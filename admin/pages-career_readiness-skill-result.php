<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];
$st_id = $_GET['st_id'];

$checkuserrow = $conn->query("SELECT admin_user_id  from admin where admin_id  = '$admin_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->admin_user_id;

?>
<script>
  function showDiv(select) {
    if (select.value == 'Correct') {

      $('#Correct').show();
      $('#Incorrect').hide();
      $('#choose').hide();

    } else if (select.value == 'Incorrect') {

      $('#Correct').hide();
      $('#Incorrect').show();
      $('#choose').hide();

    } else if (select.value == 'choose') {
      $('#choose').show();
      $('#Incorrect').hide();
      $('#Correct').hide();

    }
  }

  function showDiv1(select) {
    if (select.value == 'Correct') {

      // $('#submitscore').show();
      $('#submitscore').hide();
      // $('#choose').hide();
    } else if (select.value == 'Incorrect') {

      // $('#Correct').hide();
      // $('#submitscore').show();
      $('#submitscore').hide();

    } else if (select.value == '') {
      $('#submitscore').show();
      // $('#Incorrect').hide();
      // $('#Correct').hide();

    }
  }
</script>

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
                  <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-career_readiness-skill-response.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>

                </div>
                <!-- table  -->
                <div class="card-body">
                  <table id="dataTableBasic" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                    <thead class="bg-gradient bg-info text-white">
                      <tr class="text-center">
                        <th scope="col" class="border-0" width="10px">No.</th>
                        <!-- <th scope="col" class="border-0" width="200px">Skill Assessment Test</th> -->
                        <th scope="col" class="border-0" width="250px">Question Attachment</th>

                        <th scope="col" class="border-0" width="200px">Answer Attachment</th>
                        <!-- <th scope="col" class="border-0" width="100px">Time Taken</th> -->
                        <th scope="col" class="border-0" width="100px">Score</th>
                        <!-- <th scope="col" class="border-0" width="100px">Action</th> -->
                        <th scope="col" class="border-0" width="50px">Action</th>
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
                    LEFT JOIN studuni_st_test_review sstr
                    ON sstr.susatrv_st_test_id=ssqr.susatqrs_sat_quiz_id
                   WHERE st_created_by = '$get_userID' AND stq.stq_st_id = $st_id AND sstr.susatrv_st_test_question_id=stq.stq_id  AND stq.stq_type='fileupload' ");
                      $num = 1;
                      if (mysqli_num_rows($query) > 0) {
                        while ($rows = mysqli_fetch_object($query)) {


                      ?>
                          <tr>
                            <form method="post" action="">

                              <td class="text-center"><?php echo $num++; ?></td>


                              <td class="wide">

                                <span style="vertical-align: middle;">
                                  <?php
                                  if ($rows->stq_fileupload != NULL) {
                                  ?>
                                    <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/skillfileupload/<?php echo $rows->stq_fileupload; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a><span><?php echo $rows->stq_fileupload; ?></span>
                                  <?php
                                  } else {
                                  ?>
                                    <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                  <?php
                                  }
                                  ?>
                                </span>
                              </td>
                              <td class="wide">

                                <span style="vertical-align: middle;">
                                  <?php
                                  if ($rows->susatrv_fileupload != NULL) {
                                  ?>
                                    <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/studentfileupload/<?php echo $rows->susatrv_fileupload; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a><span><?php echo $rows->susatrv_fileupload; ?></span>
                                  <?php
                                  } else {
                                  ?>
                                    <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                  <?php
                                  }
                                  ?>
                                </span>
                              </td>



                              <td>


                                <select class="form-select" name="score" aria-label="Default select example" onchange="showDiv(this)">
                                  <option name="choose">Choose</option>

                                  <option value="Correct" name="Correct" <?php if ($rows->susatrv_answer_status == "Correct") {
                                                                            echo "selected";
                                                                          } else {
                                                                          } ?>>Correct</option>
                                  <option value="Incorrect" name="Incorrect" <?php if ($rows->susatrv_answer_status == "Incorrect") {
                                                                                echo "selected";
                                                                              } else {
                                                                              } ?>>Incorrect</option>
                                </select>
                              </td>

                              <td>
                                <input type="hidden" name="susatqrs_sat_quiz_id" value="<?php echo $rows->susatqrs_sat_quiz_id; ?>">
                                <input type="hidden" name="susatqrs_total_question" value="<?php echo $rows->susatqrs_total_question; ?>">
                                <input type="hidden" name="stq_st_id" value="<?php echo $rows->stq_st_id; ?>">

                                <input type="hidden" name="susatrv_st_test_id" value="<?php echo $rows->susatrv_st_test_id; ?>">
                                <input type="hidden" name="susatrv_st_test_question_id" value="<?php echo $rows->susatrv_st_test_question_id; ?>">
                                <?php if ($rows->susatrv_answer_status == '') { ?>
                                  <button type="submit" class="btn mt-3 me-md-2  btn-outline-success btn-sm shadow" id="submitscore" value="submitscore" name="submitscore">Submit</button>
                                <?php } else { ?><button type="submit" class="btn mt-3 me-md-2  btn-outline-success btn-sm shadow" id="submitscore" value="submitscore" name="submitscore" disabled>Submit</button>
                                <?php } ?>
                              </td>


                          </tr>

                          </form>




                      <?php
                        }
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