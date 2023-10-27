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

    use DBData\Microcredential as mc;

    $mcInfo = new mc($suID);

    $mc_id = $_GET["mc_id"];
    $data = $mcInfo->fetch_microcredential($mc_id);


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
    <div class="position-fixed top-10 end-0 p-5" >
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
                                <?= $data["mc_code"] !== NULL ? $data["mc_code"] : "" ?>
                            </span>
                        </h2>
                        <!-- Micro-credential name -->
                        <h1 class="text-white display-4 fw-semi-bold"><?= $data["mc_title"] ?></h1>
                        <!-- <p class="text-white mb-6 lead">
                            JavaScript is the popular programming language which powers web pages and web applications. 
                            This course will get you started coding in JavaScript.
                        </p> -->
                        <!-- Micro-credential category -->
                        <div class="text-white text-decoration-none mt-6">
                            <i class="fe fe-book text-white-50 me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                            <?= $data["mc_category"] !== NULL ? $data["mc_category"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                        </div>
                        <ul class="list-inline mt-1 m-0 mb-1">
                            <!-- Micro-credential duration -->
                            <li class="mb-1">
                                <i class="far fa-clock me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Duration"></i>
                                <span class="text-white">
                                    <?= $data["mc_duration"] !== NULL ? $data["mc_duration"] : "<span class='text-muted'><em>Not set</em></span>" ?>
                                </span>
                            </li>
                            <!-- Micro-credential level -->
                            <li class="text-truncate">
                                <i class="mdi mdi-school me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Level"></i>
                                <span class="text-white">
                                    <?= $data["mc_level"] !== NULL ? acadLevel($data["mc_level"]) : "<span class='text-muted'><em>Not set</em></span>" ?>
                                </span>
                            </li>
                            <!-- Micro-credential credit -->
                            <!-- <li>
                                <i class="fe fe-book-open me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>
                                <span class="text-white">
                                    <?= $data["mc_credit"] !== NULL ? $data["mc_credit"] . " credits" : "<span class='text-muted'><em>Not set</em></span>" ?>
                                </span>
                            </li> -->
                        </ul>
                        <!-- Micro-credential total enroll -->
                        <div class="mb-0">
                            <i class="fe fe-users me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>
                            <span class="text-white">
                                <?= $data["mc_total_enrolled"] === NULL || $data["mc_total_enrolled"] == 0 ? "<span class='text-muted'><em>No enrollment</em></span>" : $data["mc_total_enrolled"] . " enrolled" ?>
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
                                            <?= $data["mc_description"] ?>
                                        </p>
                                    </div>
                                    <!-- Micro-credential learning outcomes -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">Learning Outcomes</h3>
                                        <p>
                                            <?= $data["mcld_learning_outcome"] ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- More details -->
                                <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                    <!-- Micro-credential intended learners -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">Intended Learners</h3>
                                        <p>
                                            <?= $data["mcld_intended_learners"] ?>
                                        </p>
                                    </div>
                                    <!-- Micro-credential rerequisites -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">Prerequisites</h3>
                                        <p>
                                            <?= $data["mcld_prerequisites"] ?>
                                        </p>
                                    </div>
                                    <!-- Micro-credential skill achieved -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">Skill Achieved</h3>
                                        <p>
                                            <?= $data["mcld_skills"] ?>
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
                            <div class="d-flex justify-content-center position-relative rounded py-10 border-white border rounded-3 bg-cover" style="background-image: url('<?= "../assets/images/microcredential/" . $data["mc_image"] ?>')">
                                <a class="popup-youtube icon-shape rounded-circle btn-play icon-xl text-decoration-none fade">
                                    <i class="fe fe-play"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Price single page -->
                            <div class="mb-3">
                                <span class="text-dark fw-bold h2"><?= feeFormat($data["mc_fee"]) ?></span>
                                <!-- <del class="fs-4 text-muted">$750</del> -->
                            </div>
                            <?php
                            if ($data["mc_enrollment_date"] === "anytime") {
                                $disabledEnroll = "";
                            ?>
                                <div class="mb-3">
                                    <h3 class="text-body text-center">Start any time</h3>
                                </div>
                            <?php
                            } else if ($data["mc_enrollment_date"] === "choosedate") {
                                $today = date("Y-m-d", strtotime("now"));

                                // Check if today date is in range between the start and end date.
                                if (($today >= $data["mces_start_date"]) && ($today <= $data["mces_end_date"])) {
                                    $disabledEnroll = "";
                                } else {
                                    $disabledEnroll = "disabled";
                                }
                            ?>
                                <!-- Duration -->
                                <div class="d-flex justify-content-between mb-3 px-3 pb-0">
                                    <div>
                                        <h4 class="text-body">Open date</h4>
                                        <span class="fw-medium fs-3 text-dark"><?= date_format(date_create($data["mces_start_date"]), "d/m/Y") ?></span>
                                    </div>
                                    <div>
                                        <h4 class="text-body">Close date</h4>
                                        <span class="fw-medium fs-3 text-dark"><?= date_format(date_create($data["mces_end_date"]), "d/m/Y") ?></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div id="addtocart" class="d-flex align-items-center">
                                <!-- <a href="#" class="btn btn-primary mb-2  ">Start Free Month</a> -->
                                <?php
                                if ($data["mc_fee"] == 0) {
                                ?>
                                <button type="button" class="btn btn-primary me-2 w-100 <?= $disabledEnroll ?>" data-id="<?= $data["mc_id"] ?>" data-type="mc" data-function="buynow">Enroll Now</button>
                                <?php                                } else {
                                ?>
                                <button type="button" class="btn btn-warning btn-icon w-100 <?= $disabledEnroll ?>" data-id="<?= $data["mc_id"] ?>" data-type="mc" data-function="addtocart" data-bs-toggle="tooltip" data-placement="top" title="Add to Cart">
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
                        if ($data["mc_owner"] !== NULL) {
                        ?>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="position-relative">
                                        <img src="<?= $data["institution_logo"] !== NULL ? "../assets/images/avatar/" . $data["institution_logo"] : "../assets/images/avatar/university_default.jpg" ?>" alt="" class="rounded-circle avatar-xl" />

                                        <img src="../assets/images/svg/checked-mark.svg" class="position-absolute mt-2 ms-n3" alt="" height="30" width="30" />

                                    </div>
                                    <div class="ms-4">
                                        <h4 class="mb-0"><?= $data["university_name"] ?></h4>
                                        <p class="mb-0 fs-6"><?= $data["institution_email"] ?></p>
                                        <p class="mb-1 fs-6"><?= $data["institution_contact_no"] ?></p>
                                        <a href="<?= $data["university_website"] ?>" target="_blank" class="fs-5"><?= $data["university_website"] ?></a>
                                    </div>
                                </div>
                                <!-- <div class="border-top px-3 pt-3 pb-0 text-end">
                                <a href="#" class="btn btn-outline-white btn-sm">View Details <i class="fe fe-chevron-right ms-1"></i></a>
                            </div> -->
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
    require_once("pages-footer.php");
    ?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <script src="js/payment.js"></script>



</body>

</html>