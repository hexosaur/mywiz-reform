<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {

	$unit = json_decode($_POST['data']);

	$unit_name = $conn->real_escape_string(trim($unit->unit_name ?? ''));
	$unit_code = $conn->real_escape_string(trim($unit->unit_code ?? ''));
	$unit_id = (int)($unit->pkid ?? 0);

	if ($unit_name == '' || $unit_code == '') {
		echo "err";
		exit;
	}
	
	// ===== CHECK EXISTENCE =====
	if ($unit_id == 0) {

		$exst_name = "SELECT 1 FROM inv_units WHERE unit_name = '$unit_name' LIMIT 1";
		if ($conn->query($exst_name)->num_rows > 0) {
			echo "exist";
			exit;
		}

		$exst_code = "SELECT 1 FROM inv_units WHERE unit_code = '$unit_code' LIMIT 1";
		if ($conn->query($exst_code)->num_rows > 0) {
			echo "exist_code";
			exit;
		}

		// ===== INSERT =====
		$sql = "INSERT INTO inv_units (unit_name, unit_code)
				VALUES ('$unit_name', '$unit_code')";

		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}
	} else {

		$exst_name = "SELECT 1 FROM inv_units WHERE unit_name = '$unit_name' AND unit_id != '$unit_id' LIMIT 1";
		if ($conn->query($exst_name)->num_rows > 0) {
			echo "exist";
			exit;
		}

		$exst_code = "SELECT 1 FROM inv_units WHERE unit_code = '$unit_code' AND unit_id != '$unit_id' LIMIT 1";
		if ($conn->query($exst_code)->num_rows > 0) {
			echo "exist_code";
			exit;
		}
		
		// ===== UPDATE =====
		$sql = "UPDATE inv_units SET unit_name = '$unit_name', unit_code = '$unit_code' WHERE unit_id = '$unit_id'";
		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}
	}
}
?>