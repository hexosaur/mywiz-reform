<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT brand_id, brand_name FROM inv_brands ORDER BY brand_name ASC";
	$select = "";
	if ($result = $conn->query($sql)) {
		$select .= "<option disabled selected value='0'>Select Brand</option>";
		while ($row = $result->fetch_assoc()) {
			$brand_id   = (int)$row['brand_id'];
			$brand_name = htmlspecialchars($row['brand_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$select .= "<option value='{$brand_id}'>{$brand_name}</option>";
		}

		$result->free();
		echo $select;
		exit;
	} else {
		echo "";
		exit;
	}
}
?>