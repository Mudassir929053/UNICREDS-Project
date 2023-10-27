<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php'); ?>
<?php
include 'pages-head.php';
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
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>

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
                                    <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow " style="width:100%">
                                        <thead class="bg-primary text-white">
                                            <tr class="text-center">
                                                <th scope="col" class="border-0" width="10px">No.</th>
                                                <th scope="col" class="border-0" width="200px">Job Title</th>
                                                <th scope="col" class="border-0" width="250px">Job Description</th>
                                                <th scope="col" class="border-0">Job Category</th>
                                                <th scope="col" class="border-0">Job Status</th>
                                                <th scope="col" class="border-0">Date Posted</th>
                                                <th scope="col" class="border-0">Open Until</th>
                                                <th scope="col" class="border-0" width="20px">Position</th>
                                                <th scope="col" class="border-0" width="20px">Total Applicant</th>
                                                <th scope="col" class="border-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php
                                            $queryJob = $conn->query("SELECT * FROM job
                                                                      LEFT JOIN industry ON job_industry_id = industry.industry_id
                                                                      LEFT JOIN job_category ON job_category_id = job_category.jc_id
                                                                      WHERE job_industry_id = '$industry_id'
                                                                     
                                                                      ORDER BY job_date_created DESC;");

                                            $num = 1;
                                            if (mysqli_num_rows($queryJob) > 0) {
                                                while ($rows = mysqli_fetch_object($queryJob)) {
                                                    $job_id = $rows->job_id;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                        <td><?php echo $rows->job_title; ?></td>
                                                        <td class="wide">
                                                            <?= (strip_tags(substr($rows->job_description, 0, 50))) ?>...
                                                            <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->job_id; ?>">
                                                                <span style="color: skyblue;">Read More</span>
                                                            </button>
                                                        </td>

                                                        <!-- Start Modal Page Job Desc -->
                                                        <div class="modal fade" id="modalView<?php echo $rows->job_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobdesc" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Job Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->job_description ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal Page Job Desc -->


                                                        <td class="text-center"><?php echo $rows->jc_name; ?></td>
                                                        <td class="text-center">
                                                            <span style="vertical-align: middle;" class="<?php if ($rows->job_status == 'Active') {
                                                                                                                echo "badge rounded-pill bg-success";
                                                                                                            }
                                                                                                            if ($rows->job_status == 'Draft') {
                                                                                                                echo "badge rounded-pill bg-secondary";
                                                                                                            } ?>"><?php echo $rows->job_status; ?>
                                                            </span>

                                                            <a class="me-1 text-inherit" href="#">

                                                                <?php if ($rows->job_status == 'Draft') : ?>
                                                                    <a href="industry-function.php?post_job=<?php echo $rows->job_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Post Job" onclick="return postjob()">
                                                                        <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                                <?php endif ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-center"><?php if ($rows->job_date_posted == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo date('j/m/Y', strtotime($rows->job_date_posted));
                                                                                    } ?>
                                                        </td>
                                                        <td class="text-center"><?php if ($rows->job_date_posted == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo date('j/m/Y', strtotime($rows->job_date_posted. '+ 1 month'));
                                                                                    } ?>
                                                        </td> 
                                                        <td class="text-center"><?php echo $rows->job_no_of_vacancies ?></td>

                                                        <?php  $queryApplicant = $conn->query("SELECT * FROM job_student_university_application
                                                                                         WHERE jsua_job_id = '$job_id';");
                                                                                         
                                                               $totalApplication = mysqli_num_rows($queryApplicant);                          
                                                        ?>
                                                                
                                                        <td class="text-center"><?php echo $totalApplication; ?></td>                           
                                                     
                                                        <td class="text-center ">
                                                            <a class="btn btn-sm btn-info" href="applicant-details.php?job_id=<?php echo $rows->job_id; ?>">
                                                                <i class="fa fa-search me-1" aria-hidden="true"></i>View Applicant</a>
                                                       
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