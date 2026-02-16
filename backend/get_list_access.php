<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	// SQL query to retrieve access levels
	$sql = "SELECT access_level_id, access_level_name, access_level_description, access_level_value FROM ref_access_levels ORDER BY access_level_name ASC";

	$n = 1;  // For numbering the rows in the table
	$table = "";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$access_level_id = (int)$row['access_level_id'];
				$access_level_name = htmlspecialchars($row['access_level_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$access_level_description = htmlspecialchars($row['access_level_description'] ?? '', ENT_QUOTES, 'UTF-8');
				$access_level_value = (int)$row['access_level_value'];
				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Access Level: '>{$access_level_name}</td><td class='text-center' data-column='Description: '>{$access_level_description}</td><td class='text-center' data-column='Value: '>{$access_level_value}</td>
				<td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$access_level_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$access_level_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
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
