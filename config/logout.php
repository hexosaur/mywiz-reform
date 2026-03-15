<?php
session_start();
error_reporting(0);
include('cfg.php');
if (!empty($_COOKIE['remember_me'])) {
    $parts = explode(":", $_COOKIE['remember_me'], 2);
    if (count($parts) === 2) {
        $selector = $parts[0];
        $del = $conn->prepare("DELETE FROM auth_remember_tokens WHERE selector=?");
        $del->bind_param("s", $selector);
        $del->execute();
    }
    setcookie("remember_me", "", time() - 3600, "`/");
}
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

unset($_SESSION['adminlogin']);
unset($_SESSION['login']);
unset($_SESSION['branch']);
unset($_SESSION['level']);
unset($_SESSION['permissions']);
unset($_SESSION['permission_classes']);
unset($_SESSION['role_id']);
session_destroy();
?>