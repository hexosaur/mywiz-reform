<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

		$pkid = (int)$_GET['id']; // employee_attachment_id

		$sql = "SELECT  employee_attachment_id, employee_id, attachment_type_id, attachment_title, file_name, reference_no, issued_by, issue_date, expiry_date, remarks FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid' LIMIT 1";

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$issue_date = !empty($row['issue_date']) ? date("F j, Y", strtotime($row['issue_date'])) : "";
				$expiry_date = !empty($row['expiry_date']) ? date("F j, Y", strtotime($row['expiry_date'])) : "";
				echo json_encode(array(
					"pkid" => (int)$row['employee_attachment_id'],
					"employee_id" => (int)$row['employee_id'],
					"attach_type" => (int)$row['attachment_type_id'],
					"attach_title" => $row['attachment_title'],
					"file_name" => $row['file_name'],
					"old_file_name" => $row['file_name'],
					"attach_ref_no" => $row['reference_no'],
					"attach_issue" => $row['issued_by'],
					"attach_date" => $issue_date,
					"attach_expiry" => $expiry_date,
					"attach_remarks" => $row['remarks']
				));
				exit;
			} else {
				echo json_encode(array(
					"status" => "error",
					"message" => "No attachment record found."
				));
				exit;
			}
		} else {
			echo json_encode(array(
				"status" => "error",
				"message" => "Query execution failed."
			));
			exit;
		}
	}
?>