<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {

		$employee_id = (int)$_GET['id'];

		$sql = "SELECT
					e.first_name,
					ea.employee_attachment_id,
					ea.attachment_title,
					ea.file_name,
					ea.reference_no,
					ea.issued_by,
					ea.issue_date,
					ea.expiry_date,
					ea.remarks,
					rat.type_name
				FROM mgmt_employee_attachments ea
				LEFT JOIN ref_attachment_types rat
					ON rat.attachment_type_id = ea.attachment_type_id
				JOIN mgmt_employees e
					ON e.employee_id = ea.employee_id
				WHERE ea.employee_id = '$employee_id'
				ORDER BY 
					rat.sort_order ASC,
					ea.created_at DESC";

		$html = "";
		$first_name = "";

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {

				$html .= "<div class='emp-attach-scroll' style='max-height:40rem; overflow-y:auto; padding-right:6px;'>";

				while ($row = $result->fetch_assoc()) {

					if ($first_name == "") {
						$first_name = $row['first_name'];
					}

					$employee_attachment_id = (int)$row['employee_attachment_id'];
					$attachment_title = htmlspecialchars($row['attachment_title'] ?? '', ENT_QUOTES, 'UTF-8');
					$type_name = htmlspecialchars($row['type_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$file_name = htmlspecialchars($row['file_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$reference_no = htmlspecialchars($row['reference_no'] ?? '', ENT_QUOTES, 'UTF-8');
					$issued_by = htmlspecialchars($row['issued_by'] ?? '', ENT_QUOTES, 'UTF-8');
					$remarks = htmlspecialchars($row['remarks'] ?? '', ENT_QUOTES, 'UTF-8');

					$issue_date = !empty($row['issue_date']) ? date("F j, Y", strtotime($row['issue_date'])) : "—";
					$expiry_date_raw = $row['expiry_date'];
					$expiry_date = !empty($expiry_date_raw) ? date("F j, Y", strtotime($expiry_date_raw)) : "—";

					$status_badge = "<span class='badge badge-secondary'>No Expiry</span>";
					if (!empty($expiry_date_raw)) {
						$today = date("Y-m-d");
						if ($expiry_date_raw < $today) {
							$status_badge = "<span class='badge badge-danger'>Expired</span>";
						} else if ($expiry_date_raw <= date("Y-m-d", strtotime("+30 days"))) {
							$status_badge = "<span class='badge badge-warning'>Expiring Soon</span>";
						} else {
							$status_badge = "<span class='badge badge-success'>Valid</span>";
						}
					}

					$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
					$file_icon = "feather icon-file-text";
					if (in_array($file_ext, ['jpg','jpeg','png','gif','webp'])) {
						$file_icon = "feather icon-image";
					} else if ($file_ext == 'pdf') {
						$file_icon = "feather icon-file";
					}

					$file_url = "../uploads/employee_attachments/" . rawurlencode($file_name);

					$html .= "
					<div class='card mb-2 shadow-sm border-0'>
						<div class='card-body py-3 px-3'>
							<div class='d-flex justify-content-between align-items-start flex-wrap'>
								<div class='pr-3' style='flex:1; min-width:240px;'>
									<div class='d-flex align-items-center mb-2'>
										<div class='mr-2 text-primary'><i class='{$file_icon}'></i></div>
										<div>
											<h6 class='mb-0 font-weight-bold'>{$attachment_title}</h6>
											<small class='text-muted'>{$type_name}</small>
										</div>
									</div>

									<div class='row small text-muted'>
										<div class='col-md-6 mb-1'><strong>Reference No:</strong> ".(!empty($reference_no) ? $reference_no : "—")."</div>
										<div class='col-md-6 mb-1'><strong>Issued By:</strong> ".(!empty($issued_by) ? $issued_by : "—")."</div>
										<div class='col-md-6 mb-1'><strong>Issue Date:</strong> {$issue_date}</div>
										<div class='col-md-6 mb-1'><strong>Expiry Date:</strong> {$expiry_date}</div>
										<div class='col-12 mb-1'><strong>Remarks:</strong> ".(!empty($remarks) ? $remarks : "—")."</div>
										<div class='col-12 mt-1'>{$status_badge}</div>
									</div>
								</div>

								<div class='text-right mt-2 mt-md-0'>
									<a href='{$file_url}' target='_blank' class='btn btn-outline-primary btn-sm mb-1 btn-view-file' data-file='{$file_name}' title='View File'>
										<span class='feather icon-eye'></span>
									</a>
									<button type='button' class='btn btn-outline-info btn-sm mb-1 btn-edit-item' data-id='{$employee_attachment_id}' title='Edit Attachment'>
										<span class='feather icon-edit'></span>
									</button>
									<button type='button' class='btn btn-outline-danger btn-sm mb-1 btn-del-item' data-id='{$employee_attachment_id}' title='Delete Attachment'>
										<span class='feather icon-trash-2'></span>
									</button>
								</div>
							</div>
						</div>
					</div>";
				}

				$html .= "</div>";

			} else {
				$get_emp = "SELECT first_name FROM mgmt_employees WHERE employee_id = '$employee_id' LIMIT 1";
				$res_emp = $conn->query($get_emp);
				if ($res_emp && $res_emp->num_rows > 0) {
					$emp_row = $res_emp->fetch_assoc();
					$first_name = $emp_row['first_name'];
				}

				$html .= "
				<div class='text-center py-5 text-muted'>
					<div class='mb-2'><i class='feather icon-folder' style='font-size:32px;'></i></div>
					<div class='font-weight-bold'>No attachment yet</div>
					<small>This employee has no uploaded attachments yet.</small>
				</div>";
			}

			$result->free();
		}

		echo json_encode(array(
			"html" => $html,
			"first_name" => $first_name
		));
		exit;
	}
?>