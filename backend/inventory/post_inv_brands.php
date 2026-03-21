<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {
	$brand = json_decode($_POST['data']);

	$brand_name  = $conn->real_escape_string(trim($brand->brand_name ?? ''));
	$description = $conn->real_escape_string(trim($brand->description ?? ''));
	$brand_id    = (int)($brand->pkid ?? 0);

	if ($brand_name == '') {
		echo "err";
		exit;
	}

	// ===== CHECK EXISTENCE =====
	if ($brand_id == 0) {
		$exst = "SELECT 1 FROM inv_brands WHERE brand_name = '$brand_name' LIMIT 1";
		$res = $conn->query($exst);
		if ($res && $res->num_rows > 0) {
			echo "exist";
			exit;
		}

		// ===== INSERT =====
		$sql = "INSERT INTO inv_brands (brand_name, description)
				VALUES ('$brand_name', '$description')";

		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}

	} else {
		$exst_update = "SELECT 1 FROM inv_brands WHERE brand_name = '$brand_name' AND brand_id != '$brand_id' LIMIT 1";
		$res = $conn->query($exst_update);
		if ($res && $res->num_rows > 0) {
			echo "exist";
			exit;
		}

		// ===== UPDATE =====
		$sql = "UPDATE inv_brands
				SET brand_name = '$brand_name',
					description = '$description'
				WHERE brand_id = '$brand_id'";

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