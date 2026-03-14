<?php
function check_permission($required_permission_classes) {
	if (!isset($_SESSION['permission_classes']) || !array_intersect($required_permission_classes, $_SESSION['permission_classes'])) {
		header('Location: ../restrict/403.php');
		exit;
	}
}
?>