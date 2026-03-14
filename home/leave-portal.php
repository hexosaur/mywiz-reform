<?php include('../config/postcheck.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>

	.img-preview img {
		max-width: 100%;
		max-height: 150px;
	}
	.img-preview img:hover {
		opacity: 0.8;
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
										<div class="col-md-8">
											<div class="page-header-title">
												<h5 class="m-b-10">File a Leave</h5>
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
								<div class="row">
                                <!-- [ basic-table ] start -->
								
								<div class="col-xl-12">
									<div class="card">
										<div class="card-body">
											<h3>File a Leave</h3>
											<hr>
											<form>
												<div class="row">
													<div class="form-group col-md-6">
														<label for="req_type">Choose Leave Type <span class="text-danger">*</span></label>
														<select id="req_type" class="dd_lvtype mb-3 form-control">
															<option disabled selected>Select Leave Type</option>

														</select>
													</div>
													<div class="form-group col-md-6">
														<label for="req_proxy">Select Proxy <span class="text-danger">*</span></label>
														<select disabled id="req_proxy" class="dd_proxy mb-3 form-control">
															<option disabled selected>Select Proxy</option>
														</select>
													</div>
													<hr>
													<div class="form-group col-md-8">
														<label for="req_dayS">Date From <span class="text-danger">*</span></label>
														<input  id="req_dayS" class="startDatePicker noSunday form-control form-control-sm" readonly placeholder="Select a starting date" required/>
													</div>
													
													<div class="form-group col-md-4">
														<label for="req_timeF">Time From <span class="text-danger">*</span></label>
														<select id="req_timeF" class="mb-3 form-control" required>
															<option disabled selected>Select Starting</option>
															<option>Morning</option>
															<option>Afternoon</option>
														</select>
													</div>
													<div class="form-group col-md-8">
														<label for="req_dayE">Date To <span class="text-danger">*</span></label>
														<input id="req_dayE" class="endDatePicker noSunday form-control form-control-sm" readonly placeholder="Select a ending date" required/>
													</div>
													<div class="form-group col-md-4">
														<label for="req_timeT">Time To <span class="text-danger">*</span></label>
														<select id="req_timeT" class=" form-control" required>
															<option disabled selected>Select Ending</option>
															<option value="Morning">Morning</option>
															<option value="Afternoon">Afternoon</option>
														</select>
													</div>
													<div class="form-group col-xl-12">
														<label for="req_purpose">Purpose of leave <span class="text-danger">*</span></label>
														<textarea class="form-control" id="req_purpose" rows="3" required></textarea>
													</div>
													<div class="form-group col-md-4 img-preview d-none align-items-center">
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
													<div class="form-group col-md-8 d-none align-items-center">
														<label class=" mt-4" for="req_attach" class="mr-2">Attach Image <span class="text-danger">*</span></label>
														<input type="file" class="form-control" id="req_attach" />
													</div>
												</div>
											</form>
											<hr>
											<div class="text-center">
												<button class="btn btn-primary btn_save">Apply</button>
												<button class="btn btn-danger btn-cancel" onclick="location.href='../home/dashboard'">Cancel</button>
											</div>
										</div>
									</div>
								</div>

                                <!-- [ basic-table ] end -->
								
								
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
	var usable_days;
	var employee_id = <?php echo (int)$_SESSION['login']; ?>;
	dd_leave_type(employee_id);

	setupFilePreview('#req_attach', '.img-preview img');


	$('.btn_save').click(function () {
		var chk = checkFormValidity();
		var id = employee_id;
		
		if(chk){
			var fileInput = $('#req_attach');
			var requested_days = computeDaySelect('#req_dayS', '#req_dayE', '#req_timeF', '#req_timeT');
			let message = 'New Leave Request Success';
			var data = { req_type: $('#req_type').val(), req_proxy : $('#req_proxy').val(), req_dayS : $('#req_dayS').val(),req_dayE : $('#req_dayE').val(), req_timeF : $('#req_timeF').val(),req_timeT : $('#req_timeT').val(), requested_days : requested_days, req_purpose : $('#req_purpose').val(), pkid : id}
			var json = JSON.stringify(data);
			if(requested_days > usable_days){
					Swal.fire({icon: 'error',  title: 'Selection Limit Reached', text: `You can only select up to ${usable_days} day(s) left. You filed ${requested_days} day(s)`, showConfirmButton: false, timer: 4500});
			}else{
				const formData = new FormData();
				 if (fileInput[0].files.length > 0) {
					formData.append('fileupload', fileInput[0].files[0]);
				} 
				formData.append('data', json);
				// console.log(formData);
				
				$.ajax({
					url: "../backend/post_leave_request.php",
					type: "POST",
					data: formData,
					contentType: false, 
					processData: false,
					success: function(data) {
						console.log(data.trim());
						if(data.trim() == 'err'){
							Swal.fire({icon: 'error', title: 'Fail to file leave request.', showConfirmButton: false, timer: 2500});
						}else if(data.trim() == 'true'){
							Swal.fire({icon: 'success',title: message, text: "Please wait for validation", showConfirmButton: false,timer:950});
							setTimeout(function() {
								window.location.href = "../home/leave-record";
							}, 850); 
							
						}else if(data.trim() == 'file_invalid'){
							Swal.fire({icon: 'error', title: 'Fail to file leave request.', text: 'Invalid file type! Only JPG, JPEG, PNG, GIF are allowed.' , showConfirmButton: false, timer: 2500});
						}else if(data.trim() == 'file_exceed'){
							Swal.fire({icon: 'error', title: 'Fail to file leave request.', text: 'File exceeded 9MB' ,  showConfirmButton: false, timer: 2500});
						}else if(data.trim() == ''){
							Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr, status, error); 
					}
				});
			}
		}
	
	});
	$('#req_type').change(function(){
		var req_id = $('#req_proxy').val()
		var ent_id = $(this).val();
		// console.log(ent_id);
		$('.btn_save').attr('data-id', req_id);
		$.get("../backend/get_det_leave_ent_dd.php?security=123465&id=" + ent_id, function(data, status) {
			var array_ent = jQuery.parseJSON(data);
			console.log(array_ent);
			usable_days = parseFloat(array_ent.allowed_days + array_ent.modified_days - array_ent.used_days, 2);
			console.log(usable_days);
			const needsAttach = array_ent.requires_attachment == 1;
			const needsProxy = array_ent.requires_proxy == 1;
			const $wrap = $('#req_attach').closest('.form-group');			
			if (needsAttach) {
				$wrap.removeClass('d-none').hide().fadeIn(400);
				$('#req_attach').prop('required', true);
				$('.img-preview').removeClass('d-none').hide().fadeIn(400);
			} else {
				$('#req_attach').prop('required', false).val('');
				$wrap.fadeOut(10, function () {
					$wrap.addClass('d-none').show();
					$('.img-preview').addClass('d-none').show();
				});
			}
			if (needsProxy) {
				dd_proxy(employee_id);
				$('#dd_proxy').prop('required', true);
			}else{
				$('.dd_proxy').prop('selectedIndex', 0);
				$('#dd_proxy').prop('required', false).val('');
			}
			$('#req_proxy').prop('disabled', array_ent.requires_proxy != 1);
		});
	});




	
</script>
</html>
