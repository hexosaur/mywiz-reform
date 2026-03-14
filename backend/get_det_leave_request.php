<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_GET['security']) || $_GET['security'] !== '123465' || !isset($_GET['id'])) {
	echo "err id";
	exit;
}

$request_id = (int)$_GET['id'];
$sql_request = " SELECT  lr.employee_id, lr.entitlement_id, lr.proxy_employee_id, lr.purpose, lr.date_from, lr.date_to, lr.time_from, lr.time_to, lr.requested_days, lr.status, lr.created_at, lr.updated_at, lr.attachment, lt.type_name, lt.type_code, e.department_id, CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), ''), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '') ) AS employee_full_name FROM leave_requests lr JOIN leave_entitlements le ON le.entitlement_id = lr.entitlement_id JOIN leave_types lt ON lt.type_id = le.type_id JOIN mgmt_employees e ON e.employee_id = lr.employee_id WHERE lr.request_id = '$request_id' LIMIT 1 ";
$res_request = $conn->query($sql_request);
$request_details = [];
if ($res_request && $res_request->num_rows > 0) {
	$request_details = $res_request->fetch_assoc();
	if (!isset($request_details['attachment']) || trim((string)$request_details['attachment']) === '') {
		$request_details['attachment'] = null;
	}
	if ($request_details['proxy_employee_id'] !== null) {
		$proxy_id = (int)$request_details['proxy_employee_id'];
		$sql_proxy = "SELECT CONCAT(first_name, ' ', surname) AS full_name FROM mgmt_employees WHERE employee_id = '$proxy_id' LIMIT 1";
		$res_proxy = $conn->query($sql_proxy);
		if ($res_proxy && $res_proxy->num_rows > 0) {
			$proxy_details = $res_proxy->fetch_assoc();
			$request_details['proxy_name'] = $proxy_details['full_name'];
		} else {
			$request_details['proxy_name'] = 'N/A';
		}
	} else {
		$request_details['proxy_name'] = 'N/A';
	}
	$dept_id = (int)$request_details['department_id'];
} else {
	echo json_encode(array('error' => "error_details"));
	exit;
}
$sql_steps = " SELECT lrs.step_no, lrs.step_type, lrs.step_status, lrs.acted_at, lrs.required_min_value, CASE WHEN lrs.step_type = 'HR' THEN 'H.R.' WHEN lrs.step_type = 'TOP' THEN 'Top Management' WHEN lrs.step_type = 'BR_DEPT_CHAIN' THEN ( SELECT r2.role_name FROM mgmt_roles r2 JOIN ref_access_levels al2 ON al2.access_level_id = r2.access_level_id WHERE al2.access_level_value = lrs.required_min_value AND r2.department_id = '$dept_id' ORDER BY r2.role_id ASC LIMIT 1 ) WHEN lrs.step_type = 'BRANCH_CHAIN' THEN ( SELECT r3.role_name FROM mgmt_roles r3 JOIN ref_access_levels al3 ON al3.access_level_id = r3.access_level_id WHERE al3.access_level_value = lrs.required_min_value AND r3.department_id != '$dept_id' ORDER BY r3.role_id ASC LIMIT 1 ) ELSE 'Approval' END AS step_label FROM leave_request_steps lrs WHERE lrs.request_id = '$request_id' ORDER BY lrs.step_no ASC ";

$res_steps = $conn->query($sql_steps);
$steps_data = [];
if ($res_steps && $res_steps->num_rows > 0) {
	while ($step = $res_steps->fetch_assoc()) {
		$steps_data[] = $step;
	}
}
$response_data = [
	'request_details' => $request_details,
	'steps' => $steps_data
];
echo json_encode($response_data);
exit;
?>