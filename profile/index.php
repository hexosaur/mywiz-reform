<?php include('../config/postcheck.php') ?>

<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	.emp-banner.card{
		position: relative;
		overflow: hidden;
		border: 0;
		border-radius: 12px;
		margin-bottom: 1rem;
		background: #101923;
	}

	.emp-banner-cover{
		width: 100%;
		height: 280px;
		object-fit: cover;
		display: block;
	}

	.emp-banner-overlay{
		position: absolute;
		inset: 0;
		background: linear-gradient(
			180deg,
			rgba(8,12,18,0.10) 0%,
			rgba(8,12,18,0.18) 30%,
			rgba(8,12,18,0.40) 65%,
			rgba(8,12,18,0.68) 100%
		);
	}

	.emp-banner-glass{
		position: absolute;
		left: 0;
		right: 0;
		bottom: 0;
		padding: 18px 24px;
		background: rgba(22, 30, 42, 0.50);
		backdrop-filter: blur(10px);
		-webkit-backdrop-filter: blur(10px);
		border-top: 1px solid rgba(255,255,255,0.08);
	}

	.emp-banner-avatar{
		width: 110px;
		height: 110px;
		border-radius: 50%;
		object-fit: cover;
		object-position: center;
		border: 4px solid rgba(255,255,255,0.92);
		background: #fff;
		box-shadow: 0 8px 22px rgba(0,0,0,0.22);
		margin-top: -48px;
		flex: 0 0 auto;
	}

	.emp-banner-meta{
		min-width: 0;
	}

	.emp-banner-name{
		font-size: 30px;
		line-height: 1.1;
		font-weight: 700;
		color: #fff;
		margin: 0 0 6px;
	}

	.emp-banner-sub{
		font-size: 15px;
		font-weight: 500;
		color: rgba(255,255,255,0.88);
	}

	.emp-banner-sub .sep{
		opacity: .45;
		margin: 0 6px;
	}

	.emp-banner-action .btn{
		padding: .55rem 1.15rem;
	}

	@media (max-width: 767.98px){
		.emp-banner-cover{
			height: 320px;
		}

		.emp-banner-glass{
			padding: 16px;
		}

		.emp-banner-avatar{
			width: 88px;
			height: 88px;
			margin-top: -34px;
		}

		.emp-banner-name{
			font-size: 22px;
		}

		.emp-banner-sub{
			font-size: 13px;
		}

		.emp-banner-action{
			width: 100%;
			margin-top: 12px;
		}

		.emp-banner-action .btn{
			width: 100%;
		}
	}

	.profile-contain {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 5px 0;
	}
	.profile-title {
		flex: 1;
	}
	.profile-detail {
		text-align: right;
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
								 <div class="row view-default">
									<div class="col-xl-12">

										<div class="card emp-banner mb-0 rounded-0">
											<img src="../uploads/profile/banner.jpg" class="emp-banner-cover" alt="Profile Banner">
											<div class="emp-banner-overlay"></div>

											<div class="emp-banner-glass">
												<div class="d-flex align-items-end justify-content-between flex-wrap">
													<div class="d-flex align-items-end flex-wrap mr-3">
														<img id="profile-picture"
															src="../uploads/profile/default.jpg"
															class="emp-banner-avatar mr-3"
															alt="User Profile">

														<div class="emp-banner-meta pb-1">
															<h2 class="emp-banner-name mb-1" id="profile-name">Employee Name</h2>
															<div class="emp-banner-sub">
																<span class="profile-code">EMP-0001</span>
																<span class="sep">|</span>
																<span class="profile-department-text">Department</span>
																<span class="sep">|</span>
																<span class="profile-branch-text">Branch</span>
															</div>
														</div>
													</div>
													
													<div class="emp-banner-action pb-1">
														<button class="btn btn-primary" type="button"><i class="fa fa-edit mr-2"></i>Edit Profile
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" id="pills-main-tab" data-toggle="pill" href="#pills-main" role="tab" aria-controls="pills-home" aria-selected="true">Main</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="pills-employment-tab" data-toggle="pill" href="#pills-employment" role="tab" aria-controls="pills-employment" aria-selected="false">Employment</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="pills-document-tab" data-toggle="pill" href="#pills-document" role="tab" aria-controls="pills-document" aria-selected="false">Documents</a>
													</li>
												</ul>
												<div class="tab-content" id="pills-tabContent" style="padding: 0;background: none;box-shadow: none;">
													<!-- MAIN TAB -->
													<div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab">
														<div class="row">
															<div class="col-md-4">
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

															<div class="col-md-6 profile-post">
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
													</div>

													<!-- ABOUT TAB -->
													<div class="tab-pane fade show " id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
														<div class="row">
															<!-- LEFT PANE -->
															<div class="col-md-5">
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																		<div class="card-header"><h5>Address Information</h5></div>
																		<div class="card-body">
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Email</span><span class="profile-detail">A</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Mobile Number</span><span class="profile-detail">B</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Telephone</span><span class="profile-detail">B</span>
																			</div>
																		</div>
																	</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																		<div class="card-header"><h5>Contact Information</h5></div>
																		<div class="card-body">
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Email</span><span class="profile-detail">A</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Mobile Number</span><span class="profile-detail">B</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Telephone</span><span class="profile-detail">B</span>
																			</div>
																		</div>
																	</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																		<div class="card-header"><h5>Emergency Contact</h5></div>
																		<div class="card-body">
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Name</span><span class="profile-detail">A</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Relationship</span><span class="profile-detail">B</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Contact Number</span><span class="profile-detail">C</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Address</span><span class="profile-detail">C</span>
																			</div>
																		</div>
																	</div>
																	</div>
																</div>
															</div>
															<!-- RIGHT PANE -->
															 <div class="col-md-7">
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																			<div class="card-header"><h5>Personal Information</h5></div>
																			<div class="card-body">
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Full Name</span><span class="profile-detail">A</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">NickName</span><span class="profile-detail">B</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Employee ID</span><span class="profile-detail">C</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Date of Birth</span><span class="profile-detail">D</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Civil Status</span><span class="profile-detail">E</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Nationality</span><span class="profile-detail">F</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted mb-2">Bloodtype</span><span class="profile-detail">G</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																			<div class="card-header"><h5>Biography</h5></div>
																			<div class="card-body">
																				<p>
																					A LONG TEXT <br>
																					Ad pariatur nostrud pariatur exercitation ipsum ipsum culpa mollit commodo mollit ex. Aute sunt incididunt amet commodo est sint nisi deserunt pariatur do. Aliquip ex eiusmod voluptate
																		exercitation
																		cillum id incididunt elit sunt. Qui minim sit magna Lorem id et dolore velit Lorem amet exercitation duis deserunt. Anim id labore elit adipisicing ut in id occaecat pariatur ut ullamco ea tempor duis.Ad pariatur nostrud pariatur exercitation ipsum ipsum culpa mollit commodo mollit ex. Aute sunt incididunt amet commodo est sint nisi deserunt pariatur do. Aliquip ex eiusmod voluptate
																		exercitation
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															
															
								
															
														</div>
													</div>
													<!-- EMPLOYMENT TAB -->
													<div class="tab-pane fade" id="pills-employment" role="tabpanel" aria-labelledby="pills-employment-tab">
														<div class="row">
															<!-- LEFT PANE -->
															<div class="col-md-5">
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																		<div class="card-header"><h5>Work Timeline</h5></div>
																		<div class="card-body">
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Email</span><span class="profile-detail">A</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Mobile Number</span><span class="profile-detail">B</span>
																			</div>
																			<div class="profile-contain">
																				<span class="profile-title f-w-600 text-muted">Telephone</span><span class="profile-detail">B</span>
																			</div>
																		</div>
																	</div>
																	</div>
																</div>
																
															</div>
															<!-- RIGHT PANE -->
															<div class="col-md-7">
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																			<div class="card-header"><h5>Employment Summary</h5></div>
																			<div class="card-body">
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Status</span><span class="profile-detail">A</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Date Hired</span><span class="profile-detail">B</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Years of Service</span><span class="profile-detail">C</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Employee Type</span><span class="profile-detail">D</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="card">
																			<div class="card-header"><h5>Position Details</h5></div>
																			<div class="card-body">
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Department</span><span class="profile-detail">D</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Designation</span><span class="profile-detail">D</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Branch</span><span class="profile-detail">D</span>
																				</div>
																				<div class="profile-contain">
																					<span class="profile-title f-w-600 text-muted">Immediate Head</span><span class="profile-detail">D</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
															</div>



														</div>
													</div>

													<!-- DOCUMENTS TABS -->
													<div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">
														<div class="row">
															<div class="col md-12">
																<div class="card">
																	<div class="card-header"><h5>Employee Documents</h5> <span class="text-right">UPLOAD DOCUMENTS</span></div>
																	<div class="card-body">
																		INSERT TABLE HERE FOR DOCUMENT LISTS
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
			let requestURL = "../backend/system/system_get_employee_profile.php?security=123465";
			if(lastSegment && lastSegment !== "customize" && lastSegment !== "profile"){
				requestURL += "&user=" + encodeURIComponent(lastSegment);
			}
			$.get(requestURL, function(data, status){
				var array = jQuery.parseJSON(data);
				console.log(array);
				
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

					$.get("../backend/management/get_det_emp.php?security=123465&id=" + pkid, function(data, status){
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
	// $('.btn-save').click(function () {
	// 	var fileInput = $('#profile-image');
	// 	var data = {
	// 		username: $("#username").val(),
	// 		password: $("#password").val(),
	// 		prov_id: $("#prov_id").val(),
	// 		city_id: $("#city_id").val(),
	// 		brgy_id: $("#brgy_id").val(),
	// 		address_line: $("#address_line").val(),
	// 		first_name: $("#first_name").val(),
	// 		middle_name: $("#middle_name").val(),
	// 		surname: $("#surname").val(),
	// 		suffix: $("#suffix").val(),
	// 		birth_date: $("#birth_date").val(),
	// 		marital_status: $("#marital_status").val(),
	// 		gender: $("#gender").val(),
	// 		email: $("#email").val(),
	// 		contact_no: $("#contact_no").val(),
	// 		sss_no: $("#sss_no").val(),
	// 		pagibig_no: $("#pagibig_no").val(),
	// 		tin_no: $("#tin_no").val(),
	// 		philhealth_no: $("#philhealth_no").val()
	// 	};

	// 	var json = JSON.stringify(data);

	// 	Swal.fire({ title: 'Confirm Profile Update', text: 'Enter your current password to continue.', input: 'password', inputPlaceholder: 'Current password', inputAttributes: { autocapitalize: 'off', autocorrect: 'off' }, showCancelButton: true, confirmButtonText: 'Verify', cancelButtonText: 'Cancel', inputValidator: (value) => { if (!value) { return 'Password is required.'; } }
	// 	}).then((result) => {
	// 		if (!result.isConfirmed) return;
	// 		var verifyPassword = result.value;
	// 		$.post("../backend/system/system_verify_profile_password.php", {
	// 			password: verifyPassword
	// 		}, function (verifyRes) {
	// 			verifyRes = verifyRes.trim();
	// 			if (verifyRes === 'true') {
	// 				const formData = new FormData();
	// 				if (fileInput[0].files.length > 0) {
	// 					formData.append('profile_image', fileInput[0].files[0]);
	// 				}
	// 				formData.append('data', json);
	// 				formData.append('verify_password', verifyPassword);
	// 				$.ajax({
	// 					url: "../backend/profile/post_update_profile.php",
	// 					type: "POST",
	// 					data: formData,
	// 					processData: false,
	// 					contentType: false,
	// 					success: function(res){
	// 						res = res.trim();
	// 						if(res === "success"){
	// 							let newUsername = $("#username").val().trim();
	// 							Swal.fire({
	// 								icon: "success",
	// 								title: "Profile Updated Successfully",
	// 								showConfirmButton: false,
	// 								timer: 1200
	// 							}).then(() => {
	// 								if(newUsername){
	// 									window.location.href = "../profile/" + encodeURIComponent(newUsername);
	// 								}else{
	// 									location.reload();
	// 								}
	// 							});
	// 						}
	// 						else if(res === "username_exist"){
	// 							Swal.fire({
	// 								icon: "error",
	// 								title: "Username already exists",
	// 								text: "Please choose a different username.",
	// 								confirmButtonColor: "#3085d6"
	// 							});
	// 							$("#username").focus();

	// 						}
	// 						else if(res === "email_exist"){
	// 							Swal.fire({
	// 								icon: "error",
	// 								title: "Email already exists",
	// 								text: "This email is already registered to another account.",
	// 								confirmButtonColor: "#3085d6"
	// 							});
	// 							$("#email").focus();

	// 						}
	// 						else if(res === "session_expired"){
	// 							Swal.fire({
	// 								icon: "warning",
	// 								title: "Session expired",
	// 								text: "Please login again."
	// 							}).then(()=>{
	// 								window.location.href = "../auth/login";
	// 							});
	// 						}
	// 						else{

	// 							Swal.fire({
	// 								icon: "error",
	// 								title: "Update Failed",
	// 								text: "Something went wrong while updating your profile."
	// 							});
	// 						}
	// 					},
	// 					error:function(){
	// 						Swal.fire({
	// 							icon:"error",
	// 							title:"Server Error",
	// 							text:"Unable to connect to server."
	// 						});
	// 					}
	// 				});

	// 			} else { Swal.fire({ icon: 'error', title: 'Incorrect password', text: 'The password you entered is invalid.' });
	// 			}
	// 		});
	// 	});
	// });




	$(document).off('click.profileHeaderNav', '#profileHeaderNav .nav-link').on('click.profileHeaderNav', '#profileHeaderNav .nav-link', function(){
		$('#profileHeaderNav .nav-link').removeClass('active');
		$(this).addClass('active');
	});
</script>

</html>
