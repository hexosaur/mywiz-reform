<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT department_id, department_name FROM mgmt_departments ORDER BY department_name ASC";
	$n = 1;
	$table = "";

	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {

				$dept_id   = (int)($row['department_id'] ?? 0);
				$dept_name = htmlspecialchars($row['department_name'] ?? '', ENT_QUOTES, 'UTF-8');
				$table .= "<tr><td class='text-center'>{$n}</td><td class='text-center' data-column='Department: '>{$dept_name}</td><td class='text-center' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$dept_id}'><span class='feather icon-edit'></span></div><div class='btn btn-outline-danger btn-sm btn-del' data-id='{$dept_id}'><span class='feather icon-trash-2'></span></div></td></tr>";
				$n++;
			}
			$result->free();
		}
	}

	echo $table;
	exit;
}
?>
