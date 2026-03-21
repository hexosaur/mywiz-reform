<?php include('../config/postcheck.php') ?>
<?php
	include('../config/check_permission.php');
	$required_permission_class = ['superadmin'];
	check_permission($required_permission_class);
?>
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
												<li class="breadcrumb-item"><a href="../inventory/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Inventory</a></li>
												<li class="breadcrumb-item"><a href="#"><span class="page-title"></span></a></li>
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
															<h3 class="mb-0"><span class="page-title"></span> Catalog</h3>
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
																<th class="">Supplier</th>
																<th class="">Contact Person</th>
																<th class="">Number</th>
																<th class="">Email</th>
																<th class="text-center">Status</th>
																<th class="text-center">Action</th>
															</tr>
														</thead>
														<tbody>
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
													<div class="row mt-3 mb-3 d-none is-edit">
															<div class="col text-center">
																<div class="btn-group btn-group-toggle " data-toggle="buttons">
																	<label for="is-active" class="btn btn-sm btn-secondary">
																	<input type="radio" name="options" id="is-active" value="1"> Active</label>
																	<label for="is-inactive" class="btn btn-sm btn-secondary">
																	<input type="radio" name="options" id="is-inactive" value="0"> Inactive</label>
																</div>
															</div>
														</div>
													<div class="row">
														<div class="form-group col-md-6">
															<label for="supplier_name">Supplier <span class="text-danger">*</span></label>
															<input id="supplier_name" class=" form-control form-control-sm" placeholder="Supplier" required/>
														</div>
														<div class="form-group col-md-6">
															<label for="contact_person">Contact Person <span class="text-danger">*</span></label>
															<input id="contact_person" class=" form-control form-control-sm" placeholder="Contact Person" required/>
														</div>
														<div class="form-group col-md-4">
															<label for="contact_number">Contact Number <span class="text-danger">*</span></label>
															<input id="contact_number" type="number" class=" form-control form-control-sm" placeholder="Contact Number" required/>
														</div>
														<div class="form-group col-md-4">
															<label for="email">Email</label>
															<input id="email" type="email"  class=" form-control form-control-sm" placeholder="Email" />
														</div>
														<div class="form-group col-md-4">
															<label for="address">Address <span class="text-danger">*</span></label>
															<input id="address" class=" form-control form-control-sm" placeholder="Address" required/>
														</div>
														<div class="form-group col-md-6">
															<label for="tin_no">TIN No.</label>
															<input id="tin_no" type="number"  class=" form-control form-control-sm" placeholder="TIN" />
														</div>
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn-save" data-id="0">Apply</button>
													<button class="btn btn-danger btn-cancel">Cancel</button>
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
<script>
	// Initialize
	var is_active = 1;
	const pagetitle = $('.page-title').html();
	var userPermissions = ['view_branch']; 

	tableload();
	

	// script for interactions
	// ACTION LISTENERS
	$('.btn-group-toggle .btn').click(function() {
		let val = parseInt($(this).find('input').val());
		isActiveToggle(val);
	});
	$('.btn-save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { supplier_name: $('#supplier_name').val(), contact_person: $('#contact_person').val(), contact_number: $('#contact_number').val(), email: $('#email').val(), address: $('#address').val(), tin_no: $('#tin_no').val(), status : is_active, pkid : id}
			var json = JSON.stringify(data)
			$.post("../backend/inventory/post_inv_suppliers.php", {data: json}, function (data, a) {
				data = data.trim();
				if(data == 'exist'){
					Swal.fire({icon: 'error', title: pagetitle+' already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'exist_code'){
					Swal.fire({icon: 'error', title: pagetitle+' Code already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					tableload();
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
					showMainPage();
				}else if(data.trim() == ''){
					Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
				}
			});
		}
	});
	// EDIT
	$('.table').on('click', '.btn-edit', function () {
		$('.text-btn').text("Edit");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.is-edit').fadeIn().removeClass('d-none');
		$('.view-default').hide();
		pkid = $(this).data('id');
		$.get("../backend/inventory/get_det_inv_suppliers.php?security=123465&id=" + pkid, function(data, status) {
			var array = jQuery.parseJSON(data);
			$('.btn-save').attr('data-id', pkid);
			$('#supplier_name').val(array.supplier_name);
			$('#contact_person').val(array.contact_person);
			$('#contact_number').val(array.contact_number);
			$('#email').val(array.email);
			$('#address').val(array.address);
			$('#tin_no').val(array.tin_no);
			isActiveToggle(array.status);
		});
	});

	// DEL
	$('.table').on('click', '.btn-del', function () {
		const id = $(this).data('id');
		confirmTypedDelete({
			url: "../backend/inventory/del_inv_supplier.php?security=123465&id=" + id,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
				showMainPage();
			}
		});
	});

	$('.btn-cancel').click(function(){	
		$('.is-edit').fadeIn().addClass('d-none');
		// resetDependentSelect($('.dd_city'), 'Select City');
		// resetDependentSelect($('.dd_brgy'), 'Select Barangay');
	});


	// script for body functions default
	function tableload(){
		resetDataTable('.table');
		$.get("../backend/inventory/get_list_inv_suppliers.php?security=123465", function(data,status){
			$(".table tbody").html(data);
			// SET TABLE EDITABLE OR NOT DYNAMICALLTY SOON
			setDataTable(".table", {dtOptions:{ lengthChange: false, ordering: false, searching: false, info: false, paging: false, }});
		});
	}
</script>
</html>
