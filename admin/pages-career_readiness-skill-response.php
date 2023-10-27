<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];

$checkuserrow = $conn->query("SELECT admin_user_id  from admin where admin_id  = '$admin_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->admin_user_id;

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
     
      <div class="container-fluid p-4">
        
        <div class="">

          <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12">
              <div class="card shadow">
              <div class="col-md-12 bg-light text-right">
                  <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-career_readiness-skill-assessment.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>

                </div>
                <!-- table  -->
                <div class="card-body">
                  <table id="dataTableBasic" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                    <thead class="bg-gradient bg-info text-white">
                      <tr class="text-center">
                        <th scope="col" class="border-0" width="10px">No.</th>
                        <th scope="col" class="border-0" width="200px">Skill Assessment Test</th>
                        <th scope="col" class="border-0" width="200px">Student Name</th>

                        <!-- <th scope="col" class="border-0" width="200px">Attachment</th> -->
                        <th scope="col" class="border-0">Time Taken</th>
                        <th scope="col" class="border-0">Grade</th>
                        <!-- <th scope="col" class="border-0">Status</th> -->
                        <!-- <th scope="col" class="border-0" width="50px">Status</th> -->
                      </tr>
                    </thead>
                    <tbody class="align-middle">

                      <?php
                      // echo $get_userID;
                      $query = $conn->query("SELECT * FROM skill_assessment_test AS st
                      LEFT JOIN skill_assessment_test_question AS stq
                      ON st.st_id=stq.stq_st_id
                      LEFT JOIN studuni_sat_quiz_result AS ssqr
                      ON st.st_id= ssqr.susatqrs_sat_quiz_id
                      LEFT JOIN student_university AS su
                      ON ssqr.susatqrs_student_university_id=su.su_id
                   WHERE st_created_by='$get_userID' AND stq.stq_type='fileupload' AND st.st_id=ssqr.susatqrs_sat_quiz_id
                      GROUP BY stq.stq_st_id
                     
                    ");
                      $num = 1;
                      if (mysqli_num_rows($query) > 0) {
                        while ($rows = mysqli_fetch_object($query)) {


                      ?>
                          <tr>
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td class="border-top-0">
                              <a class="text-inherit">
                                <div class="d-lg-flex align-items-center">

                                  <div class="ms-lg-3 mt-2 mt-lg-0">
                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-career_readiness-skill-result.php?st_id=<?php echo $rows->st_id; ?>">
                                      <h4 class="mb-1 text-primary-hover">
                                        <?php echo $rows->st_title; ?>
                                      </h4>
                                    </a>
                                    <span class="text-inherit "><?php echo date('j F Y H:i:s', strtotime($rows->st_created_date)) ?> </span>
                                  </div>
                                </div>
                              </a>
                            </td>
                            <td class="text-center">
                              <span style="vertical-align: middle;">
                                <center><?php echo $rows->su_fname; ?>
                                </center>
                              </span>
                            </td>
                            <!-- <td class="wide">

                            <span style="vertical-align: middle;">
                                                   <?php
                                                   if ($rows->susatrv_fileupload != NULL) {
                                                   ?>
                                                      <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/studentfileupload/<?php echo $rows->susatrv_fileupload; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>
                                                </span>
                            </td> -->

                            <td class="text-center">
                              <span style="vertical-align: middle;">
                                <center><?php echo $rows->susatqrs_time_taken; ?>
                                </center>
                              </span>
                            </td>
                            <td class="text-center">
                            <?php echo $rows->susatqrs_grade; ?>%
                            </td>

                            
                            
                          </tr>
                </div>
              </div>


              <!-- end modal edit -->



            <?php
                        }
                      } else {
            ?>
          <?php
                      }
          ?>

          </tbody>
          </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- Script -->

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
    function deletecourse() {
      var x = confirm("Are you sure want to delete this test?\n\n All questions will be deleted");

      if (x == true) {
        return true;
      } else {
        return false;
      }
    }


    function clearForm() {

      document.getElementById("coursedetail").reset();
      $('#field_id').selectpicker("refresh");

    }

    function publishcourse() {
      var x = confirm("Are you sure want to publish this course?");

      if (x == true) {
        return true;
      } else {
        return false;
      }
    }


    function unpublishcourse() {
      var x = confirm("Are you sure want to unpublish this course?");

      if (x == true) {
        return true;
      } else {
        return false;
      }
    }
  </script>



  <!-- clipboard -->



  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>
  <script src="../assets/js/ckeditor.js"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>