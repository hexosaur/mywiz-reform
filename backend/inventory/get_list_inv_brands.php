<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT brand_id, brand_name, description
			FROM inv_brands
			ORDER BY brand_name ASC";
	$n = 1;
	$table = "";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$brand_id    = (int)$row['brand_id'];
				$brand_name  = htmlspecialchars($row['brand_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$description = htmlspecialchars((isset($row['description']) && trim($row['description']) !== '') ? $row['description'] : 'No Description', ENT_QUOTES, 'UTF-8');
				$table .= "<tr><td class='text-center align-middle'>{$n}</td><td class='align-middle' data-column='Brand: '>{$brand_name}</td><td class='align-middle' data-column='Description: '>{$description}</td><td class='text-center align-middle' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$brand_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$brand_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}
	echo $table;
	exit;
}
?>