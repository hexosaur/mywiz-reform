<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	// Fetch employee entitlement details with full name
	$sql = "SELECT DISTINCT e.employee_id, CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), '' ), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '' ) ) AS full_name FROM leave_entitlements le JOIN mgmt_employees e ON le.employee_id = e.employee_id JOIN leave_types lt ON le.type_id = lt.type_id WHERE e.is_active = 1 AND lt.is_active = 1 ORDER BY e.surname ASC, e.first_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$employee_id = (int)$row['employee_id'];
				$full_name = htmlspecialchars($row['full_name'] ?? '', ENT_QUOTES, 'UTF-8');

				// Append the row to the table with Edit action button
				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Employee Name: '>{$full_name}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$employee_id}'><span class='feather icon-edit'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}

	echo $table;
	exit;
}
?>
