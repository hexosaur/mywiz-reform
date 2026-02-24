	<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

		$id = (int)$_GET['id'];

		$sql = "SELECT department_id, department_name, department_scope FROM mgmt_departments WHERE department_id = '$id' LIMIT 1";

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$result->free();

				echo json_encode([
					"dept_id"    => (int)$row['department_id'],
					"dept_name"  => $row['department_name'] ?? ''
				]);
				exit;
			}

			echo json_encode(["status" => "error", "message" => "No data found for the given department ID."]);
			exit;
		}

		echo json_encode(["status" => "error", "message" => "Error executing the query."]);
		exit;
	}

	echo json_encode(["status" => "error", "message" => "Invalid request."]);
	exit;
	?>
