<!DOCTYPE html>
<html lang="en">
<?php include '../database/dbcon.php'; ?>
<?php include 'industry-function.php'; ?>
<?php
include 'pages-head.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script> 
    <script src="multiselect-dropdown.js" type="text/javascript"></script> -->

</head>

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
                                <h1 class="mb-0 h2 fw-bold">Project Advertisement</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Advertisement</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Project Advertisement</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <?php
                                $querypa = $conn->query("SELECT * FROM project_advertisement;");

                                if (mysqli_num_rows($querypa) > 0) {

                                ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewJob">Add New Project</button>

                                <?php
                                } else {
                                ?>
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<p class='text-start'>Please complete your company profile before add job advertisement</p>">
                                        <a class="btn btn-primary btn-sm" href="company-profile.php">Add New Project</a>
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
                                    <h5 class="modal-title" id="jobadvertmodal">New Project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="pa_id" value="<?php echo $pa_id; ?>">
                                        <div class="row">
                                            <div class="mb-3 col-md-">
                                                <label class="form-label">Project Title :</label>
                                                <input type="text" id="pa_advrt_title" name="pa_advrt_title" class="form-control" autocomplete="nope" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="dateInput">Project Start Date</label>
                                                <input type="month" id="pa_start_date" name="pa_start_date" class="form-control" autocomplete="nope">
                                            </div>

                                            <div class="mb-3 col-md-2">
                                                <label class="form-label" for="dateInput">Project Duration</label>
                                                <input type="text" id="pa_duration" name="pa_duration" class="form-control" autocomplete="nope">




                                                <!-- <input type="time" id="pa_duration" name="pa_duration" class="form-control" autocomplete="nope">
                                             -->
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Project Description :</label>
                                            <textarea class="form-control" name="pa_advrt_des" id="pa_advrt_des"></textarea>

                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#pa_advrt_des'), {

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
                                                <label class="form-label">Project Type :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="pa_advrt_type" id="pa_advrt_type">
                                                    <option selected disabled>Select Project Type</option>
                                                    <option value="Full-Time">Full-Time</option>
                                                    <option value="Part-Time">Part-Time</option>
                                                    <option value="Temporary">Temporary</option>
                                                    <option value="Contract">Contract</option>
                                                    <option value="Internship">Internship</option>

                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Project Category:</label>
                                                <select class="selectpicker" data-width="100%" name="pa_category" data-live-search="true" id="pa_category" required>
                                                    <option value="" selected disabled>Select Category</option>

                                                    <?php $queryJobCategory = $conn->query("SELECT Distinct pa_category from project_advertisement");
                                                    if (mysqli_num_rows($queryJobCategory) > 0) {
                                                        while ($rowcategory = mysqli_fetch_object($queryJobCategory)) {
                                                    ?>
                                                            <option><?php echo $rowcategory->pa_category; ?></option>
                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <!-- <div class="mb-3 col-md-6">
                                                <label class="form-label">Career Level :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="pa_advrt_careerlevel" id="pa_advrt_careerlevel">
                                                    <option selected disabled>Select Project Level</option>
                                                    <option value="Entry Level">Entry Level</option>
                                                    <option value="Junior Executive">Junior Executive</option>
                                                    <option value="Senior Executive">Senior Executive</option>
                                                    <option value="Non Executive">Non Executive</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Senior Manager">Senior Manager</option>

                                                </select>
                                            </div> -->
                                        </div>

                                        <div class="row">

                                            <div class="mb-3 col-md-6">
                                                <div class="row">
                                                    <label class="form-label" for="textInput">Wages :</label>
                                                    <div class=" col-md-3 ">
                                                        <select class="selectpicker" data-width="100%" name="pa_salary">
                                                            <option value="RM">RM</option>
                                                            <option value="SGD">SGD</option>
                                                            <option value="USD">USD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group ">
                                                            <input type="number" id="pa_salary_min" name="pa_salary_min" class="form-control" autocomplete="nope" placeholder="Min Wages" required>
                                                            <span class="input-group-text" id="inputGroupPrepend">TO</span>
                                                            <input type="number" id="pa_salary_max" name="pa_salary_max" class="form-control" autocomplete="nope" placeholder="Max Wages" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. of Vacancies :</label>
                                                <input type="number" id="pa_vacancy" name="pa_vacancy" class="form-control" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Project Requirement:</label><br>
                                                <select multiple="multiple" class="selectpicker" data-live-search="true" data-width="100%" tabindex="6" multiselect-max-items="20" id="pa_requirement" name="pa_requirement[]">
                                                    <optgroup label="Information Technology">
                                                        <option>Computer Programmer</option>
                                                        <option>Information Security Analyst</option>
                                                        <option>Web Developer </option>
                                                        <option>Data Scientist</option>
                                                        <option>Computer and Information Research Scientist</option>
                                                        <option>Database Administrator</option>
                                                        <option>HTML</option>
                                                        <option>CSS</option>
                                                        <option>JAVASCRIPT</option>
                                                        <option>Python</option>
                                                        <option>Amazon Web Services</option>
                                                        <option>Microsoft Azure</option>
                                                        <option>PHP</option>
                                                        <option>Oracle</option>
                                                    </optgroup>
                                                    <optgroup1 label="IT and Systems">
                                                        <option>Project Manager.</option>
                                                        <option>Business Development Executive/ Manager. </option>
                                                        <option>Product Manager. </option>
                                                        <option>Marketing Manager.</option>
                                                        <option>Analytics Manager.</option>
                                                        <option> System Manager.</option>
                                                        <option>Data Processing Manager.</option>
                                                        <option>Business Analyst.</option>
                                                        <option>Investment Banker</option>
                                                    </optgroup1>
                                                </select>
                                                <!-- <input type="text" id="pa_requirement" name="pa_requirement" class="form-control" autocomplete="nope" required> -->
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="fileInput">Project Attachment:</label>
                                                <input type="file" id="pa_attachment" name="pa_attachment" class="form-control">
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_job_advertisement">Submit</button>
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
                                                <th scope="col" class="border-0" width="150px">Project Title</th>
                                                <th scope="col" class="border-0" width="250px">Project Description</th>
                                                <th scope="col" class="border-0" width="200px">Project Start Dt</th>
                                                <th scope="col" class="border-0" width="200px">Project Duration</th>
                                                <th scope="col" class="border-0">Project category</th>
                                                <th scope="col" class="border-0">Requirement</th>
                                                <th scope="col" class="border-0" width="180px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php
                                            $queryJob = $conn->query("SELECT * FROM project_advertisement");

                                            $num = 1;
                                            if (mysqli_num_rows($queryJob) > 0) {
                                                while ($rows = mysqli_fetch_object($queryJob)) {
                                                    $pa_id = $rows->pa_id;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $num++; ?></td>
                                                        <td><?php echo $rows->pa_advrt_title; ?></td>
                                                        <td class="wide">
                                                            <?= (strip_tags(substr($rows->pa_advrt_des, 0, 50))) ?>...
                                                            <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->pa_id; ?>">
                                                                <span style="color: skyblue;">Read More</span>
                                                            </button>
                                                        </td>

                                                        <!-- Start Modal Page Job Desc -->
                                                        <div class="modal fade" id="modalView<?php echo $rows->pa_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobdesc" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Job Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->pa_advrt_des ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal Page Job Desc -->

                                                        <td class="text-center"><?php echo $rows->pa_start_date; ?></td>
                                                        <td class="text-center"><?php echo $rows->pa_duration; ?></td>
                                                        <td class="text-center"><?php echo $rows->pa_category; ?></td>
                                                        <td class="text-center"><?php echo $rows->pa_requirement; ?></td>
                                                        <td class="text-center ">
                                                            <!-- <a class="btn btn-sm btn-info" href="job-advertisement-details.php?job_id=<?php echo $rows->pa_id; ?>">
                                                                    <i class="fa fa-search me-1" aria-hidden="true"></i>View Details</a> -->
                                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJob<?php echo $rows->pa_id; ?>">
                                                                <i class="fa fa-edit me-1" aria-hidden="true"></i>Edit</button>
                                                            <a class="btn btn-sm btn-danger" href="industry-function.php?delete_job_advertisement=<?php echo $rows->pa_id; ?>" title="Delete Project" onclick="return deletejob()">
                                                                <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="editJob<?php echo $rows->pa_id; ?>" tabindex="-1" role="dialog" aria-labelledby="jobmodal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="jobmodal">Edit Job Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="pa_id" value="<?php echo $pa_id; ?>">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-">
                                                                                <label class="form-label">Project Title :</label>
                                                                                <input type="text" name="pa_advrt_title" class="form-control" value="<?php echo $rows->pa_advrt_title; ?>">
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label" for="dateInput">Project Start Date</label>
                                                                                <input type="text" id="pa_start_date" name="pa_start_date" class="form-control" value="<?php echo $rows->pa_start_date; ?>">
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label" for="dateInput">Project Duration</label>
                                                                                <input type="text" name="pa_duration" class="form-control pa_duration" value="<?php echo $rows->pa_duration; ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Project Description :</label>
                                                                            <textarea class="form-control" name="pa_advrt_des" id="pa_advrt_des<?php echo $rows->pa_id; ?>"><?php echo $rows->pa_advrt_des; ?></textarea>

                                                                            <script>
                                                                                ClassicEditor
                                                                                    .create(document.querySelector('#pa_advrt_des<?php echo $rows->pa_id; ?>'), {

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
                                                                                <label class="form-label">Project Type :</label>
                                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="pa_advrt_type" id="pa_advrt_type">
                                                                                    <option selected disabled>Select Project Type</option>
                                                                                    <option value="Full-Time" <?php if ($rows->pa_advrt_type == 'Full-Time') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Full-Time</option>
                                                                                    <option value="Part-Time" <?php if ($rows->pa_advrt_type == 'Part-Time') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Part-Time</option>
                                                                                    <option value="Temporary" <?php if ($rows->pa_advrt_type == 'Temporary') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Temporary</option>
                                                                                    <option value="Contract" <?php if ($rows->pa_advrt_type == 'Contract') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Contract</option>
                                                                                    <option value="Internship" <?php if ($rows->pa_advrt_type == 'Internship') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Internship</option>
                                                                                </select>
                                                                            </div>

                                                                            <!-- <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Career Level :</label>
                                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="pa_advrt_careerlevel">
                                                                                    <option value="Entry Level" <?php if ($rows->pa_advrt_careerlevel == 'Entry Level') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>Entry Level</option>
                                                                                    <option value="Junior Executive" <?php if ($rows->pa_advrt_careerlevel == 'Junior Executive') {
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>Junior Executive</option>
                                                                                    <option value="Senior Executive" <?php if ($rows->pa_advrt_careerlevel == 'Senior Executive') {
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>Senior Executive</option>
                                                                                    <option value="Non Executive" <?php if ($rows->pa_advrt_careerlevel == 'Non Executive') {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>Non Executive</option>
                                                                                    <option value="Manager" <?php if ($rows->pa_advrt_careerlevel == 'Manager') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Manager</option>
                                                                                    <option value="Senior Manager" <?php if ($rows->pa_advrt_careerlevel == 'Senior Manager') {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>Senior Manager</option>
                                                                                </select>
                                                                            </div> -->
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label">Project Category:</label>
                                                                                <select class="selectpicker" data-width="100%" name="pa_category" data-live-search="true" required>
                                                                                    <?php $queryJobCategory = $conn->query("SELECT Distinct pa_category from project_advertisement");
                                                                                    if (mysqli_num_rows($queryJobCategory) > 0) {
                                                                                        while ($rowcategory = mysqli_fetch_object($queryJobCategory)) {
                                                                                    ?>
                                                                                            <option value="<?php echo $rowcategory->pa_category; ?>" <?php if ($rows->pa_category == $rowcategory->pa_category) {
                                                                                                                                                            echo "selected";
                                                                                                                                                        } ?>><?php echo $rowcategory->pa_category; ?></option>
                                                                                        <?php }
                                                                                    } else {
                                                                                        ?>
                                                                                    <?php
                                                                                    } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="mb-3 col-md-6">
                                                                                <div class="row">
                                                                                    <label class="form-label" for="textInput">Wages :</label>
                                                                                    <div class=" col-md-3 ">
                                                                                        <select class="selectpicker" data-width="100%" name="pa_salary" value="<?php echo $rows->pa_salary; ?>">
                                                                                            <option value="RM" <?php if ($rows->pa_salary == 'RM') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>RM</option>
                                                                                            <option value="SGD" <?php if ($rows->pa_salary == 'SGD') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>SGD</option>
                                                                                            <option value="USD" <?php if ($rows->pa_salary == 'USD') {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>USD</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-9">
                                                                                        <div class="input-group ">
                                                                                            <input type="number" name="pa_salary_min" class="form-control" value="<?php echo $rows->pa_salary_min; ?>">
                                                                                            <span class="input-group-text" id="inputGroupPrepend">TO</span>
                                                                                            <input type="number" name="pa_salary_max" class="form-control" value="<?php echo $rows->pa_salary_max; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">No. of Vacancies :</label>
                                                                                <input type="number" name="pa_vacancy" class="form-control" value="<?php echo $rows->pa_vacancy; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label class="form-label">Project Requirement</label>
                                                                                        <!-- <input type="text" name="pa_requirement" class="form-control" value="<?php echo $rows->pa_requirement; ?>"> -->
                                                                                        <select multiple="multiple" class="selectpicker" data-live-search="true" data-width="100%" tabindex="6" multiselect-max-items="20" id="pa_requirement" name="pa_requirement[]">
                                                                                            <optgroup label="Information Technology">
                                                                                                <option>Computer Programmer</option>
                                                                                                <option>Information Security Analyst</option>
                                                                                                <option>Web Developer </option>
                                                                                                <option>Data Scientist</option>
                                                                                                <option>Computer and Information Research Scientist</option>
                                                                                                <option>Database Administrator</option>
                                                                                                <option>HTML</option>
                                                                                                <option>CSS</option>
                                                                                                <option>JAVASCRIPT</option>
                                                                                                <option>Python</option>
                                                                                                <option>Amazon Web Services</option>
                                                                                                <option>Microsoft Azure</option>
                                                                                                <option>PHP</option>
                                                                                                <option>Oracle</option>
                                                                                            </optgroup>
                                                                                            <optgroup1 label="IT and Systems">
                                                                                                <option>Project Manager.</option>
                                                                                                <option>Business Development Executive/ Manager. </option>
                                                                                                <option>Product Manager. </option>
                                                                                                <option>Marketing Manager.</option>
                                                                                                <option>Analytics Manager.</option>
                                                                                                <option> System Manager.</option>
                                                                                                <option>Data Processing Manager.</option>
                                                                                                <option>Business Analyst.</option>
                                                                                                <option>Investment Banker</option>
                                                                                            </optgroup1>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 col-md-6">
                                                                                <label class="form-label" for="fileInput">Project Attachment: <?php echo $rows->pa_attachment; ?></label>
                                                                                <input type="file" name="pa_attachment" class="form-control" value=<?php echo $rows->pa_attachment; ?>>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success btn-sm" name="edit_job_advertisement">Update</button>
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

    <script>
        const input = document.getElementById('pa_duration');
        input.addEventListener('change', function() {
            const value = input.value;
            const parts = value.match(/^(\d+)\s*(\w+)$/);
            if (!parts) {
                // invalid input format
                alert("Invalid duration format. Please enter a number followed by 'days' or 'months'");
                input.value = "";
                return;
            }
            const number = parseInt(parts[1], 10);
            const unit = parts[2].toLowerCase();
            if (unit === 'days' && number >= 1 && number <= 365) {
                // valid duration in days
            } else if (unit === 'months' && number >= 1 && number <= 12) {
                // valid duration in months
            } else {
                // invalid duration
                alert("Invalid duration value. Please enter a number between 1 and 365 for days or 1 and 12 for months");
                input.value = "";
                return;
            }
            // insert the duration into the database
            // ...
        });
    </script>
    <!-- Libs JS -->





    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>