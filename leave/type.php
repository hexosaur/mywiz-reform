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
												<h5 class="m-b-10">Category</h5>
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
															<h3 class="mb-0"><span class="page-title"></span> List</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table id="table_leave" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Code</th>
																<th class="text-center">Name</th>
																<th class="text-center">Description</th>
																<th class="text-center">Days</th>
																<th class="text-center">Type</th>
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
													<div class="row">
														<div class=" form-group col-md-6">
															<label for="type_name">Leave Category Name <span class="text-danger">*</span></label>
															<input id="type_name" class="form-control form-control-sm" placeholder="Name" required/>
														</div>
														<div class=" form-group col-md-3">
															<label for="type_code">Leave Category Code <span class="text-danger">*</span></label>
															<input id="type_code" class="form-control form-control-sm" placeholder="Code" required/>
														</div>
														<div class=" form-group col-md-3">
															<label>Gender <span class="text-danger">*</span></label>
															<select id="type_gender" class="form-control" required>
																<option value="All" selected>All</option>
																<option value="Male">Male only</option>
																<option value="Female">Female Only</option>
															</select>
														</div>
														<div class=" form-group col-md-6">
															<label for="type_desc">Leave Description <span class="text-danger">*</span></label>
															<input id="type_desc" class="form-control form-control-sm" placeholder="Description"/>
														</div>
														<div class=" form-group col-md-6">
															<label for="type_days">Maximum Number of Days <span class="text-danger">*</span></label>
															<input id="type_days" type="number" class="form-control form-control-sm" placeholder="Max Days" required/>
														</div>
													</div>
													<div class="row justify-content-evenly">
														<div class="form-group ml-3 col form-check">
															<input type="checkbox" class="form-check-input" id="type_pay">
															<label class="form-check-label" for="type_pay">With Pay</label>
														</div>
														<div class="form-group ml-3 col form-check">
															<input type="checkbox" class="form-check-input" id="type_attach">
															<label class="form-check-label" for="type_attach">Attachment Required</label>
														</div>
														<div class="form-group ml-3 col form-check">
															<input type="checkbox" class="form-check-input" id="type_proxy">
															<label class="form-check-label" for="type_proxy">Has Proxy</label>
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
	const pagetitle = $('.page-title').html();
	tableload_Leave();
	// FUNCTIONS
	function tableload_Leave(){
		resetDataTable();
		$.get("../backend/get_list_leave_type.php?security=123465", function(data,status){
			$("#table_leave tbody").html(data);
			setDataTable(".table", {rowHide : 3, showActions : true});
			// EDIT
			$('.btn-edit').click(function() {
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				pkid = $(this).data('id');
				$.get("../backend/get_det_leave_type.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					console.log(array);
					$('.btn_save').attr('data-id', pkid);
					$('#type_name').val(array.type_name);
					$('#type_code').val(array.type_code);
					$('#type_desc').val(array.type_desc);
					$('#type_days').val(array.type_days);
					$('#type_pay').prop('checked', !!array.type_pay);
					$('#type_attach').prop('checked', !!array.type_attach);
					$('#type_proxy').prop('checked', !!array.type_proxy);

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
							Swal.fire({ icon: 'error', title: 'Error deleting '+pagetitle, showConfirmButton: false, timer: 1200 });
						}
						});
					}
				});
			});			
		});
	}
	// const cancan = 0;
	// console.log(!!cancan);
	

	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			let type_pay = $('#type_pay').prop('checked') ? 1 : 0;
			let type_attach = $('#type_attach').prop('checked') ? 1 : 0;
			let type_proxy = $('#type_proxy').prop('checked') ? 1 : 0;
			var data = { type_name : $('#type_name').val(), type_code : $('#type_code').val(), type_gender : $('#type_gender').val() , type_desc : $('#type_desc').val(), type_days : $('#type_days').val(), type_pay : type_pay, type_attach : type_attach, type_proxy : type_proxy, pkid : id };
			var json = JSON.stringify(data);
			console.log(data);
			$.post("../backend/post_leave_type.php", { data: json}, function (data, a) {
				data = data.trim();
				console.log(data);
				if(data == 'exist_code'){
					Swal.fire({icon: 'error', title: pagetitle+' Code already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'exist_name'){
					Swal.fire({icon: 'error', title: pagetitle+' Name already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
					tableload_Leave();
					showMainPage();
					is_active = 1;
				}else if(data.trim() == ''){
					Swal.fire({icon: 'error',title: 'Error Uploading to Database!',showConfirmButton: false,timer:1000});
				}
			});
		}
	});
	$('.cnl-btn').click(function(){	

	});
	

	
</script>

</html>
