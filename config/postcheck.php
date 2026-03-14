<?php
session_start();
include(__DIR__ . "/cfg.php"); // ✅ ADDED

// ✅ ADDED: If session missing, try remember_me cookie
if (empty($_SESSION['adminlogin']) && empty($_SESSION['login']) && !empty($_COOKIE['remember_me'])) {
	$parts = explode(":", $_COOKIE['remember_me'], 2);
	if (count($parts) === 2) {
		[$selector, $token] = $parts;
		$token_hash = hash('sha256', $token);

		$stmt = $conn->prepare(" SELECT id, user_id, user_type, token_hash, expires_at FROM auth_remember_tokens WHERE selector = ? LIMIT 1 ");
		$stmt->bind_param("s", $selector);
		$stmt->execute();
		$row = $stmt->get_result()->fetch_assoc();

		if ($row && strtotime($row['expires_at']) >= time() && hash_equals($row['token_hash'], $token_hash)) {

			session_regenerate_id(true); // ✅ ADDED

			// ✅ Restore session
			if ($row['user_type'] === 'admin') {

				$_SESSION['adminlogin'] = (int)$row['user_id'];
				$_SESSION['level'] = 9999;
				$_SESSION['branch'] = "super";
				$_SESSION['permission_classes'] = ['superadmin'];
				$_SESSION['permissions'] = ['superadmin'];

			} else {

				$_SESSION['login'] = (int)$row['user_id'];
				$emp_id = (int)$row['user_id'];

				// ✅ Reload employee branch/role/level
				$sqlE = "SELECT e.branch_id, e.role_id, al.access_level_value FROM mgmt_users u JOIN mgmt_employees e ON e.employee_id = u.employee_id LEFT JOIN mgmt_roles rl ON rl.role_id = e.role_id LEFT JOIN ref_access_levels al ON al.access_level_id = rl.access_level_id WHERE u.employee_id = ? AND e.is_active = 1 LIMIT 1";
				$stE = $conn->prepare($sqlE);
				$stE->bind_param("i", $emp_id);
				$stE->execute();
				$emp = $stE->get_result()->fetch_assoc();

				if ($emp) {
					$_SESSION['level']  = (int)$emp['access_level_value'];
					$_SESSION['branch'] = (int)$emp['branch_id'];
					$_SESSION['role_id'] = (int)$emp['role_id'];
					$role_id = (int)$emp['role_id'];
					$permSql = "SELECT p.permission_name, p.permission_class
								FROM mgmt_role_permissions rp
								JOIN mgmt_permissions p ON p.permission_id = rp.permission_id
								WHERE rp.role_id = ?";
					$stP = $conn->prepare($permSql);
					$stP->bind_param("i", $role_id);
					$stP->execute();
					$permRes = $stP->get_result();

					$perms = [];
					$permission_classes = [];
					while ($p = $permRes->fetch_assoc()) {
						$perms[] = $p['permission_name'];
						if (!in_array($p['permission_class'], $permission_classes, true)) {
							$permission_classes[] = $p['permission_class'];
						}
					}

					$_SESSION['permissions'] = $perms;
					$_SESSION['permission_classes'] = $permission_classes;

				} else {
					setcookie("remember_me", "", time() - 3600, "/");
				}
			}
			$newToken = bin2hex(random_bytes(32));
			$newHash  = hash('sha256', $newToken);

			$upd = $conn->prepare("UPDATE auth_remember_tokens SET token_hash=?, last_used_at=NOW() WHERE id=?");
			$upd->bind_param("si", $newHash, $row['id']);
			$upd->execute();

			setcookie( "remember_me", $selector . ":" . $newToken, [ "expires"  => strtotime($row['expires_at']), "path"     => "/", "secure"   => !empty($_SERVER['HTTPS']), "httponly" => true, "samesite" => "Lax" ] );

		} else {
			// invalid/expired
			if (!empty($row['id'])) {
				$del = $conn->prepare("DELETE FROM auth_remember_tokens WHERE id=?");
				$del->bind_param("i", $row['id']);
				$del->execute();
			}
			setcookie("remember_me", "", time() - 3600, "/");
		}

	} else {
		setcookie("remember_me", "", time() - 3600, "/");
	}
}

// ✅ ORIGINAL GUARD
if (empty($_SESSION['adminlogin']) && empty($_SESSION['login'])) {
	header('Location: ../');
	exit();
}
?>