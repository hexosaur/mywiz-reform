<?php
    session_start();
	error_reporting(0);
	include('../config/cfg.php');
	if(true){
		if ( isset($_GET['security']) && $_GET['security'] == '123465' && isset($_GET['id']) ) {
			$pkid = $_GET['id'];
			$sql = "DELETE FROM mgmt_permissions WHERE permission_id = '$pkid'";
			if ($conn->query($sql) === TRUE) {
				echo "true";
				exit;
			}else{
				echo $conn->error;
			}				
		}	
	}
?>	

