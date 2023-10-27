<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include '../database/dbcon.php';
include('institution-function.php');

$institution_id = $_SESSION['sess_institutionid'];
$sql="SELECT institution_user_id  from institution where institution_id  = '$institution_id'";
$checkuserrow = $conn->query($sql);
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->institution_user_id;
?>



<body>
  <!-- Wrapper -->
  <div id="db-wrapper">
    <!-- navbar vertical -->
    <?php
    unset($_SESSION['pages']);
    $_SESSION['pages'] = 'employability';
    include 'pages-sidebar.php';
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
                <h1 class="mb-1 h2 fw-bold">Employability Program </h1>
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

                <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-employability-program-register.php">
                  Add Program </a>
              </div>
            </div>
          </div>



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
                    <thead class="bg-gradient bg-info text-white">
                      <tr class="text-center">
                        <th scope="col" class="border-0" width="10px">No.</th>
                        <th scope="col" class="border-0" width="400px">Employability Program</th>
                        <th scope="col" class="border-0" width="300px">Employability Program Description</th>
                        <th scope="col" class="border-0">Program Fee</th>
                        <th scope="col" class="border-0">Status</th>
                        <th scope="col" class="border-0">Date Publish</th>
                        <th scope="col" class="border-0">Publish</th>

                        <th scope="col" class="border-0" width="50px">Action</th>
                      </tr>
                    </thead>
                    <tbody class="align-middle">
                      <?php
                      $querycourse = $conn->query("SELECT * FROM employability_program   
                                               LEFT JOIN user ON course_created_by = user.user_id                                                                                
                                               WHERE course_created_by = '$get_userID' ;");
                      $num = 1;
                      if (mysqli_num_rows($querycourse) > 0) {
                        while ($rows = mysqli_fetch_object($querycourse)) {
                          $ep_id = $rows->ep_id;
                      ?>
                          <tr>
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td class="border-top-0">
                              <a class="text-inherit">
                                <div class="d-lg-flex align-items-center">
                                  <div>
                                    <img src="../assets/images/course/<?php echo $rows->ep_cover_attachment; ?>" alt="" class="img-4by3-lg rounded" />
                                  </div>
                                  <div class="ms-lg-3 mt-2 mt-lg-0">
                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-employability-program-details.php?cid=<?php echo $rows->ep_id;  ?>">
                                      <h4 class="mb-1 text-primary-hover">
                                        <?php echo $rows->ep_title; ?>
                                      </h4>
                                    </a>
                                    <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->ep_created_date)) ?> </span>
                                  </div>
                                </div>
                              </a>
                            </td>
                            <td class="wide">
                              <?= (strip_tags(substr($rows->ep_description, 0, 50))) ?>...
                              <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->ep_id; ?>">
                                <span style="color: skyblue;">Read More</span>
                              </button>
                            </td>
                            <?php if ($rows->ep_fee == 'Free' || $rows->ep_fee == 'free' || $rows->ep_fee == 'FREE') { ?>
                              <td class="text-center"><?php echo $rows->ep_fee; ?></td>
                            <?php } else { ?>
                              <td class="text-center">RM <?php echo floatval($rows->ep_fee / 100); ?></td>
                            <?php
                            } ?>

                            <td class="text-center">
                              <span style="vertical-align: middle;" class="<?php if ($rows->course_status == 'Draft') {
                                                                              echo "badge rounded-pill bg-secondary";
                                                                            } elseif ($rows->course_status == 'Processing') {
                                                                              echo "badge rounded-pill bg-warning";
                                                                            } elseif ($rows->course_status == 'Approved') {
                                                                              echo "badge rounded-pill bg-success";
                                                                            } elseif ($rows->course_status == 'Published') {
                                                                              echo "badge rounded-pill bg-primary";
                                                                            } else {
                                                                              echo "badge rounded-pill bg-danger";
                                                                            } ?>"><?php echo $rows->ep_publish; ?></span>
                            </td>

                            <?php if ($rows->ep_published_date != NULL) { ?>
                              <td class="text-center"><?php echo date('j/m/Y', strtotime($rows->ep_published_date)) ?></td>
                            <?php } else { ?>
                              <td class="text-center"><?php echo date('j F Y', strtotime($rows->ep_published_date)) ?>
                              </td>
                            <?php } ?>

                            <td class="text-center">
                              <?php $querynote = $conn->query("SELECT * FROM employabilty_program_note LEFT JOIN 	employability_program ON 	employability_program.ep_id = epn_ep_id 
                                 WHERE ep_id = '$ep_id' AND course_created_by = '$get_userID' AND epn_created_by = '$get_userID'");
                              $totalnote =  mysqli_num_rows($querynote);

                              $queryvideo = $conn->query("SELECT * FROM employabilty_program_video LEFT JOIN employability_program ON employability_program.ep_id = epv_ep_id  
                                 WHERE ep_id = '$ep_id' AND course_created_by = '$get_userID' AND epv_created_by = '$get_userID'");
                              $totalvideo =  mysqli_num_rows($queryvideo);

                              $queryquiz = $conn->query("SELECT * FROM employability_program_quiz LEFT JOIN employability_program ON employability_program_quiz.epq_ep_id = employability_program.ep_id 
                              WHERE employability_program.ep_id = '$ep_id' AND employability_program.course_created_by = '$get_userID' AND employability_program_quiz.epq_created_by ='$get_userID'");
                              $totalquiz =  mysqli_num_rows($queryquiz);



                              $totallearningvideo = $totalvideo;
                              $totallearningactivity = $totalnote;
                              $totalassessment = $totalquiz;

                              ?>
                              <?php if ($rows->ep_publish == 'Draft') {

                                if ($totallearningvideo >= 1 && $totallearningactivity >= 1 && $totalassessment >= 1) {
                              ?>

                                  <a class="btn btn-sm btn-success shadow" href="institution-function.php?publish_course=<?php echo $rows->ep_id; ?>" title="Publish Course" onclick="return publishcourse()">Publish</a>
                                <?php } else { ?>
                                  <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<p class='text-start'>A complete module contains at least the followings :</p>
    <li class='text-start'>ONE (1) self-developed and well edited learning video </li>
    <li class='text-start'>ONE (1) learning activity – to develop the learners</li>
    <li class='text-start'>ONE (1) assessment – to assess the learners</li> <br>
    <p class='text-start'><b>*You need to complete the module before publish</b></p> ">
                                    <button class="btn btn-sm text-dark btn-light-secondary shadow" style="pointer-events: none;" type="button" disabled>Publish Disabled</button>
                                  </span>

                                <?php } ?>
                              <?php } else { ?>
                                <a class="btn btn-sm btn-warning shadow" href="institution-function.php?unpublish_course=<?php echo $rows->ep_id; ?>" title="Unpublish Course" onclick="return unpublishcourse()">Unpublish</a>
                              <?php  } ?>


                            </td>

                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                              <span class="dropdown dropstart">
                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                  <i class="fe fe-more-vertical"></i></a>
                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                  <a class="dropdown-item" href="pages-employability-program-details.php?cid=<?php echo $rows->ep_id; ?>"><i class="fe fe-eye dropdown-item-icon text-info"></i>View Details</a>
                                  <a class="dropdown-item" href="pages-employability-program-content.php?cid=<?php echo $rows->ep_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i>Manage Content</a>
                                  <a class="dropdown-item" href="pages-employability-program-content-edit.php?cid=<?php echo $rows->ep_id; ?>"><i class="fe fe-edit dropdown-item-icon text-warning"></i>Edit</a>
                                  <a class="dropdown-item" href="institution-function.php?delete_ep=<?php echo $rows->ep_id; ?>" title="Delete Course" onclick="return deletecourse()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                </span>
                              </span>
                            </td>
                          </tr>


                </div>
              </div>

              <!-- end modal edit -->

              <!-- Modal for More -->
              <div class="modal fade" id="modalView<?php echo $rows->ep_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursedesc" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Employability Program Description</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-justify"><?php echo $rows->ep_description ?></h5>
                    </div>
                  </div>
                </div>
              </div>

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
      var x = confirm("Are you sure want to delete this course?\nAll course details and its content will be deleted");

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