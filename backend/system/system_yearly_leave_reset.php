<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (true) {

		$current_year = date('Y');
		$current_employee_id = isset($_SESSION['login']) ? (int)$_SESSION['login'] : 0;

		// =========================================================
		// CHECK IF RESET FOR CURRENT YEAR WAS ALREADY DONE
		// =========================================================
		$sql_check = "SELECT reset_id FROM ref_leave_reset_logs WHERE reset_year = '$current_year' LIMIT 1";
		$res_check = $conn->query($sql_check);

		if ($res_check && $res_check->num_rows > 0) {
			// Already reset for this year
			echo "done";
			exit;
		}

		$conn->begin_transaction();

		try {
			// =========================================================
			// RESET NON-ALL-YEAR ENTITLEMENTS (scope = 0)
			// - used_days = 0
			// - modified_days = 0
			// - entitlement_year = NULL
			// =========================================================
			$sql_reset_scope0 = "
				UPDATE leave_entitlements
				SET
					used_days = 0.00,
					modified_days = 0.00,
					entitlement_year = NULL,
					last_modified_by = " . ($current_employee_id > 0 ? "'$current_employee_id'" : "NULL") . ",
					last_modified_at = NOW(),
					updated_at = NOW()
				WHERE scope = 0
			";

			if (!$conn->query($sql_reset_scope0)) {
				throw new Exception("reset_scope0_failed");
			}

			// =========================================================
			// RESET ALL-YEAR ENTITLEMENTS (scope = 1)
			// - used_days = 0
			// - keep modified_days
			// =========================================================
			$sql_reset_scope1 = "
				UPDATE leave_entitlements
				SET
					used_days = 0.00,
					last_modified_by = " . ($current_employee_id > 0 ? "'$current_employee_id'" : "NULL") . ",
					last_modified_at = NOW(),
					updated_at = NOW()
				WHERE scope = 1
			";

			if (!$conn->query($sql_reset_scope1)) {
				throw new Exception("reset_scope1_failed");
			}

			// =========================================================
			// INSERT RESET LOG SO IT WON'T RUN AGAIN THIS YEAR
			// =========================================================
			$sql_log = "
				INSERT INTO ref_leave_reset_logs (reset_year, reset_done_at, reset_done_by)
				VALUES (
					'$current_year',
					NOW(),
					" . ($current_employee_id > 0 ? "'$current_employee_id'" : "NULL") . "
				)
			";

			if (!$conn->query($sql_log)) {
				throw new Exception("insert_reset_log_failed");
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
?>