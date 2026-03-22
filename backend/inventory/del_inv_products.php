<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
	$pkid = (int)$_GET['id'];

	$q = "SELECT image FROM inv_products WHERE product_id = '$pkid' LIMIT 1";
	$r = $conn->query($q);

	if ($r && $r->num_rows > 0) {
		$row = $r->fetch_assoc();
		$img = $row['image'] ?? '';

		if ($img != '') {
			$full = "../../" . $img;
			if (file_exists($full)) {
				@unlink($full);
			}
		}
	}

	$sql = "DELETE FROM inv_products WHERE product_id = '$pkid'";

	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	} else {
		echo "err";
		exit;
	}
}
?>