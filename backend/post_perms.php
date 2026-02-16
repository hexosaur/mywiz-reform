<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (true) {
	if (isset($_POST['permission'])) {
		// Decode the incoming JSON and sanitize inputs
		$permission = json_decode($_POST['permission']);
		$permission_name = $conn->real_escape_string($permission->perms_name);
		$permission_title = $conn->real_escape_string($permission->perms_title);
		$permission_class = $conn->real_escape_string($permission->perms_class);
		$permission_description = $conn->real_escape_string($permission->perms_desc);
		$permission_id = (int)$permission->pkid; 
		$pcd = true; 
		if ($permission_id == 0) {
			$exst_name = "SELECT 1 FROM mgmt_permissions WHERE permission_name = '$permission_name' LIMIT 1";
			if ($conn->query($exst_name)->num_rows > 0) {
				echo "exist_name";
				exit;
			}
			$exst_title = "SELECT 1 FROM mgmt_permissions WHERE permission_title = '$permission_title' LIMIT 1";
			if ($conn->query($exst_title)->num_rows > 0) {
				echo "exist_title";
				exit;
			}
			// $exst_class = "SELECT 1 FROM mgmt_permissions WHERE permission_class = '$permission_class' LIMIT 1";
			// if ($conn->query($exst_class)->num_rows > 0) {
			// 	echo "exist_class";
			// 	exit;
			// }
			
		} else {
			$sql_check = "SELECT permission_name, permission_title, permission_description FROM mgmt_permissions WHERE permission_id = '$permission_id'";
			$result = $conn->query($sql_check);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$is_changed = false;
				if ($row['permission_name'] !== $permission_name) {
					$is_changed = true;  // If permission name is different, it's changed
				}
				if ($row['permission_title'] !== $permission_title) {
					$is_changed = true;  // If permission title is different, it's changed
				}
				if ($row['permission_description'] !== $permission_description) {
					$is_changed = true; 
				}

				// If no changes detected, return 'no_change'
				if (!$is_changed) {
					echo "exist";  // No changes detected
					exit;
				}
			}
		}

		// ===== INSERT / UPDATE =====
		if ($permission_id == 0) {
			// Insert new permission
			$sql = "INSERT INTO mgmt_permissions(permission_name, permission_title, permission_class, permission_description) 
					VALUES ('$permission_name', '$permission_title', '$permission_class', '$permission_description')";
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
			// Update existing permission
			$sql = "UPDATE mgmt_permissions 
					SET permission_name = '$permission_name', 
						permission_title = '$permission_title', 
						permission_class = '$permission_class', 
						permission_description = '$permission_description'
					WHERE permission_id = '$permission_id'";
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
