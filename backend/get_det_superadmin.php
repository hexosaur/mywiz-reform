<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$admin_id = $_GET['id'];

	// SQL query to retrieve the superadmin details
	$sql = "SELECT admin_id, first_name, middle_name, surname, suffix, username, is_active FROM admin_superadmin WHERE admin_id = '$admin_id' LIMIT 1";
	
	// Execute the query
	if ($result = $conn->query($sql)) {
		if($result->num_rows > 0){
			$data = array();
			while ($row = $result->fetch_array()) {
				$data[] = $row;
				$first_name = $row['first_name'];
				$middle_name = $row['middle_name'];
				$surname = $row['surname'];
				$suffix = $row['suffix'];
				$username = $row['username'];
				$is_active = $row['is_active'];
			}
			if($suffix === ""){ $suffix = "N/A";}
			$result->free();

			// Return the data in JSON format
			echo json_encode(array(
				"first_name" => $first_name, 
				"middle_name" => $middle_name, 
				"surname" => $surname, 
				"suffix" => $suffix, 
				"username" => $username, 
				"is_active" => $is_active
			));
			exit;
		} else {
			echo json_encode(array("status" => "error", "message" => "No data found for the given admin ID."));
			exit;
		}
	} else {
		echo json_encode(array("status" => "error", "message" => "Error executing the query."));
		exit;
	}
}
?>