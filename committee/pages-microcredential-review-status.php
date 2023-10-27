<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_userid = $_SESSION['sess_committeeid'];
$mcid = $_GET['mcid'];

$checkuserrow = $conn->query("SELECT * from committee where committee_id = '$committee_userid'");
$rowReadUser = $checkuserrow->fetch_object();
$get_uniID = $rowReadUser->committee_institution_id;
$get_committeeuserID = $rowReadUser->committee_user_id;
?>



</style>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mcreview';
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
                                <h1 class="mb-1 h2 fw-bold">Micro-Credential Information</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">Micro-Credential Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-microcredential-review.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>

                    </div>


                </div>
                <?php
                $querymc = $conn->query("SELECT * FROM microcredential 
                                            LEFT JOIN mc_learning_details on mc_learning_details.mcld_mc_id = mc_id
                                            LEFT JOIN mc_course_credit_transfer ON mc_course_credit_transfer.mccct_mc_id = mc_id
                                            LEFT JOIN mc_enrolment_session ON mc_enrolment_session.mces_mc_id = mc_id
                                            LEFT JOIN review_microcredential ON mc_id = review_microcredential.rmc_mc_id
                                            LEFT JOIN mc_mou ON mc_mou.mcm_mc_id = mc_id  
                                            LEFT JOIN user ON mc_created_by = user.user_id
                                            LEFT JOIN lecturer ON user.user_id = lecturer.lecturer_user_id
                                            LEFT JOIN institution ON mc_owner = institution.institution_id
                                            LEFT JOIN university ON institution.institution_university_id = university.university_id
                                           
                                            where mc_id = '$mcid'  ;");

                $num = 1;
                if (mysqli_num_rows($querymc) > 0) {
                    while ($rows = mysqli_fetch_object($querymc)) {
                ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header border-bottom px-4 py-3">

                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h4 class="mb-0">Micro-Credential Details</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <button type="button" class="btn btn-outline-warning btn-light-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#reviewmc<?php echo $rows->mc_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Review</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Start Modal Page -->
                                    <div class="modal fade" id="reviewmc<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcreviewmodal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mcreviewmodal">Review Micro-Credential</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <input id="rmc_id" class="form-control" type="hidden" name="rmc_id" value="<?php echo $rows->rmc_id; ?>">
                                                        <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                        <input id="rmc_user_request" class="form-control" type="hidden" name="rmc_user_request" value="<?php echo $rows->rmc_user_request; ?>">
                                                        <input id="rmc_user_review " class="form-control" type="hidden" name="rmc_user_review" value="<?php echo $get_committeeuserID; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label">Comment :</label>
                                                            <textarea class="form-control" name="rmc_comment"></textarea>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="submit" class="btn btn-danger btn-sm shadow me-3" name="reject_mc" title="Reject Micro-Credential" onclick="return rejectmc()">
                                                        <i class="far fa-times-circle me-1"></i>Reject
                                                    </button>
                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="approve_mc" title="Approve Micro-Credential" onclick="return approvemc()">
                                                        <i class="fe fe-check-circle me-1"></i>Approve
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- End Modal Page -->


                                    <div class="card-body">
                                        <div class="row d-flex align-items-stretch">


                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Title</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->mc_title; ?></p>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        if ($rows->mc_code != NULL) { ?>
                                                            <tr>
                                                                <td width="200px" class="bg-light-info text-dark">Code</td>
                                                                <td>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_code; ?></p>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        } else {
                                                        } ?>

                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Description</td>
                                                            <td> <?= (strip_tags(substr($rows->mc_description, 0, 100))) ?>...
                                                                <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewDesc<?php echo $rows->mc_id; ?>">
                                                                    <span style="color: skyblue;">Read More</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal for mc description -->
                                                        <div class="modal fade" id="modalViewDesc<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcdesc" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Micro-credential Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->mc_description ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal for mc description -->
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Category</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_category; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Level</td>
                                                            <td>
                                                                <?php
                                                                $arr = $rows->mc_level;
                                                                $sprt = explode(",", $arr);

                                                                if ($sprt != NULL) {
                                                                    if ($arr != NULL) {
                                                                        if (in_array("1", $sprt)) {
                                                                            echo ' <p class="text-dark mb-0 fw-semi-bold" >Undergraduate</p>';
                                                                        }

                                                                        if (in_array("2", $sprt)) {
                                                                            echo '<p class="text-dark mb-0 fw-semi-bold" >Postgraduate</p>';
                                                                        }

                                                                        if (in_array("3", $sprt)) {
                                                                            echo '<p class="text-dark mb-0 fw-semi-bold" >Continuing and Professional Development</p>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Duration</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_duration; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Fee</td>
                                                            <td>
                                                                <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_fee; ?></p>
                                                                <?php } else { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->mc_fee / 100); ?></p>
                                                                <?php
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Credit Transfer</td>
                                                            <td>
                                                                <div class="d-flex justify-content-between align-items-center ">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <span style="vertical-align: middle;" class="<?php if ($rows->mc_credit_transfer == 'Yes') {
                                                                                                                                echo "badge rounded-pill bg-light-success text-dark-success";
                                                                                                                            } else {
                                                                                                                                echo "badge rounded-pill bg-light-danger text-dark-danger";
                                                                                                                            } ?>"><?php echo $rows->mc_credit_transfer; ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                    </div>

                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <?php if ($rows->mc_enrollment_date == 'choosedate') {
                                                        ?>
                                                            <tr>
                                                                <td width="200px" class="bg-light-info text-dark">Enrolment Date</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-between align-items-center ">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <p class="text-dark mb-0 fw-semi-bold">
                                                                                    <?php echo date('d/m/Y', strtotime($rows->mces_start_date)); ?>
                                                                                    <i class="bi bi-arrow-right fs-5 m-1"></i>
                                                                                    <?php echo date('d/m/Y', strtotime($rows->mces_end_date)); ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td width="200px" class="bg-light-info text-dark">Enrolment Date</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-between align-items-center ">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <p class="text-dark mb-0 fw-semi-bold">
                                                                                    Anytime
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </table>
                                                </div>


                                            </div>

                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-success text-dark">Learning Outcome</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->mcld_learning_outcome; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-success text-dark">Intended Learners</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mcld_intended_learners; ?></p>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td width="200px" class="bg-light-success text-dark">Requirements or Prerequisites</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mcld_prerequisites; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-success text-dark">Skills that participants will be able to achieve</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mcld_skills; ?></p>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-3 shadow">
                                    <div class="card-header border-bottom px-4 py-3">

                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h4 class="mb-0">Developer Information</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <!-- <button type="button" class="btn btn-outline-warning btn-light-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#reviewmc<?php echo $rows->mc_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Review</button> -->
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <?php if ($rows->user_role_id == '1') {
                                        $adminrole = $rows->user_role_id;
                                        $adminuserid = $rows->user_id;

                                        $queryadmininstitution = $conn->query("SELECT * FROM admin LEFT JOIN institution ON admin_institution = institution.institution_id
                                                                                                              LEFT JOIN university ON institution.institution_university_id = university.university_id 
                                                                                                              WHERE admin_user_id = '$adminuserid' AND admin_role_id = '$adminrole'");

                                        $rowReadAdmin = $queryadmininstitution->fetch_object();
                                        $institution_name = $rowReadAdmin->university_name;
                                        $institution_email = $rowReadAdmin->institution_email;

                                    ?>

                                        <div class="card-body">
                                            <div class="row d-flex align-items-stretch">


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Institution Name</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $institution_name; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Email</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $institution_email; ?></p>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Contact No.</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rowReadAdmin->institution_contact_no; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Memorandum of Understanding</td>
                                                            <td style='vertical-align:middle'>
                                                                <a href="../assets/attachment/microcredential/mouattachment/<?php echo $rows->mcm_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View MoU attachment">
                                                                    <span class="badge rounded-pill bg-info fw-semi-bold text-dark"><b></b>View MoU</span></a>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } elseif ($rows->user_role_id == '7') { ?>

                                        <div class="card-body">
                                            <div class="row d-flex align-items-stretch">


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Name</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->lecturer_fname; ?> <?php echo $rows->lecturer_lname; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Email</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->lecturer_email; ?></p>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Contact No.</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->lecturer_contact_no; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Institution</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->university_name; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-warning text-dark">Memorandum of Understanding</td>
                                                            <td style='vertical-align:middle'>
                                                                <a href="../assets/attachment/microcredential/mouattachment/<?php echo $rows->mcm_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View MoU attachment">
                                                                    <span class="badge rounded-pill bg-info fw-semi-bold text-dark"><b></b>View MoU</span></a>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                    <?php } ?>



                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php if ($rows->mc_credit_transfer == 'Yes') { ?>
                                    <div class="card mt-3 shadow" id="credittransfer">
                                        <div class="card-header border-bottom px-4 py-3">

                                            <div class="d-flex justify-content-between align-items-center ">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h4 class="mb-0">Course Information (Credit Transfer)</h4>
                                                    </div>
                                                </div>
                                                <div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row d-flex align-items-stretch">


                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                    <tr>
                                                            <td width="200px" class="bg-light-danger text-dark">Micro-Credential Title</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->mc_title; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-danger text-dark">Course Title</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->mccct_course_title; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-danger text-dark">Course Code</td>
                                                            <td>
                                                                <?php
                                                                if ($rows->mc_code != NULL) { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mccct_course_code; ?></p>
                                                                <?php
                                                                } else { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold">N/A</p>
                                                                <?php
                                                                } ?>

                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td width="200px" class="bg-light-danger text-dark">Course Level</td>
                                                            <td>
                                                                <?php
                                                                $arr = $rows->mccct_course_level;
                                                                $sprt = explode(",", $arr);

                                                                if ($sprt != NULL) {
                                                                    if ($arr != NULL) {
                                                                        if (in_array("1", $sprt)) {
                                                                            echo ' <p class="text-dark mb-0 fw-semi-bold" >Undergraduate</p>';
                                                                        }

                                                                        if (in_array("2", $sprt)) {
                                                                            echo '<p class="text-dark mb-0 fw-semi-bold" >Postgraduate</p>';
                                                                        }

                                                                        if (in_array("3", $sprt)) {
                                                                            echo '<p class="text-dark mb-0 fw-semi-bold" >Continuing and Professional Development</p>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } else {
                                }
                                ?>
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
        function approvemc() {
            var x = confirm("Are you sure want to approve this micro-credential?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }

        function rejectmc() {
            var x = confirm("Are you sure want to reject this micro-credential?");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script>
        function notcredittransfer() {
            var x = confirm("\nYou need to delete course information in the section below if this micro-credential is not available for credit transfer");

            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script>
        function new_offerdate_anytime() {
            $("#new_offerdate1").hide();
            $("#anytime").show();

        }

        function new_offerdate_date() {
            $("#new_offerdate1").show();
            $("#anytime").hide();
        }
    </script>
</body>

</html>