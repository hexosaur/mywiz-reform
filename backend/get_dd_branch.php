<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');
	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465') {
			$sql = "SELECT * FROM `mgmt_branch`";
			$select;
			if($result = $conn->query($sql)){
				if($result->num_rows > 0){
					$select.="<option disabled value='0'>Select Branch</option>";
					while($row = $result->fetch_array()){ 
					 	$select .= "<option value=".$row['branch_id'].">".$row['branch_name']."</option>";
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