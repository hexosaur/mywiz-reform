/******************************************************************************************************************
****************************	GLOBALLY CALLED JQUERY FUNCTIONS ARE LOCATED HERE 		***************************
*******************************************************************************************************************/


/***********************************************************************************************
*****************			FUNCTIONS ONLY TO BE CALLED GLOBALLY 		************************
************************************************************************************************/
/**  =====================
		DROP DOWN SECTION
==========================  **/

// UNIVERSAL DROPDOWN FILTER SELECTOR
function enableSelectTypeFilter(selector, opts = {}) {
	const cfg = {
		match: 'startsWith',   // 'startsWith' or 'includes'
		clearDelay: 800,
		...opts
	};

	const ns = '.tf_' + selector.replace(/[^a-z0-9]/gi, '_');

	$(document)
		.off('mousedown' + ns, selector)
		.off('keydown' + ns, selector);

	$(document).on('mousedown' + ns, selector, function () {
		const $sel = $(this);
		cacheOptionsIfNeeded($sel);
		resetSelect($sel);
	});

	$(document).on('keydown' + ns, selector, function (e) {
		const $sel = $(this);
		cacheOptionsIfNeeded($sel);

		let buffer = $sel.data('typeBuffer') || '';

		if (e.key === 'Escape') {
		resetSelect($sel);
		e.preventDefault();
		return;
		}

		if (e.key === 'Backspace') {
		buffer = buffer.slice(0, -1);
		$sel.data('typeBuffer', buffer);
		applyFilter($sel, buffer, cfg.match);
		e.preventDefault();
		return;
		}

		if (e.key.length === 1 && !e.ctrlKey && !e.metaKey && !e.altKey) {
		buffer += e.key.toLowerCase();
		$sel.data('typeBuffer', buffer);

		clearTimeout($sel.data('bufTimer'));
		$sel.data('bufTimer', setTimeout(() => resetSelect($sel), cfg.clearDelay));

		applyFilter($sel, buffer, cfg.match);
		e.preventDefault();
		}
	});

	function cacheOptionsIfNeeded($sel) {
		if (!$sel.data('allOptions')) {
		$sel.data('allOptions', $sel.find('option').clone());
		}
	}

	function applyFilter($sel, query, matchMode) {
		const all = $sel.data('allOptions');
		const q = (query || '').trim().toLowerCase();
		const currentVal = $sel.val();

		const $placeholder = $(all[0]).clone(); // first option = placeholder
		const matches = [];

		for (let i = 1; i < all.length; i++) {
		const $opt = $(all[i]);
		const text = $opt.text().trim().toLowerCase();

		const ok = !q
			? true
			: (matchMode === 'includes' ? text.includes(q) : text.startsWith(q));

		if (ok) matches.push($opt.clone());
		}

		$sel.empty().append($placeholder);
		matches.forEach($o => $sel.append($o));

		if (currentVal && $sel.find(`option[value="${currentVal}"]`).length) {
		$sel.val(currentVal);
		} else {
		$sel.prop('selectedIndex', 0);
		}
	}

	function resetSelect($sel) {
		const all = $sel.data('allOptions');
		if (!all) return;

		clearTimeout($sel.data('bufTimer'));
		$sel.data('typeBuffer', '');

		const currentVal = $sel.val();
		$sel.empty().append(all.clone());

		if (currentVal && $sel.find(`option[value="${currentVal}"]`).length) {
		$sel.val(currentVal);
		}
	}
}

// DROP DOWN GET FUNCTION
function dd_prov(isEdit = false, prov_id) {
$.get("../backend/get_dd_prov.php", { security: '123465' }, function (data) {
	$('.dd_prov').html(data);
	if (isEdit && prov_id !== null) {
	$('.dd_prov').val(prov_id).trigger('change');
	}
});
}
function dd_city(isEdit = false,prov_id, city_id){
	$.get("../backend/get_dd_city.php", {security: '123465', id : prov_id}, function (data) {
		$('.dd_city').removeAttr("disabled");
		$('.dd_city').html(data);
		
		if (isEdit && city_id !== null) {
			setTimeout(function() {
				$('.dd_city').val(city_id).trigger('change'); 
			}, 50);  
		}
	});
}
function dd_brgy(isEdit = false,city_id, brgy_id = null) {
	$.get("../backend/get_dd_brgy.php", {security: '123465', id: city_id}, function (data) {
		$('.dd_brgy').removeAttr("disabled").html(data);
		if (isEdit && brgy_id !== null) {
			setTimeout(function() {
				$('.dd_brgy').val(brgy_id).trigger('change');
			}, 100);
		}
	});
}

// ORGANIZATION DROPDOWNS HERE 
function dd_dept() {
	$.get("../backend/get_dd_dept.php", { security: '123465' }, function (data) {
		$('.dd_dept').html(data);
	});
}
function dd_branch() {
	$.get("../backend/get_dd_branch.php", { security: '123465' }, function (data) {
	$('.dd_branch').each(function () {
			if ($(this).hasClass('tomsel')) {
				$(this).html(data);
				tomselDropdowns(this);

			} else {
				$(this).html(data);
				$(this).prop('selectedIndex', 0);
			}
		});
	});
}
function dd_perms() {
	$.get("../backend/get_dd_perms.php", { security: '123465' }, function (data) {
	$('.dd_perms').each(function () {
			if ($(this).hasClass('tomsel')) {
				$(this).html(data);
				tomselDropdowns(this);

			} else {
				$(this).html(data);
				$(this).prop('selectedIndex', 0);
			}
		});
	});
}
function dd_access() {
	$.get("../backend/get_dd_access.php", { security: '123465' }, function (data) {
	$('.dd_access').each(function () {
			if ($(this).hasClass('tomsel')) {
				$(this).html(data);
				tomselDropdowns(this);

			} else {
				$(this).html(data);
				$(this).prop('selectedIndex', 0);
			}
		});
	});
}
function dd_leave_type() {
	$.get("../backend/get_dd_leave_type.php", { security: '123465' }, function (data) {
	$('.dd_lvtype').each(function () {
			if ($(this).hasClass('tomsel')) {
				$(this).html(data);
				tomselDropdowns(this);
			} else {
				$(this).html(data);
				$(this).prop('selectedIndex', 0);
			}
		});
	});
}
function dd_role(dept_id) {
	$.get("../backend/get_dd_role.php", { security: '123465' , dept_id : dept_id }, function (data) {
		$('.dd_role').each(function () {
			if ($(this).hasClass('tomsel')) {
				$(this).html(data);
				tomselDropdowns(this);

			} else {
				$(this).html(data);
				$(this).prop('selectedIndex', 0);
			}
		});
	});
}	




function tomselDropdowns(element) {
	if (element.TomSelect) {
		
		element.TomSelect.refreshOptions();
	} else {
		new TomSelect(element, {
			create: false,
			allowEmptyOption: true,
			closeAfterSelect: true,
			plugins: ['remove_button'],
		});
		// console.log("TomSelect New");
	}
}











/**  =====================
	DATATABLE SECTION
==========================  **/
function resetDataTable(){
	const $tbl = $('.table');
	if ($.fn.DataTable.isDataTable($tbl)) {
		const dt = $tbl.DataTable();
		$tbl.find('[data-toggle="tooltip"],[title]').tooltip?.('dispose');
		dt.destroy();
	}
	$tbl.removeAttr('style'); 
	$tbl.find('thead th, tbody td').removeAttr('style');
}
// INITIALIZING THE TABLE WITH CAN OPTOUT
// setDataTable('#table_emp', { rowHide: 3, showActions: false }); <----- SAMPLE TO CALL
function setDataTable(selector = '.table', opts = {}) {
	const {
		rowHide = null,              // e.g. 3 if you still want to hide a specific column
		showActions = true,          // permissions flag: true=show last col, false=hide last col
		extraColumnDefs = [],        // allow per-table additional defs
		dtOptions = {}               // allow passing other DataTables options
	} = opts;

	const $tbl = $(selector);

	$tbl.each(function () {
		const $t = $(this);

		// if already initialized, destroy safely (common for dynamic reloads)
		if ($.fn.DataTable.isDataTable($t)) {
		$t.DataTable().destroy();
		}
		const columnDefs = [];
		if (rowHide !== null && rowHide !== undefined) {
		columnDefs.push({ targets: rowHide, visible: false, searchable: true });
		// example: next column not orderable/searchable
		columnDefs.push({ targets: rowHide + 1, orderable: false, searchable: false });
		}

		columnDefs.push({
		targets: -1,
		visible: showActions,
		orderable: false,
		searchable: false
		});

		columnDefs.push(...extraColumnDefs);
		$t.DataTable({
		autoWidth: false,
		columnDefs,

		createdRow: function (row, data) {
			if (rowHide !== null && rowHide !== undefined) {
			const location = (data[rowHide] || '').toString().trim();
			if (location) $(row).addClass('dt-row-tip').attr('data-location', location);
			}
		},

		drawCallback: function () {
			if (rowHide !== null && rowHide !== undefined) {
			const $rows = $t.find('tbody tr.dt-row-tip');
			$rows.each(function () {
				$(this).attr('title', $(this).attr('data-location') || '');
			});
			$rows.tooltip({ container: 'body', trigger: 'hover focus', placement: 'top' });
			}
		},

		...dtOptions
		});
	});
}






/**  =====================
	 DATE PICKER SECTION
==========================  **/
// OPTIONAL FOR A NO SUNDAY, SATURDAY OR WEEKENDS
function getInvalidDateFn($el) {
// Extendable rules
	if ($el.hasClass('noSunday')) {
		return function (date) { return date.day() === 0; };
	}
	if ($el.hasClass('noWeekend')) {
		return function (date) { return date.day() === 0 || date.day() === 6; };
	}
	if ($el.hasClass('noSaturday')) {
		return function (date) { return date.day() === 6; };
	}
	return null;
}
function rangeContainsInvalid(start, end, invalidFn) {
	if (!invalidFn) return false;
	let d = start.clone().startOf('day');
	const last = end.clone().startOf('day');
	while (d.isSameOrBefore(last, 'day')) {
		if (invalidFn(d)) return true;
		d.add(1, 'day');
	}
	return false;
}
// helper: (re)initialize END picker with optional minDate
function initEndPicker($end, minDate, $startRef) {
	const inst = $end.data('daterangepicker');
	if (inst) inst.remove();

	$end.off('apply.daterangepicker.linked cancel.daterangepicker.linked');

	const opts = {
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,
		locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
	};

	if (minDate) opts.minDate = minDate;

	// if either END or START has rule class, apply it
	const invEnd = getInvalidDateFn($end) || ($startRef ? getInvalidDateFn($startRef) : null);
	if (invEnd) opts.isInvalidDate = invEnd; // :contentReference[oaicite:4]{index=4}

	$end.daterangepicker(opts)
		.on('apply.daterangepicker.linked', function (e, picker) {
		$(this).val(picker.startDate.format('MMMM DD, YYYY'));
		})
		.on('cancel.daterangepicker.linked', function () {
		$(this).val('');
		});
}
	
/**  =====================
	HIDE AND SHOW SECTION
==========================  **/
// RESETS THE FORMS AND FUNCTIONS
function showMainPage(){
	$('.btn_save').attr('data-id', 0);
	$('.view-default').fadeIn().removeClass('d-none');
	$('.view-modify').hide();	
	$('.dd_city, .dd_brgy').prop('disabled', true).prop('selectedIndex', 0);
	clearForms('.view-modify');	
}

/**  =====================
		FORMS  SECTION
==========================  **/
// CLEARING FORM
let IS_CLEARING = false;
function resetDependentSelect($sel, label) {
	$sel.html(`<option value="" disabled selected>${label}</option>`)
		.prop('disabled', true);
		// DO NOT trigger change here
}
function clearForms(scope = document) {
	IS_CLEARING = true;
	const $s = $(scope);
	// clear text inputs/textarea
	$s.find('input.form-control, textarea.form-control')
		.not(':button,:submit,:reset,[type=checkbox],[type=radio]')
		.val('');

	// clear checkboxes/radios
	$s.find('input[type=checkbox], input[type=radio]').prop('checked', false);

	// ✅ clear selects (TomSelect + normal)
	$s.find('select').each(function () {

		// TomSelect attached?
		if (this.tomselect) {
		this.tomselect.setValue([], true);   // clears selected items
		this.tomselect.setTextboxValue('');  // clears typed search
		this.tomselect.close();

		// also clear underlying select (just to be sure)
		$(this).find('option').prop('selected', false);
		$(this).val([]);
		return;
		}

		// normal select
		this.selectedIndex = 0;
		$(this).trigger('change');
	});
	IS_CLEARING = false;
}
// VALIDITY CHECKING FORM
function checkFormValidity(scope = document) {
	var isValid = true;

	$(scope)
		.find('.form-control[required]')
		.filter(':enabled') // Ignore disabled fields (like dd_city until enabled)
		.each(function () {
			var el = this;
			var $el = $(el);
			var tag = el.tagName.toLowerCase();
			var type = (el.type || '').toLowerCase();

			// checkbox / radio
			if (type === 'checkbox' || type === 'radio') {
				if (!$el.is(':checked')) {
					isValid = false;
					$el.trigger('focus');
					return false; // break
				}
				return; // continue
			}

			// select (normal select, checking if value is null or empty)
			if (tag === 'select') {
				var v = $el.val();
				var ok = Array.isArray(v) ? v.length > 0 : !!String(v || '').trim();
				if (!ok) {
					isValid = false;
					$el.trigger('focus');
					return false;
				}
				return;
			}

			// input/textarea
			if (!String($el.val() || '').trim()) {
				isValid = false;
				$el.trigger('focus');
				return false; 
			}
		});

	if (isValid === false) {
		Swal.fire({
			icon: 'error',
			title: 'Error',
			text: 'Please complete all fields correctly before submitting the form.',
			showConfirmButton: false
		});
	}

	return isValid;
}
function hidePerms(){



	
}




/***********************************************************************************************
*****************			JQUERY FUNCTIONS ONLY TO BE CALLED GLOBALLY 		****************
************************************************************************************************/
// DROP DOWN CLASS CALLED FOR AUTO FILTER
$(function () {
	/**  =====================
		DROP DOWN SECTION
	==========================  **/
	enableSelectTypeFilter('.dd_prov, .dd_city, .dd_brgy', { match: 'startsWith' });



	/**  =====================
		DATE PICKER SECTION
	==========================  **/
	// A) Single date with month & year dropdowns (supports .noSunday/.noSaturday/.noWeekend)
	$('.singleDatePicker').each(function () {
	const $el = $(this);

	const opts = { singleDatePicker: true, showDropdowns: true, autoUpdateInput: false, locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' } };

	const invalidFn = getInvalidDateFn($el);
	if (invalidFn) opts.isInvalidDate = invalidFn;

	$el.daterangepicker(opts)
		.on('apply.daterangepicker', function (e, picker) {
		$(this).val(picker.startDate.format('MMMM DD, YYYY'));
		}).on('cancel.daterangepicker', function () {
		$(this).val('');
		});
	});
	// B) Date range with month & year dropdowns (supports .noSunday/.noSaturday/.noWeekend)
	$('.rangeDatePicker').each(function () {
		const $el = $(this);

		const opts = { showDropdowns: true, autoUpdateInput: false, locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' } };

		const invalidFn = getInvalidDateFn($el);
		if (invalidFn) opts.isInvalidDate = invalidFn;

		$el.daterangepicker(opts)
			.on('apply.daterangepicker', function (e, picker) {
			// If you want "no Sunday inside the whole range", enforce it here
			if (rangeContainsInvalid(picker.startDate, picker.endDate, invalidFn)) {
				$(this).val('');
				if (typeof log === 'function') log('Range invalid (restricted days not allowed).');
				else console.warn('Range invalid (restricted days not allowed).');
				return;
			}

			const val = picker.startDate.format('MM/DD/YY') + ' - ' + picker.endDate.format('MM/DD/YY');
			$(this).val(val);
			if (typeof log === 'function') log('Range: ' + val);
			})
			.on('cancel.daterangepicker', function () {
			$(this).val('');
			if (typeof log === 'function') log('Range cleared');
		});
	});
	// C) Date range with 2 single date pickers
	// START date picker
	$('.startDatePicker').each(function () {
		const $start = $(this);

		const startOpts = {
			singleDatePicker: true,
			showDropdowns: true,
			autoUpdateInput: false,
			locale: { format: 'MM/DD/YY', cancelLabel: 'Clear' }
		};

		const invStart = getInvalidDateFn($start);
		if (invStart) startOpts.isInvalidDate = invStart; // disables dates :contentReference[oaicite:3]{index=3}

		$start.daterangepicker(startOpts)
			.on('apply.daterangepicker', function (e, picker) {
			const start = picker.startDate.clone().startOf('day');
			$(this).val(start.format('MMMM DD, YYYY'));

			const $end = $('.endDatePicker');
			$end.prop('disabled', false).val('');

			// re-init END with minDate + same invalid rule (see below)
			initEndPicker($end, start, $start);
			})
			.on('cancel.daterangepicker', function () {
			$(this).val('');

			const $end = $('.endDatePicker');
			$end.val('').prop('disabled', true);
			initEndPicker($end, null, $start); // reset end (no minDate)
			});
	});

	// END date picker (initialize once at load — disabled until start picked)
	const $endInit = $('.endDatePicker');
	$endInit.prop('disabled', true);
	initEndPicker($endInit, null);

	

	/**  =====================
		ACTION LISTENERS SECTION
	==========================  **/
	// BASIC BUTTON LISTENERS
	$('.btn-add').click(function(){
		$('.text-btn').text("Add");
		$('.view-modify').fadeIn().removeClass('d-none');
		$('.view-default').hide();
	});
	// $('.btn-edit').click(function(){
	// 	$('.text-btn').text("Edit");
	// 	$('.view-modify').fadeIn().removeClass('d-none');
	// 	$('.view-default').hide();
	// });
	$('.cnl-btn').click(function(){	
		showMainPage();
	});
	// COUNTRY DROP DOWNS ACTION LISTENERS
	// TRIGGER PROVINCE DROPDOWN
	$(document).on('mousedown', '.dd_prov', function () {
		$('.dd_city').prop('disabled', true).prop('selectedIndex', 0);
		$('.dd_brgy').prop('disabled', true).prop('selectedIndex', 0);
		dd_prov(false,null);
	});
	$(document).on('change', '.dd_prov', function () {
		prov_id = $(this).val();
		if (IS_CLEARING) return;

		if (!prov_id) {
			resetDependentSelect($('.dd_city'), 'Select City');
			resetDependentSelect($('.dd_brgy'), 'Select Barangay');
			return;
		}
		console.log
		dd_city(undefined,prov_id,undefined);
	});
	// TRIGGER CITY DROPDOWN
	$(document).on('mousedown', '.dd_city', function () {
		$('.dd_brgy').prop('disabled', true).prop('selectedIndex', 0);
		dd_city(undefined,prov_id,undefined);
	});
	$(document).on('change', '.dd_city', function () {
		city_id = $(this).val();
		if (IS_CLEARING) return;
		if (!city_id) {
			resetDependentSelect($('.dd_brgy'), 'Select Barangay');
			return;
		}
		dd_brgy(undefined,city_id,undefined);
	});
	// $(document).on('mousedown', '.dd_dept', function () {
		// $('.dd_role').prop('disabled', true).prop('selectedIndex', 0);
		// dd_role(dept_id);
	// });

	$(document).on('change', '.dd_dept', function () {
		dept_id = $(this).val();
		if (IS_CLEARING) return;
		if (!dept_id) {
			resetDependentSelect($('.dd_role'), 'Select Role');
			return;
		}
		dd_role(dept_id);
	});
	


	// TRIGGER BARANGAY DROPDOWN
	$(document).on('mousedown', '.dd_brgy', function () {
		dd_brgy(undefined,city_id,undefined);
	});
	$(document).on('change', '.dd_brgy', function () {
		brgy_id = $(this).val();
	});
	// TRIGGER BRANCH DROPDOWN
	$(document).on('change', '.dd_branch', function () {
		// branch_id = $(this).val();
	});

	// TRIGGER LOGOUT
	function logoff(){
		$.get("../config/logout.php",function(data, event){
			console.log(data);
			window.location = '/mywiz-reform/';
		});
	}

	$('.btn-logout').click(function(){	
		Swal.fire({ title: 'Are you sure?', 
			html: 'Are you sure you want to log-out?',
			icon: 'warning', showCancelButton: true, confirmButtonColor: '#20a661', cancelButtonColor: '#d33', confirmButtonText: 'Yes!'
		}).then((result) => {
			if (result.isConfirmed) {
				logoff();
			}
		});
	});
	console.log("jquery loaded");

});