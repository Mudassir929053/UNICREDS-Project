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
    use DBData\Course as c;
    use DBData\Microcredential as mc;
    
    $courseInfo = new c($suID);
    $mcInfo = new mc($suID);
?>

    <!-- Page Content -->
    <div class="bg-primary">
        <div class="container">
            <!-- Hero Section -->
            <div class="row align-items-center g-0">
                <div class="col-xl-5 col-lg-6 col-md-12 my-8">
                    <div class="py-5 py-lg-0">
                        <h1 class="text-white display-4 fw-bold">Welcome to UNICREDS Learning Application</h1>
                        <p class="text-white-50 mb-4 lead">
                            Hand-picked instructor and expertly crafted courses, designed for the modern students.
                        </p>
                        <!-- <a href="#" class="btn btn-white">Are You Instructor?</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-4 shadow-sm">
        <div class="container">
            <div class="row align-items-center g-0">
                <!-- Features -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                    <div class="d-flex align-items-center">
                        <span class="icon-sahpe icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                            <i class="fe fe-video"></i>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semi-bold">Online courses</h4>
                            <p class="mb-0">Enjoy a variety of fresh topics</p>
                        </div>
                    </div>
                </div>
                <!-- Features -->
                <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                    <div class="d-flex align-items-center">
                        <span class="icon-sahpe icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semi-bold">Expert instruction</h4>
                            <p class="mb-0">Find the right instructor for you</p>
                        </div>
                    </div>
                </div>
                <!-- Features -->
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="d-flex align-items-center">
                        <span class="icon-sahpe icon-lg bg-light-warning rounded-circle text-center text-dark-warning fs-4 ">
                            <i class="fe fe-clock"></i>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semi-bold">Lifetime access</h4>
                            <p class="mb-0">Learn on your schedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrolled course -->
    <div class="pt-lg-12 pb-lg-3 pt-8 pb-6">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="mb-0">Enrolled course</h2>
                </div>
            </div>
    <?php
        if($courseInfo->fetch_enrolled_courses() === NULL) {
    ?>
            <!-- No courses -->
            <div class="row mb-8 justify-content-center">
                <div class="col-lg-8 col-md-12 col-12 text-center">
                    <h2 class="mb-2 display-4 fw-bold">You didn't enrolled in any courses.</h2>
                    <p class="lead">
                        <a href="course-lists.php" class="text-inherit">Enrolled now</a> to start your journey!
                    </p>
                </div>
            </div>
    <?php
        } else {
    ?>
            <!-- Course lists -->
            <div class="position-relative">
                <ul class="controls" id="sliderFirstControls">
                    <li class="prev">
                        <i class="fe fe-chevron-left"></i>
                    </li>
                    <li class="next">
                        <i class="fe fe-chevron-right"></i>
                    </li>
                </ul>
                <div class="sliderFirst d-flex align-items-center">
            <?php
                $link;
                $i = 0;

                foreach($courseInfo->fetch_enrolled_courses() as $data) {
                    $course_id = $data["course_id"];
                    $link = "course-view-enrolled.php?course_id={$course_id}&amp;pill=desc";
            ?>
                    <div class="item">
                        <!-- Card -->
                        <a href="<?= $link ?>" class="card-img-top">
                            <div class="card border mb-4 card-hover">
                                <div style="max-height: 150px;">
                                    <img src="<?= $data["course_image"] !== NULL ? "../assets/images/course/" . $data["course_image"] : "../assets/images/course/course-default.jpg" ?>" 
                                        alt="" class="card-img-top rounded-top-md" height="150">
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Course name -->
                                    <h4 class="mb-2 text-truncate">
                                        <?= $data["course_title"] ?>
                                    </h4>
                                    <ul class="list-inline mt-3 m-0 mb-2">
                                        <!-- Course institution -->
                                        <li class="text-truncate mb-1">
                                            <i class="fe fe-user-check me-1" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>
                                            <span class="text-body">
                                                <?= $data["course_owner"] !== NULL ? $courseInfo->check_course_owner($data["course_owner"])["name"] : "<span class='text-muted'><em>Not available</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Course category -->
                                        <li class="text-truncate mb-1">
                                            <i class="fe fe-book me-1 text-success" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                            <span class="text-body text-truncate">
                                                <?= $data["course_category"] !== NULL ? $data["course_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Course duration -->
                                        <li class="mb-1">
                                            <i class="far fa-clock me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>
                                            <span class="text-body">
                                                <?= $data["course_duration"] !== NULL ? $data["course_duration"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Course level -->
                                        <li class="text-truncate mb-1">
                                            <i class="mdi mdi-school me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>
                                            <span class="text-body">
                                                <?= $data["course_level"] !== NULL ? acadLevel($data["course_level"]) : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Course credit -->
                                        <!-- <li>
                                            <i class="fe fe-book-open me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>
                                            <span class="text-body">
                                                <?= $data["course_credit_transfer"] !== NULL ? $data["course_credit_transfer"] . " credits" : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li> -->
                                        <!-- Course total enroll -->
                                        <li class="mb-0">
                                            <i class="fe fe-users me-1 text-warning" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>
                                            <span class="text-body">
                                                <?= $data["course_total_enrolled"] != 0 ? $data["course_total_enrolled"] . " enrolled" : "<span class='text-muted'><em>No enrollment</em></span>" ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                $i++;
                if($i >= 7) {
            ?>
                    <!-- View the rest of items -->
                    <div class="item">
                        <a href="student-enrollment.php?navTab=course">
                            <!-- Card -->
                            <div class="card  mb-4 card-hover">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h4 class="p-0 m-0 d-flex justify-content-center align-items-center text-inherit">
                                            <span href="#" class="text-inherit">View more </span><i class="fe fe-chevron-right"></i>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                        break;
                    }
                }
            ?>
                </div>
            </div>
    <?php
        }
    ?>
        </div>
    </div>

    <!-- Enrolled microcredential -->
    <div class="pb-lg-3 pt-lg-3 mb-8">
        <div class="container">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="mb-0">Enrolled micro-credential</h2>
                </div>
            </div>
    <?php
        if($mcInfo->fetch_enrolled_microcredentials() === NULL) {
    ?>
            <!-- No microcredentials -->
            <div class="row mb-8 justify-content-center">
                <div class="col-lg-10 col-md-12 col-12 text-center">
                    <h2 class="mb-2 display-4 fw-bold">You didn't enrolled in any micro-credentials.</h2>
                    <p class="lead">
                        <a href="micro-creds-lists.php" class="text-inherit">Enrolled now</a> to start your journey!
                    </p>
                </div>
            </div>
    <?php
        } else {
    ?>
            <!-- Micro-credential lists -->
            <div class="position-relative">
                <ul class="controls " id="sliderSecondControls">
                    <li class="prev">
                        <i class="fe fe-chevron-left"></i>
                    </li>
                    <li class="next">
                        <i class="fe fe-chevron-right"></i>
                    </li>
                </ul>
                <div class="sliderSecond d-flex align-items-center">
            <?php
                $link;
                $i = 0;

                foreach($mcInfo->fetch_enrolled_microcredentials() as $data) {
                    $mc_id = $data["mc_id"];
                    $link = "micro-creds-view-enrolled.php?mc_id={$mc_id}&amp;pill=desc";
            ?>
                    <div class="item">
                        <!-- Card -->
                        <a href="<?= $link ?>" class="card-img-top">
                            <div class="card border mb-4 card-hover">
                                <div style="max-height: 150px;">
                                    <img src="<?= "../assets/images/microcredential/" . $data["mc_image"] ?>" 
                                        alt="" class="card-img-top rounded-top-md" height="150">
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Micro-credential name -->
                                    <h4 class="mb-2 text-truncate">
                                        <?= $data["mc_title"] ?>
                                    </h4>
                                    <ul class="list-inline mt-3 m-0 mb-2">
                                        <!-- Micro-credential institution -->
                                        <li class="text-truncate mb-1">
                                            <i class="fe fe-user-check me-1" data-bs-toggle="tooltip" data-placement="top" title="Owner"></i>
                                            <span class="text-body">
                                                <?= $data["mc_owner"] !== NULL ? $data["university_name"] : "<span class='text-muted'><em>Not available</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Micro-credential category -->
                                        <li class="text-truncate mb-1">
                                            <i class="fe fe-book me-1 text-success" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                            <span class="text-body text-truncate">
                                                <?= $data["mc_category"] !== NULL ? $data["mc_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Micro-credential duration -->
                                        <li class="mb-1">
                                            <i class="far fa-clock me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>
                                            <span class="text-body">
                                                <?= $data["mc_duration"] !== NULL ? $data["mc_duration"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Micro-credential level -->
                                        <li class="text-truncate mb-1">
                                            <i class="mdi mdi-school me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>
                                            <span class="text-body">
                                                <?= $data["mc_level"] !== NULL ? acadLevel($data["mc_level"]) : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li>
                                        <!-- Micro-credential credit -->
                                        <!-- <li>
                                            <i class="fe fe-book-open me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>
                                            <span class="text-body">
                                                <?= $data["mc_credit_transfer"] !== NULL ? $data["mc_credit_transfer"] . " credits" : "<span class='text-muted'><em>Not set</em></span>" ?>
                                            </span>
                                        </li> -->
                                        <!-- Micro-credential total enroll -->
                                        <li class="mb-0">
                                            <i class="fe fe-users me-1 text-warning" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>
                                            <span class="text-body">
                                                <?= $data["mc_total_enrolled"] !== NULL ? $data["mc_total_enrolled"] . " enrolled" : "<span class='text-muted'><em>No enrollment</em></span>" ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                    $i++;
                    if($i >= 7) {
            ?>
                    <!-- View the rest of items -->
                    <div class="item">
                        <a href="student-enrollment.php?navTab=mc">
                            <!-- Card -->
                            <div class="card  mb-4 card-hover">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h4 class="p-0 m-0 d-flex justify-content-center align-items-center text-inherit">
                                            <span href="#" class="text-inherit">View more </span><i class="fe fe-chevron-right"></i>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                        break;
                    }
                }
            ?>
                </div>
            </div>
    <?php
        }
    ?>
        </div>
    </div>

    <!-- Footer -->
    <?php
include '../main/pages-footer.php';
?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>