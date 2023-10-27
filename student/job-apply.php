<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
?>

<body>
    <!-- Navbar -->
<?php
    include('pages-topbar.php');

    $jobID = $_GET["job_id"];
    $job = $jobInfo->fetch_job($jobID);

    // Student university job application.
    if(isset($_POST["applyJob"])) {
        if($suInfoRow["su_cv"] !== NULL) {
            $job_apply = array(
                "job_id"    => $_POST["applyJob"], 
                "su_id"     => $suID, 
                "date"      => date("Y-m-d H:i:s", strtotime("now")), 
                "status"    => "Pending", 
                "summary"   => mysqli_real_escape_string($conn, $_POST["summary"]), 
            );

            $insert = $jobInfo->insert_job_application($job_apply);

            if($insert) {
                echo ("<script>location.href = 'student-job-application.php';</script>");
            } else {
                echo "<script>alert('System Error: Insert JSUA.');</script>";
                echo var_dump($job_apply);
            }
        } else {
            echo "<script>alert('Please upload your CV/Resume.');</script>";
        }
    }

    // Check if student university already applied on this job or not.
    $suJob = $jobInfo->fetch_job_applications($suID);
    if($suJob !== NULL) {
        foreach($suJob as $val) {
            if($val["jsua_job_id"] === $jobID) {
                echo ("<script>location.href = '$_SERVER[HTTP_REFERER]';</script>");
            }
        }
    }
?>

    <!-- Page Header -->
    <div class="bg-info py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="mb-4">
                        <h1 class="mb-0 text-white display-4">Apply Job</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-body">
                        <?php
                            if($job["industry_logo"] !== NULL) {
                        ?>
                                <img src="../assets/images/industry/<?= $job["industry_logo"] ?>" class="avatar-xl rounded border bg-white " alt="">
                        <?php
                            } else {
                        ?>
                                <span class="avatar avatar-xl avatar-info">
                                    <span class="avatar-initials rounded fs-2"><?= $job["industry_name"][0].$job["industry_name"][1] ?></span>
                                </span>
                        <?php
                            }
                        ?>
                            <h3 class="mb-0 mt-2 fw-bold"><?= $job["job_title"] ?></h3>
                            <h5 class="mb-0">
                                <a href="job-industry-profile.php?ind_id=<?= $job["industry_id"] ?>"><?= $job["industry_name"] ?></a>
                            </h5>
                            <p class="mt-3 mb-1 fw-medium">
                                <i class="fe fe-map-pin me-1" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>
                                <?= $job["industry_city_id"] !== NULL ? $job["industry_city_id"].", ".$job["state_name"] : '<em class="text-muted fs-4">Not specified</em>' ?>
                            </p>
                            <p class="mb-1 fw-medium">
                                <i class="fe fe-dollar-sign me-1" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>
                                <?= salary($job["job_min_salary"], $job["job_max_salary"]) ?>
                            </p>
                            <p class="mb-1 fw-medium">
                                <i class="fe fe-book me-1" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>
                                <?= $job["job_type"] ?>
                            </p>
                            <p class="mb-0 fw-medium">
                                <i class="fe fe-zoom-in me-1" data-bs-toggle="tooltip" data-placement="top" title="Vacancy"></i>
                                <?= $job["job_no_of_vacancies"]." position" ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="mb-0">Your Portfolio Info</h4>
                        </div>
                        <div class="card-body">
							<div class="d-lg-flex align-items-center justify-content-between pb-3 border-bottom">
								<div class="d-flex align-items-center mb-4 mb-lg-0">
									<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
									<div class="ms-3">
										<h4 class="mb-0"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h4>
										<p class="mb-0">
                                            <?= $suInfoRow["su_email"] ?>
										</p>
										<p class="mb-0">
                                            <?= $suInfoRow["su_contact_no"] !== NULL ? $suInfoRow["su_contact_no"] : "<span class='text-muted'><em>Not available</em></span>" ?>
										</p>
									</div>
								</div>
								<div class="d-flex flex-column">
                            <?php
                                $checkCV = false;

                                if($suInfoRow["su_cv"] !== NULL) {
                                    $checkCV = true;
                                    $suCV = $suInfoRow["su_cv"];
                            ?>
									<!-- Manage CV -->
									<button type="button" class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#manageCVModal">View CV</button>
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
																<button type="button" class="btn btn-danger" id="deleteCV" data-bs-toggle="tooltip" data-placement="top" title="Delete CV" 
																	onclick="if(window.confirm('Are you sure to delete this CV?')) {
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
                            <?php
                                } else {
                            ?>
									<!-- Upload CV -->
									<button type="button" class="btn btn-outline-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#uploadCVModal">Upload CV</button>
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
                            <?php
                                }
                            ?>

                                    <!-- View Experience -->
									<button class="btn btn-outline-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#viewExp">View Experience</button>
                                    <!-- View experience modal -->
                                    <div class="modal fade" id="viewExp" tabindex="-1" role="dialog" aria-labelledby="viewExpTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="viewExpTitle">Experiences List</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <?php
                                                $suExp = $suInfo->fetch_experience();

                                                if($suExp === NULL) {
                                            ?>
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <h2>You didn't have any experience.</h2>
                                                        <p class="fs-3">
                                                            Add your experience in your Portfolio.
                                                        </p>
                                                    </div>
                                            <?php
                                                } else {
                                            ?>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Job Title</th>
                                                                <th scope="col">Company Name</th>
                                                                <th scope="col">Start Date</th>
                                                                <th scope="col">End Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($suExp as $val) {
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?= $i ?></th>
                                                                <td><?= $val["sued_job_title"] ?></td>
                                                                <td><?= $val["sued_company_name"] ?></td>
                                                                <td><?= date_format(date_create($val["sued_start_date"]), "d/m/Y") ?></td>
                                                                <td><?= $val["sued_job_status"] === "Past" ? date_format(date_create($val["sued_end_date"]), "d/m/Y") : "Current" ?></td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                        }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                            <?php
                                                }
                                            ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="student-manage-portfolio.php?tab=exp" class="btn btn-primary">Go to Experience <i class="fe fe-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Skills -->
									<button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewSkill">View Skill Set</button>
                                    <!-- View skills modal -->
                                    <div class="modal fade" id="viewSkill" tabindex="-1" role="dialog" aria-labelledby="viewSkillTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="viewExpTitle">Skills List</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                            <?php
                                                $suSkill = $suInfo->fetch_skill();

                                                if($suSkill === NULL) {
                                            ?>
                                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                                        <h2>You didn't have any skills.</h2>
                                                        <p class="fs-3">
                                                            Add your skill in your Porfolio.
                                                        </p>
                                                    </div>
                                            <?php
                                                } else {
                                            ?>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Skill Name</th>
                                                                <th scope="col">Proficiency</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($suSkill as $val) {
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?= $i ?></th>
                                                                <td><?= $val["skill_name"] ?></td>
                                                                <td><?= $val["sus_skill_level"] ?></td>
                                                            </tr>
                                                    <?php
                                                            $i++;
                                                        }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                            <?php
                                                }
                                            ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="student-manage-portfolio.php?tab=skill" class="btn btn-primary">Go to Skill <i class="fe fe-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="my-4">
                                    <h4>Pitch Yourself</h4>
                                    <p>
                                        Write your personal summary of yourself, achievements, skills, and experiences. It needs to be concise, consistent and clear.
                                    </p>
                                    <textarea class="form-control" name="summary" placeholder="Write your summary here" rows="4" autocomplete="off" required></textarea>
                                </div>
                                <div class="d-grid col-6 mx-auto">
                                    <button class="btn btn-primary <?= $checkCV ? "" : "disabled" ?>" type="submit" name="applyJob" value="<?= $_GET["job_id"] ?>">Send Application</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <!-- Footer -->
<?php
    require_once("pages-footer.php");
?>

    <!-- Script -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>