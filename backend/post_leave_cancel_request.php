<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (!isset($_POST['id'])) {
	echo "err";
	exit;
}

$request_id = (int)$_POST['id'];
$employee_id = isset($_SESSION['login']) ? (int)$_SESSION['login'] : 0;

$conn->begin_transaction();

try {
	$sql_req = " SELECT request_id, entitlement_id, requested_days, status FROM leave_requests WHERE request_id = '$request_id' AND employee_id = '$employee_id' LIMIT 1 ";
	$res_req = $conn->query($sql_req);
	if (!$res_req || $res_req->num_rows == 0) {
		throw new Exception("not_found");
	}
	$row = $res_req->fetch_assoc();
	$entitlement_id = (int)$row['entitlement_id'];
	$requested_days = (float)$row['requested_days'];
	$status = trim($row['status']);
	if ($status === 'Cancelled' || $status === 'Approved' || $status === 'Rejected') {
		throw new Exception("not_allowed");
	}
	$sql_ent = " UPDATE leave_entitlements SET used_days = GREATEST(used_days - '$requested_days', 0), updated_at = NOW() WHERE entitlement_id = '$entitlement_id' AND employee_id = '$employee_id' LIMIT 1 ";
	if ($conn->query($sql_ent) !== TRUE) {
		throw new Exception("entitlement_fail");
	}
	$sql_cancel = " UPDATE leave_requests SET status = 'Cancelled', updated_at = NOW() WHERE request_id = '$request_id' AND employee_id = '$employee_id' LIMIT 1 ";

	if ($conn->query($sql_cancel) !== TRUE) {
		throw new Exception("cancel_fail");
	}
	$sql_steps = " UPDATE leave_request_steps SET step_status = 'Cancelled', acted_at = NOW() WHERE request_id = '$request_id' AND step_status NOT IN ('Approved','Rejected','Cancelled') ";

	if ($conn->query($sql_steps) !== TRUE) {
		throw new Exception("steps_fail");
	}

	$conn->commit();
	echo "true";
	exit;

} catch (Exception $e) {

	$conn->rollback();

	if ($e->getMessage() == "not_allowed") {
		echo "not_allowed";
	} elseif ($e->getMessage() == "not_found") {
		echo "not_found";
	} else {
		echo "err";
	}

	exit;
}
?>