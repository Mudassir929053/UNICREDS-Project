<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>


<?php
if (isset($_POST['add_profile_video'])) {


	$vp_created_date = date('Y-m-d H:i:s');
	$studuni_id = $_SESSION['sess_studentid'];
	$allowed_exs = array("mp4", 'webm', 'avi', 'flv');
	if ($_FILES['mcv_attachment']['name'] != NULL) {
		$allowed_exs = $_FILES['mcv_attachment']['name'];
		$mcv_attachment = str_replace("'", "", date('YmdHis') . $_FILES['mcv_attachment']['name']);
	} else {
		$mcv_attachment = "";
	}

	$folder1 = "../assets/uploads/";
	move_uploaded_file($_FILES['mcv_attachment']['tmp_name'], $folder1 . $mcv_attachment);
	$filename = "../assets/uploads/" . $mcv_attachment;


	$insertmcv = $conn->query("INSERT INTO video_profile (vp_video,vp_created_date,vp_student_university_id) 
											values ('$mcv_attachment','$vp_created_date','{$studuni_id}')");

	if ($insertmcv) {
		echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
	} else {
		echo "<script>alert('Create micro-credential video is not successful');
											location.href='$_SERVER[HTTP_REFERER]';</script>";
	}
}
?>

<style>
	input[type="file"] {
		z-index: -1;
		position: absolute;
		opacity: 0;
	}

	input:focus+label {
		outline: 2px solid;
	}


	#tooltip {
		position: relative;
		cursor: pointer;

		font-size: 15px;
		/* font-weight: bold; */
		font-family: sans-serif;
	}

	#tooltipText {
		position: absolute;
		left: 50%;
		top: 0;
		transform: translateX(-50%);
		background-color: #000;
		color: #fff;
		white-space: nowrap;
		padding: 10px 15px;
		border-radius: 7px;
		visibility: hidden;
		opacity: 0;
		transition: opacity 0.5s ease;

	}

	#tooltipText::before {
		border: 15px solid;
		border-color: #000 #0000 #0000;
	}

	#tooltip:hover #tooltipText {
		top: -130%;
		visibility: visible;
		opacity: 1;
	}
</style>

<body>
	<!-- Top navigation -->
	<?php
	include('pages-topbar.php');
	?>

	<div class="pt-5 pb-5">
		<div class="container">
			<!-- Student university info -->
			<div class="row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<!-- Bg -->
					<div class="pt-16 rounded-top-md" style="
														background: url(../assets/images/background/profile-bg.jpg) no-repeat;
														background-size: cover;
						">
					</div>
					<div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
						<div class="d-flex align-items-center">
							<div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n8">
								<span class="avatar avatar-xxl">
									<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" alt="" class="rounded-circle" />
								</span>
							</div>
							<div class="lh-1">
								<h2 class="mb-0">
									<?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?>
								</h2>
								<p class="mb-0 d-block"><?= $suInfoRow["su_email"] ?></p>
							</div>
						</div>
						<div>
							<a href="job-search.php" class="btn btn-outline-primary btn-sm d-none d-md-block">
								Go to Dashboard
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Content -->
			<div class="row mt-0 mt-md-4">
				<div class="col-lg-3 col-md-4 col-12">
					<?php
					include("student-sidebar.php");
					?>
				</div>
				<div class="col-lg-9 col-md-8 col-12 mb-4">
					<!-- Card -->
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<h3 class="mb-0">Profile Details</h3>
							<p class="mb-0">
								You have full control to manage your own account setting.
							</p>
						</div>

						<!-- Portfolio info -->
						<div class="card-body">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									<span class="avatar avatar-xl">
										<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" alt="" class="rounded-circle" />
									</span>
									<div class="ms-3">
										<h4 class="mb-0">Change your avatar</h4>
										<p class="mb-0">
											PNG or JPG no bigger than 800px wide and tall.
										</p>
									</div>
								</div>
								<div>
									<!-- Upload profile pic -->
									<button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#profilePicModal">Upload</button>
									<!-- Upload profile pic modal -->
									<div class="modal fade" id="profilePicModal" tabindex="-1" role="dialog" aria-labelledby="profilePicModalTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<form id="upProfilePicForm" action="function/student-profile.php" method="post" enctype="multipart/form-data">
													<div class="modal-header">
														<h5 class="modal-title h4" id="profilePicModalTitle">Profile Picture</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
															<span aria-hidden="true"></span>
														</button>
													</div>
													<div class="modal-body">
														<!-- <ul class="nav nav-pills d-flex justify-content-center mt-0 mb-3" role="tablist">
															<li class="nav-item" data-bs-toggle="tooltip" data-placement="top" title="Upload photo">
																<button type="button" class="nav-link active btn btn-icon" id="uploadPhotoButton" data-bs-toggle="pill" href="#courseCoverImg" role="tab" aria-controls="courseCoverImg" aria-selected="true">
																	<i class="fe fe-upload"></i>
																</button>
															</li>
															<li class="nav-item ms-2" data-bs-toggle="tooltip" data-placement="top" title="Capture photo">
																<button type="button" class="nav-link btn btn-icon" id="capturePhotoButton" data-bs-toggle="pill" href="#capturePhotoPills" role="tab" aria-controls="capturePhotoPills" aria-selected="false">
																	<i class="fe fe-camera"></i>
																</button>
															</li>
														</ul> -->
														<div class="tab-content">
															<!-- File upload preview -->
															<div class="tab-pane fade show active custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg" role="tabpanel" aria-labelledby="uploadPhotoButton">
																<!-- picture preview -->
																<div class="d-flex justify-content-center">
																	<div class="custom-file-container__image-preview border border-primary rounded-circle" style="width: 250px;"></div>
																</div>
																<label class="form-label">Profile picture
																	<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
																</label>
																<!-- picture upload -->
																<label class="custom-file-container__custom-file">
																	<input type="file" class="custom-file-container__custom-file__custom-file-input" name="profilePic" accept="video/mp4,video/x-m4v,video/*" required />
																	<span class="custom-file-container__custom-file__custom-file-control"></span>
																</label>
																<small class="mt-3 d-block">
																	Important guidelines: no bigger than 800 pixels; .jpg, .jpeg, or .png.
																</small>
																<input type="hidden" name="currProfilePic" value="<?= $suInfoRow["su_profile_pic"] ?>">
															</div>
															<!-- Capture profile photo -->
															<!-- <div class="tab-pane fade" id="capturePhotoPills" role="tabpanel" aria-labelledby="capturePhotoButton">
																<div class="d-flex justify-content-center mb-3">
																	<video class="border border-primary" id="videoCamera" width="320" height="240" autoplay></video>
																</div>
																<div class="d-flex justify-content-center">
																	<button type="button" class="btn btn-outline-info btn-sm" id="clickCapture">Capture</button>
																</div>
																<p>Upload this photo?</p>
																<div class="d-flex justify-content-center mt-4">
																	<canvas class="collapse" id="showCapture" width="320" height="240"></canvas>
																</div>
															</div> -->
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" name="upProfilePic" class="btn btn-primary">Upload</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<!-- Delete profile picture -->
									<?php $profilePic = $suInfoRow["su_profile_pic"]; ?>
									<button type="button" class="btn btn-outline-danger btn-sm" onclick="if(window.confirm('Are you sure to delete this Profile Picture?')) {
                                            window.open('function/student-profile.php?deletePic=true', '_self');
                                        }" <?= $profilePic === NULL ? "disabled" : "" ?>>Delete</button>
								</div>
							</div>
							<?php
							if (isset($_GET['delete_ep'])) {
								$delete = $_GET['delete_ep'];
								$studuni_id = $_SESSION['sess_studentid'];

								$delep = $conn->query("DELETE FROM video_profile where vp_student_university_id = '$studuni_id'");

								if ($delep) {

									echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
								} else {
									echo "<script>alert('Delete course is not successful.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
								}
							}


							?>
							<hr class="my-5" />
							<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
								<div id="tooltip">
									<span id="tooltipText">Craft a succinct elevator speech, delivering a clear and persuasive message in under 5 minutes.</span>
									<i class="fa mx-2 fs-3 text-info">&#xf0eb;</i>
								</div>
								<?php $studuni_id = $_SESSION['sess_studentid']; ?>

								<a class="btn btn-outline-danger btn-sm" type="button" name="delete_ep" id="delete_ep" href="student-manage-video.php?delete_ep=<?php echo $studuni_id; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>
								<!-- <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addExp">Add new</i></button> -->
							</div>
							<!-- Student profile info view -->
							<div>
								<div class="d-lg-flex align-items-center justify-content-between mb-3">
									<div class="mb-3 mb-lg-0">
										<h4 class="mb-0">Add a Video</h4>
										<p class="mb-0">
											Add a video about your self and related to your job.
										</p>
									</div>

								</div>
								<!-- Profile details -->
								<div class="card-body">
									<div class="row">
										<div class="d-flex justify-content-end">
											<!-- <div class="d-flex flex-column">
												<div class="mb-0 fs-6 text-secondary">
													Date Registered: <span class="text-dark text-end"><?= date_format(date_create($suInfoRow["su_registered_date"]), "h:i a, d/m/Y") ?></span>
												</div>
												<div class="mb-0 fs-6 text-secondary">
													Date Updated: <span class="text-dark w-100 text-end"><?= $suInfoRow["su_updated_date"] !== NULL ? date_format(date_create($suInfoRow["su_updated_date"]), "h:i a, d/m/Y") : "<em class='text-muted'>Not updated</em>" ?></span>
												</div>
											</div> -->
										</div>

										<?php
										$studuni_id = $_SESSION['sess_studentid'];
										$querycn = $conn->query("SELECT * FROM `video_profile`WHERE vp_student_university_id = '$studuni_id'");


										if (mysqli_num_rows($querycn) > 0) {
											while ($rows = mysqli_fetch_object($querycn)) {
												//    if($rows['vdo_file']){

										?>

												<div class="card-body bg-secondary bg-gradient">
													<video width="100%" controls>
														<source src="../assets/uploads/<?php echo $rows->vp_video; ?>">
													</video>
												</div>
										<?php
											}
										} else {
											echo '<form action="" method="post"  enctype="multipart/form-data">
											<div class="row">
												<div class="col-8">
													<div class=" start-50  border border-info">



														<input type="file" id="file-upload" name="mcv_attachment" multiple required />
														<label for="file-upload"><svg width="26%" height="26%" fill="currentColor" class="bi bi-camera-video py-4 mx-19 px-5 text-primary" viewBox="0 0 16 16">
																<path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z" />
																<h5 class="vdo py-0 mx-19 px-5"> Add Video</h5>
															</svg></label>
														<div id="file-upload-filename"></div>
														


													</div>
												</div>
												<div class="col-4 text-dark">

													<h5>Improve Your Haring Chance By 30% By adding A Video</h5>
													Recruiters Prefer Candidates with A Video Profile.
												</div>
											</div><br>
											<button type="submit" class="btn btn-success btn-sm" name="add_profile_video">Save</button>
										</form>';
										}
										?>





									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php
	include('pages-footer.php');
	?>


	<!-- Scripts -->
	<!-- Theme JS -->
	<script src="../assets/js/theme.min.js"></script>
	<!-- Country, State, City JS -->
	<script src="js/region.js"></script>



</body>

</html>