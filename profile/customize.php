<?php include('../config/postcheck.php') ?>

<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	.profile-banner-img {
		height: 260px;
		object-fit: cover;
	}
	.img-preview img {
		max-width: 100%;
		max-height: 150px;
	}
	.img-preview img:hover {
		opacity: 0.8;
	}
	.profile-avatar {
		width: 130px;
		height: 130px;
		border-radius: 50%;
		object-fit: cover;
		object-position: center;
		border: 3px solid #fff;
		box-shadow: 0 2px 8px rgba(0,0,0,0.15);
	}
</style>
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
												<h5 class="m-b-10">Profile</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Home</a></li>
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
										<div class="card border-0 shadow-sm">
											<div class="card-body p-0">
												 <!-- Banner -->
												<img src="../uploads/profile/banner.jpg"
													class="card-img-top img-fluid"
													alt="Profile Banner"
													style="height: 260px; object-fit: cover;">

												<div class="card-body">
													<!-- Profile Header -->
													<div class="row align-items-center">
														<!-- Profile Image -->
														<div class="col-md-2 col-sm-3 text-center text-sm-left mb-3 mb-md-0">
															<img id="profile-picture"
																src="../uploads/profile/default.jpg"
																class="profile-avatar"
																alt="User Profile Image">
														</div>
														<!-- Profile Info -->
														<div class="col-md-7 col-sm-6 text-center text-sm-left mb-3 mb-md-0">
															<h2 class="mb-1 font-weight-bold"><span  id="profile-name"></span></h2>
															<h6 class=" mb-1"><span class="profile-code"></span></h6>
															<!-- <h6 class=" mb-1"><span id="">Nickname</span></h6> -->
														</div>
														<!-- Edit Button -->
														<div class="col-md-3 col-sm-3 text-center text-sm-right">
															<button type="button" class="btn btn-primary btn-edit" data-toggle="collapse" data-target="#profile-edit" aria-expanded="false" aria-controls="profile-edit">
																<i class="fa fa-edit mr-2"></i>Edit Profile
															</button>
														</div>
													</div>
													
													<div class="collapse" id="profile-edit">
														<div class="card-body">
															<div class="row">
																<ul class="nav nav-tabs" id="myTab" role="tablist">
																	<li class="nav-item">
																		<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Personal</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" id="employment-tab" data-toggle="tab" href="#employment" role="tab" aria-controls="employment" aria-selected="false">Employment</a>
																	</li>
																</ul>
																<div class="tab-content col-md-12" id="myTabContent">
																	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
																		<h3>User Information</h3>
																		<div class="row">
																			<div class="form-group col-md-4 img-preview align-items-center">
																				<div class="p-2 text-center">
																					<img src="../pkg/assets/media/img/attach.png" style="cursor: pointer;" data-toggle="modal" data-target="#imagePreviewModal">
																				</div>
																			</div>
																			<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
																				<div class="modal-dialog modal-lg" role="document">
																					<div class="modal-content">
																						<div class="modal-header">
																							<h5 class="modal-title text-center" id="imagePreviewModalLabel"><span>Image Preview</span></h5>
																							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																								<span aria-hidden="true">&times;</span>
																							</button>
																						</div>
																						<div class="modal-body text-center">
																							<img id="fullImagePreview" class="img-fluid" src="../pkg/assets/media/img/attach.png" alt="Full Image Preview">
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="form-group col-md-8 align-items-center">
																				<label class=" mt-4" for="profile-image" class="mr-2">Attach Image <span class="text-danger">*</span></label>
																				<input type="file" class="form-control" id="profile-image" />
																			</div>
																																				
																		</div>
																		<div class="row">
																			<div class="form-group col-md-6">
																				<label for="username">Username <span class="text-danger">*</span></label>
																				<input id="username" class="form-control form-control-sm" placeholder="@username" />
																			</div>
																			<div class="form-group col-md-6">
																				<label for="password">Password</label>
																				<input id="password" type="password" class="form-control form-control-sm" placeholder="Password"/>
																			</div>																		
																		</div>
																		
																	</div>
																	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
																		<h3>Personal Information</h3>
																		<div class="row">
																			<div class="form-group col-md-4">
																				<label for="first_name">First Name <span class="text-danger">*</span></label>
																				<input id="first_name" class="form-control form-control-sm" placeholder="First Name" />
																			</div>
																			<div class="form-group col-md-3">
																				<label for="middle_name">Middle Name</label>
																				<input id="middle_name" class="form-control form-control-sm" placeholder="Middle Name"/>
																			</div>
																			<div class="form-group col-md-3">
																				<label for="surname">Surname <span class="text-danger">*</span></label>
																				<input id="surname" class="form-control form-control-sm" placeholder="Surname" />
																			</div>
																			<div class="form-group col-md-2">
																				<label>Suffix <span class="text-danger">*</span></label>
																				<select id="suffix" class="form-control">
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
																				<input id="birth_date" class="singleDatePicker form-control form-control-sm" readonly placeholder="Select birthday"/>
																			</div>
																			<div class="form-group col-md-3">
																				<label>Marital Status <span class="text-danger">*</span></label>
																				<select id="marital_status" class="form-control">
																					<option disabled selected>Select Status</option>
																					<option value="Single">Single</option>
																					<option value="Married">Married</option>
																					<option value="Divorce">Divorce</option>
																					<option value="Widowed">Widowed</option>
																					<option value="Separated">Separated</option>
																					<option value="Cohabiting">Cohabiting</option>
																					
																				</select>
																			</div>
																			<div class="form-group col-md-3">
																				<label>Gender <span class="text-danger">*</span></label>
																				<select id="gender" class="form-control">
																					<option disabled selected>Select Gender</option>
																					<option value="Male">Male</option>
																					<option value="Female">Female</option>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
																		<h3>Contact Information</h3>
																		<div class="row">
																			<div class="form-group col-md-4">
																				<label for="prov_id">Province <span class="text-danger">*</span></label>
																				<select id="prov_id" class="dd_prov form-control">
																					<option disabled selected>Select Province</option>
																				</select>
																			</div>
																			<div class="form-group col-md-4">
																				<label for="city_id">City <span class="text-danger">*</span></label>
																				<select id="city_id" class="dd_city form-control">
																					<option disabled selected>Select City</option>
																				</select>
																			</div>
																			<div class="form-group col-md-4">
																				<label for="brgy_id">Barangay <span class="text-danger">*</span></label>
																				<select id="brgy_id" class="dd_brgy form-control">
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
																	<div class="tab-pane fade" id="employment" role="tabpanel" aria-labelledby="home-tab">
																		<h3>Employment Details</h3>
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
																	</div>
																	<hr>
																	<div class="text-center">
																		<button class="btn btn-primary btn_save" data-id="0">Apply</button>
																		<button class="btn btn-danger btn-cancel" data-toggle="collapse" data-target="#profile-edit" aria-expanded="false" aria-controls="profile-edit">Cancel</button>
																	</div>
																</div>
																
															</div>
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
								
								<div class="row view-default" >
									<div class="col-xl-5">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h3>Personal Details</h3>
														<h6 class="text-muted mb-1">
															<i class="bi bi-info-square pcoded-micon mr-2"></i>
															<span class="pcoded-mtext profile-code"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-gender-ambiguous pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-gender"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-cake pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-birthday"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-chat-left-heart pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-status"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-geo-alt pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-address"></span>
														</h6>
													
														
														<h3 class="mt-2">Contact Details</h3>
														<h6 class="text-muted mb-1">
															<i class="bi bi-envelope-at pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-email" ></span></h6>
														
														<h6 class="text-muted mb-1">
															<i class="bi bi-telephone pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-contact"></span>
														</h6>


														<h3 class="mt-2">Employment Details</h3>
														<h6 class="text-muted mb-1">
															<i class="bi bi-calendar-check pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-date-hire">Date Hired</span>
														</h6>
														<h6 class="text-muted mb-1 profile-rate">
															<i class="bi bi-cash-stack pcoded-micon mr-2"></i>
															<span class="pcoded-mtext">Rate</span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-building pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-branch"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-people pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-department"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-person-square pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-role"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-fingerprint pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-sss"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-bandaid pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-philhealth"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-tag pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-tin"></span>
														</h6>
														<h6 class="text-muted mb-1">
															<i class="bi bi-heart pcoded-micon mr-2"></i>
															<span class="pcoded-mtext" id="profile-pagibig"></span>
														</h6>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-7 profile-post">
										<h3 class="text-center f-w-600 text-muted mt-2">No post available</h3>
										<h3 class="text-center f-w-600 text-muted mt-2">Will be updated sooner...</h3>
										<div class="card d-none">
											<div class="card-body">
											<div class="row">
												<div class="row">
													<div class="col">
														img
													</div>
													<div class="col">
														Name
													</div>
													
													
												</div>
												<div class="row">
													<div class="col">
														Date
													</div>
												</div>
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
	
	setupFilePreview('#profile-image', '.img-preview img');
	$(document).ready(function(){
		loadProfile();
	});

	// GET PROFILE 
	function loadProfile(){
			const path = window.location.pathname.replace(/\/+$/, ''); // remove trailing slash
			const lastSegment = path.substring(path.lastIndexOf('/') + 1);
			let requestURL = "../backend/system_get_employee_profile.php?security=123465";
			if(lastSegment && lastSegment !== "customize" && lastSegment !== "profile"){
				requestURL += "&user=" + encodeURIComponent(lastSegment);
			}
			$.get(requestURL, function(data, status){
				var array = jQuery.parseJSON(data);
				if(array.status == "success"){

					$("#profile-picture").attr("src", "../uploads/profile/" + array.profile_photo);
					$("#profile-name").html(array.full_name);
					$(".profile-code").html(array.employee_code);
					$("#profile-email").html(array.email);
					$("#profile-role").html(array.role_name);
					$("#profile-contact").html(array.contact_no);
					$("#profile-branch").html(array.branch_name);
					$("#profile-department").html(array.department_name);

					if(!array.is_owner){
						$(".btn-edit").hide();
						$(".profile-rate").hide();
					}

					pkid = array.employee_id;

					dd_prov(true, array.prov_id);
					dd_city(true, array.prov_id,array.city_id);
					dd_brgy(true, array.city_id,array.brgy_id);

					$("#username").val(array.username);
					$("#prov_id").val(array.prov_id);
					$("#city_id").val(array.city_id);
					$("#brgy_id").val(array.brgy_id);
					$("#address_line").val(array.address_line);
					$("#first_name").val(array.first_name);
					$("#middle_name").val(array.middle_name);
					$("#surname").val(array.surname);
					$("#suffix").val(array.suffix ? array.suffix : "N/A");

					$.get("../backend/get_det_emp.php?security=123465&id=" + pkid, function(data, status){

						var employee = jQuery.parseJSON(data);
						$("#profile-address").html(employee.address);
						$(".profile-rate span").html("₱ "+employee.daily_rate);
						$("#profile-birthday").html(employee.birth_date);
						$("#profile-gender").html(employee.gender);
						$("#profile-status").html(employee.marital_status);
						$("#profile-date-hire").html(employee.date_hired);

						$("#profile-sss").html(employee.sss_no ? employee.sss_no : "N/A");
						$("#profile-philhealth").html(employee.philhealth_no ? employee.philhealth_no : "N/A");
						$("#profile-pagibig").html(employee.pagibig_no ? employee.pagibig_no : "N/A");
						$("#profile-tin").html(employee.tin_no ? employee.tin_no : "N/A");

						$("#birth_date").val(employee.birth_date);
						$("#marital_status").val(employee.marital_status);
						$("#gender").val(employee.gender);
						$("#email").val(employee.email);
						$("#contact_no").val(employee.contact_no);

						$("#sss_no").val(employee.sss_no ? employee.sss_no : null);
						$("#pagibig_no").val(employee.pagibig_no ? employee.pagibig_no : null);
						$("#tin_no").val(employee.tin_no ? employee.tin_no : null);
						$("#philhealth_no").val(employee.philhealth_no ? employee.philhealth_no : null);

					});
				}
			});
		}







	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function () {
		var fileInput = $('#profile-image');
		var data = {
			username: $("#username").val(),
			password: $("#password").val(),
			prov_id: $("#prov_id").val(),
			city_id: $("#city_id").val(),
			brgy_id: $("#brgy_id").val(),
			address_line: $("#address_line").val(),
			first_name: $("#first_name").val(),
			middle_name: $("#middle_name").val(),
			surname: $("#surname").val(),
			suffix: $("#suffix").val(),
			birth_date: $("#birth_date").val(),
			marital_status: $("#marital_status").val(),
			gender: $("#gender").val(),
			email: $("#email").val(),
			contact_no: $("#contact_no").val(),
			sss_no: $("#sss_no").val(),
			pagibig_no: $("#pagibig_no").val(),
			tin_no: $("#tin_no").val(),
			philhealth_no: $("#philhealth_no").val()
		};

		var json = JSON.stringify(data);

		Swal.fire({ title: 'Confirm Profile Update', text: 'Enter your current password to continue.', input: 'password', inputPlaceholder: 'Current password', inputAttributes: { autocapitalize: 'off', autocorrect: 'off' }, showCancelButton: true, confirmButtonText: 'Verify', cancelButtonText: 'Cancel', inputValidator: (value) => { if (!value) { return 'Password is required.'; } }
		}).then((result) => {
			if (!result.isConfirmed) return;
			var verifyPassword = result.value;
			$.post("../backend/system_verify_profile_password.php", {
				password: verifyPassword
			}, function (verifyRes) {
				verifyRes = verifyRes.trim();
				if (verifyRes === 'true') {
					const formData = new FormData();
					if (fileInput[0].files.length > 0) {
						formData.append('profile_image', fileInput[0].files[0]);
					}
					formData.append('data', json);
					formData.append('verify_password', verifyPassword);
					$.ajax({
						url: "../backend/post_update_profile.php",
						type: "POST",
						data: formData,
						processData: false,
						contentType: false,
						success: function(res){
							res = res.trim();
							if(res === "success"){
								let newUsername = $("#username").val().trim();
								Swal.fire({
									icon: "success",
									title: "Profile Updated Successfully",
									showConfirmButton: false,
									timer: 1200
								}).then(() => {
									if(newUsername){
										window.location.href = "../profile/" + encodeURIComponent(newUsername);
									}else{
										location.reload();
									}
								});
							}
							else if(res === "username_exist"){
								Swal.fire({
									icon: "error",
									title: "Username already exists",
									text: "Please choose a different username.",
									confirmButtonColor: "#3085d6"
								});
								$("#username").focus();

							}
							else if(res === "email_exist"){
								Swal.fire({
									icon: "error",
									title: "Email already exists",
									text: "This email is already registered to another account.",
									confirmButtonColor: "#3085d6"
								});
								$("#email").focus();

							}
							else if(res === "session_expired"){
								Swal.fire({
									icon: "warning",
									title: "Session expired",
									text: "Please login again."
								}).then(()=>{
									window.location.href = "../auth/login";
								});
							}
							else{

								Swal.fire({
									icon: "error",
									title: "Update Failed",
									text: "Something went wrong while updating your profile."
								});
							}
						},
						error:function(){
							Swal.fire({
								icon:"error",
								title:"Server Error",
								text:"Unable to connect to server."
							});
						}
					});

				} else { Swal.fire({ icon: 'error', title: 'Incorrect password', text: 'The password you entered is invalid.' });
				}
			});
		});
	});
</script>

</html>
