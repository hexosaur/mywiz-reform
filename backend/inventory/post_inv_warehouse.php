<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {
	$warehouse = json_decode($_POST['data']);

	$warehouse_name = $conn->real_escape_string(trim($warehouse->warehouse_name ?? ''));
	$warehouse_code = $conn->real_escape_string(trim($warehouse->warehouse_code ?? ''));
	$prov_id        = (int)($warehouse->prov_id ?? 0);
	$city_id        = (int)($warehouse->city_id ?? 0);
	$brgy_id        = isset($warehouse->brgy_id) && $warehouse->brgy_id !== '' ? (int)$warehouse->brgy_id : "NULL";
	$address_line   = $conn->real_escape_string(trim($warehouse->address_line ?? ''));
	$status         = isset($warehouse->status) ? (int)$warehouse->status : 1;
	$warehouse_id   = (int)($warehouse->pkid ?? 0);

	if ($warehouse_name == '' || $warehouse_code == '' || $prov_id <= 0 || $city_id <= 0) {
		echo "err";
		exit;
	}

	// check duplicate name
	if ($warehouse_id == 0) {
		$sql_name = "SELECT 1 FROM inv_warehouses WHERE warehouse_name = '$warehouse_name' LIMIT 1";
		$res_name = $conn->query($sql_name);
		if ($res_name && $res_name->num_rows > 0) {
			echo "exist_name";
			exit;
		}

		$sql_code = "SELECT 1 FROM inv_warehouses WHERE warehouse_code = '$warehouse_code' LIMIT 1";
		$res_code = $conn->query($sql_code);
		if ($res_code && $res_code->num_rows > 0) {
			echo "exist_code";
			exit;
		}

		$sql = "INSERT INTO inv_warehouses ( warehouse_name, warehouse_code, prov_id, city_id, brgy_id, address_line, status ) VALUES ( '$warehouse_name', '$warehouse_code', '$prov_id', '$city_id', " . ($brgy_id === "NULL" ? "NULL" : "'$brgy_id'") . ", '$address_line', '$status' )";

		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}

	} else {
		$sql_name = "SELECT 1 FROM inv_warehouses WHERE warehouse_name = '$warehouse_name' AND warehouse_id != '$warehouse_id' LIMIT 1";
		$res_name = $conn->query($sql_name);
		if ($res_name && $res_name->num_rows > 0) {
			echo "exist_name";
			exit;
		}

		$sql_code = "SELECT 1 FROM inv_warehouses WHERE warehouse_code = '$warehouse_code' AND warehouse_id != '$warehouse_id' LIMIT 1";
		$res_code = $conn->query($sql_code);
		if ($res_code && $res_code->num_rows > 0) {
			echo "exist_code";
			exit;
		}

		$sql = "UPDATE inv_warehouses SET warehouse_name = '$warehouse_name', warehouse_code = '$warehouse_code', prov_id = '$prov_id', city_id = '$city_id', brgy_id = " . ($brgy_id === "NULL" ? "NULL" : "'$brgy_id'") . ", address_line = '$address_line', status = '$status' WHERE warehouse_id = '$warehouse_id'";

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