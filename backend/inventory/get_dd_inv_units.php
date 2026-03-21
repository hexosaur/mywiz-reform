<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT unit_id, unit_name, unit_code FROM inv_units ORDER BY unit_name ASC";

	$select = "";

	if ($result = $conn->query($sql)) {

		$select .= "<option disabled selected value='0'>Select Unit</option>";

		while ($row = $result->fetch_assoc()) {
			$id = (int)$row['unit_id'];
			$name = htmlspecialchars($row['unit_code'], ENT_QUOTES, 'UTF-8');
			$select .= "<option value='{$id}'>{$name}</option>";
		}

		echo $select;
		exit;
	}
}
?>