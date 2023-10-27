<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<style>
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
	.tips0{
		position: absolute;
		left: 65%;
	}
	.tips{
		position: absolute;
		left: 69%;
	}
	.tips1{
		position: absolute;
		left: 69%;
	}
	.tips2{
		position: absolute;
		left: 75%;
	}
	.tips3{
		position: absolute;
		left: 72%;
	}
	.tips4{
		position: absolute;
		left: 68%;
	}
</style>
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
							
							<a  type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#profilePicModal">Upload Image</a>
                            <a href="student-manage-portfolio.php" class="btn btn-outline-secondary btn-sm">Go To Back</a>

						</div>
					</div>
				</div>
			</div>
			<!-- Content -->
			<div class="row mt-0 mt-md-4">
				<!-- Sidebar nav -->
				<div class="col-lg-3 col-md-4 col-12">

				</div>
				<!-- Main content -->
				<div class="col-lg-9 col-md-8 col-12 mb-4">
					<!-- Card -->
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<h3 class="mb-0">Qualifications</h3>
							<p class="mb-0">
								We use these details to show you jobs that match your unique skills and experience.
							</p>

							
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark  " type="button"  data-bs-toggle="modal"  data-bs-target="#updateProfile"onclick="viewCurrPlace('updateProfileForm')" >

									<h4><i style='font-size:20px' class='fas'>&#xf406;</i> ADD Personal Details </h4>
									<div id="tooltip" class="tips0">
										<span id="tooltipText">1. Please fill up your complete personal details like Name,Contact number,Links etc. Without any false details.<br>2. Please watchout for links and attachments Weather they are working properly or not.<br>3. Consider to fill-up additional information without any hesitation.<br>4. Please save the form after entering the complete details. </span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark  " type="button" data-bs-toggle="modal" data-bs-target="#addExp">

									<h4><i style="font-size:20px" class="fa">&#xf2b9;</i> ADD EXPERIENCE </h4>
									<div id="tooltip" class="tips1">
										<span id="tooltipText">1. Use the correct job title for job vacancy you are applying for.For Example,'web developer' should be writen as 'Full Stack Developer'.<br>2. Describe your tasks,responsibilities and any competancies developed as clearly as possible.<br>3. Take a good look at what the company is looking for,compose your text with<br> the needs of the company in mind and complete it with your own experience.<br>4. If you have work experience,only mention the relevant tasks and responsibilities for the vacancy you wish to apply.<br>5. You can add your experience multiple times. </span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark " type="button" data-bs-toggle="modal" data-bs-target="#addEdu">
									<h4><i style='font-size:20px' class='fas'>&#xf501;</i> ADD EDUCATION</h4>
									<div id="tooltip" class="tips">
										<span id="tooltipText">1. Only mention the courses that you have actually attended.<br>2. Don't mention primary or secondary schools unless they are your latest education.<br>3. If you didn't fully complete a course,it can still add value to your resume or atleast explain a gap in your work history.<br>4. Please mention your accurate percentage and group(Course) in the provided fields.<br>5. You can add your education multiple times.</span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark  " type="button" data-bs-toggle="modal" data-bs-target="#addSkill">
									<h4><i style='font-size:20px' class='fas'>&#xf559;</i> ADD SKILLS</h4>
									<div id="tooltip" class="tips2">
										<span id="tooltipText">1. Only mention the skils that are valuable for the vacancy you wish to apply for.<br>2. Examples:Great communicator,Team player,Flexible etc.<br>3. Mention any valuable skills related to the vacancy such as computer and software skills. For example:Ms-word,Photoshop etc.<br>4. You can add your skills multiple times.</span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark  " type="button" data-bs-toggle="modal" data-bs-target="#addHobby">
									<h4><i style="font-size:20px" class="fa">&#xf0ae;</i> ADD HOBBIES</h4>
									<div id="tooltip" class="tips3">
										<span id="tooltipText">1. Only mention the hobbies which add value to your resume and the job you wish to apply for.For example:'Dancing' <br>may not be relavent to the IT sector,but 'Programming' would be.<br>2. Feel free to mention hobbies that tell the employer about your personality,such as sports,photography,travelling etc.<br>3. Do not mention adult hobbies thet can cause a negative impact. For example:gambling,Political stances etc.<br>4. You can add your hobbies multiple times.</span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
							<div class="form-card">
								<button class="accordion-button collapsed  text-dark  " type="button" data-bs-toggle="modal" data-bs-target="#addReference">
									<h4><i style="font-size:20px" class="fa">&#xf2b5;</i> ADD REFERENCE</h4>
									<div id="tooltip" class="tips4">
										<span id="tooltipText">1. Only mention the authenticated details of a person who is going to refer you in his/her company or industry.<br>2. Do not fill the fake details of a person who will not going to be refered you.</span>
										<span><i class="fa bala">&#xf0eb;</i> Tips</span>
									</div>
								</button>
							</div>
						</div>
						

						<a href="templates.php" class="btn btn-outline-secondary btn-sm text-dark">Templetes</a>
						<!-- Portfolio info -->
						<div class="card-body">
							<div class="d-lg-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center mb-4 mb-lg-0">


								</div>

							</div>

							<!-- Portfolio info view -->
							<div class="mt-6">
								<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
								   <div>
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "exp" ? "active" : "" ?>" id="exp-tab" data-id="exp" data-bs-toggle="tab" href="#exp" role="tab" aria-controls="exp" aria-selected="true">Experience</a>
									</li>
                                  </div><br>
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "skill" ? "active" : "" ?>" id="skill-tab" data-id="skill" data-bs-toggle="tab" href="#skill" role="tab" aria-controls="skill" aria-selected="false">Skill</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "education" ? "active" : "" ?>" id="education-tab" data-id="education" data-bs-toggle="tab" href="#education" role="tab" aria-controls="edu" aria-selected="false">Education</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "hobby" ? "active" : "" ?>" id="hobby-tab" data-id="hobby" data-bs-toggle="tab" href="#hobby" role="tab" aria-controls="edu" aria-selected="false">Hobbies</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "reference" ? "active" : "" ?>" id="reference-tab" data-id="reference" data-bs-toggle="tab" href="#reference" role="tab" aria-controls="edu" aria-selected="false">Reference</a>
									</li>


								</ul> -->
								<div class="tab-content" id="myTabContent">
									<!-- Experiece lists -->
									<div class="tab-pane fade <?= $_GET["tab"] === "exp" ? "show active" : "" ?>" id="exp" role="tabpanel" aria-labelledby="exp-tab">
										<?php
										// Fetch student university's experience details.
										$suExpInfo = $suInfo->fetch_experience();

										if ($suExpInfo === NULL) {
										?>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Do you have any experience?</h1>
													<p class="lead mt-4">Here, add your own experiences now!</p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExp">
															Create now!
														</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addExp">Add new</i></button>
												</div>
											</div>
											<?php
											for ($i = 0; $i < count($suExpInfo); $i++) {
											?>
												<!-- Experience -->
												<div class="card-body border-top border-primary mt-1">
													<span class="fs-6">Job Title</span>
													<h3 class="mb-4">
														<?= $suExpInfo[$i]["sued_job_title"] ?>
														<?= $suExpInfo[$i]["sued_job_status"] === "Current" ? "<span class='badge rounded-pill bg-success ms-2'>Current</span>" : "" ?>
													</h3>
													<div class="row">
														<div class="col-md-8 col-12">
															<span class="fs-6">Company Name</span>
															<h5 class="mb-3"><?= $suExpInfo[$i]["sued_company_name"] ?></h5>



															<span class="fs-6">Company Address</span>
															<p class="h5">
																<?= $suExpInfo[$i]["sued_address"] ?>,<br>
																<?= $suExpInfo[$i]["postcode_number"] . " " . $suExpInfo[$i]["city_name"] . ", " . $suExpInfo[$i]["state_name"] ?><br>
																<?= $suExpInfo[$i]["country_name"] ?></p>
														</div>
														<div class="col-md-4 col-12">
															<span class="fs-6">Start Date</span>
															<h5 class="mb-3"><?= date_format(date_create($suExpInfo[$i]["sued_start_date"]), "dM-YY") ?></h5>
															<span class="fs-6">End Date</span>
															<h5 class="mb-3"><?= $suExpInfo[$i]["sued_job_status"] === "Current" ? "-" : date_format(date_create($suExpInfo[$i]["sued_end_date"]), "M-Y") ?></h5>
														</div>
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Job Description/Experience</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suExpInfo[$i]["sued_description"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->
														<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editExp<?= $i + 1 ?>" onclick="viewCurrPlace('editExpForm<?= $i + 1 ?>')">Edit</button>
														<!-- Edit experience modal -->
														<div class="modal fade" id="editExp<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="editExpLabel<?= $i + 1 ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title h4" id="editExpLabel<?= $i + 1 ?>">EDIT EXPERIENCE</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
																			<span aria-hidden="true"></span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form class="row" id="editExpForm<?= $i + 1 ?>" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="jobTitleEdit<?= $i + 1 ?>">Job Title <span class="text-danger">*<span></label>
																				<input type="text" name="jobTitle" value="<?= $suExpInfo[$i]["sued_job_title"] ?>" id="jobTitleEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="compNameEdit<?= $i + 1 ?>">Company Name <span class="text-danger">*<span></label>
																				<input type="text" name="compName" value="<?= $suExpInfo[$i]["sued_company_name"] ?>" id="compNameEdit<?= $i + 1 ?>" class="form-control" placeholder="Company Name" required>
																			</div>

																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="startDateEdit<?= $i + 1 ?>">Start Date <span class="text-danger">*<span></label>
																				<input type="date" name="startDate" value="<?= $suExpInfo[$i]["sued_start_date"] ?>" id="startDateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" required>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="endDateEdit<?= $i + 1 ?>">End Date <span class="text-danger">*<span></label>
																				<input type="date" name="endDate" value="<?= $suExpInfo[$i]["sued_end_date"] ?>" id="endDateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" <?= $suExpInfo[$i]["sued_job_status"] == "Current" ? "disabled" : "" ?> required>
																				<div class="form-check mt-2">
																					<input type="checkbox" name="jobStatus" value="Current" id="jobStatusEdit<?= $i + 1 ?>" class="form-check-input" <?= $suExpInfo[$i]["sued_job_status"] == "Current" ? "checked" : "" ?> onchange="endDateDisable(this.checked, this.id, <?= $i + 1 ?>)">
																					<label class="form-check-label" for="jobStatusEdit<?= $i + 1 ?>">Present</label>
																				</div>
																			</div>
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="addressEdit<?= $i + 1 ?>">Address <span class="text-danger">*<span></label>
																				<input type="text" name="address" value="<?= $suExpInfo[$i]["sued_address"] ?>" id="addressEdit<?= $i + 1 ?>" class="form-control" placeholder="Address">
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label">Country <span class="text-danger">*<span></label>
																				<select class="form-control" name="countryID" id="countryExpEdit<?= $i + 1 ?>" data-country-id="<?= $suExpInfo[$i]["sued_job_location_country_id"] ?>" data-width="100%" onchange="fetchState(this.id, this.value)" required>
																					<option value="" disabled>Select Country</option>
																					<?php
																					$countryInfo = $conn->query("SELECT * 
																							FROM `country` 
																							ORDER BY country_name");
																					$countryInfoNumRow = mysqli_num_rows($countryInfo);

																					for ($j = 0; $j < $countryInfoNumRow; $j++) {
																						$countryInfoRow = mysqli_fetch_object($countryInfo);
																						$selected = $countryInfoRow->country_id == $suExpInfo[$i]["sued_job_location_country_id"] ? "selected" : "";
																					?>
																						<option value="<?= $countryInfoRow->country_id ?>" <?= $selected ?>><?= $countryInfoRow->country_name ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label">State <span class="text-danger">*<span></label>
																				<select class="form-control" name="stateID" id="stateExpEdit<?= $i + 1 ?>" data-state-id="<?= $suExpInfo[$i]["sued_job_location_state_id"] ?>" data-width="100%" onchange="fetchCity(this.id, this.value)">
																					<option value="<?= $suExpInfo[$i]["sued_job_location_state_id"] ?>" selected><?= $suExpInfo[$i]["state_name"] ?></option>

																				</select>
																			</div>
																			<div class="mb-3 col-md-6">
																				<label class="form-label">City <span class="text-danger">*<span></label>
																				<select class="form-control" name="cityID" id="cityExpEdit<?= $i + 1 ?>" data-city-id="<?= $suExpInfo[$i]["sued_job_location_city_id"] ?>" data-width="100%">
																					<option value="<?= $suExpInfo[$i]["sued_job_location_city_id"] ?>" selected><?= $suExpInfo[$i]["city_name"] ?></option>

																				</select>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="zipCodeEdit<?= $i + 1 ?>">Zip/Postal Code</label>
																				<input type="text" name="zipCode" value="<?= $suExpInfo[$i]["postcode_number"] ?>" id="zipCodeEdit<?= $i + 1 ?>" class="form-control" placeholder="Zip">
																			</div>
																			<div class="mb-3 mb-4">
																				<label for="expDescEdit<?= $i + 1 ?>" class="form-label">Experience Description <span class="text-danger">*<span></label>
																				<textarea class="form-control" name="expDesc" id="expDescEdit<?= $i + 1 ?>" placeholder="Write your experience here " rows="5" maxlength="150"><?= $suExpInfo[$i]["sued_description"] ?></textarea>
																				<small>
																					Please describe your experience, responsibility, and any related projects that you've done.
																				</small>
																				<script>
																					ClassicEditor
																						.create(document.querySelector('#expDescEdit<?= $i + 1 ?>'), {

																						})
																						.then(editor => {
																							window.editor = editor;
																						})
																						.catch(err => {
																							console.error(err.stack);
																						});
																				</script>
																			</div>
																			<input type="hidden" name="suedID" value="<?= $suExpInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">

																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary" name="suExp" value="edit">Save</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>

														<!-- Delete experience -->
														<?php $suedID = $suExpInfo[$i]["sued_id"] ?>
														<button class="btn btn-outline-danger btn-sm" type="button" onclick="if(window.confirm('Are you sure to delete this experience?')) {
														window.open('function/student-portfolio.php?sued_id=<?= $suedID ?>', '_self');
													}">Delete</button>
													</div>
												</div>
										<?php
											}
										}
										?>
									</div>

									<!-- Education -->

									<div class="tab-pane fade <?= $_GET["tab"] === "education" ? "show active" : "" ?>" id="education" role="tabpanel" aria-labelledby="education-tab">
										<?php
										$sql = "SELECT * 
																				FROM `student_university_education_details`           
																				WHERE sued_student_university_id =$suID 
																				ORDER BY sued_course_start_date desc;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suEduInfo = $student->fetch_all(MYSQLI_ASSOC);
										rsort($suEduInfo, 1);
										// Fetch student university's experience details.
										// $suEduInfo = $suInfo->fetch_education();

										if ($suEduInfo === NULL) {
										?>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Here, add your own education now!</h1>
													<p class="lead mt-4"></p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEdu">
															Create now!
														</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addEdu">Add new</i></button>
												</div>
											</div>
											<?php
											for ($i = 0; $i < count($suEduInfo); $i++) {
											?>
												<!-- Experience -->
												<div class="card-body border-top border-primary mt-1">
													<span class="fs-6">Group</span>
													<h3 class="mb-4">
														<?= $suEduInfo[$i]["sued_course_title"] ?>

													</h3>
													<div class="row">
														<div class="col-md-8 col-12">
															<span class="fs-6">Collage Name</span>
															<h5 class="mb-3"><?= $suEduInfo[$i]["sued_college_name"] ?></h5>

														</div>

														<div class="col-md-4 col-12">
															<span class="fs-6">Start Date</span>
															<h5 class="mb-3"><?= date_format(date_create($suEduInfo[$i]["sued_course_start_date"]), "M-Y") ?></h5>
															<span class="fs-6">End Date</span>
															<h5 class="mb-3"><?= date_format(date_create($suEduInfo[$i]["sued_course_end_date"]), "M-Y") ?></h5>
														</div>
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Your Percentage/Education</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suEduInfo[$i]["sued_course_description"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->
														<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editEdu<?= $i + 1 ?>" onclick="('editEduForm<?= $i + 1 ?>')">Edit</button>
														<!-- Edit experience modal -->
														<div class="modal fade" id="editEdu<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="editEduLabel<?= $i + 1 ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title h4" id="editEduLabel<?= $i + 1 ?>">EDIT EDUCATION</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
																			<span aria-hidden="true"></span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form class="row" id="editEduForm<?= $i + 1 ?>" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="courseTitleEdit<?= $i + 1 ?>">Highest Study<span class="text-danger">*<span></label>
																				<input type="text" name="courseTitle" value="<?= $suEduInfo[$i]["sued_course_title"] ?>" id="courseTitleEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="collegeNameEdit<?= $i + 1 ?>">Collage Name<span class="text-danger">*<span></label>
																				<input type="text" name="collegeName" value="<?= $suEduInfo[$i]["sued_college_name"] ?>" id="collegeNameEdit<?= $i + 1 ?>" class="form-control" placeholder="Company Name" required>
																			</div>

																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="startDateEdit<?= $i + 1 ?>">Start Date <span class="text-danger">*<span></label>
																				<input type="date" name="startDate" value="<?= $suEduInfo[$i]["sued_course_start_date"] ?>" id="startDateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" required>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="endDateEdit<?= $i + 1 ?>">End Date <span class="text-danger">*<span></label>
																				<input type="date" name="endDate" value="<?= $suEduInfo[$i]["sued_course_end_date"] ?>" id="endDateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" required>
																				<div class="form-check mt-2">
																					<input type="checkbox" name="courseStatus" value="Current" id="courseStatusEdit<?= $i + 1 ?>" class="form-check-input" <?= $suEduInfo[$i]["sued_course_status"] == "Current" ? "checked" : "" ?> onchange="endDateDisable(this.checked, this.id, <?= $i + 1 ?>)">
																					<label class="form-check-label" for="courseStatusEdit<?= $i + 1 ?>">Present</label>
																				</div>
																			</div>

																			<div class="mb-3 col-12 col-md-6">




																			</div>


																			<div class="mb-3 mb-4">
																				<label for="eduDescEdit<?= $i + 1 ?>" class="form-label">Education Percentage <span class="text-danger">*<span></label>
																				<textarea class="form-control" name="eduDesc" id="eduDescEdit<?= $i + 1 ?>" placeholder="Write your experience here " rows="5" maxlength="10"><?= $suEduInfo[$i]["sued_course_description"] ?></textarea>

																				<script>
																					ClassicEditor
																						.create(document.querySelector('#eduDescEdit<?= $i + 1 ?>'), {

																						})
																						.then(editor => {
																							window.editor = editor;
																						})
																						.catch(err => {
																							console.error(err.stack);
																						});
																				</script>
																			</div>
																			<input type="hidden" name="suedID" value="<?= $suEduInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">

																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary" name="suEdu" value="edit">Save</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>

														<!-- Delete Education -->

														<?php $suedID = $suEduInfo[$i]["sued_id"]; ?>


														<?php
														if (isset($_GET['delete_ep'])) {
															$delete = $_GET['delete_ep'];

															$delep = $conn->query("DELETE FROM student_university_education_details where sued_id = '$delete'");

															if ($delep) {

																echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
															} else {
																echo "<script>alert('Delete course is not successful.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
															}
														}


														?>


														 <a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>


													</div>
												</div>
										<?php
											}
										}

										?>
									</div>







									<!-- Skill lists -->
									<div class="tab-pane fade <?= $_GET["tab"] === "skill" ? "show active" : "" ?>" id="skill" role="tabpanel" aria-labelledby="skill-tab">
										<?php

										$sql = "SELECT * 
									FROM `student_university_skill_set` AS sus 
									JOIN `skill_type` AS st ON sus.sus_skill_type_id = st.skill_id 
									WHERE sus.sus_student_university_id =$suID
									ORDER BY sus_skill_level desc;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suSkillInfo = $student->fetch_all(MYSQLI_ASSOC);
										rsort($suSkillInfo, 1);

										if ($suSkillInfo === NULL) {
										?>
											<!-- No skills -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Do you have any skills?</h1>
													<p class="lead mt-4">Here, add your own skills now!</p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSkill">
															Add now!
														</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-4">
													<button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addSkill">Add skill</button>
												</div>
												<!-- View skill -->
												<div class="py-2" id="">
													<div class="container">
														<div class="row">
															<!-- List of skills -->
															<?php
															$i = 0;

															foreach ($suSkillInfo as $skill) {
																$skill_id = $skill["skill_id"];
																$su_skill_id = $skill["sus_id"];

																if ($skill["sus_skill_certificate"] !== NULL) {
																	$certName = "<mark>" . $skill["sus_skill_certificate"] . "</mark>";
																	$certDate = "<span class='text-body'>" . date_format(date_create($skill["sus_certificate_date"]), "M-Y") . "</span>";
																	$certPrvd = "<span class='text-body'>" . $skill["sus_certificate_provider"] . "</span>";
																	$certLink = "../assets/attachment/student/$suID/skillcert/" . $suSkillInfo[$i]["sus_skill_certificate"];
																} else {
																	$certName = "<span class='text-muted'><em>Certificate not provided</em></span>";
																	$certDate = "<span class='text-muted'><em>Not available</em></span>";
																	$certPrvd = "<span class='text-muted'><em>Not available</em></span>";
																	$certLink = NULL;
																}
															?>
																<div class="col-xl-6 col-lg-6 col-md-6 col-12">
																	<div class="card mb-4 card-hover border">
																		<div class="card-body d-flex justify-content-between align-items-center p-4">
																			<div class="w-100">
																				<div class="ms-1 d-flex justify-content-between w-100">
																					<h4 class="mb-1 text-truncate" style="max-width: 250px;">
																						<a class="text-inherit" data-bs-toggle="tooltip" data-placement="top" title="<?= $skill["skill_name"] ?>" style="cursor: default;">
																							<?= $skill["skill_name"] ?>
																						</a>
																					</h4>
																					<!-- dropdown -->
																					<div class="dropdown dropstart">
																						<a href="#" class="text-link" id="userSetting" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																							<i class="fe fe-more-horizontal fs-3"></i>
																						</a>
																						<ul class="dropdown-menu border" aria-labelledby="userSetting">
																							<li class="dropdown-animation dropdown-submenu dropdown-toggle-none">
																								<a class="dropdown-item dropdown-toggle" href="#" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown">
																									<i class="fe fe-award dropdown-item-icon"></i>
																									Skill certificate
																								</a>
																								<ul class="dropdown-menu dropdown-menu-xs border">
																									<?php
																									if ($certLink !== NULL) {
																									?>
																										<li>
																											<a class="dropdown-item" href="<?= $certLink ?>" target="_blank">
																												<i class="fe fe-eye dropdown-item-icon"></i>
																												View certificate
																											</a>
																										</li>
																										<li>
																											<a class="dropdown-item" href="<?= $certLink ?>" download>
																												<i class="fe fe-download dropdown-item-icon"></i>
																												Download certificate
																											</a>
																										</li>
																									<?php
																									}
																									?>
																									<li>
																										<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#upCertModal<?= $i ?>">
																											<i class="fe fe-upload dropdown-item-icon"></i>
																											Upload certificate
																										</a>
																									</li>
																									<?php
																									if ($certLink !== NULL) {
																									?>
																										<li>
																											<a class="dropdown-item" style="cursor: pointer;" onclick="if(window.confirm('Are you sure to delete this certificate?')) {
																										window.open('function/student-portfolio.php?delSkillCert=<?= $certLink ?>&su_skill_id=<?= $su_skill_id ?>', '_self');
																									}">
																												<i class="fe fe-trash dropdown-item-icon"></i>
																												Delete certificate
																											</a>
																										</li>
																									<?php
																									}
																									?>
																								</ul>
																							</li>
																							<li>
																								<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editSkillModal<?= $i ?>">
																									<i class="fe fe-edit dropdown-item-icon"></i>
																									Edit skill info
																								</a>
																							</li>
																							<li>
																								<a class="dropdown-item" style="cursor: pointer;" onclick="if(window.confirm('Are you sure to delete this certificate?')) {
																								window.open('function/student-portfolio.php?delSkillSet=<?= $certLink ?>&skill_id=<?= $skill_id ?>&su_skill_id=<?= $su_skill_id ?>', '_self');
																							}">
																									<i class="fe fe-trash dropdown-item-icon"></i>
																									Delete skill
																								</a>
																							</li>
																						</ul>
																					</div>
																				</div>
																				<?php $bala = $skill["sus_skill_level"]; ?>
																				<ul class="ms-1 list-inline mb-0">
																					<li class="text-dark text-truncate"><?= skillLevel($bala) ?></li>
																					<li class="text-dark text-truncate"><?= $certName ?></li>
																					<li class="text-dark ms-2">Date: <?= $certDate ?></li>
																					<li class="text-dark ms-2">Provider: <?= $certPrvd ?></li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- Skill info edit modal -->
																<div class="modal fade" id="editSkillModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="editSkillModalTitle<?= $i ?>" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-centered" role="document">
																		<div class="modal-content">
																			<form action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																				<div class="modal-header">
																					<h5 class="modal-title h4" id="editSkillModalTitle<?= $i ?>">Edit Skill Info</h5>
																					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true"></span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<div class="row">
																						<!-- Skill name input -->
																						<div class="mb-3 col-12 col-md-7">
																							<label for="skillName<?= $i ?>" class="form-label">Skill Name<span class="text-danger">*</span></label>
																							<input type="text" name="skill_name" value="<?= $skill["skill_name"] ?>" id="skillName<?= $i ?>" class="form-control" placeholder="Skill name" required>
																						</div>
																						<!-- Skill level input -->
																						<div class="mb-3 col-12 col-md-5">
																							<label for="skillLvl<?= $i ?>" class="form-label">Proficiency<span class="text-danger">*</span></label>
																							<select class="selectpicker" name="skill_lvl" id="skillLvl<?= $i ?>" data-width="100%" required>
																								<option value="">Select level</option>
																								<option value="40" <?= $skill["sus_skill_level"] === "40" ? "selected" : "" ?>>Beginner</option>
																								<option value="70" <?= $skill["sus_skill_level"] === "70" ? "selected" : ""  ?>>Intermediate</option>
																								<option value="90" <?= $skill["sus_skill_level"] === "90" ? "selected" : ""  ?>>Advance</option>
																							</select>
																						</div>
																						<input type="hidden" name="skill_type_id" value="<?= $skill_id ?>">
																						<input type="hidden" name="su_skill_id" value="<?= $su_skill_id ?>">
																					</div>
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																					<button type="submit" name="editSkillInfo" class="btn btn-primary">Save changes</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
																<!-- Skill certificate upload modal -->
																<div class="modal fade" id="upCertModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="upCertModalTitle<?= $i ?>" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-centered" role="document">
																		<div class="modal-content">
																			<form action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																				<div class="modal-header">
																					<h5 class="modal-title h4" id="upCertModalTitle<?= $i ?>">Upload Skill Certificate</h5>
																					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true"></span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<div class="row">
																						<!-- Skill certificate input -->
																						<div class="mb-3 col-12 col-md-12">
																							<p class="mb-1 text-dark">
																								Skill certificate<span class="text-danger">*</span><br>
																								<small class="text-muted">It will override your current certificate (<strong>only accept .pdf, .doc, and .docx</strong>).</small>
																							</p>
																							<div class="mb-1">
																								<input type="file" name="skill_cert" accept=".pdf, .doc, .docx" size="40" class="form-control" id="inputfavicon">
																							</div>
																							<small>Current file: <span class="text-dark"><?= $skill["sus_skill_certificate"] ?></span></small>
																						</div>
																						<!-- Skill certificate provider input -->
																						<div class="mb-3 col-12 col-md-7">
																							<label for="skillPrvd<?= $i ?>" class="form-label">Certificate provider<span class="text-danger">*</span></label>
																							<input type="text" name="skill_prvd_name" value="<?= $skill["sus_certificate_provider"] ?>" id="skillPrvd<?= $i ?>" class="form-control" placeholder="Certificate provider" required>
																						</div>
																						<!-- Skill certificate date received input -->
																						<div class="mb-3 col-12 col-md-5">
																							<label for="skillDate<?= $i ?>" class="form-label">Date received<span class="text-danger">*</span></label>
																							<input type="date" name="skill_date" value="<?= $skill["sus_certificate_date"] ?>" id="skillDate<?= $i ?>" class="form-control" placeholder="" required>
																						</div>
																						<input type="hidden" name="skill_type_id" value="<?= $skill_id ?>">
																						<input type="hidden" name="su_skill_id" value="<?= $su_skill_id ?>">
																					</div>
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																					<button type="submit" name="upSkillCert" class="btn btn-primary">Save changes</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>



															<?php
																$i++;
															}
															?>
														</div>
													</div>
												</div>
											</div>

										<?php
										}
										?>

									</div>
									<div class="tab-pane fade <?= $_GET["tab"] === "hobby" ? "show active" : "" ?>" id="hobby" role="tabpanel" aria-labelledby="hobby-tab">
										<?php
										$sql = "SELECT * 
																				FROM `student_university_hobby_details`           
																				WHERE sued_student_university_id = $suID ;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suHobbyInfo = $student->fetch_all(MYSQLI_ASSOC);

										if ($suHobbyInfo === NULL) {



										?>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Here, add your own hobby now!</h1>
													<p class="lead mt-4"></p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHobby">
															Create now!
														</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addHobby">Add new</i></button>
												</div>
											</div>

											<?php
											for ($i = 0; $i < count($suHobbyInfo); $i++) {
											?>

												<!-- Experience -->
												<div class="card-body border-top border-primary mt-1">
													<span class="fs-6">Hobby's</span>
													<h3 class="mb-4">

														<?= $suHobbyInfo[$i]["sued_hobby_name"] ?>

													</h3>

													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->

														<!-- Edit experience modal -->
														<div class="modal fade" id="editHobby<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="editHobbyLabel<?= $i + 1 ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title h4" id="editHobbyLabel<?= $i + 1 ?>">EDIT HOBBY</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
																			<span aria-hidden="true"></span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form class="row" id="editHobbyForm<?= $i + 1 ?>" method="post" enctype="multipart/form-data">
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="courseTitleEdit<?= $i + 1 ?>">Hobby<span class="text-danger">*<span></label>
																				<input type="text" name="courseTitle" value="<?= $suHobbyInfo[$i]["sued_hobby_name"] ?>" id="courseTitleEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>


																	</div>

																	<div class="mb-3 col-12 col-md-6">




																	</div>



																	<input type="hidden" name="suedID" value="<?= $suHobbyInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">

																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary" name="suHobby" value="edit">Save</button>
																	</div>
																	</form>
																</div>
															</div>
														</div>
													</div>

													<!-- Delete Education -->

													<?php $suedID = $suHobbyInfo[$i]["sued_id"]; ?>


													<?php
													if (isset($_GET['delete_ep'])) {
														$delete = $_GET['delete_ep'];

														$delep = $conn->query("DELETE FROM student_university_hobby_details where sued_id = '$delete'");

														if ($delep) {

															echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
														} else {
															echo "<script>alert('Delete course is not successful.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
														}
													}


													?>
													<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editHobby<?= $i + 1 ?>" onclick="('editHobbyForm<?= $i + 1 ?>')">Edit</button>


													 <a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>



												</div>
										<?php
											}
										}

										?>



									</div>
									<!-- Reference -->
									<div class="tab-pane fade <?= $_GET["tab"] === "reference" ? "show active" : "" ?>" id="reference" role="tabpanel" aria-labelledby="reference-tab">
										<?php
										$sql = "SELECT * 
																				FROM `student_university_reference_details`           
																				WHERE sued_student_university_id = $suID ;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suReferenceInfo = $student->fetch_all(MYSQLI_ASSOC);
										rsort($suReferenceInfo, 1);
										// Fetch student university's experience details.
										// $suEduInfo = $suInfo->fetch_education();

										if ($suReferenceInfo === NULL) {
										?>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Here, add your own reference now!</h1>
													<p class="lead mt-4"></p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReference">
															Create now!
														</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addReference">Add new</i></button>
												</div>
											</div>
											<?php
											for ($i = 0; $i < count($suReferenceInfo); $i++) {
											?>
												<!-- Experience -->
												<div class="card-body border-top border-primary mt-1">
													<div class="row">
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Your reference</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suReferenceInfo[$i]["sued_reference"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->
														<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editReference<?= $i + 1 ?>" onclick="('editReferenceForm<?= $i + 1 ?>')">Edit</button>
														<!-- Edit experience modal -->
														<div class="modal fade" id="editReference<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="editReferenceLabel<?= $i + 1 ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title h4" id="editReferenceLabel<?= $i + 1 ?>">EDIT REFERENCE</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
																			<span aria-hidden="true"></span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form class="row" id="editReferenceForm<?= $i + 1 ?>" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																			<div class="mb-3 mb-4">
																				<label for="referenceDescEdit<?= $i + 1 ?>" class="form-label">reference <span class="text-danger">*<span></label>
																				<textarea class="form-control" name="referenceDesc" id="referenceDescEdit<?= $i + 1 ?>" placeholder="Write your reference here " rows="5" maxlength="100"><?= $suReferenceInfo[$i]["sued_reference"] ?></textarea>


																			</div>
																			<input type="hidden" name="suedID" value="<?= $suReferenceInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">

																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary" name="suReference" value="edit">Save</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>

														<!-- Delete Education -->

														<?php $suedID = $suReferenceInfo[$i]["sued_id"]; ?>


														<?php
														if (isset($_GET['delete_ep'])) {
															$delete = $_GET['delete_ep'];

															$delep = $conn->query("DELETE FROM student_university_reference_details where sued_id = '$delete'");

															if ($delep) {

																echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
															} else {
																echo "<script>alert('Delete course is not successful.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
															}
														}


														?>


														 <a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>


													</div>
												</div>
										<?php
											}
										}

										?>
									</div>
									<!-- reference  end -->

								</div>

							</div>


							<!-- Add new experience modal  -->
							<div class="modal fade" id="addExp" tabindex="-1" role="dialog" aria-labelledby="addExpLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addExpLabel">Add Experience</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addExpForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="jobTitle">Job Title <span class="text-danger">*<span></label>
													<input type="text" name="jobTitle" id="jobTitle" class="form-control" placeholder="Job Title" required>
												</div>
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="compName">Company Name <span class="text-danger">*<span></label>
													<input type="text" name="compName" id="compName" class="form-control" placeholder="Company Name" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
													<input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
													<input type="date" name="endDate" id="endDateAdd" class="form-control" placeholder="Select date" disabled required>
													<div class="form-check mt-2">
														<input type="checkbox" name="jobStatus" value="Current" id="jobStatusAdd" class="form-check-input" checked onchange="endDateDisable(this.checked, this.id, 0)">
														<label class="form-check-label" for="jobStatus">Present</label>
													</div>
												</div>

												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="address">Address <span class="text-danger">*<span></label>
													<input type="text" name="address" id="address" class="form-control" placeholder="Address">
												</div>

												<div class="mb-3 col-12 col-md-6">
													<label class="form-label">Country <span class="text-danger">*<span></label>
													<select class="form-control" name="countryID" id="countryExpAdd" data-width="100%" onchange="fetchState(this.id, this.value)" required>
														<option value="" selected disabled>Select Country</option>
														<?php
														$countryInfo = $conn->query("SELECT * 
																		FROM `country` 
																		ORDER BY country_name");
														$countryInfoNumRow = mysqli_num_rows($countryInfo);

														for ($i = 0; $i < $countryInfoNumRow; $i++) {
															$countryInfoRow = mysqli_fetch_object($countryInfo);
														?>
															<option value="<?= $countryInfoRow->country_id ?>"><?= $countryInfoRow->country_name ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label">State <span class="text-danger">*<span></label>
													<select class="form-control" name="stateID" id="stateExpAdd" data-width="100%" onchange="fetchCity(this.id, this.value)" required>
														<option value="" selected disabled>Select State</option>

													</select>
												</div>
												<div class="mb-3 col-md-6">
													<label class="form-label">City <span class="text-danger">*<span></label>
													<select class="form-control" name="cityID" id="cityExpAdd" data-width="100%" required>
														<option value="" selected disabled>Select City</option>

													</select>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="mb-3 mb-4">
													<label for="addExpDesc" class="form-label">Experience Description <span class="text-danger">*<span></label>
													<textarea class="form-control" name="expDesc" id="addExpDesc" placeholder="Write your experience here " rows="5" maxlength="150"></textarea>
													<span class="pull-right label label-default" id="count_message"></span>
													<small>
														Please describe your experience, responsibility, and any related projects that you've done.
													</small>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="suExp" value="add">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<!-- Add new skill modal  -->
							<div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-labelledby="addSkillLabel" aria-hidden="true">
								<div class="modal-dialog modal-xl" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addSkillLabel">Add Skill</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form id="addSkillForm" action="../student/function/student-portfolio.php" method="post" enctype="multipart/form-data">
												<!-- Skill slot default -->
												<div class="row" id="defaultSkillRow">
													<div class="mb-3 col-12 col-md-6">
														<label class="form-label" for="skillTitle">Skill <span class="text-danger">*</span></label>
														<input type="text" name="skillTitle[]" id="skillTitle" class="form-control" placeholder="Skill name" required>
													</div>
													<div class="mb-3 col-12 col-md-3">
														<label class="form-label">Proficiency <span class="text-danger">*</span></label>
														<select name="skillLvl[]" id="skillLvl" class="selectpicker" data-width="100%" required>
															<option value="">Select level</option>
															<option value="40">Beginner</option>
															<option value="70">Intermediate</option>
															<option value="90">Advance</option>
														</select>
													</div>
													<div class="mb-3 col-12 col-md-2">
														<div class="form-check mt-6">
															<input type="checkbox" name="certCheck[]" id="certCheck" class="form-check-input" onchange="certEnable(this.checked, 0)">
															<label class="form-check-label" for="certCheck">Add certificate</label>
														</div>
													</div>
													<div class="mb-3 col-12 col-md-1">
														<label class="form-label fade" for="addSkillSlot">Add </label>
														<button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-placement="top" title="Add skill slot" onclick="addNewRow()"><i class="fe fe-plus"></i></button>
													</div>
													<div id="insertCert0" class="row collapse">
														<div class="mb-3 col-12 col-md-4">
															<label class="form-label" for="certProvider">Certificate Provider <span class="text-danger">*</span></label>
															<input type="text" name="certProvider[]" id="certProvider0" class="form-control" placeholder="Provider name">
														</div>
														<div class="mb-3 col-12 col-md-4">
															<label class="form-label" for="upCert">Upload Certificate <span class="text-danger">* </span><small>(.pdf, .doc, .docx)</small></label>
															<input type="file" accept=".pdf, .doc, .docx" size="40" name="upCert[]" class="form-control" id="upCert0">
														</div>
														<div class="mb-3 col-12 col-md-3">
															<label class="form-label" for="certDate">Date Received <span class="text-danger">*</span></label>
															<input type="date" name="certDate[]" id="certDate0" class="form-control" placeholder="">
														</div>
													</div>
													<!-- Skill slot 1 -->
												</div>
												<!-- Modal footer -->
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="addSkill">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<!-- education -->
							<div class="modal fade" id="addEdu" tabindex="-1" role="dialog" aria-labelledby="addEduLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addEduLabel">Add education</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addEduForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="collegeName">College name <span class="text-danger">*<span></label>
													<input type="text" name="collegeName" id="collegeName" class="form-control" placeholder="course Title" required>
												</div>

												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="courseTitle">Your Group<span class="text-danger">*<span></label>
													<input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="College Name" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
													<input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
													<input type="date" name="endDate" id="endDateAdd" class="form-control" placeholder="Select date" required>

												</div>





												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="mb-3 mb-4">
													<label for="addEduDesc" class="form-label">Education Percentage <span class="text-danger">*<span></label>
													<textarea class="form-control" name="eduDesc" id="addEduDesc" placeholder="eg:10/10 ,eg:9.0/10" rows="5" maxlength="10"></textarea>

													<script>
														ClassicEditor
															.create(document.querySelector('#addeduDesc'), {

															})
															.then(editor => {
																window.editor = editor;
															})
															.catch(err => {
																console.error(err.stack);
															});
													</script>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="suEdu" value="add">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="addHobby" tabindex="-1" role="dialog" aria-labelledby="addHobbyLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addHobbyLabel">Add hobby</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addEduForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">


												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="courseTitle">Your hobby<span class="text-danger">*<span></label>
													<input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="College Name" required>
												</div>






												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->

												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="suHobby" value="add">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- hobby END -->
							<!-- reference -->
							<div class="modal fade" id="addReference" tabindex="-1" role="dialog" aria-labelledby="addReferenceLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addReferenceLabel">Add reference</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addReferenceForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">






												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="mb-3 mb-4">
													<label for="addReferenceDesc" class="form-label">reference <span class="text-danger">*<span></label>
													<textarea class="form-control" name="referenceDesc" id="addReferenceDesc" placeholder="eg:10/10 ,eg:9.0/10" rows="5" maxlength="100"></textarea>


												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="suReference" value="add">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- reference end -->

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
																	<label class="form-label" for="linkedinSU">Linked in <span class="text-danger">*<span></label>
																	<input type="text" name="linkedinSU" value="<?= $suInfoRow["su_linked_in"] ?>" id="linkedinSU" class="form-control" placeholder="Linked in link" required>
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
	<!-- Student Portfolio JS -->
	<script src="js/student-portfolio.js"></script>

	<!-- For navigation -->
	<script type="text/javascript">
		// Tab navigation.
		$("#myTab > li > a").click(function() {
			var id = $(this).data("id");
			var fileLink = window.location.href;
			var link = fileLink.split("?")[0] + "?tab=" + id;

			// --- change the link query values.
			window.history.pushState("", "", link);
		});
	</script>
	<!-- <script>
		
    var text_max = 10;
$('#count_message').html('0 / ' + text_max );

$('#expDesc').keyup(function() {
  var text_length = $('#addExpDesc').val().length;
  var text_remaining = text_max - text_length;
  
  $('#count_message').html(text_length + ' / ' + text_max);
});
</script> -->


</body>

</html>