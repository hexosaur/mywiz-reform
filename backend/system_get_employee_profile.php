<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (true) {
		if (isset($_GET['security']) && $_GET['security'] == '123465') {

			// =========================================================
			// EMPLOYEE USER
			// =========================================================
			if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {

				$employee_id = (int)$_SESSION['login'];

				$sql = "SELECT  u.user_id, u.username, u.profile_photo, u.last_login_at, e.employee_id, e.employee_code, e.first_name, e.middle_name, e.surname, e.suffix, e.email, e.contact_no, e.branch_id, e.department_id, e.role_id, e.is_active, b.branch_name, b.branch_code, d.department_name, r.role_name, CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), ''), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '') ) AS full_name FROM mgmt_users u JOIN mgmt_employees e ON e.employee_id = u.employee_id LEFT JOIN mgmt_branch b ON b.branch_id = e.branch_id LEFT JOIN mgmt_departments d ON d.department_id = e.department_id LEFT JOIN mgmt_roles r ON r.role_id = e.role_id WHERE u.employee_id = '$employee_id' LIMIT 1";

				$result = $conn->query($sql);

				if ($result && $result->num_rows > 0) {
					$row = $result->fetch_assoc();

					$profile_photo = $row['profile_photo'];
					if ($profile_photo == NULL || trim($profile_photo) == '') {
						$profile_photo = 'default.jpg';
					}

					echo json_encode(array(
						"status"           => "success",
						"user_type"        => "employee",
						"user_id"          => $row['user_id'],
						"username"         => $row['username'],
						"profile_photo"    => $profile_photo,
						"last_login_at"    => $row['last_login_at'],
						"employee_id"      => $row['employee_id'],
						"employee_code"    => $row['employee_code'],
						"first_name"       => $row['first_name'],
						"full_name"        => $row['full_name'],
						"middle_name"      => $row['middle_name'],
						"surname"          => $row['surname'],
						"suffix"           => $row['suffix'],
						"email"            => $row['email'],
						"contact_no"       => $row['contact_no'],
						"branch_id"        => $row['branch_id'],
						"branch_name"      => $row['branch_name'],
						"branch_code"      => $row['branch_code'],
						"department_id"    => $row['department_id'],
						"department_name"  => $row['department_name'],
						"role_id"          => $row['role_id'],
						"role_name"        => $row['role_name'],
						"is_active"        => $row['is_active']
					));
					exit;
				}
			}

			// =========================================================
			// SUPERADMIN
			// =========================================================
			if (isset($_SESSION['adminlogin']) && !empty($_SESSION['adminlogin'])) {

				$admin_id = (int)$_SESSION['adminlogin'];

				$sql_admin = "SELECT admin_id, first_name, middle_name, surname, suffix, username, is_active, CONCAT( first_name, ' ', IF(middle_name IS NOT NULL AND middle_name != '', CONCAT(LEFT(middle_name,1), '. '), ''), surname, IF(suffix IS NOT NULL AND suffix != '', CONCAT(' ', suffix), '') ) AS full_name FROM admin_superadmin WHERE admin_id = '$admin_id' AND is_active = 1 LIMIT 1";

				$result_admin = $conn->query($sql_admin);

				if ($result_admin && $result_admin->num_rows > 0) {
					$row_admin = $result_admin->fetch_assoc();

					$ghost_prefix = '<i class="bi bi-lightning-charge"></i> ';

					echo json_encode(array(
						"status"         => "success",
						"user_type"      => "superadmin",
						"admin_id"       => $row_admin['admin_id'],
						"username"       => $row_admin['username'],
						"profile_photo"  => 'default.jpg',
						"first_name"     => $ghost_prefix . $row_admin['first_name'],
						"full_name"      => $ghost_prefix . $row_admin['full_name'],
						"middle_name"    => $row_admin['middle_name'],
						"surname"        => $row_admin['surname'],
						"suffix"         => $row_admin['suffix'],
						"role_name"      => 'Superadmin',
						"is_active"      => $row_admin['is_active']
					));
					exit;
				}
			}

			echo json_encode(array(
				"status" => "error",
				"message" => "Session expired or invalid."
			));
			exit;
		}
	}
?>