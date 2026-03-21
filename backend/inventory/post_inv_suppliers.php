<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {
	$supplier = json_decode($_POST['data']);

	$supplier_name   = $conn->real_escape_string(trim($supplier->supplier_name));
	$contact_person  = $conn->real_escape_string(trim($supplier->contact_person));
	$contact_number  = $conn->real_escape_string(trim($supplier->contact_number));
	$email           = $conn->real_escape_string(trim($supplier->email));
	$address         = $conn->real_escape_string(trim($supplier->address));
	$tin_no          = $conn->real_escape_string(trim($supplier->tin_no));
	$status 		 = $conn->real_escape_string(trim($supplier->status));
	$supplier_id     = (int)$supplier->pkid;

	if ($supplier_name == '') {
		echo "err";
		exit;
	}

	if ($supplier_id == 0) {
		$exst_name = "SELECT 1 FROM inv_suppliers WHERE supplier_name = '$supplier_name' LIMIT 1";
		if ($conn->query($exst_name)->num_rows > 0) {
			echo "exist_name";
			exit;
		}

		$sql = "INSERT INTO inv_suppliers ( supplier_name, contact_person, contact_number, email, address, tin_no , status ) VALUES ( '$supplier_name', '$contact_person', '$contact_number', '$email', '$address', '$tin_no' , '$status' )";

		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}

	} else {
		$exst_name_update = "SELECT 1 FROM inv_suppliers WHERE supplier_name = '$supplier_name' AND supplier_id != '$supplier_id' LIMIT 1";
		if ($conn->query($exst_name_update)->num_rows > 0) {
			echo "exist_name";
			exit;
		}

		$sql = "UPDATE inv_suppliers SET supplier_name = '$supplier_name', contact_person = '$contact_person', contact_number = '$contact_number', email = '$email', address = '$address', tin_no = '$tin_no', status = '$status' WHERE supplier_id = '$supplier_id'";

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