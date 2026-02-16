<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465') {
		$sql = "SELECT  permission_id, permission_name, permission_title, permission_description, permission_class FROM mgmt_permissions mp ORDER BY permission_title ASC";

		$n = 1;
		$table = "";
		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					// Get the permission details from the result
					$permission_id   = (int)$row['permission_id'];
					$permission_name = htmlspecialchars($row['permission_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$permission_title = htmlspecialchars($row['permission_title'] ?? '', ENT_QUOTES, 'UTF-8');
					$permission_description = htmlspecialchars($row['permission_description'] ?? '', ENT_QUOTES, 'UTF-8');
					$permission_class = htmlspecialchars($row['permission_class'] ?? '', ENT_QUOTES, 'UTF-8');
					$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Permission Name: '>{$permission_name}</td><td class='text-center' data-column='Title: '>{$permission_title}</td><td class='text-center' data-column='Description: '>{$permission_description}</td><td class='text-center' data-column='Class: '>{$permission_class}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$permission_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$permission_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
					$n++;
				}
				$result->free();
			}
		}

		// Output the table content
		echo $table;
		exit;
	}
?>
