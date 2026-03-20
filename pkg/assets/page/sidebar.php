<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="../home/dashboard" class="b-brand">
					<img src="../pkg/assets/media/logo.svg" alt="" style="height:2rem;" class="logo images">
					<img src="../pkg/assets/media/logo-icon.svg" alt=""style="height:1rem;" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">

					<!-- DEFAULT USER -->
					<li class="nav-item pcoded-menu-caption">
						<label>Home</label>
					</li>
					<li class="nav-item">
						<a href="../home/dashboard" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-calendar2"></i></i></span><span class="pcoded-mtext">Leave Portal</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../home/leave-portal" class="">File a Leave</a></li>
							<li class=""><a href="../home/leave-record" class="">Leave Record</a></li>
						</ul>
					</li>
					<!-- WILL BE ACTIVATED SOON -->
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Evaluation</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">Evaluate</a></li>
							<li class=""><a href="#" class="">My Rating</a></li>
						</ul>
					</li>
					<!-- ADMINISTRATOR -->
					<li class="superadmin d-none nav-item pcoded-menu-caption">
						<label>Administrator</label>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-archive"></i></span><span class="pcoded-mtext">Archives</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">Forms Categories</a></li>
							<li class=""><a href="#" class="">Evaluation Archives</a></li>
							<li class=""><a href="../leave/archive" class="">Leave Archives</a></li>
							<li class=""><a href="#" class="">Overtime Archives</a></li>
							<li class=""><a href="#" class="">Travel Order Archives</a></li>
						</ul>
					</li>
					<li class="admin-permission superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-codepen"></i></span><span class="pcoded-mtext">Organization</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../management/branch" class="">Branch</a></li>
							<li class=""><a href="../management/department" class="">Department / Group</a></li>
							<li class=""><a href="../management/designation" class="">Designation</a></li>
							<li class=""><a href="../management/employee" class="">Employee</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item">
						<a href="../home/dashboard" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Post an Announcement</span></a>
					</li>


					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Evaluation Management</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">Evaluation Categories</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clock"></i></span><span class="pcoded-mtext">Overtime Management</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">Overtime Categories</a></li>
						</ul>
					</li>
				
					<!-- HUMAN RESOURCE SECTION -->
					<li class="hr-permission superadmin d-none nav-item pcoded-menu-caption">
						<label>Human Resource</label>
					</li>
					<li class="hr-permission superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-calendar2-event"></i></i></span><span class="pcoded-mtext">Leave Management</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../leave/archive" class="">Leave Archives</a></li>
							<li class=""><a href="../leave/type" class="">Leave Types</a></li>
							<li class=""><a href="../leave/entitlement" class="">Leave Entitlements</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
					<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-luggage"></i></span><span class="pcoded-mtext">Travel Orders</span></a>
					<ul class="pcoded-submenu">
						<li class=""><a href="#" class="">Format to be Updated</a></li>
					</ul>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
					<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-luggage"></i></span><span class="pcoded-mtext">Payroll</span></a>
					<ul class="pcoded-submenu">
						<li class=""><a href="#" class="">Format to be Updated</a></li>
					</ul>

					<!-- INVENTORY SECTION -->
					<li class="superadmin d-none nav-item pcoded-menu-caption">
						<label>Inventory</label>
					</li>
					<li class="nav-item superadmin d-none">
						<a href="../inventory/dashboard" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Summary</span></a>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-inbox"></i></span><span class="pcoded-mtext">Master Data</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../inventory/products" class="">Products</a></li>
							<li class=""><a href="../inventory/categories" class="">Categories</a></li>
							<li class=""><a href="../inventory/warehouse" class="">Warehouse</a></li>
							<li class=""><a href="../inventory/suppliers" class="">Units</a></li>
							<li class=""><a href="../inventory/brands" class="">Brands/Manufacturers</a></li>
							<li class=""><a href="../inventory/suppliers" class="">Suppliers</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-bag-heart"></i></span><span class="pcoded-mtext">Purchasing</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../inventory/purchase" class="">Purchase</a></li>
							<li class=""><a href="../inventory/purchase" class="">Receiving</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-inbox"></i></span><span class="pcoded-mtext">Stock Operations</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../inventory/products" class="">Stocks On Hand</a></li>
							<li class=""><a href="../inventory/categories" class="">Transfers</a></li>
							<li class=""><a href="../inventory/warehouse" class="">Adjustments</a></li>
							<li class=""><a href="../inventory/brands" class="">Stock Count</a></li>
						</ul>
					</li>
					<li class="superadmin d-none nav-item pcoded-hasmenu">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-bag-heart"></i></span><span class="pcoded-mtext">POS Settings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">Dashboard</a></li>
							<li class=""><a href="#" class="">Customers</a></li>
							<li class=""><a href="#" class="">Sales</a></li>
							<li class=""><a href="#" class="">Discounts/Coupons</a></li>
						</ul>
					</li>
					<!-- FINANCE SECTION -->
					<li class="nav-item pcoded-menu-caption superadmin d-none">
						<label>Finance</label>
					</li>
					<li class="nav-item pcoded-hasmenu superadmin d-none">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-bar-chart"></i></span><span class="pcoded-mtext">Summary</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">To be updated</a></li>
						</ul>
					</li>

					<!-- Sales & Marketing -->
					<li class="nav-item pcoded-menu-caption superadmin d-none">
						<label>Sales & Marketing</label>
					</li>
					<li class="nav-item pcoded-hasmenu superadmin d-none">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-inbox"></i></span><span class="pcoded-mtext">Product Settings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="#" class="">To be updated</a></li>
						</ul>
					</li>

					<!-- Information Technology -->
					<li class="nav-item pcoded-menu-caption superadmin d-none">
						<label>Projects & Operations</label>
					</li>
					<li class="nav-item pcoded-hasmenu operations superadmin d-none">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-tools"></i></i></span><span class="pcoded-mtext">Project</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../project/dashboard" class="">Dashboard</a></li>
							<li class=""><a href="../project/projects" class="">Project</a></li>
							<li class=""><a href="#" class="">Maintenance</a></li>
						</ul>
					</li>


					<!-- SUPER ADMIN SECTION WHICH HAS ACCESS TO ALL -->
					<li class="superadmin nav-item pcoded-menu-caption d-none">
						<label>Super Administrator</label>
					</li>
					<li class="superadmin nav-item pcoded-hasmenu d-none">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Org Settings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../admin/access" class="">Access Level</a></li>
							<li class=""><a href="../admin/permissions" class="">Permissions</a></li>
							<li class=""><a href="../admin/enroll" class="">Superadmin Enroll</a></li>
						</ul>
					</li>
					<li class="superadmin nav-item pcoded-hasmenu d-none">
						<a href="#" class="nav-link"><span class="pcoded-micon"><i class="bi bi-gear-wide-connected"></i></span><span class="pcoded-mtext">Page Settings</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="../admin/settings" class="">Company Information</a></li>
							<li class=""><a href="../admin/permissions" class="">Permissions</a></li>
							<li class=""><a href="../admin/enroll" class="">Superadmin Enroll</a></li>
						</ul>
					</li>

					<!-- BREAKER -->
					<li style="margin:8rem 0 8rem 0;">
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->