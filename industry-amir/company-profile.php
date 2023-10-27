<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php'); ?>
<?php include('industry-function.php'); ?>
<?php
include 'pages-head.php';
?>


<?php $industry_id = $_SESSION['sess_industryid']; ?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'company_profile';
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
                                <h1 class="mb-0 h2 fw-bold">Profile</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">My Company</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Edit Profile
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <div class="py-3">
                    <div class="col-xl-11 mx-auto">
                        <div class="row">

                            <!-- Job Offers -->
                            <?php
                            $queryIndustry = $conn->query("SELECT * FROM industry
                                                           LEFT JOIN industry_field ON industry_industry_field_id = industry_field.industry_field_id 
                                                           LEFT JOIN industry_information ON industry_id = industry_information.ii_industry_id 
                                                           LEFT JOIN state ON industry_state_id = state.state_id                                                            
                                                           WHERE industry_id = '$industry_id'");

                            $num = 1;
                            if (mysqli_num_rows($queryIndustry) > 0) {
                                while ($rows = mysqli_fetch_object($queryIndustry)) {
                            ?>
                                    <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                                        <div class="card">

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <?php

                                                        if ($rows->industry_logo != NULL) {
                                                            $ProfilePic = 'images/profile_picture/' . $rows->industry_logo;
                                                        } else {
                                                            $ProfilePic = '../assets/images/avatar/avatardefault.png';
                                                        }
                                                        ?>
                                                        <img alt="avatar" src="<?php echo $ProfilePic; ?>" class="avatar-xl rounded-circle" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div>
                                                            <h3 class="mb-0"><?php echo $rows->industry_name;   ?></h3>
                                                        </div>
                                                        <div>
                                                            <h5 class="mt-2"><?php echo $rows->industry_contact_no;  ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mx-auto">
                                                        <!-- <div class="mt-4 m-1">
                                                            <button style="margin:auto;display:block" class="btn btn-sm bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                                                                Profile
                                                            </button>
                                                    </div>
                                                    <div class="m-1">
                                                    <button style="margin:auto;display:block" class="btn btn-sm bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                                                                Contact
                                                            </button>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Job Description -->
                                    <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                                        <div class="card">
                                            <div class="card-header border-bottom">
                                                <h4 class="mb-0">Company Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <button class="accordion-button collapsed bg-light-info text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#company" href="#collapseOne">
                                                        Company
                                                    </button>

                                                    <div class="collapse show" id="company">
                                                        <div class="card card-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="industry_id" value="<?php echo $industry_id; ?>">
                                                                <input type="hidden" name="industry_user_id" value="<?php echo $rows->industry_user_id; ?>">
                                                                <div class="mb-5">
                                                                    <label class="form-label">Company Name :</label>
                                                                    <input type="text" value="<?php echo $rows->industry_name; ?>" class="form-control" readonly>
                                                                </div>

                                                                <div class="mb-5">
                                                                    <label class="form-label">Company Size :</label>
                                                                    <div>
                                                                        <input type="radio" class="btn-check" name="new_company_size" value="Up to 10 employees" id="Up to 10 employees" <?php if ($rows->ii_company_size == "Up to 10 employees") {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?>>
                                                                        <label class="btn btn-outline-primary" for="Up to 10 employees">Up to 10 employees</label>

                                                                        <input type="radio" class="btn-check" name="new_company_size" value="10-50 employees" id="10-50 employees" <?php if ($rows->ii_company_size == "10-50 employees") {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                                        <label class="btn btn-outline-primary" for="10-50 employees">10-50 employees</label>

                                                                        <input type="radio" class="btn-check" name="new_company_size" value="50-250 employees" id="50-250 employees" <?php if ($rows->ii_company_size == "50-250 employees") {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?>>
                                                                        <label class="btn btn-outline-primary" for="50-250 employees">50-250 employees</label>

                                                                        <input type="radio" class="btn-check" name="new_company_size" value="More than 250 employees" id="More than 250 employees" <?php if ($rows->ii_company_size == "More than 250 employees") {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    } ?>>
                                                                        <label class="btn btn-outline-primary" for="More than 250 employees">More than 250 employees</label>
                                                                    </div>
                                                                </div>

                                                                <!-- <div class="mb-5">
                                                                        <label class="form-label" for="textInput">Company SSM :</label>
                                                                        <div class="custom-file">
                                                                            <div class="input-group mb-1">

                                                                                <input type="file" onChange="readURL(this);" class="form-control custom-file-input" name="ssm_attachment" id="ssm_attachment<?php echo $rows->industry_id; ?>">

                                                                            </div>
                                                                        </div>
                                                                        <?php if ($rows->industry_ssm != NULL) { ?>
                                                                            <p>Current File : <a href="attachment/industry_attachment/<?php echo $rows->industry_ssm; ?>" target="_blank">
                                                                                    <?php echo $rows->industry_ssm; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>

                                                                    </div> -->

                                                                <div class="row">
                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label">Company start operation date* :</label>
                                                                        <div class="input-group me-3">
                                                                            <input class="form-control flatpickr" type="text" name="new_industry_start_operation_date" value="<?php echo $rows->ii_start_operation_date; ?>" aria-describedby="basic-addon2">

                                                                            <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                        </div>

                                                                    </div>

                                                                    <div class="mb-5 col-md-6">
                                                                        <label class="form-label">Company Sector :</label>
                                                                        <select class="selectpicker" data-width="100%" data-live-search="true" name="new_industry_field_id" required>
                                                                            <option value="" selected disabled>Select Sector..</option>
                                                                            <?php $queryCheckSector = $conn->query("SELECT * from industry_field");
                                                                            if (mysqli_num_rows($queryCheckSector) > 0) {
                                                                                while ($rowsec = mysqli_fetch_object($queryCheckSector)) {
                                                                            ?>
                                                                                    <option value="<?php echo $rowsec->industry_field_id; ?>" <?php if ($rows->industry_industry_field_id == $rowsec->industry_field_id) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } else {
                                                                                                                                                } ?>><?php echo $rowsec->industry_field_name; ?></option>

                                                                                <?php }
                                                                            } else {
                                                                                ?>
                                                                            <?php
                                                                            } ?>
                                                                        </select>
                                                                    </div>


                                                                </div>

                                                                <div class="mb-5">
                                                                    <label class="form-label">Company Description :</label>
                                                                    <textarea class="form-control" name="new_company_overview" id="companyoverview<?php echo $rows->industry_id; ?>"><?php echo $rows->ii_overview; ?></textarea>

                                                                    <script>
                                                                        ClassicEditor
                                                                            .create(document.querySelector('#companyoverview<?php echo $rows->industry_id; ?>'), {

                                                                            })
                                                                            .then(editor => {
                                                                                window.editor = editor;

                                                                            })
                                                                            .catch(err => {
                                                                                console.error(err.stack);
                                                                            });
                                                                    </script>
                                                                </div>



                                                                <div class="mb-5">
                                                                    <label class="form-label">Address :</label>
                                                                    <textarea class="form-control" name="new_industry_address1" id="new_industry_address1" autocomplete="nope" required><?php echo $rows->industry_address1; ?></textarea>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="mb-5 col-md-4">
                                                                        <label class="form-label">State :</label>
                                                                        <select class="selectpicker" data-width="100%" data-live-search="true" name="new_state" required>
                                                                            <option value="" selected disabled>Select State..</option>
                                                                            <?php $queryCheckState = $conn->query("SELECT * from state");
                                                                            if (mysqli_num_rows($queryCheckState) > 0) {
                                                                                while ($rowstate = mysqli_fetch_object($queryCheckState)) {
                                                                            ?>
                                                                                    <option value="<?php echo $rowstate->state_id; ?>" <?php if ($rows->industry_state_id == $rowstate->state_id) {
                                                                                                                                            echo "selected";
                                                                                                                                        } else {
                                                                                                                                        } ?>><?php echo $rowstate->state_name; ?></option>

                                                                                <?php }
                                                                            } else {
                                                                                ?>
                                                                            <?php
                                                                            } ?>
                                                                        </select>

                                                                    </div>

                                                                    <div class="mb-5 col-md-4">
                                                                        <label class="form-label">City :</label>
                                                                        <input type="text" name="new_industry_city" value="<?php echo $rows->industry_city_id; ?>" class="form-control" autocomplete="nope" required>
                                                                    </div>

                                                                    <div class="mb-5 col-md-4">
                                                                        <label class="form-label">Country :</label>
                                                                        <input type="text" name="new_industry_country" value="<?php echo $rows->industry_country_id; ?>" class="form-control" autocomplete="nope" required>
                                                                    </div>
                                                                </div>

                                                                <div class="d-md-flex align-items-center justify-content-between">
                                                                    <div class="mb-3 mb-md-0">

                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-sm btn-primary" type="submit" name="edit_industry_profile">
                                                                            Update Profile
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="mb-3">
                                                    <button class="accordion-button collapsed bg-light-info text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#contact">
                                                        Contact
                                                    </button>

                                                    <div class="collapse" id="contact">
                                                        <div class="card card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                                        </div>
                                                    </div>
                                                </div> -->


                                            </div>
                                        </div>
                                    </div>

                                <?php }
                            } else {
                                ?>
                            <?php
                            } ?>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!--Script-->
    <script>


    </script>


    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>