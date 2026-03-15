<?php
session_start();
if (!empty($_SESSION['adminlogin']) || !empty($_SESSION['login'])) {
	header("Location: home/dashboard");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php $__t0 = microtime(true); ?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="MyWiz Login Portal" />
	<meta name="keywords" content="mywiz, login, portal, wizmaster" />
	<meta name="author" content="Wizmaster Corporation" />

	<link rel="icon" href="pkg/assets/media/logo-wiz.ico" type="image/x-icon">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="pkg/assets/fonts/fontawesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="pkg/assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="pkg/css/style.css">
	<link rel="stylesheet" href="pkg/assets/plugins/sweetalert/swal.css">

	<style>
		:root{
			--login-bg-1: #21266b;
			--login-bg-2: #4d1175;
			--login-card-bg: rgba(255,255,255,0.96);
			--login-card-shadow: 0 24px 60px rgba(11, 20, 60, 0.22);
			--login-muted: #6c757d;
			--login-title: #1b2430;
			--login-input-bg: #fff;
			--login-input-border: #d7ddea;
			--login-video-overlay: linear-gradient(180deg, rgba(7,18,40,0.05), rgba(7,18,40,0.25));
		}

		html, body {
			height: 100%;
		}

		body.login-page {
			min-height: 100vh;
			margin: 0;
			background:
				radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 30%),
				linear-gradient(135deg, var(--login-bg-1), var(--login-bg-2));
			font-family: "Mada", sans-serif;
			overflow-x: hidden;
		}

		.login-page-wrapper {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 32px 16px 88px;
		}

		.login-shell {
			width: 100%;
			max-width: 980px;
		}

		.login-card {
			display: flex;
			min-height: 450px;
			background: var(--login-card-bg);
			border-radius: 24px;
			overflow: hidden;
			box-shadow: var(--login-card-shadow);
		}

		.login-form-panel {
			width: 45%;
			min-width: 360px;
			background: rgba(255,255,255,0.98);
			padding: 42px 34px 32px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			position: relative;
			z-index: 2;
		}

		.login-brand {
			display: flex;
			align-items: center;
			gap: 12px;
			margin-bottom: 18px;
		}

		.login-brand img {
			height: 52px;
			width: auto;
			display: block;
		}

		.login-brand-text {
			line-height: 1.1;
		}

		.login-brand-text h2 {
			margin: 0;
			font-size: 1.35rem;
			font-weight: 800;
			color: var(--login-title);
		}

		.login-brand-text p {
			margin: 4px 0 0;
			font-size: .88rem;
			color: var(--login-muted);
		}

		.login-form .form-group {
			margin-bottom: 18px;
		}

		.login-form label {
			font-weight: 700;
			font-size: .92rem;
			margin-bottom: 8px;
			color: #2f3a4d;
		}

		.login-form .form-control {
			height: 48px;
			border-radius: 12px;
			border: 1px solid var(--login-input-border);
			background: var(--login-input-bg);
			padding: 12px 14px;
			box-shadow: none !important;
		}

		.login-form .form-control:focus {
			border-color: #6d85f7;
			box-shadow: 0 0 0 0.2rem rgba(109,133,247,0.12) !important;
		}

		.login-form .input-group .form-control {
			border-right: 0;
		}

		.login-form .input-group-append .input-group-text {
			border-radius: 0 12px 12px 0;
			background: #fff;
			border: 1px solid var(--login-input-border);
			border-left: 0;
			cursor: pointer;
			min-width: 52px;
			justify-content: center;
		}

		.login-form .input-group-append .input-group-text i {
			font-size: 1rem;
		}

		.login-options {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			margin-top: 4px;
			margin-bottom: 22px;
			flex-wrap: wrap;
		}

		.login-options .form-check {
			margin-bottom: 0;
		}

		.login-options a {
			font-weight: 600;
			font-size: .9rem;
		}

		.btn-login {
			height: 48px;
			border-radius: 12px;
			font-weight: 700;
			font-size: 1rem;
			width: 100%;
			box-shadow: 0 10px 24px rgba(95,124,246,.24);
		}

		.login-video-panel {
			position: relative;
			width: 58%;
			background: #091321;
			overflow: hidden;
		}

		.login-video-panel::before {
			content: "";
			position: absolute;
			inset: 0;
			background: var(--login-video-overlay);
			z-index: 1;
			pointer-events: none;
		}

		.login-video {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
			background: #091321;
		}

		.login-video-badge {
			position: absolute;
			top: 18px;
			left: 18px;
			z-index: 2;
			background: rgba(255,255,255,0.16);
			backdrop-filter: blur(8px);
			color: #fff;
			padding: 8px 12px;
			border-radius: 999px;
			font-size: .85rem;
			font-weight: 700;
			letter-spacing: .2px;
		}

		.login-video-caption {
			position: absolute;
			left: 24px;
			right: 24px;
			bottom: 24px;
			z-index: 2;
			color: #fff;
		}

		.login-video-caption h4 {
			margin: 0 0 8px;
			font-size: 1.5rem;
			font-weight: 800;
		}

		.login-video-caption p {
			margin: 0;
			font-size: .95rem;
			color: rgba(255,255,255,0.88);
			max-width: 420px;
		}

		.login-footer {
			position: fixed;
			left: 0;
			right: 0;
			bottom: 0;
			padding: 12px 18px;
			background: rgba(255,255,255,0.88);
			backdrop-filter: blur(10px);
			border-top: 1px solid rgba(0,0,0,0.06);
			z-index: 10;
		}

		.login-footer-wrap {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			font-size: .9rem;
			flex-wrap: wrap;
		}

		.login-footer small {
			color: #6c757d;
		}

		@media (max-width: 991.98px) {
			.login-card {
				flex-direction: column;
				min-height: unset;
			}

			.login-form-panel,
			.login-video-panel {
				width: 100%;
			}

			.login-form-panel {
				min-width: 100%;
				padding: 28px 22px 24px;
			}

			.login-video-panel {
				min-height: 280px;
				order: -1;
			}

			.login-video-caption h4 {
				font-size: 1.2rem;
			}

			.login-video-caption p {
				font-size: .88rem;
			}
		}

		@media (max-width: 575.98px) {
			.login-page-wrapper {
				padding: 16px 10px 86px;
			}

			.login-card {
				border-radius: 18px;
			}

			.login-form-panel {
				padding: 22px 16px 18px;
			}

			.login-brand img {
				height: 44px;
			}

			.login-video-panel {
				min-height: 220px;
			}

			.login-footer-wrap {
				justify-content: center;
				text-align: center;
			}
		}
	</style>
</head>

<body class="login-page">
	<div class="login-page-wrapper">
		<div class="login-shell">
			<div class="login-card">

				<div class="login-form-panel">
					<div class="login-brand">
						<!-- <img src="pkg/assets/media/logo.svg" alt="Wizmaster Logo"> -->
						<div class="login-brand-text">
							<h2>Sign In</h2>
							<p>Wizmaster Corporation</p>
						</div>
					</div>
					<form id="loginForm" class="login-form" autocomplete="off">
						<div class="form-group">
							<label for="username">Username</label>
							<input class="form-control" id="username" type="text" placeholder="Enter your username">
						</div>

						<div class="form-group" >
							<label for="password">Password</label>
							<div class="input-group" style="background:transparent">
								<input class="form-control" id="password" type="password" placeholder="Enter your password" ">
								<div class="input-group-append">
									<span class="input-group-text" id="togglePassword">
										<i class="bi bi-eye-slash"></i>
									</span>
								</div>
							</div>
						</div>

						<div class="login-options">
							<div class="form-check">
								<input class="form-check-input" id="remember_me" type="checkbox">
								<label class="form-check-label" for="remember_me">Keep me logged in</label>
							</div>
							<a href="password.html">Forgot Password?</a>
						</div>

						<button type="button" class="btn btn-primary btn-login submit">Login</button>
					</form>
				</div>

				<div class="login-video-panel">
					<div class="login-video-badge">
						<i class="bi bi-play-circle-fill mr-1"></i> mywiz Portal
					</div>

					<video
						class="login-video"
						autoplay
						muted
						loop
						playsinline
						preload="metadata"
						disablepictureinpicture
						controlslist="nodownload nofullscreen noremoteplayback"
					>
						<source src="pkg/assets/media/video/default.mp4" type="video/mp4">
					</video>

					<div class="login-video-caption">
						<h4>Smarter access. Faster workflow.</h4>
						<p>Manage records, employees, and internal workflows from one modern portal.</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	<footer class="login-footer">
		<div class="login-footer-wrap">
			<div>
				Copyright © 2020 onwards,
				<a href="https://www.facebook.com/WizmasterCorporation" target="_blank" rel="noopener noreferrer">Wizmaster Corporation</a>.
			</div>
			<small>by engr. hexosaur</small>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
	<script src="pkg/assets/plugins/sweetalert/swal.js"></script>

	<?php $__ms = (microtime(true) - $__t0) * 1000; ?>
	<script>
		console.log("PHP exec (ms): <?= number_format($__ms, 2) ?>");
	</script>

	<script>
		$('#togglePassword').on('click', function () {
			const passwordField = $('#password');
			const icon = $(this).find('i');
			const isPassword = passwordField.attr('type') === 'password';

			passwordField.attr('type', isPassword ? 'text' : 'password');
			icon.toggleClass('bi-eye-slash bi-eye');
		});

		function handleLogin() {
			var pass = $('#password').val().trim();
			var user = $('#username').val().trim();
			var remember = $('#remember_me').is(':checked') ? 1 : 0;
			var data = { user: user, pass: pass, remember: remember };

			if (user === '' || pass === '') {
				Swal.fire({
					icon: 'error',
					title: 'Fill in the information first!',
					showConfirmButton: false,
					timer: 1200
				});
				return;
			}

			var temp = JSON.stringify(data);

			$('.submit').prop('disabled', true).text('Signing in...');

			$.post("config/login.php", { data: temp }, function (data) {
				data = data.trim();

				if (data === 'err_acc') {
					Swal.fire({
						icon: 'error',
						title: 'Fail! Wrong username or password',
						showConfirmButton: false,
						timer: 2500
					});
				} else if (data !== "") {
					window.location.href = 'home/dashboard';
					return;
				} else {
					Swal.fire({
						icon: 'error',
						title: "Failure to login! Account doesn't exist",
						showConfirmButton: false,
						timer: 1200
					});
				}
			}).fail(function () {
				Swal.fire({
					icon: 'error',
					title: 'Unable to connect to the server',
					showConfirmButton: false,
					timer: 1800
				});
			}).always(function () {
				$('.submit').prop('disabled', false).text('Login');
			});
		}

		$('.submit').on('click', function (e) {
			e.preventDefault();
			handleLogin();
		});

		$('#loginForm').on('submit', function (e) {
			e.preventDefault();
			handleLogin();
		});

		$('#password, #username').on('keypress', function(event) {
			if (event.which === 13) {
				event.preventDefault();
				handleLogin();
			}
		});
	</script>
</body>
</html>