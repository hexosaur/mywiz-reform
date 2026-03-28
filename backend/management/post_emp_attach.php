<?php
session_start();
error_reporting(0);
include('../../config/cfg.php');

if (isset($_POST['data'])) {

	$employee_attachment = json_decode($_POST['data']);
	$pkid = isset($employee_attachment->pkid) ? (int)$employee_attachment->pkid : 0; // employee_attachment_id
	$employee_id = isset($employee_attachment->employee_id) ? (int)$employee_attachment->employee_id : 0;

	$attachment_type_id = isset($employee_attachment->attach_type) ? (int)$employee_attachment->attach_type : 0;
	$attachment_title = trim($conn->real_escape_string($employee_attachment->attach_title ?? ''));
	$reference_no = trim($conn->real_escape_string($employee_attachment->attach_ref_no ?? ''));
	$issued_by = trim($conn->real_escape_string($employee_attachment->attach_issue ?? ''));
	$issue_date = !empty($employee_attachment->attach_date) ? date('Y-m-d', strtotime($employee_attachment->attach_date)) : '';
	$expiry_date = !empty($employee_attachment->attach_expiry) ? date('Y-m-d', strtotime($employee_attachment->attach_expiry)) : '';
	$remarks = trim($conn->real_escape_string($employee_attachment->attach_remarks ?? ''));
	$old_file_name = trim($employee_attachment->old_file_name ?? '');

	if ($employee_id <= 0 || $attachment_type_id <= 0 || $attachment_title == '') {
		echo "empty";
		exit;
	}

	$file_name = $old_file_name;
	$new_upload = false;

	// if edit mode and old_file_name not passed from frontend, fetch existing one
	if ($pkid > 0 && empty($file_name)) {
		$get_old = "SELECT file_name FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid' LIMIT 1";
		$res_old = $conn->query($get_old);
		if ($res_old && $res_old->num_rows > 0) {
			$row_old = $res_old->fetch_assoc();
			$file_name = $row_old['file_name'];
		}
	}

	// upload file
	if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload']['name'])) {

		$upload_dir = "../../uploads/employee_attachments/";
		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}

		$orig_name = $_FILES['fileupload']['name'];
		$tmp_name = $_FILES['fileupload']['tmp_name'];
		$file_error = $_FILES['fileupload']['error'];

		$ext = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
		$allowed = array('pdf','jpg','jpeg','png','doc','docx','xls','xlsx');

		if (!in_array($ext, $allowed)) {
			echo "invalid_file";
			exit;
		}

		if ($file_error != 0) {
			echo "file_err";
			exit;
		}

		$file_name = "empatt_" . $employee_id . "_" . time() . "_" . mt_rand(1000,9999) . "." . $ext;
		$target_file = $upload_dir . $file_name;

		if (!move_uploaded_file($tmp_name, $target_file)) {
			echo "file_err";
			exit;
		}

		$new_upload = true;
	}

	// new record requires a file
	if ($pkid == 0 && empty($file_name)) {
		echo "no_file";
		exit;
	}

	$reference_no_sql = ($reference_no !== '') ? "'" . $reference_no . "'" : "NULL";
	$issued_by_sql = ($issued_by !== '') ? "'" . $issued_by . "'" : "NULL";
	$issue_date_sql = ($issue_date !== '') ? "'" . $conn->real_escape_string($issue_date) . "'" : "NULL";
	$expiry_date_sql = ($expiry_date !== '') ? "'" . $conn->real_escape_string($expiry_date) . "'" : "NULL";
	$remarks_sql = ($remarks !== '') ? "'" . $remarks . "'" : "NULL";
	$file_name_sql = ($file_name !== '') ? "'" . $conn->real_escape_string($file_name) . "'" : "NULL";

	if ($pkid > 0) {
		$sql_check = "SELECT * FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid' LIMIT 1";
		$result = $conn->query($sql_check);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$is_changed = false;
			if ((int)$row['employee_id'] !== $employee_id) $is_changed = true;
			if ((int)$row['attachment_type_id'] !== $attachment_type_id) $is_changed = true;
			if (($row['attachment_title'] ?? '') !== $attachment_title) $is_changed = true;
			if (($row['reference_no'] ?? '') !== $reference_no) $is_changed = true;
			if (($row['issued_by'] ?? '') !== $issued_by) $is_changed = true;
			if (($row['issue_date'] ?? '') !== $issue_date) $is_changed = true;
			if (($row['expiry_date'] ?? '') !== $expiry_date) $is_changed = true;
			if (($row['remarks'] ?? '') !== $remarks) $is_changed = true;
			if ($new_upload) $is_changed = true;
			if (!$is_changed) {
				echo "exist";
				exit;
			}
		}
	}
	if ($pkid == 0) {

		$sql = "INSERT INTO mgmt_employee_attachments(
					employee_id,
					attachment_type_id,
					attachment_title,
					file_name,
					reference_no,
					issued_by,
					issue_date,
					expiry_date,
					remarks
				) VALUES (
					'$employee_id',
					'$attachment_type_id',
					'$attachment_title',
					$file_name_sql,
					$reference_no_sql,
					$issued_by_sql,
					$issue_date_sql,
					$expiry_date_sql,
					$remarks_sql
				)";

		if ($conn->query($sql) === TRUE) {
			echo "true";
			exit;
		} else {
			if ($new_upload && !empty($file_name)) {
				$rollback_file = "../../uploads/employee_attachments/" . basename($file_name);
				if (file_exists($rollback_file)) {
					@unlink($rollback_file);
				}
			}
			echo "err";
			exit;
		}

	} else {

		$get_old = "SELECT file_name FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid' LIMIT 1";
		$res_old = $conn->query($get_old);
		$old_db_file = '';
		if ($res_old && $res_old->num_rows > 0) {
			$row_old = $res_old->fetch_assoc();
			$old_db_file = $row_old['file_name'];
		}

		$sql = "UPDATE mgmt_employee_attachments
				SET employee_id = '$employee_id',
					attachment_type_id = '$attachment_type_id',
					attachment_title = '$attachment_title',
					file_name = $file_name_sql,
					reference_no = $reference_no_sql,
					issued_by = $issued_by_sql,
					issue_date = $issue_date_sql,
					expiry_date = $expiry_date_sql,
					remarks = $remarks_sql
				WHERE employee_attachment_id = '$pkid'";

		if ($conn->query($sql) === TRUE) {

			if ($new_upload && !empty($old_db_file) && $old_db_file != $file_name) {
				$old_path = "../../uploads/employee_attachments/" . basename($old_db_file);
				if (file_exists($old_path)) {
					@unlink($old_path);
				}
			}

			echo "true";
			exit;
		} else {
			if ($new_upload && !empty($file_name)) {
				$rollback_file = "../../uploads/employee_attachments/" . basename($file_name);
				if (file_exists($rollback_file)) {
					@unlink($rollback_file);
				}
			}
			echo "err";
			exit;
		}
	}
}
?>