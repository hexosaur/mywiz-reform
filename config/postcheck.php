<?php 
	session_start();
	if (empty($_SESSION['adminlogin']) && empty($_SESSION['login'])) {
		header('Location: ../');
		exit();
	}
?>