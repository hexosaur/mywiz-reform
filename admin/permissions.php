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
												<h5 class="m-b-10">Permissions</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Admin</a></li>
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
													<table id="table_perms" class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Name</th>
																<th class="text-center">Title</th>
																<th class="text-center">Description</th>
																<th class="text-center">Class</th>
																<th class="text-center">Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="text-center">1</td>
																<td class="text-center">view_inventory</td>
																<td class="text-center">View Inventory</td>
																<td class="text-center">To View the Inventory Page</td>
																<td class="text-center">perms_view-inventory</td>
																<td class="text-center">
																	<div class="btn btn-outline-info btn-sm btn-edit" data-id="2"><span class="feather icon-edit"></span></div>
																	<div class="btn btn-outline-danger btn-sm btn-del" data-id="2"><span class="feather icon-trash-2"></span></div>
																</td>
															</tr>												
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
															<label for="perms_name"><span class="page-title"></span> Name <span class="text-danger">*</span></label>
															<input id="perms_name" class="form-control form-control-sm" placeholder="i.e view_inventory"  required/>
														</div>
														<div class="form-group col-md-6">
															<label for="perms_title"><span class="page-title"></span> Title <span class="text-danger">*</span></label>
															<input id="perms_title" class="form-control form-control-sm" placeholder=" i.e View Inventory "  required/>
														</div>
														<div class="form-group col-md-6">
															<label for="perms_class"><span class="page-title"></span> Class <span class="text-danger">*</span></label>
															<input id="perms_class" class="form-control form-control-sm" placeholder="i.e. view-perms-inventory"  required/>
														</div>
														<div class="form-group col-md-6">
															<label for="perms_desc"><span class="page-title"></span> Description <span class="text-danger">*</span></label>
															<input id="perms_desc" class="form-control form-control-sm" placeholder="Permission Description"  required/>
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
	var perms_id;
	const pagetitle = $('.page-title').html();
	// script for body functions default
	// Initialize
	tableload_Perms();
	function tableload_Perms() {
		resetDataTable();
		$.get("../backend/get_list_perms.php?security=123465", function (data) {
			data = (data || "").trim();
			$("#table_perms tbody").html(data);
			 wrapTable();
			// EDIT
			$('.btn-edit').click(function() {
				$('.text-btn').text("Edit");
				$('.view-modify').fadeIn().removeClass('d-none');
				$('.view-default').hide();
				pkid = $(this).data('id');
				$.get("../backend/get_det_perms.php?security=123465&id=" + pkid, function(data, status) {
					var array = jQuery.parseJSON(data);
					// console.log(array);
					$('.btn_save').attr('data-id', pkid);
					$('#perms_name').val(array.perms_name);
					$('#perms_title').val(array.perms_title);
					$('#perms_class').val(array.perms_class);
					$('#perms_desc').val(array.perms_desc);				
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
						$.post("../backend/del_perms.php?security=123465&id=" + id, function (data, status) {
						data = (data || '').trim();
						if (data === 'true') {
							Swal.fire({ showConfirmButton: false, title: 'Deleted!', text: pagetitle+' deleted.', icon: 'success', timer: 700 });
							tableload_Perms();
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

	function  wrapTable() {
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

	


	$('#perms_name, #perms_class').on('keydown', function(e) {
		if (e.key === " ") {
			e.preventDefault();
		} 
	}).on('input', function() {
        $(this).val($(this).val().toLowerCase());
    });;


	// script for interactions
	// ACTION LISTENERS
	$('.btn_save').click(function(){
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');
		if(chk){
			// Convert id to a number (if needed)
			var notif = parseInt(id, 10);
			let message = notif === 0 ?  'New '+pagetitle+' Saved!' : pagetitle+' Details Updated!';
			var data = { perms_name: $('#perms_name').val(), perms_title : $('#perms_title').val(), perms_class : $('#perms_class').val(), perms_desc :  $('#perms_desc').val(), pkid : id}
			var json = JSON.stringify(data);
			$.post("../backend/post_perms.php", {permission: json}, function (data, a) {
				data = data.trim();
				// console.log(data)
				if(data == 'exist_name'){
					Swal.fire({icon: 'error', title: pagetitle+'Name already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'exist_title'){
					Swal.fire({icon: 'error', title: pagetitle+'Title already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'exist_class'){
					Swal.fire({icon: 'error', title: pagetitle+'Class already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'exist'){
					Swal.fire({icon: 'error', title: 'No changes made! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
				}else if(data == 'true'){
					tableload_Perms();
					Swal.fire({icon: 'success',title: message,showConfirmButton: false,timer:950});
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
