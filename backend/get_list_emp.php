<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT e.employee_id, CONCAT( e.first_name, ' ', IF(e.middle_name IS NOT NULL AND e.middle_name != '', CONCAT(LEFT(e.middle_name,1), '. '), '' ), e.surname, IF(e.suffix IS NOT NULL AND e.suffix != '', CONCAT(' ', e.suffix), '' ) ) AS full_name, e.employee_code, d.department_name, r.role_name FROM mgmt_employees e LEFT JOIN mgmt_departments d ON d.department_id = e.department_id LEFT JOIN mgmt_roles r ON r.role_id = e.role_id ORDER BY e.surname ASC, e.first_name ASC";
	$n = 1;
	$table = "";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$employee_id	= (int)$row['employee_id'];
				$emp_number 	= str_pad($employee_id, 4, '0', STR_PAD_LEFT);
				$full_name		= htmlspecialchars($row['full_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$employee_code	= htmlspecialchars($row['employee_code'] ?? '', ENT_QUOTES, 'UTF-8');
				$dept_name		= htmlspecialchars($row['department_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$role_name		= htmlspecialchars($row['role_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='ID: '>{$emp_number}</td><td class='text-center' data-column='Name: '>{$full_name}</td><td class='text-center' data-column='Code: '>{$employee_code}</td><td class='text-center' data-column='Department: '>{$dept_name}</td><td class='text-center' data-column='Role: '>{$role_name}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$employee_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-warning btn-sm btn-rst' data-id='{$employee_id}'><span class='feather icon-refresh-cw'></span></div>`</td></tr>";
				$n++;
			}
			$result->free();
		}
	}

	echo $table;
	exit;
}
?>
