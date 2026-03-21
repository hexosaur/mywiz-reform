<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];

	$sql = "SELECT brand_id, brand_name, description FROM inv_brands WHERE brand_id = '$id' LIMIT 1";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo json_encode(array(
				"brand_id" => (int)$row['brand_id'],
				"brand_name" => $row['brand_name'] ?? '',
				"description" => $row['description'] ?? ''
			));
			exit;
		} else {
			echo json_encode(array(
				"status" => "error",
				"message" => "No data found."
			));
			exit;
		}
	} else {
		echo json_encode(array(
			"status" => "error",
			"message" => "Error executing query."
		));
		exit;
	}
}
?>