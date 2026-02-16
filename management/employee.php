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
												<h5 class="m-b-10">Employee</h5>
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
															<h3 class="mb-0"><span class="page-title"></span> List NOTE(is_active trigger og EMP CODE AUTO GENERATION)</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table id="table_emp" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">ID</th>
																<th class="text-center">Name</th>
																<th class="text-center">Code</th>
																<th class="text-center">Department</th>
																<th class="text-center">Role</th>
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

								<!-- USER SOMETHING -->
								<!-- <div class="row">
									<div class="form-group col-md-5">
										<label for="emp_user">Username <span class="text-danger">*</span></label>
										<div class="input-group col-mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">@</span>
											</div>
											<input id="emp_user" type="text" class="form-control" placeholder="Username">
										</div>
									</div>
									<div class="form-group col-md-5">
										<label for="emp_pass">Password <span class="text-danger">*</span></label>
										<input id="emp_pass" type="password" class="form-control" placeholder="Username">
									</div>
								</div> -->



								<!-- [ Modify View ] start -->
								<div class="row view-modify d-none">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<h3 class="text-center"><span class="text-btn"></span> <span class="page-title"></span></h3>
												<hr>
												<form>
													<div class="add-employee">
														<h3>Personal Information</h3>
														<div class="row">
															<div class="form-group col-md-4">
																<label for="first_name">First Name <span class="text-danger">*</span></label>
																<input id="first_name" class="form-control form-control-sm" placeholder="First Name"  required/>
															</div>
															<div class="form-group col-md-3">
																<label for="middle_name">Middle Name <span class="text-danger">*</span></label>
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
															<div class="form-group col-md-5">
																<label for="birth_date">Birthday <span class="text-danger">*</span></label>
																<input id="birth_date" class="singleDatePicker form-control form-control-sm" readonly placeholder="Select birthday" required/>
															</div>
															<div class="form-group col-md-2">
																<label>Marital Status <span class="text-danger">*</span></label>
																<select id="marital_status" class="form-control" required>
																	<option disabled selected>Select Status</option>
																	<option value="Single">Single</option>
																	<option value="Married">Married</option>
																	<option value="Divorce">Divorce</option>
																	<option value="Widowed">Widowed</option>
																	<option value="Separated">Separated</option>
																	<option value="Cohabiting">Cohabiting</option>
																	
																</select>
															</div>
															<div class="form-group col-md-2">
																<label>Gender <span class="text-danger">*</span></label>
																<select id="gender" class="form-control" required>
																	<option disabled selected>Select Gender</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
														</div>
														<hr>
														<h3>Contact Information</h3>
														<div class="row">
															<div class="form-group col-md-4">
																<label for="prov_id">Province <span class="text-danger">*</span></label>
																<select id="prov_id" class="dd_prov form-control" required>
																	<option disabled selected>Select Province</option>
																</select>
															</div>
															<div class="form-group col-md-4">
																<label for="city_id">City <span class="text-danger">*</span></label>
																<select id="city_id" class="dd_city form-control" required>
																	<option disabled selected>Select City</option>
																</select>
															</div>
															<div class="form-group col-md-4">
																<label for="brgy_id">Barangay <span class="text-danger">*</span></label>
																<select id="brgy_id" class="dd_brgy form-control" required>
																	<option disabled selected>Select Barangay</option>
																</select>
															</div>
															<div class="form-group col-md-8">
																<label for="address_line">Address Line <span class="text-danger">*</span></label>
																<input id="address_line" class="form-control form-control-sm" placeholder="Input Address line"/>
															</div>
															<div class="form-group col-md-6">
																<label for="email">E-mail <span class="text-danger">*</span></label>
																<input id="email" type="email" class="form-control form-control-sm" placeholder="Input E-mail"/>
															</div>
															<div class="form-group col-md-6">
																<label for="contact_no">Contact Number <span class="text-danger">*</span></label>
																<input id="contact_no" type="tel" minlength="11" maxlength="13"class="form-control form-control-sm" placeholder="09xxxxxxxxx"/>
															</div>
														</div>
													</div>
													<div class="edit-employee d-none">
														<h3>Employee Information</h3>
														
														<div class="row">
															<div class="col-md-5">
																<strong>Employee Name: </strong> <span id="edit-full-name">TEST FULL NAME</span>
															</div>
															<div class="col-md-3">
																<strong>Marital Status: </strong><span id="edit-status">Single</span>
															</div>
															<div class="col-md-3">
																<strong>Gender: </strong><span id="edit-gender">Male</span>
															</div>
															
															<div class="col-md-5">
																<strong>Address: </strong><span id="edit-address">Address Line, Barangay, City, Province</span>
															</div>
															<div class="col-md-5">
																<strong>Birthday: </strong><span id="edit-birthday">Date</span>
															</div>
															<div class="col-md-5">
																<strong>Email: </strong><span id="edit-email">test@gmail.com</span>
															</div>
															<div class="col-md-4">
																<strong>Contact Number: </strong><span id="edit-contact">09123456789</span>
															</div>
														</div>
														<div class="row mt-3">
															
															<div class="col text-center">
																<div class="btn-group btn-group-toggle " data-toggle="buttons">
																	<label for="is-active" class="btn btn-sm btn-secondary">
																	<input type="radio" name="options" id="is-active" value="1"> Active</label>
																	<label for="is-inactive" class="btn btn-sm btn-secondary">
																	<input type="radio" name="options" id="is-inactive" value="0"> Inactive</label>
																</div>
															</div>
														</div>
													</div>
													<hr>
													<h3>Employment Details</h3>
													<div class="row">
														<div class="form-group col-md-4">
															<label for="date_hired">Date Hired <span class="text-danger">*</span></label>
															<input id="date_hired" class="singleDatePicker form-control form-control-sm" readonly placeholder="Select Hired Date" required />
														</div>
														<div class="form-group col-md-4">
															<label for="branch_id">Branch <span class="text-danger">*</span></label>
															<select id="branch_id" class="dd_branch form-control" required>
																<option disabled selected>Select Branch</option>
															</select>
														</div>
														<div class="form-group col-md-3">
															<label for="daily_rate">Employee Rate <span class="text-danger">*</span></label>
															<div class="input-group ">
																<div class="input-group-prepend">
																	<span class="input-group-text">&#8369;</span>
																</div>
																<input id="daily_rate" type="number" placeholder="Input Daily Rate" class="form-control" required>
																
															</div>
														</div>
														<div class="form-group col-md-4">
															<label for="department_id">Department <span class="text-danger">*</span></label>
															<select id="department_id" class="dd_dept form-control" required>
																<option disabled selected>Select Department</option>
															</select>
														</div>
														<div class="form-group col-md-4">
															<label for="role_id">Designation <span class="text-danger">*</span></label>
															<select id="role_id" class="dd_role form-control" required>
																<option disabled selected>Select Role</option>
															</select>
														</div>
														
													</div>
													<div class="row">
														<div class="form-group col-md-4">
															<label for="sss_no">SSS Number <span class="text-danger">*</span></label>
															<input id="sss_no" type="number" class="form-control form-control-sm" placeholder="SSS No."/>
														</div>
														<div class="form-group col-md-4">
															<label for="pagibig_no">Pag-Ibig Number <span class="text-danger">*</span></label>
															<input id="pagibig_no" type="number" class="form-control form-control-sm" placeholder="Pag-Ibig No."/>
														</div>
														<div class="form-group col-md-4">
															<label for="tin_no">TIN Number <span class="text-danger">*</span></label>
															<input id="tin_no" type="number" class="form-control form-control-sm" placeholder="TIN No."/>
														</div>
														<div class="form-group col-md-4">
															<label for="philhealth_no">PhilHealth Number <span class="text-danger">*</span></label>
															<input id="philhealth_no" type="number" class="form-control form-control-sm" placeholder="PhilHealth No."/>
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
	// dd_role();
	dd_dept();
	dd_branch();
	tableload_Employee();
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
	function tableload_Employee(){
		resetDataTable();
		$.get("../backend/get_list_emp.php?security=123465", function(data,status){
			$("#table_emp tbody").html(data);
			setTable();
			// console.log(data);
			// wrapTable();
			// EDIT
			$('.btn-edit').click(function() {
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				$('.add-employee').hide().addClass('d-none');
				$('.edit-employee').fadeIn().removeClass('d-none');
				// Disable required fields in the add-employee form to prevent validation
				$('.add-employee .form-control').attr('disabled', true);
				$('.add-employee select').attr('disabled', true);
				pkid = $(this).data('id');
				$.get("../backend/get_det_emp.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					is_active = parseInt(array.is_active);
					emp_active(is_active);
					dd_role(array.department_id);
					$('.btn_save').attr('data-id', pkid);
					$('#edit-full-name').html(array.fullname);
					$('#edit-status').html(array.marital_status);
					$('#edit-gender').html(array.gender);
					$('#edit-birthday').html(array.birth_date);
					$('#edit-address').html(array.address);
					$('#edit-email').html(array.email);
					$('#edit-contact').html(array.contact_no);
					$('#date_hired').val(array.date_hired);
					$('#branch_id').val(array.branch_id);
					$('#daily_rate').val(array.daily_rate);
					$('#department_id').val(array.department_id);
					// $('#role_id').val(parseInt(array.role_id));
					$('#sss_no').val(array.sss_no);
					$('#pagibig_no').val(array.pagibig_no);
					$('#tin_no').val(array.tin_no);
					$('#philhealth_no').val(array.philhealth_no);
					// console.log(array);
					$('.btn_save').attr('data-id', pkid);



					setTimeout(function() {
						$('#role_id').val(parseInt(array.role_id));
					}, 100); 
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
							tableload_Employee();
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
	function setTable() {
		 $('#table_emp').DataTable();
	}
	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { first_name :  $('#first_name').val(), middle_name : $('#middle_name').val(), surname : $('#surname').val(), suffix : $('#suffix').val(), birth_date : $('#birth_date').val(), marital_status : $('#marital_status').val(), gender : $('#gender').val(), prov_id : $('#prov_id').val(), city_id : $('#city_id').val(), brgy_id : $('#brgy_id').val(), address_line : $('#address_line').val(), email : $('#email').val(), contact_no : $('#contact_no').val(), date_hired : $('#date_hired').val(),  branch_id : $('#branch_id').val(), daily_rate : $('#daily_rate').val(), department_id : $('#department_id').val(), role_id : $('#role_id').val(), sss_no : $('#sss_no').val(), pagibig_no : $('#pagibig_no').val(), tin_no : $('#tin_no').val(), philhealth_no : $('#philhealth_no').val(), pkid : id, is_active : is_active};
			console.log("PUSHED SAVED DATA: ",data);
			var json = JSON.stringify(data);
			$.post("../backend/post_emp.php", { employee: json}, function (data, a) {
				data = data.trim();
				console.log(data);
				if(data == 'exist'){
					Swal.fire({icon: 'error', title: pagetitle+'already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
					tableload_Employee();
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
		$('.add-employee').fadeIn().removeClass('d-none');
		$('.edit-employee').addClass('d-none');
		$('.add-employee .form-control').attr('disabled', false);
		$('.add-employee select').attr('disabled', false);
	});
	

	$('.btn-group-toggle .btn').click(function() {
		let val = parseInt($(this).find('input').val());
		emp_active(val);
	});
	
</script>

</html>
