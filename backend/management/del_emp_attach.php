<?php
	session_start();
	error_reporting(0);
	include('../../config/cfg.php');

	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id'])) {
			$pkid = (int)$_GET['id'];

			$get = "SELECT file_name FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid' LIMIT 1";
			$res = $conn->query($get);

			if($res && $res->num_rows > 0){
				$row = $res->fetch_assoc();
				$file_name = $row['file_name'];
			}else{
				echo "err";
				exit;
			}

			$sql = "DELETE FROM mgmt_employee_attachments WHERE employee_attachment_id = '$pkid'";
			if ($conn->query($sql) === TRUE) {

				if(!empty($file_name)){
					$file_path = "../../uploads/employee_attachments/" . basename($file_name);
					if(file_exists($file_path)){
						@unlink($file_path);
					}
				}

				echo "true";
				exit;
			}else{
				echo "err";
				exit;
			}
		}
	}
?>