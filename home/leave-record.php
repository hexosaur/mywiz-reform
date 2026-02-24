
<!DOCTYPE html>
<html lang="en">
<?php include('../pkg/assets/page/head.php')?>
<style>
	/* ADD MODIFICATION FOR CIRCLE ON  */
.circle-content {
	position: absolute;
	left: 50%;
	top: 50%;
	transform: translate(-50%, -50%);
	/* Add styling for the text (font size, color, etc.) */
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
										<div class="col-md-12">
											<div class="page-header-title">
												<h5 class="m-b-10">Leave Portal</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="../home/dashboard"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Leave Portal</a></li>
												<li class="breadcrumb-item"><a href="#">Leave Record</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->

							<!-- [ Main Content ] start -->
							<div class="container-fluid">
								<div class="row">
									<div class="col-xl-2">
										<div class="card align-items-center"">
											<div class="card-body align-items-center">
												<div class="circle-content">
													<span class="percent-text">2 Used SIL</span>
												</div>
												<div id="circle" style="position:relative"></div>
												
											</div>
											<!-- <div><strong>TEST</strong></div> -->
										</div>
										 
									</div>
									<!-- <div class="col-xl-2">
										<div class="card align-items-center"">
											<div class="card-body align-items-center">
												<div id="ct2"></div>
												<div class="text-center"><strong>HEHEHE</strong></div>
											</div>
										</div>
									</div>
									<div class="col-xl-2">
										<div class="card align-items-center"">
											<div class="card-body align-items-center">
												<div id="ct3"></div>
												<div class="text-center"><strong>HEHEHE</strong></div>
											</div>
										</div>
									</div>
									<div class="col-xl-2">
										<div class="card align-items-center"">
											<div class="card-body align-items-center">
												<div id="ct4"></div>
												<div class="text-center"><strong>HEHEHE</strong></div>
											</div>
										</div>
									</div> -->
								</div>
								<div class="row">
                                <!-- [ basic-table ] start -->
								
								<div class="col-xl-12">
									<div class="card">
										<div class="card-body table-border-style">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>From</th>
															<th>To</th>
															<th>Days</th>
															<th>Status</th>
															<th>Leave</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>1</td>
															<td>Christian Pads</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>2</td>
															<td>Cyvel Gelena</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>3</td>
															<td>Deisery Magrina</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>4</td>
															<td>Ryan Otto</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>5</td>
															<td>Christian Pads</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>6</td>
															<td>Cyvel Gelena</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>7</td>
															<td>Deisery Magrina</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>8</td>
															<td>Ryan Otto</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>9</td>
															<td>Christian Pads</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														<tr>
															<td>10</td>
															<td>Ryan Otto</td>
															<td>08/24/25</td>
															<td>08/24/25</td>
															<td>1</td>
															<td>Waiting</td>
															<td>Voluntary</td>
														</tr>
														
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
                                <!-- [ basic-table ] end -->
								<hr>
								
							</div>
							<!-- [ Main Content ] end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php include('../pkg/assets/page/footer.php')?>
<script>
	$(function () {
		$('.table').DataTable({pageLength: 13, lengthChange: false,	ordering:  true, searching: true, responsive: true,
			columnDefs: [{ targets: 0, orderable: true },
			{ targets: [2,3], type: 'date' }
			// { targets: 5, orderable: false }     // example: disable sort for Status
			]
		});
	});
	$('#circle').circleProgress({
		value: 5/6, // The progress value (0.0 to 1.0)
		size: 125, // Size of the circle in pixels
		emptyFill: "#eee",
		fill: {
			gradient: ["red", "blue"]
		}
	});



</script>
</body>

</html>
