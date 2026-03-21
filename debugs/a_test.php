
echo json_encode(array('error' => "error_details"));



LIMITER
<div class="form-group col-md-8">
	<label for="rangetest">Date From <span class="text-danger">*</span></label>
	<input  id="rangetest" class="daylimit-1 rangeDatePicker noSunday form-control form-control-sm" readonly placeholder="Select a starting date" required/>
</div>
<div class="form-group col-md-8">
	<label for="xtesta">Date From <span class="text-danger">*</span></label>
	<input  id="xtesta" class="daylimit-1 singleDatePicker noSunday form-control form-control-sm" readonly placeholder="Select a starting date" required/>
</div>










<script>
// 	FOUND A NEW BUG
// IF DATA TABLE NEXT PAGE IT WONT FUNCTION AS DESIRED (ACTION BUTTON)
// sample for triggering without issue

	// EDIT
	$('.table').on('click', '.btn-edit', function () {
		
	});

	// DEL
	$('.table').on('click', '.btn-del', function () {
		
	});
	$('#table_leave').on('click', '.btn-edit', function () {
		$('.text-btn').text("Edit");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.view-default').hide();

		let pkid = $(this).data('id');

		$.get("../backend/leave/get_det_leave_type.php?security=123465&id=" + pkid, function(data, status) {
			var array = jQuery.parseJSON(data);

			$('.btn-save').attr('data-id', pkid);
			$('#type_name').val(array.type_name);
			$('#type_code').val(array.type_code);
			$('#type_desc').val(array.type_desc);
			$('#type_days').val(array.type_days);
			$('#type_gender').val(array.gender);
			$('#type_pay').prop('checked', !!array.type_pay);
			$('#type_attach').prop('checked', !!array.type_attach);
			$('#type_proxy').prop('checked', !!array.type_proxy);
		});
	});
	// DELETE
	$('#table_leave').on('click', '.btn-del', function () {
		const id = $(this).data('id');

		confirmTypedDelete({
			url: "../backend/leave/del_leave_type.php?security=123465&id=" + id,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
				showMainPage();
			}
		});
	});
	// DELETE
	$('.btn-del').click(function(){
		console.log("clicked");
		const id = $(this).data('id');
		confirmTypedDelete({
			url: "../backend/leave/del_leave_type.php?security=123465&id=" + id,
			pageTitle: pagetitle,
			onSuccess: function () {
				tableload();
				showMainPage();
			}
		});
	});	
</script>