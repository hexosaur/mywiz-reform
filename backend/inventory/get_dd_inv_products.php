<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT product_id, product_name, sku FROM inv_products WHERE status = 1 ORDER BY product_name ASC";
	$select = "";
	if ($result = $conn->query($sql)) {
		$select .= "<option disabled selected value='0'>Select Product</option>";
		while ($row = $result->fetch_assoc()) {
			$id   = (int)$row['product_id'];
			$name = htmlspecialchars($row['product_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$sku  = htmlspecialchars($row['sku'] ?? '', ENT_QUOTES, 'UTF-8');

			$select .= "<option value='{$id}'>{$name} ({$sku})</option>";
		}

		echo $select;
		exit;
	} else {
		echo "";
		exit;
	}
}
?>