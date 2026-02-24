<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

function to_mysql_date($s) {
	$s = trim((string)$s);
	if ($s === '') return null;

	if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $s)) return $s;

	$dt = DateTime::createFromFormat('F d, Y', $s); // February 13, 2026
	if ($dt instanceof DateTime) return $dt->format('Y-m-d');
	// Feb 13, 2026 (optional)
	// $dt = DateTime::createFromFormat('M d, Y', $s); 
	// if ($dt instanceof DateTime) return $dt->format('Y-m-d');

	return null;
}

if (!isset($_POST['employee'])) { echo "err"; exit; }

$emp = json_decode($_POST['employee']);
if (!$emp) { echo "err"; exit; }

// ------------------------------
// Assign + sanitize
// (NO ?? '' — relies on frontend required checks)
// ------------------------------
$employee_id   = (int)$emp->pkid;

// $employee_code = $conn->real_escape_string(trim($emp->employee_code));
// $employee_code = "TEST";
$first_name    = $conn->real_escape_string(trim($emp->first_name));
$middle_name   = $conn->real_escape_string(trim($emp->middle_name));
$last_name     = $conn->real_escape_string(trim($emp->surname)); // you use surname in UI
$suffix        = $conn->real_escape_string(trim($emp->suffix));
if($suffix == "N/A"){$suffix = NULL;}
$birth_date    = to_mysql_date($emp->birth_date);
$date_hired    = to_mysql_date($emp->date_hired);
$marital       = $conn->real_escape_string(trim($emp->marital_status));
$gender        = $conn->real_escape_string(trim($emp->gender));
$email         = $conn->real_escape_string(trim($emp->email));
$contact_no    = $conn->real_escape_string(trim($emp->contact_no));
$prov_id       = (int)$emp->prov_id;
$city_id       = (int)$emp->city_id;
$brgy_id       = (int)$emp->brgy_id;
$address_line  = $conn->real_escape_string(trim($emp->address_line));
$branch_id     = (int)$emp->branch_id;
$department_id = (int)$emp->department_id;
$role_id       = (int)$emp->role_id;
$daily_rate    = (float)$emp->daily_rate;
$sss_no        = $conn->real_escape_string(trim($emp->sss_no));
$pagibig_no    = $conn->real_escape_string(trim($emp->pagibig_no));
$tin_no        = $conn->real_escape_string(trim($emp->tin_no));
$philhealth_no = $conn->real_escape_string(trim($emp->philhealth_no));
$is_active     = (int)$emp->is_active;

// Fetch the department name and use the first 3 characters
$dept_name_sql = "SELECT department_name FROM mgmt_departments WHERE department_id = '$department_id' LIMIT 1";
$dept_name_result = $conn->query($dept_name_sql);
$department_code = '';
if ($dept_name_result && $dept_name_result->num_rows > 0) {
	$department_row = $dept_name_result->fetch_assoc();
	// Get the first 3 characters of the department name, convert to uppercase
	$department_code = strtoupper(substr($department_row['department_name'], 0, 3));
}
$hire_year = date("Y", strtotime($emp->date_hired));


// ------------------------------
// Helpers to build NULL-able SQL safely
// ------------------------------
function sql_nullable_str($conn, $s) {
	$s = trim((string)$s);
	if ($s === '') return "NULL";
	return "'" . $conn->real_escape_string($s) . "'";
}
function sql_nullable_int($n) {
	$n = (int)$n;
	return ($n > 0) ? "'$n'" : "NULL";
}
function sql_nullable_date($d) {
	return ($d && trim($d) !== '') ? "'$d'" : "NULL";
}
function sql_nullable_decimal($n) {
	return ($n > 0) ? "'" . number_format((float)$n, 2, '.', '') . "'" : "NULL";
}

// ------------------------------
// DUPLICATE CHECKS (minimal)
// - keep these to avoid duplicates even if frontend ok
// ------------------------------
if ($employee_id == 0) {
	if (trim($employee_code) !== '') {
		$ex = $conn->query("SELECT 1 FROM mgmt_employees WHERE employee_code = '$employee_code' LIMIT 1");
		if ($ex && $ex->num_rows > 0) { echo "exist_code"; exit; }
	}
	if (trim($email) !== '') {
		$ex = $conn->query("SELECT 1 FROM mgmt_employees WHERE email = '$email' LIMIT 1");
		if ($ex && $ex->num_rows > 0) { echo "exist_email"; exit; }
	}
} else {
	if (trim($employee_code) !== '') {
		$ex = $conn->query("SELECT 1 FROM mgmt_employees WHERE employee_code = '$employee_code' AND employee_id != '$employee_id' LIMIT 1");
		if ($ex && $ex->num_rows > 0) { echo "exist_code"; exit; }
	}
	if (trim($email) !== '') {
		$ex = $conn->query("SELECT 1 FROM mgmt_employees WHERE email = '$email' AND employee_id != '$employee_id' LIMIT 1");
		if ($ex && $ex->num_rows > 0) { echo "exist_email"; exit; }
	}
}

// ------------------------------
// INSERT / UPDATE EMPLOYEE
// ------------------------------
if ($employee_id == 0) {

	$sql = "INSERT INTO mgmt_employees( first_name, middle_name, surname, suffix, birth_date, marital_status, gender, email, contact_no, prov_id, city_id, brgy_id, address_line, date_hired, branch_id, department_id, role_id, daily_rate, sss_no, pagibig_no, tin_no, philhealth_no, is_active ) VALUES ( " . sql_nullable_str($conn, $first_name) . ", " . sql_nullable_str($conn, $middle_name) . ", " . sql_nullable_str($conn, $last_name) . ", " . sql_nullable_str($conn, $suffix) . ", " . sql_nullable_date($birth_date) . ", " . sql_nullable_str($conn, $marital) . ", " . sql_nullable_str($conn, $gender) . ", " . sql_nullable_str($conn, $email) . ", " . sql_nullable_str($conn, $contact_no) . ", " . sql_nullable_int($prov_id) . ", " . sql_nullable_int($city_id) . ", " . sql_nullable_int($brgy_id) . ", " . sql_nullable_str($conn, $address_line) . ", " . sql_nullable_date($date_hired) . ", '$branch_id', '$department_id', '$role_id', " . sql_nullable_decimal($daily_rate) . ", " . sql_nullable_str($conn, $sss_no) . ", " . sql_nullable_str($conn, $pagibig_no) . ", " . sql_nullable_str($conn, $tin_no) . ", " . sql_nullable_str($conn, $philhealth_no) . ", '$is_active' )";
	if ($conn->query($sql) !== TRUE) { echo "err"; exit; }
	$employee_id = (int)$conn->insert_id;

	// INSERTING FOR THE EMPLOYEE CODE
	$employee_code = $department_code . '-' . $hire_year . '-' .$employee_id;
	$emp_code_sql = "UPDATE mgmt_employees SET employee_code = '$employee_code' WHERE employee_id = '$employee_id'";
	if ($conn->query($emp_code_sql) !== TRUE) { echo "err"; exit; }


	// ------------------------------
	// Insert Leave Entitlements for Each Leave Type
	// ------------------------------
	$entitlement_sql = "SELECT type_id, gender AS genderlv, default_allowed_days FROM leave_types WHERE is_active = 1";
	$entitlement_result = $conn->query($entitlement_sql);

	if ($entitlement_result && $entitlement_result->num_rows > 0) {
		while ($row = $entitlement_result->fetch_assoc()) {
			$type_id = $row['type_id'];
			$genderlv = $row['genderlv'];  // Get the gender from the leave_types table
			$default_allowed_days = $row['default_allowed_days'];  // Get default allowed days from the leave_types table

			// Check if employee gender matches the leave type's gender
			if (($genderlv == 'All') || ($genderlv == 'Male' && $gender == 'Male') || ($genderlv == 'Female' && $gender == 'Female')) {
				// Insert entitlement record for each employee matching gender condition
				$insert_entitlement_sql = "INSERT INTO leave_entitlements (employee_id, type_id, scope, allocated_days, modified_days, used_days, created_at, updated_at) 
					VALUES ('$employee_id', '$type_id', 0, '$default_allowed_days', 0, 0, NOW(), NOW())";

				if ($conn->query($insert_entitlement_sql) !== TRUE) {
					echo "Error inserting entitlement for employee $employee_id, leave type $type_id.";
					exit;
				}
			}
		}
	}

	// ------------------------------
	// AUTO CREATE USER LOGIN (only if missing)
	// username = employee_id
	// password = md5("1")
	// ------------------------------
	$pass_md5 = sha1(md5("1")); // your chosen default
	$emp_number = str_pad($employee_id, 4, '0', STR_PAD_LEFT);
	$clean_surname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $last_name));
	$username_raw = $emp_number . $clean_surname;
	$username = $conn->real_escape_string($username_raw);

	

	// optional safety: username collision check (rare but possible if same surname + same emp_number impossible; but keep it anyway)
	$chk = $conn->query("SELECT 1 FROM mgmt_users WHERE username = '$username' LIMIT 1");
	if ($chk && $chk->num_rows > 0) { echo "err_user"; exit; }
	if ($chk) $chk->free();

	$sqlu = "INSERT INTO mgmt_users(employee_id, username, password_hash) VALUES ('$employee_id', '$username', '$pass_md5')";
	if ($conn->query($sqlu) !== TRUE) { echo "err"; exit; }

} else {
	$employee_code = $department_code . '-' . $hire_year . '-' .$employee_id;
	$sql = "UPDATE mgmt_employees SET is_active = '$is_active', date_hired = " . sql_nullable_date($date_hired) . ",  branch_id = " . sql_nullable_int($branch_id) . ", department_id = " . sql_nullable_int($department_id) . ", role_id = " . sql_nullable_int($role_id) . ", daily_rate = " . sql_nullable_decimal($daily_rate) . ", employee_code = '$employee_code', sss_no = " . sql_nullable_str($conn, $sss_no) . ", pagibig_no = " . sql_nullable_str($conn, $pagibig_no) . ", tin_no = " . sql_nullable_str($conn, $tin_no) . ", philhealth_no = " . sql_nullable_str($conn, $philhealth_no) . " WHERE employee_id = '$employee_id'";

	if ($conn->query($sql) !== TRUE) { 
		echo "err"; 
		exit; 
	}

}

echo "true";
exit;
?>
