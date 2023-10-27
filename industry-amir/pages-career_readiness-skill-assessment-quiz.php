<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('industry-function.php');

$industry_id = $_SESSION['sess_industryid'];

// $course_id = $_GET['cid'];
$st_id = $_GET['st_id'];


$stq_type = "";

@$stq_type = $_SESSION['sqt_type'];

?>



<body>
   <!-- Wrapper -->
   <div id="db-wrapper">
      <!-- navbar vertical -->
      <?php
      unset($_SESSION['pages']);
      $_SESSION['pages'] = 'Skill_Assessment';
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
                        <h1 class="mb-1 h2 fw-bold">skill assessment Content</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="#">Skill Assessment Test</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Add Skill Test Question</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>
                     <div>

                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-career_readiness-skill-assessment.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>
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
                           <a class="nav-link <?php if ($stq_type == "multiple choice") {
                                                   echo "active";
                                                } else if ($stq_type == NULL) {
                                                   echo "active";
                                                } ?>" id="note-tab" data-bs-toggle="pill" href="#note" role="tab" aria-controls="note" aria-selected="true">Multiple Choice</a>

                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?php if ($stq_type == "fileupload") {
                                                   echo "active";
                                                } ?>" id="fileupload-tab" data-bs-toggle="pill" href="#fileupload" role="tab" aria-controls="fileupload" aria-selected="false">File Upload</a>
                        </li>



                     </ul>
                  </div>
               </div>
               <!-- Card Body -->
               <div class="card-body">
                  <div class="tab-content" id="tabContent">
                     <!-- *******************************************************MULTIPLE CHOICE************************************************************************************** -->
                     <div class="tab-pane <?php if ($stq_type == "multiple choice") {
                                             echo "active";
                                          } else if ($stq_type == NULL) {
                                             echo "active";
                                          } ?>" id="note" role="tabpanel" aria-labelledby="note-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <div class="card-body bg-white">
                              <div class="table-responsive">
                                 <table id="dataTableBasic1" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                    <thead class="bg-gradient bg-info text-white">
                                       <tr class="text-center">
                                          <th scope="col" class="border-0" width="10px">No.</th>
                                          <!-- <th scope="col" class="border-0" width="100px">Question Type</th> -->
                                          <th scope="col" class="border-0" width="100px">Question</th>
                                          <!-- <th scope="col" class="border-0" width="">File</th> -->
                                          <th scope="col" class="border-0" width="100px">Option1</th>
                                          <th scope="col" class="border-0" width="100px">Option2</th>
                                          <th scope="col" class="border-0" width="100px">Option3</th>
                                          <th scope="col" class="border-0" width="100px">Option4</th>
                                          <th scope="col" class="border-0" width="100px">Answer</th>
                                          <th scope="col" class="border-0" width="150px">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                       <?php
                                       $querycq = $conn->query("SELECT * FROM  skill_assessment_test_question AS satq
                                    JOIN skill_assessment_test_answer AS sata
                                    ON satq.stq_id=sata.stqa_stq_id
                                    WHERE stq_st_id=$st_id and stq_type='multiple choice';");
                                       $num = 1;
                                       if (mysqli_num_rows($querycq) > 0) {
                                          while ($rows = mysqli_fetch_object($querycq)) {
                                       ?>
                                             <tr>
                                                <td class="text-center"><?php echo $num++; ?></td>
                                                <td class="wide">
                                                   <?= (strip_tags(substr($rows->stq_question, 0, 50))) ?>...
                                                   <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->stq_id; ?>">
                                                      <span style="color: skyblue;">Read More</span>
                                                   </button>
                                                   <!-- Modal for More -->
                                                   <div class="modal fade" id="modalView<?php echo $rows->stq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="testinstruction" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Question</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->stq_question ?></h5>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </td>

                                                <td class="text-center">
                                                   <span style="vertical-align: middle;">
                                                      <center><?php echo $rows->stqa_answer1;
                                                               ?>
                                                      </center>
                                                   </span>
                                                </td>
                                                <td class="text-center">
                                                   <span style="vertical-align: middle;">
                                                      <center><?php echo $rows->stqa_answer2; ?>
                                                      </center>
                                                   </span>
                                                </td>
                                                <td class="text-center">
                                                   <span style="vertical-align: middle;">
                                                      <center><?php echo $rows->stqa_answer3; ?>
                                                      </center>
                                                   </span>
                                                </td>
                                                <td class="text-center">
                                                   <span style="vertical-align: middle;">
                                                      <center><?php echo $rows->stqa_answer4; ?>
                                                      </center>
                                                   </span>
                                                </td>
                                                <td class="text-center">
                                                   <span style="vertical-align: middle;">
                                                      <center><?php echo $rows->stqa_right_answer_word; ?>
                                                      </center>
                                                   </span>
                                                </td>
                                                <td>

                                                   <button type="button" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editMulti<?php echo $rows->stq_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</button></a>
                                                   <!-- *******************************************************EDIT MULTIPLE CHOICE***************************************************************************************** -->

                                                   <div class="modal fade" id="editMulti<?php echo $rows->stq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cmultiplemodal" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h5 class="modal-title" id="cmultiplemodal">Add New multiple</h5>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="" method="POST" enctype="multipart/form-data" id="editMulti" autocomplete="off">
                                                                  <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                                  <input type="hidden" name="stqa_id" value="<?php echo $rows->stqa_id; ?>">
                                                                  <input type="hidden" name="stq_id" value="<?php echo $rows->stq_id; ?>">
                                                                  <input type="hidden" name="stq_type" value="<?php echo $rows->stq_type; ?>">
                                                                  <!-- <input type="hidden" name="pts_id" value="1"> -->
                                                                  
                                                                  <div class="mb-3">
                                                                     
                                                                     <label class="form-label">Question:</label>
                                                                     <textarea class="form-control" name="new_stq_question" id="new_stq_question<?php echo $rows->stq_id; ?>">
                                                                     <?php echo $rows->stq_question; ?></textarea>
                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#new_stq_question<?php echo $rows->stq_id; ?>'), {})
                                                                           .then(editor => {
                                                                              window.editor = editor;
                                                                           })
                                                                           .catch(err => {
                                                                              console.error(err.stack);
                                                                           });
                                                                     </script>
                                                                  </div>
                                                                  
                                                                  <div class="mb-3">
                                                                     <label class="form-label">Options:</label>
                                                                     <div id="mcq">
                                                                        <div class="table-responsive">
                                                                           <table class="table table-bordered no-wrap table-hover">
                                                                              <thead>
                                                                                 <tr>
                                                                                    <th width="50px">Correct Answer</th>
                                                                                    <th>Answers</th>
                                                                                 </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                 <tr>
                                                                                    <td>
                                                                                       <ul>
                                                                                          <input type="radio" value="1" name="new_answermulchoice" id="multi" <?php if ($rows->stqa_right_answer == "1") {
                                                                                                                                                                  echo 'checked';
                                                                                                                                                               } ?>>
                                                                                       </ul>
                                                                                    </td>

                                                                                    <td>
                                                                                       <input type="text" name="new_stq_answer1" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $rows->stqa_answer1; ?>">
                                                                                    </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                    <td>
                                                                                       <ul>
                                                                                          <input type="radio" value="2" name="new_answermulchoice" id="multi" <?php if ($rows->stqa_right_answer == "2") {
                                                                                                                                                                  echo 'checked';
                                                                                                                                                               } ?>>
                                                                                       </ul>
                                                                                    </td>

                                                                                    <td>
                                                                                       <input type="text" name="new_stq_answer2" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $rows->stqa_answer2; ?>">
                                                                                    </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                    <td>
                                                                                       <ul>
                                                                                          <input type="radio" value="3" name="new_answermulchoice" id="multi" <?php if ($rows->stqa_right_answer == "3") {
                                                                                                                                                                  echo 'checked';
                                                                                                                                                               } ?>>
                                                                                       </ul>
                                                                                    </td>

                                                                                    <td>
                                                                                       <input type="text" name="new_stq_answer3" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $rows->stqa_answer3; ?>">
                                                                                    </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                    <td>
                                                                                       <ul>
                                                                                          <input type="radio" value="4" name="new_answermulchoice" id="multi" <?php if ($rows->stqa_right_answer == "4") {
                                                                                                                                                                  echo 'checked';
                                                                                                                                                               } ?>>
                                                                                       </ul>
                                                                                    </td>

                                                                                    <td>
                                                                                       <input type="text" name="new_stq_answer4" placeholder="Answer" class="form-control form-control-sm" value="<?php echo $rows->stqa_answer4; ?>">
                                                                                    </td>
                                                                                 </tr>
                                                                              </tbody>
                                                                           </table>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                                     <button type="submit" class="btn btn-success btn-sm" name="edit_skill_question">Update</button>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                
                                                   <!-- *************************************************************end of edit multiple choice************************************************************************************* -->
                                                   <a class="btn btn-sm btn-danger" href="industry-function.php?delete_skill_assessment_test_quiz=<?php echo $rows->stq_id; ?>&delete_skill_assessment_test_question_answer=<?php echo $rows->stqa_id; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                                </td>
                                             </tr>
                                       <?php
                                          }
                                       }
                                       ?>
                                 </table>
                              </div>
                           </div>
                        </div>






                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursenote">Add multiple choice+</a>

                        <div class="modal fade" id="addcoursenote" tabindex="-1" role="dialog" aria-labelledby="cmultiplemodal" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="cmultiplemodal">Add New multiple</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addMulti" autocomplete="off">
                                       <input type="hidden" value="multiple choice" name="stq_type">
                                       <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">


                                       <div class="mb-3 col-12 float-start">
                                          <label class="form-label">Question :</label>
                                          <textarea class="form-control" name="stq_question" id="stq_question"></textarea>
                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#stq_question'), {})
                                                .then(editor => {
                                                   window.editor = editor;
                                                })
                                                .catch(err => {
                                                   console.error(err.stack);
                                                });
                                          </script>
                                       </div>
                                       <div class="row">
                                          <label class="form-label">Options:</label>
                                          <div id="mcq">
                                             <div class="table-responsive">
                                                <table class="table table-bordered no-wrap table-hover">
                                                   <thead>
                                                      <tr>
                                                         <th width="50px">Correct Answer</th>
                                                         <th>Answers</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <ul>
                                                               <input type="radio" class="check" value="1" name="answermulchoice" id="multi" checked>
                                                            </ul>
                                                         </td>
                                                         <td>
                                                            <input type="text" name="stqa_answer1" placeholder="Answer" class="form-control form-control-sm">
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td>
                                                            <ul>
                                                               <input type="radio" class="check" value="2" name="answermulchoice" id="multi1">
                                                            </ul>
                                                         </td>
                                                         <td>
                                                            <input type="text" name="stqa_answer2" placeholder="Answer" class="form-control form-control-sm">
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td>
                                                            <ul>
                                                               <input type="radio" class="check" value="3" name="answermulchoice" id="multi2">
                                                            </ul>
                                                         </td>
                                                         <td>
                                                            <input type="text" name="stqa_answer3" placeholder="Answer" class="form-control form-control-sm">
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td>
                                                            <ul>
                                                               <input type="radio" class="check" value="4" name="answermulchoice" id="multi3">
                                                            </ul>
                                                         </td>
                                                         <td>
                                                            <input type="text" name="stqa_answer4" placeholder="Answer" class="form-control form-control-sm">
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                          <button type="submit" class="btn btn-success btn-sm" name="add_skill_question">Submit</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                     <!-- ************************************************END OF MULTIPLE CHOICE**************************************************************************** -->



                     <!-- *****************************************************************FILE UPLOAD********************************************************************************************************* -->
                     <div class="tab-pane <?php if ($stq_type == "fileupload") {
                                             echo "active";
                                          } ?>" id="fileupload" role="tabpanel" aria-labelledby="fileupload-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <div class="card-body bg-white">
                              <table id="dataTableBasic2" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                                 <thead class="bg-gradient bg-info text-white">
                                    <tr class="text-center">
                                       <th scope="col" class="border-0" width="10px">No.</th>
                                       <!-- <th scope="col" class="border-0" width="100px">Question Type</th> -->

                                       <th scope="col" class="border-0" width="100px">File name</th>
                                       <th scope="col" class="border-0" width="100px">Attachment</th>
                                       <th scope="col" class="border-0" width="250px">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="align-middle">
                                    <?php
                                    $querycq = $conn->query("SELECT * FROM 
                                    skill_assessment_test_question WHERE stq_st_id=$st_id and stq_type='fileupload'; ");
                                    $num = 1;
                                    if (mysqli_num_rows($querycq) > 0) {
                                       while ($rows = mysqli_fetch_object($querycq)) {
                                    ?>
                                          <tr>
                                             <td class="text-center"><?php echo $num++; ?></td>
                                             <td class="text-center">
                                                <?php echo $rows->stq_fileupload; ?>
                                             </td>

                                             <td class="text-center ">


                                                <span style="vertical-align: middle;">
                                                   <?php
                                                   if ($rows->stq_fileupload != NULL) {
                                                   ?>
                                                      <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/skillfileupload/<?php echo $rows->stq_fileupload; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>
                                                </span>
                                             </td>
                                             <td class="text-center ">

                                                <button type="button" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editfileupload<?php echo $rows->stq_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</button></a>


                                                <!-- **************************************************************edit of file upload********************** -->
                                                <div class="modal fade" id="editfileupload<?php echo $rows->stq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cfilemodal" aria-hidden="true">

                                                   <div class="modal-dialog modal-dialog-centered modal-lg">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title" id="cfilemodal">Edit File Upload</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data" id="fileupload" autocomplete="off">
                                                               <div class="mb-3">
                                                                  <input type="hidden" value="fileupload" name="stq_type">
                                                                  <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">
                                                                  <input type="hidden" name="stq_id" value="<?php echo $rows->stq_id; ?>">


                                                               </div>



                                                               <!-- <div class="mb-3 col-md-12">
                                                                  <label class="form-label" for="textInput">Attachment :</label>
                                                                  <div class="input-group mb-1">

                                                                     <div class="btn  float-right bg-primary text-light ">
                                                                        <input type="file" accept="application/pdf,application/vnd.ms-excel" name="stq_fileupload">
                                                                     </div>
                                                                  </div>
                                                               </div> -->

                                                               <div class="mb-3 col-md-12">
                                                                  <label class="form-label" for="textInput">Attachment :</label>
                                                                  <div class="custom-file">
                                                                     <div class="input-group mb-1 btn  float-right bg-primary text-light ">
                                                                        <input type="file" accept="application/pdf,application/vnd.ms-excel" name="new_stq_fileupload" id="new_stq_fileupload">

                                                                     </div>
                                                                  </div>

                                                                  <?php if ($rows->stq_fileupload != NULL) { ?>
                                                                     <div class="card">

                                                                     </div>
                                                                     <p>Current File : <a href="../assets/attachment/skillfileupload/<?php echo $rows->stq_fileupload; ?>" target="_blank">
                                                                           <?php echo $rows->stq_fileupload; ?></a></p>
                                                                  <?php } else {
                                                                  } ?>

                                                               </div>

                                                         </div>

                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                                            <button type="submit" class="btn btn-success btn-sm" name="edit_file_upload">Update</button>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   </form>
                                                </div>

                                                <!-- ****************************end of file upload********************************************* -->

                           </div>



                           <a class="btn btn-sm btn-danger" href="industry-function.php?delete_language_test_quiz_file=<?php echo $rows->stq_id; ?>" title="Delete Question" onclick="return deletequestion()"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                           </td>
                           </tr>
                     <?php
                                       }
                                    }
                     ?>
                     </table>
                        </div>
                     </div>




                     <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursefile">Add File Upload +</a>

                     <div class="modal fade" id="addcoursefile" tabindex="-1" role="dialog" aria-labelledby="cfilemodal" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="cfilemodal">Add file</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form action="" method="POST" enctype="multipart/form-data" id="fileupload" autocomplete="off">
                                    <div class="mb-3">
                                       <input type="hidden" value="fileupload" name="stq_type">
                                       <input type="hidden" name="st_id" value="<?php echo $st_id; ?>">

                                    </div>



                                    <div class="mb-3 col-md-12">
                                       <label class="form-label" for="textInput">Attachment :</label>
                                       <div class="input-group mb-1">

                                          <div class="btn  float-right bg-primary text-light ">
                                             <input type="file" accept="application/pdf,application/vnd.ms-excel" name="stq_fileupload">
                                          </div>
                                       </div>
                                    </div>

                              </div>

                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">Close</button>
                                 <button type="submit" class="btn btn-success btn-sm" name="add_skill_question_file">Submit</button>
                              </div>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
                  <!-- *******************************************************END OF FILE UPLOAD*********************************************************************************** -->











               </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <script>
      function deletequestion() {
         var x = confirm("Are you sure want to delete this question?");
         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletecn() {
         var x = confirm("Are you sure want to delete this multiple choice?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletecv() {
         var x = confirm("Are you sure want to delete this fileupload?");

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

      function publishfileupload() {
         var x = confirm("Are you sure want to publish this fileupload?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function unpublishfileupload() {
         var x = confirm("Are you sure want to unpublish this fileupload?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }




      function clearForm() {
         document.getElementById("addmcnote_form").reset();

      }

      $(document).ready(function() {
         // Basic
         $('.dropify').dropify();
      });

      $(document).ready(function() {
         $('#dataTableBasic1').DataTable();
      });

      $(document).ready(function() {
         $('#dataTableBasic2').DataTable();
      });
   </script>



   <!-- clipboard -->



   <!-- Theme JS -->
   <script src="../assets/js/theme.min.js"></script>
   <script src="../assets/js/ckeditor.js"></script>

   <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>