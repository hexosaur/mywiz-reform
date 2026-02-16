<?php
	session_start();
	error_reporting(E_ALL);
	include('../config/cfg.php');
	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465'&& isset($_GET['id']) ) {
			$prov_id = $_GET['id'];
			$sql = "SELECT * FROM `ref_cities` WHERE `prov_id` = '$prov_id'";
			$select="";
			if($result = $conn->query($sql)){
				if($result->num_rows > 0){
					$select.="<option disabled selected>Select City</option>";
					while($row = $result->fetch_array()){ 
					 	$select .= "<option value=".$row['city_id'].">".$row['city_name']."</option>";
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