<?php include('../config/postcheck.php') ?>
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
												<h5 class="m-b-10">Superadmin</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Super Admin</a></li>
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
															<h3 class="mb-0"><span class="page-title"></span> List</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table id="table_admin" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">ID</th>
																<th class="text-center">Name</th>
																<th class="text-center">Username</th>
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
												<h3>Personal Information</h3>
												<div class="row">
													<div class="form-group col-md-4">
														<label for="first_name">First Name <span class="text-danger">*</span></label>
														<input id="first_name" class="form-control form-control-sm" placeholder="First Name"  required/>
													</div>
													<div class="form-group col-md-3">
														<label for="middle_name">Middle Name</label>
														<input id="middle_name" class="form-control form-control-sm" placeholder="Middle Name"/>
													</div>
													<div class="form-group col-md-3">
														<label for="surname">Surname <span class="text-danger">*</span></label>
														<input id="surname" class="form-control form-control-sm" placeholder="Surname"  required/>
													</div>
													<div class="form-group col-md-2">
														<label>Suffix <span class="text-danger">*</span></label>
														<select id="suffix" class="form-control" required>
															<option disabled selected>Select Suffix</option>
															<option value="N/A">N/A</option>
															<option value="Jr.">Jr.</option>
															<option value="Sr.">Sr.</option>
															<option value="II">II</option>
															<option value="III">III</option>
															<option value="IV">IV</option>
															<option value="V">V</option>
															<option value="VI">VI</option>
														</select>
													</div>
												</div>
												<div class="row mt-3 active_toggle d-none">
													<div class="col text-center">
														<div class="btn-group btn-group-toggle " data-toggle="buttons">
															<label for="is-active" class="btn btn-sm btn-secondary">
															<input type="radio" name="options" id="is-active" value="1"> Active</label>
															<label for="is-inactive" class="btn btn-sm btn-secondary">
															<input type="radio" name="options" id="is-inactive" value="0"> Inactive</label>
														</div>
													</div>
												</div>
												<hr>
												<!-- USER SOMETHING -->
												<div class="row">
													<div class="form-group col-md-5">
														<label for="username">Username <span class="text-danger">*</span></label>
														<div class="input-group col-mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">@</span>
															</div>
															<input id="username" type="text" class="form-control" placeholder="Username" required>
														</div>
													</div>
													<div class="form-group col-md-5">
														<label for="password">Password <span class="text-danger">*</span></label>
														<input id="password" type="password" class="form-control" placeholder="Password">
													</div>
												</div>
													
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn_save" data-id="0">Apply</button>
													<button class="btn btn-danger cnl-btn btn_cancel">Cancel</button>
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
	var is_active = 1;
	const pagetitle = $('.page-title').html();
	tableload_Admin();
	
	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { first_name :  $('#first_name').val(), middle_name : $('#middle_name').val(), surname : $('#surname').val(), suffix : $('#suffix').val(), username :  $('#username').val(), password :  $('#password').val(), pkid : id, is_active : is_active};
			// console.log("PUSHED SAVED DATA: ",data);
			var json = JSON.stringify(data);
			$.post("../backend/post_superadmin.php", { data: json}, function (data, a) {
				data = data.trim();
				console.log(data);
				if(data == 'exist_username'){
					Swal.fire({icon: 'error', title: pagetitle+' username already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
					tableload_Admin();
					showMainPage();
					is_active = 1;
				}else if(data.trim() == ''){
					Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
				}
			});
		}
	});
	$('.cnl-btn').click(function(){	
		is_active = 1;
		$('.active_toggle').addClass('d-none');
	});
	

	$('.btn-group-toggle .btn').click(function() {
		let val = parseInt($(this).find('input').val());
		emp_active(val);
	});
	// FUNCTIONS
	function emp_active(value){
		if (value == 1) {
			$('#is-active').prop('checked', true);
			$('#is-active').parent().removeClass("btn-secondary").addClass("btn-success active");
			$('#is-inactive').parent().removeClass('active').addClass("btn-secondary").removeClass('btn-danger');
		}
		else if (value == 0) {
			$('#is-inactive').prop('checked', true);
			$('#is-active').parent().removeClass('active').addClass("btn-secondary").removeClass('btn-success');;
			$('#is-inactive').parent().removeClass("btn-secondary").addClass("btn-danger active");
		}
		is_active = value;
	}
	function tableload_Admin(){
		resetDataTable();
		$.get("../backend/get_list_superadmin.php?security=123465", function(data,status){
			$("#table_admin tbody").html(data);
			setDataTable(".table", { showActions : true});
			// EDIT
			$('.btn-edit').click(function() {
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				$('.active_toggle').fadeIn().removeClass('d-none');
				pkid = $(this).data('id');
				$.get("../backend/get_det_superadmin.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					is_active = parseInt(array.is_active);
					emp_active(is_active);
					$('#first_name').val(array.first_name);
					$('#middle_name').val(array.middle_name);
					$('#surname').val(array.surname);
					$('#suffix').val(array.suffix);
					$('#username').val(array.username);
					$('#password').val(array.password);
					$('.btn_save').attr('data-id', pkid);
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
						$.post("../backend/del_role.php?security=123465&id=" + id, function (data, status) {
						data = (data || '').trim();
						if (data === 'true') {
							Swal.fire({ showConfirmButton: false, title: 'Deleted!', text: pagetitle+' deleted.', icon: 'success', timer: 700 });
							tableload_Admin();
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
</script>

</html>
