<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];

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
                                <h1 class="mb-1">Add Employability Program</h1>
                                <p class="mb-0 lead text-white">
                                    Just fill the form and create your Employability Program.
                                </p>
                            </div>
                            <div>
                                <a href="pages-employability-program.php" class="btn btn-sm btn-info shadow"><i class="mdi mdi-keyboard-backspace me-2"></i>Back to menu</a>
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
                                    <form action="" method="POST" enctype="multipart/form-data" id="mcdetail">
                                        <!-- Content one -->
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                            <!-- Card -->
                                            <div class="card mb-3 shadow">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Employability Program Information</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                <!-- <input type="hidden" name="institution_id" value="<?php echo $insti_ID;?>"> -->
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">Employability Program Title :</label>
                                                            <input style="text-transform:capitalize" id="course_title" class="form-control" type="text" placeholder="Employability Program" name="course_title" autocomplete="off">
                                                        </div>

                                                       

                                                       
                                                    </div>

                                                   

                                                   

                                                    <div class="mb-3">
                                                        <label class="form-label">Employability Program Description :</label>
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
                                                            <label class="form-label">Employability Program Category :</label>
                                                            <input id="course_category" class="form-control" type="text" placeholder="Employability Program Category" name="course_category" autocomplete="off">
                                                             </div>

                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Employability Program Fee :</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">RM</span>
                                                                <input class="form-control" type="text" placeholder="Employability Program Fee" name="course_fee" aria-label="Dollar amount (with dot and two decimal places)" autocomplete="off">
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
                                                    <h4 class="mb-0">About Employability Program</h4>
                                                </div>

                                                <div class="card-body">
                                                  

                                                    <div class="mb-3">
                                                        <label class="form-label">State/List the specific skills/competencies that participants will be able to achieve at the end of the Employability Program :</label>
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
                                                    <label class="form-label" for="textInput">Employability Program Intro Video :</label>              
                                                    <div class="input-group mb-1">
                                                    <input class="dropify form-control" type="file" name="cv_attachment" accept="video/mp4, video/webm" id="cv_attachment">
                                                    <label class="input-group-text">Upload</label>
                                                    </div>
                                                    <small class="mt-3 d-block">Upload your Employability Program intro video here.
                                                            Important guidelines:acceptable only .mp4, x-m4v, .ogv, .ogg, .mov,.webm, .mkv farmat & not should be More than 100MB </small>

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
                                                    <h4 class="mb-0">Employability Program Media</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                                        <label class="form-label">Employability Program cover image
                                                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                                        </label>
                                                        <label class="custom-file-container__custom-file">
                                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/jpeg, image/png" name="coursecoverImg" id="pictureUpload" required>
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
                                                <button type="submit" id="submit" class="btn btn-success btn-sm shadow" name="add_employability_program">
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