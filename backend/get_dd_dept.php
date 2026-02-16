<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');
	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465') {
			$sql = "SELECT * FROM `mgmt_departments`";
			$select;
			if($result = $conn->query($sql)){
				if($result->num_rows > 0){
					$select.="<option disabled selected>Select Departments</option>";
					while($row = $result->fetch_array()){ 
					 	$select .= "<option value=".$row['department_id'].">".$row['department_name']."</option>";
					}
					$result->free();
				}
				echo $select;
				exit;
			}else{
				echo "";
			}
		}
	}
?>