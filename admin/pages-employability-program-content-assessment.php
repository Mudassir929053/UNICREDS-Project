<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');
$admin_id = $_SESSION['sess_adminid'];
// $institution_id = $_SESSION['sess_institutionid'];
$ep_id = $_GET['cid'];

?>



<body>
	<!-- Wrapper -->
	<div id="db-wrapper">
		<!-- navbar vertical -->
		<?php
		unset($_SESSION['pages']);
		$_SESSION['pages'] = 'announcement';
		include 'pages-sidebar.php';
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
                        <h1 class="mb-1 h2 fw-bold">Employability Program Assessment</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="pages-employability-program.php">Employabiltiy Program</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="pages-employability-program-content.php?cid=<?php echo $ep_id; ?>">Employabiltiy Program Content</a>
                        </li>
                        
                    
                        <li class="breadcrumb-item active" aria-current="page">
                            All
                        </li>
                    </ol>
                </nav>
                     </div>
                     <div>
                        <a class="btn btn-sm btn-primary waves-effect waves-light shadow"   href="pages-employability-program-content.php?cid=<?php echo $ep_id; ?>">
                           <i class="fas fa-pen-square me-1"></i> Manage Content </a>
                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-employability-program.php">
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
                           $querycq = $conn->query("SELECT * FROM employability_program_quiz
                                                     LEFT JOIN employability_program ON employability_program.ep_id = epq_ep_id 
                                                     WHERE epq_ep_id  = '$ep_id'");

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
                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->epq_id ?>" aria-controls="viddetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->epq_title ?></span>
                                                      
                                                   </a>
                                                </h5>
                                                <div>

                                                   <span style="vertical-align: middle;" class="<?php if ($rows->epq_status == 'Published') {
                                                                                                   echo "badge bg-success ";
                                                                                                } else {
                                                                                                   echo "badge bg-warning ";
                                                                                                } ?>"><?php echo $rows->epq_status; ?></span>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->epq_status == 'Published') : ?>
                                                         <a href="admin-function.php?unpublish_cq=<?php echo $rows->epq_id; ?>" title="Unpublish Quiz" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishquiz()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->epq_status == 'Save Only') : ?>
                                                         <a href="admin-function.php?publish_cq=<?php echo $rows->epq_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Quiz" onclick="return publishquiz()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>

                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditquiz<?php echo $rows->epq_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaleditquiz<?php echo $rows->epq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcq" aria-hidden="true">
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
                                                                     <input type="hidden" name="cid_id" value="<?php echo $ep_id; ?>">
                                                                     <input type="hidden" name="cq_id" value="<?php echo $rows->epq_id; ?>">

                                                                     <label class="form-label" for="textInput">Quiz Title :</label>
                                                                     <input type="text" id="new_cq_title" name="new_cq_title" value="<?php echo $rows->epq_title; ?>" class="form-control" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                     <label class="form-label">Quiz Instruction</label>
                                                                     <textarea class="form-control" name="new_cq_instruction" id="editor<?php echo $rows->epq_id; ?>"><?php echo $rows->epq_instruction; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editor<?php echo $rows->epq_id; ?>'), {

                                                                           })
                                                                           .then(editor<?php echo $rows->epq_id; ?> => {
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
                                                                        <input name="new_cq_duration" id="new_quiz_duration" type="text" value="<?php echo $rows->epq_duration; ?>" class="form-control maskedTextField" onChange="check0(this)">
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

                                                   <a href="institution-function.php?delete_cq=<?php echo $rows->epq_id; ?>&cid=<?php echo $ep_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletecq()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#quizdetail<?php echo $rows->epq_id ?>" aria-controls="quizdetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span></a>
                                                </div>
                                             </div>

                                             <div id="quizdetail<?php echo $rows->epq_id ?>" class="collapse" data-bs-parent="#quizdetail">
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
                                                                  <p style="vertical-align: middle;"><?php echo $rows->epq_instruction; ?></p>
                                                               </td>
                                                               <td><center><?php if (($rows->epq_duration) != 0) {

                                                        echo hoursandmins($rows->epq_duration, '%2d Hours and %2d Minutes');

                                                         } ?>

                                             </center>
                                                               </td>
                                                               <td>
                                                                  <a href="pages-employability-program-assessment-quiz.php?cid=<?php echo $ep_id; ?>&cq_id=<?php echo $rows->epq_id ?>" data-bs-toggle="tooltip" data-placement="top" title="Add Question">
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
                                           <input type="hidden" name="course_id" value="<?php echo $ep_id; ?>"> 

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