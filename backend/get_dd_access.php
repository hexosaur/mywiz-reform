<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT access_level_id, access_level_name FROM ref_access_levels ORDER BY access_level_name ASC";
	$select = "";
	if ($result = $conn->query($sql)) {
		$select .= "<option disabled selected>Select Access</option>";
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$access_level_id   = (int)$row['access_level_id'];
				$access_level_name = htmlspecialchars($row['access_level_name'], ENT_QUOTES, 'UTF-8');
				$select .= "<option value='{$access_level_id}'>{$access_level_name}</option>";
			}
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
