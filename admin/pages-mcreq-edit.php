<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];
$mcid = $_GET['mcid'];
?>



</style>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mcrequest';
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
                                <!-- <a class="btn btn-info waves-effect waves-light btn-sm shadow" href="pages-microcredential-edit.php?mcid=<?php echo $mcid; ?>">
                                    <i class="fe fe-edit fs-5 me-1"></i>Edit</a> -->
                                <!-- <a class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" href="pages-microcredential-content.php?mcid=<?php echo $mcid; ?>">
                                    <i class="fe fe-folder-plus fs-5 me-1"></i> Add Content </a> -->
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-mcreq-list.php">
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
                                            LEFT JOIN mc_mou ON mc_mou.mcm_mc_id = mc_id
                                            LEFT JOIN institution ON mc_owner = institution.institution_id
                                            LEFT JOIN university ON institution.institution_university_id = university.university_id    
                                            where mc_id = '$mcid' AND mc_deleted_date IS NULL;");

                $num = 1;
                if (mysqli_num_rows($querymc) > 0) {
                    while ($rows = mysqli_fetch_object($querymc)) {
                ?>
                        <div class="row">
                            <div class="col-md-8">
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
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editmcdetail<?php echo $rows->mc_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Modal For Edit mc information details -->
                                    <div class="modal fade" id="editmcdetail<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcmodal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mcmodal">Edit Micro-Credential</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">

                                                        <!-- Card -->
                                                        <div class="card mb-3 shadow">
                                                            <div class="card-header border-bottom px-4 py-3">
                                                                <h4 class="mb-0">Micro-Credential Information</h4>
                                                            </div>
                                                            <!-- Card body -->
                                                            <div class="card-body">

                                                                <div class="row">
                                                                    <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">

                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Micro-Credential Title :</label>
                                                                        <input style="text-transform:capitalize" id="new_mc_title" class="form-control" type="text" placeholder="Micro-Credential Title" name="new_mc_name" value="<?php echo $rows->mc_title; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-2">
                                                                        <label class="form-label">Course Code :</label>
                                                                        <input id="mc_code" class="form-control" type="text" placeholder="Micro-Credential Code" name="new_mc_code" value="<?php echo $rows->mc_code; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-4">
                                                                        <label class="form-label">Course Level (may select more than one) :</label>
                                                                        <div class="input-group" style="display: inline-block;">
                                                                            <?php
                                                                            $mclevel = $rows->mc_level;
                                                                            $arr = explode(",", $mclevel);
                                                                            ?>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_mc_level[]" value="1" id="undergraduate<?php echo $rows->mc_id; ?>" <?php if (in_array("1", $arr)) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?>>
                                                                                <label for="undergraduate<?php echo $rows->mc_id; ?>">Undergraduate</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_mc_level[]" value="2" id="postgraduate<?php echo $rows->mc_id; ?>" <?php if (in_array("2", $arr)) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                                                <label for="postgraduate<?php echo $rows->mc_id; ?>">Postgraduate</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_mc_level[]" value="3" id="cpd<?php echo $rows->mc_id; ?>" <?php if (in_array("3", $arr)) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                                <label for="cpd<?php echo $rows->mc_id; ?>">Continuing and Professional Development</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="mb-3">
                                                                    <label class="form-label">Micro-Credential Description :</label>
                                                                    <textarea class="form-control" name="new_mc_desc" id="editor<?php echo $rows->mc_id; ?>"><?php echo $rows->mc_description; ?></textarea>
                                                                    <small>A summary of your micro-credential.</small>
                                                                    <script>
                                                                        ClassicEditor
                                                                            .create(document.querySelector('#editor<?php echo $rows->mc_id; ?>'), {

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
                                                                        <label class="form-label">Micro-Credential Category :</label>
                                                                        <input class="form-control" type="text" placeholder="Micro-Credential Category" name="new_mc_category" value="<?php echo $rows->mc_category; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Micro-Credential Fee :</label>
                                                                        <input class="form-control" type="text" placeholder="Micro-Credential Fee" name="new_mc_fee" value="<?php echo floatval($rows->mc_fee / 100); ?>" aria-label="Dollar amount (with dot and two decimal places)">
                                                                    </div>

                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Estimated Duration :</label>
                                                                        <input id="duration" class="form-control" type="text" placeholder="Micro-Credential Duration" name="new_mc_duration" value="<?php echo $rows->mc_duration; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <div class="custom-file-container" data-upload-id="courseCoverImg<?php echo $rows->mc_id; ?>" id="courseCoverImg<?php echo $rows->mc_id; ?>">
                                                                        <label class="form-label">Micro-Credential cover image
                                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                                        </label>
                                                                        <label class="custom-file-container__custom-file">
                                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="mccoverimg" id="pictureUpload">
                                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                        </label>
                                                                        <?php if ($rows->mc_image != NULL) { ?>
                                                                            <p class="mt-2">Current File Image: <a href="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" target="_blank">
                                                                                    <?php echo $rows->mc_image; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>
                                                                        <small class="mt-3 d-block">Upload your micro-credential image here.
                                                                            Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                                                                            gif, or .png. no text on the image.</small>
                                                                        <div class="custom-file-container__image-preview"></div>
                                                                    </div>
                                                                    <script>
                                                                        if ($("#courseCoverImg<?php echo $rows->mc_id; ?>").length)
                                                                            new FileUploadWithPreview("courseCoverImg<?php echo $rows->mc_id; ?>", {
                                                                                showDeleteButtonOnImages: !0,
                                                                                text: {
                                                                                    chooseFile: " No File Selected",
                                                                                    browse: "Upload File"
                                                                                }
                                                                            });
                                                                    </script>
                                                                </div>

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_mc">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- End Modal For Edit mc information details -->

                                    <div class="card-body">
                                        <div class="row d-flex align-items-stretch">

                                            <div class="col-md-4">
                                                <!-- Card -->
                                                <div class="card mb-4 shadow-lg ">

                                                    <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" class="rounded card-img-top" alt="" height="250">

                                                </div>
                                            </div>
                                            <div class="col-md-8">
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
                                                            <td> <?= (strip_tags(substr($rows->mc_description, 0, 50))) ?>...
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
                                                        <?php
                                                        if ($rows->mc_level != NULL) { ?>
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
                                                        <?php
                                                        } else {
                                                        } ?>
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
                                                                    <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->mc_fee / 100); ?> </p>
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
                                                                        <div>
                                                                            <a class="me-1 text-inherit" href="#">
                                                                                <?php if ($rows->mc_credit_transfer == 'Yes') : ?>
                                                                                    <a href="#" title="Change to non credit transfer" data-bs-toggle="tooltip" data-placement="top" onclick="return notcredittransfer()">
                                                                                        <i class="fas fa-toggle-on text-success fs-3" style="vertical-align: middle;"></i></a>
                                                                                <?php endif ?>
                                                                                <?php if ($rows->mc_credit_transfer == 'No') : ?>
                                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#oncredittransfer<?php echo $rows->mc_id; ?>">
                                                                                        <i class="fas fa-toggle-off text-secondary fs-3" data-bs-toggle="tooltip" data-placement="top" title="Change to credit transfer" style="vertical-align: middle;"></i>
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </a>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for change to credit transfer -->
                                                                    <div class="modal fade" id="oncredittransfer<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="oncredittransfer" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Course Information</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                                        <i class="mb-3"><span class=" fs-4 mb-3">Please state the name of course that enable the credit transfer and the course code</span></i>
                                                                                        <div class="row mt-3">
                                                                                            <div class="mb-3 col-md-6">
                                                                                                <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                                                                <input id="mc_credit_transfer" class="form-control" type="hidden" name="mc_credit_transfer" value="Yes">
                                                                                                <label class="form-label">Course Title :</label>
                                                                                                <input style="text-transform:capitalize" id="mc_course_title" class="form-control" type="text" placeholder="Course Title" name="mc_course_title" autocomplete="off">
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-2">
                                                                                                <label class="form-label">Course Code :</label>
                                                                                                <input id="mc_course_code" class="form-control" type="text" placeholder="Course Code" name="mc_course_code" autocomplete="off">
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-4">
                                                                                                <label class="form-label">Course Level (may select more than one) :</label>
                                                                                                <div class="input-group" style="display: inline-block;">
                                                                                                    <input type="hidden" name="mc_course_level[]">
                                                                                                    <div class="checkbox checkbox-info">
                                                                                                        <input type="checkbox" name="mc_course_level[]" value="1" id="undergraduate">
                                                                                                        <label for="undergraduate">Undergraduate</label>
                                                                                                    </div>
                                                                                                    <div class="checkbox checkbox-info">
                                                                                                        <input type="checkbox" name="mc_course_level[]" value="2" id="postgraduate">
                                                                                                        <label for="postgraduate">Postgraduate</label>
                                                                                                    </div>
                                                                                                    <div class="checkbox checkbox-info">
                                                                                                        <input type="checkbox" name="mc_course_level[]" value="3" id="cpd">
                                                                                                        <label for="cpd">Continuing and Professional Development</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="change_to_transfer_credit">
                                                                                        Edit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal for change to credit transfer -->


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
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editdateenrolment<?php echo $rows->mc_id; ?><?php echo $rows->mces_id; ?>">
                                                                                    <i class="fe fe-edit me-1 text-warning fs-5" data-bs-toggle="tooltip" data-placement="top" title="Edit Date Enrolment" style="vertical-align: middle;"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for edit enrolment date-->
                                                                    <div class="modal fade" id="editdateenrolment<?php echo $rows->mc_id; ?><?php echo $rows->mces_id; ?>" tabindex="-1" role="dialog" aria-labelledby="oncredittransfer" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Date Enrolment</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                                        <div class="mb-2">
                                                                                            <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                                                            <input id="mces_id" class="form-control" type="hidden" name="mces_id" value="<?php echo $rows->mces_id; ?>">
                                                                                            <label class="form-label fs-4">Date of enrolment :</label>
                                                                                            <label for="no" class="ms-2">Anytime</label>
                                                                                            <input type="radio" name="new_offerdate" value="anytime" <?php if ($rows->mc_enrollment_date == 'anytime') : ?> checked="checked" <?php endif ?> onclick="new_offerdate_anytime();" />

                                                                                            <label for="yes" class="ms-2">Choose date</label>
                                                                                            <input type="radio" name="new_offerdate" value="choosedate" <?php if ($rows->mc_enrollment_date == 'choosedate') : ?> checked="checked" <?php endif ?> onclick="new_offerdate_date();" />
                                                                                        </div>

                                                                                        <div class="row" id="new_offerdate1">
                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">Start Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="new_mc_start_date" placeholder="Select Date" value="<?php echo $rows->mces_start_date; ?>" aria-describedby="basic-addon2">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">End Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="new_mc_end_date" placeholder="Select Date" value="<?php echo $rows->mces_end_date; ?>" aria-describedby="basic-addon3">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon3"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="anytime" style="display:none">
                                                                                            <b>
                                                                                                <h3>The current date of enrolment will be deleted</h3>
                                                                                            </b>
                                                                                        </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_enrolment_date">
                                                                                        Edit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal for edit enrolment date-->
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
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#adddateenrollment<?php echo $rows->mc_id; ?>">
                                                                                    <i class="fa fa-calendar me-1 text-info fs-5" data-bs-toggle="tooltip" data-placement="top" title="Add Date Enrolment" style="vertical-align: middle;"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for add enrolment date-->
                                                                    <div class="modal fade" id="adddateenrollment<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="oncredittransfer" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Date Enrolment</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST" enctype="multipart/form-data">


                                                                                        <div class="row">
                                                                                            <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">Start Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="mc_start_date" placeholder="Select Date" aria-describedby="basic-addon2">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">End Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="mc_end_date" placeholder="Select Date" aria-describedby="basic-addon3">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon3"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>


                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="add_enrolment_date">
                                                                                        Add Date
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                <!-- Modal for add enrolment date-->
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Memorandum of Understanding</td>
                                                            <td style='text-align:center; vertical-align:middle'>
                                                                <div class="d-flex justify-content-between align-items-center ">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <a href="../assets/attachment/microcredential/mouattachment/<?php echo $rows->mcm_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View MoU attachment">
                                                                                <span class="badge rounded-pill bg-info fw-semi-bold text-dark"><b></b>View MoU</span></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editmou<?php echo $rows->mc_id; ?><?php echo $rows->mcm_id; ?>">
                                                                                <i class="fas fa-edit me-1 text-warning fs-5" data-bs-toggle="tooltip" data-placement="top" title="Edit MoU attachment" style="vertical-align: middle;"></i>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <div class="modal fade" id="editmou<?php echo $rows->mc_id; ?><?php echo $rows->mcm_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Attachment</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                                <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                                                <input id="mcm_id" class="form-control" type="hidden" name="mcm_id" value="<?php echo $rows->mcm_id; ?>">
                                                                                <input id="institution_id" class="form-control" type="hidden" name="institution_id" value="<?php echo $rows->institution_id; ?>">
                                                                                <div class="mb-3 col-md-12">
                                                                                    <label class="form-label" for="textInput">Attachment :</label>
                                                                                    <div class="custom-file">
                                                                                        <div class="input-group mb-1">
                                                                                            <input type="file" onChange="readURL(this);" class="form-control custom-file-input" name="mcm_attachment" id="mcm_attachment<?php echo $rows->mcm_id; ?>">

                                                                                        </div>
                                                                                    </div>

                                                                                    <?php if ($rows->mcm_attachment != NULL) { ?>
                                                                                        <p>Current File : <a href="../assets/attachment/microcredential/mouattachment/<?php echo $rows->mcm_attachment; ?>" target="_blank">
                                                                                                <?php echo $rows->mcm_attachment; ?></a></p>
                                                                                    <?php } else {
                                                                                    } ?>

                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Collaboration :</label>

                                                                                    <textarea class="form-control" name="new_mcm_collaboration" id="new_mcm_collaboration<?php echo $rows->mcm_id; ?>" placeholder="Describe the collaborators for this course"><?php echo $rows->mcm_collaboration ?></textarea>
                                                                                    <small>Description of collaboration.</small>
                                                                                    <script>
                                                                                        ClassicEditor
                                                                                            .create(document.querySelector('#new_mcm_collaboration<?php echo $rows->mcm_id; ?>'), {

                                                                                            })
                                                                                            .then(editor => {
                                                                                                window.editor = editor;

                                                                                            })
                                                                                            .catch(err => {
                                                                                                console.error(err.stack);
                                                                                            });
                                                                                    </script>
                                                                                </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_mou_attachment">
                                                                                Edit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Collaboration</td>
                                                            <td> <?= (strip_tags(substr($rows->mcm_collaboration, 0, 50))) ?>...
                                                                <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewMOACollab<?php echo $rows->mc_id; ?>">
                                                                    <span style="color: skyblue;">Read More</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal for mc description -->
                                                        <div class="modal fade" id="modalViewMOACollab<?php echo $rows->mc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="collabmoa" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Collaboration Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->mcm_collaboration ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal for mc description -->
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Card -->
                                <div class="card mb-4 shadow">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h4 class="mb-0">Learning Details</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editmcld<?php echo $rows->mcld_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">



                                        <div class="modal fade" id="editmcld<?php echo $rows->mcld_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcld" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Micro-credential Learning Details</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">

                                                            <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                            <input id="mcld_id" class="form-control" type="hidden" name="mcld_id" value="<?php echo $rows->mcld_id; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Learning Outcome :</label>
                                                                <textarea class="form-control" name="new_mc_lo" id="editormclo<?php echo $rows->mcld_id; ?>"><?php echo $rows->mcld_learning_outcome; ?></textarea>
                                                                <small>You must enter learning objectives or outcomes that learners can expect to achieve after completing your course..</small>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#editormclo<?php echo $rows->mcld_id; ?>'), {

                                                                        })
                                                                        .then(editor => {
                                                                            window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                            console.error(err.stack);
                                                                        });
                                                                </script>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Intended Learners of the course :</label>
                                                                <textarea class="form-control" name="new_mc_il" id="new_mc_il<?php echo $rows->mcld_id; ?>" placeholder="Example : Undergraduate students/Postgraduate students or worker etc.."><?php echo $rows->mcld_intended_learners; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_mc_il<?php echo $rows->mcld_id; ?>'), {

                                                                        })
                                                                        .then(editor => {
                                                                            window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                            console.error(err.stack);
                                                                        });
                                                                </script>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">What are the requirements or prerequisites skills/knowledge/experience to enrol in this course? :</label>
                                                                <textarea class="form-control" name="new_mc_prerequisites" id="new_mc_prerequisites<?php echo $rows->mcld_id; ?>" placeholder="Example : No specific skills or prior technical knowledge required"><?php echo $rows->mcld_prerequisites; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_mc_prerequisites<?php echo $rows->mcld_id; ?>'), {

                                                                        })
                                                                        .then(editor => {
                                                                            window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                            console.error(err.stack);
                                                                        });
                                                                </script>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">State/List the specific skills/competencies that participants will be able to achieve at the end of the course :</label>
                                                                <textarea class="form-control" name="new_mc_skills" id="new_mc_skills<?php echo $rows->mcld_id; ?>" placeholder="Example : Will be able to create responsive and user friendly web pages"><?php echo $rows->mcld_skills; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_mc_skills<?php echo $rows->mcld_id; ?>'), {

                                                                        })
                                                                        .then(editor => {
                                                                            window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                            console.error(err.stack);
                                                                        });
                                                                </script>
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_mcld">
                                                            Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                        <!-- Accordion flush -->

                                        <div class="accordion accordion-flush " id="accordionFlushExample">

                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingTwo">Learning Outcome</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->mcld_learning_outcome; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Intended Learners of the course</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->mcld_intended_learners; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Requirements or Prerequisites</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->mcld_prerequisites; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Specific skills/competencies that participants will be able to achieve</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->mcld_skills; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                </div>



                            </div>
                        </div>

                        <?php if ($rows->mc_credit_transfer == 'Yes') { ?>

                            <div class="card mt-3 shadow" id="credittransfer">
                                <div class="card-header border-bottom px-4 py-3">

                                    <div class="d-flex justify-content-between align-items-center ">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="mb-0">Course Information</h4>
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editcoursecredittransfer<?php echo $rows->mccct_id; ?>">
                                                    <i class="fe fe-edit fs-5 me-1"></i>Edit</button>
                                                <a class="btn btn-danger waves-effect waves-light btn-sm shadow text-dark" href="admin-function.php?delete_mccct=<?php echo $rows->mccct_id; ?>&mcid=<?php echo $rows->mc_id; ?>" title="Delete Course Credit Transfer" onclick="return deletemccct()">
                                                    <i class="fe fe-trash fs-5 me-1"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for edit mc course credit transfer -->
                                <div class="modal fade" id="editcoursecredittransfer<?php echo $rows->mccct_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mccct" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Course Information</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="card mb-3 shadow">

                                                        <div class="card-body">
                                                            <input id="mc_id" class="form-control" type="hidden" name="mc_id" value="<?php echo $rows->mc_id; ?>">
                                                            <input id="mccct_id" class="form-control" type="hidden" name="mccct_id" value="<?php echo $rows->mccct_id; ?>">
                                                            <i class="mb-3"><span class=" fs-4 mb-3">Please state the name of course that enable the credit transfer and the course code</span></i>
                                                            <div class="row mt-3">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Course Title :</label>
                                                                    <input style="text-transform:capitalize" id="new_mc_course_title" class="form-control" type="text" placeholder="Course Title" name="new_mc_course_title" value="<?php echo $rows->mccct_course_title; ?>">
                                                                </div>

                                                                <div class="mb-3 col-md-2">
                                                                    <label class="form-label">Course Code :</label>
                                                                    <input id="new_mc_course_code" class="form-control" type="text" placeholder="Course Code" name="new_mc_course_code" value="<?php echo $rows->mccct_course_code; ?>">
                                                                </div>

                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Course Level (may select more than one) :</label>
                                                                    <div class="input-group" style="display: inline-block;">
                                                                        <?php
                                                                        $chkbox = $rows->mccct_course_level;
                                                                        $arr = explode(",", $chkbox);
                                                                        ?>
                                                                        <div class="checkbox checkbox-info">
                                                                            <input type="checkbox" name="new_mc_course_level[]" value="1" id="undergraduate<?php echo $rows->mccct_id; ?>" <?php if (in_array("1", $arr)) {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?>>
                                                                            <label for="undergraduate<?php echo $rows->mccct_id; ?>">Undergraduate</label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-info">
                                                                            <input type="checkbox" name="new_mc_course_level[]" value="2" id="postgraduate<?php echo $rows->mccct_id; ?>" <?php if (in_array("2", $arr)) {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?>>
                                                                            <label for="postgraduate<?php echo $rows->mccct_id; ?>">Postgraduate</label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-info">
                                                                            <input type="checkbox" name="new_mc_course_level[]" value="3" id="cpd<?php echo $rows->mccct_id; ?>" <?php if (in_array("3", $arr)) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                                            <label for="cpd<?php echo $rows->mccct_id; ?>">Continuing and Professional Development</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_course_transfer_credit">
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- Modal for edit mc course credit transfer -->


                                <div class="card-body">
                                    <i class="mb-3"><span class=" fs-4 mb-3">Please state the name of course that enable the credit transfer and the course code</span></i>
                                    <div class="row mt-3">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Course Title :</label>
                                            <input style="text-transform:capitalize" id="new_mc_course_title" class="form-control" type="text" placeholder="Course Title" name="new_mc_course_title" value="<?php echo $rows->mccct_course_title; ?>">
                                        </div>

                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Course Code :</label>
                                            <input id="new_mc_course_code" class="form-control" type="text" placeholder="Course Code" name="new_mc_course_code" value="<?php echo $rows->mccct_course_code; ?>">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Course Level (may select more than one) :</label>
                                            <div class="input-group" style="display: inline-block;">
                                                <?php
                                                $chkbox = $rows->mccct_course_level;
                                                $arr = explode(",", $chkbox);
                                                ?>
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" name="new_mc_course_level[]" value="1" id="undergraduate<?php echo $rows->mccct_id; ?>" <?php if (in_array("1", $arr)) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>>
                                                    <label for="undergraduate<?php echo $rows->mccct_id; ?>">Undergraduate</label>
                                                </div>
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" name="new_mc_course_level[]" value="2" id="postgraduate<?php echo $rows->mccct_id; ?>" <?php if (in_array("2", $arr)) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>>
                                                    <label for="postgraduate<?php echo $rows->mccct_id; ?>">Postgraduate</label>
                                                </div>
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" name="new_mc_course_level[]" value="3" id="cpd<?php echo $rows->mccct_id; ?>" <?php if (in_array("3", $arr)) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                                                    <label for="cpd<?php echo $rows->mccct_id; ?>">Continuing and Professional Development</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        <?php } else {
                        }
                        ?>






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
        function deletemccct() {
            var x = confirm("\nAre you sure want to delete this course information?\n\n Data will be deleted permanently");

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