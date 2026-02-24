<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_GET['security']) || $_GET['security'] !== '123465') {
	exit;
}

$sql = "SELECT type_id, type_name, type_code, type_description, default_allowed_days, with_pay, requires_attachment, requires_proxy, is_active FROM leave_types ORDER BY type_name ASC";
$n = 1;
$table = "";
if ($result = $conn->query($sql)) {
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {

			$type_id   = (int)$row['type_id'];
			$code      = htmlspecialchars($row['type_code'] ?? '', ENT_QUOTES, 'UTF-8');
			$name      = htmlspecialchars($row['type_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$desc_main = htmlspecialchars($row['type_description'] ?? '', ENT_QUOTES, 'UTF-8');
			$days = htmlspecialchars((string)($row['default_allowed_days'] ?? '0'), ENT_QUOTES, 'UTF-8');
			$with_pay = ((int)$row['with_pay'] === 1);
			$req_att  = ((int)$row['requires_attachment'] === 1);
			$req_prx  = ((int)$row['requires_proxy'] === 1);

			// merged description parts
			$pay_txt  = $with_pay ? "With Pay" : "Without Pay";
			$att_txt  = $req_att ? "Attachment Required" : "No Attachment";
			$prx_txt  = $req_prx ? "Proxy Required" : "No Proxy";

			// If you want it cleaner, keep main desc first (if any), then the flags
			$merged_desc = "";
			if (trim($desc_main) !== "") {
				$merged_desc .= "{$desc_main} • ";
			}
			$merged_desc .= "{$pay_txt} • {$att_txt} • {$prx_txt}";
			$type_label = $with_pay ? "Paid" : "Unpaid";

			// Status badge
			$is_active = ((int)$row['is_active'] === 1);
			$status_badge = $is_active ? "<span class='badge badge-pill badge-success'>Active</span>" : "<span class='badge badge-pill badge-danger'>Inactive</span>";

			$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Code: '>{$code}</td><td class='text-center' data-column='Name: '>{$name}</td><td class='text-center' data-column='Description: '>{$merged_desc}</td><td class='text-center' data-column='Days: '>{$days}</td><td class='text-center' data-column='Type: '>{$type_label}</td><td class='text-center' data-column='Status: '>{$status_badge}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$type_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$type_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
			$n++;
		}
		$result->free();
	}
}

echo $table;
exit;
?>
