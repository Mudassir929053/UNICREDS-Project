<!DOCTYPE html>
<html lang="en">


<?php

include 'pages-head.php';
include '../database/dbcon.php';
include('admin-function.php');
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'dashboard';
        include 'pages-sidebar.php';
        ?>

        <!-- Page Content -->
        <div id="page-content">

            <?php
            include 'pages-header.php';
            $admin_id = $_SESSION['sess_adminid'];
            ?>

            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h1 class="mb-0 h2 fw-bold">Dashboard</h1>
                            </div>
                            <div class="d-flex">
                                <!-- <div class="input-group me-3  ">
    <input class="form-control flatpickr" type="text" placeholder="Select Date" aria-describedby="basic-addon2">

    <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

    </div>
    <a href="#" class="btn btn-primary">Setting</a> -->
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Institution</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/nobciafz.json" trigger="loop" delay="5000" colors="primary:#121331,secondary:#08a88a" style="width:40px;height:40px">
                                                    </lord-icon>
                                                    <!-- <span class="fas fa-user-check fs-3 text-primary"></span> -->
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                786 &nbsp;<span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
                                                <i class="fas fa-registered text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+200</span>
                                            <span class="ms-1 fw-medium">Instructor</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Industry</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop" delay="5000" colors="primary:#121331,secondary:#08a88a" style="width:40px;height:40px">
                                                    </lord-icon>
                                                    <!-- <span class=" fas fa-users fs-3 text-primary"></span> -->
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                2,456 &nbsp;<span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
                                                <i class="fas fa-registered text-success"></i>


                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+1200</span>
                                            <span class="ms-1 fw-medium">Students</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Students</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop" delay="5000" colors="primary:#121331,secondary:#08a88a" style="width:40px;height:40px">
                                                    </lord-icon>
                                                    <!-- <span class=" fas fa-users fs-3 text-primary"></span> -->
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                2,456 &nbsp;<span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
                                                <i class="fas fa-registered text-success"></i>


                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+1200</span>
                                            <span class="ms-1 fw-medium">Students</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Instructor</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/nobciafz.json" trigger="loop" delay="5000" colors="primary:#121331,secondary:#08a88a" style="width:40px;height:40px">
                                                    </lord-icon>
                                                    <!-- <span class="fas fa-user-check fs-3 text-primary"></span> -->
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                786 &nbsp;<span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
                                                <i class="fas fa-registered text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+200</span>
                                            <span class="ms-1 fw-medium">Instructor</span>
                                        </div>
                                    </div>
                                </div>

         
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Micro-Credential</span>
                                                </div>
                                                <div>
                                                    <!-- <span class=" fas fa-book fs-3 text-info"></span> -->
                                                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop" delay="2000" colors="primary:#gray-900,secondary:#0d6efd" style="width:40px;height:40px">
                                                    </lord-icon>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                27 &nbsp;<span class="fw-bold mb-1 text-success fs-3"> PUBLISHED </span>&nbsp;
                                                <i class="far fa-check-circle text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+35</span>
                                            <span class="ms-1 fw-medium">Number of approved</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Courses</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/wxnxiano.json" trigger="loop" delay="2500" colors="primary:#121331,secondary:#ffc107" style="width:40px;height:40px">
                                                    </lord-icon>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                71 &nbsp;<span class="fw-bold mb-1 text-success fs-3"> PUBLISHED </span>&nbsp;
                                                <i class="far fa-check-circle text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+21</span>
                                            <span class="ms-1 fw-medium">Number of approved</span>
                                        </div>
                                    </div>
                                </div>





                            </div>


                        </div>
                    </div>




                </div>
            </div>





        </div>
    </div>


    <script>
        $(document).ready(function() {
            $(".toast").toast('show');
        });
    </script>


    <!-- clipboard -->


    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/libs/fullcalendar/main.js"></script>

</body>

</html>