<?php http_response_code(403); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>403 • Forbidden</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- SHARED ERROR PAGE CSS -->
	<style>
		/* =========================
	ERROR PAGE ONLY CSS
	Scoped to .err-page
	========================= */

	html, body {
		min-height: 100%;
	}

	body {
		margin: 0;
	}

	/* LIGHT DEFAULT */
	.err-page{
		--err-blue-1:#0a58ca;
		--err-blue-2:#0dcaf0;

		--err-bg-1:#f6f9ff;
		--err-bg-2:#eef4ff;
		--err-bg-3:#f7fbff;

		--err-ink:#0b1220;
		--err-muted:#6c7a92;

		--err-card:rgba(255,255,255,.88);
		--err-border:rgba(255,255,255,.55);
		--err-line:rgba(10,88,202,.12);

		--err-soft:rgba(10,88,202,.10);
		--err-soft-2:rgba(10,88,202,.18);

		--err-shadow:0 24px 60px rgba(10,88,202,.20);

		--err-btn-light-bg:#ffffff;
		--err-btn-light-border:rgba(10,88,202,.16);
		--err-btn-light-text:#0b1220;

		--err-input-bg:rgba(255,255,255,.72);

		--err-hint-bg:rgba(13,110,253,.06);
		--err-hint-border:rgba(13,110,253,.35);
		--err-hint-text:#0b2b5a;

		position: relative;
		min-height: 100vh;
		width: 100%;
		overflow: hidden;
		color: var(--err-ink);
		background:
			radial-gradient(1200px 700px at 10% 10%, rgba(13,202,240,.18), transparent 55%),
			radial-gradient(1100px 650px at 90% 20%, rgba(10,88,202,.22), transparent 60%),
			linear-gradient(180deg, var(--err-bg-1) 0, var(--err-bg-2) 45%, var(--err-bg-3) 100%);
	}

	/* DARK MODE - YOUR APP */
	html.theme-dark .err-page,
	body.theme-dark .err-page,
	html.dark .err-page,
	body.dark .err-page,
	html.dark-mode .err-page,
	body.dark-mode .err-page,
	body.dark-layout .err-page,
	body.layout-dark .err-page {
		--err-bg-1:#07101f;
		--err-bg-2:#0c172b;
		--err-bg-3:#091322;

		--err-ink:#edf3ff;
		--err-muted:#9fb0cd;

		--err-card:rgba(18,28,49,.88);
		--err-border:rgba(255,255,255,.08);
		--err-line:rgba(255,255,255,.08);

		--err-soft:rgba(13,202,240,.10);
		--err-soft-2:rgba(13,202,240,.20);

		--err-shadow:0 24px 60px rgba(0,0,0,.42);

		--err-btn-light-bg:#15233d;
		--err-btn-light-border:rgba(255,255,255,.08);
		--err-btn-light-text:#edf3ff;

		--err-input-bg:rgba(255,255,255,.05);

		--err-hint-bg:rgba(13,202,240,.08);
		--err-hint-border:rgba(13,202,240,.22);
		--err-hint-text:#dce9ff;

		background:
			radial-gradient(1200px 700px at 10% 10%, rgba(13,202,240,.10), transparent 55%),
			radial-gradient(1100px 650px at 90% 20%, rgba(10,88,202,.14), transparent 60%),
			linear-gradient(180deg, var(--err-bg-1) 0, var(--err-bg-2) 45%, var(--err-bg-3) 100%);
	}

	/* AUTO DARK IF SYSTEM PREFERS DARK */
	@media (prefers-color-scheme: dark){
		.err-page{
			--err-bg-1:#07101f;
			--err-bg-2:#0c172b;
			--err-bg-3:#091322;

			--err-ink:#edf3ff;
			--err-muted:#9fb0cd;

			--err-card:rgba(18,28,49,.88);
			--err-border:rgba(255,255,255,.08);
			--err-line:rgba(255,255,255,.08);

			--err-soft:rgba(13,202,240,.10);
			--err-soft-2:rgba(13,202,240,.20);

			--err-shadow:0 24px 60px rgba(0,0,0,.42);

			--err-btn-light-bg:#15233d;
			--err-btn-light-border:rgba(255,255,255,.08);
			--err-btn-light-text:#edf3ff;

			--err-input-bg:rgba(255,255,255,.05);

			--err-hint-bg:rgba(13,202,240,.08);
			--err-hint-border:rgba(13,202,240,.22);
			--err-hint-text:#dce9ff;
		}
	}

	/* BLOBS */
	.err-page .err-blob{
		position:absolute;
		width:520px;
		height:520px;
		border-radius:50%;
		filter:blur(30px);
		opacity:.24;
		z-index:0;
		pointer-events:none;
	}

	.err-page .err-blob.one{
		left:-180px;
		top:-180px;
		background:radial-gradient(circle at 30% 30%, var(--err-blue-2), transparent 55%);
	}

	.err-page .err-blob.two{
		right:-220px;
		bottom:-220px;
		background:radial-gradient(circle at 35% 35%, var(--err-blue-1), transparent 60%);
	}

	/* MAIN SHELL */
	.err-page .err-shell{
		position:relative;
		z-index:1;
		min-height:100vh;
		display:flex;
		align-items:center;
		justify-content:center;
		padding:2rem 1rem;
	}

	/* CARDS */
	.err-page .err-card{
		background:var(--err-card);
		border:1px solid var(--err-border);
		backdrop-filter:blur(10px);
		-webkit-backdrop-filter:blur(10px);
		box-shadow:var(--err-shadow);
		border-radius:1.25rem;
		overflow:hidden;
		color:var(--err-ink);
	}

	.err-page .err-card .card-body,
	.err-page .err-card h1,
	.err-page .err-card h2,
	.err-page .err-card h3,
	.err-page .err-card h4,
	.err-page .err-card h5,
	.err-page .err-card h6,
	.err-page .err-card p,
	.err-page .err-card span,
	.err-page .err-card div,
	.err-page .err-card li,
	.err-page .err-card strong {
		color: inherit;
	}

	/* BADGE + ICON */
	.err-page .err-badge{
		background:var(--err-soft);
		color:var(--err-blue-2);
		border:1px solid var(--err-soft-2);
		font-weight:600;
	}

	.err-page .err-iconbox{
		width:62px;
		height:62px;
		border-radius:16px;
		display:grid;
		place-items:center;
		background:var(--err-soft);
		border:1px solid var(--err-soft-2);
	}

	/* TYPOGRAPHY */
	.err-page .err-code{
		font-size:clamp(3.2rem, 8vw, 5.4rem);
		line-height:1;
		font-weight:800;
		letter-spacing:-.06em;
		background:linear-gradient(90deg, var(--err-blue-1), var(--err-blue-2));
		-webkit-background-clip:text;
		background-clip:text;
		color:transparent !important;
		margin:0;
	}

	.err-page .err-sub,
	.err-page .err-mini{
		color:var(--err-muted) !important;
	}

	.err-page hr{
		border-color:var(--err-line);
		opacity:1;
	}

	/* SEARCH BOX */
	.err-page .err-searchbox{
		border-radius:.95rem;
		overflow:hidden;
		border:1px solid var(--err-soft-2);
		background:var(--err-input-bg);
	}

	.err-page .err-searchbox .form-control{
		background:transparent !important;
		border:0 !important;
		color:var(--err-ink) !important;
		box-shadow:none !important;
	}

	.err-page .err-searchbox .form-control::placeholder{
		color:var(--err-muted) !important;
	}

	/* BUTTONS */
	.err-page .btn-primary{
		background:var(--err-blue-1);
		border-color:var(--err-blue-1);
		box-shadow:0 10px 20px rgba(10,88,202,.22);
	}

	.err-page .btn-primary:hover{
		filter:brightness(.98);
	}

	.err-page .btn-light{
		background:var(--err-btn-light-bg);
		border-color:var(--err-btn-light-border);
		color:var(--err-btn-light-text);
	}

	.err-page .btn-light:hover{
		filter:brightness(.98);
		color:var(--err-btn-light-text);
	}

	.err-page .btn-outline-primary{
		border-color:rgba(10,88,202,.45);
		color:var(--err-blue-2);
	}

	.err-page .btn-outline-primary:hover{
		background:rgba(10,88,202,.08);
		border-color:rgba(10,88,202,.55);
		color:var(--err-blue-2);
	}

	/* HINT BOX */
	.err-page .err-hint{
		background:var(--err-hint-bg);
		border:1px dashed var(--err-hint-border);
		color:var(--err-hint-text);
		border-radius:.9rem;
		padding:.85rem 1rem;
		font-size:.95rem;
	}

	/* LINKS + BOOTSTRAP HELPERS INSIDE ERROR PAGE */
	.err-page a{
		color:inherit;
	}

	.err-page .text-primary{
		color:var(--err-blue-2) !important;
	}

	.err-page .text-muted{
		color:var(--err-muted) !important;
	}

	/* MOBILE */
	@media (max-width: 575.98px){
		.err-page .err-shell{
			padding:1rem .75rem;
		}

		.err-page .err-code{
			font-size:3rem;
		}
	}
</style>
</head>
<body class="">
<div class="err-page">
	<div class="err-blob one"></div>
	<div class="err-blob two"></div>

	<main class="err-shell">
		<div class="container" style="max-width:980px;">
			<div class="row g-4 align-items-stretch">
				<div class="col-12 col-lg-7">
					<div class="card err-card h-100">
						<div class="card-body p-4 p-md-5">
							<div class="d-flex align-items-center gap-3 mb-3">
								<div class="err-iconbox" aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#0a58ca" viewBox="0 0 16 16">
										<path d="M8 1a3 3 0 0 0-3 3v3H4a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2h-1V4a3 3 0 0 0-3-3zM6 4a2 2 0 1 1 4 0v3H6V4zm2 5a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1z"/>
									</svg>
								</div>
								<span class="badge err-badge rounded-pill px-3 py-2">Access Restricted</span>
							</div>

							<h1 class="err-code">403</h1>
							<h2 class="h4 mt-2 mb-1">Forbidden</h2>
							<p class="err-sub mb-4">
								You don’t have permission to view this page. If you believe this is a mistake, please sign in or contact the administrator.
							</p>

							<div class="err-hint mb-4">
								<strong>Tip:</strong> If you were trying to open a folder URL, directory listing is disabled for security.
							</div>

							<div class="d-flex flex-wrap gap-2">
								<a class="btn btn-primary px-4" href="/mywiz/home/dashboard">Go to Home</a>
								<a class="btn btn-outline-primary px-4" href="/mywiz/">Login</a>
								<button class="btn btn-light px-4" onclick="history.back()">Go Back</button>
							</div>

							<p class="err-mini mt-4 mb-0">
								Error code: <strong>403</strong> • <?php echo htmlspecialchars(date('Y-m-d H:i:s')); ?>
							</p>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-5">
					<div class="card err-card h-100">
						<div class="card-body p-4 p-md-5">
							<h3 class="h5 mb-3">What you can do</h3>
							<ul class="list-unstyled mb-0">
								<li class="d-flex gap-2 mb-3">
									<span class="text-primary fw-bold">1.</span>
									<span>Make sure you’re logged in with the correct account.</span>
								</li>
								<li class="d-flex gap-2 mb-3">
									<span class="text-primary fw-bold">2.</span>
									<span>Try opening the page from the dashboard menu instead of typing the URL.</span>
								</li>
								<li class="d-flex gap-2">
									<span class="text-primary fw-bold">3.</span>
									<span>If you keep seeing this, ask the admin to grant access to your role.</span>
								</li>
							</ul>

							<hr class="my-4">

							<div class="err-mini">
								<div><strong>Path:</strong> <?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? ''); ?></div>
								<div><strong>IP:</strong> <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? ''); ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
</body>
</html>