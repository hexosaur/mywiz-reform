<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];

	$sql = "SELECT supplier_name, contact_person, contact_number, email, address, tin_no, status FROM inv_suppliers WHERE supplier_id = '$id' LIMIT 1";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo json_encode(array(
				"supplier_name"  => $row['supplier_name'],
				"contact_person" => $row['contact_person'],
				"contact_number" => $row['contact_number'],
				"email"          => $row['email'],
				"address"        => $row['address'],
				"tin_no"         => $row['tin_no'],
				"status"         => (int)$row['status']
			));
			exit;
		} else {
			echo json_encode(array("status" => "error", "message" => "No data found."));
			exit;
		}
	} else {
		echo json_encode(array("status" => "error", "message" => "Query error."));
		exit;
	}
}
?>