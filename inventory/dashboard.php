<?php include('../config/postcheck.php') ?>

<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<body>
=======
<html lang="en">`
<?php include('../pkg/assets/page/head.php')?>
<body class="">
>>>>>>> 58032dd011639852ee5af109168b61c6e2bcc140
	<?php include('../pkg/assets/page/sidebar.php')?>
	<?php include('../pkg/assets/page/navbar.php')?>

	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<div class="page-header">
								<div class="page-block">
									<div class="d-flex justify-content-between align-items-start flex-nowrap dashboard-head">
										<div class="dashboard-head-left pr-2">
											<div class="page-header-title">
												<h5 class="mb-1">Summary</h5>
											</div>
											<ul class="breadcrumb mb-0">
												<li class="breadcrumb-item">
													<a href="../inventory/dashboard"><i class="feather icon-home"></i></a>
												</li>
												<li class="breadcrumb-item">
													<a href="#"><span class="page-title"></span></a>
												</li>
											</ul>
										</div>

										<div class="dashboard-head-right text-right pl-2">
											<h4 class="now_time mb-0">
												<span class="hour_part"></span><span class="blink_colon">:</span><span class="minute_part"></span>
												<span class="ampm_part"></span>
											</h4>
											<div class="now_date text-muted">date</div>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
<<<<<<< Updated upstream
							<div class="row">

								<!-- MINI KPI CARDS -->
								<div class="col-12 db-section-gap">
									<div class="db-grid-5">
										<div class="db-grid-col">
											<div class="card db-metric-card db-equal-card">
												<div class="card-body">
<<<<<<< HEAD
									<div class="db-metric-wrap">
										<div class="db-metric-icon text-c-blue">
											<i class="fas fa-boxes"></i>
										</div>
										<div class="db-metric-content">
											<div class="db-metric-label">Total Products</div>
											<div class="db-metric-value">1,250</div>
											<p class="db-metric-sub">Active inventory items</p>
											<div class="db-metric-action">
												<a href="../inventory/products" class="btn btn-sm btn-outline-primary">View Products</a>
											</div>
										</div>
									</div>
=======
													<div class="row">
														<div class="col db-metric-icon text-c-blue">
															<i class="fas fa-boxes"></i>
														</div>
														<div class="coldb-metric-content">
															<div class="db-metric-label">Total Products</div>
															<div class="db-metric-value">1,250</div>
															<p class="db-metric-sub">Active inventory items</p>
															
														</div>
														
													</div>
													<div class="row db-metric-action">
																<a href="../inventory/products" class="btn btn-sm btn-outline-primary">View Products</a>
															</div>
>>>>>>> 58032dd011639852ee5af109168b61c6e2bcc140
												</div>
											</div>
=======
							 <div class="row">
								<div class="col mb-4">
									<div class="db-mini-card">
										<div class="db-mini-body">
											<div class="db-mini-icon bg-blue"><i class="fas fa-boxes"></i></div>
											<div class="db-mini-content">
												<div class="db-mini-label">Total Products</div>
												<div class="db-mini-value">1,250</div>
												<p class="db-mini-sub">Active inventory items</p>
											</div>
										</div>
										<div class="db-mini-footer">
											<a href="../inventory/products" class="db-mini-link">View Products</a>
>>>>>>> Stashed changes
										</div>
									</div>
								</div>
								<div class="col mb-4">
									<div class="db-mini-card">
										<div class="db-mini-body">
											<div class="db-mini-icon bg-red"><i class="fas fa-exclamation-triangle"></i></div>
											<div class="db-mini-content">
												<div class="db-mini-label">Low Stock</div>
												<div class="db-mini-value">32</div>
												<p class="db-mini-sub">Needs reorder soon</p>
											</div>
										</div>
										<div class="db-mini-footer">
											<a href="../inventory/products" class="db-mini-link">Review Items </a>
										</div>
									</div>
								</div>
								<div class="col mb-4">
									<div class="db-mini-card">
										<div class="db-mini-body">
											<div class="db-mini-icon bg-yellow"><i class="fas fa-times-circle"></i></div>
											<div class="db-mini-content">
												<div class="db-mini-label">Out of Stock</div>
												<div class="db-mini-value">8</div>
												<p class="db-mini-sub">Unavailable products</p>
											</div>
										</div>
										<div class="db-mini-footer">
											<a href="../inventory/products" class="db-mini-link">Restock Now </a>
										</div>
									</div>
								</div>
								<div class="col mb-4">
									<div class="db-mini-card">
										<div class="db-mini-body">
											<div class="db-mini-icon bg-green"><i class="fas fa-truck-loading"></i></div>
											<div class="db-mini-content">
												<div class="db-mini-label">Total Suppliers</div>
												<div class="db-mini-value">58</div>
												<p class="db-mini-sub">Registered suppliers</p>
											</div>
										</div>
										<div class="db-mini-footer">
											<a href="../inventory/suppliers" class="db-mini-link">Open Suppliers </a>
										</div>
									</div>
								</div>
								<div class="col mb-4">
									<div class="db-mini-card">
										<div class="db-mini-body">
											<div class="db-mini-icon bg-info"><i class="fas fa-archive"></i></div>
											<div class="db-mini-content">
												<div class="db-mini-label">Warehouses</div>
												<div class="db-mini-value">9</div>
												<p class="db-mini-sub">Active locations</p>
											</div>
										</div>
										<div class="db-mini-footer">
											<a href="../inventory/warehouse" class="db-mini-link">Manage Sites </a>
										</div>
									</div>
								</div>								
							 </div>

							<div class="row">
								<!-- STOCK BY CATEGORY -->
								<div class="col-xl-4">
									<div class="card">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="mb-0">Stock by Category</h5>
											<a href="../inventory/categories" class="db-view-all">View All</a>
										</div>
										<div class="card-body">
											<div class="db-donut-wrap">
												<div class="db-donut-chart">
													<canvas id="stockCategoryChart"></canvas>
												</div>
												<div class="db-donut-legend">
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#4c6ef5"></span>Electronics</span>
														<span>33.5%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#2ca961"></span>Office</span>
														<span>24.2%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#f59f00"></span>Furniture</span>
														<span>18.7%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#e52d27"></span>Cleaning</span>
														<span>12.1%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#0288d1"></span>Misc</span>
														<span>11.5%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#0288d1"></span>Misc</span>
														<span>11.5%</span>
													</div>
													<div class="db-donut-legend-item">
														<span><span class="db-donut-legend-dot" style="background:#0288d1"></span>Misc</span>
														<span>11.5%</span>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- TOP MOVING PRODUCTS -->
								<div class="col-xl-4">
									<div class="card">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="mb-0">Top Moving Products</h5>
											<a href="../inventory/products" class="db-view-all">View All</a>
										</div>
										<div class="card-body">
											<div class="db-progress-item">
												<div class="db-progress-label">
													<span>Wireless Mouse</span>
													<small>32.9%</small>
												</div>
												<div class="progress db-progress">
													<div class="progress-bar bg-primary" style="width:32.9%"></div>
												</div>
											</div>
											<div class="db-progress-item">
												<div class="db-progress-label">
													<span>Office Desk</span>
													<small>31.4%</small>
												</div>
												<div class="progress db-progress">
													<div class="progress-bar bg-success" style="width:31.4%"></div>
												</div>
											</div>
											<div class="db-progress-item">
												<div class="db-progress-label">
													<span>Keyboard</span>
													<small>23.4%</small>
												</div>
												<div class="progress db-progress">
													<div class="progress-bar bg-warning" style="width:23.4%"></div>
												</div>
											</div>
											<div class="db-progress-item">
												<div class="db-progress-label">
													<span>Desk Organizer</span>
													<small>16.9%</small>
												</div>
												<div class="progress db-progress">
													<div class="progress-bar bg-danger" style="width:16.9%"></div>
												</div>
											</div>
											<div class="db-progress-item">
												<div class="db-progress-label">
													<span>Laptop</span>
													<small>10.4%</small>
												</div>
												<div class="progress db-progress">
													<div class="progress-bar bg-info" style="width:10.4%"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- STOCK MOVEMENT CHART -->
								<div class="col-xl-6">
									<div class="card db-chart-card">
										<div class="card-header">
											<h5 class="mb-0">Stock Movement Overview</h5>
										</div>
										<div class="card-body">
											<div class="db-chart-sm">
												<canvas id="stockMovementChart"></canvas>
											</div>
										</div>
									</div>
								</div>
								<!-- LOW STOCK TABLE -->
								<div class="col-xl-6">
									<div class="card ">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="mb-0">Low Stock Alerts</h5>
											<a href="../inventory/products" class="db-view-all">View All</a>
										</div>
										<div class="card-body px-0 py-0">
											<div class="table-responsive">
												<table class="table table-hover mb-0">
													<thead>
														<tr>
															<th class="text-center">#</th>
															<th>Product</th>
															<th>Supplier</th>
															<th class="text-center">Stock</th>
															<th class="text-center">Status</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="text-center">1</td>
															<td>Wireless Keyboard</td>
															<td>Super Electronics</td>
															<td class="text-center">5</td>
															<td class="text-center"><span class="badge badge-danger">Low Stock</span></td>
														</tr>
														<tr>
															<td class="text-center">2</td>
															<td>Office Desk</td>
															<td>Desu Furniture</td>
															<td class="text-center">6</td>
															<td class="text-center"><span class="badge badge-danger">Low Stock</span></td>
														</tr>
														<tr>
															<td class="text-center">3</td>
															<td>Packing Tape</td>
															<td>Supply Hub</td>
															<td class="text-center">6</td>
															<td class="text-center"><span class="badge badge-warning">Reorder Soon</span></td>
														</tr>
														<tr>
															<td class="text-center">4</td>
															<td>Whiteboard Marker</td>
															<td>Stationery World</td>
															<td class="text-center">5</td>
															<td class="text-center"><span class="badge badge-danger">Low Stock</span></td>
														</tr>
														<tr>
															<td class="text-center">5</td>
															<td>Bond Paper A4</td>
															<td>Office Central</td>
															<td class="text-center">0</td>
															<td class="text-center"><span class="badge badge-danger">Out of Stock</span></td>
														</tr>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- RECENT ACTIVITY -->
								<div class="col-xl-4">
									<div class="card">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="mb-0">Recent Activity</h5>
											<a href="#" class="db-view-all">View All</a>
										</div>
										<div class="card-body">
											<div class="db-activity-item">
												<div class="db-activity-icon bg-success"><i class="fas fa-arrow-down"></i></div>
												<div class="db-activity-content">
													<h6>Stock In</h6>
													<small>10 units of Office Chair added</small>
												</div>
											</div>
											<div class="db-activity-item">
												<div class="db-activity-icon bg-warning"><i class="fas fa-arrow-up"></i></div>
												<div class="db-activity-content">
													<h6>Stock Out</h6>
													<small>5 units of Mouse released</small>
												</div>
											</div>
											<div class="db-activity-item">
												<div class="db-activity-icon bg-info"><i class="fas fa-user-plus"></i></div>
												<div class="db-activity-content">
													<h6>New Supplier</h6>
													<small>ABC Trading was added</small>
												</div>
											</div>
											<div class="db-activity-item">
												<div class="db-activity-icon bg-danger"><i class="fas fa-exclamation-circle"></i></div>
												<div class="db-activity-content">
													<h6>Critical Stock</h6>
													<small>Bond Paper is out of stock</small>
												</div>
											</div>
											<div class="db-activity-item">
												<div class="db-activity-icon bg-danger"><i class="fas fa-exclamation-circle"></i></div>
												<div class="db-activity-content">
													<h6>Critical Stock</h6>
													<small>Bond Paper is out of stock</small>
												</div>
											</div>
										</div>
									</div>
								</div>

								
								

								

								

								

							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end -->

	<?php include('../pkg/assets/page/footer.php')?>

</body>
<script>
	// setDataTable('.table');
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	(function () {
		var isDark = document.documentElement.classList.contains('theme-dark');
		var gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.08)';
		var textColor = isDark ? '#94a3b8' : '#748892';

		var stockMovementCanvas = document.getElementById('stockMovementChart');
		if (stockMovementCanvas) {
			new Chart(stockMovementCanvas, {
				type: 'line',
				data: {
					labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
					datasets: [
						{
							label: 'Stock In',
							data: [10, 18, 15, 17, 20, 19, 23],
							borderColor: '#4c6ef5',
							backgroundColor: 'rgba(76,110,245,0.10)',
							borderWidth: 2,
							pointRadius: 2,
							fill: true,
							tension: 0.4
						},
						{
							label: 'Stock Out',
							data: [6, 12, 9, 14, 15, 13, 17],
							borderColor: '#f59f00',
							backgroundColor: 'rgba(245,159,0,0.08)',
							borderWidth: 2,
							pointRadius: 2,
							fill: true,
							tension: 0.4
						}
					]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							position: 'top',
							labels: { fontColor: textColor, boxWidth: 12, padding: 8, fontSize: 11 }
						}
					},
					scales: {
						x: { grid: { color: gridColor, drawBorder: false }, ticks: { fontColor: textColor, fontSize: 10 } },
						y: { beginAtZero: true, grid: { color: gridColor, drawBorder: false }, ticks: { fontColor: textColor, fontSize: 10 } }
					}
				}
			});
		}

		var stockCategoryCanvas = document.getElementById('stockCategoryChart');
		if (stockCategoryCanvas) {
			new Chart(stockCategoryCanvas, {
				type: 'doughnut',
				data: {
					datasets: [{
						data: [33.5, 24.2, 18.7, 12.1, 11.5],
						backgroundColor: ['#4c6ef5', '#2ca961', '#f59f00', '#e52d27', '#0288d1'],
						borderWidth: 0
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					cutoutPercentage: 65,
					plugins: { legend: { display: false }, tooltip: { enabled: false } }
				}
			});
		}
	})();
</script>
</html>
