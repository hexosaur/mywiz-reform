<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

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
				// =========================================================
				$sql_req = " SELECT request_id, status FROM leave_requests WHERE request_id = '$request_id' LIMIT 1 ";
				$res_req = $conn->query($sql_req);

				if (!$res_req || $res_req->num_rows == 0) {
					throw new Exception("request_not_found");
				}

				$row_req = $res_req->fetch_assoc();

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
				$step_no = (int)$row_step['step_no'];

				// =========================================================
				// APPROVE CURRENT STEP
				// =========================================================
				$sql_update_step = " UPDATE leave_request_steps SET step_status = 'Approved', acted_by = '$employee_id', acted_at = NOW() WHERE step_id = '$step_id' AND step_status = 'Pending' LIMIT 1 ";

				if (!$conn->query($sql_update_step)) {
					throw new Exception("update_step_failed");
				}

				// =========================================================
				// CHECK IF THERE ARE STILL PENDING STEPS
				// =========================================================
				$sql_next = " SELECT step_id FROM leave_request_steps WHERE request_id = '$request_id' AND step_status = 'Pending' ORDER BY step_no ASC LIMIT 1 ";
				$res_next = $conn->query($sql_next);

				if ($res_next && $res_next->num_rows > 0) {
					// Still has next step, request remains pending
					$sql_update_request = " UPDATE leave_requests SET updated_at = NOW() WHERE request_id = '$request_id' LIMIT 1 ";

					if (!$conn->query($sql_update_request)) {
						throw new Exception("update_request_pending_failed");
					}
				} else {
					// No more pending steps, final approval
					$sql_update_request = " UPDATE leave_requests SET status = 'Approved', updated_at = NOW() WHERE request_id = '$request_id' AND status = 'Pending' LIMIT 1 ";

					if (!$conn->query($sql_update_request)) {
						throw new Exception("final_approve_failed");
					}
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