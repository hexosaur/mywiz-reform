<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
			$id = $_GET['id'];
			$sql = "SELECT permission_name, permission_title, permission_class, permission_description FROM mgmt_permissions WHERE permission_id = '$id'";

			// Execute the query
			if ($result = $conn->query($sql)) {
				if ($result->num_rows > 0) {
					$data = array();
					while ($row = $result->fetch_array()) {
						$data[] = $row;  
						$perms_name = $row['permission_name'];
						$perms_title = $row['permission_title'];
						$perms_class = $row['permission_class'];
						$perms_desc = $row['permission_description'];
					}
					
					// Free the result set
					$result->free();

					// Return the data as a JSON object
					echo json_encode(array(
						"perms_name" => $perms_name, 
						"perms_title" => $perms_title, 
						"perms_class" => $perms_class, 
						"perms_desc" => $perms_desc
					));
					exit;
				} else {
					// If no results are found, return an error message
					echo json_encode(array("status" => "error", "message" => "No data found for the given permission ID."));
					exit;
				}
			} else {
				// If there’s an error executing the query, return an error message
				echo json_encode(array("status" => "error", "message" => "Error executing the query."));
				exit;
			}
		}
	}
?>
