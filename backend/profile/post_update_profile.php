<?php
session_start();
include('../../config/cfg.php');

if(!isset($_SESSION['login'])){
	echo "session_expired";
	exit;
}

$employee_id = (int)$_SESSION['login'];

/* =========================
GET JSON DATA
========================= */

if(!isset($_POST['data'])){
	echo "invalid_request";
	exit;
}

$data = json_decode($_POST['data'], true);

$username       = trim($data['username']);
$password       = trim($data['password']);

$prov_id        = $data['prov_id'];
$city_id        = $data['city_id'];
$brgy_id        = $data['brgy_id'];
$address_line   = trim($data['address_line']);

$first_name     = trim($data['first_name']);
$middle_name    = trim($data['middle_name']);
$surname        = trim($data['surname']);
$suffix         = trim($data['suffix']);

$birth_date     = $data['birth_date'];
$marital_status = $data['marital_status'];
$gender         = $data['gender'];

$email          = trim($data['email']);
$contact_no     = trim($data['contact_no']);

$sss_no         = trim($data['sss_no']);
$pagibig_no     = trim($data['pagibig_no']);
$tin_no         = trim($data['tin_no']);
$philhealth_no  = trim($data['philhealth_no']);


/* =========================
CHECK DUPLICATE USERNAME
========================= */

if($username != ''){
	$username_safe = $conn->real_escape_string($username);
	$check_user = $conn->query(" SELECT user_id  FROM mgmt_users WHERE username = '$username_safe' AND employee_id != '$employee_id' LIMIT 1 ");
	if($check_user && $check_user->num_rows > 0){
		echo "username_exist";
		exit;
	}
}


/* =========================
CHECK DUPLICATE EMAIL
========================= */

if($email != ''){
	$email_safe = $conn->real_escape_string($email);
	$check_email = $conn->query(" SELECT employee_id  FROM mgmt_employees WHERE email = '$email_safe' AND employee_id != '$employee_id' LIMIT 1 ");
	if($check_email && $check_email->num_rows > 0){
		echo "email_exist";
		exit;
	}

}


/* =========================
IMAGE UPLOAD
========================= */

$profile_photo = null;

if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0){
	$target_dir = "../uploads/profile/";
	$ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
	$filename = "emp_".$employee_id."_".time().".".$ext;
	if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_dir.$filename)){
		$profile_photo = $filename;
	}
}


/* =========================
BUILD UPDATE QUERIES
========================= */

$conn->begin_transaction();

try{

	/* ================= USER TABLE ================= */
	$update_user = [];
	if($username != ''){ $update_user[] = "username='".$conn->real_escape_string($username)."'"; }
	if($password != ''){ $hash = password_hash($password, PASSWORD_DEFAULT); $update_user[] = "password_hash='".$hash."'"; }
	if($profile_photo){ $update_user[] = "profile_photo='".$profile_photo."'"; }
	if(count($update_user) > 0){
		$sql_user = "UPDATE mgmt_users SET ".implode(",", $update_user)." WHERE employee_id='$employee_id'";
		$conn->query($sql_user);
	}


	/* ================= EMPLOYEE TABLE ================= */

	$update_emp = [];

	if($first_name != '') $update_emp[] = "first_name='".$conn->real_escape_string($first_name)."'";
	if($middle_name != '') $update_emp[] = "middle_name='".$conn->real_escape_string($middle_name)."'";
	if($surname != '') $update_emp[] = "surname='".$conn->real_escape_string($surname)."'";
	if($suffix != '' && $suffix != "N/A")
		$update_emp[] = "suffix='".$conn->real_escape_string($suffix)."'";

	if($birth_date != '') $update_emp[] = "birth_date='".$birth_date."'";
	if($marital_status != '') $update_emp[] = "marital_status='".$marital_status."'";
	if($gender != '') $update_emp[] = "gender='".$gender."'";

	if($email != '') $update_emp[] = "email='".$conn->real_escape_string($email)."'";
	if($contact_no != '') $update_emp[] = "contact_no='".$conn->real_escape_string($contact_no)."'";

	if($prov_id != '') $update_emp[] = "prov_id='".$prov_id."'";
	if($city_id != '') $update_emp[] = "city_id='".$city_id."'";
	if($brgy_id != '') $update_emp[] = "brgy_id='".$brgy_id."'";
	if($address_line != '') $update_emp[] = "address_line='".$conn->real_escape_string($address_line)."'";

	if($sss_no != '') $update_emp[] = "sss_no='".$sss_no."'";
	if($pagibig_no != '') $update_emp[] = "pagibig_no='".$pagibig_no."'";
	if($tin_no != '') $update_emp[] = "tin_no='".$tin_no."'";
	if($philhealth_no != '') $update_emp[] = "philhealth_no='".$philhealth_no."'";

	if(count($update_emp) > 0){

		$sql_emp = "UPDATE mgmt_employees SET ".implode(",", $update_emp)." WHERE employee_id='$employee_id'";

		$conn->query($sql_emp);
	}


	$conn->commit();

	echo "success";

}catch(Exception $e){

	$conn->rollback();
	echo "error";

}
?>