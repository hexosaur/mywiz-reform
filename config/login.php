<?php
	session_start();
	error_reporting(0);
	include('../cfg/config.php');
	if (isset($_POST['login'])) {
		$data = json_decode($_POST['login']);
		$user = $data->user;
		$pass = sha1(md5($data->pass));
		$sqlA = "SELECT * FROM `superadmin` WHERE wiz_user = '$user' AND wiz_pass = '$pass' AND wiz_ol = '1'";
		$sqlE = "SELECT * FROM `employee` WHERE emp_user = '$user' AND emp_pass = '$pass' AND active = '1'";
		if ($result = $conn->query($sqlA)) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_array()){ 
					$admID = $row['wiz_id'];
					$_SESSION['adminlogin'] = $admID;
					$_SESSION['level'] = $row['lvl'];
					$_SESSION['table'] = "superadmin";
					$_SESSION['branch'] = "super";
				}
				echo $_SESSION['adminlogin'];
				$result->free();
			}
		}
		if ($result = $conn->query($sqlE)) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_array()){ 
					$empID = $row['emp_id'];
					$_SESSION['login'] = $empID;
					$_SESSION['level'] = $row['accl'];
					$_SESSION['table'] = "employee";
					$_SESSION['branch'] = $row['fac_id'];
				}
				echo $_SESSION['login'];
				$result->free();
			}
		}
	}
?>