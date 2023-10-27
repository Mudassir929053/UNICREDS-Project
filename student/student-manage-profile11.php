<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
	include('pages-head.php');
?>

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
									<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="rounded-circle" />
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
							<a href="student-home-page.php" class="btn btn-outline-primary btn-sm d-none d-md-block">
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
										<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
											alt="" class="rounded-circle" />
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
																	<input type="file" class="custom-file-container__custom-file__custom-file-input" name="profilePic" accept=".jpg, .jpeg, .png" required/>
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
									<button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="if(window.confirm('Are you sure to delete this Profile Picture?')) {
                                            window.open('function/student-profile.php?deletePic=true', '_self');
                                        }" <?= $profilePic === NULL ? "disabled" : "" ?>>Delete</button>
								</div>
							</div>
							<hr class="my-5" />

							<!-- Student profile info view -->
							<div>
                                <div class="d-lg-flex align-items-center justify-content-between mb-3">
                                    <div class="mb-3 mb-lg-0">
                                        <h4 class="mb-0">Personal Details</h4>
                                        <p class="mb-0">
                                            Edit your personal information and any related information.
                                        </p>
                                    </div>
                                    <div>
										<!-- Update student profile -->
                                        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#updateProfile" 
											onclick="viewCurrPlace('updateProfileForm')">Update profile</button>										
										<!-- Update student profile modal -->
										<div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="updateProfileLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<form id="updateProfileForm" action="function/student-profile.php" method="post" enctype="multipart/form-data">
														<div class="modal-header">
															<h5 class="modal-title h4" id="updateProfileLabel">Update Profile</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																<span aria-hidden="true"></span>
															</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="fnameSU">First Name <span class="text-danger">*<span></label>
																	<input type="text" name="fnameSU" value="<?= $suInfoRow["su_fname"] ?>" id="fnameSU" class="form-control" placeholder="First Name" required>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="lnameSU">Last Name <span class="text-danger">*<span></label>
																	<input type="text" name="lnameSU" value="<?= $suInfoRow["su_lname"] ?>" id="lnameSU" class="form-control" placeholder="Last Name" required>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="icnumSU">I/C Number <span class="text-danger">*<span></label>
																	<input type="text" name="icnumSU" value="<?= $suInfoRow["su_no_ic"] ?>" id="icnumSU" class="form-control" placeholder="I/C Number" required>
																	<small class="text-muted">No need to add spaces or any symbols, eg. <strong>980101015152</strong></small>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="passSU">Passport </label>
																	<input type="text" name="passSU" value="<?= $suInfoRow["su_passport_no"] !== NULL ? $suInfoRow["su_passport_no"] : "" ?>" id="passSU" class="form-control" placeholder="Passport">
																	<small class="text-muted">No need to add spaces or any symbols, eg. <strong>A22242698</strong></small>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="phoneSU">Phone Number <span class="text-danger">*<span></label>
																	<input type="text" name="phoneSU" value="<?= $suInfoRow["su_contact_no"] ?>" id="phoneSU" class="form-control" placeholder="Phone" maxlength="10" required>
																	<small class="text-muted">No need to add spaces or any symbols, eg. <strong>01123456789</strong></small>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="natSU">Nationality <span class="text-danger">*<span></label>
																	<input type="text" name="natSU" value="<?= $suInfoRow["su_nationality"] ?>" id="natSU" class="form-control" required>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="dobSU">Date of Birth <span class="text-danger">*<span></label>
																	<input type="date" name="dobSU" value="<?= $suInfoRow["su_dob"] ?>" id="dobSU" class="form-control" required>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="genderSU">Gender <span class="text-danger">*<span></label>
																	<select name="genderSU" id="genderSU" class="selectpicker w-100" required>
																		<option value="Male" <?= $suInfoRow["su_gender"] === "Male" ? "selected" : "" ?>>Male</option>
																		<option value="Female" <?= $suInfoRow["su_gender"] === "Female" ? "selected" : "" ?>>Female</option>
																	</select>
																</div>

																<div class="mb-3 col-12 col-md-12">
																	<label class="form-label" for="addrSU">Address Line <span class="text-danger">*<span></label>
																	<input type="text" name="addrSU" value="<?= $suInfoRow["su_address"] ?>" id="addrSU" class="form-control" placeholder="Address" required>
																	<small class="text-muted">Home/Lot/Building no., Street name</small>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label">Country <span class="text-danger">*<span></label>
																	<select class="form-control" name="countryID" id="countrySU" 
																		data-country-id="<?= $suInfoRow["su_country_id"] ?>" data-width="100%" 
																		onchange="fetchState(this.id, this.value)" required>
																		<option value="" disabled >Select Country</option>
																<?php 
																	$countryInfo = $conn->query("SELECT * 
																						FROM `country` 
																						ORDER BY country_name");
																	$countryInfoNumRow = mysqli_num_rows($countryInfo);

																	for($j = 0; $j < $countryInfoNumRow; $j++) {
																		$countryInfoRow = mysqli_fetch_object($countryInfo);
																		$selected = $countryInfoRow->country_id == $suInfoRow["su_country_id"] ? "selected" : "";
																?>
																		<option value="<?= $countryInfoRow->country_id ?>" <?= $selected ?>><?= $countryInfoRow->country_name ?></option>
																<?php
																	}
																?>
																	</select>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label">State <span class="text-danger">*<span></label>
																	<select class="form-control" name="stateID" id="stateSU" 
																		data-state-id="<?= $suInfoRow["su_state_id"] ?>" data-width="100%" 
																		onchange="fetchCity(this.id, this.value)">
																		<option value="<?= $suInfoRow["su_state_id"] ?>" selected><?= $suInfoRow["state_name"] ?></option>
																	
																	</select>
																</div>
																<div class="mb-3 col-md-6">
																	<label class="form-label">City <span class="text-danger">*<span></label>
																	<select class="form-control" name="cityID" id="citySU" 
																		data-city-id="<?= $suInfoRow["su_city_id"] ?>" data-width="100%">
																		<option value="<?= $suInfoRow["su_city_id"] ?>" selected><?= $suInfoRow["city_name"] ?></option>
																		
																	</select>
																</div>
																<div class="mb-3 col-12 col-md-6">
																	<label class="form-label" for="zipCode">Zip/Postal Code</label>
																	<input type="text" name="zipCode" value="<?= $suInfoRow["postcode_number"] ?>" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="submit" name="upProfile" class="btn btn-primary">Save</button>
														</div>
													</form>
												</div>
											</div>
										</div>
                                    </div>
                                </div>
								<!-- Profile details -->
                                <div class="card-body">
                                    <div class="row">  
                                        <div class="d-flex justify-content-end">
											<div class="d-flex flex-column">
												<div class="mb-0 fs-6 text-secondary">
													Date Registered: <span class="text-dark text-end"><?= date_format(date_create($suInfoRow["su_registered_date"]), "h:i a, d/m/Y") ?></span>
												</div>
												<div class="mb-0 fs-6 text-secondary">
													Date Updated: <span class="text-dark w-100 text-end"><?= $suInfoRow["su_updated_date"] !== NULL ? date_format(date_create($suInfoRow["su_updated_date"]), "h:i a, d/m/Y") : "<em class='text-muted'>Not updated</em>" ?></span>
												</div>
											</div>
                                        </div>  
                                        <h4 class="mt-0 mb-3 text-primary">Personal Information</h4>
                                        <div class="col-md-7 col-12">
                                            <span class="fs-6">Full Name</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h4>
                                            
                                            <span class="fs-6">Contact Number</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_contact_no"] !== NULL ? $suInfoRow["su_contact_no"] : "<span class='text-muted'><em>Not specified</em></span>" ?></h4>
                                            
                                            <span class="fs-6">Date of Birth</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_dob"] !== NULL ? date_format(date_create($suInfoRow["su_dob"]), "jS F, Y") : "<span class='text-muted'><em>Not specified</em></span>" ?></h4>
                                            
                                            <span class="fs-6">Address</span>
                                            <h4 class="mb-3">
										<?php
											if($suInfoRow["su_address"] !== NULL) {
										?>
                                                <p>
													<?= $suInfoRow["su_address"] ?> <br>
													<?= $suInfoRow["postcode_number"] ?> <?= $suInfoRow["city_name"] ?>, <br>
													<?= $suInfoRow["state_name"] ?>, <?= $suInfoRow["country_name"] ?>
												</p>
										<?php
											} else {
												echo "<span class='text-muted'><em>Not specified</em></span>";
											}
										?>
											</h4>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <span class="fs-6">I/C Number</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_no_ic"] !== NULL ? $suInfoRow["su_no_ic"] : "<span class='text-muted'><em>Not specified</em></span>" ?></h4>
                                            
                                            <span class="fs-6">Passport Number</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_passport_no"] == NULL ? "<span class='text-muted'><em>Not specified</em></span>" : $suInfoRow["su_passport_no"] ?></h4>
                                            
                                            <span class="fs-6">Gender</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_gender"] !== NULL ? $suInfoRow["su_gender"] : "<span class='text-muted'><em>Not specified</em></span>" ?></h4>
                                            
                                            <span class="fs-6">Nationality</span>
                                            <h4 class="mb-3"><?= $suInfoRow["su_nationality"] !== NULL ? $suInfoRow["su_nationality"] : "<span class='text-muted'><em>Not specified</em></span>" ?></h4>
                                        </div>
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
	
	<script type="text/javascript">
		// let camera_button = document.querySelector("#capturePhotoButton");
		// let video = document.querySelector("#videoCamera");
		// let click_button = document.querySelector("#clickCapture");
		// let canvas = document.querySelector("#showCapture");
		
		// camera_button.addEventListener("click", async function() {
		// 	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false});
		// 	video.srcObject = stream;
		// });

		// click_button.addEventListener("click", function() {
		// 	canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
		// 	let image_data_url = canvas.toDataURL("image/jpeg").replace(/^data:image\/jpeg;base64,/, "");

		// 	document.getElementById("showCapture").className = "";

		// 	//console.log(image_data_url);
		// 	$.ajax({
		//         type: 'POST',
		//         url: 'student-function.php',
		//         data: { img_data_url: image_data_url }
		// 	});
		// });
	</script>

</body>

</html>