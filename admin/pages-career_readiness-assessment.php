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
    $_SESSION['pages'] = 'Career_Readiness';
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
                <h1 class="mb-1 h2 fw-bold">Psychometric Test</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                      <a href="#">Psychometric Test</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      All
                    </li>
                  </ol>
                </nav>
              </div>
              <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursequiz">Add Physometric Test +</a>

              <div class="modal fade" id="addcoursequiz" tabindex="-1" role="dialog" aria-labelledby="coursequizmodal" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="coursequizmodal">Add New Physometric Test</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="POST" enctype="multipart/form-data" id="addmcquiz_form" autocomplete="off">
                        <div class="mb-3">
                     

                          <label class="form-label" for="textInput">Physometric Test Title :</label>
                          <input type="text" id="pt_title" name="pt_title" class="form-control" placeholder="Quiz title" required>
                        </div>


                        <div class="mb-3">
                          <label class="form-label">Physometric Test Instruction</label>
                          <textarea class="form-control" name="pt_instruction" id="editorquiz"></textarea>

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
                          <label class="form-label">Physometric Test Duration :</label>
                          <div class="input-group">
                            <input name="pt_duration" id="quiz_duration" type="text" class="form-control maskedTextField" onChange="check0(this)">
                            <div class="input-group-append">
                              <span class="input-group-text">Minutes</span>
                            </div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="enumInput">Action :</label>
                          <select class="selectpicker" data-width="100%" name="pt_status" required>
                            <option value="">Action</option>
                            <option value="Published">Publish</option>
                            <option value="Save Only">Save Only</option>
                          </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-sm" name="add_Physometric_Test">Save</button>
                    </div>
                  </div>
                </div>
                </form>
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
                        <th scope="col" class="border-0" width="430px">Psychometric Test</th>
                        <th scope="col" class="border-0" width="300px">Test Instruction</th>
                        <th scope="col" class="border-0">Test duraton</th>
                        <th scope="col" class="border-0">publish</th>
                        <th scope="col" class="border-0">publish</th>
                        <th scope="col" class="border-0" width="50px">Action</th>
                      </tr>
                    </thead>
                    <tbody class="align-middle">
                      
                      <?php
                      $querycq = $conn->query("SELECT * FROM psychometric_test WHERE pt_created_by = '$get_userID' AND pt_deleted_date IS NULL ");

                      $num = 1;
                      if (mysqli_num_rows($querycq) > 0) {
                        while ($rows = mysqli_fetch_object($querycq)) {

                      ?>
                          <tr>
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td class="border-top-0">
                              <a class="text-inherit">
                                <div class="d-lg-flex align-items-center">

                                  <div class="ms-lg-3 mt-2 mt-lg-0">
                                    <a data-bs-toggle="tooltip" title="View Details" href="pages-career_readiness-assessment-quiz.php?pt_id=<?php echo $rows->pt_id; ?>">
                                      <h4 class="mb-1 text-primary-hover">
                                        <?php echo $rows->pt_title; ?>
                                      </h4>
                                    </a>
                                    <span class="text-inherit "><?php echo date('j F Y H:i:s', strtotime($rows->pt_created_date)) ?> </span>
                                  </div>
                                </div>
                              </a>
                            </td>
                            <td class="wide">
                              <?= (strip_tags(substr($rows->pt_instruction, 0, 50))) ?>...
                              <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->pt_id; ?>">
                                <span style="color: skyblue;">Read More</span>
                              </button>
                            </td>

                            <td class="text-center">
                              <span style="vertical-align: middle;">
                                <center><?php if (($rows->pt_duration) != 0) {
                                          echo hoursandmins($rows->pt_duration, '%2d Hours and %2d Minutes');
                                        } ?>
                                </center>
                              </span>
                            </td>
                            <td class="text-center">
                              <span style="vertical-align: middle;" class="<?php if ($rows->pt_status == 'Draft') {
                                                                              echo "badge   bg-secondary";
                                                                            } elseif ($rows->pt_status == 'Processing') {
                                                                              echo "badge   bg-warning";
                                                                            } elseif ($rows->pt_status == 'Approved') {
                                                                              echo "badge   bg-success";
                                                                            } elseif ($rows->pt_status == 'Published') {
                                                                              echo "badge   bg-primary";
                                                                            } else {
                                                                              echo "badge   bg-warning";
                                                                            } ?>"><?php echo $rows->pt_status; ?></span>
                            </td>

                            <td class="text-center">

                              <a class="me-1 text-inherit" href="#">
                                <?php if ($rows->pt_status == 'Published') : ?>
                                  <a class="btn btn-sm btn-warning shadow" href="admin-function.php?unpublish_crt=<?php echo $rows->pt_id; ?>" title="Unpublish Quiz" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishquiz()">
                                    <!-- <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i> -->
                                    Unpublish
                                  </a>
                                <?php endif ?>
                                <?php if ($rows->pt_status == 'Save Only') : ?>
                                  <a class="btn btn-sm btn-success shadow" href="admin-function.php?publish_crt=<?php echo $rows->pt_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Quiz" onclick="return publishquiz()">
                                    <!-- <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i> -->
                                    Publish
                                  </a>
                                <?php endif ?>
                              </a>
                            </td>
                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                              <span class="dropdown dropstart">
                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                  <i class="fe fe-more-vertical"></i></a>
                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Action</span>
                                  <a class="dropdown-item" href="#modaleditquiz<?php echo $rows->pt_id; ?>" data-bs-toggle="modal" data-bs-target="#modaleditquiz<?php echo $rows->pt_id; ?>"><i class="fe fe-folder-plus dropdown-item-icon text-primary"></i>Update</a>
                                  <!-- <a href="#modaleditquiz<?php # echo $rows->pt_id; 
                                                              ?>" class="me-1 text-inherit" data-bs-toggle="modal" class="dropdown-item" data-bs-target="#modaleditquiz<?php #echo $rows->pt_id; 
                                                                                                                                                                                                  ?>">
                                                                              <i class="fe fe-edit dropdown-item-icon text-warning" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i>Edit</a> -->
                                  <a class="dropdown-item" href="admin-function.php?delete_crt=<?php echo $rows->pt_id; ?>" title="Delete Course" onclick="return deletecourse()"><i class="fe fe-trash dropdown-item-icon text-danger"></i>Delete</a>
                                  <a class="dropdown-item" href="pages-career_readiness-assessment-quiz.php?pt_id=<?php echo $rows->pt_id ?>" title="Delete Course"><i class="fas fa-question-circle dropdown-item-icon text-danger"></i>Questions</a>

                                </span>
                              </span>
                            </td>
                          </tr>
                </div>
              </div>
              <div class="modal fade" id="modaleditquiz<?php echo $rows->pt_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcq" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Physometric Test</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">

                          <input type="hidden" name="pt_id" value="<?php echo $rows->pt_id; ?>">

                          <label class="form-label" for="textInput">Physometric Test Title :</label>
                          <input type="text" id="new_pt_title" name="new_pt_title" value="<?php echo $rows->pt_title; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Physometric Test Instruction</label>
                          <textarea class="form-control" name="new_pt_instruction" id="editor<?php echo $rows->pt_id; ?>"><?php echo $rows->pt_instruction; ?></textarea>

                          <script>
                            ClassicEditor
                              .create(document.querySelector('#editor<?php echo $rows->pt_id; ?>'), {

                              })
                              .then(editor<?php echo $rows->pt_id; ?> => {
                                window.editor = editor;

                              })
                              .catch(err => {
                                console.error(err.stack);
                              });
                          </script>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Physometric Test Duration :</label>
                          <div class="input-group">
                            <input name="new_pt_duration" id="new_quiz_duration" type="text" value="<?php echo $rows->pt_duration; ?>" class="form-control maskedTextField" onChange="check0(this)">
                            <div class="input-group-append">
                              <span class="input-group-text">Minutes</span>
                            </div>
                          </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-sm" name="edit_psychometric_test">Update</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end modal edit -->

              <!-- Modal for More -->
              <div class="modal fade" id="modalView<?php echo $rows->pt_id; ?>" tabindex="-1" role="dialog" aria-labelledby="coursedesc" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Course Description</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-justify"><?php echo $rows->pt_instruction ?></h5>
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