<?php include('../config/postcheck.php') ?>
<?php
	include('../config/check_permission.php');
	$required_permission_class = ['superadmin'];
	check_permission($required_permission_class);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	.product-image{
		width: 220px;
		aspect-ratio: 1 / 1;
	}

	.product-image img{
		object-fit: cover;
	}


	.tbl-product-image{
		width: 100px;
		height: 100px;
		object-fit: cover;
		border-radius: 50%;
		margin-right: 10px;
		flex-shrink: 0;
		border: 1px solid #dee2e6;
		background: #f8f9fa;
	}
	.tbl-supplier-container{
		display: flex;
		flex-direction: column;
	}

	.tbl-supplier-item{
		font-size: 12px;
		padding: 3px 6px;
		margin-bottom: 2px;
		display: block;
	}

	.tbl-supplier-more{
		font-size: 12px;
		font-weight: 600;
		color: #6c757d;
		padding: 2px 4px;
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
												<h5 class="m-b-10">Products</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../inventory/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Inventory</a></li>
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
														<div class="col col-md-6">
															<h3 class="mb-0"><span class="page-title"></span> Catalog</h3>
														</div>
														<div class="col col-md-6 d-flex justify-content-between">
															<div class="d-flex align-items-center">
																<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-box-arrow-in-down"></i> EXPORT</button>
															</div>
															<div class="d-flex align-items-center">
																<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-box-arrow-in-down"></i> GET TEMPLATE</button>
															</div>
															<div class="d-flex align-items-center">
																<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-upload"></i> IMPORT</button>
															</div>
															<button class="btn btn-primary btn-add">Add <span class="page-title"></span></button>
														</div>
														
													</div>
												<hr>
												<div class="table-responsive">
													<table class="table_product table table-hover">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th>Product</th>
																<th>Category</th>
																<th>Brand</th>
																<th>Supplier</th>
																<th class="text-center">Unit</th>
																<th class="text-center">Markup</th>
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
													<!-- MODIFIED -->
													<div class="row mt-3 mb-3 d-none is-edit">
														<div class="col text-center">
															<div class="btn-group btn-group-toggle status-toggle" data-toggle="buttons">
																
																<label for="is-active" class="btn btn-sm btn-secondary" data-value="1">
																	<input type="radio" name="options" id="is-active" value="1"> Active
																</label>

																<label for="is-inactive" class="btn btn-sm btn-secondary" data-value="0">
																	<input type="radio" name="options" id="is-inactive" value="0"> Inactive
																</label>

																<!-- ADDED -->
																<label for="is-eol" class="btn btn-sm btn-secondary" data-value="2">
																	<input type="radio" name="options" id="is-eol" value="2"> EOL
																</label>
																<div class="btn-group ml-2 stock-view d-none" role="group">
																	<button type="button" id="is-lowstock" class="btn btn-sm btn-warning" disabled>Low Stock</button>
																	<button type="button" id="is-nostock" class="btn btn-sm btn-danger" disabled>No Stock</button>
																</div>
															</div>
															<div class="mt-2">
																<small id="product-status-note" class="d-block mt-1 text-muted"></small>
															</div>
														</div>
													</div>
													<div class="row g-3 align-items-start">
														
														<!-- Product Image -->
														<div class="col-12 col-xl-3 order-1">
															<div class="product-image border rounded overflow-hidden mx-auto">
																<img src="../pkg/assets/media/img/default.jpg" class="w-100 h-100" alt="">
															</div>
														</div>
														<!-- Fields -->
														<div class="col-12 col-xl-9 order-2">
															<div class="row g-3">
																
																<div class="form-group col-12 col-md-6 col-xl-7">
																	<label for="inv_product_name">Product Name <span class="text-danger">*</span></label>
																	<input id="inv_product_name" class="form-control form-control-sm" placeholder="Product Name" required>
																</div>

																<div class="form-group col-6 col-md-3 col-xl-2">
																	<label for="inv_reorder_level">Reorder Level <span class="text-danger">*</span></label>
																	<input id="inv_reorder_level" type="number" class="notnega form-control form-control-sm" value="1" required>
																</div>

																<div class="form-group col-6 col-md-3 col-xl-3">
																	<label for="inv_base_unit">Base Unit <span class="text-danger">*</span></label>
																	<select id="inv_base_unit" class="dd_inv_unit form-control" required>
																		<option disabled selected>Select Unit</option>
																		<option>Voluntary</option>
																	</select>
																</div>

																<div class="form-group col-6 col-md-3">
																	<label for="inv_markup">Mark up % <span class="text-danger">*</span></label>
																	<input id="inv_markup" type="number" class="notnega form-control form-control-sm" value="30.00" required>
																</div>

																<div class="form-group col-6 col-md-5">
																	<label for="inv_category">Category <span class="text-danger">*</span></label>
																	<select id="inv_category" class="dd_inv_category form-control" required>
																		<option disabled selected>Select Category</option>
																		<option>Voluntary</option>
																	</select>
																</div>

																<div class="form-group col-12 col-md-4">
																	<label for="inv_brand">Brand</label>
																	<select id="inv_brand" class="dd_inv_brand form-control">
																		<option disabled selected>Select Brand</option>
																		<option>Voluntary</option>
																	</select>
																</div>

																<div class="form-group col-12 col-md-7">
																	<label for="inv_supplier">Supplier</label>
																	<select id="inv_supplier" class="dd_inv_suppliers tomsel form-control" multiple>
																		<option disabled selected>Select Supplier</option>
																		<option>Voluntary</option>
																	</select>
																</div>

																<div class="form-group col-12 col-md-5">
																	<label for="inv_product_image">Product Image</label>
																	<input id="inv_product_image" type="file" class="form-control form-control-sm">
																</div>
															</div>
														</div>
													</div>

													<div class="row g-3 mt-1">
														<div class="form-group col-12">
															<label for="inv_description">Product Description</label>
															<input id="inv_description" class="form-control form-control-sm" placeholder="Product Description">
														</div>
													</div>

													<div class="row mt-2">
														<div class="col-12">
															<div class="form-check">
																<input id="inv_serialized" type="checkbox" class="form-check-input" id="serialized">
																<label for="inv_serialized" class="form-check-label" for="serialized">Serialized</label>
															</div>
														</div>
													</div>
												</form>
												<hr>
												<div class="text-center">
													<button class="btn btn-primary btn-save" data-id="0">Apply</button>
													<button class="btn btn-danger btn-cancel">Cancel</button>
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
	
	// Initialize
	var allowedFileSize = 5;
	var is_status = 1;
	var product_status_lock = false;
	const pagetitle = $('.page-title').html();
	// var userPermissions = ['view_branch']; 

	setupFilePreview('#inv_product_image', '.product-image img');
	tableload();
	dd_inv_category();
	dd_inv_brand();
	dd_inv_suppliers();
	dd_inv_unit();

	// script for interactions
	// ACTION LISTENERS
	// FOR EDIT ACTION LISTENERS ON RADIO
	$(document).off('click.productStatus', '.status-toggle label').on('click.productStatus', '.status-toggle label', function(e){
		let value = parseInt($(this).data('value'), 10);
		if (product_status_lock && value === 1) {
			e.preventDefault();
			e.stopPropagation();
			return false;
		}else{
			setProductStatus(value, false);
		}
		console.log("THIS IS TRIGGERED B");
	});
	$('.btn-save').click(function () {
		var chk = checkFormValidity();
		var id = $(this).attr('data-id');

		if (chk) {
			let message = parseInt(id, 10) === 0 ? 'New ' + pagetitle + ' Saved!' : pagetitle + ' Details Updated!';
			const withSerial = $('#inv_serialized').is(':checked') ? 1 : 0;
			const formData = new FormData();
			var data = { product_name: $('#inv_product_name').val(), category_id: $('#inv_category').val(), base_unit_id: $('#inv_base_unit').val(), brand_id: $('#inv_brand').val(), supplier_id: $('#inv_supplier').val(), markup_percent: $('#inv_markup').val(), reorder_level: $('#inv_reorder_level').val(), description: $('#inv_description').val(), serialized: withSerial , fileSize : allowedFileSize , status : is_status , pkid: id };
			var json = JSON.stringify(data);
			formData.append('data', json);
			const fileCheck = appendFileWithLimit(formData, '#inv_product_image', allowedFileSize);
			if (!fileCheck.ok) {
				Swal.fire({ icon: 'error', title: fileCheck.message, showConfirmButton: false, timer: 2500 });
				return;
			}
			$.ajax({
				url: "../backend/inventory/post_inv_products.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					data = data.trim();
					if (data == 'exist_name') {
						Swal.fire({icon: 'error', title: pagetitle + ' already exists! Please modify or delete the existing entry.', showConfirmButton: false, timer: 2500});
					} else if (data == 'file_invalid' || data == 'invalid_image') {
						Swal.fire({icon: 'error', title: 'Invalid image file! Allowed: jpg, jpeg, png, gif, webp.', showConfirmButton: false, timer: 2500});
					} else if (data == 'file_exceed') {
						Swal.fire({icon: 'error', title: 'Image file exceeded size limit!', showConfirmButton: false, timer: 2500});
					} else if (data == 'file_error' || data == 'file_upload_fail' || data == 'img_err') {
						Swal.fire({icon: 'error', title: 'Image upload failed!', showConfirmButton: false, timer: 2500});
					} else if (data == 'true') {
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
	// EDIT
	$('.table').on('click', '.btn-edit', function () {
		$('.text-btn').text("Edit");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.is-edit').fadeIn().removeClass('d-none');
		$('.view-default').hide();
		pkid = $(this).data('id');
		$.get("../backend/inventory/get_det_inv_products.php?security=123465&id=" + pkid, function(data, status) {
			var array = jQuery.parseJSON(data);
			is_status = parseInt(array.status);
			setProductStatus(is_status, true);	
			$('.btn-save').attr('data-id', pkid);
			$('#inv_product_name').val(array.product_name);
			$('#inv_category').val(array.category_id);
			$('#inv_base_unit').val(array.base_unit_id);
			$('#inv_brand').val(array.brand_id);
			$('#inv_description').val(array.description);
			$('#inv_markup').val(array.markup);
			$('#inv_reorder_level').val(array.reorder_level);
			$('#inv_serialized').prop('checked', !!array.serialized);
			
			const sel = document.querySelector('#inv_supplier');
			if (sel && sel.tomselect) {
				sel.tomselect.setValue(array.supplier_ids || [], true);
				sel.tomselect.refreshItems();
			}
			
		});
	});

	// DEL
	$('.table').on('click', '.btn-del', function () {
		const id = $(this).data('id');
		confirmTypedDelete({
			url: "../backend/inventory/del_inv_products.php?security=123465&id=" + id,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
				showMainPage();
			}
		});
	});

	$('.btn-cancel').click(function(){	
		$('.is-edit').fadeIn().addClass('d-none');
		is_status = 1;
		// resetDependentSelect($('.dd_city'), 'Select City');
		// resetDependentSelect($('.dd_brgy'), 'Select Barangay');
	});
	$('.btn-add').click(function(){	
		$('#inv_reorder_level').val("1");
		$('#inv_markup').val("30.00");
	});


	// script for body functions default
	function tableload(){
		resetDataTable('.table');
		$.get("../backend/inventory/get_list_inv_products.php?security=123465", function(data,status){
			$(".table tbody").html(data);
			setDataTable('.table', {
				showActions: true,
				useResponsive: true,

				extraColumnDefs: [
					{ targets: 1, className: 'all', responsivePriority: 1, width: '45px' },
					{ targets: 2, responsivePriority: 2 },
					{ targets: 3, responsivePriority: 3, width: '110px' },
					{ targets: 4, responsivePriority: 4 },
					{ targets: 5, responsivePriority: 2, width: '90px' },
					{ targets: -1, className: 'all text-center text-nowrap', width: '120px' }
				]
			});
		});
	}
	
	/* =========================================
					PRODUCT STATUS
	0 = Inactive, 1 = Active, 2 = EOL, 3 = Low Stock, 4 = No Stock
	========================================= */
	function setProductStatus(status, isLoad = false){
		status = parseInt(status, 10);

		if (![0,1,2,3,4].includes(status)) status = 1;
		if (isLoad) {
			is_status = status;
			product_status_lock = (status === 3 || status === 4);
		}

		// ADDED: block Active if locked by Low/No Stock
		if (product_status_lock && status === 1) {
			return false;
		}
		$('input[name="options"]').prop('checked', false);
		$('.status-toggle label')
			.removeClass('active btn-success btn-danger btn-dark')
			.addClass('btn-secondary');
		$('#is-active').prop('disabled', product_status_lock);
		if(is_status == 3 || is_status == 4){
			$('.stock-view').fadeIn().removeClass('d-none');
			if(is_status == 3){
				$('#is-lowstock').fadeIn().removeClass('d-none');
				$('#is-nostock').addClass('d-none');
			}else{
				$('#is-nostock').fadeIn().removeClass('d-none');
				$('#is-lowstock').addClass('d-none');
			}
		}else{
			$('.stock-view').addClass('d-none');
		}
		let noteText = '';
		switch(status){
			case 0:
				$('#is-inactive').prop('checked', true);
				$('#is-inactive').parent().removeClass('btn-secondary').addClass('btn-danger active');
				noteText = 'Product is manually inactive.';
				break;

			case 1:
				$('#is-active').prop('checked', true);
				$('#is-active').parent().removeClass('btn-secondary').addClass('btn-success active');
				noteText = 'Product is active.';
				break;

			case 2:
				$('#is-eol').prop('checked', true);
				$('#is-eol').parent().removeClass('btn-secondary').addClass('btn-dark active');
				noteText = 'Product is end-of-life.';
				break;

			case 3:
				noteText = 'Active cannot be selected while stock is low.';
				break;
			case 4:
				noteText = 'Active cannot be selected while there is no stock.';
				break;
		}

		if (is_status === 3) {
			if (status !== 3) noteText = 'Stock is low. Active remains disabled until restocked.';
		}
		if (is_status === 4) {
			if (status !== 4) noteText = 'No stock available. Active remains disabled until restocked.';
		}
		$('#product-status-note').html(noteText);
	}
	
</script>

</html>
