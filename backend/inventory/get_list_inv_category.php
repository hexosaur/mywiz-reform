<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT category_id, category_name, category_code FROM inv_categories ORDER BY category_name ASC";
	$n = 1;
	$table = "";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$category_id   = (int)$row['category_id'];
				$category_name = htmlspecialchars($row['category_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$category_code = htmlspecialchars($row['category_code'] ?? '', ENT_QUOTES, 'UTF-8');
				$table .= "<tr><td class='text-center align-middle'>{$n}</td><td class='align-middle' data-column='Category: '>{$category_name}</td><td class='align-middle' data-column='Code: '>{$category_code}</td><td class='text-center align-middle' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$category_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$category_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}
	echo $table;
	exit;
}
?>