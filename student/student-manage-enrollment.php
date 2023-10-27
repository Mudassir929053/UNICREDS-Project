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

    <!-- Page Content -->
    <div class="pt-5">
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
                    <!-- Card -->
                    <div class="card mb-4"><!-- Card header -->
                        <div class="card-header mb-2">
                            <h3 class="mb-0">Course & Micro-credential & Employability-Program Enrollment</h3>
                            <p class="mb-0 ">Manage your enrollment here.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body mb-2">
                            <ul class="nav nav-tabs justify-content-center fw-bold text-uppercase" id="enrollTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?= $_GET["tab"] === "course" ? "active" : "" ?>" id="course-tab" data-bs-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="true">
                                        Course
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $_GET["tab"] === "mc" ? "active" : "" ?>" id="mc-tab" data-bs-toggle="tab" href="#mc" role="tab" aria-controls="mc" aria-selected="false">
                                        Micro-credential
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $_GET["tab"] === "ep" ? "active" : "" ?>" id="ep-tab" data-bs-toggle="tab" href="#ep" role="tab" aria-controls="ep" aria-selected="false">
                                        Employability Program
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="enrollTabContent">
                            <!-- Course -->
                            <div class="tab-pane fade <?= $_GET["tab"] === "course" ? "show active" : "" ?>" id="course" role="tabpanel" aria-labelledby="course-tab">
                                <?php
                                if ($courseInfo->fetch_enrolled_courses() === NULL) {
                                ?>
                                    <!-- No courses -->
                                    <div class="d-flex mt-4 mb-3 justify-content-center">
                                        <div class="col-lg-8 col-md-12 col-12 text-center">
                                            <h2 class="mb-2 display-5 fw-bold">Oops! There's no courses.</h2>
                                            <p class="lead">
                                                Start enrolling in <a href="course-lists.php" class="text-inherit">courses now!</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- Table  -->
                                    <div class="table-responsive border-0 overflow-y-hidden">
                                        <table class="table mb-0 text-nowrap">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="border-0">Course Name</th>
                                                    <th scope="col" class="border-0 text-center">Duration</th>
                                                    <th scope="col" class="border-0 text-center">Credits</th>
                                                    <th scope="col" class="border-0 text-center">Status</th>
                                                    <!-- <th scope="col" class="border-0"></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Course Lists -->
                                                <?php
                                                if ($courseInfo->fetch_enrolled_courses() !== NULL) {
                                                    foreach ($courseInfo->fetch_enrolled_courses() as $data) {
                                                        $course_id = $data["course_id"];

                                                        $link = "course-view-enrolled.php?course_id={$course_id}&amp;pill=desc";
                                                ?>
                                                        <tr>
                                                            <!-- Course -->
                                                            <td class="border-top-0" style="max-width: 400px;">
                                                                <a href="<?= $link ?>" class="text-inherit">
                                                                    <div class="d-lg-flex align-items-center">
                                                                        <div>
                                                                            <img src="<?= $data["course_image"] !== NULL ? "../assets/images/course/" . $data["course_image"] : "../assets/images/course/course-default.jpg" ?>"" alt="" class=" img-4by3-lg rounded" />
                                                                        </div>
                                                                        <div class="ms-lg-3 mt-2 mt-lg-0 text-truncate">
                                                                            <!-- Name -->
                                                                            <h4 class="mb-1 text-primary-hover text-truncate"><?= $data["course_title"] ?></h4>
                                                                            <!-- Enrolled Date -->
                                                                            <span class="text-inherit">Enrolled on <?= date_format(date_create($data["ecsu_enrollment_date"]), "jS F, Y") ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <!-- Duration -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["course_duration"] ?>
                                                            </td>
                                                            <!-- Credits -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["course_credit"] ?>
                                                            </td>
                                                            <!-- Progress -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["ecsu_status"] ?>
                                                            </td>
                                                            <!-- Settings -->
                                                            <!-- <td class="align-middle border-top-0">
                                                    <span class="dropdown dropstart">
                                                        <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown1"
                                                            data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu border" aria-labelledby="courseDropdown1">
                                                            <span class="dropdown-header">Settings</span>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Unenroll Course
                                                            </a>
                                                        </span>
                                                    </span>
                                                </td> -->
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- Micro-credential -->
                            <div class="tab-pane fade <?= $_GET["tab"] === "mc" ? "show active" : "" ?>" id="mc" role="tabpanel" aria-labelledby="mc-tab">
                                <?php
                                if ($mcInfo->fetch_enrolled_microcredentials($suID) === NULL) {
                                ?>
                                    <!-- No courses -->
                                    <div class="d-flex mt-4 mb-3 justify-content-center">
                                        <div class="col-lg-8 col-md-12 col-12 text-center">
                                            <h2 class="mb-2 display-5 fw-bold">Oops! There's no micro-credentials.</h2>
                                            <p class="lead">
                                                Start enrolling in <a href="micro-creds-lists.php" class="text-inherit">micro-credentials now!</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- Table  -->
                                    <div class="table-responsive border-0 overflow-y-hidden">
                                        <table class="table mb-0 text-nowrap">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="border-0">Micro-credential Name</th>
                                                    <th scope="col" class="border-0 text-center">Duration</th>
                                                    <th scope="col" class="border-0 text-center">Credit</th>
                                                    <th scope="col" class="border-0 text-center">Status</th>
                                                    <!-- <th scope="col" class="border-0"></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Micro-credential Lists -->
                                                <?php
                                                if ($mcInfo->fetch_enrolled_microcredentials($suID) !== NULL) {
                                                    $link;

                                                    foreach ($mcInfo->fetch_enrolled_microcredentials($suID) as $data) {
                                                        $mc_id = $data["mc_id"];
                                                        $link = "micro-creds-view-enrolled.php?mc_id={$mc_id}&amp;pill=desc";
                                                ?>
                                                        <tr>
                                                            <!-- Micro-credential -->
                                                            <td class="border-top-0" style="max-width: 400px;">
                                                                <a href="<?= $link ?>" class="text-inherit">
                                                                    <div class="d-lg-flex align-items-center">
                                                                        <div>
                                                                            <img src="<?= "../assets/images/microcredential/" . $data["mc_image"] ?>" alt="" class="img-4by3-lg rounded" />
                                                                        </div>
                                                                        <div class="ms-lg-3 mt-2 mt-lg-0 text-truncate">
                                                                            <h4 class="mb-1 text-primary-hover text-truncate"><?= $data["mc_title"] ?></h4>
                                                                            <span class="text-inherit">Enrolled on <?= date_format(date_create($data["emcsu_enrollment_date"]), "jS F, Y") ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <!-- Duration -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["mc_duration"] !== NULL ? $data["mc_duration"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                                            </td>
                                                            <!-- Credit Transfer -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <!-- <?= $data["mc_credit_transfer"] !== NULL ? $data["mc_credit_transfer"] . " credits" : "<span class='text-muted'><em>Not set</em></span>" ?> -->
                                                                <span class='text-muted'><em>Not set</em></span>
                                                            </td>
                                                            <!-- Progress -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["emcsu_status"] ?>
                                                            </td>
                                                            <!-- Settings -->
                                                            <!-- <td class="align-middle border-top-0">
                                                    <span class="dropdown dropstart">
                                                        <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown1"
                                                            data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu border" aria-labelledby="courseDropdown1">
                                                            <span class="dropdown-header">Settings</span>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Unenroll Course
                                                            </a>
                                                        </span>
                                                    </span>
                                                </td> -->
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- Employability Program-->
                            <div class="tab-pane fade <?= $_GET["tab"] === "ep" ? "show active" : "" ?>" id="ep" role="tabpanel" aria-labelledby="ep-tab">
                                <?php
                                if ($epInfo->fetch_enrolled_employability_programs($suID) === NULL) {
                                ?>
                                    <!-- No courses -->
                                    <div class="d-flex mt-4 mb-3 justify-content-center">
                                        <div class="col-lg-8 col-md-12 col-12 text-center">
                                            <h2 class="mb-2 display-5 fw-bold">Oops! There's no Employability Program.</h2>
                                            <p class="lead">
                                                Start enrolling in <a href="ep-list.php" class="text-inherit">Employability Program now!</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- Table  -->
                                    <div class="table-responsive border-0 overflow-y-hidden">
                                        <table class="table mb-0 text-nowrap">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="border-0">Employability Program Name</th>
                                                    <!-- <th scope="col" class="border-0 text-center">Duration</th>
                                                <th scope="col" class="border-0 text-center">Credit</th> -->
                                                    <th scope="col" class="border-0 text-center">Status</th>
                                                    <!-- <th scope="col" class="border-0"></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Micro-credential Lists -->
                                                <?php
                                                if ($epInfo->fetch_enrolled_employability_programs($suID) !== NULL) {
                                                    $link;

                                                    foreach ($epInfo->fetch_enrolled_employability_programs($suID) as $data) {
                                                        $ep_id = $data["ep_id"];
                                                        $link = "micro-creds-view-enrolled.php?ep_id={$ep_id}&amp;pill=desc";
                                                ?>
                                                        <tr>
                                                            <!-- Micro-credential -->
                                                            <td class="border-top-0" style="max-width: 400px;">
                                                                <a href="<?= $link ?>" class="text-inherit">
                                                                    <div class="d-lg-flex align-items-center">
                                                                        <div>
                                                                            <img src="<?= "../assets/images/microcredential/" . $data["ep_image"] ?>" alt="" class="img-4by3-lg rounded" />
                                                                        </div>
                                                                        <div class="ms-lg-3 mt-2 mt-lg-0 text-truncate">
                                                                            <h4 class="mb-1 text-primary-hover text-truncate"><?= $data["ep_title"] ?></h4>
                                                                            <span class="text-inherit">Enrolled on <?= date_format(date_create($data["eepsu_enrollment_date"]), "jS F, Y") ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>


                                                            <!-- Progress -->
                                                            <td class="align-middle text-center border-top-0">
                                                                <?= $data["eepsu_status"] ?>
                                                            </td>
                                                            <!-- Settings -->
                                                            <!-- <td class="align-middle border-top-0">
                                                    <span class="dropdown dropstart">
                                                        <a class="text-decoration-none text-muted" href="#" role="button" id="courseDropdown1"
                                                            data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu border" aria-labelledby="courseDropdown1">
                                                            <span class="dropdown-header">Settings</span>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Unenroll Course
                                                            </a>
                                                        </span>
                                                    </span>
                                                </td> -->
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
    </div>

    <!-- Footer -->
    <?php
    include('pages-footer.php');
    ?>


    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

    <!-- For navigation -->
    <script>
        // Tab navigation.
        $("#enrollTab").find("a").on("click", function() {
            var subj = $(this).attr("aria-controls");
            var fileLink = window.location.href;
            var link = fileLink.split("?")[0] + "?tab=" + subj;

            // --- change the link query values.
            window.history.pushState("", "", link);
        });
    </script>
</body>

</html>