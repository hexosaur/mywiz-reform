<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	// SQL query to retrieve all superadmins
	$sql = "SELECT admin_id, CONCAT(first_name, ' ', IF(middle_name IS NOT NULL AND middle_name != '', CONCAT(LEFT(middle_name,1), '. '), ''), surname, IF(suffix IS NOT NULL AND suffix != '', CONCAT(' ', suffix), '')) AS full_name, username, is_active FROM admin_superadmin  ORDER BY surname ASC, first_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$admin_id = (int)$row['admin_id'];
				$admin_num 	= str_pad($admin_id, 4, '0', STR_PAD_LEFT);
				$full_name = htmlspecialchars($row['full_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$username = htmlspecialchars($row['username'] ?? '', ENT_QUOTES, 'UTF-8');
				$is_active = ((int)$row['is_active'] === 1);
				$status_badge = $is_active ? "<span class='badge badge-pill badge-success'>Active</span>" : "<span class='badge badge-pill badge-danger'>Inactive</span>";

				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='ID: '>{$admin_num}</td><td class='text-center' data-column='Name: '>{$full_name}</td><td class='text-center' data-column='Username: '>{$username}</td><td class='text-center' data-column='Status: '>{$status_badge}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$admin_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$admin_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}

	// Output the table rows
	echo $table;
	exit;
}
?>