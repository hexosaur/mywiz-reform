<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_POST['data'])) { echo "err"; exit; }
$pcd = true;
$lt = json_decode($_POST['data']);
if (!$lt) { echo "err"; exit; }

$type_id   = isset($lt->pkid) ? (int)$lt->pkid : 0;

$type_code = $conn->real_escape_string(trim($lt->type_code));
$type_name = $conn->real_escape_string(trim($lt->type_name));
$type_desc = $conn->real_escape_string(trim($lt->type_desc));
$type_gender = $lt->type_gender;  // Gender for the leave type (All, Male, Female)
$with_pay            = (int)$lt->type_pay;
$requires_attachment = (int)$lt->type_attach;
$requires_proxy      = (int)$lt->type_proxy;
$default_days = (float)$lt->type_days;
$is_active = isset($lt->is_active) ? (int)$lt->is_active : 1;

if ($type_code === '' || $type_name === '') { echo "err"; exit; }

// ------------------------------
// DUPLICATE CHECKS
// ------------------------------
if ($type_id == 0) {
	$ex = $conn->query("SELECT 1 FROM leave_types WHERE type_code = '$type_code' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_code"; exit; }

	$ex = $conn->query("SELECT 1 FROM leave_types WHERE type_name = '$type_name' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_name"; exit; }

} else {
	$ex = $conn->query("SELECT 1 FROM leave_types WHERE type_code = '$type_code' AND type_id != '$type_id' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_code"; exit; }

	$ex = $conn->query("SELECT 1 FROM leave_types WHERE type_name = '$type_name' AND type_id != '$type_id' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_name"; exit; }
}

// ------------------------------
// INSERT / UPDATE
// ------------------------------
if ($type_id == 0) {
	// Insert the new leave type into the leave_types table
	$sql = "INSERT INTO leave_types( type_code, type_name, type_description, with_pay, requires_attachment, requires_proxy, default_allowed_days, gender, is_active ) 
			VALUES ( '$type_code', '$type_name', " . ($type_desc !== '' ? "'$type_desc'" : "NULL") . ", '$with_pay', '$requires_attachment', '$requires_proxy', '" . number_format($default_days, 2, '.', '') . "', '$type_gender', '$is_active' )";
	if ($conn->query($sql) !== TRUE) { echo "err"; exit; }
	$new_type_id = $conn->insert_id;

	// ------------------------------
	// Insert Leave Entitlements for Each Employee Based on Gender
	// ------------------------------
	// Fetch all active employees
	$employee_sql = "SELECT employee_id, gender AS gender_emp FROM mgmt_employees WHERE is_active = 1";
	$employee_result = $conn->query($employee_sql);

	if ($employee_result && $employee_result->num_rows > 0) {
		while ($employee = $employee_result->fetch_assoc()) {
			$employee_id = $employee['employee_id'];
			$employee_gender = $employee['gender_emp'];  // Employee gender

			// Gender matching logic
			if ($type_gender == 'All' || ($type_gender == 'Male' && $employee_gender == 'Male') || ($type_gender == 'Female' && $employee_gender == 'Female')) {
				// Insert entitlement for the employee
				$insert_entitlement_sql = " INSERT INTO leave_entitlements (employee_id, type_id, scope, allocated_days, modified_days, used_days, created_at, updated_at) VALUES ('$employee_id', '$new_type_id', 0, '$default_days', 0, 0, NOW(), NOW())";

				if ($conn->query($insert_entitlement_sql) !== TRUE) {
					echo "Error inserting entitlement for employee $employee_id.";
					exit;
				}
			}
		}
	}

	echo "true";
	exit;

} else {
	// Update existing leave type
	$sql = "UPDATE leave_types SET type_code = '$type_code', type_name = '$type_name', type_description = " . ($type_desc !== '' ? "'$type_desc'" : "NULL") . ", with_pay = '$with_pay', requires_attachment = '$requires_attachment', requires_proxy = '$requires_proxy', default_allowed_days = '" . number_format($default_days, 2, '.', '') . "', gender = '$type_gender', is_active = '$is_active' WHERE type_id = '$type_id'";
	if ($conn->query($sql) !== TRUE) { echo "err"; exit; }

	// Optionally, you could add logic to update existing entitlements if needed

	echo "true";
	exit;
}
?>
