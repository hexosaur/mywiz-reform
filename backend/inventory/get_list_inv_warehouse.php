<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT  w.warehouse_id, w.warehouse_name, w.warehouse_code, w.address_line, w.status, p.prov_name, c.city_name, b.brgy_name FROM inv_warehouses w LEFT JOIN ref_provinces p ON p.prov_id = w.prov_id LEFT JOIN ref_cities c ON c.city_id = w.city_id LEFT JOIN ref_barangays b ON b.brgy_id = w.brgy_id ORDER BY w.warehouse_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		while ($row = $result->fetch_assoc()) {

			$id     = (int)$row['warehouse_id'];
			$name   = htmlspecialchars($row['warehouse_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$code   = htmlspecialchars($row['warehouse_code'] ?? '', ENT_QUOTES, 'UTF-8');
			$prov   = htmlspecialchars($row['prov_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$city   = htmlspecialchars($row['city_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$brgy   = htmlspecialchars($row['brgy_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$addr   = htmlspecialchars($row['address_line'] ?? '', ENT_QUOTES, 'UTF-8');
			$status = (int)$row['status'] === 1
				? "<span class='badge badge-success'>Active</span>"
				: "<span class='badge badge-danger'>Inactive</span>";

			$location = trim($brgy . ", " . $city . ", " . $prov . ", " . $addr, " ,");

			$table .= "
				<tr>
					<td class='text-center align-middle'>{$n}</td>
					<td data-column='Warehouse: '><span class='f-w-600'>{$name}</span><br><small>{$code}</small></td>
					<td data-column='Location: ' class='align-middle'>{$location}</td>
					<td class='text-center align-middle' data-column='Status: '>{$status}</td>
					<td class='text-center align-middle' data-column='Action: '>
						<div class='btn btn-outline-info btn-sm btn-edit' data-id='{$id}'><span class='feather icon-edit'></span></div>
						<div class='btn btn-outline-danger btn-sm btn-del' data-id='{$id}'><span class='feather icon-trash-2'></span></div>
					</td>
				</tr>
			";
			$n++;
		}

		echo $table;
		exit;
	}
}
?>