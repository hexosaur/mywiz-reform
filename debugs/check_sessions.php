<?php
	$sess = [
	"table"  => $_SESSION['table'] ?? null,
	"login"  => $_SESSION['login'] ?? null,
	"adminlogin" => $_SESSION['adminlogin'] ?? null,
	"branch" => $_SESSION['branch'] ?? null,
	"level"  => $_SESSION['level'] ?? null,
	"role_id" => $_SESSION['role_id'] ?? null,
	"permissions" => $_SESSION['permissions'] ?? [],
	"permission_classes" => $_SESSION['permission_classes'] ?? []
	];
?>
<script>
	window.APP_SESSION = <?= json_encode($sess, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
</script>