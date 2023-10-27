<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php');
?>
<?php
include 'pages-head.php';
include 'pages-header.php';

$industry_id = $_SESSION['sess_industryid'];

$job_id = $_GET['job_id'];
$su_id = $_GET['su_id'];

$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->industry_user_id;
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


            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <h1 class="mb-0 h2 fw-bold">Assign Test</h1>
                                <!-- Breadcrumb -->
                                <!-- <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Jobs</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Candidate Application</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav> -->
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="applicant-details.php?job_id=<?php echo $job_id; ?>">
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
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow " style="width:100%">
                                            <thead class="bg-primary text-white">
                                                <tr class="text-center">
                                                    <th scope="col" class="border-0" width="10px">No.</th>
                                                    <th scope="col" class="border-0">Language Test</th>
                                                    <th scope="col" class="border-0">Skill Assessment Test</th>
                                                    <th scope="col" class="border-0">Psychometric Test</th>
                                                    <th scope="col" class="border-0" width="150px">Assign test</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                <?php
                                                $queryJob = $conn->query("SELECT *
                                            FROM `job_student_university_application` AS jsua
                                            WHERE jsua.jsua_job_id='$job_id' AND jsua.jsua_student_university_id='$su_id' ");

                                                $num = 1;
                                                if (mysqli_num_rows($queryJob) > 0) {
                                                    while ($rows = mysqli_fetch_object($queryJob)) {
                                                        // $job_id = $rows->job_id;
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $num++; ?></td>


                                                            <!-- Start Modal Page Job Desc -->

                                                            <!-- End Modal Page Job Desc -->



                                                            <td class="text-center">

                                                                <select multiple=multiple class="selectpicker" data-width="100%" name="language_test[]">
                                                                    <?php
                                                                    $lang = $conn->query("SELECT * FROM language_test_quiz 
                                                                WHERE language_test_quiz.ltq_created_by=$get_userID AND language_test_quiz.ltq_status='Published'");


                                                                    if (mysqli_num_rows($lang) > 0) {
                                                                        while ($rows = mysqli_fetch_object($lang)) {

                                                                    ?>
                                                                            <option value="<?php echo $rows->ltq_id; ?>"><?php echo $rows->ltq_title; ?> </option>

                                                                        <?php }
                                                                    } else {
                                                                        ?>
                                                                    <?php

                                                                    } ?>

                                                                </select>
                                                            </td>
                                                            <td class="text-center">

                                                                <select multiple=multiple class="selectpicker" data-width="100%" name="skill_assessment_test[]">
                                                                    <?php
                                                                    $skill = $conn->query("SELECT * FROM `skill_assessment_test` 
                                                                WHERE st_created_by=$get_userID AND st_status='Published'");

 
                                                                    if (mysqli_num_rows($skill) > 0) {
                                                                        while ($rows = mysqli_fetch_object($skill)) {

                                                                    ?>
                                                                            <option value="<?php echo $rows->st_id; ?>"><?php echo $rows->st_title; ?> </option>

                                                                    <?php }
                                                                    } else  ?>


                                                                </select>
                                                            </td>



                                                            <td class="text-center">
                                                                <select multiple=multiple class="selectpicker" data-width="100%" name="psychometric_test[]">
                                                                    <?php
                                                                    $ptest = $conn->query("SELECT * FROM psychometric_test
                                                                WHERE pt_created_by=$get_userID AND pt_status='Published'");


                                                                    if (mysqli_num_rows($ptest) > 0) {
                                                                        while ($rows = mysqli_fetch_object($ptest)) {

                                                                    ?>
                                                                            <option value="<?php echo $rows->pt_id; ?>"><?php echo $rows->pt_title; ?> </option>

                                                                        <?php }
                                                                    } else {
                                                                        ?>
                                                                    <?php

                                                                    } ?>



                                                                </select>
                                                            </td>
                                                            <?php
                                                            $assigndisable = $conn->query("SELECT * FROM `assign_test` AS at WHERE at.at_su_id=$su_id AND at.at_job_id=$job_id");
                                                            $assign_count = $assigndisable->num_rows;
                                                            ?>
                                                            <td class="text-center">
                                                                <?php if ($assign_count > 0) { ?>
                                                                    <button type="submit" class="btn btn-success btn-sm" name="assign_test" disabled>
                                                                        <i class="fas fa-user-check"></i> Assigned
                                                                    </button>
                                                                <?php } else { ?>
                                                                    <button type="submit" class="btn btn-success btn-sm" name="assign_test">
                                                                        <i class="fas fa-user-check"></i> Assign
                                                                    </button>
                                                                <?php } ?>

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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>
    <!--Script-->
    <script>
        function postjob() {
            var x = confirm("Are you sure you want to post this job advertisement?");
            if (x == true) {
                return true;
            } else {
                return false;
            }
        }

        function deletejob() {
            var x = confirm("Are you sure you want to delete this job advertisement?");
            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <!-- Libs JS -->





    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>