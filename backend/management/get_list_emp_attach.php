<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if (isset($_GET['security']) && $_GET['security'] == '123465') {

		$sql = "SELECT 
					e.employee_id,
					CONCAT_WS(' ',
						e.first_name,
						CASE 
							WHEN e.middle_name IS NOT NULL AND e.middle_name != '' 
							THEN CONCAT(LEFT(e.middle_name,1),'.')
							ELSE NULL
						END,
						e.surname,
						CASE 
							WHEN e.suffix IS NOT NULL AND e.suffix != '' AND e.suffix != 'N/A'
							THEN e.suffix
							ELSE NULL
						END
					) AS employee_name,
					COUNT(ea.employee_attachment_id) AS attachment_count,
					GROUP_CONCAT(
						DISTINCT rat.type_name 
						ORDER BY rat.sort_order ASC, rat.type_name ASC 
						SEPARATOR ', '
					) AS attachment_types
				FROM mgmt_employees e
				LEFT JOIN mgmt_employee_attachments ea
					ON ea.employee_id = e.employee_id
				LEFT JOIN ref_attachment_types rat
					ON rat.attachment_type_id = ea.attachment_type_id
				GROUP BY e.employee_id, e.first_name, e.middle_name, e.surname, e.suffix
				ORDER BY employee_name ASC";

		$n = 1;
		$table = "";

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {

					$employee_id = (int)$row['employee_id'];
					$employee_name = htmlspecialchars($row['employee_name'] ?? '', ENT_QUOTES, 'UTF-8');
					$attachment_count = (int)$row['attachment_count'];
					$attachment_types = $row['attachment_types'];

					if (!empty($attachment_types)) {
						$type_list = "";
						$types = explode(', ', $attachment_types);
						foreach ($types as $type) {
							$type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
							$type_list .= "<span class='badge badge-info border mr-1 mb-1'>{$type}</span>";
						}
					} else {
						$type_list = "<span class='text-muted font-italic'>No attachment yet</span>";
					}

					$view_btn = "";
					$edit_btn = "";

					if ($attachment_count > 0) {
						
						$edit_btn = "<div class='btn btn-outline-info btn-sm btn-edit' data-id='{$employee_id}' title='Manage Attachments'><span class='bi bi-info-lg'></span></div>";
					} else {
						
						$edit_btn = "<div class='btn btn-outline-info btn-sm' style='opacity:.45; cursor:not-allowed;' title='No Attachments Yet'><span class='bi bi-info-lg'></span></div>";
					}

					$add_btn = "<div class='btn btn-outline-primary btn-sm btn-add' data-id='{$employee_id}' title='Add Attachment'><span class='feather icon-plus'></span></div>";

					$table .= "<tr>
						<td class='text-center'>{$n}</td>
						<td data-column='Employee: '>{$employee_name}</td>
						<td data-column='Attachment Types: '>{$type_list}</td>
						<td class='text-center' data-column='Action: '>
							{$add_btn}
							{$edit_btn}
						</td>
					</tr>";

					$n++;
				}
				$result->free();
			}
		}

		echo $table;
		exit;
	}
?>