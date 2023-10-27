<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];
$mcid = $_GET['mcid'];

@$assessment_type = $_SESSION['assessment_type'];
?>



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
         <!-- Container fluid -->
         <div class="container-fluid p-4">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-12">
                  <!-- Page Header -->
                  <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                     <div class="mb-3 mb-md-0">
                        <h1 class="mb-1 h2 fw-bold">Micro-credential Assessment</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="pages-microcredential.php">Micro-credential</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Micro-credential Assessment</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>
                     <div>
                        <a class="btn btn-sm btn-primary waves-effect waves-light shadow" href="pages-microcredential-content-review.php?mcid=<?php echo $mcid; ?>">
                           View Content </a>
                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-microcredential-review.php">
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
                           $querymcq = $conn->query("SELECT * FROM mc_quiz
                                    WHERE mcq_deleted_date IS NULL AND mcq_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymcq) > 0) {
                              while ($rows = mysqli_fetch_object($querymcq)) {

                           ?>
                                 <div class="accordion" id="quizlist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->mcq_id ?>" aria-controls="viddetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle" data-bs-toggle="tooltip" title="View Details"><?php echo $rows->mcq_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->mcq_id ?>" aria-controls="quizdetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span></a>
                                                </div>
                                             </div>

                                             <div id="quizdetail<?php echo $rows->mcq_id ?>" class="collapse" data-bs-parent="#quizdetail">
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
                                                                  <p style="vertical-align: middle;"><?php echo $rows->mcq_instruction; ?></p>
                                                               </td>
                                                               <td>
                                                                  <center><?php if (($rows->mcq_duration) != 0) {
                                                                              echo hoursandmins($rows->mcq_duration, '%2d Hours and %2d Minutes');
                                                                           } ?>
                                                                  </center>
                                                               </td>
                                                               <td>
                                                                  <a href="pages-mc-assessment-quiz-review.php?mcid=<?php echo $mcid; ?>&mcq_id=<?php echo $rows->mcq_id ?>" data-bs-toggle="tooltip" data-placement="top" title="Add Question">
                                                                     <span class="badge rounded-pill bg-primary">
                                                                        <i class="fe fe-eye fs-4 me-1" style="vertical-align: middle;">
                                                                        </i>View Question
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

                     </div>

                     <div class="tab-pane <?php if ($assessment_type == "Test") {
                                             echo "active";
                                          } ?>" id="test" role="tabpanel" aria-labelledby="test-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <!-- List group -->
                           <?php
                           $querymct = $conn->query("SELECT * FROM mc_test
                                    WHERE mct_deleted_date IS NULL AND mct_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymct) > 0) {
                              while ($rows = mysqli_fetch_object($querymct)) {

                           ?>

                                 <div class="list-group list-group-flush border-top-0" id="testlist">
                                    <div>
                                       <div class="list-group-item rounded m-1">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <h5 class="mb-0">
                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#testdetail<?php echo $rows->mct_id ?>" aria-controls="testdetail">
                                                   <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                   <span class="align-middle" data-bs-toggle="tooltip" title="View Details"><?php echo $rows->mct_title ?></span>
                                                </a>
                                             </h5>
                                             <div>
                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#testdetail<?php echo $rows->mct_id ?>" aria-controls="testdetail">
                                                   <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                </a>
                                             </div>
                                          </div>
                                          <div id="testdetail<?php echo $rows->mct_id ?>" class="collapse" data-bs-parent="#testdetail">
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
                                                               <p style="vertical-align: middle;"><?php echo $rows->mct_instruction; ?></p>
                                                            </td>
                                                            <td>
                                                               <center><?php if (($rows->mct_duration) != 0) {
                                                                           echo hoursandmins($rows->mct_duration, '%2d Hours and %2d Minutes');
                                                                        } ?></center>
                                                            </td>
                                                            <td> <a href="pages-mc-assessment-test-review.php?mcid=<?php echo $mcid; ?>&mct_id=<?php echo $rows->mct_id ?>" data-bs-toggle="tooltip" data-placement="top" title="Add Question">
                                                                  <span class="badge rounded-pill bg-primary">
                                                                     <i class="fe fe-eye fs-4 me-1" style="vertical-align: middle;">
                                                                     </i>View Question
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

                     </div>

                     <div class="tab-pane <?php if ($assessment_type == "Tutorial") {
                                             echo "active";
                                          } ?>" id="tutorial" role="tabpanel" aria-labelledby="tutorial-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querymctu = $conn->query("SELECT * FROM mc_tutorial
                                    LEFT JOIN mc_tutorial_duedate ON mc_tutorial_duedate.mctud_mc_tutorial_id = mctu_id 
                                    WHERE mctu_deleted_date IS NULL AND mctu_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymctu) > 0) {
                              while ($rows = mysqli_fetch_object($querymctu)) {

                           ?>
                                 <div class="accordion" id="tutoriallist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#tutorialdetail<?php echo $rows->mctu_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="tutorialdetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->mctu_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#tutorialdetail<?php echo $rows->mctu_id ?>" aria-controls="tutorialdetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="tutorialdetail<?php echo $rows->mctu_id ?>" data-bs-parent="#tutoriallist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdesctutorial<?php echo $rows->mctu_id; ?>" title="View Description">
                                                      <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>


                                                   <div class="modal fade" id="modalviewdesctutorial<?php echo $rows->mctu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mctudesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Tutorial Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->mctu_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->mctu_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/microcredential/mctutorial/<?php echo $rows->mctu_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment">
                                                         <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn btn-outline-secondary waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>

                                                   <a class="btn btn-outline-warning waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewduedatetutorial<?php echo $rows->mctu_id; ?><?php echo $rows->mctud_id; ?>" title="View Description">
                                                      <span class="hidden-xs-down"><i class="mdi mdi-calendar-multiple-check fs-4" aria-hidden="true"></i> Due date </span></a>


                                                   <div class="modal fade" id="modalviewduedatetutorial<?php echo $rows->mctu_id; ?><?php echo $rows->mctud_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mctudesc" aria-hidden="true">
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
                                                                     <label class="form-label">Date : <input type="text" value="<?php echo date('j F Y', strtotime($rows->mctud_duedate_date)) ?>" style="border: none; font-weight: bold;" readonly>
                                                                     </label>
                                                                  </div>

                                                                  <div class="mb-3 col-md-6 col-12">
                                                                     <label class="form-label">Time : <input type="time" value="<?php echo $rows->mctud_duedate_time; ?>" style="border: none; font-weight: bold;" readonly>
                                                                     </label>
                                                                  </div>

                                                               </div>
                                                            </div>

                                                         </div>
                                                      </div>
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
                                 <i class="mdi mdi-48px mdi-notebook-remove"></i>
                                 <h4 class="card-title">No Tutorial Available</h4>
                              </div>
                           <?php
                           } ?>
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
      function deletemcq() {
         var x = confirm("Are you sure want to delete this quiz?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletemct() {
         var x = confirm("Are you sure want to delete this test?");

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
</body>

</html>