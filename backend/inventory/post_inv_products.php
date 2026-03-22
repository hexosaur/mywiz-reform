<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (!isset($_POST['data'])) {
	echo "err";
	exit;
}

$product = json_decode($_POST['data']);

$product_name   = $conn->real_escape_string(trim($product->product_name ?? ''));
$category_id    = (int)($product->category_id ?? 0);
$base_unit_id   = (int)($product->base_unit_id ?? 0);
$brand_id       = isset($product->brand_id) && $product->brand_id !== '' ? (int)$product->brand_id : "NULL";
$markup_percent = (float)($product->markup_percent ?? 0);
$reorder_level  = (float)($product->reorder_level ?? 0);
$description    = $conn->real_escape_string(trim($product->description ?? ''));
$serialized     = isset($product->serialized) ? (int)$product->serialized : 0;
$fileSize       = (int)($product->fileSize ?? 2);
$status     = (int)($product->status ?? 1);
$product_id     = (int)($product->pkid ?? 0);

// multiple suppliers
$supplier_ids = [];
if (isset($product->supplier_id) && is_array($product->supplier_id)) {
	$supplier_ids = $product->supplier_id;
}

if ($product_name == '' || $category_id <= 0 || $base_unit_id <= 0) {
	echo "err";
	exit;
}

// ===========================
// CHECK PRODUCT NAME
// ===========================
if ($product_id == 0) {
	$exst_name = "SELECT 1 FROM inv_products WHERE product_name = '$product_name' LIMIT 1";
	if ($conn->query($exst_name)->num_rows > 0) {
		echo "exist_name";
		exit;
	}
} else {
	$sql_check = "SELECT product_name, category_id, base_unit_id, brand_id, is_serialized, reorder_level, markup, description FROM inv_products WHERE product_id = '$product_id'";
	$result = $conn->query($sql_check);

	if (!$result || $result->num_rows == 0) {
		echo "err";
		exit;
	}

	$row = $result->fetch_assoc();

	$is_changed = false;
	$name_changed = (($row['product_name'] ?? '') !== $product_name);
	if ($name_changed) $is_changed = true;

	if ((int)($row['category_id'] ?? 0) !== $category_id) $is_changed = true;
	if ((int)($row['base_unit_id'] ?? 0) !== $base_unit_id) $is_changed = true;
	if ((string)($row['brand_id'] ?? '') !== (string)($brand_id === "NULL" ? '' : $brand_id)) $is_changed = true;
	if ((int)($row['is_serialized'] ?? 0) !== $serialized) $is_changed = true;
	if ((float)($row['reorder_level'] ?? 0) != $reorder_level) $is_changed = true;
	if ((float)($row['markup_percent'] ?? 0) != $markup_percent) $is_changed = true;
	if (($row['description'] ?? '') !== $description) $is_changed = true;

	// supplier pivot changes
	$existing_suppliers = [];
	$rs = $conn->query("SELECT supplier_id FROM inv_product_suppliers WHERE product_id = '$product_id'");
	if ($rs) {
		while ($r = $rs->fetch_assoc()) $existing_suppliers[] = (string)$r['supplier_id'];
		$rs->free();
	}

	$new_suppliers = array_map('strval', $supplier_ids);
	sort($existing_suppliers);
	sort($new_suppliers);
	if ($existing_suppliers !== $new_suppliers) $is_changed = true;

	// if new image uploaded, consider changed
	if (isset($_FILES['fileupload']) && $_FILES['fileupload']['error'] !== UPLOAD_ERR_NO_FILE) {
		$is_changed = true;
	}

	if (!$is_changed) {
		echo "exist";
		exit;
	}

	if ($name_changed) {
		$exst_name_update = "SELECT 1 FROM inv_products WHERE product_name = '$product_name' AND product_id != '$product_id' LIMIT 1";
		if ($conn->query($exst_name_update)->num_rows > 0) {
			echo "exist_name";
			exit;
		}
	}
}

// ===========================
// GET CATEGORY CODE
// ===========================
$sql_cat = "SELECT category_code FROM inv_categories WHERE category_id = '$category_id' LIMIT 1";
$res_cat = $conn->query($sql_cat);

if (!$res_cat || $res_cat->num_rows == 0) {
	echo "invalid_category";
	exit;
}

$row_cat = $res_cat->fetch_assoc();
$category_code = strtoupper(trim($row_cat['category_code'] ?? ''));

if ($category_code == '') {
	echo "invalid_category_code";
	exit;
}

// ===========================
// AUTO GENERATE SKU (NEW ONLY)
// ===========================
$sku = '';

if ($product_id == 0) {
	$prefix = "WIZ";
	$sku_like = $prefix . $category_code . '%';

	$sql_last = "SELECT sku
				 FROM inv_products
				 WHERE sku LIKE '$sku_like'
				 ORDER BY product_id DESC
				 LIMIT 1";
	$res_last = $conn->query($sql_last);

	$next_num = 1;

	if ($res_last && $res_last->num_rows > 0) {
		$row_last = $res_last->fetch_assoc();
		$last_sku = $row_last['sku'] ?? '';
		$last_num = (int)substr($last_sku, strlen($prefix . $category_code));
		$next_num = $last_num + 1;
	}

	$sku = $prefix . $category_code . str_pad($next_num, 4, '0', STR_PAD_LEFT);

	$chk_sku = "SELECT 1 FROM inv_products WHERE sku = '$sku' LIMIT 1";
	if ($conn->query($chk_sku)->num_rows > 0) {
		echo "exist_code";
		exit;
	}
}

// ===========================
// OPTIONAL IMAGE UPLOAD
// ===========================
$db_image_path = "";

if (isset($_FILES['fileupload']) && $_FILES['fileupload']['error'] !== UPLOAD_ERR_NO_FILE) {

	if ($_FILES['fileupload']['error'] !== UPLOAD_ERR_OK) {
		echo "file_error";
		exit;
	}

	$maxSize = $fileSize * 1024 * 1024;
	if ($_FILES['fileupload']['size'] > $maxSize) {
		echo "file_exceed";
		exit;
	}

	$file_name = $_FILES['fileupload']['name'];
	$file_tmp  = $_FILES['fileupload']['tmp_name'];
	$file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

	$allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
	if (!in_array($file_ext, $allowed_ext)) {
		echo "file_invalid";
		exit;
	}

	$upload_dir = "../../uploads/products/";
	if (!is_dir($upload_dir)) {
		mkdir($upload_dir, 0777, true);
	}

	$new_file_name = 'prod_' . time() . '_' . mt_rand(1000, 9999) . '.' . $file_ext;
	$target_file = $upload_dir . $new_file_name;

	if (!move_uploaded_file($file_tmp, $target_file)) {
		echo "file_upload_fail";
		exit;
	}

	$db_image_path = "uploads/products/" . $new_file_name;
}

// ===========================
// INSERT / UPDATE PRODUCT
// ===========================
if ($product_id == 0) {
	$sql = "INSERT INTO inv_products ( sku, product_name, category_id, base_unit_id, brand_id, image, is_serialized, reorder_level, markup, description ) VALUES ( '$sku', '$product_name', '$category_id', '$base_unit_id', $brand_id, " . ($db_image_path != '' ? "'" . $conn->real_escape_string($db_image_path) . "'" : "NULL") . ", '$serialized', '$reorder_level', '$markup_percent', '$description' )";
	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}
	
	$product_id = (int)$conn->insert_id;
	
} else {
	// delete old image if replaced
	if ($db_image_path != '') {
		$q_old = "SELECT image FROM inv_products WHERE product_id = '$product_id' LIMIT 1";
		$r_old = $conn->query($q_old);

		if ($r_old && $r_old->num_rows > 0) {
			$row_old = $r_old->fetch_assoc();
			$old_img = $row_old['image'] ?? '';

			if ($old_img != '') {
				$old_full = "../../" . $old_img;
				if (file_exists($old_full)) {
					@unlink($old_full);
				}
			}
		}
	}

	$sql = "UPDATE inv_products SET product_name = '$product_name', category_id = '$category_id', base_unit_id = '$base_unit_id', brand_id = $brand_id, is_serialized = '$serialized', reorder_level = '$reorder_level', markup = '$markup_percent', description = '$description', status = '$status'";

	if ($db_image_path != '') {
		$sql .= ", image = '" . $conn->real_escape_string($db_image_path) . "'";
	}

	$sql .= " WHERE product_id = '$product_id'";

	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}
}

// ===========================
// SAVE PRODUCT SUPPLIERS (pivot)
// ===========================
$conn->query("DELETE FROM inv_product_suppliers WHERE product_id = '$product_id'");

if (!empty($supplier_ids)) {
	$first = true;
	foreach ($supplier_ids as $sid) {
		$sid = (int)$sid;
		if ($sid <= 0) continue;

		$is_default = $first ? 1 : 0;
		$sql_sup = "INSERT INTO inv_product_suppliers(product_id, supplier_id, is_default)
					VALUES ('$product_id', '$sid', '$is_default')";
		if ($conn->query($sql_sup) !== TRUE) {
			echo "err";
			exit;
		}

		$first = false;
	}
}

echo "true";
exit;
?>