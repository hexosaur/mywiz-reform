<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT access_level_name, access_level_description, access_level_value FROM ref_access_levels WHERE access_level_id = '$id'";

	// Execute the query
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			// Return the data as a JSON object
			echo json_encode(array(
				"access_name" => $row['access_level_name'],
				"access_desc" => $row['access_level_description'],
				"access_val" => $row['access_level_value']
			));
			exit;
		} else {
			echo json_encode(array("status" => "error", "message" => "No data found for the given access level ID."));
			exit;
		}
	} else {
		// If there is an error executing the query
		echo json_encode(array("status" => "error", "message" => "Error executing the query."));
		exit;
	}
}
?>
