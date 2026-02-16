<?php
session_start();
error_reporting(E_ALL); // Enable full error reporting for debugging
include('../config/cfg.php');

if (isset($_POST['data'])) {
	// Decode the incoming JSON for access data
	$access = json_decode($_POST['data']);
	$access_name = $conn->real_escape_string($access->access_name);
	$access_desc = $conn->real_escape_string($access->access_desc);
	$access_value = (int)$access->access_val;
	$access_id = (int)$access->pkid;
	$pcd = true;

	if ($access_id == 0) {
		$exst_name = "SELECT 1 FROM ref_access_levels WHERE access_level_name = '$access_name' LIMIT 1";
		if ($conn->query($exst_name)->num_rows > 0) {
			echo "exist_name";
			exit;
		}
	} else {
		$sql_check = "SELECT access_level_name, access_level_description, access_level_value FROM ref_access_levels WHERE access_level_id = '$access_id'";
		$result = $conn->query($sql_check);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$is_changed = false;
			if ($row['access_level_name'] !== $access_name) $is_changed = true;
			if ($row['access_level_description'] !== $access_desc) $is_changed = true;
			if ($row['access_level_value'] !== $access_value) $is_changed = true;
			if (!$is_changed) {
				echo "exist";
				exit;
			}
		} else {
			echo "err";
			exit;
		}
		$exst_name_update = "SELECT 1 FROM ref_access_levels WHERE access_level_name = '$access_name' AND access_level_id != '$access_id' LIMIT 1";
		if ($conn->query($exst_name_update)->num_rows > 0) {
			echo "exist_name";
			exit;
		}
	}

	if ($access_id == 0) {
		$sql = "INSERT INTO ref_access_levels(access_level_name, access_level_description, access_level_value) VALUES ('$access_name', '$access_desc', '$access_value')";

		if ($conn->query($sql) !== TRUE) {
			echo "err";
			exit;
		}
		echo "true";
	} else {
		// Update existing access level
		$sql = "UPDATE ref_access_levels SET access_level_name = '$access_name', access_level_description = '$access_desc', access_level_value = '$access_value' WHERE access_level_id = '$access_id'";

		if ($conn->query($sql) === TRUE) {
			echo "true";
		} else {
			echo "err";
		}
	}
}
?>
