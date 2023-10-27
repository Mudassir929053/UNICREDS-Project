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
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <?php
                                $queryIndustry = $conn->query("SELECT * FROM industry_information WHERE ii_industry_id = '$industry_id';");


                                if (mysqli_num_rows($queryIndustry) > 0) {

                                ?>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewJob">Add New Job</button>

                                <?php
                                } else {
                                ?>
                                 <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" 
                                 title="<p class='text-start'>Please complete your company profile before add job advertisement</p>">
                                  <a class="btn btn-primary btn-sm" href="company-profile.php">Add New Job</a>
                                  </span>
                                
                                <?php
                                } ?>

                                

                            </div>
                        </div>
                    </div>

                    <!-- Start Modal Page -->
                    <div class="modal fade" id="addNewJob" tabindex="-1" role="dialog" aria-labelledby="jobadvertmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="jobadvertmodal">New Job</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="industry_id" value="<?php echo $industry_id; ?>">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Job Title :</label>
                                                <input type="text" id="job_title" name="job_title" class="form-control" autocomplete="nope" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="textInput">Job Code :</label>
                                                <input type="text" id="job_code" name="job_code" class="form-control" autocomplete="nope">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Job Description :</label>
                                            <textarea class="form-control" name="job_description" id="job_description"></textarea>

                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#job_description'), {

                                                    })
                                                    .then(editor => {
                                                        window.editor = editor;

                                                    })
                                                    .catch(err => {
                                                        console.error(err.stack);
                                                    });
                                            </script>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Job Type :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="job_type" id="job_type">
                                                    <option selected disabled>Select Job Type</option>
                                                    <option value="Full-Time">Full-Time</option>
                                                    <option value="Part-Time">Part-Time</option>
                                                    <option value="Temporary">Temporary</option>
                                                    <option value="Contract">Contract</option>
                                                    <option value="Internship">Internship</option>

                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Career Level :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="job_level" id="job_level">
                                                    <option selected disabled>Select Job Level</option>
                                                    <option value="Entry Level">Entry Level</option>
                                                    <option value="Junior Executive">Junior Executive</option>
                                                    <option value="Senior Executive">Senior Executive</option>
                                                    <option value="Non Executive">Non Executive</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Senior Manager">Senior Manager</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Job Category:</label>
                                                <select class="selectpicker" data-width="100%" name="job_category" data-live-search="true" id="jc" required>
                                                    <option value="" selected disabled>Select Category</option>

                                                    <?php $queryJobCategory = $conn->query("SELECT * from job_category");
                                                    if (mysqli_num_rows($queryJobCategory) > 0) {
                                                        while ($rowcategory = mysqli_fetch_object($queryJobCategory)) {
                                                    ?>
                                                            <option value="<?php echo $rowcategory->jc_id; ?>"><?php echo $rowcategory->jc_name; ?></option>
                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="row">
                                                    <label class="form-label" for="textInput">Salary :</label>
                                                    <div class=" col-md-3 ">
                                                        <select class="selectpicker" data-width="100%" name="salary_currency">
                                                            <option value="RM">RM</option>
                                                            <option value="SGD">SGD</option>
                                                            <option value="USD">USD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group ">
                                                            <input type="text" id="job_min_salary" name="job_min_salary" class="form-control" autocomplete="nope" placeholder="Min Salary" required>
                                                            <span class="input-group-text" id="inputGroupPrepend">TO</span>
                                                            <input type="text" id="job_max_salary" name="job_max_salary" class="form-control" autocomplete="nope" placeholder="Max Salary" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">No. of Vacancies :</label>
                                                        <input type="text" id="job_no_of_vacancies" name="job_no_of_vacancies" class="form-control" autocomplete="nope" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Years of Experience :</label>
                                                        <input type="text" id="job_experience_year" name="job_experience_year" class="form-control" autocomplete="nope" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="textInput">Job Qualification :</label>
                                                <input type="text" id="job_qualification" name="job_qualification" class="form-control" autocomplete="nope">
                                            </div>
                                        </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_job">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- End Modal Page -->

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
                                                        
                                                        
                                                        <?php  $queryApplicant = $conn->query("SELECT * FROM job_student_university_application
                                                                                         WHERE jsua_job_id = '$job_id';");
                                                                                         
                                                               $totalApplication = mysqli_num_rows($queryApplicant);                          
                                                        ?>
                                                                
                                                        <td class="text-center"><?php echo $totalApplication; ?></td>    
                                                     
                                                        <td class="text-center ">
                                                            <a class="btn btn-sm btn-info" href="job-advertisement-details.php?job_id=<?php echo $rows->job_id; ?>">
                                                                <i class="fa fa-search me-1" aria-hidden="true"></i>View Details</a>
                                                            <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editJob<?php echo $rows->job_id; ?>">
                                                                <i class="fa fa-edit me-1" aria-hidden="true"></i>Edit</button>
                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_job=<?php echo $rows->job_id; ?>" title="Delete Vacancy" onclick="return deletejob()">
                                                                <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="editJob<?php echo $rows->job_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobmodal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="jobmodal">Edit Job Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="industry_id" value="<?php echo $industry_id; ?>">
                                                                        <input type="hidden" name="job_id" value="<?php echo $rows->job_id; ?>">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Job Title :</label>
                                                                                <input type="text" name="new_job_title" class="form-control" value="<?php echo $rows->job_title; ?>">
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label" for="textInput">Job Code :</label>
                                                                                <input type="text" name="new_job_code" class="form-control" value="<?php echo $rows->job_code; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Job Description :</label>
                                                                            <textarea class="form-control" name="new_job_description" id="job_description<?php echo $rows->job_id; ?>"><?php echo $rows->job_description; ?></textarea>

                                                                            <script>
                                                                                ClassicEditor
                                                                                    .create(document.querySelector('#job_description<?php echo $rows->job_id; ?>'), {

                                                                                    })
                                                                                    .then(editor => {
                                                                                        window.editor = editor;

                                                                                    })
                                                                                    .catch(err => {
                                                                                        console.error(err.stack);
                                                                                    });
                                                                            </script>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Job Type :</label>
                                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="new_job_type">
                                                                                    <option selected disabled>Select Job Type</option>
                                                                                    <option value="Full-Time" <?php if ($rows->job_type == 'Full-Time') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Full-Time</option>
                                                                                    <option value="Part-Time" <?php if ($rows->job_type == 'Part-Time') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Part-Time</option>
                                                                                    <option value="Temporary" <?php if ($rows->job_type == 'Temporary') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Temporary</option>
                                                                                    <option value="Contract" <?php if ($rows->job_type == 'Contract') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Contract</option>
                                                                                    <option value="Internship" <?php if ($rows->job_type == 'Internship') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Internship</option>

                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Career Level :</label>
                                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="new_job_level">

                                                                                    <option value="Entry Level" <?php if ($rows->job_level == 'Entry Level') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Entry Level</option>
                                                                                    <option value="Junior Executive" <?php if ($rows->job_level == 'Junior Executive') {
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>Junior Executive</option>
                                                                                    <option value="Senior Executive" <?php if ($rows->job_level == 'Senior Executive') {
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>Senior Executive</option>
                                                                                    <option value="Non Executive" <?php if ($rows->job_level == 'Non Executive') {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>Non Executive</option>
                                                                                    <option value="Manager" <?php if ($rows->job_level == 'Manager') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Manager</option>
                                                                                    <option value="Senior Manager" <?php if ($rows->job_level == 'Senior Manager') {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>Senior Manager</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Job Category:</label>
                                                                                <select class="selectpicker" data-width="100%" name="new_job_category" data-live-search="true" required>

                                                                                    <?php $queryJobCategory = $conn->query("SELECT * from job_category");
                                                                                    if (mysqli_num_rows($queryJobCategory) > 0) {
                                                                                        while ($rowcategory = mysqli_fetch_object($queryJobCategory)) {
                                                                                    ?>
                                                                                            <option value="<?php echo $rowcategory->jc_id; ?>" <?php if ($rows->job_category_id == $rowcategory->jc_id) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>><?php echo $rowcategory->jc_name; ?></option>
                                                                                        <?php }
                                                                                    } else {
                                                                                        ?>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <div class="row">
                                                                                    <label class="form-label" for="textInput">Salary :</label>
                                                                                    <div class=" col-md-3 ">
                                                                                        <select class="selectpicker" data-width="100%" name="new_salary_currency" value="<?php echo $rows->job_salary_currency; ?>">
                                                                                            <option value="RM" <?php if ($rows->job_salary_currency == 'RM') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>RM</option>
                                                                                            <option value="SGD" <?php if ($rows->job_salary_currency == 'SGD') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>SGD</option>
                                                                                            <option value="USD" <?php if ($rows->job_salary_currency == 'USD') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>USD</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <div class="input-group ">
                                                                                            <input type="text" name="new_job_min_salary" class="form-control" autocomplete="nope" value="<?php echo $rows->job_min_salary; ?>">
                                                                                            <span class="input-group-text" id="inputGroupPrepend">TO</span>
                                                                                            <input type="text" name="new_job_max_salary" class="form-control" autocomplete="nope" value="<?php echo $rows->job_max_salary; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label class="form-label">No. of Vacancies :</label>
                                                                                        <input type="text" name="new_job_no_of_vacancies" class="form-control" value="<?php echo $rows->job_no_of_vacancies; ?>">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="form-label">Years of Experience :</label>
                                                                                        <input type="text" name="new_job_experience_year" class="form-control" value="<?php echo $rows->job_experience_year; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label" for="textInput">Job Qualification :</label>
                                                                                <input type="text" name="new_job_qualification" class="form-control" value="<?php echo $rows->job_qualification; ?>">
                                                                            </div>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success btn-sm" name="edit_job">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
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