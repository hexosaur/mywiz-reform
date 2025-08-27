<div id="layoutSidenav_nav">
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
		<div class="sb-sidenav-menu">
			<div class="nav">
				<div class="sb-sidenav-menu-heading">Home</div>
				<!-- DASHBOARD -->
				<a class="nav-link" href="../home/dashboard">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard
				</a>
				<!-- LEAVE -->
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLeave" aria-expanded="false" aria-controls="collapseLeave">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Leave Portal<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLeave" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link" href="layout-static.html">Leave Requests</a>
						<a class="nav-link" href="layout-static.html">File a Leave</a>
						<a class="nav-link" href="layout-sidenav-light.html">Leave Logs</a>
					</nav>
				</div>
				<!-- EVALUATION -->
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEvaluate" aria-expanded="false" aria-controls="collapseEvaluate">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Evaluation<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseEvaluate" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link" href="layout-static.html">Evaluate</a>
						<a class="nav-link" href="layout-sidenav-light.html">Peer Eval</a>
					</nav>
				</div>
				<!-- PAYSLIP -->
				<a class="nav-link" href="index.php">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Payslip
				</a>
				


				<!-- ADMIN AREA -->
				<div class="sb-sidenav-menu-heading">Administrator</div>
				<!-- Organizational Setup -->
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrgSetup" aria-expanded="false" aria-controls="collapseOrgSetup">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Organization<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseOrgSetup" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link" href="../management/branch">Branch Management</a>
						<a class="nav-link" href="../management/department">Dept. Management</a>
						<a class="nav-link" href="../management/job">Job Management</a>
						<a class="nav-link" href="../management/employee">Employee Management</a>
					</nav>
				</div>
				<!-- Leave Management -->
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLeaveMgmt" aria-expanded="false" aria-controls="collapseLeaveMgmt">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Leave Management<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLeaveMgmt" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link" href="layout-static.html">Leave Categories</a>
						<a class="nav-link" href="layout-static.html">Leave Archives</a>
					</nav>
				</div>
				<!-- ACCOUNTING -->
				<!-- OPERATIONS -->




				<!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
					Layouts
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav">
						<a class="nav-link" href="layout-static.html">Static Navigation</a>
						<a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
					</nav>
				</div>
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
					<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
					Pages
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
						<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
							Authentication
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link" href="login.html">Login</a>
								<a class="nav-link" href="register.html">Register</a>
								<a class="nav-link" href="password.html">Forgot Password</a>
							</nav>
						</div>
						<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
							Error
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link" href="401.html">401 Page</a>
								<a class="nav-link" href="404.html">404 Page</a>
								<a class="nav-link" href="500.html">500 Page</a>
							</nav>
						</div>
					</nav>
				</div>
				<div class="sb-sidenav-menu-heading">Addons</div>
				<a class="nav-link" href="charts.html">
					<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
					Charts
				</a>
				<a class="nav-link" href="tables.html">
					<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
					Tables
				</a> -->
			</div>
		</div>
		<div class="sb-sidenav-footer">
			<div class="small">Logged in as:</div>
			Full Name here
		</div>
	</nav>
</div>