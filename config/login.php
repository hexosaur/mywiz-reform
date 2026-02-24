<?php
	session_start();
	error_reporting(E_ALL);
	include('cfg.php');

	if (!isset($_POST['data'])) { echo "err_acc"; exit; }

	$data = json_decode($_POST['data']);
	if (!$data) { echo "err_acc"; exit; }

	$user = $conn->real_escape_string(trim((string)$data->user));
	$pass = sha1(md5((string)$data->pass));

	/* 1) SUPERADMIN */
	$sqlA = "SELECT admin_id FROM admin_superadmin WHERE username = '$user' AND password = '$pass' AND is_active = 1 LIMIT 1";

	$resA = $conn->query($sqlA);
	if ($resA && $resA->num_rows > 0) {
		$row = $resA->fetch_assoc();
		$adminperms = [];
		$_SESSION['adminlogin'] = (int)$row['admin_id'];
		$_SESSION['level'] = 9999;
		$_SESSION['table'] = "superadmin";
		$_SESSION['branch'] = "super";
		$_SESSION['permission'] = $adminperms;
		echo $_SESSION['adminlogin'];
		exit;
	}

	/* 2) EMPLOYEE */
	$sqlE = " SELECT  u.employee_id, e.branch_id, e.role_id, rl.access_level_id, al.access_level_value FROM mgmt_users u JOIN mgmt_employees e ON e.employee_id = u.employee_id LEFT JOIN mgmt_roles rl ON rl.role_id = e.role_id LEFT JOIN ref_access_levels al ON al.access_level_id = rl.access_level_id WHERE u.username = '$user' AND u.password_hash = '$pass' AND e.is_active = 1 LIMIT 1 ";



	$resE = $conn->query($sqlE);
	if ($resE && $resE->num_rows > 0) {
		$row = $resE->fetch_assoc();
		$emp_id = (int)$row['employee_id'];
		$role_id = (int)$row['role_id'];
		$_SESSION['login'] = $emp_id;
		$_SESSION['level'] = (int)$row['access_level_value'];
		$_SESSION['table'] = ["employee"];
		$_SESSION['branch'] = (int)$row['branch_id'];
		$_SESSION['role_id'] = $role_id;
		
		$permSql = " SELECT p.permission_name FROM mgmt_role_permissions rp JOIN mgmt_permissions p ON p.permission_id = rp.permission_id WHERE rp.role_id = '$role_id' ";
		


		$permRes = $conn->query($permSql);
		$perms = [];
		if ($permRes && $permRes->num_rows > 0) {
			while ($p = $permRes->fetch_assoc()) {
				$perms[] = $p['permission_name'];
			}
		}
		$_SESSION['permissions'] = $perms;
		echo $_SESSION['login'];


		exit;
	}

	/* If both fail */
	echo "err_acc";
	exit;
?>