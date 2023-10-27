<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];
$course_id = $_GET['cid'];
?>


<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'course';
        include('pages-sidebar.php');
        ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';
            ?>
            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">

                        <!-- Page header-->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <h1 class="mb-1 h2 fw-bold">Employability Program Information</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="pages-employability-program.php">Employability Program Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <!-- <a class="btn btn-info waves-effect waves-light btn-sm shadow" href="pages-course-forum.php?cid=<?php echo $course_id; ?>">
                                <i class="mdi mdi-comment-outline fs-5 me-1"></i>Forum</a> -->
                                <a class="btn btn-info waves-effect waves-light btn-sm shadow" href="pages-employability-program-edit.php?cid=<?php echo $course_id; ?>">
                                    <i class="fe fe-edit fs-5 me-1"></i>Edit</a>
                                <a class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" href="pages-employability-program-content.php?cid=<?php echo $course_id; ?>">
                                    <i class="fe fe-folder-plus fs-5 me-1"></i> Add Content </a>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-employability-program.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>

                    </div>
                    <?php
                    $querycourse = $conn->query("SELECT * FROM employability_program 
                                            LEFT JOIN user ON course_created_by = user.user_id
                                            LEFT JOIN admin ON admin.admin_user_id = user.user_id 
                                            WHERE ep_id = '$course_id' AND course_deleted_date IS NULL;");

                    $num = 1;
                    if (mysqli_num_rows($querycourse) > 0) {
                        while ($rows = mysqli_fetch_object($querycourse)) {
                    ?>

                            <div class="col-lg-3 col-md-4 col-12">
                                <!-- Card -->
                                <div class="card mb-4 shadow-lg ">

                                    <img src="../assets/images/employability_program/epthumbnails/<?php echo $rows->ep_cover_attachment; ?>" class="card-img-top rounded-top-md" alt="" height="300">

                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col lh-1">
                                                <span class="fs-4 mb-2 fw-semi-bold d-block text-dark-primary"><?php echo $rows->ep_title; ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <span style="vertical-align: middle;" class="<?php if ($rows->ep_publish == 'Published') {
                                                                                                    echo "badge bg-success";
                                                                                                } else {
                                                                                                    echo "badge bg-warning";
                                                                                                } ?>"><?php echo $rows->ep_publish; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock text-info fs-4"></i>
                                                <div class="ms-2">
                                                    <h5 class="mb-0 text-body">Duration</h5>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div>
                                                    <p class="text-dark mb-0 fw-semi-bold"><?php #echo $rows->course_duration; 
                                                                                            ?></p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar text-success" viewBox="0 0 16 16">
                                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                                                </svg>
                                                <div class="ms-2">
                                                    <h5 class="mb-0 text-body">Cost</h5>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div>
                                                    <?php if ($rows->ep_fee == 'Free' || $rows->ep_fee == 'free' || $rows->ep_fee == 'FREE') { ?>
                                                        <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->ep_fee; ?></p>
                                                    <?php } else { ?>
                                                        <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->ep_fee / 100); ?></p>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>


                                        <?php

                                        ?>



                                        <?php {
                                        }
                                        ?>



                                        <hr>
                                        <div class="row align-items-center g-0 mt-1 ">
                                            <div class="col-auto">
                                                <?php

                                                if ($rows->admin_logo != NULL) {
                                                    $ProfilePic = '../assets/images/avatar/' . $rows->admin_logo;
                                                } else {
                                                    $ProfilePic = '../assets/images/avatar/university_default.jpg';
                                                }
                                                ?>
                                                <img src="<?php echo $ProfilePic; ?>" alt="" class="rounded-circle avatar-sm me-3">
                                            </div>
                                            <div class="col lh-1">
                                                <h5 class="mb-1"><?php echo $rows->admin_name; ?></h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                                <!-- Card -->
                                <div class="card mb-4 shadow-lg">

                                    <div class="card-body">

                                        <h4>
                                            About Course
                                        </h4>
                                        <hr>


                                        <!-- Accordion flush -->

                                        <div class="accordion accordion-flush " id="accordionFlushExample">






                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Specific skills/competencies that participants will be able to achieve</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->ep_skills_achieve; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsevideo" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Employability Program Intro video</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapsevideo" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <video width="100%" controls>
                                                            <source src="../assets/attachment/employability_program/epintrovideos/<?php  echo $rows->ep_introvideo; ?>">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                </div>

                            </div>


                </div>
            </div>


            <!-- Page Content -->

        <?php
                        }
                    } else {
        ?>
    <?php
                    }
    ?>

        </div>
    </div>



    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>


    <script>

    </script>
</body>

</html>