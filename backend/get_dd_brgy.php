<?php
	session_start();
	error_reporting(0);
	include('../config/cfg.php');
	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465'&& isset($_GET['id']) ) {
			$city_id = $_GET['id'];
			$sql = "SELECT * FROM `ref_barangays` WHERE `city_id` = '$city_id'";
			$select;
			if($result = $conn->query($sql)){
				if($result->num_rows > 0){
					$select.="<option disabled selected>Select Barangay</option>";
					while($row = $result->fetch_array()){ 
					 	$select .= "<option value=".$row['brgy_id'].">".$row['brgy_name']."</option>";
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