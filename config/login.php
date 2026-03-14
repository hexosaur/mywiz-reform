<?php
session_start();
error_reporting(E_ALL);
include('cfg.php');

if (!isset($_POST['data'])) { echo "err_acc"; exit; }

$data = json_decode($_POST['data']);
if (!$data) { echo "err_acc"; exit; }

$user = trim((string)$data->user);
$plainPass = (string)$data->pass;
$remember = !empty($data->remember) ? 1 : 0;
function set_remember_me(mysqli $conn, int $user_id, string $user_type) {

	$selector = bin2hex(random_bytes(6));
	$token    = bin2hex(random_bytes(32));
	$tokenHash = hash('sha256', $token);

	$expires = new DateTime('+3 months');
	$expiresSql = $expires->format('Y-m-d H:i:s');

	$ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);
	$ip = substr($_SERVER['REMOTE_ADDR'] ?? '', 0, 45);

	$stmt = $conn->prepare(" INSERT INTO auth_remember_tokens (user_id, user_type, selector, token_hash, expires_at, user_agent, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)
	");
	$stmt->bind_param("issssss", $user_id, $user_type, $selector, $tokenHash, $expiresSql, $ua, $ip);
	$stmt->execute();

	setcookie(
		"remember_me",
		$selector . ":" . $token,
		[
			"expires"  => $expires->getTimestamp(),
			"path"     => "/",
			"secure"   => !empty($_SERVER['HTTPS']),
			"httponly" => true,
			"samesite" => "Lax"
		]
	);
}

/* 1) SUPERADMIN (bcrypt stored in admin_superadmin.password) */
$stmtA = $conn->prepare(" SELECT admin_id, password FROM admin_superadmin WHERE username = ? AND is_active = 1 LIMIT 1 ");
$stmtA->bind_param("s", $user);
$stmtA->execute();
$resA = $stmtA->get_result();

if ($resA && $resA->num_rows > 0) {
	$row = $resA->fetch_assoc();
	if (password_verify($plainPass, $row['password'])) {
		if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
			$newHash = password_hash($plainPass, PASSWORD_DEFAULT);
			$up = $conn->prepare("UPDATE admin_superadmin SET password=? WHERE admin_id=?");
			$up->bind_param("si", $newHash, $row['admin_id']);
			$up->execute();
		}

		session_regenerate_id(true);

		$admin_id = (int)$row['admin_id'];
		$_SESSION['adminlogin'] = $admin_id;
		$_SESSION['level'] = 9999;
		$_SESSION['branch'] = "super";
		$_SESSION['permission_classes'] = ['superadmin'];
		$_SESSION['permissions'] = ['superadmin'];

		if ($remember) {
			set_remember_me($conn, $admin_id, 'admin');
		}

		echo $_SESSION['adminlogin'];
		exit;
	}
}

/* 2) EMPLOYEE (bcrypt stored in mgmt_users.password_hash) */
$stmtE = $conn->prepare(" SELECT u.employee_id, u.password_hash, e.branch_id, e.role_id, al.access_level_value FROM mgmt_users u JOIN mgmt_employees e ON e.employee_id = u.employee_id LEFT JOIN mgmt_roles rl ON rl.role_id = e.role_id LEFT JOIN ref_access_levels al ON al.access_level_id = rl.access_level_id WHERE u.username = ? AND e.is_active = 1 LIMIT 1 ");
$stmtE->bind_param("s", $user);
$stmtE->execute();
$resE = $stmtE->get_result();

if ($resE && $resE->num_rows > 0) {
	$row = $resE->fetch_assoc();
	if (password_verify($plainPass, $row['password_hash'])) {
		if (password_needs_rehash($row['password_hash'], PASSWORD_DEFAULT)) {
			$newHash = password_hash($plainPass, PASSWORD_DEFAULT);
			$up = $conn->prepare("UPDATE mgmt_users SET password_hash=? WHERE employee_id=?");
			$up->bind_param("si", $newHash, $row['employee_id']);
			$up->execute();
		}

		session_regenerate_id(true);

		$emp_id = (int)$row['employee_id'];
		$role_id = (int)$row['role_id'];

		$_SESSION['login'] = $emp_id;
		$_SESSION['level'] = (int)$row['access_level_value'];
		$_SESSION['branch'] = (int)$row['branch_id'];
		$_SESSION['role_id'] = $role_id;

		$permStmt = $conn->prepare("
			SELECT p.permission_name, p.permission_class
			FROM mgmt_role_permissions rp
			JOIN mgmt_permissions p ON p.permission_id = rp.permission_id
			WHERE rp.role_id = ?
		");
		$permStmt->bind_param("i", $role_id);
		$permStmt->execute();
		$permRes = $permStmt->get_result();

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

		if ($remember) {
			set_remember_me($conn, $emp_id, 'employee');
		}

		echo $_SESSION['login'];
		exit;
	}
}

echo "err_acc";
exit;
?>