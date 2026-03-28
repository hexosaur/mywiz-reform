<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (true) {
	if (isset($_POST['attachment_type'])) {
		$attachment_type = json_decode($_POST['attachment_type']);

		$type_name = trim($conn->real_escape_string($attachment_type->att_name));
		$description = trim($conn->real_escape_string($attachment_type->att_desc));
		$is_required = isset($attachment_type->att_required) ? (int)$attachment_type->att_required : 0;
		$is_expirable = isset($attachment_type->att_expirable) ? (int)$attachment_type->att_expirable : 0;
		$sort_order = isset($attachment_type->att_sort) ? (int)$attachment_type->att_sort : 0;
		$attachment_type_id = (int)$attachment_type->pkid;

		$pcd = true;

		if ($type_name == '') {
			echo "empty_name";
			exit;
		}

		if ($attachment_type_id == 0) {
			$exst_name = "SELECT 1 FROM ref_attachment_types WHERE type_name = '$type_name' LIMIT 1";
			if ($conn->query($exst_name)->num_rows > 0) {
				echo "exist_name";
				exit;
			}
		} else {
			$exst_name = "SELECT 1 FROM ref_attachment_types WHERE type_name = '$type_name' AND attachment_type_id != '$attachment_type_id' LIMIT 1";
			if ($conn->query($exst_name)->num_rows > 0) {
				echo "exist_name";
				exit;
			}

			$sql_check = "SELECT type_name, description, is_required, is_expirable, sort_order 
						  FROM ref_attachment_types 
						  WHERE attachment_type_id = '$attachment_type_id'";
			$result = $conn->query($sql_check);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$is_changed = false;

				if ($row['type_name'] !== $type_name) {
					$is_changed = true;
				}
				if (($row['description'] ?? '') !== $description) {
					$is_changed = true;
				}
				if ((int)$row['is_required'] !== $is_required) {
					$is_changed = true;
				}
				if ((int)$row['is_expirable'] !== $is_expirable) {
					$is_changed = true;
				}
				if ((int)$row['sort_order'] !== $sort_order) {
					$is_changed = true;
				}

				if (!$is_changed) {
					echo "exist";
					exit;
				}
			}
		}

		if ($attachment_type_id == 0) {
			$sql = "INSERT INTO ref_attachment_types(type_name, description, is_required, is_expirable, sort_order) VALUES ('$type_name', '$description', '$is_required', '$is_expirable', '$sort_order')";
			if ($conn->query($sql) !== TRUE) {
				$pcd = false;
				echo "err";
				exit;
			}
			if ($pcd) {
				echo "true";
			} else {
				echo "err";
				exit;
			}
		} else {
			$sql = "UPDATE ref_attachment_types SET type_name = '$type_name', description = '$description', is_required = '$is_required', is_expirable = '$is_expirable', sort_order = '$sort_order' WHERE attachment_type_id = '$attachment_type_id'";
			if ($conn->query($sql) === TRUE) {
				echo "true";
				exit;
			} else {
				echo "err";
				exit;
			}
		}
	}
}
?>