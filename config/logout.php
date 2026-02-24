
<?php
	session_start();
	error_reporting(0);
	include('cfg.php');
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 60*60,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	unset($_SESSION['adminlogin']);
	unset($_SESSION['login']);
	unset($_SESSION['branch']);
	unset($_SESSION['level']);	
	unset($_SESSION['permissions']);
	session_destroy();
?>