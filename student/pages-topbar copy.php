<?php
if ($suInfo->fetch_info() !== NULL) {
	$suInfoRow = $suInfo->fetch_info();
} else {
	echo ("<script>window.location.href ='../session-expired.php'</script>");
}
?>

<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-default">
	<div class="container-fluid px-0">
		<!-- Brand logo -->
		<a class="navbar-brand" href="../student/student-home-page.php">
			<img src="../assets/images/brand/logo/logo_unicreds.png" alt="" />
		</a>

		<!-- Mobile view nav wrap -->
		<ul class="navbar-nav navbar-right-wrap ms-auto d-lg-none d-flex nav-top-wrap">
			<li id="cart-topbar" class="dropdown d-inline-block stopevent ">

				<a class="btn btn-warning btn-icon rounded-circle text-light" href="#" role="button" id="dropdownCartSecond" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fe fe-shopping-cart"></i>
				</a>

				<div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownCartSecond">
					<div>
						<div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
							<span class="h5 mb-0">Added Items</span>
						</div>
						<!-- Cart lists -->
						<ul class="list-group list-group-flush scrollbar" style="max-height: 300px;">
						</ul>
						<div class="border-top px-3 pt-3 pb-0">
							<div class="d-flex justify-content-end align-items-center">
								<a role="button" class="btn btn-outline-warning btn-sm" href="cart-item.php">
									Go to My Cart
								</a>
							</div>
						</div>
					</div>
				</div>
			</li>

			<!-- Notifications mobile view -->
			<li class="dropdown stopevent ms-2">
				<a class="btn btn-light btn-icon rounded-circle text-muted indicator indicator-primary" href="#" role="button" data-bs-toggle="dropdown">
					<i class="fe fe-bell"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-end shadow">
					<div>
						<div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
							<span class="h5 mb-0">Notifications</span>
							<a href="# " class="text-muted">
								<span class="align-middle">
									<i class="fe fe-settings me-1"></i>
								</span>
							</a>
						</div>
						<ul class="list-group list-group-flush notification-list-scroll">
							<li class="list-group-item bg-light-warning">
								<div class="row">
									<div class="col">
										<a class="text-body" href="#">
											<div class="d-flex">
												<img src="../assets/images/avatar/avatar-1.jpg" alt="" class="avatar-md rounded-circle" />
												<div class="ms-3">
													<h5 class="fw-bold mb-1">Kristin Watson:</h5>
													<p class="mb-3 text-truncate-line-2">
														Krisitn Watsan like your comment on course
														Javascript Introduction!
													</p>
													<span class="fs-6 text-muted">
														<span>
															2 hours ago,
														</span>
														<span class="ms-1">2:19 PM</span>
													</span>
												</div>
											</div>
										</a>
									</div>
									<div class="col-auto text-center me-2">
										<div>
											<a href="#" class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as read">
												<i class="fe fe-check text-info"></i>
											</a>
										</div>
										<div>
											<a href="#" class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
												<i class="fe fe-x text-danger"></i>
											</a>
										</div>
									</div>
								</div>
							</li>

							<!-- <li class="list-group-item">
								<div class="row">
									<div class="col">
										<a href="#" class="text-body">
											<div class="d-flex">
												<img src="../assets/images/avatar/avatar-2.jpg" alt="" class="avatar-md rounded-circle"/>
												<div class="ms-3">
													<h5 class="fw-bold mb-1">Brooklyn Simmons</h5>
													<p class="mb-3">
														Just launched a new Courses React for Beginner.
													</p>
													<span class="fs-6 text-muted">
														<span>
															<span class="fe fe-thumbs-up text-success me-1"></span>
															Oct 9,
														</span>
														<span class="ms-1">1:20 PM</span>
													</span>
												</div>
											</div>
										</a>
									</div>
									<div class="col-auto text-center me-2">
										<a href="#" class="badge-dot bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as unread"></a>
									</div>
								</div>
							</li>

							<li class="list-group-item">
								<div class="row">
									<div class="col">
										<a href="#" class="text-body">
											<div class="d-flex">
												<img src="../assets/images/avatar/avatar-3.jpg" alt="" class="avatar-md rounded-circle"/>
												<div class="ms-3">
													<h5 class="fw-bold mb-1">Jenny Wilson</h5>
													<p class="mb-3">
														Krisitn Watsan like your comment on course Javascript
														Introduction!
													</p>
													<span class="fs-6 text-muted">
														<span>
															<span class="fe fe-thumbs-up text-info me-1"></span>
															Oct 9,
														</span>
														<span class="ms-1">1:56 PM</span>
													</span>
												</div>
											</div>
										</a>
									</div>
									<div class="col-auto text-center me-2">
										<a href="#" class="badge-dot bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as unread"></a>
									</div>
								</div>
							</li>

							<li class="list-group-item">
								<div class="row">
									<div class="col">
										<a href="#" class="text-body">
											<div class="d-flex">
												<img src="../assets/images/avatar/avatar-4.jpg" alt="" class="avatar-md rounded-circle"/>
												<div class="ms-3">
													<h5 class="fw-bold mb-1">Sina Ray</h5>
													<p class="mb-3">
														You earn new certificate for complete the Javascript
														Beginner course.
													</p>
													<span class="fs-6 text-muted">
														<span>
															<span class="fe fe-award text-warning me-1"></span>
															Oct 9,
														</span>
														<span class="ms-1">1:56 PM</span>
													</span>
												</div>
											</div>
										</a>
									</div>
									<div class="col-auto text-center me-2">
										<a href="#" class="badge-dot bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as unread"></a>
									</div>
								</div>
							</li> -->
						</ul>
						<div class="border-top px-3 pt-3 pb-0">
							<a href="student-announcement.php" class="text-link fw-semi-bold">See all Notifications</a>
						</div>
					</div>
				</div>
			</li>

			<!-- User account mobile view -->
			<li class="dropdown ms-2">
				<a class="rounded-circle" href="#" role="button" data-bs-toggle="dropdown">
					<div class="avatar avatar-md avatar-indicators avatar-online">
						<img alt="avatar" src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" class="rounded-circle" />
					</div>
				</a>
				<div class="dropdown-menu dropdown-menu-end shadow">
					<div class="dropdown-item">
						<div class="d-flex">
							<div class="avatar avatar-md avatar-indicators avatar-online">
								<img alt="avatar" src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" class="rounded-circle" />
							</div>
							<div class="ms-3 lh-1">
								<h5 class="mb-1"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h5>
								<p class="mb-0 text-muted"><?= $suInfoRow["su_email"] ?></p>
							</div>
						</div>
					</div>
					<div class="dropdown-divider"></div>
					<ul class="list-unstyled">
						<li>
							<a class="dropdown-item" href="student-manage-profile.php">
								<i class="fe fe-user me-2"></i>
								Profile
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="student-purchases.php">
								<i class="fe fe-shopping-bag me-2"></i>
								Purchases
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="student-manage-security.php">
								<i class="fe fe-lock me-2"></i>
								Security
							</a>
						</li>
					</ul>
					<div class="dropdown-divider"></div>
					<ul class="list-unstyled">
						<li>
							<a class="dropdown-item" href="../logout.php">
								<i class="fe fe-power me-2"></i>
								Sign Out
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>

		<!-- Button -->
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icon-bar top-bar mt-0"></span>
			<span class="icon-bar middle-bar"></span>
			<span class="icon-bar bottom-bar"></span>
		</button>

		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="navbar-default">
			<ul class="navbar-nav">
				<!-- Catalog dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarCatalog" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Catalog
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarCatalog">
						<li>
							<h4 class="dropdown-header">Catalog</h4>
						</li>
						<li>
							<a href="course-lists.php" class="dropdown-item">
								Courses
							</a>
						</li>
						<li>
							<a href="micro-creds-lists.php" class="dropdown-item">
								Micro-credentials
							</a>
						</li>
						<li>
							<a href="ep-list.php" class="dropdown-item">
								Employability Program
							</a>
						</li>
					</ul>
				</li>

				<!-- Carrer path dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarCareerPath" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Career Path
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarCareerPath">
						<li>
							<h4 class="dropdown-header">Career Path</h4>
						</li>
						<li>
							<a href="student-manage-portfolio.php?tab=exp" class="dropdown-item">
								My Portfolio
							</a>
						</li>
						<li>
							<a href="student-job-application.php" class="dropdown-item">
								Job Application
							</a>
						</li>
						<li class="dropdown-submenu dropend">
							<a href="#" class="dropdown-item dropdown-list-group-item dropdown-toggle">
								Job Hunting
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="job-search.php" class="dropdown-item">
										Search Job
									</a>
								</li>
								<li>
									<a href="job-industry-search.php" class="dropdown-item">
										Company Profiles
									</a>
								</li>
							</ul>
						</li>
						<?php
						$tests = $conn->query("SELECT *
						FROM `assign_test`
						WHERE `at_su_id` = '$suID'
						AND `at_expiry_date` > NOW()
						AND DATE_ADD(`at_created_date`, INTERVAL 24 HOUR) > NOW()
						
						");
						$skill_tests = array();
						$psychometric_tests = array();
						$language_tests = array();

						while ($test = mysqli_fetch_object($tests)) {
							if (!empty($test->at_st_id)) {
								$test_ids = explode(",", $test->at_st_id);
								foreach ($test_ids as $id) {
									if (!in_array($id, $skill_tests)) {
										$skill_tests[] = $id;
									}
								}
							}

							if (!empty($test->at_pt_id)) {
								$test_ids = explode(",", $test->at_pt_id);
								foreach ($test_ids as $id1) {
									if (!in_array($id1, $psychometric_tests)) {
										$psychometric_tests[] = $id1;
									}
								}
							}

							if (!empty($test->at_ltq_id)) {
								$test_ids = explode(",", $test->at_ltq_id);
								foreach ($test_ids as $id2) {
									if (!in_array($id2, $language_tests)) {
										$language_tests[] = $id2;
									}
								}
							}
						}

						$skill_count = count($skill_tests);
						$psychometric_count = count($psychometric_tests);
						$language_count = count($language_tests);

						// Check each skill assessment test ID against studuni_sat_quiz_result table
						if ($skill_count > 0) {
							foreach ($skill_tests as $test_id) {
								$result = $conn->query("SELECT * FROM `studuni_sat_quiz_result` WHERE `susatqrs_sat_quiz_id` = '$test_id' AND `susatqrs_student_university_id` = '$suID'");
								if ($result && mysqli_num_rows($result) > 0) {
									$skill_count--;
								}
							}
						}

						// Check each psychometric test ID against studuni_lt_test_result table
						if ($psychometric_count > 0) {
							foreach ($psychometric_tests as $test_id) {
								$result2 = $conn->query("SELECT * FROM `studuni_pt_test_result` WHERE `supttrs_pt_test_id` = '$test_id' AND `supttrs_student_university_id` = '$suID'");

								if ($result2 && mysqli_num_rows($result2) > 0) {
									$psychometric_count--;
								}
							}
						}



						// Check each language test ID against studuni_lt_test_result table
						if ($language_count > 0) {
							foreach ($language_tests as $test_id) {
								$result1 = $conn->query("SELECT * FROM `studuni_lt_test_result` WHERE `sulttrs_test_id` = '$test_id' AND `sulttrs_student_university_id` = '$suID'");
								if ($result1 && mysqli_num_rows($result1) > 0) {
									$language_count--;
								}
							}
						}


						?>
						<li class="dropdown-submenu dropend">
							<a href="#" class="dropdown-item dropdown-list-group-item">
								Assessment Management <?php if ($skill_count + $psychometric_count + $language_count > 0) { ?><span class="badge bg-danger"><?php echo $skill_count + $psychometric_count + $language_count; ?></span><?php } ?>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="skill-assessment-test.php" class="dropdown-item">
										Skill Assessment Test <?php if ($skill_count > 0) { ?><span class="badge bg-danger"><?php echo $skill_count; ?></span><?php } ?>
									</a>
								</li>
								<li>
									<a href="student-psychometric-test.php" class="dropdown-item">
										Psychometric Test <?php if ($psychometric_count > 0) { ?><span class="badge bg-danger"><?php echo $psychometric_count; ?></span><?php } ?>
									</a>
								</li>
								<li>
									<a href="language-test.php" class="dropdown-item">
										Language Test <?php if ($language_count > 0) { ?><span class="badge bg-danger"><?php echo $language_count; ?></span><?php } ?>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- Account -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarAccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Account
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarAccount">
						<li>
							<h4 class="dropdown-header">Account</h4>
						</li>
						<li class="dropdown-submenu dropend">
							<a href="#" class="dropdown-item dropdown-list-group-item dropdown-toggle">
								My Enrollment
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="student-manage-enrollment.php?tab=course" class="dropdown-item">
										Course
									</a>
								</li>
								<li>
									<a href="student-manage-enrollment.php?tab=mc" class="dropdown-item">
										Micro-credential
									</a>
								</li>
								<li>
									<a href="student-manage-enrollment.php?tab=ep" class="dropdown-item">
										Employability Program
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="document_manager.php" class="dropdown-item">
								Documents
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-item">
								Badge
							</a>
						</li>
					</ul>
				</li>
			</ul>

			<!-- Search bar -->
			<form id="searchBox" action="search-results.php" method="post" enctype="multipart/form-data" class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center">
				<span class="position-absolute ps-3 search-icon">
					<i class="fe fe-search"></i>
				</span>
				<input type="search" class="form-control ps-6" name="query" placeholder="Search Catalog" autocomplete="off">
				<!-- Search results -->
				<!-- class property: `invisible - visible`, `opacity: 0 - opacity: 1` -->
				<div id="search-result" class="dropdown-menu dropdown-menu-lg mw-50 invisible" style="opacity: 0;">
					<h6 class="dropdown-header text-primary">Matched</h6>
					<div class="scrollbar" style="max-height: 300px;">
						<ul id="matched-result" class="list-group overflow-auto list-group-flush">
							<!-- contents here -->
						</ul>
					</div>
					<!-- <h6 class="dropdown-header text-primary mt-3">Relevant</h6>
					<div class="scrollbar" style="max-height: 300px;">
						<ul id="relevant-result" class="list-group overflow-auto list-group-flush">

						</ul>
					</div> -->
				</div>
			</form>

			<!-- Desktop view -->
			<ul class="navbar-nav navbar-right-wrap ms-auto d-none d-lg-block">
				<!-- Cart desktop view -->
				<li id="cart-topbar" class="dropdown d-inline-block stopevent ">

					<a class="btn btn-warning btn-icon rounded-circle text-light" href="#" role="button" id="dropdownCartSecond" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fe fe-shopping-cart"></i>
					</a>

					<div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownCartSecond">
						<div>
							<div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
								<span class="h5 mb-0">Added Items</span>
							</div>
							<!-- Cart lists -->
							<ul class="list-group list-group-flush scrollbar" style="max-height: 300px;">
							</ul>
							<div class="border-top px-3 pt-3 pb-0">
								<div class="d-flex justify-content-end align-items-center">
									<a role="button" class="btn btn-outline-warning btn-sm" href="cart-item.php">
										Go to My Cart
									</a>
								</div>
							</div>
						</div>
					</div>
				</li>

				<!-- Announcements desktop view -->
				<li class="dropdown d-inline-block stopevent ms-2">
					<a class="btn btn-primary btn-icon rounded-circle text-white" href="#" role="button" id="dropdownNotificationSecond" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fe fe-bell"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotificationSecond">
						<div>
							<div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
								<span class="h5 fw-medium text-dark mb-0">Announcements</span>
							</div>
							<?php
							$ann_list = $annInfo->fetch_announcements();

							if ($ann_list !== NULL) {
							?>
								<!-- Announcements lists -->
								<ul class="list-group list-group-flush notification-list-scroll ">
									<?php
									$i = 0;
									foreach ($ann_list as $val) {
										// Limit to 9 list of announcements.
										if ($i > 9) {
											break;
										}
									?>
										<li class="list-group-item bg-light">
											<div class="row">
												<div class="col">
													<div class="text-body" href="#">
														<div class="d-flex">
															<img src="<?= $val["sender_image"] ?>" alt="" class="avatar-md rounded-circle" />
															<div class="ms-3">
																<small class="fw-medium text-muted"><?= $val["sender"] ?></small>
																<h5 class="fw-bold mb-1"><?= $val["sender_name"] ?>:</h5>
																<div class="mb-3 text-truncate-line-2">
																	<?= $val["message"] ?>
																</div>
																<span class="fs-6 text-muted">
																	<?= date_format(date_create($val["created_date"]), "g:i a, d F Y") ?>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
									<?php
										$i++;
									}
									?>
								</ul>
							<?php
							} else {
							?>
								<div class="d-flex justify-content-center align-items-center my-4 p-3">
									<h3 class="mb-0 text-center">Currently there's no announcement intended for you.</h3>
								</div>
							<?php
							}
							?>
							<div class="border-top px-3 pt-3 pb-0">
								<a href="student-announcement.php" class="text-link fw-semi-bold">See all Announcements</a>
							</div>
						</div>
					</div>
				</li>

				<!-- User account desktop view -->
				<li class="dropdown ms-2 d-inline-block">
					<a class="rounded-circle" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
						<div class="avatar avatar-md avatar-indicators avatar-online">
							<img alt="avatar" src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" class="rounded-circle" />
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<div class="dropdown-item">
							<div class="d-flex">
								<div class="avatar avatar-md avatar-indicators avatar-online">
									<img alt="avatar" src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" class="rounded-circle" />
								</div>
								<div class="ms-3 lh-1">
									<h5 class="mb-1"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h5>
									<p class="mb-0 text-muted"><?= $suInfoRow["su_email"] ?></p>
								</div>
							</div>
						</div>
						<div class="dropdown-divider"></div>
						<ul class="list-unstyled">
							<li>
								<a class="dropdown-item" href="student-manage-profile.php">
									<i class="fe fe-user me-2"></i>
									Profile
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="student-purchases.php">
									<i class="fe fe-shopping-bag me-2"></i>
									Purchases
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="student-manage-security.php">
									<i class="fe fe-lock me-2"></i>
									Security
								</a>
							</li>
						</ul>
						<div class="dropdown-divider"></div>
						<ul class="list-unstyled">
							<li>
								<a class="dropdown-item" href="../logout.php">
									<i class="fe fe-power me-2"></i>
									Sign Out
								</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Search JS -->
<script src="js/search.js"></script>
<!-- Cart JS -->
<script>
	$("li#cart-topbar > a").on("mouseover", function() {
		$.ajax({
			url: "function/payment.php",
			type: "POST",
			data: {
				cartLists: ""
			},
			dataType: "",
			beforeSend: function() {
				// do something...
			},
			success: function(data) {
				$("li#cart-topbar").find("ul.scrollbar").html(data);
			},
			error: function(request, status, error) {
				alert(request.responseText);
				alert(error.message);
			},
			complete: function() {
				// do something...
			}
		});
	});
</script>