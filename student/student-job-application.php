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

    $suJob = $jobInfo->fetch_job_applications($suID);

    // Withdraw/Delete the job application.
    if(isset($_POST["withdrawJobApp"])) {
        $jsua_id = $_POST["withdrawJobApp"];

        $jsua_update = $jobInfo->update_job_application($jsua_id);

        if($jsua_update) {
            echo "<script>alert('Withdrawal Successful!');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        } else {
            echo "<script>alert('System Error: Update JSUA.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    } else if(isset($_POST["deleteJobApp"])) {
        $jsua_id = $_POST["deleteJobApp"];

        $jsua_delete = $jobInfo->delete_job_application($jsua_id);

        if($jsua_delete) {
            echo "<script>alert('Delete Successful!');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        } else {
            echo "<script>alert('System Error: Delete JSUA.');location.href = '$_SERVER[HTTP_REFERER]';</script>";
        }
    }
?>

	<!-- Page Content -->
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
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="card">
                        <!-- Card header  -->
                        <div class="card-header">
                            <h3 class="mb-1">Job Application</h3>
                            <p class="mb-0">Manage your job applications here.</p>
                        </div>
                <?php
                    if($suJob !== NULL) {
                ?>
                        <!-- Table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0">
                                <thead class="table-info">
                                    <tr>
                                        <th>Job Info</th>
                                        <th class="text-center">Company</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Job application lists -->
                            <?php
                                foreach($suJob as $val) {
                                    switch($val["jsua_status"]) {
                                        case "Pending":
                                            $badge = "bg-warning";
                                            break;
                                        case "KIV":
                                            $badge = "bg-info";
                                            break;
                                        case "Success":
                                            $badge = "bg-success";
                                            break;
                                        case "Rejected":
                                            $badge = "bg-danger";
                                            break;
                                        case "Withdraw":
                                            $badge = "bg-secondary";
                                            break;
                                        case "Invite for interview":
                                        $badge = "bg-primary";
                                        break;
                                        // case "KIV":
                                        // $badge = "bg-primary";
                                        // break;
                                    }
                            ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column">
                                                <h5>
                                                    <a href="job-details.php?job_id=<?= $val["job_id"] ?>" class="text-inherit"><?= $val["job_title"] ?></a>
                                                </h5>
                                                <div>
                                                    <p class="mb-1 fw-medium fs-6">
                                                        <i class="fe fe-map-pin me-1" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>
                                                        <?= $val["industry_city_id"] !== NULL ? $val["industry_city_id"].", ".$val["state_name"] : '<em class="text-muted fs-4">Not specified</em>' ?>
                                                    </p>
                                                    <p class="mb-1 fw-medium fs-6">
                                                        <i class="fe fe-dollar-sign me-1" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>
                                                        <?= salary($val["job_min_salary"], $val["job_max_salary"]) ?>
                                                    </p>
                                                    <p class="mb-1 fw-medium fs-6">
                                                        <i class="fe fe-book me-1" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>
                                                        <?= $val["job_type"] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-wrap">
                                            <h5 class="mb-0">
                                                <a href="job-industry-profile.php?ind_id=<?= $val["industry_id"] ?>" class="text-inherit"><?= $val["industry_name"] ?></a>
                                            </h5>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= date_format(date_create($val["jsua_application_date"]), "j F Y, g:i a") ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge <?= $badge ?>"><?= $val["jsua_status"] ?></span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="dropdown dropstart">
                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownNine" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe fe-more-vertical" ></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownNine">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <button type="submit" name="withdrawJobApp" value="<?= $val["jsua_id"] ?>" class="dropdown-item <?= $val["jsua_status"] !== "Pending" ? "disabled" : "" ?>">
                                                            <i class="fe fe-corner-up-left me-2"></i>Withdraw
                                                        </button>
                                                    </form>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <button type="submit" name="deleteJobApp" value="<?= $val["jsua_id"] ?>" class="dropdown-item <?= (($val["jsua_status"] === "Rejected") || ($val["jsua_status"] === "Withdraw")) ? "" : "disabled" ?>">
                                                            <i class="fe fe-trash me-2"></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                                </tbody>
                            </table>
                        </div>
                <?php
                    } else {
                ?>
                        <!-- No job application -->
                        <div class="d-flex mt-4 mb-3 justify-content-center">
                            <div class="col-lg-8 col-md-12 col-12 text-center">
                                <h2 class="mb-2 display-5 fw-bold">Oops! You didn't apply to any companies.</h2>
                                <p class="lead text-dark">
                                    Search your desired <a href="job-search.php" class="text-inherit">career now!</a>
                                </p>
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
	
	<!-- Footer -->
<?php
	include('pages-footer.php');
?>


	<!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>