<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {
	$category = json_decode($_POST['data']);
	$category_name = $conn->real_escape_string(trim($category->category));
	$category_id   = (int)$category->pkid;
	if ($category_name == '') {
		echo "err";
		exit;
	}
	// CHECK DUPLICATE
	if ($category_id == 0) {
		$exst_name = "SELECT 1 FROM inv_categories WHERE category_name = '$category_name' LIMIT 1";
		$res = $conn->query($exst_name);
		if ($res && $res->num_rows > 0) {
			echo "exist_name";
			exit;
		}
		$sql = "INSERT INTO inv_categories(category_name) VALUES ('$category_name')";
		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			echo "err";
			exit;
		}

	} else {
		$exst_name_update = "SELECT 1 FROM inv_categories WHERE category_name = '$category_name' AND category_id != '$category_id' LIMIT 1";
		$res = $conn->query($exst_name_update);
		if ($res && $res->num_rows > 0) {
			echo "exist_name";
			exit;
		}

		$sql = "UPDATE inv_categories SET category_name = '$category_name' WHERE category_id = '$category_id'";
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