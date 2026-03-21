<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$id = (int)$_GET['id'];

	$sql = "SELECT  w.warehouse_id, w.warehouse_name, w.warehouse_code, w.prov_id, w.city_id, w.brgy_id, w.address_line, w.status, p.prov_name, c.city_name, b.brgy_name FROM inv_warehouses w LEFT JOIN ref_provinces p ON p.prov_id = w.prov_id LEFT JOIN ref_cities c ON c.city_id = w.city_id LEFT JOIN ref_barangays b ON b.brgy_id = w.brgy_id WHERE w.warehouse_id = '$id' LIMIT 1";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			echo json_encode(array(
				"warehouse_id"   => (int)$row['warehouse_id'],
				"warehouse_name" => $row['warehouse_name'] ?? '',
				"warehouse_code" => $row['warehouse_code'] ?? '',
				"prov_id"        => (int)$row['prov_id'],
				"prov_name"      => $row['prov_name'] ?? '',
				"city_id"        => (int)$row['city_id'],
				"city_name"      => $row['city_name'] ?? '',
				"brgy_id"        => !is_null($row['brgy_id']) ? (int)$row['brgy_id'] : 0,
				"brgy_name"      => $row['brgy_name'] ?? '',
				"address_line"   => $row['address_line'] ?? '',
				"status"         => (int)$row['status']
			));
			exit;
		}
	}

	echo json_encode(array("status" => "error", "message" => "No data found."));
	exit;
}
?>