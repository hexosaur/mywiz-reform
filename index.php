<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/c/c8/National_Power_Corporation_%28NAPOCOR%29.svg">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,200&family=Roboto:wght@100;300;400;500;900&display=swap&family=Roboto:wght@100;300;400;500;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
	<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
	<title>Login Page</title>
	<link rel="stylesheet" href="pkg/css/login.css">
	<style>
		input[type=number]::-webkit-outer-spin-button,
		input[type=number]::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
	</style>
</head>
<body>

<div class="login-container">
	<div class="login-form">
		<img class="logo" src="pkg/assets/media/img/logo-text.png" alt="">
		<!-- <h3>My Wiz Portal</h3> -->
		<form action="#" method="post">
			<input id="username" type="text" name="username" placeholder="Enter your user ID" required>
			<input id="password" type="password" name="password" placeholder="Enter your password" required>
			<div class="submit">Sign in</div>
			<div class="display_view">
				<a href="#">Proceed to display</a>
			</div>
		</form>
	</div>
	<!-- <div class="login-image"></div> -->

	<div class="login-video">
		<video autoplay muted loop playsinline>
			<source src="pkg/assets/media/video/default.mp4" type="video/mp4">
			Your browser does not support the video tag.
		</video>
	</div>
</div>

<!-- Copyright outside the card -->
<p class="copyright">Copyright © 2024 onwards, <a href="https://www.wizmaster.ph">Wizmaster Corporation </a> by hexosaur</p>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>$(document).ready(function(){

	// $('#username').on('keydown', function() {
	// 	if (event.key.toLowerCase() === 'e') {
	// 		event.preventDefault();
	// 	}
	// 	if (event.key.toLowerCase() === '+') {
	// 		event.preventDefault();
	// 	}
	// 	if (event.key.toLowerCase() === '-') {
	// 		event.preventDefault();
	// 	}
	// 	if (event.key.toLowerCase() === '.') {
	// 		event.preventDefault();
	// 	}
	// });
	function handleLogin() {
		var pass = $('#password').val();
		var user = $('#username').val();
		var data = { user: user, pass: pass}
		var temp = JSON.stringify(data);
		// console.log(temp);
		if (user === '' || pass === '') {
			console.log("Username and password are required.");
		} else{
			// console.log(temp);
			$.post("cfg/login.php", { login: temp}, function (data) {
				data = data.trim();
				// console.log(data);
				if(data == 'err_acc'){
					Swal.fire({icon: 'error', title: 'Fail! wrong username or password', showConfirmButton: false, timer: 2500});
				}else if (data != ""){
					window.location.href = 'home/dashboard.php';
				}else{
					Swal.fire({icon: 'error',title: "Failure to login! Account doesn't exist",showConfirmButton: false,timer:1000});
				}
			});
		} 

		
	}
	$('.submit').click(function() {
		handleLogin();
		// location.href="home/dashboard.php";
	});
	$('#password, #username').keypress(function(event) {
		if (event.which === 13) { // 13 is the Enter key code
			handleLogin();
		}
	});
	$(".display_view").click(function(){
		location.href="display/index.php";
	})
});
</script>
</body>
</html>
