<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include '../database/dbcon.php';
include('institution-function.php');

$institution_id = $_SESSION['sess_institutionid'];
$ep_id = $_GET['cid'];
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
                                <h1 class="mb-1 h2 fw-bold">Employability Program Information</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="pages-employability-program.php">Employability Program Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-employability-program.php">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                            </div>
                        </div>

                    </div>


                </div>
                <?php
                $querycourse = $conn->query("SELECT * FROM employability_program 
                                            LEFT JOIN user ON course_created_by = user.user_id
                                            LEFT JOIN admin ON admin.admin_user_id = user.user_id 
                                            WHERE ep_id = '$ep_id' AND course_deleted_date IS NULL;");

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
                                                    <h4 class="mb-0">Program Details</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editcoursedetail<?php echo $rows->ep_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Modal For Edit course information details -->
                                    <div class="modal fade" id="editcoursedetail<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursemodal" aria-hidden="true">
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
                                                                    <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->ep_id; ?>">

                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Employability Program Title :</label>
                                                                        <input style="text-transform:capitalize" id="new_course_title" class="form-control" type="text" placeholder="Employability Program Title" name="new_course_name" value="<?php echo $rows->ep_title; ?>">
                                                                    </div>



                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Program Description :</label>
                                                                    <textarea class="form-control" name="new_course_desc" id="editor<?php echo $rows->ep_id; ?>"><?php echo $rows->ep_description; ?></textarea>
                                                                    <small>A summary of your course.</small>
                                                                    <script>
                                                                        ClassicEditor
                                                                            .create(document.querySelector('#editor<?php echo $rows->ep_id; ?>'), {

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
                                                                        <input class="form-control" type="text" placeholder="Course Category" name="new_course_category" value="<?php echo $rows->ep_category; ?>">
                                                                    </div>

                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Course Fee :</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">RM</span>
                                                                            <input class="form-control" type="text" placeholder="Course Fee" name="new_course_fee" value="<?php echo floatval($rows->ep_fee / 100); ?>" aria-label="Dollar amount (with dot and two decimal places)">
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="mb-3">
                                                                    <div class="custom-file-container" data-upload-id="courseCoverImg<?php echo $rows->course_id; ?>" id="courseCoverImg<?php echo $rows->course_id; ?>">
                                                                        <label class="form-label">Course cover image
                                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                                        </label>
                                                                        <label class="custom-file-container__custom-file">
                                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="coursecoverimg" id="pictureUpload">
                                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                        </label>
                                                                        <?php if ($rows->ep_cover_attachment != NULL) { ?>
                                                                            <p class="mt-2">Current File Image: <a href="../assets/images/employability_program/epthumbnails/<?php echo $rows->ep_cover_attachment; ?>" target="_blank">
                                                                                    <?php echo $rows->ep_cover_attachment; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>
                                                                        <small class="mt-3 d-block">Upload your course image here.
                                                                            Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                                                                            gif, or .png. no text on the image.</small>
                                                                        <!-- <div class="custom-file-container__image-preview"></div> -->
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
                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_employability_program">
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

                                                    <img src="../assets/images/employability_program/epthumbnails/<?php echo $rows->ep_cover_attachment; ?>" class="rounded card-img-top" alt="" height="250">

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Title</td>
                                                            <td>
                                                                <p class="text-warning mb-0 fw-semi-bold"><?php echo $rows->ep_title; ?></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Description</td>
                                                            <td> <?= (strip_tags(substr($rows->ep_description, 0, 50))) ?>...
                                                                <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalViewDesc<?php echo $rows->ep_id; ?>">
                                                                    <span style="color: skyblue;">Read More</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal for mc description -->
                                                        <div class="modal fade" id="modalViewDesc<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursedesc" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Micro-credential Description</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="text-justify"><?php echo $rows->ep_description ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal for mc description -->





                                                        <tr>
                                                            <td width="200px" class="bg-light-info text-dark">Fee</td>
                                                            <td>
                                                                <?php if ($rows->ep_fee == 'Free' || $rows->ep_fee == 'free' || $rows->ep_fee == 'FREE') { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->ep_fee; ?></p>
                                                                <?php } else { ?>
                                                                    <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->ep_fee / 100); ?></p>
                                                                <?php
                                                                } ?>
                                                            </td>
                                                        </tr>

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
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editcld<?php echo $rows->ep_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="modal fade" id="editcld<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cld" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Course Learning Details</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">

                                                            <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->ep_id; ?>">
                                                            <input id="cld_id" class="form-control" type="hidden" name="cld_id" value="<?php echo $rows->cld_id; ?>">

                                                            <div class="mb-3">
                                                                <label class="form-label">State/List the specific skills/competencies that participants will be able to achieve at the end of the course :</label>
                                                                <textarea class="form-control" name="new_course_skills" id="new_course_skills<?php echo $rows->ep_id; ?>" placeholder="Example : Will be able to create responsive and user friendly web pages"><?php echo $rows->ep_skills_achieve; ?></textarea>
                                                                <script>
                                                                    ClassicEditor
                                                                        .create(document.querySelector('#new_course_skills<?php echo $rows->ep_id; ?>'), {

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
                                                        <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_employability_program_skills">
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
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Specific skills/competencies that participants will be able to achieve</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <?php echo $rows->ep_skills_achieve; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </div>

                                </div>
                                <div class="card mb-4 shadow">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h4 class="mb-0">Employability Program Video</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <button type="button" class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" data-bs-toggle="modal" data-bs-target="#editvideo<?php echo $rows->ep_id; ?>">
                                                        <i class="fe fe-edit fs-5 me-1"></i>Edit</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    <div class="modal fade" id="editvideo<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cld" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Employability Program Video</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->ep_id; ?>">
                    <input id="cld_id" class="form-control" type="hidden" name="cld_id" value="<?php echo $rows->cld_id; ?>">

                    <div class="card mb-3 shadow">
                        <div class="card-header border-bottom px-4 py-3">
                            <h4 class="mb-0">Employability Program Media</h4>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                <label class="form-label" for="textInput">Employability Program Intro Video :</label>
                                <div class="input-group mb-1">
                                    <input class="dropify form-control" type="file" name="cv_attachment" accept="video/mp4,video/x-m4v,video/*" id="cv_attachment">
                                    <label class="input-group-text" for="cv_file">Upload</label>
                                </div>
                                <small class="mt-3 d-block">Upload your Employability Program intro video here.
                                    Important guidelines: acceptable only .mp4, x-m4v, .ogv, .ogg, .mov,.webm, .mkv format & not should be more than 100MB </small>
                            </div>
                            <?php if ($rows->ep_introvideo!= null) : ?>
                                <div class="mt-3">
                                    <label class="form-label">Existing Video</label>
                                    <p><?php echo $rows->ep_introvideo; ?><a href="../assets/attachment/employability_program/epintrovideos/<?php echo $rows->ep_introvideo; ?>" target="_blank">
                                    <?php echo $rows->ep_introvideo; ?></a></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_employability_program_video">
                    Save Video
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


                                        <!-- Accordion flush -->


                                        <div class="accordion accordion-flush " id="accordionFlushExample">



                                            <div class="accordion-item shadow bg-light rounded mb-3">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button collapsed bg-light-warning" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsevideo" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        <i>
                                                            <h4 class="accordion-header" id="headingThree">Employability Program Intro video</h4>
                                                        </i>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapsevideo" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <video width="100%" controls>
                                                            <source src="../assets/attachment/employability_program/epintrovideos/<?php echo $rows->ep_introvideo; ?>">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="modal fade" id="editvideo<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cld" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Course video Details</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">

                                                        <input id="course_id" class="form-control" type="hidden" name="course_id" value="<?php echo $rows->ep_id; ?>">
                                                        <input id="cld_id" class="form-control" type="hidden" name="cld_id" value="<?php echo $rows->cld_id; ?>">




                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="edit_employability_program_skills">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
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