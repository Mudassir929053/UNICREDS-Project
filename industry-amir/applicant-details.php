<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php'); ?>
<?php include 'pages-head.php'; ?>

<?php
$job_id = $_GET['job_id'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'job_application';
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
                                <h1 class="mb-0 h2 fw-bold">Candidate Application</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Jobs</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Candidate Application</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Applicant Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="candidate-application.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="">
                    <div class="row">
                        <!-- basic table -->
                        <div class="col-md-12 col-12 mb-5">
                            <div class="card shadow">
                                <!-- card header  -->

                                <!-- table  -->
                                <div class="card-body">
                                    <table id="dataTableBasic1" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                        <thead class="bg-primary text-white">
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
                                            $queryJob = $conn->query("SELECT * FROM job_student_university_application
                                                                      LEFT JOIN student_university ON jsua_student_university_id = student_university.su_id  
                                                                      LEFT JOIN job ON jsua_job_id = job.job_id 
                                                                      WHERE jsua_job_id = '$job_id';");

                                            $num = 1;
                                            if (mysqli_num_rows($queryJob) > 0) {
                                                while ($rows = mysqli_fetch_object($queryJob)) {
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
                                                                                    while ($rows = mysqli_fetch_object($querystudentExp)) {

                                                                                ?>

                                                                                        <tbody>

                                                                                            <tr>
                                                                                                <td class="text-center"><?php echo $num++; ?></td>
                                                                                                <td><?php echo $rows->sued_language_name; ?></td>
                                                                                                <td><?php echo $rows->sued_com_name; ?></td>
                                                                                                <td><?php echo date('j/m/Y', strtotime($rows->sued_job_start_date)); ?></td>
                                                                                                <?php if ($rows->sued_com_status == "Past") { ?>
                                                                                                    <td><?php echo date('j/m/Y', strtotime($rows->sued_job_end_date)); ?></td>
                                                                                                <?php } else { ?>
                                                                                                    <td><?php echo $rows->sued_com_status ?></td>
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
                                                                                        <th scope="col">#</th>
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
                                                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"> <i class="fe fe-more-vertical"></i></a>
                                                                <span class="dropdown-menu" aria-labelledby="courseDropdown">
                                                                    <span class="dropdown-header">Action</span>
                                                                    <a class="dropdown-item" href="assign_test.php?job_id=<?php echo $rows->job_id; ?>&su_id=<?php echo $rows->su_id; ?>">Assign test</a>
                                                                    <a class="dropdown-item" href="industry-function.php?interview=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id; ?>">Invite for interview</a>
                                                                    <a class="dropdown-item" href="industry-function.php?kiv=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id; ?>">Keep in view</a>
                                                                    <a class="dropdown-item" href="industry-function.php?reject=<?php echo $rows->jsua_id; ?>&job_id=<?php echo $job_id; ?>&su_id=<?php echo $su_id; ?>">Reject Applicant</a>
                                                                    <!-- <a class="dropdown-item" href="#">View Content</a> -->
                                                                </span> </span>
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
    <!--Script-->
    <script>
        $(document).ready(function() {
            $('#dataTableBasic1').dataTable();
        });
    </script>
    <!-- Libs JS -->





    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>