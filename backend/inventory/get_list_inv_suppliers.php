<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT supplier_id, supplier_name, contact_person, contact_number, email, status FROM inv_suppliers ORDER BY supplier_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		while ($row = $result->fetch_assoc()) {
			$supplier_id    = (int)$row['supplier_id'];
			$supplier_name  = htmlspecialchars($row['supplier_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$contact_person = htmlspecialchars($row['contact_person'] ?? '', ENT_QUOTES, 'UTF-8');
			$contact_number = htmlspecialchars($row['contact_number'] ?? '', ENT_QUOTES, 'UTF-8');
			$email = htmlspecialchars((isset($row['email']) && trim($row['email']) !== '') ? $row['email'] : 'N/A', ENT_QUOTES, 'UTF-8');
			$status_badge   = (isset($row['status']) && (int)$row['status'] === 1)
				? "<span class='badge badge-success'>Active</span>"
				: "<span class='badge badge-danger'>Inactive</span>";
			$table .= "<tr><td class='text-center align-middle'>{$n}</td><td class='align-middle' data-column='Supplier: '>{$supplier_name}</td><td class='align-middle' data-column='Contact Person: '>{$contact_person}</td><td class='align-middle' data-column='Contact Number: '>{$contact_number}</td><td class='align-middle' data-column='Email: '>{$email}</td><td class='text-center align-middle' data-column='Status: '>{$status_badge}</td><td class='align-middle text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$supplier_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$supplier_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
			$n++;
		}
		$result->free();
		
	}

	echo $table;
	exit;
}
?>