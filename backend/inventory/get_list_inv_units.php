<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT unit_id, unit_name, unit_code FROM inv_units ORDER BY unit_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {

		while ($row = $result->fetch_assoc()) {

			$id   = (int)$row['unit_id'];
			$name = htmlspecialchars($row['unit_name'], ENT_QUOTES, 'UTF-8');
			$code = htmlspecialchars($row['unit_code'], ENT_QUOTES, 'UTF-8');

			$table .= "
				<tr>
					<td class='text-center align-middle'>{$n}</td>
					<td class='align-middle' data-column='Unit: '>{$name}</td>
					<td class='align-middle' data-column='Code: '>{$code}</td>
					<td class='text-center align-middle'>
						<div class='btn btn-outline-info btn-sm btn-edit' data-id='{$id}'><span class='feather icon-edit'></span></div>
						<div class='btn btn-outline-danger btn-sm btn-del' data-id='{$id}'><span class='feather icon-trash-2'></span></div>
					</td>
				</tr>
			";

			$n++;
		}

		echo $table;
		exit;
	}
}
?>