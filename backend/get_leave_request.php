<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (true) {
		if (isset($_GET['security']) && $_GET['security'] == '123465') {

			if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
				echo json_encode(array(
					"status" => "error",
					"message" => "Session expired or invalid."
				));
				exit;
			}

			$employee_id = (int)$_SESSION['login'];

			// =========================================================
			// GET CURRENT LOGGED-IN EMPLOYEE DETAILS
			// =========================================================
			$sql_emp = "SELECT me.employee_id, me.branch_id, me.department_id, me.role_id, md.department_name, mr.role_name, ral.access_level_value, CONCAT( me.first_name, ' ', IF(me.middle_name IS NOT NULL AND me.middle_name != '', CONCAT(LEFT(me.middle_name,1), '. '), ''), me.surname, IF(me.suffix IS NOT NULL AND me.suffix != '', CONCAT(' ', me.suffix), '') ) AS full_name FROM mgmt_employees me LEFT JOIN mgmt_departments md ON me.department_id = md.department_id LEFT JOIN mgmt_roles mr ON me.role_id = mr.role_id LEFT JOIN ref_access_levels ral ON mr.access_level_id = ral.access_level_id WHERE me.employee_id = '$employee_id' AND me.is_active = 1 LIMIT 1";

			$result_emp = $conn->query($sql_emp);

			if (!$result_emp || $result_emp->num_rows == 0) {
				echo json_encode(array(
					"status" => "error",
					"message" => "Logged-in employee not found."
				));
				exit;
			}

			$row_emp = $result_emp->fetch_assoc();

			$current_branch_id        = (int)$row_emp['branch_id'];
			$current_department_id    = (int)$row_emp['department_id'];
			$current_department_name  = $row_emp['department_name'];
			$current_access_level     = (int)$row_emp['access_level_value'];

			// =========================================================
			// GET ALL PENDING REQUESTS WHERE CURRENT LOGGED-IN EMPLOYEE
			// IS QUALIFIED TO APPROVE THE CURRENT PENDING STEP
			// =========================================================
			$sql = "SELECT
						lr.request_id,
						lr.employee_id,
						lr.entitlement_id,
						lr.proxy_employee_id,
						lr.purpose,
						lr.date_from,
						lr.date_to,
						lr.time_from,
						lr.time_to,
						lr.requested_days,
						lr.status,
						lr.attachment,
						lr.created_at,
						lrs.step_id,
						lrs.step_no,
						lrs.step_type,
						lrs.required_min_value,
						lrs.branch_id AS step_branch_id,
						lrs.department_id AS step_department_id,
						lrs.step_status,
						req.branch_id AS requester_branch_id,
						req.department_id AS requester_department_id,
						req_role.role_name AS requester_role_name,
						req_level.access_level_value AS requester_access_level_value,
						CONCAT(
							req.first_name, ' ',
							IF(req.middle_name IS NOT NULL AND req.middle_name != '', CONCAT(LEFT(req.middle_name,1), '. '), ''),
							req.surname,
							IF(req.suffix IS NOT NULL AND req.suffix != '', CONCAT(' ', req.suffix), '')
						) AS requester_full_name,
						lt.type_name AS leave_type_name
					FROM leave_requests lr
					INNER JOIN leave_request_steps lrs
						ON lr.request_id = lrs.request_id
					INNER JOIN (
						SELECT request_id, MIN(step_no) AS min_step_no
						FROM leave_request_steps
						WHERE step_status = 'Pending'
						GROUP BY request_id
					) ps
						ON lrs.request_id = ps.request_id
						AND lrs.step_no = ps.min_step_no
					LEFT JOIN mgmt_employees req
						ON lr.employee_id = req.employee_id
					LEFT JOIN mgmt_roles req_role
						ON req.role_id = req_role.role_id
					LEFT JOIN ref_access_levels req_level
						ON req_role.access_level_id = req_level.access_level_id
					LEFT JOIN leave_entitlements le
						ON lr.entitlement_id = le.entitlement_id
					LEFT JOIN leave_types lt
						ON le.type_id = lt.type_id
					WHERE lr.status = 'Pending'
					AND lr.employee_id != '$employee_id'
					AND req.is_active = 1
					AND (
						(
							lrs.step_type = 'BR_DEPT_CHAIN'
							AND IFNULL(lrs.branch_id, req.branch_id) = '$current_branch_id'
							AND IFNULL(lrs.department_id, req.department_id) = '$current_department_id'
							AND '$current_access_level' >= lrs.required_min_value
							AND '$current_access_level' > req_level.access_level_value
						)
						OR
						(
							lrs.step_type = 'BRANCH_CHAIN'
							AND IFNULL(lrs.branch_id, req.branch_id) = '$current_branch_id'
							AND '$current_access_level' >= lrs.required_min_value
							AND '$current_access_level' > req_level.access_level_value
						)
						OR
						(
							lrs.step_type = 'HR'
							-- AND '$current_department_name' = 'Human Resource'
							AND '$current_access_level' >= lrs.required_min_value
						)
						OR
						(
							lrs.step_type = 'TOP'
							AND '$current_access_level' >= lrs.required_min_value
						)
					)

					ORDER BY lr.created_at ASC, lrs.step_no ASC";

			if ($result = $conn->query($sql)) {

				$data = array();

				while ($row = $result->fetch_assoc()) {
					$data[] = array(
						"request_id"                    => $row['request_id'],
						"employee_id"                   => $row['employee_id'],
						"requester_full_name"           => $row['requester_full_name'],
						"leave_type_name"               => $row['leave_type_name'],
						"purpose"                       => $row['purpose'],
						"date_from"                     => $row['date_from'],
						"date_to"                       => $row['date_to'],
						"time_from"                     => $row['time_from'],
						"time_to"                       => $row['time_to'],
						"requested_days"                => $row['requested_days'],
						"status"                        => $row['status'],
						"attachment"                    => $row['attachment'],
						"created_at"                    => $row['created_at'],
						"step_id"                       => $row['step_id'],
						"step_no"                       => $row['step_no'],
						"step_type"                     => $row['step_type'],
						"required_min_value"            => $row['required_min_value'],
						"step_branch_id"                => $row['step_branch_id'],
						"step_department_id"            => $row['step_department_id'],
						"step_status"                   => $row['step_status'],
						"requester_branch_id"           => $row['requester_branch_id'],
						"requester_department_id"       => $row['requester_department_id'],
						"requester_role_name"           => $row['requester_role_name'],
						"requester_access_level_value"  => $row['requester_access_level_value']
					);
				}

				echo json_encode(array(
					"status" => "success",
					"employee" => array(
						"employee_id" => $row_emp['employee_id'],
						"full_name" => $row_emp['full_name'],
						"branch_id" => $row_emp['branch_id'],
						"department_id" => $row_emp['department_id'],
						"department_name" => $row_emp['department_name'],
						"role_name" => $row_emp['role_name'],
						"access_level_value" => $row_emp['access_level_value']
					),
					"total" => count($data),
					"requests" => $data
				));
				exit;

			} else {
				echo json_encode(array(
					"status" => "error",
					"message" => "Error executing leave request query."
				));
				exit;
			}
		}
	}
?>