<?php
session_start();
error_reporting(E_ALL);
include('../config/cfg.php');

if (!isset($_POST['data'])) { echo "err"; exit; }

$sa = json_decode($_POST['data']);
if (!$sa) { echo "err"; exit; }

$admin_id   = isset($sa->pkid) ? (int)$sa->pkid : 0;
$first_name = $conn->real_escape_string(trim($sa->first_name));
$middle_name = $conn->real_escape_string(trim($sa->middle_name));
$surname    = $conn->real_escape_string(trim($sa->surname));
$suffix     = $conn->real_escape_string(trim($sa->suffix));
$username   = $conn->real_escape_string(trim($sa->username));
$password   = $conn->real_escape_string(trim($sa->password));
$is_active  = isset($sa->is_active) ? (int)$sa->is_active : 1;


if ($suffix == "N/A" ) { $suffix = NULL; }
if ($password == "" ) { $password = 1; }
// Function to handle NULL values properly in SQL queries
function sql_nullable_str($conn, $s) {
	$s = trim((string)$s);  // Sanitize and trim spaces
	if (empty($s) || strtoupper($s) === '') {
		return "NULL";  
	}
	return "'" . $conn->real_escape_string($s) . "'";  
}

$hashed_password = sha1(md5($password));

// ------------------------------
// DUPLICATE CHECKS
// ------------------------------
if ($admin_id == 0) {
	$ex = $conn->query("SELECT 1 FROM admin_superadmin WHERE username = '$username' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_username"; exit; }
} else {
	$ex = $conn->query("SELECT 1 FROM admin_superadmin WHERE username = '$username' AND admin_id != '$admin_id' LIMIT 1");
	if ($ex && $ex->num_rows > 0) { echo "exist_username"; exit; }
}

// ------------------------------
// INSERT / UPDATE ADMIN
// ------------------------------
if ($admin_id == 0) {
	// Updated insert query for superadmin
	$sql = "INSERT INTO admin_superadmin (first_name, middle_name, surname, suffix, username, password, is_active) VALUES ('$first_name', " . sql_nullable_str($conn, $middle_name) . ", '$surname', " . sql_nullable_str($conn, $suffix) . ", '$username', '$hashed_password', '$is_active')";
	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}

	echo "true";
	exit;

} else {
	// Existing Admin: Update
	if ($password !== '') {
		$sql = "UPDATE admin_superadmin SET first_name = '$first_name', middle_name = '$middle_name', surname = '$surname', suffix = '$suffix', username = '$username', password = '$hashed_password', is_active = '$is_active' WHERE admin_id = '$admin_id'";
	} else {
		$sql = "UPDATE admin_superadmin SET  first_name = '$first_name', middle_name = '$middle_name', surname = '$surname', suffix = '$suffix', username = '$username', is_active = '$is_active' WHERE admin_id = '$admin_id'";
	}

	if ($conn->query($sql) !== TRUE) {
		echo "err";
		exit;
	}

	echo "true";
	exit;
}
?>