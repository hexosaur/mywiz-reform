<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_POST['department'])) {
	echo "err";
	exit;
}

$dept = json_decode($_POST['department']);
if (!$dept) {
	echo "err";
	exit;
}

$dept_id    = (int)$dept->pkid;
$dept_name  = $conn->real_escape_string(trim($dept->dept_name));
$dept_scope = "all";

if ($dept_id == 0) {
	$exst = $conn->query("SELECT 1 FROM mgmt_departments WHERE department_name = '$dept_name' LIMIT 1");
	if ($exst && $exst->num_rows > 0) {
		echo "exist_name";
		exit;
	}

	$sql = "INSERT INTO mgmt_departments(department_name, department_scope)
			VALUES ('$dept_name', '$dept_scope')";
	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	}

	echo "err";
	exit;

} else {
	$rs = $conn->query("SELECT department_name, department_scope FROM mgmt_departments WHERE department_id = '$dept_id' LIMIT 1");
	if (!$rs || $rs->num_rows == 0) {
		echo "err";
		exit;
	}
	$old = $rs->fetch_assoc();
	$rs->free();

	// detect no-change
	$is_changed = false;
	if ((string)$old['department_name'] !== $dept_name) $is_changed = true;
	if ((string)$old['department_scope'] !== $dept_scope) $is_changed = true;

	if (!$is_changed) {
		echo "exist"; // no changes
		exit;
	}
	if ((string)$old['department_name'] !== $dept_name) {
		$exst = $conn->query("SELECT 1 FROM mgmt_departments
							WHERE department_name = '$dept_name'
							AND department_id != '$dept_id'
							LIMIT 1");
		if ($exst && $exst->num_rows > 0) {
			echo "exist_name";
			exit;
		}
	}

	$sql = "UPDATE mgmt_departments SET department_name = '$dept_name', department_scope = '$dept_scope' WHERE department_id = '$dept_id'";
	if ($conn->query($sql) === TRUE) {
		echo "true";
		exit;
	}

	echo "err";
	exit;
}
?>
