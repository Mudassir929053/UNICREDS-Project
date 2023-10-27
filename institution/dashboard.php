<!DOCTYPE html>
<html lang="en">


<?php
session_start();
include 'pages-head.php';
include '../database/dbcon.php';

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
            $institution_id = $_SESSION['sess_institutionid'];
            $query = "SELECT institution_user_id  FROM `institution` WHERE institution_id= '$institution_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $institution_user_id = $row['institution_user_id'];
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
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/bg-gradient-green.jpg');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Courses</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/wxnxiano.json" trigger="loop" delay="2500" colors="primary:#121331,secondary:#ffc107" style="width:40px;height:40px"></lord-icon>
                                                </div>
                                            </div>
                                            <?php

                                            // SQL query to count published courses for the specified creator
                                            $query = "SELECT COUNT(*) AS course_count
                                                FROM employability_program
                                                WHERE course_created_by = '$institution_user_id'
                                                AND ep_publish = 'Published'";


                                            // Execute the query
                                            $result = mysqli_query($conn, $query);

                                            // Check if the query was successful
                                            if ($result) {
                                                // Fetch the count value
                                                $row = mysqli_fetch_assoc($result);
                                                $courseCount = $row['course_count'];

                                                // Display the count in the card
                                                echo '<h2 class="fw-bold mb-1">' . $courseCount . ' &nbsp;<span class="fw-bold mb-1 text-success fs-3"> APPROVED </span>&nbsp;<i class="far fa-check-circle text-success"></i></h2>';
                                            } else {
                                                // Handle the query error
                                                echo '<h2 class="fw-bold mb-1">N/A</h2>';
                                            }

                                            // Close the database connection
                                            ?>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+21</span>
                                            <span class="ms-1 fw-medium">Number of approved</span>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                // Execute the SQL query to count published courses for the specified creator
                                $query = "SELECT COUNT(*) AS course_count
                                    FROM employability_program
                                    WHERE course_created_by = '$institution_user_id'
                                    AND ep_publish = 'Draft'";

                                // Execute the query and fetch the result
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $courseCount = $row['course_count'];

                                // Display the count in the HTML code
                                ?>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/bg-gradient-green.jpg');">
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
                                                <?php echo $courseCount; ?>&nbsp;
                                                <span class="fw-bold mb-1 text-danger fs-3"> TO REVIEW </span>&nbsp;
                                                <i class="fas fa-spinner fa-pulse text-secondary"></i>
                                            </h2>
                                            <span class="text-danger fw-semi-bold">12+</span>
                                            <span class="ms-1 fw-medium">Number of pending</span>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                // Execute the SQL query to count students from the specified institution
                                $query = "SELECT COUNT(*) AS student_count
                                            FROM student_university
                                            WHERE su_institution_id = '$institution_id'";

                                // Execute the query and fetch the result
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $studentCount = $row['student_count'];

                                // Display the count in the HTML code
                                ?>
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
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                <?php echo $studentCount; ?>&nbsp;
                                                <span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
                                                <i class="fas fa-registered text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+1200</span>
                                            <span class="ms-1 fw-medium">Students</span>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                // Execute the SQL query to count instructors from the specified institution
                                $query = "SELECT COUNT(*) AS instructor_count
                                        FROM lecturer
                                        WHERE lecturer_institution_id = '$institution_id' AND lecturer_status ='Active'";

                                // Execute the query and fetch the result
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $instructorCount = $row['instructor_count'];

                                // Display the count in the HTML code
                                ?>
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
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                <?php echo $instructorCount; ?>&nbsp;
                                                <span class="fw-bold mb-1 text-info fs-3"> REGISTERED </span>&nbsp;
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
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/bg-blue-gradient.jpg');">
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
                                                27 &nbsp;<span class="fw-bold mb-1 text-success fs-3"> APPROVED </span>&nbsp;
                                                <i class="far fa-check-circle text-success"></i>
                                            </h2>
                                            <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+35</span>
                                            <span class="ms-1 fw-medium">Number of approved</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4" style="background-image: url('../assets/images/background/bg-blue-gradient.jpg');">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-4 text-uppercase fw-semi-bold text-dark">Micro-Credential</span>
                                                </div>
                                                <div>
                                                    <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop" delay="2000" colors="primary:#gray-900,secondary:#0d6efd" style="width:40px;height:40px">
                                                    </lord-icon>

                                                    <!-- <span class=" fas fa-book fs-3 text-info"></span> -->
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                36 &nbsp;<span class="fw-bold mb-1 text-danger fs-3"> TO REVIEW </span>&nbsp;
                                                <i class="fas fa-spinner fa-pulse text-secondary"></i>
                                            </h2>

                                            <span class="text-danger fw-semi-bold">17+</span>
                                            <span class="ms-1 fw-medium">Number of pending</span>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4">
                                        <!-- Card header -->
                                        <div class="card-header">

                                            <h3 class="mb-0">Announcement&nbsp;
                                                <lord-icon src="https://cdn.lordicon.com/fpipqhrr.json" trigger="loop" colors="primary:#000,secondary:#0d6efd" style="width:50px;height:30px">
                                                </lord-icon>
                                            </h3>


                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body" style="height: 500px; overflow-y: auto;">

                                            <?php
                                            $sqlAnnouncement = $conn->query("SELECT *
                                                FROM announcement_admin
                                                LEFT JOIN admin ON admin.admin_id = announcement_admin.announcement_created_by
                                                WHERE announcement_receiver LIKE '%4%'
                                                AND announcement_created_by = '1'
                                                AND DATEDIFF(CURDATE(), announcement_created_date) <= 30
                                                ORDER BY announcement_created_date DESC;");

                                            $num = 1;
                                            if (mysqli_num_rows($sqlAnnouncement) > 0) {
                                                while ($row = mysqli_fetch_object($sqlAnnouncement)) {
                                            ?>


                                                    <div class="toast shadow w-100 mb-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                                        <div class="toast-header bg-light-success">

                                                            <strong class="me-auto"><?php echo $row->announcement_title; ?></strong>

                                                            <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="toast-body " style="height: auto; overflow-y: auto;">
                                                            <?php echo $row->announcement_message; ?>
                                                        </div>

                                                        <div class="toast-footer bg-light-info">
                                                            <div class="d-md-flex justify-content-between align-items-center">
                                                                <div class="ms-2 mb-1 mt-3">
                                                                    <?php $senderName = ucwords(strtolower($row->admin_name)); ?>
                                                                    <h6>By <b><span class="text-success"><?php echo $senderName; ?></span></b></h6>
                                                                    <h6 class="text-warning"><?php echo date('j F Y ', strtotime($row->announcement_created_date)); ?></h6>
                                                                </div>
                                                                <div class="d-flex m-1">
                                                                    <?php

                                                                    if ($row->announcement_attachment != null) {
                                                                    ?>

                                                                        <center><a class="btn btn-info btn-sm btn-rounded" href="../assets/attachment/announcement/<?php echo $row->announcement_attachment; ?>" download title="Download Attachment">
                                                                                <i class="fas fa-download"></i> Download</a></center>
                                                                    <?php
                                                                    } else {
                                                                    ?>

                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                <?php }
                                            } else {
                                                ?>



                                                <div class="alert bg-light-secondary">
                                                    <!-- <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">  </button> -->
                                                    <h3 class="mb-0 "><i class="mdi mdi-sticker-remove"></i>&nbsp;&nbsp;No new announcement.</h3>
                                                </div>
                                            <?php
                                            } ?>
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