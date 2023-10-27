<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php'); ?>
<?php
include 'pages-head.php';
?>

<?php
$job_id = $_GET['job_id'];

@$tab_type = $_SESSION['tab_type'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'job_advertisement';
        include 'pages-sidebar.php';
        ?>

        <!-- Page Content -->
        <div id="page-content">

            <?php
            include 'pages-header.php';
            $industry_id = $_SESSION['sess_industryid'];
            ?>


            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h1 class="mb-0 h2 fw-bold">Job Advertisement</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Jobs</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Job Advertisement</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Job Advertisement Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="job-advertisement.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                $queryJobDetails = $conn->query("SELECT * FROM job
                                          LEFT JOIN industry ON job_industry_id = industry.industry_id
                                          LEFT JOIN state ON industry.industry_state_id = state.state_id 
                                          LEFT JOIN industry_information ON industry.industry_id = industry_information.ii_industry_id
                                          LEFT JOIN job_category ON job_category_id = job_category.jc_id
                                          WHERE job_id = '$job_id' AND job_industry_id = '$industry_id';");

                $num = 1;
                if (mysqli_num_rows($queryJobDetails) > 0) {
                    while ($rows = mysqli_fetch_object($queryJobDetails)) {

                ?>
                        <div class="row">
                            <div class="col-xl-5 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h4 class="mb-0">Job Details</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="px-6 mb-3">

                                            <div class="mb-3">
                                                <h1 class="mb-0 fw-bold"><?php echo $rows->job_title; ?></h1>
                                                <h3 class="mb-0 mt-2"><?php echo $rows->industry_name; ?></h3>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-6">
                                                <div>
                                                    <p class="mb-1 fw-medium">
                                                        <i class="fe fe-map-pin me-1 text-success" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>
                                                        <?php echo $rows->industry_city_id; ?>, <?php echo $rows->state_name;  ?>
                                                    </p>
                                                    <p class="mb-1 fw-medium">
                                                        <i class="fe fe-dollar-sign me-1 text-info" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>
                                                        <?php $job_sal = salary($rows->job_min_salary, $rows->job_max_salary); ?>
                                                        <?php echo $job_sal; ?>
                                                    </p>
                                                    <p class="mb-1 fw-medium">
                                                        <i class="fe fe-book me-1 text-primary" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>
                                                        <?php echo $rows->job_type;  ?>
                                                    </p>
                                                    <p class="mb-0 fw-medium">
                                                        <i class="fe fe-zoom-in me-1 text-warning" data-bs-toggle="tooltip" data-placement="top" title="Vacancy"></i>
                                                        <?php if ($rows->job_no_of_vacancies <= '1') { ?>
                                                            <?php echo $rows->job_no_of_vacancies;  ?> vacancy
                                                        <?php } else { ?>
                                                            <?php echo $rows->job_no_of_vacancies;  ?> vacancies
                                                        <?php } ?>
                                                    </p>
                                                </div>
                                                <div>

                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-7 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0 mx-auto">
                                <div class="card">
                                    <!-- <div class="card-header border-bottom">
                                        <h4 class="mb-0">Company Details</h4>
                                    </div> -->
                                    <div class="card-body">
                                        <div class="px-6 mb-3">

                                            <div class="mb-5">
                                                <h3>Job Details</h3>
                                                <div class="accordion mt-2" id="accordionExample1">
                                                    <div class="card border rounded shadow-sm">
                                                        <div class="card-header rounded" id="headingOne">
                                                            <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <div class="me-auto">
                                                                    <h4 class="mb-0">Job Descriptions</h4>
                                                                </div>
                                                                <span class="chevron-arrow ms-4">
                                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                                                            <div class="card-body text-body">
                                                                <?php echo $rows->job_description;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mb-5 row">
                                                <h3>Additional Information</h3>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                    <div class="mb-3">
                                                        <h4 class="mb-1 text-body">Career Level</h4>
                                                        <span class="text-dark fs-5"><?php echo $rows->job_level;  ?> </span>
                                                    </div>
                                                    <div class="mb-1">
                                                        <h4 class="mb-1 text-body">Years of Experience</h4>
                                                        <span class="text-dark fs-5"><?php echo $rows->job_experience_year;  ?> </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                    <div class="mb-3">
                                                        <h4 class="mb-1 text-body">Job Category</h4>
                                                        <span class="text-dark fs-5"><?php echo $rows->jc_name;  ?></span>
                                                    </div>
                                                    <div class="mb-1">
                                                        <h4 class="mb-1 text-body">Qualifications</h4>
                                                        <span class="text-dark fs-5"><?php echo $rows->job_qualification;  ?> </span>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php }
                } else {
                    ?>
                <?php
                } ?>


                <div class="row mt-3">
                    <!-- basic table -->
                    <div class="col-md-12 col-12 mb-5">
                        <div class="card shadow">
                            <!-- card header  -->
                            <div class="card-header border-bottom-0 p-0 bg-white">
                                <div>
                                    <!-- Nav -->
                                    <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                        <?php $queryJobPending = $conn->query("SELECT * FROM job_student_university_application
                                                                      LEFT JOIN student_university ON jsua_student_university_id = student_university.su_id  
                                                                      LEFT JOIN job ON jsua_job_id = job.job_id 
                                                                      WHERE jsua_job_id = '$job_id' AND jsua_status = 'Pending'
                                                                      ORDER BY jsua_application_date DESC;"); ?>

                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($tab_type == "Pending") {
                                                                    echo "active";
                                                                } else if ($tab_type == NULL) {
                                                                    echo "active";
                                                                } ?>" id="processing-tab" data-bs-toggle="pill" href="#processing" role="tab" aria-controls="processing">Processing

                                                <?php if (mysqli_num_rows($queryJobPending) > 0) { ?>
                                                    <span class="badge rounded-pill bg-secondary text-white shadow position-absolute mt-n1 ms-1"><?php echo mysqli_num_rows($queryJobPending); ?></span>
                                                <?php } else {
                                                } ?>
                                            </a>
                                        </li>
                                        <?php $queryJobInterview = $conn->query("SELECT * FROM job_student_university_application
                                                                      LEFT JOIN student_university ON jsua_student_university_id = student_university.su_id  
                                                                      LEFT JOIN job ON jsua_job_id = job.job_id 
                                                                      WHERE jsua_job_id = '$job_id' AND jsua_status = 'Invite for interview'
                                                                      ORDER BY jsua_application_date DESC;"); ?>


                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($tab_type == "Invite for interview") { echo "active"; }?>" id="appointment-tab" data-bs-toggle="pill" href="#appointment" role="tab" aria-controls="appointment">Appointment

                                                <?php if (mysqli_num_rows($queryJobInterview) > 0) { ?>
                                                    <span class="badge rounded-pill bg-success text-white shadow position-absolute mt-n1 ms-1"><?php echo mysqli_num_rows($queryJobInterview); ?></span>
                                                <?php } else {
                                                } ?>

                                            </a>
                                        </li>

                                        <?php $queryJobKiv = $conn->query("SELECT * FROM job_student_university_application
                                                                      LEFT JOIN student_university ON jsua_student_university_id = student_university.su_id  
                                                                      LEFT JOIN job ON jsua_job_id = job.job_id 
                                                                      WHERE jsua_job_id = '$job_id' AND jsua_status = 'KIV'
                                                                      ORDER BY jsua_application_date DESC;"); ?>

                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($tab_type == "KIV") { echo "active"; }?>" id="kiv-tab" data-bs-toggle="pill" href="#kiv" role="tab" aria-controls="kiv">Keep in View
                                                <?php if (mysqli_num_rows($queryJobKiv) > 0) { ?>
                                                    <span class="badge rounded-pill bg-warning text-white shadow position-absolute mt-n1 ms-1"><?php echo mysqli_num_rows($queryJobKiv); ?></span>
                                                <?php } else {
                                                } ?>
                                            </a>
                                        </li>

                                        <?php $queryJobRejected = $conn->query("SELECT * FROM job_student_university_application
                                                                      LEFT JOIN student_university ON jsua_student_university_id = student_university.su_id  
                                                                      LEFT JOIN job ON jsua_job_id = job.job_id 
                                                                      WHERE jsua_job_id = '$job_id' AND jsua_status = 'Rejected'
                                                                      ORDER BY jsua_application_date DESC;"); ?>

                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($tab_type == "Rejected") { echo "active"; }?>" id="rejected-tab" data-bs-toggle="pill" href="#rejected" role="tab" aria-controls="rejected">Rejected
                                                <?php if (mysqli_num_rows($queryJobRejected) > 0) { ?>
                                                    <span class="badge rounded-pill bg-danger text-white shadow position-absolute mt-n1 ms-1"><?php echo mysqli_num_rows($queryJobRejected); ?></span>
                                                <?php } else {
                                                } ?>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- table  -->

                            <div class="tab-content" id="tabContent">

                                <div class="tab-pane <?php if ($tab_type == "Pending") { echo "active"; } else if ($tab_type == NULL) { echo "active"; } ?>" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTableBasic1" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                                <thead class="bg-gradient bg-light-secondary text-dark">

                                                    <tr class="text-center">
                                                        <th scope="col" class="border-0" width="10px">No.</th>
                                                        <th scope="col" class="border-0" width="200px">Name</th>
                                                        <th scope="col" class="border-0">Phone</th>
                                                        <th scope="col" class="border-0">Emails</th>
                                                        <th scope="col" class="border-0">Date Applied</th>
                                                        <th scope="col" class="border-0" width="450px">Profile</th>
                                                        <th scope="col" class="border-0" width="10px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="align-middle">
                                                    <?php

                                                    $num = 1;
                                                    if (mysqli_num_rows($queryJobPending) > 0) {
                                                        while ($rows = mysqli_fetch_object($queryJobPending)) {
                                                            $job_id = $rows->job_id;
                                                            $su_id = $rows->su_id;
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $num++; ?></td>
                                                                <td><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_email; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_contact_no; ?></td>
                                                                <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->jsua_application_date)); ?></td>

                                                                <td class="text-center ">
                                                                    <!-- View pitch -->
                                                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#viewpitchModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View Pitch
                                                                    </button>
                                                                    <!-- View pitch modal -->
                                                                    <div class="modal fade" id="viewpitchModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4">Pitch</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?php echo $rows->jsua_summary; ?>
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View pitch modal -->

                                                                    <!-- View CV -->
                                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewCVModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View CV
                                                                    </button>
                                                                    <!-- View CV modal -->
                                                                    <div class="modal fade" id="viewCVModal" tabindex="-1" role="dialog" aria-labelledby="manageCVModalTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="manageCVModalTitle">Curriculum Vitae</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed src="../assets/attachment/student/<?php echo $rows->su_id; ?>/cv/<?php echo $rows->su_cv; ?>" frameborder="0" width="1000px" height="800px">
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View CV modal -->

                                                                    <!-- View Experience -->
                                                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewExp">
                                                                        View Experience
                                                                    </button>
                                                                    <!-- View experience modal -->
                                                                    <div class="modal fade" id="viewExp" tabindex="-1" role="dialog" aria-labelledby="viewExpTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Experiences List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">


                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Job Title</th>
                                                                                                <th scope="col">Company Name</th>
                                                                                                <th scope="col">Start Date</th>
                                                                                                <th scope="col">End Date</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentExp = $conn->query("SELECT * FROM student_university_experience_details
                                                                                        LEFT JOIN student_university ON sued_student_university_id = student_university.su_id  
                                                                                        WHERE sued_student_university_id  = '$su_id'
                                                                                        ORDER BY sued_job_end_date;");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentExp) > 0) {
                                                                                            while ($rowsexp = mysqli_fetch_object($querystudentExp)) {

                                                                                        ?>

                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_language_name; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_com_name; ?></td>
                                                                                                        <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_job_start_date)); ?></td>
                                                                                                        <?php if ($rowsexp->sued_com_status == "Past") { ?>
                                                                                                            <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_job_end_date)); ?></td>
                                                                                                        <?php } else { ?>
                                                                                                            <td><?php echo $rowsexp->sued_com_status ?></td>
                                                                                                        <?php } ?>
                                                                                                    </tr>

                                                                                                </tbody>

                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any experience.</h2>
                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View experience modal -->

                                                                    <!-- View Skills -->
                                                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewSkill">View Skill Set</button>
                                                                    <!-- View skills modal -->
                                                                    <div class="modal fade" id="viewSkill" tabindex="-1" role="dialog" aria-labelledby="viewSkillTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Skills List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Skill Name</th>
                                                                                                <th scope="col">Proficiency</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentSkill = $conn->query("SELECT * FROM student_university_skill_set
                                                                                                      LEFT JOIN student_university ON sus_student_university_id = student_university.su_id 
                                                                                                      LEFT JOIN skill_type ON sus_skill_type_id =  skill_type.skill_id       
                                                                                                      WHERE sus_student_university_id  = '$su_id';");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentSkill) > 0) {
                                                                                            while ($row = mysqli_fetch_object($querystudentSkill)) {

                                                                                        ?>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $row->skill_name; ?></td>
                                                                                                        <td><?php echo $row->sus_skill_level; ?></td>
                                                                                                    </tr>

                                                                                                </tbody>
                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any skills.</h2>

                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                    <span class="dropdown dropstart">
                                                                        <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                            <i class="fe fe-more-vertical"></i></a>
                                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                            <a class="dropdown-item" href="industry-function.php?interview=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Invite for interview</a>
                                                                            <a class="dropdown-item" href="industry-function.php?kiv=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Keep in view</a>
                                                                            <a class="dropdown-item" href="industry-function.php?reject=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Reject Applicant</a>
                                                                            <!-- <a class="dropdown-item" href="#">View Content</a> -->
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                            </tr>


                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane <?php if ($tab_type == "Invite for interview") { echo "active"; }?>" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTableBasic2" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                                <thead class="bg-gradient bg-light-info text-dark">
                                                    <tr class="text-center">
                                                        <th scope="col" class="border-0" width="10px">No.</th>
                                                        <th scope="col" class="border-0" width="200px">Name</th>
                                                        <th scope="col" class="border-0">Phone</th>
                                                        <th scope="col" class="border-0">Emails</th>
                                                        <th scope="col" class="border-0">Date Applied</th>
                                                        <th scope="col" class="border-0" width="450px">Profile</th>
                                                        <th scope="col" class="border-0" width="10px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="align-middle">
                                                    <?php

                                                    $num = 1;
                                                    if (mysqli_num_rows($queryJobInterview) > 0) {
                                                        while ($rows = mysqli_fetch_object($queryJobInterview)) {
                                                            $job_id = $rows->job_id;
                                                            $su_id = $rows->su_id;
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $num++; ?></td>
                                                                <td><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_email; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_contact_no; ?></td>
                                                                <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->jsua_application_date)); ?></td>

                                                                <td class="text-center ">
                                                                    <!-- View pitch -->
                                                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#viewpitchModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View Pitch
                                                                    </button>
                                                                    <!-- View pitch modal -->
                                                                    <div class="modal fade" id="viewpitchModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4">Pitch</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?php echo $rows->jsua_summary; ?>
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View pitch modal -->

                                                                    <!-- View CV -->
                                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewCVModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View CV
                                                                    </button>
                                                                    <!-- View CV modal -->
                                                                    <div class="modal fade" id="viewCVModal" tabindex="-1" role="dialog" aria-labelledby="manageCVModalTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="manageCVModalTitle">Curriculum Vitae</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed src="../assets/attachment/student/<?php echo $rows->su_id; ?>/cv/<?php echo $rows->su_cv; ?>" frameborder="0" width="1000px" height="800px">
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View CV modal -->

                                                                    <!-- View Experience -->
                                                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewExp">
                                                                        View Experience
                                                                    </button>
                                                                    <!-- View experience modal -->
                                                                    <div class="modal fade" id="viewExp" tabindex="-1" role="dialog" aria-labelledby="viewExpTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Experiences List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">


                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Job Title</th>
                                                                                                <th scope="col">Company Name</th>
                                                                                                <th scope="col">Start Date</th>
                                                                                                <th scope="col">End Date</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentExp = $conn->query("SELECT * FROM student_university_experience_details
                                                                                                      LEFT JOIN student_university ON sued_student_university_id = student_university.su_id  
                                                                                                      WHERE sued_student_university_id  = '$su_id'
                                                                                                      ORDER BY sued_end_date;");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentExp) > 0) {
                                                                                            while ($rowsexp = mysqli_fetch_object($querystudentExp)) {

                                                                                        ?>

                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_job_title; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_company_name; ?></td>
                                                                                                        <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_start_date)); ?></td>
                                                                                                        <?php if ($rowsexp->sued_job_status == "Past") { ?>
                                                                                                            <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_end_date)); ?></td>
                                                                                                        <?php } else { ?>
                                                                                                            <td><?php echo $rowsexp->sued_job_status ?></td>
                                                                                                        <?php } ?>
                                                                                                    </tr>

                                                                                                </tbody>

                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any experience.</h2>
                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View experience modal -->

                                                                    <!-- View Skills -->
                                                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewSkill">View Skill Set</button>
                                                                    <!-- View skills modal -->
                                                                    <div class="modal fade" id="viewSkill" tabindex="-1" role="dialog" aria-labelledby="viewSkillTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Skills List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Skill Name</th>
                                                                                                <th scope="col">Proficiency</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentSkill = $conn->query("SELECT * FROM student_university_skill_set
                                                                                                      LEFT JOIN student_university ON sus_student_university_id = student_university.su_id 
                                                                                                      LEFT JOIN skill_type ON sus_skill_type_id =  skill_type.skill_id       
                                                                                                      WHERE sus_student_university_id  = '$su_id';");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentSkill) > 0) {
                                                                                            while ($row = mysqli_fetch_object($querystudentSkill)) {

                                                                                        ?>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $row->skill_name; ?></td>
                                                                                                        <td><?php echo $row->sus_skill_level; ?></td>
                                                                                                    </tr>

                                                                                                </tbody>
                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any skills.</h2>

                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                    <span class="dropdown dropstart">
                                                                        <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                            <i class="fe fe-more-vertical"></i></a>
                                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                            <a class="dropdown-item" href="industry-function.php?remove_appt=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Remove from appointment</a>
                                                                            <a class="dropdown-item" href="industry-function.php?kiv=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Keep in view</a>
                                                                            <a class="dropdown-item" href="industry-function.php?reject=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Reject Applicant</a>
                                                                            <!-- <a class="dropdown-item" href="#">View Content</a> -->
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                            </tr>


                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane <?php if ($tab_type == "KIV") { echo "active"; }?>" id="kiv" role="tabpanel" aria-labelledby="kiv-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTableBasic3" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                                <thead class="bg-gradient bg-light-warning text-dark">
                                                    <tr class="text-center">
                                                        <th scope="col" class="border-0" width="10px">No.</th>
                                                        <th scope="col" class="border-0" width="200px">Name</th>
                                                        <th scope="col" class="border-0">Phone</th>
                                                        <th scope="col" class="border-0">Emails</th>
                                                        <th scope="col" class="border-0">Date Applied</th>
                                                        <th scope="col" class="border-0" width="450px">Profile</th>
                                                        <th scope="col" class="border-0" width="10px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="align-middle">
                                                    <?php

                                                    $num = 1;
                                                    if (mysqli_num_rows($queryJobKiv) > 0) {
                                                        while ($rows = mysqli_fetch_object($queryJobKiv)) {
                                                            $job_id = $rows->job_id;
                                                            $su_id = $rows->su_id;
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $num++; ?></td>
                                                                <td><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_email; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_contact_no; ?></td>
                                                                <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->jsua_application_date)); ?></td>

                                                                <td class="text-center ">
                                                                    <!-- View pitch -->
                                                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#viewpitchModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View Pitch
                                                                    </button>
                                                                    <!-- View pitch modal -->
                                                                    <div class="modal fade" id="viewpitchModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4">Pitch</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?php echo $rows->jsua_summary; ?>
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View pitch modal -->

                                                                    <!-- View CV -->
                                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewCVModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View CV
                                                                    </button>
                                                                    <!-- View CV modal -->
                                                                    <div class="modal fade" id="viewCVModal" tabindex="-1" role="dialog" aria-labelledby="manageCVModalTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="manageCVModalTitle">Curriculum Vitae</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed src="../assets/attachment/student/<?php echo $rows->su_id; ?>/cv/<?php echo $rows->su_cv; ?>" frameborder="0" width="1000px" height="800px">
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View CV modal -->

                                                                    <!-- View Experience -->
                                                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewExp">
                                                                        View Experience
                                                                    </button>
                                                                    <!-- View experience modal -->
                                                                    <div class="modal fade" id="viewExp" tabindex="-1" role="dialog" aria-labelledby="viewExpTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Experiences List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">


                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Job Title</th>
                                                                                                <th scope="col">Company Name</th>
                                                                                                <th scope="col">Start Date</th>
                                                                                                <th scope="col">End Date</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentExp = $conn->query("SELECT * FROM student_university_experience_details
                                                                                                      LEFT JOIN student_university ON sued_student_university_id = student_university.su_id  
                                                                                                      WHERE sued_student_university_id  = '$su_id'
                                                                                                      ORDER BY sued_end_date;");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentExp) > 0) {
                                                                                            while ($rowsexp = mysqli_fetch_object($querystudentExp)) {

                                                                                        ?>

                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_job_title; ?></td>
                                                                                                        <td><?php echo $rowsexp->sued_company_name; ?></td>
                                                                                                        <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_start_date)); ?></td>
                                                                                                        <?php if ($rowsexp->sued_job_status == "Past") { ?>
                                                                                                            <td><?php echo date('j/m/Y', strtotime($rowsexp->sued_end_date)); ?></td>
                                                                                                        <?php } else { ?>
                                                                                                            <td><?php echo $rowsexp->sued_job_status ?></td>
                                                                                                        <?php } ?>
                                                                                                    </tr>

                                                                                                </tbody>

                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any experience.</h2>
                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View experience modal -->

                                                                    <!-- View Skills -->
                                                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewSkill">View Skill Set</button>
                                                                    <!-- View skills modal -->
                                                                    <div class="modal fade" id="viewSkill" tabindex="-1" role="dialog" aria-labelledby="viewSkillTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Skills List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Skill Name</th>
                                                                                                <th scope="col">Proficiency</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentSkill = $conn->query("SELECT * FROM student_university_skill_set
                                                                                                      LEFT JOIN student_university ON sus_student_university_id = student_university.su_id 
                                                                                                      LEFT JOIN skill_type ON sus_skill_type_id =  skill_type.skill_id       
                                                                                                      WHERE sus_student_university_id  = '$su_id';");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentSkill) > 0) {
                                                                                            while ($row = mysqli_fetch_object($querystudentSkill)) {

                                                                                        ?>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $row->skill_name; ?></td>
                                                                                                        <td><?php echo $row->sus_skill_level; ?></td>
                                                                                                    </tr>

                                                                                                </tbody>
                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any skills.</h2>

                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                    <span class="dropdown dropstart">
                                                                        <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                            <i class="fe fe-more-vertical"></i></a>
                                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                            <a class="dropdown-item" href="industry-function.php?interview=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Invite for interview</a>
                                                                            <a class="dropdown-item" href="industry-function.php?remove_kiv=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Remove from keep in view</a>
                                                                            <a class="dropdown-item" href="industry-function.php?reject=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Reject Applicant</a>
                                                                            <!-- <a class="dropdown-item" href="#">View Content</a> -->
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                            </tr>


                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane <?php if ($tab_type == "Rejected") { echo "active"; }?>" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTableBasic4" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                                <thead class="bg-gradient bg-light-danger text-dark">
                                                    <tr class="text-center">
                                                        <th scope="col" class="border-0" width="10px">No.</th>
                                                        <th scope="col" class="border-0" width="200px">Name</th>
                                                        <th scope="col" class="border-0">Phone</th>
                                                        <th scope="col" class="border-0">Emails</th>
                                                        <th scope="col" class="border-0">Date Applied</th>
                                                        <th scope="col" class="border-0" width="450px">Profile</th>
                                                        <th scope="col" class="border-0" width="10px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="align-middle">
                                                    <?php

                                                    $num = 1;
                                                    if (mysqli_num_rows($queryJobRejected) > 0) {
                                                        while ($rows = mysqli_fetch_object($queryJobRejected)) {
                                                            $job_id = $rows->job_id;
                                                            $su_id = $rows->su_id;
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $num++; ?></td>
                                                                <td><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_email; ?></td>
                                                                <td class="text-center"><?php echo $rows->su_contact_no; ?></td>
                                                                <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->jsua_application_date)); ?></td>

                                                                <td class="text-center ">
                                                                    <!-- View pitch -->
                                                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#viewpitchModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View Pitch
                                                                    </button>
                                                                    <!-- View pitch modal -->
                                                                    <div class="modal fade" id="viewpitchModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4">Pitch</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <?php echo $rows->jsua_summary; ?>
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View pitch modal -->

                                                                    <!-- View CV -->
                                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewCVModal">
                                                                        <!-- <i class="fa fa-search me-1" aria-hidden="true"></i> -->
                                                                        View CV
                                                                    </button>
                                                                    <!-- View CV modal -->
                                                                    <div class="modal fade" id="viewCVModal" tabindex="-1" role="dialog" aria-labelledby="manageCVModalTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="manageCVModalTitle">Curriculum Vitae</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <embed src="../assets/attachment/student/<?php echo $rows->su_id; ?>/cv/<?php echo $rows->su_cv; ?>" frameborder="0" width="1000px" height="800px">
                                                                                </div>

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View CV modal -->

                                                                    <!-- View Experience -->
                                                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewExp">
                                                                        View Experience
                                                                    </button>
                                                                    <!-- View experience modal -->
                                                                    <div class="modal fade" id="viewExp" tabindex="-1" role="dialog" aria-labelledby="viewExpTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Experiences List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">


                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Job Title</th>
                                                                                                <th scope="col">Company Name</th>
                                                                                                <th scope="col">Start Date</th>
                                                                                                <th scope="col">End Date</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentExp = $conn->query("SELECT * FROM student_university_experience_details
                                                                                                      LEFT JOIN student_university ON sued_student_university_id = student_university.su_id  
                                                                                                      WHERE sued_student_university_id  = '$su_id'
                                                                                                      ORDER BY sued_end_date;");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentExp) > 0) {
                                                                                            while ($rowexp = mysqli_fetch_object($querystudentExp)) {

                                                                                        ?>

                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $rowexp->sued_job_title; ?></td>
                                                                                                        <td><?php echo $rowexp->sued_company_name; ?></td>
                                                                                                        <td><?php echo date('j/m/Y', strtotime($rowexp->sued_start_date)); ?></td>
                                                                                                        <?php if ($rowexp->sued_job_status == "Past") { ?>
                                                                                                            <td><?php echo date('j/m/Y', strtotime($rowexp->sued_end_date)); ?></td>
                                                                                                        <?php } else { ?>
                                                                                                            <td><?php echo $rowexp->sued_job_status ?></td>
                                                                                                        <?php } ?>
                                                                                                    </tr>

                                                                                                </tbody>

                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any experience.</h2>
                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- View experience modal -->

                                                                    <!-- View Skills -->
                                                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewSkill">View Skill Set</button>
                                                                    <!-- View skills modal -->
                                                                    <div class="modal fade" id="viewSkill" tabindex="-1" role="dialog" aria-labelledby="viewSkillTitle" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title h4" id="viewExpTitle">Skills List</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">No.</th>
                                                                                                <th scope="col">Skill Name</th>
                                                                                                <th scope="col">Proficiency</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <?php
                                                                                        $querystudentSkill = $conn->query("SELECT * FROM student_university_skill_set
                                                                                                      LEFT JOIN student_university ON sus_student_university_id = student_university.su_id 
                                                                                                      LEFT JOIN skill_type ON sus_skill_type_id =  skill_type.skill_id       
                                                                                                      WHERE sus_student_university_id  = '$su_id';");

                                                                                        $num = 1;
                                                                                        if (mysqli_num_rows($querystudentSkill) > 0) {
                                                                                            while ($row = mysqli_fetch_object($querystudentSkill)) {

                                                                                        ?>
                                                                                                <tbody>

                                                                                                    <tr>
                                                                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                                                                        <td><?php echo $row->skill_name; ?></td>
                                                                                                        <td><?php echo $row->sus_skill_level; ?></td>
                                                                                                    </tr>

                                                                                                </tbody>
                                                                                            <?php }
                                                                                        } else {

                                                                                            ?>
                                                                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <h2>Applicant didn't have any skills.</h2>

                                                                                            </div>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </table>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td class="text-muted px-4 py-3 text-center border-top-0">
                                                                    <span class="dropdown dropstart">
                                                                        <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                            <i class="fe fe-more-vertical"></i></a>
                                                                        <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                                                            <a class="dropdown-item" href="industry-function.php?reinstate=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id;?>">Reinstate</a>
                                                                           
                                                                            <!-- <a class="dropdown-item" href="#">View Content</a> -->
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                            </tr>


                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
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
    </div>
    <!--Script-->
    <script>
        $(document).ready(function() {
            $('#dataTableBasic1').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic2').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic3').dataTable();
        });
        $(document).ready(function() {
            $('#dataTableBasic4').dataTable();
        });
    </script>
    <!-- Libs JS -->





    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>