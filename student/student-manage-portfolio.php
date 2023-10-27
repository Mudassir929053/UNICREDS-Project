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
				<!-- Sidebar nav -->
				<div class="col-lg-3 col-md-4 col-12">
					<?php
					include("student-sidebar.php");
					?>
				</div>
				<!-- Main content -->
				<div class="col-lg-9 col-md-8 col-12 mb-4">
					<!-- Card -->
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<h3 class="mb-0">Portfolio Details</h3>
							<p class="mb-0">
								You have full control to manage your own portfolio.
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
										<h4 class="mb-0"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h4>
										<p class="mb-0">
											<?= $suInfoRow["su_email"] ?>
										</p>
										<p class="mb-0">
											<?= $suInfoRow["university_name"] ?>
										</p>
									</div>
								</div>
								<div>
									<?php if ($suInfoRow["su_cv"] != NULL) {
										$suCV = $suInfoRow["su_cv"];
									?>
										<!-- Manage CV -->
										<a type="button" class="btn btn-outline-primary btn-sm mb-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#manageCVModal">View CV</a>
										<!-- Manage CV modal -->
										<div class="modal fade" id="manageCVModal" tabindex="-1" role="dialog" aria-labelledby="manageCVModalTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<form id="manageCVForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
														<div class="modal-header">
															<h5 class="modal-title h4" id="manageCVModalTitle">Curriculum Vitae</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																<span aria-hidden="true"></span>
															</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="mb-3 col-12 col-md-8">
																	<label class="form-label" for="cvName">Current CV</label>
																	<input type="text" class="form-control" id="cvName" value="<?= $suInfoRow["su_cv"] ?>" disabled>
																</div>
																<div class="mb-3 col-12 col-md-2">
																	<label class="form-label fade" for="viewCV">View</label>
																	<a href="../assets/attachment/student/<?= $suInfoRow["su_id"] ?>/cv/<?= $suInfoRow["su_cv"] ?>" target="_blank">
																		<button type="button" class="btn btn-info" id="viewCV" data-bs-toggle="tooltip" data-placement="top" title="View CV"><i class="fe fe-eye"></i></button>
																	</a>
																</div>
																<div class="mb-3 col-12 col-md-1">
																	<label class="form-label fade" for="deleteCV">Delete</label>
																	<button type="button" class="btn btn-danger" id="deleteCV" data-bs-toggle="tooltip" data-placement="top" title="Delete CV" onclick="if(window.confirm('Are you sure to delete this CV?')) {
																		window.open('function/student-portfolio.php?delCV=<?= $suCV ?>', '_self');
																	}"><i class="fe fe-trash"></i></button>
																</div>
																<div class="mb-3 col-12 col-md-12">
																	<label class="form-label" for="newCV">Upload new CV</label>
																	<input type="file" accept=".pdf" size="40" name="studentCV" class="form-control" id="newCV" />
																</div>
																<input type="hidden" name="currCV" value="<?= $suInfoRow["su_cv"] ?>">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="submit" name="uploadCV" class="btn btn-primary">Save</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									<?php } else { ?>
										<!-- Upload CV -->
										<a type="button" class="btn btn-outline-primary btn-sm mb-3 mb-md-0" data-bs-toggle="modal" data-bs-target="#uploadCVModal">Upload CV</a>
										<!-- Upload CV modal -->
										<div class="modal fade" id="uploadCVModal" tabindex="-1" role="dialog" aria-labelledby="uploadCVModalTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<form id="uploadCVForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
														<div class="modal-header">
															<h5 class="modal-title h4" id="uploadCVModalTitle">Curriculum Vitae</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
																<span aria-hidden="true"></span>
															</button>
														</div>
														<div class="modal-body">
															<div class="mb-3">
																<p class="mb-1 text-dark">
																	CV or Resume <small class="text-muted">(Accept .pdf file format only.)</small>
																</p>
																<div class="input-group mb-1">
																	<input type="file" accept=".pdf" size="40" name="studentCV" class="form-control" id="studentCV" required>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="submit" name="uploadCV" class="btn btn-primary">Upload</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									<?php } ?>
									<!-- Edit profile -->
									<a href="resume-templates.php" class="btn btn-outline-primary btn-sm mb-3 mb-md-0">Choose Resume</a>
									<a href="coverletter.php" class="btn btn-outline-primary btn-sm mb-3 mb-md-0">Cover Letter</a>
									<a href="student-manage-profile.php" class="btn btn-outline-primary btn-sm mb-3 mb-md-0">Update Profile</a>
								</div>
							</div>
							<!-- Portfolio info view -->
							<div class="mt-6">
								<ul class="nav nav-tabs justify-content-center fw-bold text-uppercase" id="myTab" role="tablist">
									<!-- <li class="nav-item">
    <a class="nav-link <?= $_GET["tab"] === "exp" ? "active" : "" ?>" id="exp-tab" data-id="exp" data-bs-toggle="tab" href="#exp" role="tab" aria-controls="exp" aria-selected="true">Experience</a>
  </li> -->
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
									<li class="nav-item">
										<a class="nav-link <?= $_GET["tab"] === "language" ? "active" : "" ?>" id="language-tab" data-id="language" data-bs-toggle="tab" href="#language" role="tab" aria-controls="edu" aria-selected="false">Experience</a>
									</li>
								</ul>



								<div class="tab-content" id="myTabContent">
									<!-- Experiece lists -->
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
										if (!$suEduInfo) {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<div id="tooltip">
														<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Improve your education section by including clear and relevant details about your courses, certifications, and academic achievements."> <i class="fa bala">&#xf0eb;</i></button>
													</div>
												</div>
											</div>
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
													<span class="fs-6">Field Of Study</span>
													<h3 class="mb-4">
														<?= $suEduInfo[$i]["sued_course_title"] ?>
													</h3>
													<div class="row">
														<div class="col-md-8 col-12">
															<span class="fs-6">School / Collage Name</span>
															<h5 class="mb-3"><?= $suEduInfo[$i]["sued_college_name"] ?></h5>
														</div>
														<div class="col-md-4 col-12">
															<span class="fs-6">Start Date</span>
															<h5 class="mb-3"><?= date_format(date_create($suEduInfo[$i]["sued_course_start_date"]), "M-Y") ?></h5>
															<span class="fs-6">End Date</span>
															<?php
															if ($suEduInfo[$i]["sued_course_end_date"] == "0000-00-00") {
																echo	  '<h5 class="mb-3"> Current </h5>';
															} else {
															?>
																<h5 class="mb-3"><?= date_format(date_create($suEduInfo[$i]["sued_course_end_date"]), "M-Y") ?></h5>
															<?php } ?>
														</div>
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Discription</span>
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
																				<label class="form-label" for="courseTitleEdit<?= $i + 1 ?>">Field Of Study<span class="text-danger">*<span></label>
																				<input type="text" name="courseTitle" value="<?= $suEduInfo[$i]["sued_course_title"] ?>" id="courseTitleEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="collegeNameEdit<?= $i + 1 ?>">School / Collage Name<span class="text-danger">*<span></label>
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
																					<input type="checkbox" name="courseStatus" value="Current" id="courseStatusEdit<?= $i + 1 ?>" class="form-check-input" <?= $suEduInfo[$i]["sued_course_status"] == "Current" ? "checked" : "" ?> onchange="endDateDisable(this.checked, this.id,document.getElementById('endDateEdit<?= $i + 1 ?>') ,<?= $i + 1 ?>)">
																					<label class="form-check-label" for="courseStatusEdit<?= $i + 1 ?>">Present</label>
																				</div>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																			</div>
																			<div class="mb-3 mb-4">
																				<label for="eduDescEdit<?= $i + 1 ?>" class="form-label">Description <span class="text-danger">*</span></label>
																				<textarea class="form-control" name="eduDesc" id="eduDescEdit<?= $i + 1 ?>" placeholder="Write your experience here" rows="5" maxlength="200" oninput="updateCharacterCount(this)"><?= $suEduInfo[$i]["sued_course_description"] ?></textarea>
																				<div id="characterCount" class="form-text"></div>
																			</div>
																			<script>
																				function updateCharacterCount(textarea) {
																					var maxLength = parseInt(textarea.getAttribute("maxlength"));
																					var currentLength = textarea.value.length;
																					var remainingLength = maxLength - currentLength;
																					var characterCount = document.getElementById("characterCount");
																					characterCount.textContent = (remainingLength >= 0 ? remainingLength : 0) + " characters remaining";
																					if (remainingLength < 0) {
																						characterCount.classList.add("text-danger");
																					} else {
																						characterCount.classList.remove("text-danger");
																					}
																				}
																			</script>
																			<input type="hidden" name="suedID" value="<?= $suEduInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary btn-sm" name="suEdu" value="edit">Save</button>
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
										if (!$suSkillInfo) {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<div id="tooltip">
														<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Highlight relevant skills for the job. Examples: Communication, Leadership, Problem-solving. Explore certificate courses like Project Management, Digital Marketing, Web Development.">
															<i class="fa bala">&#xf0eb;</i>
														</button>
													</div>
												</div>
											</div>
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
																							<input type="text" name="skill_name" value="<?= $skill["skill_name"] ?>" id="skillName<?= $i ?>" class="form-control" placeholder="Skill name Ex: Python" required>
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
																					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																					<button type="submit" name="editSkillInfo" class="btn btn-primary btn-sm">Save changes</button>
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
																					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																					<button type="submit" name="upSkillCert btn-sm" class="btn btn-primary">Save changes</button>
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
										if (!$suHobbyInfo) {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<div id="tooltip">
														<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Include hobbies that are relevant to the job and showcase your personality, such as sports or photography. Avoid mentioning controversial or adult hobbies."> <i class="fa bala">&#xf0eb;</i></button>
													</div>
												</div>
											</div>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Here, add your hobby's now!</h1>
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
													<div class="row">
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Hobby's</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suHobbyInfo[$i]["sued_hobby_name"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->
														<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editHobby<?= $i + 1 ?>" onclick="('editHobbyForm<?= $i + 1 ?>')">Edit</button>
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
																		<form class="row" id="editHobbyForm<?= $i + 1 ?>" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
																			<div class="mb-3 mb-4">
																				<label class="form-label" for="courseTitleEdit<?= $i + 1 ?>">Hobby<span class="text-danger">*<span></label>
																				<input type="text" name="courseTitle" value="<?= $suHobbyInfo[$i]["sued_hobby_name"] ?>" id="courseTitleEdit<?= $i + 1 ?>" class="form-control" placeholder="Ex: Photography" required>
																			</div>
																			<input type="hidden" name="suedID" value="<?= $suHobbyInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary btn-sm" name="suHobby" value="edit">Save</button>
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
														<!-- <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editHobby<?= $i + 1 ?>" onclick="('editHobbyForm<?= $i + 1 ?>')">Edit</button> -->
														 <a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>
													</div>
												</div>
										<?php
											}
										}
										?>
									</div>
									<!-- Reference -->
									<div class="tab-pane fade <?= $_GET["tab"] === "reference" ? "show active" : "" ?>" id="reference" role="tabpanel" aria-labelledby="reference-tab">
										<?php
										$sql = "SELECT * FROM `student_university_reference_details` WHERE sued_student_university_id = $suID;";
										$student = $conn->query($sql);
										$suReferenceInfo = $student->fetch_all(MYSQLI_ASSOC);
										rsort($suReferenceInfo, 1);

										if (!$suReferenceInfo) {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<div id="tooltip">
														<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Ensure to provide accurate and authentic details of individuals who are willing to refer you in their company or industry. Avoid using false information for references.">
															<i class="fa bala">&#xf0eb;</i>
														</button>
													</div>
												</div>
											</div>
											<!-- No reference -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Add your reference now!</h1>
													<p class="lead mt-4"></p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReference">Create now!</button>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addReference">Add new</button>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
														<div id="tooltip">
															<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Ensure to provide accurate and authentic details of individuals who are willing to refer you in their company or industry. Avoid using false information for references.">
																<i class="fa bala">&#xf0eb;</i>
															</button>
														</div>
													</div>
												</div>
											</div>
											<?php
											for ($i = 0; $i < count($suReferenceInfo); $i++) {
											?>
												<!-- Reference -->
												<div class="card-body border-top border-primary mt-1">
													<div class="row">
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Your Reference Link</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suReferenceInfo[$i]["sued_reference"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit reference -->
														<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editReference<?= $i + 1 ?>" onclick="('editReferenceForm<?= $i + 1 ?>')">Edit</button>
														<!-- Edit reference modal -->
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
																				<label for="referenceDescEdit<?= $i + 1 ?>" class="form-label">Reference <span class="text-danger">*</span></label>
																				<input type="url" class="form-control" name="referenceDesc" id="referenceDescEdit<?= $i + 1 ?>" placeholder="Enter the URL" value="<?= $suReferenceInfo[$i]["sued_reference"] ?>" maxlength="100">
																			</div>
																			<input type="hidden" name="suedID" value="<?= $suReferenceInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																				<button type="submit" class="btn btn-primary btn-sm" name="suReference" value="edit">Save</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
														<!-- Delete Reference -->
														<?php $suedID = $suReferenceInfo[$i]["sued_id"]; ?>
														<?php
														if (isset($_GET['delete_ep'])) {
															$delete = $_GET['delete_ep'];
															$delep = $conn->query("DELETE FROM student_university_reference_details WHERE sued_id = '$delete'");
															if ($delep) {
																echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
															} else {
																echo "<script>alert('Delete reference is not successful.'); location.href = '$_SERVER[HTTP_REFERER]';</script>";
															}
														}
														?>
														<a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Reference" onclick="return deleteReference()">Delete</a>
													</div>
												</div>
										<?php
											}
										}
										?>
									</div>
									<!-- reference end -->

									<div class="tab-pane fade <?= $_GET["tab"] === "language" ? "show active" : "" ?>" id="language" role="tabpanel" aria-labelledby="language-tab">
										<?php
										$sql = "SELECT * 
										FROM `student_university_experience_details`           
										WHERE sued_student_university_id = $suID ;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suExperienceInfo = $student->fetch_all(MYSQLI_ASSOC);
										if (!$suExperienceInfo) {
										?>
											<div class="card-body mt-1">
												<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-0 mb-0">
													<div id="tooltip">
														<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Provide specific and concise details about your role, highlighting key responsibilities and achievements. Avoid vague or generic descriptions.">
															<i class="fa bala">&#xf0eb;</i>
														</button>
													</div>
												</div>
											</div>
											<!-- No experience -->
											<div class="card-body">
												<div class="mt-4 mb-4 text-center">
													<h1 class="display-4">Here, add your own Experience now!</h1>
													<p class="lead mt-4"></p>
													<i class="fas fa-arrow-down fa-2x mt-2 mb-4"></i>
													<div class="d-grid gap-2 d-md-block">
														<!-- Button trigger modal -->
														<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addExperience">
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
													<button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addExperience">Add new</i></button>
												</div>
											</div>
											<?php
											for ($i = 0; $i < count($suExperienceInfo); $i++) {
											?>
												<!-- Experience -->
												<div class="card-body border-top border-primary mt-1">
													<span class="fs-6">Job Title's</span>
													<h3 class="mb-4">
														<?= $suExperienceInfo[$i]["sued_language_name"] ?>
													</h3>
													<div class="row">
														<div class="col-md-8 col-12">
															<span class="fs-6">Company Name</span>
															<h5 class="mb-3"><?= $suExperienceInfo[$i]["sued_com_name"] ?></h5>
														</div>

														<div class="col-md-4 col-12">
															<span class="fs-6">Start Date</span>
															<h5 class="mb-3"><?= date_format(date_create($suExperienceInfo[$i]["sued_job_start_date"]), "M-Y") ?></h5>
															<span class="fs-6">End Date</span>
															<?php
															if ($suExperienceInfo[$i]["sued_job_end_date"] == "0000-00-00") {
																echo	  '<h5 class="mb-3"> Current </h5>';
															} else {
															?>
																<h5 class="mb-3"><?= date_format(date_create($suExperienceInfo[$i]["sued_job_end_date"]), "M-Y") ?></h5>
															<?php } ?>
														</div>
														<div class="col-md-12 col-12 mt-3">
															<span class="fs-6">Your Description</span>
															<p class="h5 text-dark" style="text-align: justify; text-justify: inter-word;">
																<?= $suExperienceInfo[$i]["sued_job_description"] ?>
															</p>
														</div>
													</div>
													<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
														<!-- Edit experience -->
														<!-- Edit experience modal -->
														<div class="modal fade" id="editExperience<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="editExperienceLabel<?= $i + 1 ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title h4" id="editExperienceLabel<?= $i + 1 ?>">EDIT Experience</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
																			<span aria-hidden="true"></span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form class="row" id="editExperienceForm<?= $i + 1 ?>" action="function/student-profile.php" method="post" enctype="multipart/form-data">
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="courseEdit<?= $i + 1 ?>">JobTitle<span class="text-danger">*<span></label>
																				<input type="text" name="course" value="<?= $suExperienceInfo[$i]["sued_language_name"] ?>" id="courseEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>
																			<div class="mb-3 col-12 col-md-12">
																				<label class="form-label" for="comEdit<?= $i + 1 ?>">Company name<span class="text-danger">*<span></label>
																				<input type="text" name="com" value="<?= $suExperienceInfo[$i]["sued_com_name"] ?>" id="comEdit<?= $i + 1 ?>" class="form-control" placeholder="Job Title" required>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="startdateEdit<?= $i + 1 ?>">Start Date <span class="text-danger">*<span></label>
																				<input type="date" name="startdate" value="<?= $suExperienceInfo[$i]["sued_job_start_date"] ?>" id="startdateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" required>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																				<label class="form-label" for="enddateEditEX<?= $i + 1 ?>">End Date <span class="text-danger">*<span></label>
																				<input type="date" name="enddate" value="<?= $suExperienceInfo[$i]["sued_job_end_date"] ?>" id="enddateEdit<?= $i + 1 ?>" class="form-control" placeholder="Select date" required>
																				<div class="form-check mt-2">
																					<input type="checkbox" name="comStatus" value="Current" id="comStatusEdit<?= $i + 1 ?>" class="form-check-input" <?= $suExperienceInfo[$i]["sued_com_status"] == "Current" ? "checked" : "" ?> onchange="enddateDisable(this.checked, this.id,document.getElementById('endDateEditEX<?= $i + 1 ?>') ,<?= $i + 1 ?>)">
																					<label class="form-check-label" for="comStatusEdit<?= $i + 1 ?>">Present</label>
																				</div>
																			</div>
																			<div class="mb-3 col-12 col-md-6">
																			</div>
																			<div class="mb-3 mb-4">
																				<label for="descEdit<?= $i + 1 ?>" class="form-label">Experience Description <span class="text-danger">*<span></label>
																				<textarea class="form-control" name="desc" id="descEdit<?= $i + 1 ?>" placeholder="Write your experience here " rows="5" maxlength="10"><?= $suExperienceInfo[$i]["sued_job_description"] ?></textarea>
																				<script>
																					ClassicEditor
																						.create(document.querySelector('#descEdit<?= $i + 1 ?>'), {})
																						.then(editor => {
																							window.editor = editor;
																						})
																						.catch(err => {
																							console.error(err.stack);
																						});
																				</script>
																			</div>
																	</div>
																	<div class="mb-3 col-12 col-md-6">
																	</div>
																	<input type="hidden" name="suedID" value="<?= $suExperienceInfo[$i]["sued_id"] ?>" id="suedID" class="form-control">
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
																		<button type="submit" class="btn btn-primary btn-sm" name="suExperience" value="edit">Save</button>
																	</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
													<!-- Delete Education -->
													<?php $suedID = $suExperienceInfo[$i]["sued_id"]; ?>
													<?php
													if (isset($_GET['delete_ep'])) {
														$delete = $_GET['delete_ep'];
														$delep = $conn->query("DELETE FROM student_university_experience_details where sued_id = '$delete'");
														if ($delep) {
															echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
														} else {
															echo "<script>alert('Delete course is not successful.');
								                  location.href = '$_SERVER[HTTP_REFERER]';</script>";
														}
													}
													?>
													<button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#editExperience<?= $i + 1 ?>" onclick="('editExperienceForm<?= $i + 1 ?>')">Edit</button>
													 <a class="btn btn-outline-danger btn-sm" type="button" href="student-manage-portfolio.php?delete_ep=<?php echo $suedID; ?>" title="Delete Course" onclick="return deletecourse()">Delete</a>
												</div>
										<?php
											}
										}
										?>
									</div>
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
													<label class="form-label" for="jobTitle">Job Role <span class="text-danger">*<span></label>
													<input type="text" name="jobTitle" id="jobTitle" class="form-control" placeholder="Ex: Full-Stack Developer" required>
												</div>
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="compName">Company Name <span class="text-danger">*<span></label>
													<input type="text" name="compName" id="compName" class="form-control" placeholder="Ex: Google" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
													<input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
													<input type="date" name="endDate" id="endDateAdd" class="form-control" placeholder="Select date" disabled required>
													<div class="form-check mt-2">
														<input type="checkbox" name="jobStatus" value="Current" id="jobStatusAdd" class="form-check-input" checked onchange="endDateDisable(this.checked, 'jobStatusAdd',document.getElementById('endDateAdd'), 0)">
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

												<div class="mb-3 mb-4">
													<label for="addExpDesc" class="form-label">Experience Description <span class="text-danger">*<span></label>
													<textarea class="form-control" name="expDesc" id="addExpDesc" placeholder="Write your experience here " rows="5" maxlength="150"></textarea>
													<span class="pull-right label label-default" id="count_message"></span>
													<small>
														Please describe your experience, responsibility, and any related projects that you've done.
													</small>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary btn-sm" name="suExp" value="add">Submit</button>
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
														<input type="text" name="skillTitle[]" id="skillTitle" class="form-control" placeholder="Skills Name Ex: Python" required>
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
															<input type="text" name="certProvider[]" id="certProvider0" class="form-control" placeholder="Provider name Ex: linkedin, Udemy">
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
													<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary btn-sm" name="addSkill">Submit</button>
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
											<h5 class="modal-title h4" id="addEduLabel">Add education Details</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addEduForm" action="function/student-portfolio.php" method="post" enctype="multipart/form-data">
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="courseTitle">Field Of Study<span class="text-danger">*<span></label>
													<input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="College Name" required>
												</div>
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="collegeName">School / College name <span class="text-danger">*<span></label>
													<input type="text" name="collegeName" id="collegeName" class="form-control" placeholder="course Title" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="startDate">Start Date <span class="text-danger">*<span></label>
													<input type="date" name="startDate" id="startDate" class="form-control" placeholder="Select date" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="endDateAdd">End Date <span class="text-danger">*</span></label>
													<input type="date" name="endDate" id="endDateAddedu" class="form-control" placeholder="Select date" required>
													<div class="form-check mt-2">
														<input type="checkbox" name="courseStatus" value="" id="jobStatusAdd" class="form-check-input" onchange="endDateDisable(this.checked, 'jobStatusAdd',document.getElementById('endDateAddedu'), 0)">
														<label class="form-check-label" for="jobStatusAdd">Present</label>
													</div>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<!-- <div class="mb-3 mb-4">
													<label for="addEduDesc" class="form-label">Education Percentage <span class="text-danger">*<span></label>
													<textarea class="form-control" name="eduDesc" id="addEduDesc" placeholder="eg:10/10 ,eg:9.0/10" rows="5" maxlength="10"></textarea>
													<script>
														ClassicEditor
															.create(document.querySelector('#addeduDesc'), {})
															.then(editor => {
																window.editor = editor;
															})
															.catch(err => {
																console.error(err.stack);
															});
													</script>
												</div> -->
												<div class="mb-3 mb-4">
													<label for="addEduDesc" class="form-label">Description <span class="text-danger">*</span></label>
													<textarea class="form-control" name="eduDesc" id="addEduDesc" placeholder="Write your experience here" rows="5" maxlength="200" oninput="updateCharacterCount(this)"></textarea>
													<div id="characterCount" class="form-text"></div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary btn-sm" name="suEdu" value="add">Submit</button>
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
													<input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="Ex: Photography" required>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary btn-sm" name="suHobby" value="add">Submit</button>
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
												<div class="mb-3 mb-4">
													<label for="addReferenceDesc" class="form-label">Reference <span class="text-danger">*</span></label>
													<input type="url" name="referenceDesc" id="addReferenceDesc" class="form-control" placeholder="https://in.linkedin.com/in/yourname" pattern="https://.*" required>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary btn-sm" name="suReference" value="add">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- reference end -->
							<div class="modal fade" id="addExperience" tabindex="-1" role="dialog" aria-labelledby="addExperienceLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title h4" id="addExperienceLabel">Add Experience</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clickReset();">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<!-- Form -->
											<form class="row" id="addExperienceForm" action="function/student-profile.php" method="post" enctype="multipart/form-data">
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="course">Job Title<span class="text-danger">*<span></label>
													<input type="text" name="course" id="course" class="form-control" placeholder="Full-Stack Engineer" required>
												</div>
												<div class="mb-3 col-12 col-md-12">
													<label class="form-label" for="courseTitle">Company Name<span class="text-danger">*<span></label>
													<input type="text" name="com" id="com" class="form-control" placeholder="Google" required>
												</div>
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="startdate">Start Date <span class="text-danger">*<span></label>
													<input type="date" name="startdate" id="startdate" class="form-control" placeholder="Select date" required>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="enddate">End Date <span class="text-danger">*<span></label>
													<input type="date" name="enddate" id="enddateAdd" class="form-control" placeholder="Select date" required>
												</div> -->
												<div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="endDate">End Date <span class="text-danger">*<span></label>
													<input type="date" name="endDate" id="endDateAdd1" class="form-control" placeholder="Select date" disabled required>
													<div class="form-check mt-2">
														<input type="checkbox" name="jobStatus" value="Current" id="jobStatusAdd" class="form-check-input" checked onchange="endDateDisable(this.checked, 'jobStatusAdd',document.getElementById('endDateAdd1'), 0)">
														<label class="form-check-label" for="jobStatus">Present</label>
													</div>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="mb-3 mb-4">
													<label for="addExperiencedesc" class="form-label">Experience Description <span class="text-danger">*<span></label>
													<textarea class="form-control" name="desc" id="addExperiencedesc" placeholder="Enter your description" rows="5" maxlength="200"></textarea>
													<script>
														ClassicEditor
															.create(document.querySelector('#adddesc'), {})
															.then(editor => {
																window.editor = editor;
															})
															.catch(err => {
																console.error(err.stack);
															});
													</script>
												</div>
												<!-- <div class="mb-3 col-12 col-md-6">
													<label class="form-label" for="zipCode">Zip/Postal Code</label>
													<input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip" maxlength="5">
												</div> -->
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clickReset()">Close</button>
													<button type="submit" class="btn btn-primary" name="suExperience" value="add">Submit</button>
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
	</div>
	<!-- Footer -->
	<?php
	include('pages-footer.php');
	?>
	<script src="js/student-portfolio.js"></script>
	<!-- Scripts -->
	<!-- Theme JS -->
	<script src="../assets/js/theme.min.js"></script>
	<!-- Country, State, City JS -->
	<script src="js/region.js"></script>
	<!-- Student Portfolio JS -->
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
</body>

</html>