<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if(true){
	if (isset($_POST['branch'])){
		$branch = json_decode($_POST['branch']);

		$branch_name =  $conn->real_escape_string($branch->branch_name);
		$branch_code =  $conn->real_escape_string($branch->branch_code);
		$prov_id = (int)$branch->prov_id;
		$city_id = (int)$branch->city_id;
		$brgy_id = (int)$branch->brgy_id;
		$addr = $conn->real_escape_string($branch->addr);
		$branch_id = (int)$branch->pkid;
		$pcd = true;
		if($branch_id == 0){
			$exst_name = "SELECT 1 FROM mgmt_branch WHERE branch_name = '$branch_name' LIMIT 1";
			if($conn->query($exst_name)->num_rows > 0){
				echo "exist_name";
				exit;
			}

			$exst_code = "SELECT 1 FROM mgmt_branch WHERE branch_code = '$branch_code' LIMIT 1";
			if($conn->query($exst_code)->num_rows > 0){
				echo "exist_code";
				exit;
			}

		} else {
			$exst_name_update = "SELECT 1 FROM mgmt_branch WHERE branch_name = '$branch_name' AND branch_id != '$branch_id' LIMIT 1";
			if($conn->query($exst_name_update)->num_rows > 0){
				echo "exist_name";
				exit;
			}
			$exst_code_update = "SELECT 1 FROM mgmt_branch WHERE branch_code = '$branch_code' AND branch_id != '$branch_id' LIMIT 1";
			if($conn->query($exst_code_update)->num_rows > 0){
				echo "exist_code";
				exit;
			}
		}

		// ===== INSERT / UPDATE =====
		if($branch_id == 0){

			$sql = "INSERT INTO mgmt_branch(branch_name, branch_code, prov_id, city_id, brgy_id, address_line) VALUES ('$branch_name', '$branch_code', '$prov_id', '$city_id', '$brgy_id', '$addr')";
			if ($conn->query($sql) !== TRUE) {
				$pcd = false;
				echo "err";
				exit;
			}
			if($pcd) {
				echo "true";
			} else {
				echo "err";
				exit;
			}

		} else {
			$sql = "UPDATE mgmt_branch 
					SET branch_name = '$branch_name', 
						branch_code = '$branch_code', 
						prov_id = '$prov_id', 
						city_id = '$city_id', 
						brgy_id = '$brgy_id', 
						address_line = '$addr'
					WHERE branch_id = '$branch_id'";

			if ($conn->query($sql) === TRUE) {
				echo "true";
				exit;
			} else {
				echo "err";
				exit;
			}
		}
	}
}
?>
