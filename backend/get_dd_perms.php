<?php
session_start();
error_reporting(0);
include('../config/cfg.php');

if(true){
	if (isset($_GET['security']) && $_GET['security'] == '123465') {
		$sql = "SELECT permission_id, permission_title FROM mgmt_permissions";
		$select = "";
		if($result = $conn->query($sql)){
			if($result->num_rows > 0){
				$select .= "<option disabled>Select Permission</option>";
				while($row = $result->fetch_array()){ 
					$select .= "<option value=".$row['permission_id'].">".$row['permission_title']."</option>";
				}
				$result->free();
			}
			echo $select;
			exit;
		} else {
			echo "";
		}
	}
}
?>
