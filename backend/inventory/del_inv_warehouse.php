<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$pkid = (int)$_GET['id'];

	$sql = "DELETE FROM inv_warehouses WHERE warehouse_id = '$pkid'";
	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	} else {
		echo "err";
		exit;
	}
}
?>