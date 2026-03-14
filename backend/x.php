	<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (!isset($_POST['data'])) { echo "err"; exit; }
	$req = json_decode($_POST['data']);
	if (!$req) { echo "err"; exit; }

	$employee_id    = (int)($req->pkid ?? 0);
	$entitlement_id = (int)($req->req_type ?? 0);
	$proxy_id       = (isset($req->req_proxy) && $req->req_proxy !== '' && $req->req_proxy !== null) ? (int)$req->req_proxy : null;
	$purpose = $conn->real_escape_string(trim($req->req_purpose ?? ''));
	$dayS = $conn->real_escape_string(trim($req->req_dayS ?? ''));
	$dayE = $conn->real_escape_string(trim($req->req_dayE ?? ''));
	$timeF = isset($req->req_timeF) && $req->req_timeF !== '' ? $conn->real_escape_string($req->req_timeF) : null;
	$timeT = isset($req->req_timeT) && $req->req_timeT !== '' ? $conn->real_escape_string($req->req_timeT) : null;
	$requested_days = (float)($req->requested_days ?? 0.00);
	$date_from_sql = "STR_TO_DATE('$dayS','%M %d, %Y')";
	$date_to_sql   = "STR_TO_DATE('$dayE','%M %d, %Y')";

	$sql_req = "SELECT e.branch_id, e.department_id, al.access_level_value, e.employee_code, lt.type_code FROM mgmt_employees e JOIN mgmt_roles r ON r.role_id = e.role_id JOIN ref_access_levels al ON al.access_level_id = r.access_level_id JOIN leave_entitlements le ON le.employee_id = e.employee_id JOIN leave_types lt ON lt.type_id = le.type_id WHERE e.employee_id = '$employee_id' AND e.is_active = 1 AND le.entitlement_id = '$entitlement_id' LIMIT 1";

	$res_req = $conn->query($sql_req);
	if (!$res_req || $res_req->num_rows == 0) { echo "emp_not_found"; exit; }

	$r = $res_req->fetch_assoc();
	$branch_id = (int)$r['branch_id'];
	$dept_id   = (int)$r['department_id'];
	$requester_val = (int)$r['access_level_value'];
	$employee_code = (string)$r['employee_code'];
	$leave_type_code = (string)$r['type_code'];

	$HR_MIN  = 110;
	$TOP_MIN = 120;

	function existsRow($conn, $sql) {
		$res = $conn->query($sql);
		return ($res && $res->num_rows > 0);
	}

	// ===============================================
	// File Upload Configuration
	// ===============================================
	$DIRLoc = "../uploads/leaves/";
	if (!defined('TARGET_DIR')) {
		define('TARGET_DIR', $DIRLoc);
	}
	$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
	$limitFile = 25000000;

	$attachment_path = '';

	// optional file upload
	if (
		isset($_FILES['fileupload']) &&
		is_array($_FILES['fileupload']) &&
		isset($_FILES['fileupload']['error']) &&
		$_FILES['fileupload']['error'] !== UPLOAD_ERR_NO_FILE
	) {
		$fileName    = $_FILES['fileupload']['name'] ?? '';
		$fileTmpName = $_FILES['fileupload']['tmp_name'] ?? '';
		$fileSize    = $_FILES['fileupload']['size'] ?? 0;
		$fileError   = $_FILES['fileupload']['error'] ?? UPLOAD_ERR_NO_FILE;

		if ($fileError !== UPLOAD_ERR_OK) {
			echo "file_error";
			exit;
		}

		if ($fileName === '' || $fileTmpName === '') {
			echo "file_error";
			exit;
		}

		$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		if (!in_array($fileExtension, $allowedExtensions)) {
			echo "file_invalid";
			exit;
		}

		if ($fileSize > $limitFile) {
			echo "file_exceed";
			exit;
		}

		if (!is_dir(TARGET_DIR)) {
			@mkdir(TARGET_DIR, 0777, true);
		}

		$currentDate = date("d-m-y");
		$uniqueString = substr(uniqid('', true), 0, 10);
		$newFileName = "{$currentDate}_{$employee_code}_{$leave_type_code}_{$uniqueString}.{$fileExtension}";
		$uploadPath = TARGET_DIR . $newFileName;

		if (move_uploaded_file($fileTmpName, $uploadPath)) {
			$attachment_path = $newFileName;
		} else {
			echo "file_upload_fail";
			exit;
		}
	}

	// ===============================================
	// Begin Transaction
	// ===============================================
	$conn->begin_transaction();

	try {
		$sql_insert = "INSERT INTO leave_requests (employee_id, entitlement_id, proxy_employee_id, purpose, date_from, date_to, time_from, time_to, requested_days, status, created_at, updated_at, attachment) VALUES ('$employee_id', '$entitlement_id', " . ($proxy_id === null ? "NULL" : "'$proxy_id'") . ", " . ($purpose !== '' ? "'$purpose'" : "NULL") . ", $date_from_sql, $date_to_sql, " . ($timeF === null ? "NULL" : "'$timeF'") . ", " . ($timeT === null ? "NULL" : "'$timeT'") . ", '" . number_format($requested_days, 2, '.', '') . "', 'Pending', NOW(), NOW(), " . ($attachment_path !== '' ? "'$attachment_path'" : "NULL") . ")";

		if ($conn->query($sql_insert) !== TRUE) { throw new Exception("insert_fail"); }

		$request_id = (int)$conn->insert_id;
		$step_no = 1;

		// update entitlement used days
		$sql_update_entitlement = "UPDATE leave_entitlements SET used_days = used_days + '$requested_days' WHERE employee_id = '$employee_id' AND entitlement_id = '$entitlement_id'";

		if ($conn->query($sql_update_entitlement) !== TRUE) {
			throw new Exception("update_entitlement_fail");
		}

		// STEP CHAIN
		$sql_dept_chain = "SELECT DISTINCT al.access_level_value AS val FROM mgmt_employees e JOIN mgmt_roles r ON r.role_id = e.role_id JOIN ref_access_levels al ON al.access_level_id = r.access_level_id WHERE e.is_active = 1 AND e.branch_id = '$branch_id' AND e.department_id = '$dept_id' AND al.access_level_value > '$requester_val' ORDER BY al.access_level_value ASC";

		$res_dept = $conn->query($sql_dept_chain);
		if ($res_dept) {
			while ($row = $res_dept->fetch_assoc()) {
				$val = (int)$row['val'];
				$sql_step = "INSERT INTO leave_request_steps (request_id, step_no, step_type, required_min_value, branch_id, department_id, step_status) VALUES ('$request_id', '$step_no', 'BR_DEPT_CHAIN', '$val', '$branch_id', '$dept_id', 'Pending')";
				if ($conn->query($sql_step) !== TRUE) { throw new Exception("step_fail"); }
				$step_no++;
			}
		}

		$sql_branch_chain = "SELECT DISTINCT al.access_level_value AS val FROM mgmt_employees e JOIN mgmt_roles r ON r.role_id = e.role_id JOIN ref_access_levels al ON al.access_level_id = r.access_level_id WHERE e.is_active = 1 AND e.branch_id = '$branch_id' AND e.department_id != '$dept_id' AND al.access_level_value > '$requester_val' AND al.access_level_value < '$TOP_MIN' ORDER BY al.access_level_value ASC";

		$res_branch = $conn->query($sql_branch_chain);
		if ($res_branch) {
			while ($row = $res_branch->fetch_assoc()) {
				$val = (int)$row['val'];
				$sql_step = "INSERT INTO leave_request_steps
							(request_id, step_no, step_type, required_min_value, branch_id, department_id, step_status)
							VALUES
							('$request_id', '$step_no', 'BRANCH_CHAIN', '$val', '$branch_id', NULL, 'Pending')";
				if ($conn->query($sql_step) !== TRUE) { throw new Exception("step_fail"); }
				$step_no++;
			}
		}

		$sql_hr = "SELECT 1 FROM mgmt_employees e JOIN mgmt_roles r ON r.role_id = e.role_id JOIN ref_access_levels al ON al.access_level_id = r.access_level_id JOIN mgmt_departments d ON d.department_id = e.department_id WHERE e.is_active = 1 AND e.employee_id <> '$employee_id' AND al.access_level_value >= '$HR_MIN' AND al.access_level_value < '$TOP_MIN' AND ( LOWER(d.department_name) LIKE '%human%' OR LOWER(r.role_name) LIKE '%human%' OR LOWER(r.role_name) LIKE '%hr%' ) LIMIT 1";

		if (existsRow($conn, $sql_hr)) {
			$sql_step = "INSERT INTO leave_request_steps (request_id, step_no, step_type, required_min_value, step_status) VALUES ('$request_id', '$step_no', 'HR', '$HR_MIN', 'Pending')";
			if ($conn->query($sql_step) !== TRUE) { throw new Exception("hr_fail"); }
			$step_no++;
		}

		$sql_top = "SELECT 1 FROM mgmt_employees e JOIN mgmt_roles r ON r.role_id = e.role_id JOIN ref_access_levels al ON al.access_level_id = r.access_level_id WHERE e.is_active = 1 AND e.employee_id <> '$employee_id' AND al.access_level_value >= '$TOP_MIN' AND ( LOWER(r.role_name) LIKE '%owner%' OR LOWER(r.role_name) LIKE '%pres%' OR LOWER(r.role_name) LIKE '%bod%' OR LOWER(r.role_name) LIKE '%board%' OR LOWER(r.role_name) LIKE '%admin%' ) LIMIT 1";

		if (existsRow($conn, $sql_top)) {
			$sql_step = "INSERT INTO leave_request_steps
						(request_id, step_no, step_type, required_min_value, step_status)
						VALUES
						('$request_id', '$step_no', 'TOP', '$TOP_MIN', 'Pending')";
			if ($conn->query($sql_step) !== TRUE) { throw new Exception("top_fail"); }
			$step_no++;
		}

		$chk = $conn->query("SELECT 1 FROM leave_request_steps WHERE request_id='$request_id' LIMIT 1");
		if (!$chk || $chk->num_rows == 0) {
			$conn->query("UPDATE leave_requests SET status='Approved', updated_at=NOW() WHERE request_id='$request_id'");
		}

		$conn->commit();
		echo "true";
		exit;

	} catch (Exception $e) {
		$conn->rollback();

		// optional cleanup if file uploaded but DB failed
		if ($attachment_path !== '') {
			$uploaded_file = TARGET_DIR . $attachment_path;
			if (file_exists($uploaded_file)) {
				@unlink($uploaded_file);
			}
		}

		echo "err";
		exit;
	}
	?>