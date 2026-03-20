<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (
	isset($_GET['security']) && $_GET['security'] == '123465' &&
	isset($_GET['id'])
) {
	$employee_id = (int)$_GET['id'];
	$sql_me = "SELECT branch_id, department_id FROM mgmt_employees WHERE employee_id = '$employee_id' LIMIT 1";
	$res_me = $conn->query($sql_me);

	if (!$res_me || $res_me->num_rows == 0) {
		echo "";
		exit;
	}

	$me = $res_me->fetch_assoc();
	$branch_id = (int)$me['branch_id'];
	$department_id = (int)$me['department_id'];
	$sql = "SELECT employee_id, CONCAT( first_name, ' ', IF(middle_name IS NOT NULL AND middle_name != '', CONCAT(LEFT(middle_name,1), '. '), '' ), surname, IF(suffix IS NOT NULL AND suffix != '', CONCAT(' ', suffix), '' ) ) AS full_name FROM mgmt_employees WHERE is_active = 1 AND employee_id <> '$employee_id' AND branch_id = '$branch_id' AND department_id = '$department_id' ORDER BY full_name ASC";

	$select .= "<option value='' disabled selected>Select Proxy</option><option value=''>No Proxy</option>";
	$result = $conn->query($sql);
	if (!$result) {
		$select .= "<option value='' disabled>Error loading proxy list</option>";
		echo $select;
		exit;
	}

	// if ($result->num_rows == 0) {
	// 	echo $select;
	// 	exit;
	// }

	// query ok and has rows
	while ($row = $result->fetch_assoc()) {
		$pid = (int)$row['employee_id'];
		$fullname = htmlspecialchars(trim($row['full_name'] ?? ''), ENT_QUOTES, 'UTF-8');
		$select .= "<option value='{$pid}'>{$fullname}</option>";
	}

	$result->free();
	echo $select;
	exit;
}

echo "";
exit;
?>


