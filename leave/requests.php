<?php include('../config/postcheck.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	

	.step-meta {
		font-size: 12px;
	}
	.image-file img{
		max-width: 100%;
		max-height: 200px;
		
	}

	.leave-info {
		display: flex;
		justify-content: space-between; /* Ensures equal spacing between name and days */
		align-items: center;  /* Vertically centers the content */
		margin: 5px 0; /* Optional: Adds margin between the items */
	}
	.leave-name {
		flex: 1; /* Makes the name span take up available space */
	}


</style>
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
										<div class="col-md-12">
											<div class="page-header-title">
												<h5 class="m-b-10">Requests</h5>
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
							<div class="container-fluid ">
								<div class="row view-default">
                                	<!-- [ basic-table ] start -->
								
									<div class="col-xl-12 col-md-12">
										<div class="card">
											<div class="card-body table-border-style">
												<div class="table-responsive">
													<table id="table_requests" class="table table-hover">
														<thead>
															<tr>
																<th class='text-center'>#</th>
																<th class='text-center'>Name</th>
																<th class='text-center'>Type</th>
																<th class='text-center'>Days</th>
																<th class='text-center'>Date</th>
																<th class='text-center'>Action</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- [ basic-table ] end -->
									<hr>
								</div>
							<!-- [ Main Content ] end -->

							<!-- [ Modify View ] start -->
								<div class="row view-modify d-none">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<h3 class="text-center"><span class="page-title"></span> <span class="text-btn"> Details</span> </h3>
												<hr>
												<div class="row image-file justify-content-center mb-5">
													<div class=" mx-auto d-block">
														<img src="../pkg/assets/media/img/default.jpg" alt="">
													</div>
												</div>
												<!-- <hr class="image-file"> -->
												<div class="row justify-content-center">
													<div class="col-md-8">
														<div class="leave-info">
															<span class="f-w-600 leave-name">Requestor:</span>
															<span class="leave-days" id="requester"></span>
														</div>
														<div class="leave-info">
															<span class="f-w-600 leave-name">Filed at:</span>
															<span class="leave-days" id="date_file"></span>
														</div>
														<div class="leave-info">
															<span class="f-w-600 leave-name">Leave Type:</span>
															<span class="leave-days" id="type_name"></span>
														</div>
														<div class="leave-info">
															<span class="f-w-600 leave-name">Proxy:</span>
															<span class="leave-days" id="proxy"></span>
														</div>
														<div class="leave-info">
															<span class="f-w-600 leave-name">Number of Days:</span>
															<span class="leave-days" id="requested_days"></span>
														</div>	
														<div class="leave-info">
															<span class="f-w-600 leave-name">Date of Leave:</span>
															<span class="leave-days" id="dateleave"></span>
														</div>	
														<div class="leave-info">
															<span class="f-w-600 leave-name">Purpose:</span>
															<span class="leave-days" id="purpose"></span>
														</div>
													</div>
												</div>
												<hr>
												<div class="text-center">
													<button class="btn btn-success" data-id="0"><i class="bi bi-check-lg"></i>Approve Request</button>
													<button class="btn btn-danger" data-id="0"><i class="bi bi-x-lg"></i>Reject Request</button>
													<button class="btn btn-info btn-cancel ">Go Back</button>
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
		</div>
	</div>


	<?php include('../pkg/assets/page/footer.php')?>
<script>
	tableload_LeaveRequests();

	$('.btn-success').click(function(){
		let id = $(this).attr('data-id');
		$.post("../backend/post_leave_request_approve.php", { id: id}, function (data, a) {
			data = data.trim();
			if(data == 'true'){
				Swal.fire({icon: 'success',title: "Success!", text : "Leave request approved!",showConfirmButton: false,timer:1200});
				tableload_LeaveRequests();
				showMainPage();
			}else if(data == 'err'){
				Swal.fire({icon: 'success',title: "",showConfirmButton: false,timer:950});
				tableload_LeaveRequests();
				showMainPage();
			}else if(data.trim() == ''){
				Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
			}
		});
	});
	$('.btn-danger').click(function(){
		let id = $(this).attr('data-id');
		$.post("../backend/post_leave_request_reject.php", { id: id}, function (data, a) {
			data = data.trim();
			if(data == 'true'){
				Swal.fire({icon: 'success',title: "Success!", text : "Leave request rejected!",showConfirmButton: false,timer:1200});
				tableload_LeaveRequests();
				showMainPage();
			}else if(data == 'err'){
				Swal.fire({icon: 'success',title: "",showConfirmButton: false,timer:950});
				tableload_LeaveRequests();
				showMainPage();
			}else if(data.trim() == ''){
				Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
			}
		});
	});
	
	function tableload_LeaveRequests(){
		resetDataTable('#table_requests');
		$.get("../backend/get_leave_request.php?security=123465", function(data, status){
			$("#table_requests tbody").html(data);
			setDataTable("#table_requests", { showActions : true, dtOptions : {pageLength: 13, lengthChange: false,	ordering:  true, searching: true, responsive: true, ordering: false , dom: 'lrtip' }});
			var array = jQuery.parseJSON(data);
			$("#table_requests tbody").html("");
			let employee_level  = parseInt(array.employee.access_level_value);
			let employee_branch = parseInt(array.employee.branch_id);
			let employee_dept   = parseInt(array.employee.department_id);
			let approval_count = 0;
			let row_no = 1;
			$.each(array.requests, function(i, req){
				let canApprove = false;
				if(req.step_type === "BR_DEPT_CHAIN"){
					canApprove =
						parseInt(employee_level) === parseInt(req.required_min_value) &&
						parseInt(employee_branch) === parseInt(req.step_branch_id ? req.step_branch_id : req.requester_branch_id) &&
						parseInt(employee_dept) === parseInt(req.step_department_id ? req.step_department_id : req.requester_department_id);
				}
				else if(req.step_type === "BRANCH_CHAIN"){
					canApprove =
						parseInt(employee_level) === parseInt(req.required_min_value) &&
						parseInt(employee_branch) === parseInt(req.step_branch_id ? req.step_branch_id : req.requester_branch_id);
				}
				else if(req.step_type === "HR" || req.step_type === "TOP"){
					canApprove =
						parseInt(employee_level) === parseInt(req.required_min_value);
				}

				if(canApprove){
					approval_count++;
					let date_text = moment(req.date_from).format('MMM DD, YYYY');
					if(req.date_to && req.date_to !== req.date_from){
						date_text += " to " + moment(req.date_to).format('MMM DD, YYYY');
					}
					let html = `<tr><td class='text-center'>${row_no}</td><td class='text-center'>${req.requester_full_name}</td><td class='text-center'>${req.leave_type_name}</td><td class='text-center'>${req.requested_days}</td><td class='text-center'>${date_text}</td><td class='text-center'><button class="btn btn-outline-info btn-sm btn-edit" data-id="${req.request_id}"><span class="feather icon-eye"></span></button></td></tr>`;
					$("#table_requests tbody").append(html);
					row_no++;
				}
			});
			
			if(approval_count <= 0){
				setTimeout(function() {
					window.location.href = "../home/dashboard";
				}, 1300); 
			}

			$('.btn-edit').click(function() {
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				pkid = $(this).data('id');
				$.get("../backend/get_det_leave_request.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					$('.btn-success, .btn-danger').attr('data-id', pkid);
					var imgPath = `../uploads/leaves/${array.request_details.attachment}`;
					var dateFiled = moment(array.request_details.created_at).format('MMM DD, YYYY hh:mm A');
					var dateFrom = moment(array.request_details.date_from).format('MMM DD, YYYY');
					var dateTo = moment(array.request_details.date_to).format('MMM DD, YYYY');
					var dateLeave;
					if(array.request_details.attachment == null){
						$(".image-file").addClass('d-none');
						imgPath = "../pkg/assets/media/img/attach.png";
					}else{
						$(".image-file").removeClass('d-none');
					}
					$("#requester").html(array.request_details.employee_full_name);
					$("#type_name").html(array.request_details.type_name);
					$("#proxy").html(array.request_details.proxy_name);
					$("#requested_days").html(array.request_details.requested_days);
					$("#date_file").html(dateFiled);
					$("#purpose").html(array.request_details.purpose);
					$("#dateleave").html(dateFrom === dateTo ? dateFrom : dateFrom + " - " + dateTo);
					$(".image-file img").attr('src',imgPath);
				});
			});









		});
	}

</script>
</body>

</html>
