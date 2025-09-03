<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<body class="">
	<!-- [ navigation menu ] start -->
	<?php include('../pkg/assets/page/sidebar.php')?>
	<?php include('../pkg/assets/page/navbar.php')?>
	<!-- [ navigation menu ] end -->

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
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="page-header-title">
												<h5 class="m-b-10">Leave Portal</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Leave Portal</a></li>
												<li class="breadcrumb-item"><a href="#">File a Leave</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->

							<!-- [ Main Content ] start -->
							<div class="container-fluid">
								<div class="row">
                                <!-- [ basic-table ] start -->
								
								<div class="col-xl-12">
									<div class="card">
										<div class="card-body">
											<div class="col-md-12">
													<select class="mb-3 form-control">
														<option disabled selected>Default select</option>
														<option>Voluntary</option>
														<option>Resignation</option>
													</select>
												</div>
											<div>TEST</div>
										</div>
										<div class="container" style="max-width: 980px;">
											<h3 class="mb-4">Date pickers with Year/Month selection</h3>

											<div class="picker-row">
											<!-- A) Single date (with month & year dropdowns) -->
											<div class="form-group">
												<label for="singleDate">Single date (MM/DD/YY)</label>
												<input id="singleDate" class="form-control form-control-sm" placeholder="Select a date" />
											</div>

											<!-- B) Date range (with month & year dropdowns) -->
											<div class="form-group">
												<label for="dateRange">Date range (MM/DD/YY - MM/DD/YY)</label>
												<input id="dateRange" class="form-control form-control-sm" placeholder="Select a date range" />
											</div>

										
											</div>

											<pre id="log" class="mt-3 p-3 bg-light border rounded" style="min-height: 96px;"></pre>
										</div>

									</div>
								</div>
                                <!-- [ basic-table ] end -->
								<hr>
								
							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php include('../pkg/assets/page/footer.php')?>
	<script>
		$(function () {
			const log = (msg) => $('#log').text(msg);

			// A) Single date with month & year dropdowns
			$('#singleDate')
				.daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,           // 👈 adds month/year selects
				autoUpdateInput: false,
				locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
				})
				.on('apply.daterangepicker', function (e, picker) {
				$(this).val(picker.startDate.format('MM/DD/YY'));
				log('Single date: ' + $(this).val());
				})
				.on('cancel.daterangepicker', function () {
				$(this).val('');
				log('Single date cleared');
				});

			// B) Date range with month & year dropdowns
			$('#dateRange')
				.daterangepicker({
				showDropdowns: true,           // 👈 adds month/year selects
				autoUpdateInput: false,
				locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
				})
				.on('apply.daterangepicker', function (e, picker) {
				const val = picker.startDate.format('MM/DD/YY') + ' - ' + picker.endDate.format('MM/DD/YY');
				$(this).val(val);
				log('Range: ' + val);
				})
				.on('cancel.daterangepicker', function () {
				$(this).val('');
				log('Range cleared');
				});
			});
	</script>
</body>

</html>
