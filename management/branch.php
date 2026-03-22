<?php include('../config/postcheck.php') ?>
<?php
	include('../config/check_permission.php');
	$required_permission_class = ['admin-permission', 'superadmin'];
	check_permission($required_permission_class);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<body>
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
												<h5 class="m-b-10">Branch</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Organization</a></li>
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
															<h3 class="mb-0">Branch List</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table id="table_branch" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th>Branch</th>
																<th>Code</th>
																<th class="text-center">Location</th>
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
													<div class="row">
														<div class="form-group col-md-6">
															<label for="branch_name"><span class="page-title"></span> Name <span class="text-danger">*</span></label>
															<input id="branch_name" class="form-control form-control-sm" placeholder="Branch Name"  required/>
														</div>
														<div class="form-group col-md-6">
															<label for="branch_code"><span class="page-title"></span> Code <span class="text-danger">*</span></label>
															<input id="branch_code" class=" form-control form-control-sm" placeholder="Branch Code i.e. ILGN"  required/>
														</div>
														<div class="form-group col-md-6">
															<label>Province <span class="text-danger">*</span></label>
															<select id="branch_prov" class="dd_prov form-control" required>
																<option disabled selected>Select Province</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>City <span class="text-danger">*</span></label>
															<select id="branch_city" class="dd_city form-control" required disabled>
																<option disabled selected>Select City</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>Barangay <span class="text-danger">*</span></label>
															<select id="branch_brgy" class="dd_brgy form-control" disabled required>
																<option disabled selected>Select Barangay</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label for="addr">Address Line <span class="text-danger">*</span></label>
															<input id="addr" class=" form-control form-control-sm" placeholder="Address Line" required/>
														</div>
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn-save" data-id="0">Apply</button>
													<button class="btn btn-danger btn-cancel ">Cancel</button>
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
	var prov_id, city_id, brgy_id, pkid;
	const pagetitle = $('.page-title').html();
	var userPermissions = ['view_branch']; 

	tableload();
	

	// script for interactions
	// ACTION LISTENERS
	$('.btn-save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ?  'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { branch_name: $('#branch_name').val(), branch_code : $('#branch_code').val(), prov_id : prov_id, city_id : city_id, brgy_id : brgy_id, addr : $('#addr').val(), pkid : id}
			var json = JSON.stringify(data)
			$.post("../backend/management/post_branch.php", {data: json}, function (data, a) {
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
		$('.view-default').hide();
		pkid = $(this).data('id');
		$.get("../backend/management/get_det_branch.php?security=123465&id=" + pkid, function(data, status) {
			var array = jQuery.parseJSON(data);
			$('.btn-save').attr('data-id', pkid);
			$('#branch_name').val(array.branch_name);
			$('#branch_code').val(array.branch_code);
			$('#addr').val(array.branch_address);
			$('#branch_prov').html(array.prov_name); 
			$('#branch_city').val(array.city_name);
			$('#branch_brgy').val(array.brgy_name); 
			dd_prov(true, array.prov_id);
			dd_city(true,array.prov_id, array.city_id);
			dd_brgy(true,array.city_id, array.brgy_id);
			
		});
	});
	// DEL
	$('.table').on('click', '.btn-del', function () {
		const id = $(this).data('id');
		confirmTypedDelete({
			url: "../backend/management/del_branch.php?security=123465&id=" + id,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
				showMainPage();
			}
		});
	});
	$('.btn-cancel').click(function(){	
		pkid = 0;
		resetDependentSelect($('.dd_city'), 'Select City');
		resetDependentSelect($('.dd_brgy'), 'Select Barangay');
	});
	
	

	// script for body functions default
	function tableload(){
		resetDataTable('.table');
		$.get("../backend/management/get_list_branch.php?security=123465", function(data,status){
			$("#table_branch tbody").html(data);	
			setDataTable('.table', {
				showActions: true,
				useResponsive: true,
				extraColumnDefs: [
					{ targets: 1, responsivePriority: 1 },
					{ targets: 2, responsivePriority: 2, width: '90px' },
					{ targets: 3, responsivePriority: 3 },
					{ targets: -1, responsivePriority: 1, width: '120px', className: 'text-center text-nowrap' }
				]
			});		
		});
	}
</script>


</html>
