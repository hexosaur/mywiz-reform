<?php
session_start();
error_reporting(E_ALL);
include('../../config/cfg.php');

if (isset($_POST['data'])) {
	$data = json_decode($_POST['data']);

	$scope = (int)$data->scope;
	$entitlement_id = (int)$data->pkid;
	$last_modified_by = (!empty($_SESSION['login'])) ? (int)$_SESSION['login'] : null;
	$modified_days = (float)$data->modified_days;

	// entitlement_year logic:
	// - if modified_days is 0 => NULL (always)
	// - else if scope is 0 => current year
	// - else => NULL
	if (abs($modified_days) < 0.00001) {
		$scope = 0;
		$entitlement_year = null;
	} else {
		$entitlement_year = ($scope === 0) ? (int)date('Y') : null;
	}

	// check if record exists + detect "no changes"
	$sql_check = "SELECT scope, modified_days, entitlement_year FROM leave_entitlements WHERE entitlement_id = '$entitlement_id' LIMIT 1";
	$res = $conn->query($sql_check);
	if (!$res || $res->num_rows == 0) {
		echo "err";
		exit;
	}
	$row = $res->fetch_assoc();

	$db_scope = (int)$row['scope'];
	$db_days  = (float)$row['modified_days'];
	$db_year  = ($row['entitlement_year'] === null) ? null : (int)$row['entitlement_year'];

	$is_changed = false;
	if ($db_scope !== $scope) $is_changed = true;
	if (abs($db_days - $modified_days) > 0.00001) $is_changed = true;
	if ($db_year !== $entitlement_year) $is_changed = true;

	if (!$is_changed) {
		echo "exist";
		exit;
	}

	// handle NULL properly for year and modifier
	$year_sql = ($entitlement_year === null) ? "NULL" : "'" . $entitlement_year . "'";
	$lmb_sql  = ($last_modified_by === null) ? "NULL" : "'" . $last_modified_by . "'";

	$sql = "UPDATE leave_entitlements SET scope = '$scope', modified_days = '$modified_days', entitlement_year = $year_sql, last_modified_by = $lmb_sql, last_modified_at = NOW() WHERE entitlement_id = '$entitlement_id'";

	if ($conn->query($sql) === TRUE) {
		echo "true";
	} else {
		echo "err";
	}
}
?>