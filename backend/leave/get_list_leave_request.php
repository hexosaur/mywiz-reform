<?php
session_start();
error_reporting(E_ALL);
include('../../config/cfg.php');

if (!isset($_GET['security']) || $_GET['security'] !== '123465') {
	exit;
}

$mode = isset($_GET['mode']) ? trim($_GET['mode']) : 'record';
$employee_id = isset($_SESSION['login']) ? (int)$_SESSION['login'] : 0;

$where = "";
if ($mode === 'archive') {
	$where = "";
} else {
	if ($employee_id <= 0) {
		exit;
	}
	$where = "WHERE lr.employee_id = '$employee_id'";
}

$sql = "SELECT lr.request_id, lr.date_from, lr.date_to, lr.requested_days, lr.status, e.first_name, e.surname, lt.type_code FROM leave_requests lr JOIN mgmt_employees e ON e.employee_id = lr.employee_id JOIN leave_entitlements le ON le.entitlement_id = lr.entitlement_id JOIN leave_types lt ON lt.type_id = le.type_id $where ORDER BY lr.created_at DESC";

$n = 1;
$table = "";

if ($result = $conn->query($sql)) {
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {

			$name = htmlspecialchars($row['first_name'] . " " . $row['surname'], ENT_QUOTES, 'UTF-8');
			$date_from = date("m/d/y", strtotime($row['date_from']));
			$date_to   = date("m/d/y", strtotime($row['date_to']));
			$days      = htmlspecialchars((string)$row['requested_days'], ENT_QUOTES, 'UTF-8');
			$type      = htmlspecialchars($row['type_code'], ENT_QUOTES, 'UTF-8');
			$status_raw = $row['status'];
			$status = strtolower($status_raw);
			$request_id = (int)$row['request_id'];

			if ($status === 'pending') {
				$status_badge = "<span class='badge badge-pill badge-warning'>Pending</span>";
			} elseif ($status === 'approved') {
				$status_badge = "<span class='badge badge-pill badge-success'>Approved</span>";
			} elseif ($status === 'rejected') {
				$status_badge = "<span class='badge badge-pill badge-danger'>Rejected</span>";
			} elseif ($status === 'cancelled') {
				$status_badge = "<span class='badge badge-pill badge-secondary'>Cancelled</span>";
			} else {
				$status_badge = "<span class='badge badge-pill badge-secondary'>" . htmlspecialchars($status_raw, ENT_QUOTES, 'UTF-8') . "</span>";
			}
			if ($mode === 'archive') {
				$table .= "<tr><td  class='align-middle'>{$n}</td><td class='align-middle' data-column='Name: '>{$name}</td><td class='align-middle' data-column='From: '>{$date_from}</td><td class='align-middle' data-column='To: '>{$date_to}</td><td class='align-middle' data-column='Days: '>{$days}</td><td class='align-middle' data-column='Status: '>{$status_badge}</td><td class='align-middle' data-column='Leave Type: '>{$type}</td><td class='align-middle' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$request_id}'><span class='feather icon-eye'></span></div></td></tr>";
			} else {
				$table .= "<tr><td  class='align-middle'>{$n}</td><td class='align-middle' data-column='From: '>{$date_from}</td><td class='align-middle' data-column='To: '>{$date_to}</td><td class='align-middle' data-column='Days: '>{$days}</td><td class='align-middle' data-column='Status: '>{$status_badge}</td><td class='align-middle' data-column='Leave Type: '>{$type}</td><td class='align-middle' data-column='Action: '><div class='btn btn-outline-info btn-sm btn-edit' data-id='{$request_id}'><span class='feather icon-eye'></span></div></td></tr>";
			}

			$n++;
		}

		$result->free();
	}
}

echo $table;
exit;
?>