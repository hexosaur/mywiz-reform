<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$sql = "SELECT role_name, role_description, department_id, access_level_id FROM mgmt_roles WHERE role_id = '$id'";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$role_name   = $row['role_name'];
			$role_desc   = $row['role_description'];
			$role_dept   = $row['department_id'];
			$role_access = $row['access_level_id'];
			$result->free();
			$role_perms = array();
			$sql2 = "SELECT permission_id FROM mgmt_role_permissions WHERE role_id = '$id'";
			if ($res2 = $conn->query($sql2)) {
				while ($r2 = $res2->fetch_assoc()) {
					$role_perms[] = $r2['permission_id']; // push permission_id
				}
				$res2->free();
			}
			echo json_encode(array(
				"role_name"   => $role_name,
				"role_desc"   => $role_desc,
				"role_dept"   => $role_dept,
				"role_access" => $role_access,
				"role_perms"  => $role_perms
			));
			exit;

		} else {
			echo json_encode(array("status" => "error", "message" => "No data found for the given role ID."));
			exit;
		}
	} else {
		echo json_encode(array("status" => "error", "message" => "Error executing the query."));
		exit;
	}
}

echo json_encode(array("status" => "error", "message" => "Invalid request."));
exit;
?>
