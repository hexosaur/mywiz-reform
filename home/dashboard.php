<?php include('../config/postcheck.php') ?>

<!DOCTYPE html>
<html lang="en">
	<?php include('../pkg/assets/page/head.php')?>

<body class="">
	<?php include('../pkg/assets/page/sidebar.php')?>
	<?php include('../pkg/assets/page/navbar.php')?>

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
										<div class="col-md-12">
											<div class="page-header-title">
												<h5>Dashboard</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#!">Home Dashboard</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">

								<!-- Leave Requests -->
								<div class="col-xl-3 col-md-6 leave-permissions d-none">
									<div class="card prod-p-card bg-c-blue" style="cursor: pointer;">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Leave Requests</h6>
													<h3 class="m-b-0 text-white "><span class="approval_count"></span> Total</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-user-check text-c-blue f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-primary m-r-10 approval_count">13</span>Request Needs Approval</p>
										</div>
									</div>
								</div>

								<!-- <div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-blue" style="cursor: pointer;">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Filed Leave</h6>
													<h3 class="m-b-0 text-white">8 Total</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-folder-open text-c-blue f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-primary m-r-10">8</span>Total leave this year</p>
										</div>
									</div>
								</div>


								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-green" style="cursor: pointer;">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Evaluation</h6>
													<h3 class="m-b-0 text-white">11 Personnel</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-file-invoice text-c-green f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-success m-r-10">11</span>Evaluation Needed</p>
										</div>
									</div>
								</div>


								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-red" style="cursor: pointer;">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Announcements</h6>
													<h3 class="m-b-0 text-white">15 Unread</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-money-bill-alt text-c-red f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-danger m-r-10">15</span>Unread Announcements</p>
										</div>
									</div>
								</div> -->
				

							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end -->
	<?php include('../pkg/assets/page/footer.php')?>

	
</body>
<script>
	// INITIALIZATION

	// FOR LEAVE
	var employee_level, employee_branch, employee_dept, request_value, request_chain;






	// FUNCTIONS
	// YEARLY RESET FOR LEAVE
	$.get("../backend/system_yearly_leave_reset.php", function(data, status){
		data = data.trim();
		console.log("Yearly leave crosscheck:", data);
	});

	$('.leave-permissions').click(function(){
		window.location.href = "../leave/requests";

	})
	$.get("../backend/get_leave_request.php?security=123465", function(data,status){
		var array = jQuery.parseJSON(data);
		// console.log(array);
		if(array.status == 'error'){
			var is_adminlogin = <?php echo (isset($_SESSION['adminlogin']) && !empty($_SESSION['adminlogin'])) ? 1 : 0; ?>;
			console.log(is_adminlogin)
			employee_level = 9999;
		}else{
			employee_level =  parseInt(array.employee.access_level_value);
			employee_branch =  parseInt(array.employee.branch_id);
			employee_dept =  parseInt(array.employee.department_id);
		}
		let approval_count = 0;
		let canApprove = false;
		$.each(array.requests, function(i, req){
			if(req.step_type === "BR_DEPT_CHAIN"){
				canApprove =
					parseInt(employee_level) === parseInt(req.required_min_value) &&
					parseInt(employee_branch) === parseInt(req.step_branch_id ?? req.requester_branch_id) &&
					parseInt(employee_dept) === parseInt(req.step_department_id ?? req.requester_department_id);
			}
			else if(req.step_type === "BRANCH_CHAIN"){
				canApprove =
					parseInt(employee_level) === parseInt(req.required_min_value) &&
					parseInt(employee_branch) === parseInt(req.step_branch_id ?? req.requester_branch_id);
			}
			else if(req.step_type === "HR" || req.step_type === "TOP"){
				canApprove =
					parseInt(employee_level) === parseInt(req.required_min_value);
			}

			if(canApprove){
				approval_count++;

				$("#leave_approval_list").append(`
					<div class="card mb-2">
						<div class="card-body">
							<b>${req.requester_full_name}</b><br>
							Leave Type: ${req.leave_type_name}<br>
							Dates: ${req.date_from} to ${req.date_to}<br>
							Days: ${req.requested_days}<br>
							Step: ${req.step_type}
						</div>
					</div>
				`);
			}
		});
		if(canApprove){
			$(".leave-permissions").removeClass("d-none");
			$(".approval_count").html(approval_count);
		}
	});



</script>

</html>
