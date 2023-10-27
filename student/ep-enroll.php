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

    use DBData\EmployabilityProgram as ep;

    $epInfo = new ep($suID);

    $ep_id = $_GET["ep_id"];
    $data = $epInfo->fetch_employability_program($ep_id);


    ?>
    <!--add to cart notification-->
    <div class="position-fixed top-10 end-0 p-5">
        <div class="toast fade bg-success" id="addcart" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <i class="fas fa-check d-inline"></i>&emsp;<p class="m-0 d-inline" id="addcartbody"></p>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!--add to cart notification-->

    <!--already in cart notification-->
    <div class="position-fixed top-10 end-0 p-5">
        <div class="toast fade bg-warning" id="incart" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <i class="fas fa-info-circle d-inline"></i>&emsp;<p class="m-0 d-inline" id="incartbody"></p>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!--already in cart notification-->

    <!--enrolled notification-->
    <div class="position-fixed top-10 end-0 p-5">
        <div class="toast fade bg-info" id="enrolled" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <i class="fas fa-info-circle d-inline"></i>&emsp;<p class="m-0 d-inline" id="enrolledbody"></p>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!--enrolled notification-->

    <!-- Page header -->
    <div class="pt-lg-8 pb-lg-16 pt-8 pb-12 bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div>
                        <!-- Microcredential code -->
                        <h2 class="mb-1 text-truncate ">
                            <span class="text-white">
                            </span>
                        </h2>
                        <!-- Micro-credential name -->
                        <h1 class="text-white display-4 fw-semi-bold"><?= $data["ep_title"] ?></h1>
                        <!-- <p class="text-white mb-6 lead">
                            JavaScript is the popular programming language which powers web pages and web applications. 
                            This course will get you started coding in JavaScript.
                        </p> -->
                        <!-- Micro-credential category -->
                        <div class="text-white text-decoration-none mt-6">
                            <i class="fe fe-book text-white-50 me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                            <?= $data["ep_category"] !== NULL ? $data["ep_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                        </div>

                        <!-- Micro-credential total enroll -->
                        <div class="mb-0">
                            <i class="fe fe-users me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>
                            <span class="text-white">
                                <?= $data["ep_total_enrolled"] === NULL || $data["ep_total_enrolled"] == 0 ? "<span class='text-muted'><em>No enrollment</em></span>" : $data["ep_total_enrolled"] . " enrolled" ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="pb-10">
        <div class="container">
            <div class="row">
                <!-- Microcredential contents overview. -->
                <div class="col-lg-8 col-md-12 col-12 mt-n8 mb-4 mb-lg-0">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="card-header border-bottom-0 p-0">
                            <div>
                                <!-- Nav -->
                                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">
                                            Description
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="detail-tab" data-bs-toggle="pill" href="#detail" role="tab" aria-controls="detail" aria-selected="false">
                                            More Details
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <!-- Description -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <!-- Micro-credential description -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">About This Microcredential</h3>
                                        <p>
                                            <?= $data["ep_description"] ?>
                                        </p>
                                    </div>
                                    <!-- Micro-credential learning outcomes -->

                                </div>

                                <!-- More details -->
                                <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                    <!-- Micro-credential intended learners -->

                                    <!-- Micro-credential skill achieved -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">Skill Achieved</h3>
                                        <p>
                                            <?= $data["ep_skills_achieve"] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Microcredential sidebar info. -->
                <div class="col-lg-4 col-md-12 col-12 mt-lg-n22">
                    <!-- Card -->
                    <div class="card mb-3 mb-4">
                        <div class="p-1">
                            <div class="d-flex justify-content-center position-relative rounded py-10 border-white border rounded-3 bg-cover" style="background-image: url('<?= "../assets/images/employability_program/epthumbnails/" . $data["ep_cover_attachment"] ?>')">
                                <a class="popup-youtube icon-shape rounded-circle btn-play icon-xl text-decoration-none fade">
                                    <i class="fe fe-play"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Price single page -->
                            <div class="mb-3">
                                <span class="text-dark fw-bold h2"><?= feeFormat($data["ep_fee"]) ?></span>
                                <!-- <del class="fs-4 text-muted">$750</del> -->
                            </div>


                            <div id="addtocart" class="d-flex align-items-center">
                                <!-- <a href="#" class="btn btn-primary mb-2  ">Start Free Month</a> -->
                                <?php
                                if ($data["ep_fee"] == 0) {
                                    ?>
                                    <button type="button" class="btn btn-primary me-2 w-100" data-id="<?= $data["ep_id"] ?>" data-type="ep" data-function="buynow">Enroll Now</button>
                                     <?php                                } else {
                                    ?>
                                    <button type="button" class="btn btn-warning btn-icon w-100" data-id="<?= $data["ep_id"] ?>" data-type="ep" data-function="addtocart" data-bs-toggle="tooltip" data-placement="top" title="Add to Cart">
                                    <i class="fe fe-shopping-cart fs-4"></i>
                                </button>
                                  <?php                              }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="card mb-4">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0">What's included</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-play-circle align-middle me-2 text-primary"></i>
                                    Teaching videos
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-award me-2 align-middle text-success"></i>
                                    Certificate & badges
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <i class="mdi mdi-notebook align-middle me-2 text-info"></i>
                                    Notes & slides
                                </li>
                                <li class="list-group-item bg-transparent border-bottom-0">
                                    <i class="fe fe-clock align-middle me-2 text-warning"></i>
                                    Lifetime access
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Micro-credential owner info -->
                    <div class="card">
                        <!-- Card body -->
                        <?php
                        if ($data["course_created_by"] !== NULL) {
                            $createdBy = $data["course_created_by"];
                            $userDetails = null;

                            // Retrieve user role from user table
                            $userRoleQuery = $conn->query("SELECT user_role_id FROM user WHERE user_id = $createdBy");
                            if ($userRoleQuery !== null && $userRoleQuery->num_rows > 0) {
                                $userRoleData = $userRoleQuery->fetch_assoc();
                               $userRole = $userRoleData["user_role_id"];

                                // Check the user role and retrieve user details from the corresponding table
                                if ($userRole === "1") {
                                    // Retrieve user details from admin
                                    $userDetails = $conn->query("SELECT * FROM admin WHERE admin_user_id = $createdBy");
                                } elseif ($userRole === "5") {
                                    // Retrieve user details from institution
                                    $userDetails = $conn->query("                                                                                                                                                                                                                SELECT * FROM institution WHERE institution_user_id SELECT * 
                                    FROM institution 
                                    LEFT JOIN university ON institution.institution_university_id = university.university_id 
                                    WHERE institution.institution_user_id = $createdBy");
                                }
                            }

                            if ($userDetails !== null && $userDetails->num_rows > 0) {
                                $userData = $userDetails->fetch_assoc();
                    //    print_r($userData);
                       ?>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="position-relative">
                                            <?php if ($userRole === "1") { ?>
                                                <img src="<?= $userData["admin_logo"] !== NULL ? "../assets/images/avatar/" . $userData["admin_logo"] : "../assets/images/avatar/avatar.jpg" ?>" alt="" class="rounded-circle avatar-xl" />
                                            <?php } elseif ($userRole === "5") { ?>
                                                <img src="<?= $userData["institution_logo"] !== NULL ? "../assets/images/avatar/" . $userData["institution_logo"] : "../assets/images/avatar/university_default.jpg" ?>" alt="" class="rounded-circle avatar-xl" />
                                            <?php } ?>
                                            <img src="../assets/images/svg/checked-mark.svg" class="position-absolute mt-2 ms-n3" alt="" height="30" width="30" />
                                        </div>
                                        <div class="ms-4">
                                            <?php if ($userRole === "1") { ?>
                                                <h4 class="mb-0"><?= $userData["admin_name"] ?></h4>
                                                <p class="mb-0 fs-6"><?= $userData["admin_email"] ?></p>
                    
                                            <?php } elseif ($userRole === "5") { ?>
                                                <h4 class="mb-0"><?= $userData["university_name"] ?></h4>
                                                <p class="mb-0 fs-6"><?= $userData["institution_email"] ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>
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
    <script src="js/payment.js"></script>



</body>

</html>