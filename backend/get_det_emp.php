<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
			$id = $_GET['id'];

			// SQL query to retrieve employee details including province, city, barangay names
			$sql = "SELECT 
						e.employee_id, 
						e.employee_code, 
						CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), '' ), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '' ) ) AS full_name,
						e.birth_date, 
						e.marital_status, 
						e.gender, 
						e.email, 
						e.contact_no, 
						e.address_line, 
						e.date_hired, 
						e.branch_id, 
						e.department_id, 
						e.role_id, 
						e.daily_rate, 
						e.sss_no, 
						e.pagibig_no, 
						e.tin_no, 
						e.philhealth_no, 
						e.is_active,
						p.prov_name,
						c.city_name,
						b.brgy_name
					FROM mgmt_employees e
					LEFT JOIN ref_provinces p ON e.prov_id = p.prov_id
					LEFT JOIN ref_cities c ON e.city_id = c.city_id
					LEFT JOIN ref_barangays b ON e.brgy_id = b.brgy_id
					WHERE e.employee_id = '$id'";

			// Execute the query
			if ($result = $conn->query($sql)) {
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc(); // Fetch the employee data

					// Format birth date to "February 14, 2026" or empty if null
					$birth_date = !empty($row['birth_date']) ? date("F j, Y", strtotime($row['birth_date'])) : "";
					$date_hired = !empty($row['date_hired']) ? date("F j, Y", strtotime($row['date_hired'])) : "";
					// Full address concatenation with Barangay, City, and Province
					if(($row['address_line'])!==NULL){
						$full_address .= $row['address_line'].", ";
					}
					$full_address .= $row['brgy_name'] . ", " . $row['city_name'] . ", " . $row['prov_name'];

					// Return the data as a JSON object
					echo json_encode(array(
						"employee_id"   => $row['employee_id'], 
						"employee_code" => $row['employee_code'],
						"fullname"      => $row['full_name'], 
						"birth_date"    => $birth_date, 
						"marital_status"=> $row['marital_status'],
						"gender"        => $row['gender'],
						"email"         => $row['email'],
						"contact_no"    => $row['contact_no'],
						"address"       => $full_address,
						"date_hired"    => $date_hired,
						"branch_id"     => $row['branch_id'],
						"department_id" => $row['department_id'],
						"role_id"       => $row['role_id'],
						"daily_rate"    => $row['daily_rate'],
						"sss_no"        => $row['sss_no'],
						"pagibig_no"    => $row['pagibig_no'],
						"tin_no"        => $row['tin_no'],
						"philhealth_no" => $row['philhealth_no'],
						"is_active"     => $row['is_active'],
					));
					exit;
				} else {
					// If no employee found, return an error message
					echo json_encode(array("status" => "error", "message" => "No employee data found for the given ID."));
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
