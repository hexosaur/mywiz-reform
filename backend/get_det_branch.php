<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
			$id = $_GET['id'];
			// SQL query to retrieve branch, province, city, and barangay details
			$sql = "SELECT br.branch_name, br.branch_code, br.address_line, p.prov_name, p.prov_id, c.city_name, c.city_id, b.brgy_name, b.brgy_id FROM mgmt_branch br INNER JOIN ref_provinces p ON p.prov_id = br.prov_id INNER JOIN ref_cities c ON c.city_id = br.city_id LEFT JOIN ref_barangays b ON b.brgy_id = br.brgy_id WHERE br.branch_id = '$id'";
			// Execute the query
			if ($result = $conn->query($sql)) {
				if($result->num_rows > 0){
					 $data = array();
					while ($row = $result->fetch_array()) {
						$data[] = $row;
						$branch_name = $row['branch_name'];
						$branch_code = $row['branch_code'];
						$branch_address = $row['address_line'];
						$prov_name = $row['prov_name'];
						$prov_id = $row['prov_id'];
						$city_name = $row['city_name'];
						$city_id = $row['city_id'];
						$brgy_name = $row['brgy_name'];
						$brgy_id = $row['brgy_id'];
					}
					$result->free();

					// Return the data in JSON format
					echo json_encode(array(
						"branch_name" => $branch_name, 
						"branch_code" => $branch_code, 
						"branch_address" => $branch_address, 
						"prov_name" => $prov_name, 
						"prov_id" => $prov_id, 
						"city_name" => $city_name, 
						"city_id" => $city_id, 
						"brgy_name" => $brgy_name, 
						"brgy_id" => $brgy_id
					));
					exit;
				} else {
					echo json_encode(array("status" => "error", "message" => "No data found for the given branch ID."));
					exit;
				}
			} else {
				echo json_encode(array("status" => "error", "message" => "Error executing the query."));
				exit;
			}
		}
	}
?>


