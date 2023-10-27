<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('lecturer-function.php');

$lecturer_id = $_SESSION['sess_lecturerid'];

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

            <!-- Page header-->

            <div class="py-4 py-lg-6 bg-primary shadow">
                <div class="container">
                    <div class="row">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <!-- Content -->
                            <div class="mb-4 mb-lg-0">
                                <h1 class="mb-1">Add New Course</h1>
                                <p class="mb-0 lead text-white">
                                    Just fill the form and create your course.
                                </p>
                            </div>
                            <div>
                                <a href="pages-course-list.php" class="btn btn-sm btn-info shadow"><i class="mdi mdi-keyboard-backspace me-2"></i>Back to menu</a>
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

                                </div>
                                <!-- Stepper content -->
                                <div class="bs-stepper-content mt-5">
                                    <form action="" method="POST" enctype="multipart/form-data" id="coursedetail">
                                        <!-- Content one -->
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                            <!-- Card -->
                                            <div class="card mb-3 shadow">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Course Information</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                <!-- <input type="hidden" name="institution_id" value="<?php echo $insti_ID;?>"> -->
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Course Title :</label>
                                                            <input style="text-transform:capitalize" id="course_title" class="form-control" type="text" placeholder="Course Title" name="course_title" autocomplete="off">
                                                        </div>

                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label">Course Code :</label>
                                                            <input id="course_code" class="form-control" type="text" placeholder="Code Code" name="course_code" autocomplete="off">
                                                            <small>*Optional</small>
                                                        </div>

                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Course Level (may select more than one) :</label>
                                                            <div class="input-group" style="display: inline-block;">
                                                            <!-- <input type="hidden" name="mc_level[]" value="0"> -->
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="course_level[]" value="1" id="course_undergraduate">
                                                                    <label for="course_undergraduate">Undergraduate</label>
                                                                </div>
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="course_level[]" value="2" id="course_postgraduate">
                                                                    <label for="course_postgraduate">Postgraduate</label>
                                                                </div>
                                                                <div class="checkbox checkbox-info">
                                                                    <input type="checkbox" name="course_level[]" value="3" id="course_cpd">
                                                                    <label for="course_cpd">Continuing and Professional Development</label>
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
                                                            <input class="form-control flatpickr" type="text" name="course_start_date" placeholder="Select Date" aria-describedby="basic-addon2">

                                                            <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                        </div>
                                                    </div>
                                                    <!-- form group -->
                                                    <div class="mb-3 col-md-6 col-12">
                                                        <label class="form-label">End Date :</label>
                                                        <div class="input-group me-3">
                                                            <input class="form-control flatpickr" type="text" name="course_end_date" placeholder="Select Date" aria-describedby="basic-addon3">

                                                            <span class="input-group-text text-muted" id="basic-addon3"><i class="fe fe-calendar"></i></span>

                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Course Description :</label>
                                                        <textarea class="form-control" name="course_desc" id="editorcoursedesc1"></textarea>
                                                        <small>A summary of your course.</small>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#editorcoursedesc1'), {

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
                                                            <input id="course_category" class="form-control" type="text" placeholder="Course Category" name="course_category" autocomplete="off">
                                                             </div>

                                                        <div class="mb-3 col-md-3">
                                                            <label class="form-label">Course Fee :</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">RM</span>
                                                                <input class="form-control" type="text" placeholder="Course Fee" name="course_fee" aria-label="Dollar amount (with dot and two decimal places)" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-md-3">
                                                            <label class="form-label">Estimated Duration :</label>
                                                            <input id="duration" class="form-control" type="text" placeholder="Course Duration" name="course_duration" autocomplete="off">
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
                                                    <h4 class="mb-0">About Course</h4>
                                                </div>

                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Learning Outcome :</label>
                                                        <textarea class="form-control" name="course_lo" id="editorcourselo"></textarea>
                                                        <small>You must enter learning objectives or outcomes that learners can expect to achieve after completing your course..</small>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#editorcourselo'), {

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
                                                        <textarea class="form-control" name="course_il" id="course_il" placeholder="Example : Undergraduate students/Postgraduate students or worker etc.."></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#course_il'), {

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
                                                        <textarea class="form-control" name="course_prerequisites" id="course_prerequisites" placeholder="Example : No specific skills or prior technical knowledge required"></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#course_prerequisites'), {

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
                                                        <textarea class="form-control" name="course_skills" id="course_skills" placeholder="Example : Will be able to create responsive and user friendly web pages"></textarea>
                                                        <script>
                                                            ClassicEditor
                                                                .create(document.querySelector('#course_skills'), {

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
                                                    <h4 class="mb-0">Course Media</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                                        <label class="form-label">Course cover image
                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                        </label>
                                                        <label class="custom-file-container__custom-file">
                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="coursecoverimg" id="pictureUpload" required>
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                        </label>
                                                        <small class="mt-3 d-block">Upload your course image here.
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
                                                <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="add_course">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>

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