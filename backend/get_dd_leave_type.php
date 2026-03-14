<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (
	isset($_GET['security']) && $_GET['security'] == '123465' &&
	isset($_GET['id'])
) {
	$employee_id = (int)$_GET['id'];

	$sql = " SELECT le.entitlement_id, le.type_id, lt.type_name, lt.with_pay FROM leave_entitlements le JOIN leave_types lt ON lt.type_id = le.type_id JOIN mgmt_employees e ON e.employee_id = le.employee_id WHERE le.employee_id = '$employee_id' AND lt.is_active = 1 ORDER BY lt.with_pay DESC, lt.type_name ASC ";

	$select = "";

	if ($result = $conn->query($sql)) {
		$select .= "<option value='' disabled selected>Select Leave Type</option>";

		$last_group = '';
		$opt_open = false;

		while ($row = $result->fetch_assoc()) {
			$entitlement_id = (int)$row['entitlement_id'];
			$type_name = htmlspecialchars($row['type_name'] ?? '', ENT_QUOTES, 'UTF-8');
			$with_pay = (int)$row['with_pay'];
			$group = ($with_pay === 1) ? 'Paid' : 'Unpaid';
			if ($group !== $last_group) {
				if ($opt_open) $select .= "</optgroup>";
				$select .= "<optgroup label='{$group}'>";
				$opt_open = true;
				$last_group = $group;
			}
			// value = entitlement_id (so edits update the entitlement row)
			$select .= "<option value='{$entitlement_id}'>{$type_name}</option>";
		}
		if ($opt_open) $select .= "</optgroup>";
		$result->free();
		echo $select;
		exit;
	}

	echo "";
	exit;
}

echo "";
exit;
?>