<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (true) {
		if (isset($_POST['id']) && isset($_SESSION['login'])) {

			$request_id = (int)$_POST['id'];
			$employee_id = (int)$_SESSION['login'];

			if ($request_id <= 0 || $employee_id <= 0) {
				echo "err";
				exit;
			}

			$conn->begin_transaction();

			try {
				// =========================================================
				// CHECK IF REQUEST EXISTS AND IS STILL PENDING
				// ALSO GET ENTITLEMENT + REQUESTED DAYS
				// =========================================================
				$sql_req = " SELECT request_id, entitlement_id, requested_days, status FROM leave_requests WHERE request_id = '$request_id' LIMIT 1 ";
				$res_req = $conn->query($sql_req);

				if (!$res_req || $res_req->num_rows == 0) {
					throw new Exception("request_not_found");
				}

				$row_req = $res_req->fetch_assoc();

				$entitlement_id = (int)$row_req['entitlement_id'];
				$requested_days = (float)$row_req['requested_days'];

				if ($row_req['status'] != 'Pending') {
					throw new Exception("request_not_pending");
				}

				// =========================================================
				// GET CURRENT PENDING STEP
				// =========================================================
				$sql_step = " SELECT step_id, step_no, step_status FROM leave_request_steps WHERE request_id = '$request_id' AND step_status = 'Pending' ORDER BY step_no ASC LIMIT 1 ";
				$res_step = $conn->query($sql_step);

				if (!$res_step || $res_step->num_rows == 0) {
					throw new Exception("no_pending_step");
				}

				$row_step = $res_step->fetch_assoc();
				$step_id = (int)$row_step['step_id'];

				// =========================================================
				// REJECT CURRENT STEP
				// =========================================================
				$sql_reject_step = " UPDATE leave_request_steps SET step_status = 'Rejected', acted_by = '$employee_id', acted_at = NOW() WHERE step_id = '$step_id' AND step_status = 'Pending' LIMIT 1 ";

				if (!$conn->query($sql_reject_step)) {
					throw new Exception("reject_step_failed");
				}

				// =========================================================
				// CANCEL ALL REMAINING PENDING STEPS
				// =========================================================
				$sql_cancel_next = " UPDATE leave_request_steps SET step_status = 'Cancelled' WHERE request_id = '$request_id' AND step_status = 'Pending'
				";

				if (!$conn->query($sql_cancel_next)) {
					throw new Exception("cancel_remaining_steps_failed");
				}

				// =========================================================
				// ROLLBACK / RESTORE USED DAYS TO ENTITLEMENT
				// SAME IDEA AS CANCELLED REQUEST
				// =========================================================
				$sql_restore_days = " UPDATE leave_entitlements SET used_days = CASE WHEN used_days >= '$requested_days' THEN used_days - '$requested_days' ELSE 0 END, last_modified_by = '$employee_id', last_modified_at = NOW(), updated_at = NOW() WHERE entitlement_id = '$entitlement_id' LIMIT 1 ";

				if (!$conn->query($sql_restore_days)) {
					throw new Exception("restore_days_failed");
				}

				// =========================================================
				// UPDATE MAIN REQUEST STATUS TO REJECTED
				// =========================================================
				$sql_update_request = " UPDATE leave_requests SET status = 'Rejected', updated_at = NOW() WHERE request_id = '$request_id' AND status = 'Pending' LIMIT 1 ";

				if (!$conn->query($sql_update_request)) {
					throw new Exception("reject_request_failed");
				}

				$conn->commit();
				echo "true";
				exit;

			} catch (Exception $e) {
				$conn->rollback();
				echo "err";
				exit;
			}
		}
	}

	echo "err";
	exit;
?>