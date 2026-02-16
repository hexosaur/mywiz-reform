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
											<h3>File a Leave</h3>
											<hr>
											<form>
												<div class="row">
													<div class="form-group col-md-6">
														<select class="mb-3 form-control">
															<option disabled selected>Select Leave Type</option>
															<option>Voluntary</option>
															<option>Resignation</option>
															<hr>
															<option>Resignation</option>
														</select>
													</div>
													<div class="form-group col-md-6">
														<select class="mb-3 form-control">
															<option disabled selected>Select Proxy</option>
															<option>Voluntary</option>
															<option>Resignation</option>
														</select>
													</div>
													<hr>
													<div class="form-group col-md-8">
														<label for="">Date From</label>
														<input id="" class="startDatePicker noWeekend form-control form-control-sm" readonly placeholder="Select a starting date" />
													</div>
													<div class="form-group col-md-4">
														<label for="">Time From</label>
														<select class="mb-3 form-control">
															<option disabled selected>Select Starting</option>
															<option>Morning</option>
															<option>Afternoon</option>
														</select>
													</div>
													<div class="form-group col-md-8">
														<label for="">Date To</label>
														<input id="" class="endDatePicker noWeekend form-control form-control-sm" readonly placeholder="Select a ending date" />
													</div>
													<div class="form-group col-md-4">
														<label for="">Time To</label>
														<select class=" form-control">
															<option disabled selected>Select Ending</option>
															<option>Morning</option>
															<option>Afternoon</option>
														</select>
													</div>
													<div class="form-group col-xl-12">
														<label for="">Reason</label>
														<textarea class="form-control" id="" rows="3"></textarea>
													</div>
													<div class="form-group col-xl-12">
														<label for="">Attach Image</label>
														<input type="file" class="form-control" id="" />
													</div>
												</div>
											</form>
											<hr>
											<div class="text-center">
												<button class="btn btn-primary">Apply</button>
												<button class="btn btn-danger" onclick="location.href='../home/dashboard'">Cancel</button>
											</div>
										</div>
									</div>
								</div>
                                <!-- [ basic-table ] end -->
								
								
							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php include('../pkg/assets/page/footer.php')?>
	
</body>

</html>
