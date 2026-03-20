
<head>
	<!-- META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- Favicon icon -->
	<link rel="icon" type="image/x-icon" href="/mywiz/pkg/assets/media/logo-wiz.ico?v=1">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.4.6/dist/css/tom-select.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	
	
	<link rel="stylesheet" href="../pkg/css/style.css">
	<link rel="stylesheet" href="../pkg/assets/plugins/datatables/datatables.css">
	<link rel="stylesheet" href="../pkg/assets/plugins/sweetalert/swal.css">
	<link rel="stylesheet" href="../pkg/assets/plugins/animation/css/animate.min.css">
	<link rel="stylesheet" href="../pkg/assets/fonts/fontawesome/css/fontawesome-all.min.css">
</head>
<script>
	(function () {
		const STORAGE_KEY = 'site-theme-mode';
		const saved = localStorage.getItem(STORAGE_KEY) || 'auto';
		const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
		const effective = saved === 'auto' ? (systemDark ? 'dark' : 'light') : saved;

		document.documentElement.classList.remove('theme-dark', 'theme-light');
		document.documentElement.classList.add(effective === 'dark' ? 'theme-dark' : 'theme-light');
	})();
</script>