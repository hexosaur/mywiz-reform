<?php
	// session_start();
	$sess = [
	"table"  => $_SESSION['table'] ?? null,
	"login"  => $_SESSION['login'] ?? null,
	"adminlogin" => $_SESSION['adminlogin'] ?? null,
	"branch" => $_SESSION['branch'] ?? null,
	"level"  => $_SESSION['level'] ?? null,
	"role_id" => $_SESSION['role_id'] ?? null,
	// if you store permissions, this can be big; still okay if small
	"permissions" => $_SESSION['permissions'] ?? []
	];
?>
<script>
	window.APP_SESSION = <?= json_encode($sess, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
	// console.log("APP_SESSION:", window.APP_SESSION);
</script>