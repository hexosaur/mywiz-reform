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

	.img-preview img {
		max-width: 100%;
		max-height: 150px;
	}
	.img-preview img:hover {
		opacity: 0.8;
	}
	.form-group.smooth-resize {
		transition: all 0.1s ease;
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
												<h5 class="m-b-10">Attachments</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Management</a></li>
												<li class="breadcrumb-item"><a href="#">Employee Attachments</a></li>
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
																<th>Attachments</th>
																<th>Actions</th>
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

							<!-- [ Add/Edit View ] start -->
								<div class="row view-modify d-none">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<h3 class="text-center"><span class="text-btn"></span> <span class="page-title"></span></h3>
												<hr>
												<form>
													<div class="add-employee">
														<div class="row">
															<div class="form-group col-md-3">
																<label for="attach_type">Attachement Type <span class="text-danger">*</span></label>
																<select id="attach_type" class="dd_attachment_type form-control" required>
																	<option disabled selected>Select Type</option>
																</select>
															</div>
															<div class="form-group col-md-4">
																<label for="attach_title">Attachment Title <span class="text-danger">*</span></label>
																<input id="attach_title" class="form-control form-control-sm" placeholder="Attachment Title"  required/>
															</div>
															<div class="form-group col-md-3">
																<label for="attach_ref_no">Reference No.</label>
																<input id="attach_ref_no" class="form-control form-control-sm" placeholder="Reference No." />
															</div>
															<div class="form-group col-md-3">
																<label for="attach_issue">Issued By </label>
																<input id="attach_issue" class="form-control form-control-sm" placeholder="Issued By" />
															</div>
															<div class="form-group col-md-4">
																<label for="attach_issue_date">Date Issued</label>
																<input  id="attach_issue_date" class="singleDatePicker form-control form-control-sm" readonly placeholder="Select a date"/>
															</div>
															<div class="form-group col-md-5 d-none">
																<label for="attach_expiry">Date Expiry <span class="text-danger">*</span></label>
																<input  id="attach_expiry" class="singleDatePicker form-control form-control-sm" readonly placeholder="Select a date"/>
															</div>
															<div class="form-group col-md-11">
																<label for="attach_remarks">Remarks <span class="text-danger">*</span></label>
																<input id="attach_remarks" class="form-control form-control-sm" placeholder="Remarks"  required/>
															</div>
															<div class="form-group col-md-8 align-items-center">
																<label class="mt-4" for="attach_file">Attach File <span class="text-danger">*</span></label>
																<input type="file" class="form-control" id="attach_file" required/>
															</div>
															<div class="form-group col-md-4 img-preview align-items-center">
																<div class="p-2 text-center">
																	<img src="../pkg/assets/media/img/attach.png"
																		id="attachmentPreviewImage"
																		style="cursor: pointer; max-width: 120px;"
																		data-toggle="modal"
																		data-target="#filePreviewModal">
																</div>
															</div>

															<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title text-center" id="filePreviewModalLabel">
																				<span>File Preview</span>
																			</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body text-center" id="filePreviewContent">
																			<img class="img-fluid" src="../pkg/assets/media/img/attach.png" alt="Preview">
																		</div>
																	</div>
																</div>
															</div>

															
															<input type="hidden" id="employee_id">
															<input type="hidden" id="employee_attachment_id" value="0">
															<input type="hidden" id="old_file_name">
															
														</div>
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn-save" data-id="0">Upload Attachment</button>
													<button class="btn btn-danger btn-cancel">Cancel</button>
													<button class="btn btn-danger btn-goback d-none">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							<!-- [ Add View ] end -->
							<!-- [ Detailed View ] start -->
								<div class="row view-detailed d-none">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body" style="max-height:45rem;">
												<h3><span id="attach_emp_name">Name</span>'s Attachments</h3>
												<div id="attach_per_emp_list"></div>
											</div>
											<div class="text-center mb-3">
												
												<button class="btn btn-danger btn-cancel">Go Back</button>
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
	var employee_id_test;
	var allowedFileSize = 15;
	const pagetitle = $('.page-title').html();
	tableload();
	dd_attachment_type();
	setupAttachmentPreview({ fileInputId: '#attach_file', previewImgSelector: '.img-preview img' });

	$(document).on('change', '.dd_attachment_type', function () {
		const pkid_attach = parseInt($('.dd_attachment_type').val(), 10);	
		$.get("../backend/admin/get_det_emp_attach_type.php?security=123465&id=" + pkid_attach, function(data, status) {
			var array = jQuery.parseJSON(data);
			// console.log(array);
			if(!!array.att_expirable){
				$('#attach_expiry').closest('.form-group').fadeIn(100).removeClass('d-none');
				// $('#attach_expiry').prop('required', true);
			}else{
				$('#attach_expiry').closest('.form-group').fadeOut(100).addClass('d-none');
				// $('#attach_expiry').prop('required', false).val('');
			}
			$('#attach_title').val(array.att_name);
			$('#attach_remarks').val(array.att_desc);
		});
	});


	$('.btn-save').click(function(){
		var chk = checkFormValidity();
		const attach_type = parseInt($('#attach_type').val(),10);
		const attach_id = parseInt($('#employee_attachment_id').val(),10);
		const attach_filename = parseInt($('#old_file_name').val(),10);
		let message = parseInt(attach_id, 10) === 0 ? 'New ' + pagetitle + ' Saved!' : pagetitle + ' Details Updated!';
		if(chk){
			const data = {  attach_title : $('#attach_title').val() , attach_ref_no : $('#attach_ref_no').val() , attach_issue : $('#attach_issue').val() ,attach_date : $('#attach_issue_date').val() , attach_type :  attach_type, attach_expiry : $('#attach_expiry').val() , attach_remarks : $('#attach_remarks').val() , employee_id : parseInt($('#employee_id').val(),10), pkid : attach_id}
			const formData = new FormData();
			const json = JSON.stringify(data);
			formData.append('data', json);
			const fileCheck = appendFileWithLimit(formData, '#attach_file', allowedFileSize);
			if (!fileCheck.ok) {
				Swal.fire({ icon: 'error', title: fileCheck.message, showConfirmButton: false, timer: 2500 });
				return;
			}
			console.log(json);
			$.ajax({
				url: "../backend/management/post_emp_attach.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					data = data.trim();
					console.log(data);
					if (data == 'exist') {
						Swal.fire({icon: 'error', title: pagetitle + ' already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
					} else if (data == 'invalid_file') {
						Swal.fire({icon: 'error', title: 'Invalid file! Allowed: Images and Documents Only', showConfirmButton: false, timer: 2500});
					}else if (data == 'file_err' || data == 'no_file') {
						Swal.fire({icon: 'error', title: 'File upload failed!', showConfirmButton: false, timer: 2500});
					} else if (data == 'true') {
						$('.view-modify').addClass('d-none');
						$('.btn-cancel').removeClass('d-none');
						
						tableload();
						Swal.fire({icon: 'success', title: message, showConfirmButton: false, timer: 950});
						showMainPage();
					} else {
						Swal.fire({icon: 'error', title: 'Error Uploading to Database!', showConfirmButton: false, timer: 1000});
					}
				},
				error: function (xhr, status, error) {
					console.error(xhr, status, error);
				}
			});
		}
	});
	$('.table').on('click', '.btn-add', function () {
		$('.view-modify').removeClass('d-none').hide().fadeIn();
		$('.view-detailed').addClass('d-none');
		$('.view-default').addClass('d-none');
		$('.btn-save').text('Upload Attachement');
		$('#employee_id').val($(this).data('id'));
		employee_id_test = parseInt($('#employee_id').val(),10);
		$('.btn-save').val();
	});




	// EDIT n View
	$('.table').on('click', '.btn-edit', function () {
		$('.view-detailed').removeClass('d-none').hide().fadeIn();
		$('.view-default').addClass('d-none');
		$('#employee_id').val($(this).data('id'));
		tableload();
	});
	$('#attach_per_emp_list').on('click', '.btn-edit-item', function () {		
		$('.view-modify').removeClass('d-none').hide().fadeIn();
		$('.btn-goback').removeClass('d-none').hide().fadeIn(10);
		$('.view-detailed').addClass('d-none');
		$('.view-default').addClass('d-none');
		$('.btn-save').text('Update Attachement');
		$('.btn-cancel').addClass('d-none');
		let pkid = $(this).data('id');
		$.get("../backend/management/get_det_emp_attach.php?security=123465&id=" + pkid, function(data, status) {
			let res = JSON.parse(data);
			console.log(res);
			
			if (res.status === 'error') {
				Swal.fire({
					icon: 'error',
					title: res.message,
					showConfirmButton: false,
					timer: 1800
				});
				return;
			}

			$('#employee_attachment_id').val(res.pkid);
			$('#employee_id').val(res.employee_id);
			$('#attach_type').val(res.attach_type).trigger('change');
			$('#attach_title').val(res.attach_title);
			$('#attach_ref_no').val(res.attach_ref_no);
			$('#attach_issue').val(res.attach_issue);
			$('#attach_issue_date').val(res.attach_date);
			$('#attach_expiry').val(res.attach_expiry);
			$('#attach_remarks').val(res.attach_remarks);
			// $('#attach_file').val(res.file_name);
			$('#old_file_name').val(res.old_file_name || res.file_name || '');
			setupAttachmentPreview({
				fileInputId: '#attach_file',
				previewImgSelector: '.img-preview img',
				displayInputId: '#attach_file_display',
				savedFileName: res.file_name,
				savedBaseUrl: '../uploads/employee_attachments'
			});
			$('#attach_file').prop('required', false);

		});


	});

	// DELETE
	$('#attach_per_emp_list').on('click', '.btn-del-item', function () {
		const pkid = $(this).data('id');
		confirmTypedDelete({
			url: "../backend/management/del_emp_attach.php?security=123465&id=" + pkid,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
			}
		});
	});
	// GO BACK TO EDIT/VIEW
	$('.btn-goback').click(function(){
		$('.view-default').addClass('d-none');
		$('.btn-goback').addClass('d-none');
		$('.view-modify').addClass('d-none');
		$('.view-detailed').removeClass('d-none').hide().fadeIn();
		$('.btn-cancel').removeClass('d-none').hide().fadeIn(10);
	});



	// MAIN CANCEL
	$('.btn-cancel').click(function(){
		$('.view-detailed').addClass('d-none');
		$('#employee_id').val(0);
		tableload();
	});
	function tableload(){
		resetDataTable('.table');
		$.get("../backend/management/get_list_emp_attach.php?security=123465&mode=archive", function(data,status){
			$(".table tbody").html(data);
			setDataTable(".table", { showActions : true, dtOptions : {pageLength: 13, lengthChange: false,	ordering:  true, searching: true, responsive: true }});
		});
		parseInt($('#employee_id').val(),10);
		$.get("../backend/management/get_list_attach_per_emp.php?security=123465&id=" + parseInt($('#employee_id').val(),10), function(data, status) {
			let array = JSON.parse(data);
			$('#attach_per_emp_list').html(array.html);
			$('#attach_emp_name').html(array.first_name);			
		});
	}

	

	

</script>
</body>

</html>
