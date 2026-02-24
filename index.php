<!DOCTYPE html>
<html lang="en">
<?php $__t0 = microtime(true); ?>
<head>
	<!-- META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Flash Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords"
		content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Flash Able, Flash Able bootstrap admin template">
	<meta name="author" content="Codedthemes" />
	<link rel="icon" href="pkg/assets/media/logo-wiz.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

	<link rel="stylesheet" href="pkg/assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="pkg/assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="pkg/css/style.css">
	<link rel="stylesheet" href="pkg/assets/plugins/sweetalert/swal.css">
	<style>
		.login_layout{min-height:100vh;display:flex;flex-direction:column;justify-content:center}.card-container{display:flex;justify-content:center;align-items:center;flex-grow:1}.card{width:100%;max-width:500px;margin:0 auto}footer{position:fixed;bottom:0;width:100%;background-color:#f8f9fa;padding:10px;text-align:center;font-size:.9rem;border-top:1px solid #ddd}.password-toggle{cursor:pointer;font-size:1.2rem;padding:0;margin-left:-35px;position:absolute;top:50%;right:10px;transform:translateY(-50%);z-index:2}@media (max-width:768px){.card{max-width:90%}}footer small{float:right}
	</style>
</head>
<body class="bg-primary">
	<div class="login_layout" id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header">
									<h3 class="text-center font-weight-light my-4">Welcome to MyWiz <br>Login Portal</h3>
								</div>
								<div class="card-body">
									<form>
										<div class="form-floating mb-3">
											<input class="form-control" id="username" type="email" placeholder="Username" />
											<label for="username">Username</label>
										</div>
									<div class="form-floating mb-3">
											<div class="input-group">
												<input class="form-control" id="password" type="password" placeholder="Password" />
												<span class="input-group-text" id="togglePassword">
													<i class="bi bi-eye-slash"></i>
												</span>
											</div>
											<label for="password">Password</label>
										</div>
										<div class="form-check mb-3">
											<input class="form-check-input" id="password" type="checkbox" value="" />
											<label class="form-check-label" for="password">Remember Password</label>
										</div>
										<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
											<a class="small" href="password.html">Forgot Password?</a>
											<a class="btn btn-primary submit" href="#">Login</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<!-- Footer Section -->
	<footer>
		<div>
			Copyright © 2020 onwards, <a href="https://www.facebook.com/WizmasterCorporation">Wizmaster Corporation</a>.
			<small class="text-right">by engr. hexosaur</small>
		</div>
	</footer>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.6/dist/js/tom-select.complete.min.js"></script>
<script src="pkg/js/vendor-all.min.js"></script>
<script src="pkg/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="pkg/js/pcoded.min.js"></script>
<script src="pkg/assets/plugins/datatables/datatables.js"></script>
<script src="pkg/assets/plugins/sweetalert/swal.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-circle-progress@1.2.2/dist/circle-progress.min.js"></script>
<script src="pkg/js/circle-progress.js"></script>
<script src="pkg/js/scripts.js"></script>
<script src="pkg/js/jqscript.js"></script>
<?php $__ms = (microtime(true) - $__t0) * 1000; ?>
<script>
	console.log("PHP exec (ms): <?= number_format($__ms, 2) ?>");
</script>
<script>
	$('#togglePassword').click(function () {
		const passwordField = $('#password');
		const passwordFieldType = passwordField.attr('type');

		// Toggle password visibility
		if (passwordFieldType === 'password') {
			passwordField.attr('type', 'text');  // Change to text
			$(this).find('i').removeClass('bi-eye-slash').addClass('bi-eye');  // Change icon
		} else {
			passwordField.attr('type', 'password');  // Change back to password
			$(this).find('i').removeClass('bi-eye').addClass('bi-eye-slash');  // Change icon
		}
	});

	function handleLogin() {
		var pass = $('#password').val();
		var user = $('#username').val();
		var data = { user: user, pass: pass}
		console.log(data);
		if (user === '' || pass === '') {
			console.log("Username and password are required.");
			Swal.fire({icon: 'error',title: "Fill in the information first!",showConfirmButton: false,timer:1200});
		} else{
			var temp = JSON.stringify(data);
			console.log(temp);
			$.post("config/login.php", { data: temp}, function (data) {
				data = data.trim();
				console.log(data);
				if(data == 'err_acc'){
					Swal.fire({icon: 'error', title: 'Fail! wrong username or password', showConfirmButton: false, timer: 2500});
				}else if (data != ""){
					window.location.href = 'home/dashboard';
				}else{
					Swal.fire({icon: 'error',title: "Failure to login! Account doesn't exist",showConfirmButton: false,timer:1000});
				}
			});
		} 		
	}
	$('.submit').click(function() {
		handleLogin();
		// location.href="home/dashboard";
	});
	$('#password, #username').keypress(function(event) {
		if (event.which === 13) { // 13 is the Enter key code
			handleLogin();
		}
	});



</script>
</body>
</html>