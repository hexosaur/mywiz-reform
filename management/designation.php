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
												<h5 class="m-b-10">Role</h5>
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
															<h3 class="mb-0"><span class="page-title"></span> List</h3>
														</div>
														<div class="col-6 col-md-2 d-flex justify-content-end">
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
													</div>
												<hr>
												<div class="table-responsive">
													<table id="table_role" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Role</th>
																<th class="text-center">Department</th>
																<th class="text-center">Access</th>
																<th class="text-center">Permissions</th>
																<th class="text-center">Description</th>
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
														<div class="form-group col-md-6">
															<label for="role_name"><span class="page-title"></span> Name <span class="text-danger">*</span></label>
															<input id="role_name" class="form-control form-control-sm" placeholder="Role Name"  required/>
														</div>
														<div class="form-group col-md-6">
															<label for="role_desc"><span class="page-title"></span> Description <span class="text-danger">*</span></label>
															<input id="role_desc" class="form-control form-control-sm" placeholder="Role Description"  required/>
														</div>
														<div class="form-group col-md-6">
															<label>Department <span class="text-danger">*</span></label>
															<select id="role_dept" class="dd_dept form-control" required>
																<option disabled selected>Select Department</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>Access <span class="text-danger">*</span></label>
															<!-- STATIC VALUE FOR THIS AREA -->
															<select id="role_access" class="form-control" required>
																<option disabled selected>Select Access</option>
																<option value="100">Administrator</option>
																<option value="10">Manager</option>
																<option value="1">Employee</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label>Permissions <span class="text-danger">*</span></label>
															<select id="role_perms" class="dd_perms tomsel form-control" multiple required>
															</select>
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
	// var prov_id, city_id, brgy_id, branch_id;
	var dept_id;
	const pagetitle = $('.page-title').html();
	dd_perms();
	dd_dept();
	tableload_Roles();
	function tableload_Roles(){
		resetDataTable();
		$.get("../backend/get_list_roles.php?security=123465", function(data,status){
			$("#table_role tbody").html(data);
			console.log("Rewrite table done")
			wrapTable();
			// EDIT
			$('.btn-edit').click(function() {
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				pkid = $(this).data('id');
				$.get("../backend/get_det_roles.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					// console.log(array);
					const sel = document.querySelector('#role_perms');
					$('.btn_save').attr('data-id', pkid);
					$('#role_name').val(array.role_name);
					$('#role_desc').val(array.role_desc);
					$('#role_dept').val(array.role_dept);
					$('#role_access').val(array.role_access); 
					if (sel && sel.tomselect) {
						sel.tomselect.setValue(array.role_perms || [], true); // true = silent (no change event spam)
						sel.tomselect.refreshItems(); // optional
					}
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
							tableload_Roles();
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
	function wrapTable() {
		const $tbl = $('.table');
		const rowHide = 4;
		const dt = $tbl.DataTable({ autoWidth: false, destroy: true, retrieve: false,
			columnDefs: [
				{ targets: rowHide, visible: false, searchable: true },
				{ targets: rowHide + 1, orderable: false, searchable: false }
			],
			createdRow: function (row, data) {
				const perms = (data[rowHide] || '').toString().trim();
				if (perms) {
					$(row)
						.addClass('dt-row-tip')
						.attr('data-perms', perms);
				}
			}, drawCallback: function () {
				const $rows = $tbl.find('tbody tr.dt-row-tip');
				$rows.each(function () {
					const perms = $(this).attr('data-perms') || '';
					$(this).attr('title', perms);
				});
				$rows.tooltip('dispose').tooltip({
					container: 'body',
					trigger: 'hover focus',
					placement: 'top'
				});
			}
		});
		dt.columns.adjust().draw(false);
	}
	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		// console.log("DATA ID OF SAVE BUTTON: ",id)
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ? 'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { role_name: $('#role_name').val(), role_desc : $('#role_desc').val(), role_dept :  $('#role_dept').val(), role_access : $('#role_access').val(), role_perms : $('#role_perms').val(),  pkid : id}
			// console.log(data)
			var json = JSON.stringify(data)
			// console.log(json);
			$.post("../backend/post_role.php", {role: json}, function (data, a) {
				data = data.trim();
				console.log(data);
				if(data == 'exist'){
					Swal.fire({icon: 'error', title: pagetitle+'already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
					tableload_Roles();
					showMainPage();
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
