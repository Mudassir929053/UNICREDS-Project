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
    $ep_id = $_GET["ep_id"];



    ?>

    <!-- Page header -->
    <div class="pt-lg-8 pb-lg-16 pt-8 pb-12 bg-primary">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-7 col-md-12">

                    <div>
                        <?php
                        $sql="SELECT employability_program.*, institution.*, MAX(ep_fee) AS max_ep_fee, cart.*, enrolled_ep_studuni.* 
                        FROM employability_program 
                        LEFT JOIN institution ON course_created_by = institution.institution_user_id 
                        LEFT JOIN cart ON cart.empoloyability_program_id = employability_program.ep_id 
                        LEFT JOIN enrolled_ep_studuni ON enrolled_ep_studuni.eepsu_ep_id = employability_program.ep_id 
                        WHERE employability_program.ep_id = $ep_id 
                        GROUP BY employability_program.ep_id 
                        ;";
                        
                        $queryep = $conn->query($sql);

                        $num = 1;
                        if (mysqli_num_rows($queryep) > 0) {
                            while ($rows = mysqli_fetch_object($queryep)) {
                                $ep_id = $rows->ep_id;
                        ?>

                                <!-- ep code 
                        <h2 class="mb-1 text-truncate ">
                            <span class="text-white">
                              
                            </span>
                        </h2>-->
                                <!-- ep name -->
                                <h1 class="text-white display-4 fw-semi-bold"><?= $rows->ep_title; ?></h1>
                                <!-- <p class="text-white mb-6 lead">
                            JavaScript is the popular programming language which powers web pages and web applications. 
                            This ep will get you started coding in JavaScript.
                        </p> -->
                                <!-- ep field -->
                                <div class="text-white text-decoration-none mt-6">
                                    <i class="fe fe-book text-white-50 me-2" data-bs-toggle="tooltip" data-placement="top" title="Category"></i>
                                    <?= $rows->ep_category; ?>
                                </div>
                                <!-- <ul class="mt-1 mb-1 list-inline">
                        
                            <li class="mb-1">
                            <i class="mdi mdi-school text-warning fs-4"></i>
                                <span class="text-white">
                                <span style="vertical-align: middle;" class="<?php if ($rows->ep_publish == 'Published') {
                                                                                    echo "badge bg-success";
                                                                                } else {
                                                                                    echo "badge bg-warning";
                                                                                } ?>"><?php echo $rows->ep_publish; ?>
                                                </span>
                                </span>
                            </li>
                            <!- ep level 
                            <li class="text-trucate">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar text-success" viewBox="0 0 16 16">
														<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
													</svg>
                                                
                                <span class="text-white">RM
                                <?= $rows->ep_fee; ?>
                                </span>
                                                                                          
                            </li>-->
                                <!-- ep credit -->
                                <!-- <li>
                                <i class="fe fe-book-open me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Credit"></i>
                                <span class="text-white">
                                    <?= $data["ep_credit"] ?>
                                </span>
                            </li> -->
                                </ul>
                                <!-- ep total enroll
                        <div class="lh-1 mb-0">
                            <i class="fe fe-users me-2 text-white-50" data-bs-toggle="tooltip" data-placement="top" title="Total enroll"></i>
                            <span class="text-white">
                                <?= ($data["ep_total_enrolled"] == 0 || $data["ep_total_enrolled"] === NULL) ? "<span class='text-muted'><em>No enrollment</em></span>" : $data["ep_total_enrolled"] . " enrolled" ?>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="pb-10">
        <div class="container">
            <div class="row">
                <!-- ep contents overview. -->
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
                                    <!-- ep description -->
                                    <div class="mb-4">
                                        <h3 class="mb-2">About This ep</h3>
                                        <p>
                                            <?= $rows->ep_description; ?>
                                        </p>
                                    </div>
                                    <!-- ep learning outcomes
                                    <div class="mb-4">
                                        <h3 class="mb-2">Learning Outcomes</h3>
                                        <p>
                                            <?= $data["cld_learning_outcome"] ?>
                                        </p>
                                    </div>-->
                                </div>

                                <!-- More details -->
                                <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                    <!-- ep intended learners -->

                                    <!-- ep skill achieved -->
                                    <div class="mb-4">
                                        <h3 class="mb-3">Skill Achieved</h3>
                                        <p>
                                            <?= $rows->ep_skills_achieve; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ep sidebar info. -->
                <div class="col-lg-4 col-md-12 col-12 mt-lg-n22">
                    <!-- Card -->
                    <div class="card mb-3 mb-4">
                        <div class="p-1">

                            <img src="../assets/images/course/<?= $rows->ep_cover_attachment; ?>" class="card-img-top rounded-top-md" alt="" height="300">
                            <a class="popup-youtube icon-shape rounded-circle btn-play icon-xl text-decoration-none fade">
                                <i class="fe fe-play"></i>
                            </a>

                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Price single page -->
                            <div class="mb-3">

                                <!--- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-currency-dollar text-success" viewBox="0 0 16 16">
														<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                                                        
                                                                                            
														</svg>--->

                                <span class="text-dark fw-bold h2"> <?php if ($rows->eepsu_ep_id == $ep_id && $rows->eepsu_student_university_id == $suID) { ?>
                                        <!-- <p class="text-dark mb-0 fw-semi-bold">RM <?php #echo floatval($rows->ep_fee / 100); ?></p> -->
                                        <br>
                                        <div class="d-flex align-items-center">
                                            <a class="btn btn-warning me-2 w-100" href="ep-view-enrolled.php?ep_id=<?php echo $ep_id; ?>">
                                                Go To course</a>


                                        <?php } elseif ($rows->empoloyability_program_id == $ep_id) { ?>
                                            <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->ep_fee / 100); ?></p>
                                            <br>
                                            <div id="addtocart" class="d-flex align-items-center">
                                                <a class="btn btn-warning me-2 w-100" href="cart-checkout.php">
                                                    Go To Checkout Page</a>
                                            <?php } elseif ($rows->ep_fee_status  == 'free') { ?>
                                                <p class="text-success mb-0 fw-semi-bold"><?php echo "Free"; ?></p>
                                       
                                                <br>
                                                <div id="addtocart" class="d-flex align-items-center">
                                                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="userId" value=" <?php echo $suID ?>" required>
                                                        <input type="hidden" name="employability_program_id" value=" <?php echo $ep_id ?>" required>
                                                        <!-- <a href="#" class="btn btn-primary mb-2  ">Start Free Month</a> -->
                                                        <button class="btn btn-primary mx-5 px-5 w-100" name="EnrollNow">Enroll Now</button>

                                                        
                                                    </form>
                                                <?php } else { ?>

                                                    <br>

                                                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="userId" value=" <?php echo $suID ?>" required>
                                                        <input type="hidden" name="employability_program_id" value=" <?php echo $ep_id ?>" required>
                                                        <?php $str = rand();
                                                                        $result = md5($str);
                                                                        $ep_cost = floatval($rows->ep_fee / 100)
                                                        ?>
                                                        <input type="hidden" name="token" value=" <?php echo $result; ?>" required>
                                                        <input type="hidden" name="cost" value=" <?php echo $ep_cost ?>" required>
                                                        <input type="hidden" name="subtotal" value=" <?php echo $ep_cost ?>" required>

                                                        <p class="text-success bold mb-0 fw-semi-bold">RM <span class="text-black"> <?php echo floatval($rows->ep_fee / 100); ?></span></p>
                                                        <br>
                                                        <button class="btn btn-primary me-2 w-100" name="AddTocart">
                                                            Buy Now</button>
                                                    </form>

                                                <?php } ?>
                                </span>
                                <!-- <del class="fs-4 text-muted">$750</del> -->
                            </div>




                            <!-- <button type="button" class="btn btn-primary me-2 w-100 <?= $disabledEnroll ?>" data-id="<?= $data["ep_id"] ?>" data-type="c" data-function="buynow">Enroll Now</button> -->
                            <!-- <button type="button" class="btn btn-warning btn-icon <?= $disabledEnroll ?>"  data-id="<?= $data["ep_id"] ?>" data-type="c" data-function="addtocart"
                                    data-bs-toggle="tooltip" data-placement="top" title="Add to Cart">
                                    <i class="fe fe-shopping-cart fs-4"></i>
                                </button> -->
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
                                Notes
                            </li>
                            <li class="list-group-item bg-transparent border-bottom-0">
                                <i class="fe fe-clock align-middle me-2 text-warning"></i>
                                Lifetime access
                            </li>
                            <li class="list-group-item bg-transparent border-bottom-0">
                                <i class="mdi mdi-help-circle align-middle me-2 text-info"></i> Quiz


                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ep owner info -->

                <div class="card mb-4">
                    <div class="row align-items-center mb-1 g-1 mt-1 ">
                        <div class="col-auto">
                            <?php

                                if ($rows->institution_logo != NULL) {
                                    $ProfilePic = '../assets/images/avatar/' . $rows->institution_logo;
                                } else {
                                    $ProfilePic = '../assets/images/avatar/university_default.jpg';
                                }
                            ?>
                            <img src="<?php echo $ProfilePic; ?>" alt="" class="rounded-circle avatar-sm me-3">
                        </div>
                        <div class="col lh-1">
                            <b class="mb-1"><?php echo $rows->institution_address; ?></b>
                            <h5 class="mb-1 "><?php echo $rows->institution_email; ?></h5>
                        </div>

                    </div> <?php }
                        } ?>
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