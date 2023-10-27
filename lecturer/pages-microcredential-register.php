<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('lecturer-function.php');

$lecturer_id = $_SESSION['sess_lecturerid'];
$insti_ID = $_GET['i_id'];

$queryInstitution = $conn->query("SELECT * FROM institution
LEFT JOIN university ON institution_university_id = university.university_id
WHERE institution_id = '$insti_ID' AND institution_deleted_date IS NULL;");

if ($queryInstitution->num_rows > 0) {
    $row_uni = $queryInstitution->fetch_object();
}
?>



</style>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mc';
        include('pages-sidebar.php');
        ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';
            ?>
            <!-- Container fluid -->

            <!-- Page header-->

            <div class="py-4 py-lg-6 bg-primary shadow">
                <div class="container">
                    <div class="row">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <!-- Content -->
                            <div class="mb-4 mb-lg-0">
                                <h1 class="mb-1">Add New Micro-Credential</h1>
                                <p class="mb-0 lead text-white">
                                    Just fill the form and create your micro-credential.
                                </p>
                            </div>
                            <div>
                                <a href="pages-microcredential-list.php" class="btn btn-sm btn-info shadow"><i class="mdi mdi-keyboard-backspace me-2"></i>Back to menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="pb-12">
                <div class="container">
                    <div id="courseForm" class="bs-stepper">
                        <div class="row">
                            <div>
                                <!-- Stepper Button -->
                                <div class="bs-stepper-header shadow" role="tablist">
                                    <div class="step" data-target="#test-l-1">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Section 1</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-2">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Section 2</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-3">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger3" aria-controls="test-l-3">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Section 3</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-4">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="test-l-4">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Section 4</span>
                                        </button>
                                    </div>
                                    <!-- <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-4">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="test-l-4">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Settings</span>
                                        </button>
                                    </div> -->
                                </div>
                                <!-- Stepper content -->
                                <div class="bs-stepper-content mt-5">
                                    <form action="" method="POST" enctype="multipart/form-data" id="mcdetail">
                                        <!-- Content one -->
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                            <!-- Card -->
                                            <div class="card mb-3 shadow">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Micro-Credential Information</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                <input type="hidden" name="institution_id" value="<?php echo $insti_ID;?>">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Micro-Credential Title :</label>
                                                            <input style="text-transform:capitalize" id="mc_title" class="form-control" type="text" placeholder="Micro-Credential Title" name="mc_title" autocomplete="off" required>
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label">Course Code :</label>
                                                            <input id="mccode" class="form-control" type="text" placeholder="Micro-Credential Code" name="mc_code" autocomplete="off">
                                                        </div>

                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Course Level (may select more than one) :</label>
                                                            <div class="input-group" style="display: inline-block;" >
                                                            <!-- <input type="hidden" name="mc_level[]" value="0"> -->
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="mc_level[]" value="1" id="mc_undergraduate">
                                                                    <label for="mc_undergraduate">Undergraduate</label>
                                                                </div>
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="mc_level[]" value="2" id="mc_postgraduate">
                                                                    <label for="mc_postgraduate">Postgraduate</label>
                                                                </div>
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="mc_level[]" value="3" id="mc_cpd" checked>
                                                                    <label for="mc_cpd">Continuing and Professional Development</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <i><label class="form-label fs-4">Date of enrolment :</label></i>
                                                        <label for="no" class="ms-2">Anytime</label>
                                                        <input type="radio" name="offerdate" value="anytime" onclick="offerdate1();" checked="checked"/>

                                                        <label for="yes" class="ms-2">Choose date</label>
                                                        <input type="radio" name="offerdate" value="choosedate" onclick="offerdate2();" />
                                                    </div>

                                                    <div class="row" id="offerdate" style="display:none">
                                                    <div class="mb-3 col-md-6 col-12">
                                                        <label class="form-label">Start Date :</label>
                                                        <div class="input-group me-3">
                                                            <input class="form-control flatpickr" type="text" name="mc_start_date" placeholder="Select Date" aria-describedby="basic-addon2">

                                                            <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                        </div>
                                                    </div>
                                                    <!-- form group -->
                                                    <div class="mb-3 col-md-6 col-12">
                                                        <label class="form-label">End Date :</label>
                                                        <div class="input-group me-3">
                                                            <input class="form-control flatpickr" type="text" name="mc_end_date" placeholder="Select Date" aria-describedby="basic-addon3">

                                                            <span class="input-group-text text-muted" id="basic-addon3"><i class="fe fe-calendar"></i></span>

                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Micro-Credential Description :</label>
                                                        <textarea class="form-control" name="mc_desc" id="editormcdesc1"></textarea>
                                                        <small>A summary of your micro-credential.</small>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#editormcdesc1'), {

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
                                                            <input id="mc_category" class="form-control" type="text" placeholder="Micro-Credential Category" name="mc_category" autocomplete="off">
                                                            <!-- <select class="selectpicker" data-width="100%" name="mc_category" id="field_id">
                                                                <option value="" selected disabled>Select Category</option>
                                                                <option value="Soft Skills and Professional Development Course">Soft Skills and Professional Development Course</option>
                                                                <option value="Career and Industry Specific Course">Career and Industry Specific Course</option>
                                                                <option value="Professional Certification Course">Professional Certification Course</option>
                                                            </select>
                                                            <h6 class="mt-1"><i>Explanation of micro-credential category </i> <a href="#" class="me-6 text-inherit" data-bs-toggle="modal" data-bs-target="#categorydetails">
                                                                    <i class="bi bi-info-circle fs-4 me-2" data-bs-toggle="tooltip" data-placement="top" title="View category details" style="vertical-align: middle;"></i></a></h6> -->
                                                        </div>

                                                        <div class="mb-3 col-md-3">
                                                            <label class="form-label">Micro-Credential Fee :</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">RM</span>
                                                                <input class="form-control" type="text" placeholder="Micro-Credential Fee" name="mc_fee" aria-label="Dollar amount (with dot and two decimal places)" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-md-3">
                                                            <label class="form-label">Estimated Duration :</label>
                                                            <input id="duration" class="form-control" type="text" placeholder="Micro-Credential Duration" name="mc_duration" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label class="form-label">Does the course lead to credit transfer to existing academic programme <?php if ( $row_uni->university_name != 'Unicreds') {echo 'in <b class="fs-5 text-warning">'. $row_uni->university_name;} else {} ?></b> ? :</label>
                                                        <label for="no" class="ms-2">No</label>
                                                        <input type="radio" name="tab" value="No" onclick="show1();" checked="checked" />

                                                        <label for="yes" class="ms-2">Yes</label>
                                                        <input type="radio" name="tab" value="Yes" onclick="show2();" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mb-3 shadow" id="credittransfer" style="display:none">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Course Information</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <i class="mb-3"><span class=" fs-4 mb-3">Please state the name of course that enable the credit transfer and the course code</span></i>
                                                    <div class="row mt-3">
                                                        <div class="mb-3 col-md-6">
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
                                                                <!-- <input type="hidden" name="mc_course_level[]" value="0"> -->
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
                                            </div>
                                            <!-- Button -->
                                            <button class="btn btn-primary btn-sm shadow" onclick="courseForm.next()">
                                                Next
                                            </button>
                                        </div>
                                        <!-- Content two -->
                                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                            <!-- Card -->
                                            <div class="card mb-3 shadow">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">About Micro-Credential</h4>
                                                </div>

                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Learning Outcome :</label>
                                                        <textarea class="form-control" name="mc_lo" id="editormclo"></textarea>
                                                        <small>You must enter learning objectives or outcomes that learners can expect to achieve after completing your course..</small>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#editormclo'), {

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
                                                        <textarea class="form-control" name="mc_il" id="mc_il" placeholder="Example : Undergraduate students/Postgraduate students or worker etc.."></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#mc_il'), {

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
                                                        <textarea class="form-control" name="mc_prerequisites" id="mc_prerequisites" placeholder="Example : No specific skills or prior technical knowledge required"></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#mc_prerequisites'), {

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
                                                        <textarea class="form-control" name="mc_skills" id="mc_skills" placeholder="Example : Will be able to create responsive and user friendly web pages"></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#mc_skills'), {

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
                                            </div>
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-secondary shadow" onclick="courseForm.previous()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-sm btn-primary shadow" onclick="courseForm.next()">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Content three -->
                                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                            <!-- Card -->
                                            <div class="card mb-3 shadow">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Micro-Credential Media</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                                        <label class="form-label">Micro-Credential cover image
                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                        </label>
                                                        <label class="custom-file-container__custom-file">
                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="mccoverimg" id="pictureUpload" required>
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                        </label>
                                                        <small class="mt-3 d-block">Upload your micro-credential image here.
                                                            Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                                                            gif, or .png. no text on the image.</small>
                                                        <div class="custom-file-container__image-preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-secondary shadow" onclick="courseForm.previous()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-sm btn-primary shadow" onclick="courseForm.next()">
                                                    Next
                                                </button>
                                            </div>
                                        </div>

                                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">

                                            <div class="card mb-3  border-0">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Memorandum of Agreement (MOA)</h4>
                                                </div>

                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="textInput">Attachment :</label>
                                                        <div class="input-group mb-1">
                                                            <input class="dropify form-control" type="file" name="mou_attachment" id="mou_attachment" required>
                                                            <label class="input-group-text" for="mou_attachment">Upload</label>
                                                        </div>
                                                        <small class="form-control-feedback">*Please upload attachment of MOA with <?php if ($row_uni->university_name != 'Unicreds') {
                                                                                                                        echo '<b class="fs-5 text-warning">' . $row_uni->university_name;
                                                                                                                    } else {
                                                                                                                    } ?></b></small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Collaboration :</label>

                                                        <textarea class="form-control" name="mcm_collaboration" id="mcm_collaboration" placeholder="Describe the collaborators for this course"></textarea>
                                                        <small>Description of collaboration.</small>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#mcm_collaboration'), {

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
                                            </div>
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-secondary shadow" onclick="courseForm.previous()">
                                                    Previous
                                                </button>
                                                <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="add_microcredential">
                                                    Submit
                                                </button>
                                            </div>

                                        </div>

                                        <!-- <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                                         
                                            <div class="card mb-3  border-0">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Requirements</h4>
                                                </div>
                                               
                                                <div class="card-body">
                                                    <input name='tags' value='jquery, bootstrap' autofocus>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mb-22">
                                                
                                                <button class="btn btn-secondary mt-5" onclick="courseForm.previous()">
                                                    Previous
                                                </button>
                                                <button type="submit" class="btn btn-danger mt-5">
                                                    Submit For Review
                                                </button>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>


    <script>
        function show1() {
            $("#credittransfer").hide();
        }

        function show2() {
            $("#credittransfer").show();
        }

        function offerdate1() {
            $("#offerdate").hide();
        }

        function offerdate2() {
            $("#offerdate").show();
        }

        
    </script>
</body>

</html>