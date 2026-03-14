<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$sql = "SELECT le.scope, le.modified_days, le.used_days, lt.default_allowed_days, lt.requires_proxy, lt.requires_attachment FROM leave_entitlements le INNER JOIN leave_types lt ON le.type_id = lt.type_id WHERE entitlement_id = '$id'";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$scope   = (int)$row['scope'];
			$modified_days = (float)$row['modified_days'];
			$used_days = (float)$row['used_days'];
			$allowed_days = (float)$row['default_allowed_days'];
			$requires_proxy = (int)$row['requires_proxy'];
			$requires_attachment = (int)$row['requires_attachment'];
			$result->free();
			echo json_encode(array(
				"scope"   => $scope,
				"modified_days"   => $modified_days,
				"used_days"   => $used_days,
				"allowed_days"   => $allowed_days,
				"requires_proxy"   => $requires_proxy,
				"requires_attachment"   => $requires_attachment
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
