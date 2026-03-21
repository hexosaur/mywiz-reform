<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

	$id = (int)$_GET['id'];

	$sql = "SELECT unit_id, unit_name, unit_code FROM inv_units WHERE unit_id = '$id' LIMIT 1";

	if ($result = $conn->query($sql)) {

		if ($result->num_rows > 0) {

			$row = $result->fetch_assoc();

			echo json_encode(array(
				"unit_id" => $row['unit_id'],
				"unit_name" => $row['unit_name'],
				"unit_code" => $row['unit_code']
			));
			exit;
		}
	}

	echo json_encode(array("status" => "error"));
	exit;
}
?>