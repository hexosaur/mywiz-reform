<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if (isset($_GET['security']) && $_GET['security'] == '123465') {
	$sql = "SELECT type_id, type_name, with_pay FROM leave_types WHERE is_active = '1' ORDER BY with_pay DESC, type_name ASC";  // Sorting by 'with_pay' and then by name
	$select = "";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$select .= "<option disabled selected>Select Leave Type</option>";
			$last_category = '';
			while ($row = $result->fetch_assoc()) {
				$type_id = $row['type_id'];
				$type_name = $row['type_name'];
				$with_pay = $row['with_pay'];
				if ($with_pay == 1 && $last_category != 'Paid') {
					$select .= "<optgroup label='Paid'>";
					$last_category = 'Paid';
				} elseif ($with_pay == 0 && $last_category != 'Unpaid') {
					$select .= "<optgroup label='Unpaid'>";
					$last_category = 'Unpaid';
				}
				$select .= "<option value='$type_id'>$type_name</option>";
				if (($with_pay == 1 && $last_category == 'Paid') || ($with_pay == 0 && $last_category == 'Unpaid')) {
					$select .= "</optgroup>";
				}
			}
			if ($last_category != '') {
				$select .= "</optgroup>";
			}
			$result->free();
		}

		echo $select;
		exit;

	} else {
		echo "";
		exit;
	}
}
?>
