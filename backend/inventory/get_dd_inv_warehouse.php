<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT warehouse_id, warehouse_name FROM inv_warehouses WHERE status = 1 ORDER BY warehouse_name ASC";

	$select = "";

	if ($result = $conn->query($sql)) {
		$select .= "<option disabled selected value='0'>Select Warehouse</option>";

		while ($row = $result->fetch_assoc()) {
			$id   = (int)$row['warehouse_id'];
			$name = htmlspecialchars($row['warehouse_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$select .= "<option value='{$id}'>{$name}</option>";
		}

		echo $select;
		exit;
	} else {
		echo "";
		exit;
	}
}
?>