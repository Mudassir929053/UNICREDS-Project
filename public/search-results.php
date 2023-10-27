<?php
    include('function/function.php');
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

    $query = $_POST["query"];

    $courseQuery = "c.course_title LIKE '%".$query."%' OR c.course_code LIKE '%".$query."%'";
    $mcQuery = "mc.mc_title LIKE '%".$query."%' OR mc.mc_code LIKE '%".$query."%'";

    // Fetch all the related courses and/or micro-credentials based on the search query.
    $courseSearch = $courseInfo->fetch_courses($courseQuery);
    $mcSearch = $mcInfo->fetch_microcredentials($mcQuery);
    // Fetch all the enrolled courses and micro-credentials.
    // $enrolledCourse = $courseInfo->fetch_enrolled_courses();
    // $enrolledMC = $mcInfo->fetch_enrolled_microcredentials();
?>

    <!-- Page header -->
    <div class="pt-9 pb-9 ">
        <div class="container">
            <div class="row ">
                <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="text-center mb-5">
                        <h1 class=" display-2 fw-bold">Search Results</h1>
                        <p class=" lead">
                            Find all the related courses and micro-credentials.
                        </p>
                    </div>
                    <!-- Form -->
                    <form method="post" enctype="multipart/form-data" class="row px-md-20">
                        <div class="mb-3 col ps-0  ms-2 ms-md-0">
                            <input type="search" class="form-control" name="query" placeholder="Search Catalog" required>
                        </div>
                        <div class="mb-3 col-auto ps-0">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="pb-8">
        <div class="container">
            <div class="row">
    <?php
        if(($courseSearch !== NULL) || ($mcSearch !== NULL)) {
            $result = array();

            if($courseSearch !== NULL) {
                foreach($courseSearch as $val) {
                    $course_id = $val["course_id"];
                    $link = "course-enroll.php?course_id={$course_id}";
                    $enrolled = false;
                    // check whether the course are enrolled or not.
                    // if($enrolledCourse !== NULL) {
                    //     foreach($enrolledCourse as $enroll) {
                    //         if($enroll["ecsu_course_id"] === $course_id) {
                    //             $link = "course-view-enrolled.php?course_id={$course_id}&amp;pill=desc";
                    //             $enrolled = true;
                    //         }
                    //     }
                    // }
                    $course_owner = $courseInfo->check_course_owner($val["course_owner"]);

                    $courseArr = array(
                        "link"          => $link, 
                        "enrolled"      => $enrolled, 
                        "image"         => $val["course_image"] !== NULL ? "../assets/images/course/".$val["course_image"] : "../assets/images/course/course-default.jpg", 
                        "type"          => '<span class="fs-5 mb-3 fw-semi-bold d-block text-success">Course</span>', 
                        "name"          => $val["course_title"], 
                        "description"   => $val["course_description"], 
                        "inst_logo"     => $course_owner["image"], 
                        "inst_name"     => $course_owner["name"], 
                        "inst_email"    => $course_owner["email"]
                    );

                    array_push($result, $courseArr);
                }
            }

            if($mcSearch !== NULL) {
                foreach($mcSearch as $val) {
                    $mc_id = $val["mc_id"];
                    $link = "micro-creds-enroll.php?mc_id={$mc_id}";
                    $enrolled = false;
                    // check whether the micro-credentials are enrolled or not.
                    // if($enrolledMC !== NULL) {
                    //     foreach($enrolledMC as $enroll) {
                    //         if($enroll["emcsu_mc_id"] === $mc_id) {
                    //             $link = "micro-creds-view-enrolled.php?mc_id={$mc_id}&amp;pill=desc";
                    //             $enrolled = true;
                    //         }
                    //     }
                    // }

                    if($val["mc_owner"] !== NULL) {
                        $inst_logo = $val["institution_logo"] !== NULL ? "../assets/images/avatar/" . $val["institution_logo"] : "../assets/images/avatar/university_default.jpg";
                        $inst_name = $val["university_name"];
                        $inst_email = $val["institution_email"];
                    } else {
                        $inst_logo = "../assets/images/avatar/university_default.jpg";
                        $inst_name = "<span class='text-muted'><em>Not available</em></span>";
                        $inst_email = "<span class='text-muted'><em>Not available</em></span>";
                    }

                    $mcArr = array(
                        "link"          => $link, 
                        "enrolled"      => $enrolled, 
                        "image"         => "../assets/images/microcredential/".$val["mc_image"], 
                        "type"          => '<span class="fs-5 mb-3 fw-semi-bold d-block text-primary">Micro-credential</span>', 
                        "name"          => $val["mc_title"], 
                        "description"   => $val["mc_description"], 
                        "inst_logo"     => $inst_logo, 
                        "inst_name"     => $inst_name, 
                        "inst_email"     => $inst_email
                    );

                    array_push($result, $mcArr);
                }
            }

            array_multisort(array_column($result, "name"), SORT_ASC, SORT_STRING, $result);

            foreach($result as $val) {
    ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <!-- Card -->
                    <div class="card mb-4 shadow-lg" style="max-height: 480px;">
                <?php
                    if($val["enrolled"]) {
                ?>
                        <!-- Enrolled badge -->
                        <div class="position-absolute w-100">
                            <div class="">
                                <div class="w-25 mt-2 ms-2">
                                    <span class="badge rounded-pill bg-success fs-4">Enrolled</span>
                                </div>
                            </div> 
                        </div>
                <?php
                    }
                ?>
                        <a href="<?= $val["link"] ?>" class="card-img-top" style="height: 200px;">
                            <!-- Img  -->
                            <img src="<?= $val["image"] ?>" class="card-img-top rounded-top-md h-100" alt="">
                        </a>
                        <!-- Card body -->
                        <div class="card-body">
                            <?= $val["type"] ?>
                            <h3 class="text-truncate">
                                <a href="<?= $val["link"] ?>" class="text-inherit">
                                    <?= $val["name"] ?>
                                </a>
                            </h3>
                            <div class="text-truncate-line-2"><?= $val["description"] ?></div>
                            <!-- Media content -->
                            <div class="row align-items-center g-0 mt-4">
                                <div class="col-auto">
                                    <img src="<?= $val["inst_logo"] ?>" alt="" class="rounded-circle avatar-sm me-2">
                                </div>
                                <div class="col lh-1">
                                    <h5 class="mb-1 text-truncate"><?= $val["inst_name"] ?></h5>
                                    <p class="fs-6 mb-0"><?= $val["inst_email"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        } else {
    ?>
                <!-- No contents -->
                <div class="row mt-3 mb-3 justify-content-center">
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

    <!-- Footer -->
<?php
    require_once("pages-footer.php");
?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>