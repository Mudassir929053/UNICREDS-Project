<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];
$course_id = $_GET['cid'];

@$assessment_type = $_SESSION['assessment_type'];
?>



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
         <!-- Container fluid -->
         <div class="container-fluid p-4">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-12">
                  <!-- Page Header -->
                  <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                     <div class="mb-3 mb-md-0">
                        <h1 class="mb-1 h2 fw-bold">Course Assessment</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="pages-course-list.php">Course</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Course Assessment</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>
                     <div>
                        <a class="btn btn-sm btn-primary waves-effect waves-light shadow" href="pages-course-content.php?cid=<?php echo $course_id; ?>">
                           <i class="fas fa-pen-square me-1"></i> Manage Content </a>
                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-course-list.php">
                           <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card rounded-3">
               <!-- Card header -->
               <div class="card-header border-bottom-0 p-0">
                  <div>
                     <!-- Nav -->
                     <ul class="nav nav-lb-tab" id="tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link <?php if ($assessment_type == "Quiz") {
                                                   echo "active";
                                                } else if ($assessment_type == NULL) {
                                                   echo "active";
                                                } ?>" id="quiz-tab" data-bs-toggle="pill" href="#quiz" role="tab" aria-controls="quiz" aria-selected="true">Quiz</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?php if ($assessment_type == "Test") {
                                                   echo "active";
                                                } ?>" id="test-tab" data-bs-toggle="pill" href="#test" role="tab" aria-controls="test" aria-selected="false">Test</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?php if ($assessment_type == "Tutorial") {
                                                   echo "active";
                                                } ?>" id="tutorial-tab" data-bs-toggle="pill" href="#tutorial" role="tab" aria-controls="tutorial" aria-selected="false">Tutorial</a>
                        </li>

                     </ul>
                  </div>
               </div>
               <!-- Card Body -->
               <div class="card-body">
                  <div class="tab-content" id="tabContent">
                     <div class="tab-pane <?php if ($assessment_type == "Quiz") {
                                             echo "active";
                                          } else if ($assessment_type == NULL) {
                                             echo "active";
                                          } ?>" id="quiz" role="tabpanel" aria-labelledby="quiz-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querycq = $conn->query("SELECT * FROM course_quiz
                                                     LEFT JOIN course ON course.course_id = cq_course_id
                                                     WHERE cq_deleted_date IS NULL AND cq_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($querycq) > 0) {
                              while ($rows = mysqli_fetch_object($querycq)) {

                           ?>
                                 <div class="accordion" id="quizlist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->cq_id ?>" aria-controls="viddetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->cq_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>

                                                   <span style="vertical-align: middle;" class="<?php if ($rows->cq_status == 'Published') {
                                                                                                   echo "badge bg-success ";
                                                                                                } else {
                                                                                                   echo "badge bg-warning ";
                                                                                                } ?>"><?php echo $rows->cq_status; ?></span>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->cq_status == 'Published') : ?>
                                                         <a href="committee-function.php?unpublish_cq=<?php echo $rows->cq_id; ?>" title="Unpublish Quiz" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishquiz()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->cq_status == 'Save Only') : ?>
                                                         <a href="committee-function.php?publish_cq=<?php echo $rows->cq_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Quiz" onclick="return publishquiz()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>

                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditquiz<?php echo $rows->cq_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaleditquiz<?php echo $rows->cq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcq" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Edit Quiz</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="" method="POST" enctype="multipart/form-data">
                                                                  <div class="mb-3">
                                                                     <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                     <input type="hidden" name="cq_id" value="<?php echo $rows->cq_id; ?>">

                                                                     <label class="form-label" for="textInput">Quiz Title :</label>
                                                                     <input type="text" id="new_cq_title" name="new_cq_title" value="<?php echo $rows->cq_title; ?>" class="form-control" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                     <label class="form-label">Quiz Instruction</label>
                                                                     <textarea class="form-control" name="new_cq_instruction" id="editor<?php echo $rows->cq_id; ?>"><?php echo $rows->cq_instruction; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editor<?php echo $rows->cq_id; ?>'), {

                                                                           })
                                                                           .then(editor<?php echo $rows->cq_id; ?> => {
                                                                              window.editor = editor;

                                                                           })
                                                                           .catch(err => {
                                                                              console.error(err.stack);
                                                                           });
                                                                     </script>
                                                                  </div>

                                                                  <div class="mb-3">
                                                                     <label class="form-label">Quiz Duration :</label>
                                                                     <div class="input-group">
                                                                        <input name="new_cq_duration" id="new_quiz_duration" type="text" value="<?php echo $rows->cq_duration; ?>" class="form-control maskedTextField" onChange="check0(this)">
                                                                        <div class="input-group-append">
                                                                           <span class="input-group-text">Minutes</span>
                                                                        </div>
                                                                     </div>
                                                                  </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-success btn-sm" name="edit_cq">Save</button>
                                                            </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <a href="committee-function.php?delete_cq=<?php echo $rows->cq_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletecq()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->cq_id ?>" aria-controls="quizdetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span></a>
                                                </div>
                                             </div>

                                             <div id="quizdetail<?php echo $rows->cq_id ?>" class="collapse" data-bs-parent="#quizdetail">
                                                <div class="card-body rounded p-3 mt-2">
                                                   <div class="table-responsive">
                                                      <table class="table table-bordered display no-wrap mb-0" style="width:100%">
                                                         <thead class="table-info">
                                                            <tr class="text-center">
                                                               <th>Instruction</th>
                                                               <th width="300px">Duration</th>

                                                               <th width="160px">Quiz Question</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody class="align-middle">

                                                            <tr>
                                                               <td>
                                                                  <p style="vertical-align: middle;"><?php echo $rows->cq_instruction; ?></p>
                                                               </td>
                                                               <td>
                                                                  <center><?php if (($rows->cq_duration) != 0) {
                                                                              echo hoursandmins($rows->cq_duration, '%2d Hours and %2d Minutes');
                                                                           } ?>
                                                                  </center>
                                                               </td>
                                                               <td>
                                                                  <a href="pages-course-assessment-quiz.php?cid=<?php echo $course_id; ?>&cq_id=<?php echo $rows->cq_id ?>" data-bs-toggle="tooltip" data-placement="top" title="Add Question">
                                                                     <span class="badge rounded-pill bg-info">
                                                                        <i class="fe fe-plus-circle fs-4 me-1" style="vertical-align: middle;">
                                                                        </i>Customize Question
                                                                     </span>
                                                                  </a>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              <?php }
                           } else {
                              ?>

                              <div class="col-lg-12 col-md-12 col-12 text-center">
                                 <i class="mdi mdi-48px mdi-text-box-remove"></i>
                                 <h4 class="card-title">No Quiz Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursequiz">Add Quiz +</a>

                        <div class="modal fade" id="addcoursequiz" tabindex="-1" role="dialog" aria-labelledby="coursequizmodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="coursequizmodal">Add New Quiz</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmcquiz_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                          <label class="form-label" for="textInput">Quiz Title :</label>
                                          <input type="text" id="cq_title" name="cq_title" class="form-control" placeholder="Quiz title" required>
                                       </div>


                                       <div class="mb-3">
                                          <label class="form-label">Quiz Instruction</label>
                                          <textarea class="form-control" name="cq_instruction" id="editorquiz"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editorquiz'), {

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
                                          <label class="form-label">Quiz Duration :</label>
                                          <div class="input-group">
                                             <input name="cq_duration" id="quiz_duration" type="text" class="form-control maskedTextField" onChange="check0(this)">
                                             <div class="input-group-append">
                                                <span class="input-group-text">Minutes</span>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="cq_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_course_quiz">Save</button>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>

                     <div class="tab-pane <?php if ($assessment_type == "Test") {
                                             echo "active";
                                          } ?>" id="test" role="tabpanel" aria-labelledby="test-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <!-- List group -->
                           <?php
                           $queryct = $conn->query("SELECT * FROM course_test
                                                     LEFT JOIN course ON course.course_id = ct_course_id 
                                                     WHERE ct_deleted_date IS NULL AND ct_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($queryct) > 0) {
                              while ($rows = mysqli_fetch_object($queryct)) {

                           ?>

                                 <div class="list-group list-group-flush border-top-0" id="testlist">
                                    <div>
                                       <div class="list-group-item rounded m-1">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <h5 class="mb-0">
                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#testdetail<?php echo $rows->ct_id ?>" aria-controls="testdetail">
                                                   <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                   <span class="align-middle"><?php echo $rows->ct_title ?></span>
                                                </a>
                                             </h5>
                                             <div>
                                                <span class="<?php if ($rows->ct_status == 'Published') {
                                                                  echo "badge bg-success";
                                                               } else {
                                                                  echo "badge bg-warning";
                                                               } ?>"><?php echo $rows->ct_status; ?></span>


                                                <a class="me-1 text-inherit" href="#">
                                                   <?php if ($rows->ct_status == 'Published') : ?>
                                                      <a href="committee-function.php?unpublish_ct=<?php echo $rows->ct_id; ?>" title="Unpublish Test" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishtest()">
                                                         <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                   <?php endif ?>
                                                   <?php if ($rows->ct_status == 'Save Only') : ?>
                                                      <a href="committee-function.php?publish_ct=<?php echo $rows->ct_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Test" onclick="return publishtest()">
                                                         <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                   <?php endif ?>
                                                </a>

                                                <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $rows->ct_id; ?>">
                                                   <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                <div class="modal fade" id="modaledit<?php echo $rows->ct_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editct" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Edit Test</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                               <div class="mb-3">
                                                                  <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                  <input type="hidden" name="ct_id" value="<?php echo $rows->ct_id; ?>">

                                                                  <label class="form-label" for="textInput">Title :</label>
                                                                  <input type="text" id="new_ct_title" name="new_ct_title" value="<?php echo $rows->ct_title; ?>" class="form-control" required>
                                                               </div>
                                                               <div class="mb-3">
                                                                  <label class="form-label">Test Instruction</label>
                                                                  <textarea class="form-control" name="new_ct_instruction" id="editor<?php echo $rows->ct_id; ?>"><?php echo $rows->ct_instruction; ?></textarea>

                                                                  <script>
                                                                     ClassicEditor
                                                                        .create(document.querySelector('#editor<?php echo $rows->ct_id; ?>'), {

                                                                        })
                                                                        .then(editor<?php echo $rows->ct_id; ?> => {
                                                                           window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                           console.error(err.stack);
                                                                        });
                                                                  </script>
                                                               </div>

                                                               <div class="mb-3">
                                                                  <label class="form-label">Test Duration :</label>
                                                                  <div class="input-group">
                                                                     <input name="new_ct_duration" id="new_test_duration" type="text" value="<?php echo $rows->ct_duration; ?>" class="form-control maskedTextField" onChange="check0(this)">
                                                                     <div class="input-group-append">
                                                                        <span class="input-group-text">Minutes</span>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                         </div>

                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success btn-sm" name="edit_ct">Save</button>
                                                         </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>

                                                <a href="committee-function.php?delete_ct=<?php echo $rows->ct_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletect()">
                                                   <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#testdetail<?php echo $rows->ct_id ?>" aria-controls="testdetail">
                                                   <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                </a>
                                             </div>
                                          </div>
                                          <div id="testdetail<?php echo $rows->ct_id ?>" class="collapse" data-bs-parent="#testdetail">
                                             <div class="card-body rounded p-3 mt-2">
                                                <div class="table-responsive">
                                                   <table class="table table-bordered text-nowrap mb-0" style="width:100%">
                                                      <thead class="table-info">
                                                         <tr class="text-center">
                                                            <th>Instruction</th>
                                                            <th width="300px">Duration</th>

                                                            <th width="160px">Test Question</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody class="align-middle">

                                                         <tr>
                                                            <td>
                                                               <p style="vertical-align: middle;"><?php echo $rows->ct_instruction; ?></p>
                                                            </td>
                                                            <td>
                                                               <center><?php if (($rows->ct_duration) != 0) {
                                                                           echo hoursandmins($rows->ct_duration, '%2d Hours and %2d Minutes');
                                                                        } ?></center>
                                                            </td>
                                                            <td> <a href="pages-course-assessment-test.php?cid=<?php echo $course_id; ?>&ct_id=<?php echo $rows->ct_id ?>" data-bs-toggle="tooltip" data-placement="top" title="Add Question">
                                                                  <span class="badge rounded-pill bg-info"><i class="fe fe-plus-circle fs-4 me-1" style="vertical-align: middle;"></i>Customize Question </span></a></td>

                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </div>

                                             </div>
                                          </div>


                                       </div>
                                    </div>
                                 </div>
                              <?php }
                           } else {
                              ?>
                              <div class="col-lg-12 col-md-12 col-12 text-center">
                                 <i class="mdi mdi-48px mdi-note-remove"></i>
                                 <h4 class="card-title">No Test Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addmctest">Add Test +</a>

                        <div class="modal fade" id="addmctest" tabindex="-1" role="dialog" aria-labelledby="mctestmodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="mctestmodal">Add New Test</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmctest_form" autocomplete="off">
                                       <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                       <div class="mb-3">
                                          <label class="form-label" for="textInput">Title :</label>
                                          <input type="text" id="ct_title" name="ct_title" class="form-control" placeholder="Test title" required>
                                       </div>


                                       <div class="mb-3">
                                          <label class="form-label">Test Instruction</label>
                                          <textarea class="form-control" name="ct_instruction" id="editorregtest"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editorregtest'), {

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
                                          <label class="form-label">Test Duration :</label>
                                          <div class="input-group">
                                             <input name="ct_duration" id="test_duration" type="text" class="form-control maskedTextField" onChange="check1(this)">
                                             <div class="input-group-append">
                                                <span class="input-group-text">Minutes</span>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="ct_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_course_test">Save</button>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>

                     <div class="tab-pane <?php if ($assessment_type == "Tutorial") {
                                             echo "active";
                                          } ?>" id="tutorial" role="tabpanel" aria-labelledby="tutorial-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $queryctu = $conn->query("SELECT * FROM course_tutorial
                                                      LEFT JOIN course ON course.course_id = ctu_course_id
                                                      LEFT JOIN course_tutorial_duedate ON course_tutorial_duedate.ctud_course_tutorial_id = ctu_id  
                                                      WHERE ctu_deleted_date IS NULL AND ctu_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($queryctu) > 0) {
                              while ($rows = mysqli_fetch_object($queryctu)) {

                           ?>
                                 <div class="accordion" id="tutoriallist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#tutorialdetail<?php echo $rows->ctu_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="tutorialdetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->ctu_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
                                                   <span class="<?php if ($rows->ctu_status == 'Published') {
                                                                     echo "badge bg-success";
                                                                  } else {
                                                                     echo "badge bg-warning";
                                                                  } ?>"><?php echo $rows->ctu_status; ?></span>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->ctu_status == 'Published') : ?>
                                                         <a href="committee-function.php?unpublish_ctu=<?php echo $rows->ctu_id; ?>" title="Unpublish Tutorial" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishtutorial()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->ctu_status == 'Save Only') : ?>
                                                         <a href="committee-function.php?publish_ctu=<?php echo $rows->ctu_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Tutorial" onclick="return publishtutorial()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>

                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaledittutorial<?php echo $rows->ctu_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaledittutorial<?php echo $rows->ctu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmctu" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Edit Tutorial</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="" method="POST" enctype="multipart/form-data">
                                                                  <div class="mb-3">
                                                                     <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                     <input type="hidden" name="ctu_id" value="<?php echo $rows->ctu_id; ?>">
                                                                     <input type="hidden" name="ctud_id" value="<?php echo $rows->ctud_id; ?>">

                                                                     <label class="form-label" for="textInput">Title :</label>
                                                                     <input type="text" id="new_ctu_title" name="new_ctu_title" value="<?php echo $rows->ctu_title; ?>" class="form-control" required>
                                                                  </div>

                                                                  <div class="mb-3">
                                                                     <label class="form-label">Tutorial Description :</label>
                                                                     <textarea class="form-control" name="new_ctu_desc" id="editortutorial<?php echo $rows->ctu_id; ?>"><?php echo $rows->ctu_description; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editortutorial<?php echo $rows->ctu_id; ?>'), {

                                                                           })
                                                                           .then(editor => {
                                                                              window.editor = editor;
                                                                           })
                                                                           .catch(err => {
                                                                              console.error(err.stack);
                                                                           });
                                                                     </script>

                                                                  </div>

                                                                  <div class="mb-3 col-md-12">
                                                                     <label class="form-label" for="textInput">Attachment :</label>
                                                                     <div class="custom-file">
                                                                        <div class="input-group mb-1">
                                                                           <input type="file" onChange="readURL(this);" accept="image/jpeg, image/png" class="form-control custom-file-input" name="ctu_attachment" id="ctu_attachment<?php echo $rows->ctu_id; ?>">

                                                                        </div>
                                                                     </div>

                                                                     <?php if ($rows->ctu_attachment != NULL) { ?>
                                                                        <p>Current File : <a href="../assets/attachment/course/coursetutorial/<?php echo $rows->ctu_attachment; ?>" target="_blank">
                                                                              <?php echo $rows->ctu_attachment; ?></a></p>
                                                                     <?php } else {
                                                                     } ?>

                                                                  </div>

                                                                  <div class="row">
                                                                     <label class="form-label">Due Date Submission :</label>
                                                                     <div class="mb-3 col-md-6 col-12">

                                                                        <div class="input-group me-3">
                                                                           <input class="form-control flatpickr" type="text" name="new_ctu_due_date" placeholder="Select Date" value="<?php echo $rows->ctud_duedate_date; ?>" aria-describedby="basic-addon2">

                                                                           <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                        </div>
                                                                     </div>

                                                                     <div class="mb-3 col-md-6 col-12">

                                                                        <input class="form-control" id="end-time" type="time" name="new_ctu_due_time" value="<?php echo $rows->ctud_duedate_time; ?>">

                                                                     </div>
                                                                  </div>


                                                            </div>

                                                            <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-success btn-sm" name="edit_ctu">Save</button>
                                                            </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <a href="committee-function.php?delete_ctu=<?php echo $rows->ctu_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletectu()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#tutorialdetail<?php echo $rows->ctu_id ?>" aria-controls="tutorialdetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="tutorialdetail<?php echo $rows->ctu_id ?>" data-bs-parent="#tutoriallist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdesctutorial<?php echo $rows->ctu_id; ?>" title="View Description">
                                                      <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>


                                                   <div class="modal fade" id="modalviewdesctutorial<?php echo $rows->ctu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="ctudesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Tutorial Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->ctu_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->ctu_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/course/coursetutorial/<?php echo $rows->ctu_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment">
                                                         <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn btn-outline-secondary waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>

                                                   <a class="btn btn-outline-warning waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewduedatetutorial<?php echo $rows->ctu_id; ?><?php echo $rows->ctud_id; ?>" title="View Description">
                                                      <span class="hidden-xs-down"><i class="mdi mdi-calendar-multiple-check fs-4" aria-hidden="true"></i> Due date </span></a>


                                                   <div class="modal fade" id="modalviewduedatetutorial<?php echo $rows->ctu_id; ?><?php echo $rows->ctud_id; ?>" tabindex="-1" role="dialog" aria-labelledby="ctudesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Due date Submission</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <div class="row">
                                                                  <div class="mb-3 col-md-6 col-12">
                                                                     <label class="form-label">Date : <input type="text" value="<?php echo date('j F Y', strtotime($rows->ctud_duedate_date)) ?>" style="border: none; font-weight: bold;" readonly>
                                                                     </label>
                                                                  </div>

                                                                  <div class="mb-3 col-md-6 col-12">
                                                                     <label class="form-label">Time : <input type="time" value="<?php echo $rows->ctud_duedate_time; ?>" style="border: none; font-weight: bold;" readonly>
                                                                     </label>
                                                                  </div>

                                                               </div>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>


                                                   <!--      <a href="#" class="btn btn-secondary btn-sm">View Attachment</a> -->
                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              <?php }
                           } else {
                              ?>

                              <div class="col-lg-12 col-md-12 col-12 text-center">
                                 <i class="mdi mdi-48px mdi-notebook-remove"></i>
                                 <h4 class="card-title">No Tutorial Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursetutorial">Add Tutorial +</a>

                        <div class="modal fade" id="addcoursetutorial" tabindex="-1" role="dialog" aria-labelledby="coursetutorialmodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="coursetutorialmodal">Add New Tutorial</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmctutorial_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                          <label class="form-label">Title :</label>
                                          <input style="text-transform:capitalize" id="ctu_title" class="form-control" type="text" placeholder="Tutorial Title" name="ctu_title" autocomplete="off" required>
                                       </div>


                                       <div class="mb-3">
                                          <label class="form-label">Tutorial Description</label>
                                          <textarea class="form-control" name="ctu_desc" id="editornewtutorial"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editornewtutorial'), {

                                                })
                                                .then(editor => {
                                                   window.editor = editor;
                                                })
                                                .catch(err => {
                                                   console.error(err.stack);
                                                });
                                          </script>
                                       </div>

                                       <div class="mb-3 col-md-12">
                                          <label class="form-label" for="textInput">Attachment :</label>
                                          <div class="input-group mb-1">
                                             <input class="dropify form-control" type="file" name="ctu_attachment" id="ctu_attachment">
                                             <label class="input-group-text" for="ctu_file">Upload</label>

                                          </div>
                                       </div>

                                       <div class="row">
                                          <label class="form-label">Due Date Submission:</label>
                                          <div class="mb-3 col-md-6 col-12">

                                             <div class="input-group me-3">
                                                <input class="form-control flatpickr" type="text" name="ctu_due_date" placeholder="Select Date" aria-describedby="basic-addon2">

                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                             </div>
                                          </div>

                                          <div class="mb-3 col-md-6 col-12">

                                             <input class="form-control" id="end-time" type="time" name="ctu_due_time">

                                          </div>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="ctu_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_course_tutorial">Save</button>
                                 </div>
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
   <!-- Script -->
   <!-- Libs JS -->

   <?php
   function hoursandmins($time, $format = '%02d:%02d')
   {
      if ($time < 1) {
         return;
      }
      $hours = floor($time / 60);
      $minutes = ($time % 60);
      return sprintf($format, $hours, $minutes);
   }


   ?>
   <script>
      function deletecq() {
         var x = confirm("Are you sure want to delete this quiz?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletect() {
         var x = confirm("Are you sure want to delete this test?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletectu() {
         var x = confirm("Are you sure want to delete this tutorial?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function publishnote() {
         var x = confirm("Are you sure want to publish this note?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function unpublishnote() {
         var x = confirm("Are you sure want to unpublish this note?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }


      function clearForm() {
         document.getElementById("unireg").reset();
         $('#admindept').selectpicker("refresh");

      }

      function check0(input) {
         if (input.value < 1) {
            input.value = 1;
         }
      }

      $(document).ready(function() {
         // Basic
         $('.dropify').dropify();
      });
   </script>





   <!-- clipboard -->



   <!-- Theme JS -->
   <script src="../assets/js/theme.min.js"></script>
   <script src="../assets/js/flatpickr.js"></script>

</body>

</html>