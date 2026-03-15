<?php
if (!isset($LOADER_TEXT)) $LOADER_TEXT = "Loading page...";
?>

<style>
:root{
	--loader-blue:#0d6efd; /* Bootstrap primary */
	--loader-bg: rgba(255, 255, 255, 0.3);
}

#pagePreloader{
	position: fixed;
	inset: 0;
	z-index: 9999;
	display: flex;
	align-items: center;
	justify-content: center;
	background: var(--loader-bg);
	backdrop-filter: blur(4px);
	-webkit-backdrop-filter: blur(4px);
	opacity: 0;
	visibility: hidden;
	pointer-events: none;
	transition: opacity .18s ease, visibility .18s ease;
}

#pagePreloader.is-visible{
	opacity: 1;
	visibility: visible;
	pointer-events: auto;
}

#pagePreloader .loader-card{
	width: min(420px, 92vw);
	border: 1px solid rgba(13,110,253,.14);
	border-radius: 16px;
	box-shadow: 0 16px 40px rgba(13,110,253,.10);
	background: #fff;
	padding: 22px 22px 18px;
	transform: translateY(8px);
	opacity: 0;
	text-align: center;
}
#pagePreloader.is-visible .loader-card{
	animation: loaderIn .18s ease forwards;
}
@keyframes loaderIn{ to{ transform:translateY(0); opacity:1; } }
#pagePreloader .spinner-border{
	width: 2.1rem;
	height: 2.1rem;
	border-width: .22em;
}

.loader-progress{
	height: 6px;
	border-radius: 999px;
	background: rgba(13,110,253,.10);
	overflow: hidden;
	position: relative;
	margin-top: 14px;
}
.loader-progress::before{
	content:"";
	position:absolute;
	left:-35%;
	top:0;
	height:100%;
	width:35%;
	border-radius: 999px;
	background: linear-gradient(90deg,
	rgba(13,110,253,0) 0%,
	rgba(13,110,253,.95) 50%,
	rgba(13,110,253,0) 100%
	);
	animation: loaderBar 1.05s ease-in-out infinite;
}
@keyframes loaderBar{
	0%   { left:-35%; }
	100% { left:100%; }
}

#pagePreloader.is-hiding{ opacity:0; transition: opacity .18s ease; }
</style>

<div id="pagePreloader" aria-live="polite" aria-busy="true">
<div class="loader-card">
	<!-- Spinner ABOVE -->
	<div class="spinner-border text-primary" role="status" aria-hidden="true"></div>

	<div class="fw-semibold text-primary mt-3" id="pagePreloaderText">
	<?= htmlspecialchars($LOADER_TEXT, ENT_QUOTES, 'UTF-8'); ?>
	</div>

	<div class="small text-muted mt-1">Please wait…</div>

	<div class="loader-progress" aria-hidden="true"></div>
</div>
</div>
