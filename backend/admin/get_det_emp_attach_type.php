<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
			$id = (int)$_GET['id'];
			$sql = "SELECT type_name, description, is_required, is_expirable, sort_order  FROM ref_attachment_types  WHERE attachment_type_id = '$id'";

			if ($result = $conn->query($sql)) {
				if ($result->num_rows > 0) {
					$data = array();
					while ($row = $result->fetch_array()) {
						$data[] = $row;
						$att_name = $row['type_name'];
						$att_desc = $row['description'];
						$att_required = (int)$row['is_required'];
						$att_expirable = (int)$row['is_expirable'];
						$att_sort = (int)$row['sort_order'];
					}

					$result->free();

					echo json_encode(array(
						"att_name" => $att_name,
						"att_desc" => $att_desc,
						"att_required" => $att_required,
						"att_expirable" => $att_expirable,
						"att_sort" => $att_sort
					));
					exit;
				} else {
					echo json_encode(array("status" => "error", "message" => "No data found for the given attachment type ID."));
					exit;
				}
			} else {
				echo json_encode(array("status" => "error", "message" => "Error executing the query."));
				exit;
			}
		}
	}
?>