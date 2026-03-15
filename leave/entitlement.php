<?php include('../config/postcheck.php') ?>
<?php
	include('../config/check_permission.php');
	$required_permission_class = ['hr-permission', 'superadmin'];
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
												<h5 class="m-b-10">Entitlements</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Leave</a></li>
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
														<h3 class="mb-0"><span class="page-title"></span> List </h3>
														<p class="text-danger">Note: Modify only when you add or reduce an employee's annual leave</p>
													</div>
													<!-- <div class="col-6 col-md-2 d-flex justify-content-end">
														<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
													</div> -->
												</div>
												<hr>
												<div class="table-responsive">
													<table id="table_ent" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Employee</th>
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
												<div class="row">
													<div class="col-4"><strong>Employee Name:</strong> <span id="emp_name">asd</span> </div>
													<div class="col-4"><strong>Primary ID:</strong> <span id="emp_id">asd</span> </div>
													<div class="col-4"><strong>Role:</strong> <span id="emp_role">asd</span> </div>
												</div>
												<div class="row align-items-center justify-content-center mt-4">
													<div class="table-responsive col-8">
														<table id="leave_stat" class="table table-hover">
															<thead>
																<th class="text-center">Leave</th>
																<th class="text-center">Default Max Days</th>
																<th class="text-center">Modified Days</th>
															</thead>
															<tbody>
																<tr class="text-center">
																	<td>X</td>
																	<td>Y</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<hr>
												<form>
													<div class="row">
														<div class="form-group col-md-6">
															<label>Leave Type <span class="text-danger">*</span></label>
															<select id="type_name" class="dd_lvtype form-control" required>
																<option disabled selected>Select Type</option>
															</select>
														</div>
														<div class=" form-group col-md-6">
															<label for="modified_days">Modify <span class="text-danger">*</span></label>
															<input id="modified_days" disabled type="number"class="form-control form-control-sm" step="0.5" placeholder="Modified Days"  required/>
														</div>
													</div>
													<div class="row justify-content-evenly">
														<div class="form-group ml-3 col form-check">
															<input type="checkbox" class="form-check-input" id="ent_year">
															<label class="form-check-label" for="ent_year">All year. <span class="text-primary">Check if this change applies to the yearly leave reset.</span></label>
														</div>													
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn_save" data-id="0">Apply</button>
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
	
	// script for body functions default
	// Initialize
	const pagetitle = $('.page-title').html();
	tableload_Ent();

	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			let hasInvalidDays = $('#modified_days').hasClass('is-invalid');
			if(hasInvalidDays){
				Swal.fire({ icon: 'error', title: 'Error', text: 'Please change the modified days that is divisible by 0.5.', showConfirmButton: false });
			}else{
				var notif = parseInt(id, 10);
				let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
				let scope    = $('#ent_year').prop('checked') ? 1 : 0;
				var data = { scope :  scope, modified_days :  $('#modified_days').val(), pkid : id};
				var json = JSON.stringify(data);
				$.post("../backend/post_leave_ent_edit.php", { data: json}, function (data, a) {
					data = data.trim();
					if(data == 'exist'){
						Swal.fire({icon: 'error', title: pagetitle+' has no changes! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
					}else if(data == 'true'){
						Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
						tableload_Ent();
						showMainPage();
						is_active = 1;
					}else if(data.trim() == ''){
						Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
					}
				});


			}
			
		}
	});
	



	$('.btn-cancel').click(function(){	

	});
	



	// FUNCTIONS
	function tableload_Ent(){
		resetDataTable('#table_ent');

		$.get("../backend/get_list_leave_ent.php?security=123465", function(data,status){
			$("#table_ent tbody").html(data);
			setDataTable("#table_ent", {showActions : true});
			
			// EDIT
			$('.btn-edit').click(function() {
				
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				pkid = $(this).data('id');
				dd_leave_type(pkid);
				resetDataTable('#leave_stat');
				$.get("../backend/get_det_leave_ent.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					let formatted = String(pkid).padStart(4, '0');
					$("#leave_stat tbody").html(array.tbody);
					setDataTable("#leave_stat", {dtOptions:{ lengthChange: false,	ordering:  false, searching: false, info: false,  paging: false, }});
					// $('.btn_save').attr('data-id', pkid);
					$('#emp_name').text(array.full_name);
					$('#emp_id').text(formatted);
					$('#emp_role').text(array.role_name);

					$('#type_name').change(function(){
						var ent_id = $('#type_name').val()
						$('.btn_save').attr('data-id', ent_id);
						$.get("../backend/get_det_leave_ent_dd.php?security=123465&id=" + ent_id, function(data, status) {
							var array_ent = jQuery.parseJSON(data);
							$('#modified_days').prop('disabled', false);
							$('#modified_days').val(array_ent.modified_days);
							$('#ent_year').prop('checked', !!array_ent.scope);
						});
					});
					
				});
			});
			// DELETE
			$('.btn-del').click(function(){
				Swal.fire({ title: 'Confirm delete', icon: 'warning', html: `<div style="text-align:left">Deleting this could affect other settings in this<span style="font-weight:bold;"> Proceed with caution!</span><br><br>Type <b>DELETE</b> to enable deletion:</div>`, input: 'text', inputPlaceholder: 'Type DELETE', inputAttributes: { autocapitalize: 'off', autocomplete: 'off'}, showCancelButton: true, ConfirmButtonText: 'Yes, delete it!', confirmButtonColor: '#d33',cancelButtonColor: '#20a661',
					didOpen: () => {
						const confirmBtn = Swal.getConfirmButton();
						confirmBtn.disabled = true;
						const input = Swal.getInput();
						input.addEventListener('input', () => {
						const v = (input.value || '').trim();
						confirmBtn.disabled = (v !== 'DELETE');
						});
						input.focus();
					},preConfirm: (value) => {
						const v = (value || '').trim();
						if (v !== 'DELETE') {
							Swal.showValidationMessage('Please type DELETE exactly.');
							return false;
						}
						return true;
					}
				}).then((result) => {
					if (result.isConfirmed) {
						var id = $(this).data('id');
						$.post("../backend/del_leave_type.php?security=123465&id=" + id, function (data, status) {
						data = (data || '').trim();
						if (data === 'true') {
							Swal.fire({ showConfirmButton: false, title: 'Deleted!', text: pagetitle+' deleted.', icon: 'success', timer: 700 });
							tableload_Leave();
							showMainPage();
						} else {
							Swal.fire({ icon: 'error', title: 'Error deleting '+pagetitle,  showConfirmButton: false, timer: 1200 });
						}
						});
					}
				});
			});			
		});
	}
	
	function isDivisibleByHalf(v){
		var n = parseFloat(v);
		return !isNaN(n) && Math.floor(n * 2) === n * 2;
	}
	$('#modified_days').on('input change', function () {
	var v = $(this).val();

	if (v === '') {
		$(this).removeClass('is-invalid');
		return;
	}
	if (!isDivisibleByHalf(v)) {
		$(this).addClass('is-invalid');
	} else {
		$(this).removeClass('is-invalid');
	}
	});















	
</script>

</html>
