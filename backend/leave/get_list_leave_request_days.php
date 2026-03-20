<?php
session_start();
error_reporting(E_ALL);
include('../../config/cfg.php');

if (!isset($_SESSION['login'])) {
	echo json_encode(["error" => "No session found"]);
	exit;
}

$employee_id = (int)$_SESSION['login'];

$sql = " SELECT lt.type_name, lt.default_allowed_days AS allocated_days, le.modified_days, le.used_days, (lt.default_allowed_days + le.modified_days - le.used_days) AS total_leave_balance FROM leave_entitlements le JOIN leave_types lt ON lt.type_id = le.type_id WHERE le.employee_id = ? AND lt.is_active = 1 ORDER BY lt.type_name ASC ";

// Prepare the statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $employee_id); // 'i' for integer
$stmt->execute();
$result = $stmt->get_result();

$leave_data = [];
$list = "";
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$days =(float)$row['total_leave_balance'];
		$name = $row['type_name'];
		$list .= "<div class='leave-info'><span class='f-w-600 leave-name'>{$name}:</span><span class='leave-days'>{$days}</span></div>";
	}
	echo $list;
} else {
	echo json_encode(["message" => "No leave data found for this employee."]);
}

exit;
?>