/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
$(function () {
	const log = (msg) => $('#log').text(msg);
	// A) Single date with month & year dropdowns
	$('.singleDatePicker')
		.daterangepicker({ singleDatePicker: true, showDropdowns: true,	autoUpdateInput: false,
		locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
		}).on('apply.daterangepicker', function (e, picker) {
		$(this).val(picker.startDate.format('MMMM DD,YYYY'));
		console.log('Single date: ' + $(this).val());
		}).on('cancel.daterangepicker', function () {
		$(this).val('');
		
	});

	// B) Date range with month & year dropdowns
	$('#dateRange')
		.daterangepicker({
		showDropdowns: true,           // 👈 adds month/year selects
		autoUpdateInput: false,
		locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
		})
		.on('apply.daterangepicker', function (e, picker) {
		const val = picker.startDate.format('MM/DD/YY') + ' - ' + picker.endDate.format('MM/DD/YY');
		$(this).val(val);
		log('Range: ' + val);
		})
		.on('cancel.daterangepicker', function () {
		$(this).val('');
		log('Range cleared');
	});
	// BASIC BUTTON LISTENERS
	$('.btn-add').click(function(){
		$('.text-btn').text("Add");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.view-default').hide();
	});
	$('.btn-edit').click(function(){
		$('.text-btn').text("Edit");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.view-default').hide();
	});
	$('.cnl-btn').click(function(){	
		$('.view-default').fadeIn().removeClass('d-none');
		$('.view-modify').hide();		
	});



	// MULTI-SELECT
	$('#applyBarangay').on('click', function () {
	var selected = $('.brgy:checked').map(function(){ return this.value; }).get();

	// Show as comma-separated list in the readonly input
	$('#barangayInput').val(selected.join(', '));

	// Replace hidden inputs (so form submits as barangay[])
	var hiddenWrap = $('#barangayHidden').empty();
	selected.forEach(function (v, i) {
		hiddenWrap.append('<input type="hidden" name="barangay[]" value="' + $('<div>').text(v).html() + '">');
	});

	$('#barangayPicker').modal('hide');
	});

	// Clicking the input also opens the modal (already wired via data-toggle)
	$('#barangayInput').on('keydown', function(e){ e.preventDefault(); }); // prevent typing






	console.log("scriptjs loaded");
});
