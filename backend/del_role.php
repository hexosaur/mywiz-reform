<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

	$role_id = (int)$_GET['id'];
	if ($role_id <= 0) {
		echo "err";
		exit;
	}
	$sql = "DELETE FROM mgmt_roles WHERE role_id = '$role_id'";
	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	} else {
		echo $conn->error;
		exit;
	}
}

echo "err";
exit;
?>
