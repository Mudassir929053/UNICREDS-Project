<?php
include 'function.php';
?>

<!DOCTYPE html>

<html lang="en">

<?php 
include 'main/pages-head.php';
?>
<style>
	/* Default style with no padding */ 
	#slider {
		padding: 0;
	}

	/* Media query for screens wider than 800px */
	@media (min-width: 800px) {
		#slider {
			padding: 0 100px;
		}

		#chevron {
			background-color: #FFFFFF;
			padding: 10px;
			border-radius: 50px;
			color: #777777;
			font-size: 3em;
		}
	}

	#chevron:hover {
		background-color: #6600FF;
   
	}
</style>

<body style="background-color:#FFFFFF;">
	<!-- Navbar  -->
	<?php
	include 'main/pages-header.php';
	?>
	<link rel="stylesheet" href="assets/css/theme.min.slider.css">
	<title>UNICREDS</title>
	<div class="py-md-6 py-6">
		<div class="container-fluid" style="background-image: url(./assets/images/background/Group1752.png);background-repeat: no-repeat;background-size:100% 85%;">
			<!-- Hero Section -->
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-12 mt-5">
					<div class="text-left offset-lg-2">
						<!-- Caption -->
						<h1 class="mt-5 fw-bold warning" style="color:#107575; font-size: 60px;">Empowering Your Career Journey</h1>
						<!-- <h1 class="display-3 mb-3 fw-bold" style="color:#1F618D">Online is now much easier</h1> -->
						<p class="mb-4 lead text-black" style="font-size: 30px;color: #000000;">
							Unlock your potential with our employability platform and connect with employers to buid your career.
						</p>
						<a href="./registerselection.php" class="btn text-white" style="border-radius: 30px;background-color: #107575; padding: 10px 50px 10px 50px; border:1px solid #107575;">Register </a>
					</div>
				</div>
				<!-- <div class="offset-xl-2 col-xl-4 col-lg-6 col-md-6"> -->
				<!-- Img -->
				<div class=" col-xl-6 col-lg-6 col-md-12 text-lg-end px-12">
					<img src="assets/images/background/pics.png" alt="" class="img-fluid mw-md-100 mb-4" width="950">
				</div>
				<!-- </div> -->
			</div>
			<div class=" col-xl-12 col-lg-12 col-md-12">
				<div class="col-lg-12 col-md-12 col-12 text-center">
					<!-- caption -->
					<span class="mb-3 mt-5 d-block fw-semi-bold display-6" style="color: #154746;font-size: 20px;">OUR FOCUSED</span>
					<h2 class="mb-4" style="color: #000000;font-size: 42px;">Elevate Graduates' Employability Potential</h2>
					<div class="mb-5 col-12 display-6" style="color: #000000;font-size: 20px;">Assist in the development And enhancement of job-specific training and skill-building <br>programs that align with industry best practices and market demands.</div>
				</div>
			</div>
			<!-- <div class="px-4 px-lg-9"> -->
			<div class="container-fluid mt-5">
				<div class="row mb-8 justify-content-center">
					<div class="card col-lg-2 mr-md-5 col-md-5 mb-4 shadow-lg">
						<!-- Card body -->
						<div class="card-body text-center">
							<div class="mb-4">
								<div class="mb-3">
									<!-- Img -->
									<img src="assets/images/icon/Group144.png" alt="" class="d-inline-block align-top" width="100" height="100">
								</div>
								<!-- Content -->
							</div>
							<div class="w-100 p-3 display-6" style="color: #000000;font-size:x-large;">Stay up-to-date with industry trends and market demands.</div>
						</div>
					</div>
					<div class="card col-lg-2 mr-md-5 col-md-5 mb-4 shadow-lg">
						<!-- Card body -->
						<div class="card-body text-center">
							<div class="mb-4">
								<div class="mb-3">
									<!-- Img -->
									<img src="assets/images/icon/Group145.png" alt="" class="d-inline-block align-top" width="100" height="100">
								</div>
								<!-- Content -->
							</div>
							<div class="font-weight-bold w-100 p-3 display-6" style="color: #000000;font-size:x-large;">Collaborate with industry experts.</div>
						</div>
					</div>
					<div class="card col-lg-2 mr-md-5 col-md-5 mb-4 shadow-lg">
						<!-- Card body -->
						<div class="card-body text-center">
							<div class="mb-4">
								<div class="mb-3">
									<!-- Img -->
									<img src="assets/images/icon/Group146.png" alt="" class="d-inline-block align-top" width="100" height="100">
								</div>
								<!-- Content -->
							</div>
							<div class="font-weight-bold w-100 p-3 display-6" style="color: #000000;font-size:x-large;">Tailored programs for specific industries and job roles.</div>
						</div>
					</div>
					<div class="card col-lg-2 mr-md-5 col-md-5 mb-4 shadow-lg">
						<!-- Card body -->
						<div class="card-body text-center">
							<div class="mb-4">
								<div class="mb-3">
									<!-- Img -->
									<img src="assets/images/icon/Group147.png" alt="" class="d-inline-block align-top" width="100" height="100">
								</div>
								<!-- Content -->
							</div>
							<div class="font-weight-bold w-100 p-3 display-6" style="color: #000000;font-size:x-large;">Smart Matching Technology</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	</div>




	<!-- Section 101 -->
	<div class="py-4 py-lg-9">
		<div class="container-fluid">
			<div class="row mb-8" data-aos="fade-up" data-aos-duration="5000" style="color: #000000;">
				<div class="col-xl-6 col-lg-6 col-md-12 text-lg-start">
					<img src="assets/images/background/Group169.png" alt="" class="img-fluid mw-md-100" style="width:800px;">
				</div>
				<div class=" col-xl-5 col-lg-5 col-md-12">
					<div class="display-3 mb-5">Graduates & job seeker</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group155.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Secure the best Internship opportunities and gain real industries and valuable hands-on experience.</p>
						</div>
					</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group154.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Explore diverse graduate jobs and climb the career ladder.</p>
						</div>
					</div>
					<div class="row mb-3 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group153.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Build an impressive portfolio while studying to showcase growth and skills to future employers.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="text-center my-4 custom-shadow" style="width: 80%; margin: 0 auto;">
								<a href="#" class="btn text-white shadow-lg" style="border-radius: 30px;background-color: #107575; padding: 10px 80px 10px 80px; border:1px solid #107575;font-size: larger;">Learn More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--END Section 101 -->


	<!-- Section 102 -->
	<div class="py-lg-9" style="background:#FFE5A4;">
		<div class="container-fluid">
			<div class="row mb-8" data-aos="fade-up" data-aos-duration="5000" style="color: #000000;">
				<div class="offset-md-1 col-xl-5 col-lg-5 col-md-12">
					<div class="display-3 mb-5">Companies & Industries</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group158.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Recruit verified, high-quality candidates.</p>
						</div>
					</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group159.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Optimize the hiring process for effeciency.</p>
						</div>
					</div>
					<div class="row mb-3 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group160.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">offer employment opportunity for recent graduates.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="text-center my-4 custom-shadow" style="width: 80%; margin: 0 auto;">
								<a href="#" class="btn text-white shadow-lg" style="border-radius: 30px;background-color: #107575; padding: 10px 80px 10px 80px; border:1px solid #107575;font-size: larger;">Learn More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 text-lg-center">
					<img src="assets/images/background/Company1.png" alt="" class="img-fluid mw-md-100" style="width: 650px;height: 550px;">
				</div>
			</div>
		</div>
	</div>
	<!--END Section 102 -->


	<!-- Section 103 -->
	<div class="py-4 py-lg-9">
		<div class="container-fluid">
			<div class="row mb-8" data-aos="fade-up" data-aos-duration="5000" style="color: #000000;">
				<div class="col-xl-6 col-lg-6 col-md-12 text-lg-end">
					<img src="assets/images/background/Group167.png" alt="" class="img-fluid mw-md-100" style="margin-right: 250px;">
				</div>
				<div class=" col-xl-5 col-lg-5 col-md-12">
					<div class="display-3 mb-5">Institutions</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group163.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Provide career services and resources to enhance graduates' employability skills and readiness for the job market.</p>
						</div>
					</div>
					<div class="row mb-4 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group164.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Colloborate with employers to provide gradutes with industry exposure and skill-building opportunities.</p>
						</div>
					</div>
					<div class="row mb-3 mt-3 align-items-center">
						<div class="col-auto">
							<img src="assets/images/icon/Group165.png" alt="" width="80" height="80">
						</div>
						<div class="col">
							<p class="h2">Integrating academic programs with real-world work experience that meet industries' needs.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="text-center my-4 custom-shadow" style="width: 80%; margin: 0 auto;">
								<a href="#" class="btn text-white shadow-lg" style="border-radius: 30px;background-color: #107575; padding: 10px 80px 10px 80px; border:1px solid #107575;font-size: larger;">Learn More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--END Section 103 -->


	<!-- <div class="pt-lg-12 pb-lg-3 pt-8 pb-6"> -->
	<div class="pb-lg-6 pt-lg-3" style="background:#C9F1DD;">
		<div class="container-fluid">
			<div class="row mb-8 mt-8 justify-content-center">
				<div class="col-lg-6 col-md-12 col-12 text-center">
					<h1 class="mb-2 fw-bold display-4">Available Courses </h1>
				</div>
			</div>
			<div class="row mb-8 mt-8 col-12" id=slider>
				<div class="position-relative">
					<ul class="controls" id="sliderFirstControls">
						<li class="prev">
							<i class="fe fe-chevron-left" id=chevron></i>
						</li>
						<li class="next">
							<i class="fe fe-chevron-right" id=chevron></i>
						</li>
					</ul>
					<div class="sliderFirst">

						<?php
						$querycourse = $conn->query("SELECT * FROM course 
											 LEFT JOIN user ON course_created_by = user.user_id
											 LEFT JOIN committee ON committee.committee_user_id = user.user_id
											 LEFT JOIN lecturer ON lecturer.lecturer_user_id = user.user_id
											 LEFT JOIN institution ON institution.institution_user_id = user.user_id
											 LEFT JOIN university ON institution.institution_university_id = university.university_id 
											 LEFT JOIN admin ON admin.admin_user_id = user.user_id  
											 WHERE course_status = 'Published';");

						$num = 1;
						if (mysqli_num_rows($querycourse) > 0) {
							while ($rows = mysqli_fetch_object($querycourse)) {
								$user_id = $rows->user_id;
						?>

								<div class="item">
									<!-- Card -->
									<div class="card mb-4 ml-xl-5 card-hover col-xl-10 col-lg-12">
										<a href="../unicreds/public/course-enroll.php?course_id=<?php echo $rows->course_id; ?>" class="card-img-top">
											<img src="assets/images/course/<?php echo $rows->course_image; ?>" class="card-img-top rounded-top-md" alt="" height="200">
											<!-- Card body -->
											<div class="card-body" style="height: 180px;">
												<div class="row align-items-center">
													<div class="col lh-1">
														<!-- <span class="text-truncate-line-2 fs-4 mb-2 fw-semi-bold d-block text-dark-primary "></span> -->
														<h4 class="mb-2 text-truncate-line-2 fw-semi-bold d-block text-uppercase"><?php echo $rows->course_title; ?></h4>
													</div>

												</div>

												<div class="d-flex justify-content-between align-items-center mt-3">
													<div class="d-flex align-items-center">
														<i class="bi bi-clock fs-4" style="color: #154746;"></i>
														<div class="ms-2">
															<h5 class="mb-0 text-body">Duration</h5>
														</div>
													</div>
													<div class="">
														<div>
															<p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->course_duration; ?></p>
														</div>
													</div>
												</div>


												<div class="d-flex justify-content-between align-items-center mt-1">
													<div class="d-flex align-items-center">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16" style="color: #154746;">
															<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
														</svg>
														<div class="ms-2">
															<h5 class="mb-0 text-body">Cost</h5>
														</div>
													</div>
													<div class="">
														<div>
															<?php if ($rows->course_fee == 'Free' || $rows->course_fee == 'free' || $rows->course_fee == 'FREE') { ?>
																<p class="mb-0 fw-semi-bold" style="color: #2A8A88;"><?php echo $rows->course_fee; ?></p>
															<?php } else { ?>
																<p class="mb-0 fw-semi-bold" style="color: #2A8A88;">RM <?php echo floatval($rows->course_fee / 100); ?></p>
															<?php
															} ?>
														</div>
													</div>
												</div>

												<?php if ($rows->course_level != NULL) {
												?>
													<div class="d-flex justify-content-between align-items-center mt-1">
														<div class="d-flex align-items-center">
															<!-- <i class="bi bi-clock text-info fs-4"></i> -->
															<i class="mdi mdi-school fs-4" style="color: #154746;"></i>
															<div class="ms-2">
																<h5 class="mb-0 text-body"> Level</h5>
															</div>
														</div>
														<div class="">
															<div>
																<?php
																$arr = $rows->course_level;
																$sprt = explode(",", $arr);

																if ($sprt != NULL) {
																	if ($arr != NULL) {
																		if (in_array("1", $sprt)) {
																			echo ' <p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Undergraduate</p>';
																		}

																		if (in_array("2", $sprt)) {
																			echo '<p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Postgraduate</p>';
																		}

																		if (in_array("3", $sprt)) {
																			echo '<p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Continuing and Professional Development</p>';
																		}
																	}
																} else {
																	echo '';
																}
																?>
															</div>
														</div>
													</div>
												<?php } else {
												}
												?>
											</div>
										</a>
										<div class="card-footer">
											<div class="row align-items-center g-0">
												<?php if ($rows->user_role_id == '1') { ?>
													<div class="col-auto">
														<?php

														$sqlProfile = $conn->query("SELECT * FROM institution
																				   LEFT JOIN university ON institution.institution_university_id = university.university_id  
																				   LEFT JOIN admin ON admin.admin_institution = institution.institution_id
																				   WHERE admin_user_id = '$user_id'");

														$checkunicred = mysqli_fetch_object($sqlProfile);

														if ($checkunicred->institution_logo != NULL) {
															$ProfilePic = 'assets/images/avatar/' . $checkunicred->institution_logo;
														} else {
															$ProfilePic = 'assets/images/avatar/university_default.jpg';
														}
														?>
														<!-- <img src="<?php echo $ProfilePic; ?>" class="rounded-circle avatar-xs" alt=""> -->
													</div>
													<div class="col ms-2 text-center">
														<span class="text-dark fw-bold"><?php echo $checkunicred->university_name; ?></span>
													</div>
												<?php } elseif ($rows->user_role_id == '10') { ?>
													<div class="col-auto">
														<?php

														$sqlCommitteeProfile = $conn->query("SELECT * FROM institution
																				LEFT JOIN university ON institution.institution_university_id = university.university_id  
																				LEFT JOIN committee ON committee.committee_institution_id = institution.institution_id
																				WHERE committee_user_id = '$user_id'");

														$checkcommitte = mysqli_fetch_object($sqlCommitteeProfile);

														if ($checkcommitte->institution_logo != NULL) {
															$ProfilePic = 'assets/images/avatar/' . $checkcommitte->institution_logo;
														} else {
															$ProfilePic = 'assets/images/avatar/university_default.jpg';
														}
														?>
														<!-- <img src="<?php echo $ProfilePic; ?>" class="rounded-circle avatar-xs" alt=""> -->
													</div>
													<div class="col ms-2 text-center">
														<span class="text-dark fw-bold"><?php echo $checkcommitte->university_name; ?></span>
													</div>
												<?php } elseif ($rows->user_role_id == '7') { ?>
													<div class="col-auto">
														<?php
														$sqlProfile = $conn->query("SELECT * FROM lecturer WHERE lecturer_user_id = '$user_id'");

														$checklecturerprofile = mysqli_fetch_object($sqlProfile);

														if ($checklecturerprofile->lecturer_profile_picture != NULL) {
															$ProfilePic = 'assets/images/avatar/' . $checklecturerprofile->lecturer_profile_picture;
														} else {
															$ProfilePic = 'assets/images/avatar/avatardefault.png';
														}
														?>
														<!-- <img src="<?php echo $ProfilePic; ?>" class="rounded-circle avatar-xs" alt=""> -->
													</div>
													<div class="col ms-2 text-center">
														<span class="text-dark fw-bold"><?php echo $checklecturerprofile->lecturer_fname; ?> <?php echo $rows->lecturer_lname; ?></span>
													</div>

												<?php } else { ?>

												<?php } ?>


											</div>
										</div>

									</div>

								</div>
							<?php }
						} else {
							?>
							<div class="row mt-8 justify-content-center">
								<div class="col-lg-10 col-md-12 col-12 text-center">
									<h2 class="mb-2 display-4 fw-bold">Sorry, there's no related contents right now.</h2>
								</div>
							</div>
						<?php
						}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>



	<div class="py-8 py-lg-9" style="background-image: url(assets/images/background/Feedback.png);background-repeat: no-repeat;background-size:100% 100%">
		<div class="container-fluid">
			<div class="row mb-8 justify-content-center">
				<div class="col-lg-6 col-md-12 col-12 text-center" style="color: #000000;">
					<!-- caption -->
					<span class="mb-3 d-block text-uppercase fw-semi-bold h3">Testimonials unicreds</span>
					<h2 class="mb-2 display-4 fw-bold ">Client Experiences </h2>
					<p class="lead">12+ people are already learning on Unicreds</p>
				</div>
			</div>
			<div class="row mb-8 mt-8 col-12" id=slider>
				<div class="position-relative">
					<ul class="controls" id="sliderFirstControls">
						<li class="prev">
							<i class="fe fe-chevron-left" id=chevron></i>
						</li>
						<li class="next">
							<i class="fe fe-chevron-right" id=chevron></i>
						</li>
					</ul>
					<div class="sliderFirst">
						<div class="row ml-lg-5">
							<div class="col-md-5 offset-lg-1 col-12 mb-3" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
								<!-- Card -->
								<div class="card shadow-lg">
									<!-- Card body -->
									<div class="card-body p-md-5 text-center" style="color: #000000;">
										<i class="mdi mdi-48px mdi-format-quote-open text-secondary lh-1"></i>
										<p class="lead mt-3" style="line-height: normal;">The generated lorem Ipsum is therefore always free from repetition,
											injected humour, or words etc generate lorem Ipsum which looks racteristic reasonable.</p>
									</div>
									<!-- Card Footer -->
									<div class="card-footer border-top-0 d-flex justify-content-center align-items-center">
										<div class="row">
											<div class="col-auto">
												<img src="assets/images/icon/Ellipse5.png" alt="" width="70" height="70">
											</div>
											<div class="col">
												<p class="h4">Emakit Micheal<br><span class="h5">Software Engineer from Malaysia</span></p>
												<!-- <p class="h5">Software Engineer from Malaysia</p> -->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5 col-12 mb-3" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
								<!-- Card -->
								<div class="card shadow-lg">
									<div class="card-body p-md-5 text-center" style="color: #000000;">
										<i class="mdi mdi-48px mdi-format-quote-open text-secondary lh-1"></i>
										<p class="lead mt-3" style="line-height: normal;">Lorem ipsum dolor sit amet, consectetur adipi scing elit. Sed vel felis
											imperdiet, lacinia metus malesuada diamamus rutrum turpis leo, id tincidunt magna sodales.</p>
									</div>
									<!-- Card Footer -->
									<div class="card-footer border-top-0 d-flex justify-content-center align-items-center">
										<div class="row">
											<div class="col-auto">
												<img src="assets/images/icon/Ellipse5.png" alt="" width="70" height="70">
											</div>
											<div class="col">
												<p class="h4">Emakit Micheal<br><span class="h5">Software Engineer from Malaysia</span></p>
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
	</div>


	<!-- Initialized AOS -->
	<script>
		AOS.init();
	</script>



	<!-- clipboard -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script> -->



	<!-- Theme JS -->
	<script src="assets/js/theme.min.js"></script>
	<!-- Slider -->
	<script>
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 1,
			dots: false,
			nav: true,
			mouseDrag: true,
			autoplay: true,
			// rewind: false,
			animateOut: 'slideOutUp',
			responsive: {
				10: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	</script>


</body>
<?php
include 'main/pages-footer.php';
?>

</html>
