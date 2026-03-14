<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
	echo "session_expired";
	exit;
}

if (!isset($_POST['password']) || trim($_POST['password']) == '') {
	echo "false";
	exit;
}

$employee_id = (int)$_SESSION['login'];
$password = $_POST['password'];

$sql = "SELECT password_hash FROM mgmt_users WHERE employee_id = '$employee_id' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
	$row = $result->fetch_assoc();

	if (password_verify($password, $row['password_hash'])) {
		echo "true";
	} else {
		echo "false";
	}
	exit;
}

echo "false";
exit;
?>