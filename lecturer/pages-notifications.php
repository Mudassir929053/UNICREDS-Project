<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include '../database/dbcon.php';
include('lecturer-function.php');

// $lecturer_id = $_SESSION['sess_lecturerid'];
?>



<body>
	<!-- Wrapper -->
	<div id="db-wrapper">
		<!-- navbar vertical -->
		<?php
		unset($_SESSION['pages']);
		$_SESSION['pages'] = 'announcement';
		include 'pages-sidebar.php';
		?>
		<!-- Page Content -->
		<div id="page-content">
			<?php
			include 'pages-header.php';
			?>
			<!-- Container fluid -->
			<!-- Container fluid -->
			<div class="container-fluid p-4">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<!-- Page Header -->
						<div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
							<div class="mb-3 mb-md-0">
								<h1 class="mb-1 h2 fw-bold">Announcement</h1>
								<!-- Breadcrumb -->
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="#">Announcement</a>
										</li>

										<li class="breadcrumb-item active" aria-current="page">
											All
										</li>
									</ol>
								</nav>
							</div>

						</div>
					</div>


				</div>
				<div class="">
					<div class="row">
						<!-- basic table -->
						<div class="col-md-12 col-12 mb-5">
							<div class="card smooth-shadow-md">
								<!-- card header  -->

								<!-- table  -->
								<div class="card-body">
									<div class="table-responsive">

										<table id="dataTableBasic1" class="table table-hover display no-wrap table-sm" style="width:100%">
											<thead class="bg-primary text-white">
												<tr class="text-center">
													<th width="10px">No.</th>
													<th>Title</th>
													<th>Message</th>

													<th width="350px">&nbsp;</th>
												</tr>
											</thead>
											<tbody class="align-middle">
												<?php
												// $queryAnnouncement = $conn->query("SELECT * FROM announcement_committee WHERE announcement_receiver IN ('5,7', '5')  ORDER BY announcement_created_date DESC");
												$queryAnnouncement = $conn->query("SELECT * FROM announcement_committee WHERE announcement_receiver IN ('5,7', '5') ORDER BY announcement_created_date DESC");
												$num = 1;
												if (mysqli_num_rows($queryAnnouncement) > 0) {
													while ($row = mysqli_fetch_object($queryAnnouncement)) {
												?>
														<tr>
															<td class="text-center"><?php echo $num++; ?></td>
															<td><?php echo $row->announcement_title; ?></td>
															<td>
																<?= (strip_tags(substr($row->announcement_message, 0, 50))) ?>...
																<button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $row->announcement_id; ?>">
																	<span style="color: red">Read More</span>
																</button>
															</td>


															<td class="text-center">
																<a class="btn btn-info btn-sm" <?php
																								if ($row->announcement_attachment != null) {
																								?> href="../assets/attachment/announcement/<?php echo $row->announcement_attachment; ?>" target="_blank" <?php
																																																	} else { ?> disabled style="background-color: gray;" <?php } ?> title="View">
																	<i class="fa fa-search" aria-hidden="true"></i> View Attachment</a>


															</td>

														</tr>

														<!-- Modal for More -->
														<div id="modalView<?php echo $row->announcement_id; ?>" class="modal fade" role="dialog">
															<div class="modal-dialog modal-dialog-centered modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Announcement <?php $row->announcement_id ?></h4>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>

																	<div class="modal-body">
																		<div class="form-group">


																			<div class="card bg-light">
																				<div class="card-header text-center">
																					<b>
																						<?php echo date('j F Y', strtotime($row->announcement_created_date)); ?> </b><br>
																					<h3><?php echo $row->announcement_title ?></h3>

																				</div>
																				<div class="card-body">
																					<?php echo $row->announcement_message ?>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>


													<?php }
												} else {
													?>
												<?php
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Script -->
	<!-- Libs JS -->
	<script>
		$(document).ready(function() {
			$('#dataTableBasic1').dataTable();
		});
	</script>

	<script>
		function deleteannouncement() {
			var x = confirm("Are you sure want to delete this announcement?");

			if (x == true) {
				return true;
			} else {
				return false;
			}
		}
	</script>


	<!-- Theme JS -->
	<script src="../assets/js/theme.min.js"></script>
	<script src="../assets/js/countrystatecity.js"></script>
</body>

</html>