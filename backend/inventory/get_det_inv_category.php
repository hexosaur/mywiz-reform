<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];

	$sql = "SELECT category_name, category_code
			FROM inv_categories
			WHERE category_id = '$id'
			LIMIT 1";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			echo json_encode(array(
				"category_name" => $row['category_name'],
				"category_code" => $row['category_code']
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