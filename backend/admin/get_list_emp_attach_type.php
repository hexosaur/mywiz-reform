<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465') {
		$sql = "SELECT attachment_type_id, type_name, description, is_required, is_expirable, sort_order
				FROM ref_attachment_types
				ORDER BY sort_order ASC, type_name ASC";

		$n = 1;
		$table = "";
		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					$attachment_type_id = (int)$row['attachment_type_id'];
					$type_name = htmlspecialchars($row['type_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$description = htmlspecialchars($row['description'] ?? '', ENT_QUOTES, 'UTF-8');
					$is_required = (int)$row['is_required'];
					$is_expirable = (int)$row['is_expirable'];
					$sort_order = (int)$row['sort_order'];

					$required_badge = $is_required == 1
						? "<span class='badge badge-success'>Required</span>"
						: "<span class='badge badge-secondary'>Optional</span>";

					$expirable_badge = $is_expirable == 1
						? "<span class='badge badge-warning'>Yes</span>"
						: "<span class='badge badge-secondary'>No</span>";

					$table .= "<tr>
						<td class='text-center'>{$n}</td>
						<td data-column='Type Name: '>{$type_name}</td>
						<td data-column='Description: '>{$description}</td>
						<td class='text-center' data-column='Required: '>{$required_badge}</td>
						<td class='text-center' data-column='Expirable: '>{$expirable_badge}</td>
						<td class='text-center' data-column='Sort Order: '>{$sort_order}</td>
						<td class='text-center' data-column='Action: '>
							<div class='btn btn-outline-info btn-sm btn-edit' data-id='{$attachment_type_id}'><span class='feather icon-edit'></span></div>
							<div class='btn btn-outline-danger btn-sm btn-del' data-id='{$attachment_type_id}'><span class='feather icon-trash-2'></span></div>
						</td>
					</tr>";
					$n++;
				}
				$result->free();
			}
		}

		echo $table;
		exit;
	}
?>