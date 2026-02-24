<?php
session_start();
error_reporting(0);
include('../config/cfg.php');
if (isset($_GET['security']) && $_GET['security'] === '123465' && isset($_GET['id'])) {
	$pkid = $_GET['id'];
	$pkid = mysqli_real_escape_string($conn, $pkid);
	$sql = "DELETE FROM leave_types WHERE type_id = '$pkid'";
	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	} else {
		echo $conn->error;
		exit;
	}
}
?>
