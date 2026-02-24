<?php include('../config/postcheck.php') ?>
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
												<h5 class="m-b-10">Suppliers</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Inventory</a></li>
												<li class="breadcrumb-item"><a href="#">Suppliers</a></li>
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
															<h3 class="mb-0">Supplier List</h3>
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
																<th class="text-center">Company Name</th>
																<th class="text-center">Location</th>
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
								<div class="row view-modify d-none">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<h3 class="text-center"><span class="text-btn"></span> <span class="page-title"></span></h3>
												<hr>
												<form>
													<div class="row">
														<div class="form-group col-md-6">
															<label for="">Company Name <span class="text-danger">*</span></label>
															<input id="" class=" form-control form-control-sm" placeholder="Company Name" required/>
														</div>
														<div class="form-group col-md-6">
															<label for="">Street/Building</label>
															<input id="" class=" form-control form-control-sm" placeholder="Street/Building" />
														</div>
														<div class="form-group col-md-6">
															<label>Province</label>
															<select class=" form-control">
																<option disabled selected>Select Province</option>
																<option>Voluntary</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>City</label>
															<select class=" form-control">
																<option disabled selected>Select City</option>
																<option>Voluntary</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>Barangay</label>
															<select class=" form-control">
																<option disabled selected>Select Barangay</option>
																<option>Voluntary</option>
																<option>Voluntary1</option>
																<option>Voluntary2</option>
																<option>Voluntary3</option>
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
