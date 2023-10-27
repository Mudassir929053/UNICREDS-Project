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
$ep_id = $_GET['cid'];

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

      <div class="container-fluid p-4">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
              <div class="mb-3 mb-md-0">
                <h1 class="mb-1 h2 fw-bold">Employability Program</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                      <a href="#">Employability Program</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      All
                    </li>
                  </ol>
                </nav>
              </div>
              <div>
                <!-- <div class="col-md-12 bg-light text-right">
                <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-employability-program-register.php">
                  Add Employability Program </a>
                <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-employability-program-progress-history.php">
                  View EP Learning History </a>
              </div> -->
              </div>
            </div>
          </div>
          <?php $querymcprocess = $conn->query("SELECT eepsu.*, su.*, ep.*, u.*
                                                                                FROM enrolled_ep_studuni eepsu
                                                                                LEFT JOIN student_university su ON su.su_id = eepsu.eepsu_student_university_id
                                                                                LEFT JOIN employability_program ep ON ep.ep_id = eepsu.eepsu_ep_id
                                                                                LEFT JOIN user u ON ep.course_created_by = u.user_id
                                                                                WHERE u.user_id = '$get_userID'
                                                                                AND ep.ep_id = '$ep_id'
                                                                                AND ep.course_deleted_date IS NULL;");  ?>


        </div>
        <div class="">
          <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12">
              <div class="card shadow">
                <!-- card header  -->
                <!-- <div class="card-header border-bottom-0">
                </div> -->
                <!-- table  -->
                <div class="card-body">
                  <table id="dataTableBasic" class="table table-hover table-sm display no-wrap shadow" style="width:100%">
                    <thead class="bg-gradient bg-light-secondary text-dark">
                      <tr class="text-center">
                        <th scope="col" class="border-0">No.</th>
                        <th scope="col" class="border-0" width="270px">Student Name</th>
                        <th scope="col" class="border-0">Program Enrolled Date</th>
                        <th scope="col" class="border-0" width="200px">Program Video Status</th>
                        <th scope="col" class="border-0" width="200px">Program Quiz Status</th>
                        <th scope="col" class="border-0">Program Completed Date</th>
                        <th scope="col" class="border-0">Issue Certificate</th>

                      </tr>
                    </thead>
                    <tbody class="align-middle">
                      <?php


                      $num = 1;
                      if (mysqli_num_rows($querymcprocess) > 0) {
                        while ($rows = mysqli_fetch_object($querymcprocess)) {
                          $eepsu_student_university_id = $rows->eepsu_student_university_id;
                          // Fetch all videos for the given employability program
                          $ep_video_query = "SELECT * FROM `employabilty_program_video` AS epv WHERE epv.epv_ep_id = {$ep_id} AND epv.epv_status = 'Published' ORDER BY epv.epv_created_date;";
                          $ep_video_result = mysqli_query($conn, $ep_video_query);

                          // Fetch all quizzes for the given employability program
                          $ep_quiz_query = "SELECT * FROM `employability_program_quiz` AS epq WHERE epq.epq_ep_id = {$ep_id} AND epq.epq_status = 'Published' ORDER BY epq.epq_created_date;";
                          $ep_quiz_result = mysqli_query($conn, $ep_quiz_query);

                          // Initialize progress variables
                          $total_videos = mysqli_num_rows($ep_video_result);
                          $total_quizzes = mysqli_num_rows($ep_quiz_result);
                          $video_progress = 0;
                          $quiz_progress = 0;
                          $quiz_score = 0;

                          // Check if any videos have been watched by the student
                          if (mysqli_num_rows($ep_video_result) > 0) {
                            while ($row = mysqli_fetch_assoc($ep_video_result)) {
                              $video_id = $row["epv_id"];
                              $watched_video_query = "SELECT * FROM `studuni_ep_watched_video` AS sumcvw WHERE sumcvw.suepvw_ep_video_id = {$video_id} AND sumcvw.suepvw_student_university_id = {$eepsu_student_university_id};";
                              $watched_video_result = mysqli_query($conn, $watched_video_query);
                              if (mysqli_num_rows($watched_video_result) > 0) {
                                $video_progress++;
                              }
                            }
                          }

                          // Check if any quizzes have been completed by the student
                          if (mysqli_num_rows($ep_quiz_result) > 0) {
                            while ($row = mysqli_fetch_assoc($ep_quiz_result)) {
                              $quiz_id = $row["epq_id"];
                              $completed_quiz_query = "SELECT * FROM `studuni_ep_quiz_result` AS suepqrs WHERE suepqrs.suepqrs_ep_quiz_id = {$quiz_id} AND suepqrs.suepqrs_student_university_id = {$eepsu_student_university_id} ;";
                              $completed_quiz_result = mysqli_query($conn, $completed_quiz_query);
                              if (mysqli_num_rows($completed_quiz_result) > 0) {
                                $quiz_progress++;
                              }
                            }
                          }

                          // Calculate progress percentage
                          if ($total_videos != 0) {
                            $video_percentage = round(($video_progress / $total_videos) * 100);
                          } else {
                            $video_percentage = 0;
                          }

                          if ($total_quizzes != 0) {
                            $quiz_percentage = round(($quiz_progress / $total_quizzes) * 100);
                          } else {
                            $quiz_percentage = 0;
                          }



                          // Check if both video and quiz progress are at 100%

                          if ($video_percentage == 100 && $quiz_percentage == 100) {
                            $button_disabled = "";

                            // Update enrollment status to Completed
                            $sql = "UPDATE enrolled_ep_studuni SET eepsu_status = 'Completed', eepsu_completed_date = NOW() WHERE eepsu_student_university_id = '$eepsu_student_university_id'";
                            $result = mysqli_query($conn, $sql);
                            if (!$result) {
                              echo "Error updating enrollment status: " . mysqli_error($conn);
                            }
                          } else {
                            $button_disabled = "disabled";
                          }

                      ?>
                          <tr>
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td class="border-top-0">
                              <a class="text-inherit">
                                <div class="d-lg-flex align-items-center">
                                  <div class="ms-lg-3 mt-2 mt-lg-0">
                                    <h4 class="mb-1 text-primary-hover">
                                      <?php echo $rows->su_fname; ?>
                                    </h4>

                                  </div>
                                </div>
                              </a>
                            </td>
                            <td class="wide">
                              <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->eepsu_enrollment_date)) ?> </span>
                            </td>
                            <td class="wide">
  <?php
  // Display video progress in UI
  echo "<div class='mb-3'>";
  echo "<div class='progress'>";
  if ($video_percentage == 100) {
    echo "<div class='progress-bar bg-success' role='progressbar' style='width: {$video_percentage}%;' aria-valuenow='{$video_progress}' aria-valuemin='0' aria-valuemax='{$total_videos}'>";
  } else {
    echo "<div class='progress-bar bg-info' role='progressbar' style='width: {$video_percentage}%;' aria-valuenow='{$video_progress}' aria-valuemin='0' aria-valuemax='{$total_videos}'>";
  }
  echo "<span class='visually-hidden'>{$video_percentage}% Complete</span>";
  echo "</div>";
  echo "</div>";
  if ($video_percentage == 100) {
    echo "<p class='text-center text-success'>{$video_progress} out of {$total_videos} videos watched ({$video_percentage}% complete)</p>";
  } else {
    echo "<p class='text-center text-info'>{$video_progress} out of {$total_videos} videos watched ({$video_percentage}% complete)</p>";
  }
  echo "</div>";
  ?>
</td>
<td class="wide">
  <?php
  // Display quiz progress in UI
  echo "<div class='mb-3'>";
  echo "<div class='progress'>";
  if ($quiz_percentage == 100) {
    echo "<div class='progress-bar bg-success' role='progressbar' style='width: {$quiz_percentage}%;' aria-valuenow='{$quiz_progress}' aria-valuemin='0' aria-valuemax='{$total_quizzes}'>";
  } else {
    echo "<div class='progress-bar bg-info' role='progressbar' style='width: {$quiz_percentage}%;' aria-valuenow='{$quiz_progress}' aria-valuemin='0' aria-valuemax='{$total_quizzes}'>";
  }
  echo "<span class='visually-hidden'>{$quiz_percentage}% Complete</span>";
  echo "</div>";
  echo "</div>";
  if ($quiz_percentage == 100) {
    echo "<p class='text-center text-success'>{$quiz_progress} out of {$total_quizzes} quizzes completed ({$quiz_percentage}% complete)</p>";
  } else {
    echo "<p class='text-center text-info'>{$quiz_progress} out of {$total_quizzes} quizzes completed ({$quiz_percentage}% complete)</p>";
  }
  echo "</div>";
  ?>
</td>


                            <td class="wide">
                              <?php if ($rows->eepsu_completed_date === null) : ?>
                                N/A
                              <?php else : ?>
                                <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->eepsu_completed_date)) ?> </span>
                              <?php endif; ?>


                            </td>
                            <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                              <?php
                              // Display issue certificate button if both video and quiz progress are at 100%
                              if ($video_percentage == 100 && $quiz_percentage == 100) {
                                echo "<button class='btn btn-sm btn-primary' >Issue Certificate</button>";
                              } else {
                                echo "<button class='btn btn-sm btn-primary' $button_disabled>Issue Certificate</button>";
                              }
                              ?>
                              <!-- <a class="btn btn-sm btn-warning shadow" href="admin-function.php?unpublish_course=<?php echo $rows->ep_id; ?>" title="Unpublish Course" onclick="return unpublishcourse()">Completed</a> -->
                            </td>
                          </tr>
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


  <script>
    function deletecourse() {
      var x = confirm("Are you sure want to delete this course?\n\n All course details and its content will be deleted");

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