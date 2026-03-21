<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT category_id, category_name FROM inv_categories ORDER BY category_name ASC";
	$select = "";
	if ($result = $conn->query($sql)) {
		$select .= "<option disabled selected value='0'>Select Category</option>";
		while ($row = $result->fetch_assoc()) {
			$category_id   = (int)$row['category_id'];
			$category_name = htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8');
			$select .= "<option value='{$category_id}'>{$category_name}</option>";
		}
		echo $select;
		exit;
	} else {
		echo "";
		exit;
	}
}
?>