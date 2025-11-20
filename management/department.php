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
										<div class="col-md-8">
											<div class="page-header-title">
												<h5 class="m-b-10">Department</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Organization</a></li>
												<li class="breadcrumb-item"><a href="#">Department</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->

							<!-- [ Main Content ] start -->
							<div class="container-fluid">
								<!-- [ Default View ] start -->
								<div class="row view-default" >
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body table-border-style">
												<div class="row align-items-center">
														<div class="col-6 col-md-10">
															<h3 class="mb-0">Department List</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table class="table  table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Department</th>
																<th class="text-center">Branch</th>
																<th class="text-center">Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">2</td>
																<td class="text-center">Test</td>
																<td class="text-center">Iligan</td>
																<td class="text-center">
																	<div class="btn btn-outline-info btn-sm btn-edit"><span class="feather icon-edit"></span></div>
																	<div class="btn btn-outline-danger btn-sm btn-del"><span class="feather icon-trash-2"></div>
																</td>
															</tr>
															
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- [ Default View ] end -->
								 <!-- [ Modify View ] start -->
								<div class="row view-modify">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<h3 class="text-center"><span class="text-btn"></span> <span class="page-title"></span></h3>
												<hr>
												<form>
													<div class="row">
														<div class="form-group col-md-6">
															<label for="">Department Name</label>
															<input id="" class=" form-control form-control-sm" placeholder="Department Name" />
														</div>
														<div class="form-group col-md-6">
															<label for="">Branch(es)</label>
															<input id="" class=" form-control form-control-sm" placeholder="Branch(es)" />
														</div>
														<div class="form-group col-md-6">
															<label>Manager</label>
															<select class=" form-control">
																<option disabled selected>Select Manager</option>
																<option>Voluntary</option>
															</select>
														</div>
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary">Apply</button>
													<button class="btn btn-danger cnl-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- [ Modify View ] end -->
                               
								<!-- asd -->


								<div class="form-group col-md-6">
								<label>Barangay</label>

								<!-- Readonly "select-like" input -->
								<div class="input-group">
									<input id="barangayInput" type="text" class="form-control faux-select" placeholder="Select Barangay"
										readonly data-toggle="modal" data-target="#barangayPicker">
									
								</div>

								<!-- Hidden fields to actually submit values -->
								<div id="barangayHidden"></div>
								</div>

								

								<style>
								/* make the input look like a select (add caret) */
								.faux-select {

								background-repeat: no-repeat;
								background-position: right .75rem center;
								background-size: 16px 12px;
								padding-right: 2rem;
								}
								</style>
								<?php include('../pkg/assets/page/modals.php')?>





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
			$('.singleDatePicker')
				.daterangepicker({ singleDatePicker: true, showDropdowns: true,	autoUpdateInput: false,
				locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
				}).on('apply.daterangepicker', function (e, picker) {
				$(this).val(picker.startDate.format('MM/DD/YY'));
				log('Single date: ' + $(this).val());
				}).on('cancel.daterangepicker', function () {
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


<script>
  (function () {
    // Apply selections back to the readonly input, and generate hidden inputs for form submit
	$('#applyBarangay').on('click', function () {
	var selected = $('.brgy:checked').map(function(){ return this.value; }).get();

	// Show as comma-separated list in the readonly input
	$('#barangayInput').val(selected.join(', '));

	// Replace hidden inputs (so form submits as barangay[])
	var hiddenWrap = $('#barangayHidden').empty();
	selected.forEach(function (v, i) {
		hiddenWrap.append('<input type="hidden" name="barangay[]" value="' + $('<div>').text(v).html() + '">');
	});

	$('#barangayPicker').modal('hide');
	});

	// Clicking the input also opens the modal (already wired via data-toggle)
	$('#barangayInput').on('keydown', function(e){ e.preventDefault(); }); // prevent typing
	});
</script>

</body>

</html>
