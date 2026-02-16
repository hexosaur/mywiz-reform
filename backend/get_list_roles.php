<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {

	$sql = "SELECT r.role_id, r.role_name, r.role_description, al.access_level_name, d.department_name, COALESCE(GROUP_CONCAT(p.permission_title ORDER BY p.permission_title SEPARATOR ', '), '') AS perms FROM mgmt_roles r LEFT JOIN ref_access_levels al ON r.access_level_id = al.access_level_id LEFT JOIN mgmt_departments d ON d.department_id = r.department_id LEFT JOIN mgmt_role_permissions rp ON rp.role_id = r.role_id LEFT JOIN mgmt_permissions p ON p.permission_id = rp.permission_id GROUP BY r.role_id, r.role_name, r.role_description, al.access_level_name, d.department_name ORDER BY r.role_name ASC";

	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {

				$role_id   = (int)($row['role_id'] ?? 0);
				$role_name = htmlspecialchars($row['role_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$role_desc = htmlspecialchars($row['role_description'] ?? '', ENT_QUOTES, 'UTF-8');
				$dept_name = htmlspecialchars($row['department_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$access    = htmlspecialchars($row['access_level_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$perms     = htmlspecialchars($row['perms'] ?? '', ENT_QUOTES, 'UTF-8');

				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Role: '>{$role_name}</td><td class='text-center' data-column='Department: '>{$dept_name}</td><td class='text-center' data-column='Access: '>{$access}</td><td class='text-center' data-column='Permissions: '>{$perms}</td><td class='text-center' data-column='Description: '>{$role_desc}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$role_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$role_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}

	echo $table;
	exit;
}
?>
