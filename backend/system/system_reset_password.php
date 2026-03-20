<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (!isset($_POST['id'])) {
	echo "invalida";
	exit;
}

$employee_id = (int) $_POST['id'];

if ($employee_id <= 0) {
	echo "invalidb";
	exit;
}

$new_password = '1';
$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

$sql_check = "SELECT user_id FROM mgmt_users WHERE employee_id = '$employee_id' LIMIT 1";
$result_check = $conn->query($sql_check);

if (!$result_check || $result_check->num_rows == 0) {
	echo "not_found";
	exit;
}

$sql_update = "UPDATE mgmt_users  SET password_hash = '$new_password_hash' WHERE employee_id = '$employee_id' LIMIT 1";

if ($conn->query($sql_update)) {
	echo "true";
} else {
	echo "error";
}
?>