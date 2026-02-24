<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if ( !isset($_GET['security']) || $_GET['security'] !== '123465' || !isset($_GET['id']) ) {
	echo json_encode(array("status" => "error", "message" => "Invalid request."));
	exit;
}

$id = (int)$_GET['id'];
$sql = "SELECT type_id, type_code, type_name, type_description, default_allowed_days, with_pay, requires_attachment, requires_proxy, is_active FROM leave_types WHERE type_id = '$id' LIMIT 1";

if ($result = $conn->query($sql)) {
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$result->free();

		echo json_encode(array(
			"pkid"        => (int)$row['type_id'],
			"type_code"	  => $row['type_code'],
			"type_name"   => $row['type_name'],
			"type_desc"   => $row['type_description'],
			"type_days"   => $row['default_allowed_days'],
			"type_pay"    => (int)$row['with_pay'],
			"type_attach" => (int)$row['requires_attachment'],
			"type_proxy"  => (int)$row['requires_proxy'],
			"is_active"   => (int)$row['is_active']
		));
		exit;

	} else {
		echo json_encode(array("status" => "error", "message" => "No data found for the given leave type ID."));
		exit;
	}
} else {
	echo json_encode(array("status" => "error", "message" => "Error executing the query."));
	exit;
}
?>
