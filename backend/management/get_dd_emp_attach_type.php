<?php
	session_start();
	error_reporting(E_ALL);
	include('../../config/cfg.php');
	if(true){
		if (isset($_GET['security']) && $_GET['security'] == '123465') {
			$sql = "SELECT * FROM `ref_attachment_types` ORDER BY `sort_order` ASC, `type_name` ASC";
			$select = "";
			if($result = $conn->query($sql)){
				if($result->num_rows > 0){
					$select .= "<option disabled selected>Select Attachment Type</option>";
					while($row = $result->fetch_array()){
					 	$select .= "<option value=".$row['attachment_type_id'].">".$row['type_name']."</option>";
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