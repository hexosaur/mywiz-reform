<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (
	isset($_GET['security']) && $_GET['security'] == '123465' &&
	isset($_GET['id'])
) {
	$employee_id = (int)$_GET['id'];

	// 1) Get employee header (full name + role)
	$sqlH = " SELECT e.employee_id, CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), ''), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '') ) AS full_name, r.role_name FROM mgmt_employees e LEFT JOIN mgmt_roles r ON r.role_id = e.role_id WHERE e.employee_id = '$employee_id' LIMIT 1 ";

	$resH = $conn->query($sqlH);
	if (!$resH || $resH->num_rows == 0) {
		echo json_encode(["status" => "error", "message" => "Employee not found."]);
		exit;
	}

	$h = $resH->fetch_assoc();
	$full_name = $h['full_name'] ?? '';
	$role_name = $h['role_name'] ?? '';
	$resH->free();

	// 2) Get entitlement rows for table
	$sql = " SELECT  lt.type_name, lt.default_allowed_days , le.modified_days FROM leave_entitlements le JOIN leave_types lt ON lt.type_id = le.type_id JOIN mgmt_employees e ON e.employee_id = le.employee_id WHERE le.employee_id = '$employee_id' AND e.is_active = 1 AND lt.is_active = 1 ORDER BY lt.type_name ASC ";

	$tbody = "";
	if ($res = $conn->query($sql)) {
		while ($row = $res->fetch_assoc()) {
			$type_name = htmlspecialchars($row['type_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$daysMax = (float)($row['default_allowed_days'] ?? 0);
			$daysMod = (float)($row['modified_days'] ?? 0);
			$days_fmtMax = number_format($daysMax, 2);
			$days_fmtMod = number_format($daysMod, 2);

			$tbody .= "<tr class='text-center'><td>{$type_name}</td><td>{$days_fmtMax}</td><td>{$days_fmtMod}</td></tr>";
		}
		$res->free();
	}

	echo json_encode([
		// "employee_id" => $employee_id,
		"full_name" => $full_name,
		"role_name" => $role_name,
		"tbody" => $tbody
	]);
	exit;
}

echo json_encode(["status" => "error", "message" => "Invalid request."]);
exit;
?>