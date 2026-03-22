<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

	$id = (int)$_GET['id'];

	$sql = "SELECT 
				p.product_id,
				p.sku,
				p.product_name,
				p.category_id,
				p.base_unit_id,
				p.brand_id,
				p.image,
				p.is_serialized,
				p.reorder_level,
				p.markup,
				p.description,
				p.status,

				c.category_name,
				u.unit_name,
				b.brand_name,

				s.supplier_id,
				s.supplier_name

			FROM inv_products p

			LEFT JOIN inv_categories c ON c.category_id = p.category_id
			LEFT JOIN inv_units u ON u.unit_id = p.base_unit_id
			LEFT JOIN inv_brands b ON b.brand_id = p.brand_id

			LEFT JOIN inv_product_suppliers ps 
				ON ps.product_id = p.product_id AND ps.is_default = 1
			LEFT JOIN inv_suppliers s 
				ON s.supplier_id = ps.supplier_id

			WHERE p.product_id = '$id'
			LIMIT 1";

	$result = $conn->query($sql);

	if ($result && $result->num_rows > 0) {

		$row = $result->fetch_assoc();

		// ALSO GET ALL SUPPLIERS (for multi-select edit)
		$suppliers = [];
		$q = "SELECT supplier_id FROM inv_product_suppliers WHERE product_id = '$id'";
		$r = $conn->query($q);
		if ($r) {
			while ($rs = $r->fetch_assoc()) {
				$suppliers[] = (int)$rs['supplier_id'];
			}
		}

		echo json_encode([
			"product_id" => (int)$row['product_id'],
			"sku" => $row['sku'] ?? '',
			"product_name" => $row['product_name'] ?? '',
			"category_id" => (int)$row['category_id'],
			"category_name" => $row['category_name'] ?? '',
			"base_unit_id" => (int)$row['base_unit_id'],
			"unit_name" => $row['unit_name'] ?? '',
			"brand_id" => !is_null($row['brand_id']) ? (int)$row['brand_id'] : 0,
			"brand_name" => $row['brand_name'] ?? '',
			"image" => $row['image'] ?? '',
			"serialized" => (int)$row['is_serialized'],
			"reorder_level" => $row['reorder_level'] ?? '0.00',
			"markup" => $row['markup'] ?? '0.00',
			"description" => $row['description'] ?? '',
			"supplier_id" => !is_null($row['supplier_id']) ? (int)$row['supplier_id'] : 0,
			"supplier_ids" => $suppliers,
			"status" => !is_null($row['status']) ? (int)$row['status'] : 0
		]);

		exit;
	}

	echo json_encode(["status" => "error"]);
	exit;
}
?>