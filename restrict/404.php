<?php http_response_code(404);?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>404 • Page Not Found</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
	.shell,body{min-height:100vh}:root{--blue-1:#0a58ca;--blue-2:#0dcaf0;--ink:#0b1220;--muted:#6c7a92;--card:rgba(255,255,255,.85);--border:rgba(255,255,255,.55);--shadow:0 24px 60px rgba(10, 88, 202, .20)}body{background:radial-gradient(1200px 700px at 10% 10%,rgba(13,202,240,.18),transparent 55%),radial-gradient(1100px 650px at 90% 20%,rgba(10,88,202,.22),transparent 60%),linear-gradient(180deg,#f6f9ff 0,#eef4ff 45%,#f7fbff 100%);color:var(--ink);overflow-x:hidden}.blob{position:absolute;width:520px;height:520px;border-radius:50%;filter:blur(30px);opacity:.22;z-index:0;pointer-events:none}.blob.one{left:-180px;top:-180px;background:radial-gradient(circle at 30% 30%,var(--blue-2),transparent 55%)}.blob.two{right:-220px;bottom:-220px;background:radial-gradient(circle at 35% 35%,var(--blue-1),transparent 60%)}.shell{position:relative;z-index:1;display:flex;align-items:center;justify-content:center;padding:2rem 1rem}.card-glass{background:var(--card);border:1px solid var(--border);backdrop-filter:blur(10px);box-shadow:var(--shadow);border-radius:1.25rem;overflow:hidden}.badge-soft{background:rgba(10,88,202,.1);color:var(--blue-1);border:1px solid rgba(10,88,202,.18);font-weight:600}.code{font-size:clamp(3.2rem, 8vw, 5.4rem);line-height:1;font-weight:800;letter-spacing:-.06em;background:linear-gradient(90deg,var(--blue-1),var(--blue-2));-webkit-background-clip:text;background-clip:text;color:transparent;margin:0}.sub{color:var(--muted);font-size:1.02rem;margin-top:.35rem}.searchbox{border-radius:.95rem;overflow:hidden;border:1px solid rgba(10,88,202,.18);background:rgba(255,255,255,.65)}.btn-primary{background:var(--blue-1);border-color:var(--blue-1);box-shadow:0 10px 20px rgba(10,88,202,.22)}.btn-outline-primary{border-color:rgba(10,88,202,.45);color:var(--blue-1)}.btn-outline-primary:hover{background:rgba(10,88,202,.08);border-color:rgba(10,88,202,.55);color:var(--blue-1)}.mini{font-size:.88rem;color:var(--muted)}.mark{width:62px;height:62px;border-radius:16px;display:grid;place-items:center;background:rgba(10,88,202,.1);border:1px solid rgba(10,88,202,.18)}
</style>
</head>

<body>
<div class="blob one"></div>
<div class="blob two"></div>

<main class="shell">
	<div class="container" style="max-width: 980px;">
	<div class="row g-4 align-items-stretch">
		<div class="col-12 col-lg-7">
		<div class="card card-glass h-100">
			<div class="card-body p-4 p-md-5">
			<div class="d-flex align-items-center gap-3 mb-3">
				<div class="mark" aria-hidden="true">
				<!-- compass icon -->
				<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#0a58ca" viewBox="0 0 16 16">
					<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7.5 2.5a.5.5 0 0 1 1 0v.55a5 5 0 0 1 4.45 4.45h.55a.5.5 0 0 1 0 1h-.55a5 5 0 0 1-4.45 4.45v.55a.5.5 0 0 1-1 0v-.55A5 5 0 0 1 3.05 8.5H2.5a.5.5 0 0 1 0-1h.55A5 5 0 0 1 7.5 3.05V2.5z"/>
					<path d="M10.5 5.5 9.2 9.2 5.5 10.5 6.8 6.8 10.5 5.5z"/>
				</svg>
				</div>
				<span class="badge badge-soft rounded-pill px-3 py-2">Lost in the System</span>
			</div>

			<h1 class="code">404</h1>
			<h2 class="h4 mt-2 mb-1">Page not found</h2>
			<p class="sub mb-4">
				The page you’re looking for doesn’t exist or may have been moved.
			</p>

			<div class="searchbox p-2 mb-4">
				<form class="d-flex gap-2" action="/mywiz-reform/" method="get">
				<input class="form-control border-0 bg-transparent" type="text" name="q"
						placeholder="Search (optional)…" aria-label="Search">
				<button class="btn btn-primary px-4" type="submit">Search</button>
				</form>
			</div>

			<div class="d-flex flex-wrap gap-2">
				<a class="btn btn-primary px-4" href="/mywiz-reform/home/dashboard">Go to Home</a>
				<a class="btn btn-light px-4" href="/mywiz-reform/">Login</a>
				<button class="btn btn-light px-4" onclick="history.back()">Go Back</button>
			</div>

			<p class="mini mt-4 mb-0">
				Error code: <strong>404</strong> • <?php echo htmlspecialchars(date('Y-m-d H:i:s')); ?>
			</p>
			</div>
		</div>
		</div>

		<div class="col-12 col-lg-5">
		<div class="card card-glass h-100">
			<div class="card-body p-4 p-md-5">
			<h3 class="h5 mb-3">Possible reasons</h3>
			<ul class="list-unstyled mb-0">
				<li class="d-flex gap-2 mb-3">
				<span class="text-primary fw-bold">1.</span>
				<span>The link is outdated or typed incorrectly.</span>
				</li>
				<li class="d-flex gap-2 mb-3">
				<span class="text-primary fw-bold">2.</span>
				<span>The page was moved to another route.</span>
				</li>
				<li class="d-flex gap-2">
				<span class="text-primary fw-bold">3.</span>
				<span>You don’t have access (in that case you might see a 403 instead).</span>
				</li>
			</ul>

			<hr class="my-4">
			<div class="mini">
				<div><strong>Path:</strong> <?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? ''); ?></div>
				<div><strong>Referrer:</strong> <?php echo htmlspecialchars($_SERVER['HTTP_REFERER'] ?? ''); ?></div>
			</div>
			</div>
		</div>
		</div>

	</div>
	</div>
</main>
</body>
</html>