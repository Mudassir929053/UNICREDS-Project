<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];
$course_id = $_GET['cid'];
?>



</style>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'course';
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
                                <h1 class="mb-1 h2 fw-bold">Course Information</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">Course Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-course-list.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>

                    </div>


                </div>
                <?php
                $querycourse = $conn->query("SELECT * FROM course 
                                             LEFT JOIN course_learning_details on course_learning_details.cld_course_id = course_id
                                             LEFT JOIN course_enrolment_session ON course_enrolment_session.ces_course_id = course_id
                                             LEFT JOIN user ON course_created_by = user.user_id
                                             LEFT JOIN committee ON committee.committee_user_id = user.user_id
                                             LEFT JOIN institution ON institution.institution_id = committee.committee_institution_id    
                                             WHERE course_id = '$course_id' AND course_deleted_date IS NULL;");

                $num = 1;
                if (mysqli_num_rows($querycourse) > 0) {
                    while ($rows = mysqli_fetch_object($querycourse)) {
                ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow">
                                    <div class="card-header border-bottom px-4 py-3">

                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h4 class="mb-0">Course Details</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editcoursedetail<?php echo $rows->course_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Modal For Edit course information details -->
                                    <div class="modal fade" id="editcoursedetail<?php echo $rows->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursemodal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="coursemodal">Course</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">

                                                        <!-- Card -->
                                                        <div class="card mb-3 shadow">
                                                            <div class="card-header border-bottom px-4 py-3">
                                                                <h4 class="mb-0">Course Information</h4>
                                                            </div>
                                                            <!-- Card body -->
                                                            <div class="card-body">

                                                                <div class="row">
                                                                    <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->course_id; ?>">

                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Course Title :</label>
                                                                        <input style="text-transform:capitalize" id="new_course_title" class="form-control" type="text" placeholder="Course Title" name="new_course_name" value="<?php echo $rows->course_title; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-2">
                                                                        <label class="form-label">Course Code :</label>                     
                                                                        <input id="course_code" class="form-control" type="text" placeholder="Course Code" name="new_course_code" value="<?php echo $rows->course_code; ?>"> 
                                                                    </div>

                                                                    <div class="mb-3 col-md-4">
                                                                        <label class="form-label">Course Level (may select more than one) :</label>
                                                                        <div class="input-group" style="display: inline-block;">
                                                                            <?php
                                                                            $courselevel = $rows->course_level;
                                                                            $arr = explode(",", $courselevel);
                                                                            ?>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_course_level[]" value="1" id="undergraduate<?php echo $rows->course_id; ?>" <?php if (in_array("1", $arr)) {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                } ?>>
                                                                                <label for="undergraduate<?php echo $rows->course_id; ?>">Undergraduate</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_course_level[]" value="2" id="postgraduate<?php echo $rows->course_id; ?>" <?php if (in_array("2", $arr)) {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?>>
                                                                                <label for="postgraduate<?php echo $rows->course_id; ?>">Postgraduate</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-info">
                                                                                <input type="checkbox" name="new_course_level[]" value="3" id="cpd<?php echo $rows->course_id; ?>" <?php if (in_array("3", $arr)) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                                                <label for="cpd<?php echo $rows->course_id; ?>">Continuing and Professional Development</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="mb-3">
                                                                    <label class="form-label">Course Description :</label>
                                                                    <textarea class="form-control" name="new_course_desc" id="editor<?php echo $rows->course_id; ?>"><?php echo $rows->course_description; ?></textarea>
                                                                    <small>A summary of your course.</small>
                                                                    <script>
                                                                        ClassicEditor
                                                                            .create(document.querySelector('#editor<?php echo $rows->course_id; ?>'), {

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
                                                                        <label class="form-label">Course Category :</label>
                                                                        <input class="form-control" type="text" placeholder="Course Category" name="new_course_category" value="<?php echo $rows->course_category; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Course Fee :</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">RM</span>
                                                                            <input class="form-control" type="text" placeholder="Course Fee" name="new_course_fee" value="<?php echo floatval($rows->course_fee / 100); ?>" aria-label="Dollar amount (with dot and two decimal places)">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Estimated Duration :</label>
                                                                        <input id="duration" class="form-control" type="text" placeholder="Course Duration" name="new_course_duration" value="<?php echo $rows->course_duration; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <div class="custom-file-container" data-upload-id="courseCoverImg<?php echo $rows->course_id; ?>" id="courseCoverImg<?php echo $rows->course_id; ?>">
                                                                        <label class="form-label">Course cover image
                                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                                        </label>
                                                                        <label class="custom-file-container__custom-file">
                                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/jpeg, image/png" name="coursecoverimg" id="pictureUpload">
                                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                        </label>
                                                                        <?php if ($rows->course_image != NULL) { ?>
                                                                            <p class="mt-2">Current File Image: <a href="../assets/images/course/<?php echo $rows->course_image; ?>" target="_blank">
                                                                                    <?php echo $rows->course_image; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>
                                                                        <small class="mt-3 d-block">Upload your course image here.
                                                                            Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                                                                            gif, or .png. no text on the image.</small>
                                                                        <div class="custom-file-container__image-preview"></div>
                                                                    </div>
                                                                    <script>
                                                                        if ($("#courseCoverImg<?php echo $rows->course_id; ?>").length)
                                                                            new FileUploadWithPreview("courseCoverImg<?php echo $rows->course_id; ?>", {
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
                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_course">
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

                                                    <img src="../assets/images/course/<?php echo $rows->course_image; ?>" class="rounded card-img-top" alt="" height="250">

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Title</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->course_title; ?></p>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        if ($rows->course_code != NULL) { ?>
                                                            <tr>
                                                                <td width="200px" class="bg-light-info text-dark">Code</td>
                                                                <td>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->course_code; ?></p>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        } else {
                                                        } ?>

                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Description</td>
                                                            <td> <?= (strip_tags(substr($rows->course_description, 0, 50))) ?>...
                                                                <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewDesc<?php echo $rows->course_id; ?>">
                                                                    <span style="color: skyblue;">Read More</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal for mc description -->
                                                        <div class="modal fade" id="modalViewDesc<?php echo $rows->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursedesc" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Micro-credential Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->course_description ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal for mc description -->
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Category</td>
                                                            <td>
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->course_category; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Level</td>
                                                            <td>
                                                                <?php
                                                                $arr = $rows->course_level;
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
                                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->course_duration; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Fee</td>
                                                            <td>
                                                                <?php if ($rows->course_fee == 'Free' || $rows->course_fee == 'free' || $rows->course_fee == 'FREE') { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->course_fee; ?></p>
                                                                <?php } else { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->course_fee / 100); ?></p>
                                                                <?php
                                                                } ?>
                                                            </td>
                                                        </tr>

                                                        <?php if ($rows->course_enrollment_date == 'choosedate') {
                                                        ?>
                                                            <tr>
                                                                <td width="200px" class="bg-light-info text-dark">Enrolment Date</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-between align-items-center ">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <p class="text-dark mb-0 fw-semi-bold">
                                                                                    <?php echo date('d/m/Y', strtotime($rows->ces_start_date)); ?>
                                                                                    <i class="bi bi-arrow-right fs-5 m-1"></i>
                                                                                    <?php echo date('d/m/Y', strtotime($rows->ces_end_date)); ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editdateenrolment<?php echo $rows->course_id; ?><?php echo $rows->ces_id; ?>">
                                                                                    <i class="fe fe-edit me-1 text-warning fs-5" data-bs-toggle="tooltip" data-placement="top" title="Edit Date Enrolment" style="vertical-align: middle;"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for edit enrolment date-->
                                                                    <div class="modal fade" id="editdateenrolment<?php echo $rows->course_id; ?><?php echo $rows->ces_id; ?>" tabindex="-1" role="dialog" aria-labelledby="oncredittransfer" aria-hidden="true">
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
                                                                                            <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->course_id; ?>">
                                                                                            <input id="ces_id" class="form-control" type="hidden" name="ces_id" value="<?php echo $rows->ces_id; ?>">
                                                                                            <label class="form-label fs-4">Date of enrolment :</label>
                                                                                            <label for="no" class="ms-2">Anytime</label>
                                                                                            <input type="radio" name="new_offerdate" value="anytime" <?php if ($rows->course_enrollment_date == 'anytime') : ?> checked="checked" <?php endif ?> onclick="new_offerdate_anytime();" />

                                                                                            <label for="yes" class="ms-2">Choose date</label>
                                                                                            <input type="radio" name="new_offerdate" value="choosedate" <?php if ($rows->course_enrollment_date == 'choosedate') : ?> checked="checked" <?php endif ?> onclick="new_offerdate_date();" />
                                                                                        </div>

                                                                                        <div class="row" id="new_offerdate1">
                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">Start Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="new_course_start_date" placeholder="Select Date" value="<?php echo $rows->ces_start_date; ?>" aria-describedby="basic-addon2">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">End Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="new_course_end_date" placeholder="Select Date" value="<?php echo $rows->ces_end_date; ?>" aria-describedby="basic-addon3">

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
                                                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_course_enrolment_date">
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
                                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#adddateenrollment<?php echo $rows->course_id; ?>">
                                                                                    <i class="fa fa-calendar me-1 text-info fs-5" data-bs-toggle="tooltip" data-placement="top" title="Add Date Enrolment" style="vertical-align: middle;"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal for add enrolment date-->
                                                                    <div class="modal fade" id="adddateenrollment<?php echo $rows->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="oncredittransfer" aria-hidden="true">
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
                                                                                            <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->course_id; ?>">
                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">Start Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="course_start_date" placeholder="Select Date" aria-describedby="basic-addon2">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="mb-3 col-md-6 col-12">
                                                                                                <label class="form-label">End Date :</label>
                                                                                                <div class="input-group me-3">
                                                                                                    <input class="form-control flatpickr" type="text" name="course_end_date" placeholder="Select Date" aria-describedby="basic-addon3">

                                                                                                    <span class="input-group-text text-muted" id="basic-addon3"><i class="fe fe-calendar"></i></span>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="add_course_enrolment_date">
                                                                                        Add Date
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal for add enrolment date-->
                                                            </tr>
                                                        <?php }
                                                        ?>
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
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editcld<?php echo $rows->cld_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="modal fade" id="editcld<?php echo $rows->cld_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cld" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Course Learning Details</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">

                                                            <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->course_id; ?>">
                                                            <input id="cld_id" class="form-control" type="hidden" name="cld_id" value="<?php echo $rows->cld_id; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Learning Outcome :</label>
                                                                <textarea class="form-control" name="new_course_lo" id="editorclo<?php echo $rows->cld_id; ?>"><?php echo $rows->cld_learning_outcome; ?></textarea>
                                                                <small>You must enter learning objectives or outcomes that learners can expect to achieve after completing your course..</small>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#editorclo<?php echo $rows->cld_id; ?>'), {

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
                                                                <textarea class="form-control" name="new_course_il" id="new_course_il<?php echo $rows->cld_id; ?>" placeholder="Example : Undergraduate students/Postgraduate students or worker etc.."><?php echo $rows->cld_intended_learners; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_course_il<?php echo $rows->cld_id; ?>'), {

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
                                                                <textarea class="form-control" name="new_course_prerequisites" id="new_course_prerequisites<?php echo $rows->cld_id; ?>" placeholder="Example : No specific skills or prior technical knowledge required"><?php echo $rows->cld_prerequisites; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_course_prerequisites<?php echo $rows->cld_id; ?>'), {

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
                                                                <textarea class="form-control" name="new_course_skills" id="new_course_skills<?php echo $rows->cld_id; ?>" placeholder="Example : Will be able to create responsive and user friendly web pages"><?php echo $rows->cld_skills; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_course_skills<?php echo $rows->cld_id; ?>'), {

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
                                                        <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_cld">
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
                                                        <?php echo $rows->cld_learning_outcome; ?><br>
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
                                                        <?php echo $rows->cld_intended_learners; ?>
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
                                                        <?php echo $rows->cld_prerequisites; ?>
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
                                                        <?php echo $rows->cld_skills; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                </div>



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