<?php include('../config/postcheck.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	.approval-stepper {
		position: relative;
		gap: 0;
	}
	.approval-stepper .step {
		flex: 1;
		min-width: 120px;
	}
	.approval-stepper .step:not(:last-child)::after {
		content: "";
		position: absolute;
		top: 22px;
		left: 50%;
		width: 100%;
		height: 4px;
		background: #dee2e6;
		z-index: 0;
	}

	.approval-stepper .step-circle {
		width: 44px;
		height: 44px;
		line-height: 40px;
		border-radius: 50%;
		margin: 0 auto;
		font-weight: 700;
		color: #fff;
		position: relative;
		z-index: 1;
		border: 3px solid #fff;
		box-shadow: 0 0 0 2px #dee2e6;
	}

	.approval-stepper .approved .step-circle {
		background: #28a745;
	}

	.approval-stepper .current .step-circle {
		background: #ffc107;
		color: #212529;
	}
	.approval-stepper .cancelled .step-circle {
		background: #adb5bd;
		
	}
	.approval-stepper .pending .step-circle {
		background: #5286f7;
	}

	.approval-stepper .rejected .step-circle {
		background: #dc3545;
	}

	.approval-stepper .approved:not(:last-child)::after {
		background: #28a745;
	}

	.approval-stepper .rejected:not(:last-child)::after {
		background: #dc3545;
	}

	.step-label {
		font-weight: 600;
		font-size: 14px;
	}

	.step-meta {
		font-size: 12px;
	}
	.image-file img{
		max-width: 100%;
		max-height: 150px;
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
	.leave-days {
		text-align: right; /* Optional: aligns the days to the right */
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
												<h5 class="m-b-10">Record</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Leave</a></li>
												<li class="breadcrumb-item"><a href="#">Record</a></li>
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
																<th>#</th>
																<th>Name</th>
																<th>From</th>
																<th>To</th>
																<th>Days</th>
																<th>Status</th>
																<th>Leave</th>
																<th>Action</th>
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
												<div class="approval-stepper d-flex justify-content-between align-items-start flex-wrap mb-4">
													<!-- this is a sample only -->
													<div class="step approved text-center position-relative">
														<div class="step-circle">1</div>
														<div class="step-label mt-2">Team Leader</div>
														<div class="step-meta small text-muted">2026-03-14 09:57:43</div>
													</div>
													<div class="step approved text-center position-relative">
														<div class="step-circle">2</div>
														<div class="step-label mt-2">Dept Head</div>
														<div class="step-meta small text-muted">2026-03-14 10:12:15</div>
													</div>

													<div class="step rejected text-center position-relative">
														<div class="step-circle">3</div>
														<div class="step-label mt-2">H.R</div>
														<div class="step-meta small text-muted">Pending</div>
													</div>

													<div class="step pending text-center position-relative">
														<div class="step-circle">4</div>
														<div class="step-label mt-2">Owner</div>
														<div class="step-meta small text-muted">Waiting</div>
													</div>

													<div class="step pending text-center position-relative">
														<div class="step-circle">5</div>
														<div class="step-label mt-2">President</div>
														<div class="step-meta small text-muted">Waiting</div>
													</div>
												</div>
												<div class="row image-file justify-content-center mb-5">
													<div class=" mx-auto d-block">
														<img src="../pkg/assets/media/img/default.jpg" alt="">
													</div>
												</div>
												<!-- <hr class="image-file"> -->
												<div class="justify-content-center d-flex">
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
													<!-- <button class="btn btn-primary btn-save" data-id="0">Cancel Request</button> -->
													<button class="btn btn-danger btn-cancel ">Go Back</button>
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
	tableload();



	$('.btn-save').click(function(){
		// var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		$.post("../backend/leave/post_leave_cancel_request.php", { id: id}, function (data, a) {
			data = data.trim();
			if(data == 'true'){
				Swal.fire({icon: 'success',title: "Success!", text : "Cancelation of Filed Leave Success",showConfirmButton: false,timer:1200});
				tableload();
				showMainPage();
			}else if(data == 'err'){
				Swal.fire({icon: 'success',title: "",showConfirmButton: false,timer:950});
				tableload();
				showMainPage();
			}else if(data.trim() == ''){
				Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
			}
		});
	});
	// EDIT
	$('.table').on('click', '.btn-edit', function () {
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.view-default').hide();
		pkid = $(this).data('id');
		$.get("../backend/leave/get_det_leave_request.php?security=123465&id=" + pkid, function(data, status) {
			var array = jQuery.parseJSON(data);
			$('.btn-save').attr('data-id', pkid);
			
			var imgPath = `../uploads/leaves/${array.request_details.attachment}`;
			var dateFiled = moment(array.request_details.created_at).format('MMM DD, YYYY hh:mm A');
			var dateFrom = moment(array.request_details.date_from).format('MMM DD, YYYY');
			var dateTo = moment(array.request_details.date_to).format('MMM DD, YYYY');
			var dateLeave;
			var stepsData = array.steps;
			var stepsHtml = '';
			if(array.request_details.attachment == null){
				$(".image-file img").addClass('d-none');
				imgPath = "../pkg/assets/media/img/attach.png";
			}else{
				$(".image-file img").removeClass('d-none');
			}
			$('.btn-save').prop('disabled', array.request_details.status !== 'Pending');
			$("#type_name").html(array.request_details.type_name);
			$("#proxy").html(array.request_details.proxy_name);
			$("#requested_days").html(array.request_details.requested_days);
			$("#date_file").html(dateFiled);
			$("#purpose").html(array.request_details.purpose);
			$("#dateleave").html(dateFrom === dateTo ? dateFrom : dateFrom + " - " + dateTo);
			$("#status").html(array.request_details.status);
			$("#requester").html(array.request_details.employee_full_name);
			
			$.each(stepsData, function(index, step) {
				var stepClass = '';
				var stepLabel = '';
				var actedAt = '';

				if (step.step_status == 'Approved') {
					stepClass = 'approved';
					actedAt = step.acted_at ? moment(step.acted_at).format('YYYY-MM-DD hh:mm A') : 'Approved';
				} 
				else if (step.step_status == 'Rejected') {
					stepClass = 'rejected';
					actedAt = step.acted_at ? moment(step.acted_at).format('YYYY-MM-DD hh:mm A') : 'Rejected';
				} 
				else if (step.step_status == 'Pending') {
					stepClass = 'pending';
					actedAt = 'Pending';
				}
				else if (step.step_status == 'Cancelled') {
					stepClass = 'cancelled';
					actedAt = 'Stopped';
				}

				stepsHtml += `<div class="step ${stepClass} text-center position-relative"><div class="step-circle">${step.step_no}</div><div class="step-label mt-2">${step.step_label}</div><div class="step-meta small text-muted">${actedAt}</div></div>`;
			});
			$(".approval-stepper").html(stepsHtml);				
			$(".image-file img").attr('src',imgPath);
		});
	});
	$('.btn-cancel').click(function(){
		tableload();
	});

	function tableload(){
		resetDataTable('#table_requests');
		$.get("../backend/leave/get_list_leave_request.php?security=123465&mode=archive", function(data,status){
			$("#table_requests tbody").html(data);
			setDataTable("#table_requests", { showActions : true, dtOptions : {pageLength: 13, lengthChange: false,	ordering:  true, searching: true, responsive: true }});
		});
		$.get("../backend/leave/get_list_leave_request_days.php?security=123465", function(data,status){
			$(".remaining_days").html(data);
		});
	}

	

	

</script>
</body>

</html>
