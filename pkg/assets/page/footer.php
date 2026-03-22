
<!-- Required Js -->
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.6/dist/js/tom-select.complete.min.js"></script>
<script src="../pkg/js/vendor-all.min.js"></script>
<script src="../pkg/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../pkg/js/pcoded.min.js"></script>
<script src="../pkg/assets/plugins/datatables/datatables.js"></script>
<script src="../pkg/assets/plugins/sweetalert/swal.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Moment + Daterangepicker (A & B) -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script src="
https://cdn.jsdelivr.net/npm/jquery-circle-progress@1.2.2/dist/circle-progress.min.js
"></script>



<script src="../pkg/js/circle-progress.js"></script>
<script src="../pkg/js/scripts.js"></script>
<script src="../pkg/js/jqscript.js"></script>





<?php $__ms = (microtime(true) - $__t0) * 1000; ?>


<script>
	console.log("PHP exec (ms): <?= number_format($__ms, 2) ?>");
	
	// CHECK LOGIC ON WHICH TAB TO SHOW
	var permission_class = <?= json_encode($_SESSION['permission_classes']); ?>;
	permission_class.forEach(function(perms_class) {
		$('.' + perms_class).removeClass('d-none').fadeIn();
	});
	var permission = <?= json_encode($_SESSION['permissions']); ?>;
	permission.forEach(function(perms) {
		$('.' + perms).removeClass('d-none').fadeIn();
	});

	
</script>


<!-- FOR CHECKING SESSIONS ONLY -->
<?php include('../debugs/check_sessions.php') ?>
<script>
	// console.log("APP_SESSION:", window.APP_SESSION);
</script>
<!-- Preloader -->
<script>
updateLiveDateTime();
setInterval(updateLiveDateTime, 1000);
(function($){
	const SHOW_AFTER_MS = 250;
	let finished = false;
	let shown = false;
	let showTimer = null;

	function showPreloader(){
		if (finished || shown) return;
		shown = true;

		$("body").css("overflow", "hidden");
		$("#pagePreloader").addClass("is-visible").removeClass("is-hiding");
	}

	function hidePreloader(){
		if (finished) return;
		finished = true;

		clearTimeout(showTimer);

		// If page loaded fast, loader was never shown
		if (!shown) {
			$("#pagePreloader").remove();
			return;
		}

		$("#pagePreloader").addClass("is-hiding").removeClass("is-visible");
		setTimeout(function(){
			$("#pagePreloader").remove();
			$("body").css("overflow", "");
		}, 180);
	}
	showTimer = setTimeout(showPreloader, SHOW_AFTER_MS);
	$(window).on("load", hidePreloader);

})(jQuery);
</script>
<script>
$(function () {
	const STORAGE_KEY = 'site-theme-mode';
	const $html = $('html');
	const $icon = $('#themeNavbarIcon');
	const $label = $('#theme-current-label');
	const media = window.matchMedia('(prefers-color-scheme: dark)');

	function getSavedThemeMode() {
		const mode = localStorage.getItem(STORAGE_KEY);
		return ['auto', 'light', 'dark'].includes(mode) ? mode : 'auto';
	}

	function getSystemTheme() {
		return media.matches ? 'dark' : 'light';
	}

	function getEffectiveTheme(mode) {
		return mode === 'auto' ? getSystemTheme() : mode;
	}

	function updateThemeIcon(mode, effectiveTheme) {
		let iconClass = 'bi bi-circle-half';

		if (mode === 'light') {
			iconClass = 'bi bi-brightness-high';
		} else if (mode === 'dark') {
			iconClass = 'bi bi-moon';
		} else {
			iconClass = effectiveTheme === 'dark'
				? 'bi bi-circle-half'
				: 'bi bi-circle-half';
		}

		if ($icon.length) {
			$icon.attr('class', iconClass);
		}
	}

	function updateThemeLabel(mode, effectiveTheme) {
		if (!$label.length) return;

		if (mode === 'auto') {
			$label.text('Current: Auto (' + (effectiveTheme === 'dark' ? 'Dark' : 'Light') + ')');
		} else {
			$label.text('Current: ' + mode.charAt(0).toUpperCase() + mode.slice(1));
		}
	}

	function applyTheme(mode) {
		const effectiveTheme = getEffectiveTheme(mode);

		$html
			.removeClass('theme-dark theme-light')
			.addClass(effectiveTheme === 'dark' ? 'theme-dark' : 'theme-light')
			.attr('data-theme-mode', mode)
			.attr('data-theme-effective', effectiveTheme);

		updateThemeIcon(mode, effectiveTheme);
		updateThemeLabel(mode, effectiveTheme);
	}

	function setTheme(mode) {
		if (!['auto', 'light', 'dark'].includes(mode)) {
			mode = 'auto';
		}

		localStorage.setItem(STORAGE_KEY, mode);
		applyTheme(mode);
	}

	$(document).on('click', '.btn-theme-change', function (e) {
		e.preventDefault();
		const mode = $(this).data('theme-value');
		setTheme(mode);
	});

	applyTheme(getSavedThemeMode());

	function handleSystemThemeChange() {
		if (getSavedThemeMode() === 'auto') {
			applyTheme('auto');
		}
	}

	if (typeof media.addEventListener === 'function') {
		media.addEventListener('change', handleSystemThemeChange);
	} else if (typeof media.addListener === 'function') {
		media.addListener(handleSystemThemeChange);
	}
});
</script>