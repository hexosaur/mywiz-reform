<?php
session_start();
error_reporting(E_ALL);
include('../config/cfg.php');

if (!isset($_POST['role'])) {
	echo "err";
	exit;
}

$role = json_decode($_POST['role']);

$role_name  = $conn->real_escape_string($role->role_name ?? '');
$role_desc  = $conn->real_escape_string($role->role_desc ?? '');
$dept_id    = (int)($role->role_dept ?? 0);
$access_lvl = (int)($role->role_access ?? 0);
$role_id    = (int)($role->pkid ?? 0);

// role_perms can be missing / null
$role_perms = [];
if (isset($role->role_perms) && is_array($role->role_perms)) {
	$role_perms = $role->role_perms;
}

// basic required
if (trim($role_name) === '' || $dept_id <= 0) {
	echo "err";
	exit;
}

// ===========================
// INSERT: duplicate check
// ===========================
if ($role_id == 0) {
	$exst_name = "SELECT 1 FROM mgmt_roles WHERE role_name = '$role_name' LIMIT 1";
	if ($conn->query($exst_name)->num_rows > 0) {
		echo "exist_name";
		exit;
	}
} else {
	// ===========================
	// UPDATE: check if changed
	// ===========================
	$sql_check = "SELECT role_name, role_description, department_id, access_level FROM mgmt_roles WHERE role_id = '$role_id'";
	$result = $conn->query($sql_check);

	if (!$result || $result->num_rows == 0) {
		echo "err";
		exit;
	}

	$row = $result->fetch_assoc();

	$is_changed = false;
	$name_changed = (($row['role_name'] ?? '') !== $role_name);
	if ($name_changed) $is_changed = true;

	if (($row['role_description'] ?? '') !== $role_desc) $is_changed = true;
	if ((int)($row['department_id'] ?? 0) !== $dept_id) $is_changed = true;
	if ((int)($row['access_level'] ?? 0) !== $access_lvl) $is_changed = true;

	// permission changes
	$existing = [];
	$rs = $conn->query("SELECT permission_id FROM mgmt_role_permissions WHERE role_id = '$role_id'");
	if ($rs) {
		while ($r = $rs->fetch_assoc()) $existing[] = (string)$r['permission_id'];
		$rs->free();
	}

	$new = array_map('strval', $role_perms);
	sort($existing);
	sort($new);
	if ($existing !== $new) $is_changed = true;

	if (!$is_changed) {
		echo "exist"; // no changes
		exit;
	}

	// only check duplicate name if name changed
	if ($name_changed) {
		$exst_name_update = "SELECT 1 FROM mgmt_roles
							WHERE role_name = '$role_name'
							AND role_id != '$role_id'
							LIMIT 1";
		if ($conn->query($exst_name_update)->num_rows > 0) {
			echo "exist_name";
			exit;
		}
	}
}

// ===========================
// INSERT / UPDATE role FIRST
// ===========================
if ($role_id == 0) {
	$sql = "INSERT INTO mgmt_roles(role_name, role_description, department_id, access_level)
			VALUES ('$role_name', '$role_desc', '$dept_id', '$access_lvl')";
	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}
	$role_id = (int)$conn->insert_id; // ✅ now role_id exists
} else {
	$sql = "UPDATE mgmt_roles
			SET role_name = '$role_name',
				role_description = '$role_desc',
				department_id = '$dept_id',
				access_level = '$access_lvl'
			WHERE role_id = '$role_id'";
	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}
}

// ===========================
// SAVE ROLE PERMISSIONS (pivot)
// ===========================
$conn->query("DELETE FROM mgmt_role_permissions WHERE role_id = '$role_id'");

if (!empty($role_perms)) {
	foreach ($role_perms as $pid) {
		$pid = (int)$pid;
		if ($pid <= 0) continue;
		$sql = "INSERT INTO mgmt_role_permissions(role_id, permission_id)
				VALUES ('$role_id', '$pid')";
		if ($conn->query($sql) !== TRUE) {
			echo "err";
			exit;
		}
	}
}

echo "true";
exit;
?>
