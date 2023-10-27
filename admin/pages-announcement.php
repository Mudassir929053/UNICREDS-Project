	<!DOCTYPE html>
	<html lang="en">


	<?php
	include 'pages-head.php';

	include '../database/dbcon.php';
	include 'admin-function.php';

	$admin_id = $_SESSION['sess_adminid'];
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
								<div>
									<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAnnouncement">Add Announcement</button>
								</div>
							</div>
						</div>
						<!-- Start Modal Page -->
						<div class="modal fade" id="addAnnouncement" tabindex="-1" role="dialog" aria-labelledby="announcementmodal" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="announcementmodal">Create Announcement</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
									</div>
									<div class="modal-body">
										<form action="" method="POST" enctype="multipart/form-data" id="announcement">

											<div class="mb-3">
												<label class="form-label" for="textInput">Title :</label>
												<input class="form-control" type="text" name="announcement_title" autocomplete="off" required>
											</div>

											<div class="mb-3">
												<label class="form-label" for="textInput">Receiver :</label>
												<div class="input-group" style="display: inline-block;">
													<div class="checkbox checkbox-info ">
														<input type="checkbox" name="announcement_receiver[]" value="2" id="receive2">
														<label for="receive2">Institution</label>
													</div>
													<div class="checkbox checkbox-info mt-1">
														<input type="checkbox" name="announcement_receiver[]" value="3" id="receive3">
														<label for="receive3">Industry</label>
													</div>
													<div class="checkbox checkbox-info mt-1">
														<input type="checkbox" name="announcement_receiver[]" value="4" id="receive4">
														<label for="receive4">Committee</label>
													</div>
													<div class="checkbox checkbox-info mt-1">
														<input type="checkbox" name="announcement_receiver[]" value="5" id="receive5">
														<label for="receive5">Lecturer</label>
													</div>
													<!-- <div class="checkbox checkbox-info mt-1">
														<input type="checkbox" name="announcement_receiver[]" value="6" id="receive6">
														<label for="receive5">Expert</label>
													</div> -->
													<div class="checkbox checkbox-info mt-1">
														<input type="checkbox" name="announcement_receiver[]" value="7" id="receive7">
														<label for="receive5">Student</label>
													</div>
												</div>
											</div>

											<div class="mb-3">
												<label class="form-label">Message :</label>
												<textarea class="form-control" name="announcement_message" id="editornewmessage"></textarea>

												<script>
													ClassicEditor
														.create(document.querySelector('#editornewmessage'), {

														})
														.then(editor => {
															window.editor = editor;
														})
														.catch(err => {
															console.error(err.stack);
														});
												</script>
											</div>

											<div class="mb-3">
												<label class="form-label" for="textInput">Attachment :</label>
												<div class="input-group mb-1">
													<input class="dropify form-control" type="file" name="announcement_attachment" id="announcement_attachment">
													<label class="input-group-text" for="announcement_attachment">Upload</label>
												</div>
												<small class="form-control-feedback"> *Optional </small>
											</div>



									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-success btn-sm" name="add_announcement">Submit</button>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- End Modal Page -->

					</div>
					<div class="">
						<div class="row">
							<!-- basic table -->
							<div class="col-md-12 col-12 mb-5">
								<div class="card smooth-shadow-md">
									<!-- card header  -->

									<!-- table  -->
									<div class="card-body">

										<table id="dataTableBasic" class="table table-hover display no-wrap table-sm" style="width:100%">
											<thead class="bg-primary text-white">
												<tr class="text-center">
													<th width="10px">No.</th>
													<th>Title</th>
													<th>Message</th>
													<th>Receiver</th>
													<th width="350px">&nbsp;</th>
												</tr>
											</thead>
											<tbody class="align-middle">
												<?php
												$queryAnnouncement = $conn->query("SELECT * FROM announcement_admin WHERE announcement_created_by = '$admin_id';");
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
															<td>
																<?php
																$arr = $row->announcement_receiver;
																$sprt = explode(",", $arr);

																if ($sprt != null) {
																	if ($arr != null) {
																		echo '|';
																	}
																	if (in_array("2", $sprt)) {
																		echo ' Institution |';
																	}
																	if (in_array("3", $sprt)) {
																		echo ' Industry |';
																	}
																	if (in_array("4", $sprt)) {
																		echo ' Committee |';
																	}
																	if (in_array("5", $sprt)) {
																		echo ' Lecturer |';
																	}
																	if (in_array("6", $sprt)) {
																		echo ' Expert |';
																	}
																	if (in_array("7", $sprt)) {
																		echo ' Student |';
																	}
																} else {
																	echo '';
																}
																?>
															</td>

															<td class="text-center">
																<a class="btn btn-info btn-sm" <?php
																								if ($row->announcement_attachment != null) {
																								?> href="../assets/attachment/announcement/<?php echo $row->announcement_attachment; ?>" target="_blank" <?php
																													} else { ?> disabled style="background-color: gray;" <?php } ?> title="View">
																	<i class="fa fa-search" aria-hidden="true"></i> View Attachment</a>

																<a class="btn btn-warning btn-sm waves-effect waves-light" href="" data-bs-toggle="modal" title="Edit Announcement" data-bs-target="#modalUpdate<?php echo $row->announcement_id; ?>">
																	<i class="fa fa-edit" aria-hidden="true"></i> Edit
																</a>

																<a class="btn btn-danger btn-sm waves-effect waves-light" href="admin-function.php?delete_announcement=<?php echo $row->announcement_id; ?>" title="Delete Announcement" onClick="return deleteannouncement()">
																	<i class="fa fa-trash" aria-hidden="true"></i> Delete
																</a>
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
														<!-- Modal for More -->

														<div class="modal fade" id="modalUpdate<?php echo $row->announcement_id; ?>" tabindex="-1" role="dialog" aria-labelledby="announcementmodal" aria-hidden="true">
															<div class="modal-dialog modal-dialog-centered modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="announcementmodal">Edit Announcement</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	<div class="modal-body">
																		<form action="" method="POST" enctype="multipart/form-data">
																			<input type="hidden" name="announcement_id" value="<?php echo $row->announcement_id; ?>">
																			<div class="mb-3">
																				<label class="form-label" for="textInput">Title :</label>
																				<input class="form-control" type="text" name="new_title" value="<?php echo $row->announcement_title; ?>" required>
																			</div>

																			<div class="mb-3">
																				<label class="form-label">Receiver :</label>
																				<?php
																				$chkbox = $row->announcement_receiver;
																				$arr = explode(",", $chkbox);
																				?>
																				<div class="input-group" style="display: inline-block;">
																					<div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="2" id="update2<?php echo $row->announcement_id; ?>" <?php if (in_array("2", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update2<?php echo $row->announcement_id; ?>">Institution</label>
																					</div>
																					<div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="3" id="update3<?php echo $row->announcement_id; ?>" <?php if (in_array("3", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update3<?php echo $row->announcement_id; ?>">Industry</label>
																					</div>
																					<div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="4" id="update4<?php echo $row->announcement_id; ?>" <?php if (in_array("4", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update4<?php echo $row->announcement_id; ?>">Committee</label>
																					</div>
																					<div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="5" id="update5<?php echo $row->announcement_id; ?>" <?php if (in_array("5", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update5<?php echo $row->announcement_id; ?>">Lecturer</label>
																					</div>
																					<!-- <div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="6" id="update6<?php echo $row->announcement_id; ?>" <?php if (in_array("6", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update6<?php echo $row->announcement_id; ?>">Expert</label>
																					</div> -->
																					<div class="checkbox checkbox-info">
																						<input type="checkbox" name="arr[]" value="7" id="update7<?php echo $row->announcement_id; ?>" <?php if (in_array("7", $arr)) {
																																															echo "checked";
																																														} ?>>
																						<label for="update7<?php echo $row->announcement_id; ?>">Student</label>
																					</div>
																				</div>
																			</div>

																			<div class="mb-3">
																				<label class="form-label">Message :</label>
																				<textarea class="form-control" name="new_message" id="editormessage<?php echo $row->announcement_id; ?>"><?php echo $row->announcement_message; ?></textarea>

																				<script>
																					ClassicEditor
																						.create(document.querySelector('#editormessage<?php echo $row->announcement_id; ?>'), {

																						})
																						.then(editor => {
																							window.editor = editor;
																						})
																						.catch(err => {
																							console.error(err.stack);
																						});
																				</script>

																			</div>

																			<div class="mb-3">
																				<label class="form-label" for="textInput">Attachment :</label>
																				<div class="custom-file">
																					<div class="input-group mb-1">
																						<input type="file" onChange="readURL(this);" class="form-control custom-file-input" name="announcement_attachment" id="announcement_attachment<?php echo $row->announcement_id; ?>">

																					</div>
																				</div>

																				<?php if ($row->announcement_attachment != null) { ?>
																					<p>Current File : <a href="../assets/attachment/announcement/<?php echo $row->announcement_attachment; ?>" target="_blank">
																							<?php echo $row->announcement_attachment; ?></a></p>
																				<?php } else {
																				?>
																					None
																				<?php } ?>
																			</div>


																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-success btn-sm" name="edit_announcement">Submit</button>
																	</div>
																</div>
															</div>
															</form>
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
		<!-- Script -->
		<!-- Libs JS -->

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