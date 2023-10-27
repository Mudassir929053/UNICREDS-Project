<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';
include('../database/dbcon.php');
include('institution-function.php');

$institution_id = $_SESSION['sess_institutionid'];
?>

<body>
  <!-- Wrapper -->
  <div id="db-wrapper">
    <!-- navbar vertical -->

    <?php
    unset($_SESSION['pages']);
    $_SESSION['pages'] = 'programme';
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
                <h1 class="mb-1 h2 fw-bold">Manage Academic Programme</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                      <a href="#">Academic Programme</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      All
                    </li>
                  </ol>
                </nav>
              </div>
              <div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProgramme">Add Academic Programme</button>
              </div>
            </div>
          </div>

          <!-- Start Modal Page -->
          <div class="modal fade" id="addProgramme" tabindex="-1" role="dialog" aria-labelledby="apmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="apmodal">Register Academic Programme</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                </div>
                <div class="modal-body">


                  <div id="courseForm" class="bs-stepper">

                    <div class="row">

                      <!-- Stepper Button -->
                      <div class="col-md-8 mx-auto">
                        <div class="bs-stepper-header shadow-sm " role="tablist">
                          <div class="step" data-target="#test-l-1">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                              <span class="bs-stepper-circle">1</span>
                              <span class="bs-stepper-label">Academic Programme Information</span>
                            </button>
                          </div>
                          <div class="bs-stepper-line"></div>
                          <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                              <span class="bs-stepper-circle">2</span>
                              <span class="bs-stepper-label">Academic Programme Media</span>
                            </button>
                          </div>
                        </div>
                      </div>
                      <!-- Stepper content -->
                      <div class="bs-stepper-content mt-5">
                        <form action="" method="POST" enctype="multipart/form-data" id="apdetail">
                          <!-- Content one -->
                          <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                            <!-- Card -->
                            <div class="card mb-3 ">
                              <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Academic Programme Information</h4>
                              </div>
                              <!-- Card body -->
                              <div class="card-body">
                                <div class="mb-3">
                                  <label class="control-label">Program Name:</label>
                                  <input class="form-control" type="text" name="programme_name" id="ap_name">
                                </div>

                                <div class="mb-3">
                                  <label class="form-label">Program Field:</label>
                                  <select class="selectpicker" data-live-search="true" data-width="100%" name="programme_field">
                                    <option value="" selected disabled>Select Program Field</option>
                                    <?php $queryProgrammeField = $conn->query("SELECT * from field");
                                    if (mysqli_num_rows($queryProgrammeField) > 0) {
                                      while ($row = mysqli_fetch_object($queryProgrammeField)) {
                                    ?>
                                        <option value="<?php echo $row->field_id; ?>"><?php echo $row->field_name; ?></option>
                                      <?php }
                                    } else {
                                      ?>
                                    <?php
                                    } ?>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label class="form-label" for="textInput">Program Description:</label>
                                  <textarea class="form-control" name="programme_description" id="editorreg"></textarea>
                                  <small>A brief description of your academic programme.</small>
                                  <script>
                                    ClassicEditor
                                      .create(document.querySelector('#editorreg'), {
                                        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
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
                                  <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-right: 5%;">
                                    <label class="form-label">Programme Level:</label>
                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="programme_type">
                                      <option value="">Select Program Level</option>
                                      <option value="Diploma"> Diploma </option>
                                      <option value="Degree"> Degree </option>
                                      <option value="Master"> Master </option>
                                      <option value="Phd"> Phd </option>
                                    </select>
                                  </div>

                                  <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-left: 5%;">
                                    <label class="form-label">Program Duration:</label>
                                    <input class="form-control" type="text" name="programme_duration" id="ap_duration">
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-right: 5%;">
                                    <label class="control-label">Program Fee:</label>
                                    <div class="input-group">
                                      <span class="input-group-text">RM</span>
                                      <input class="form-control" type="text" id="ap_fee" name="programme_fee"  aria-label="Amount (with dot and two decimal places)" autocomplete="off" required>
                                    </div>
                                    <!-- <input class="form-control" type="text" name="programme_fee" id="ap_fee"> -->
                                  </div>

                                  <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-left: 5%;">
                                    <label class="control-label">Program Total Credit:</label>
                                    <input class="form-control" type="text" name="programme_total_credit" id="ap_total_credit">
                                  </div>
                                </div>

                              </div>
                            </div>
                            <!-- Button -->
                            <button class="btn btn-primary btn-sm" onclick="courseForm.next()">
                              Next
                            </button>
                          </div>
                          <!-- Content two -->
                          <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                            <!-- Card -->
                            <div class="card mb-3  border-0">
                              <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Academic Programme Media</h4>
                              </div>
                              <!-- Card body -->
                              <div class="card-body">
                                <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                  <label class="form-label">Academic Programme cover image
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                  </label>
                                  <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="ap_image" id="pictureUpload" required>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                  </label>
                                  <small class="mt-3 d-block">Upload your academic programme image here.
                                    Important guidelines: 750x440 pixels; .jpg, .jpeg,.
                                    gif, or .png. no text on the image.</small>
                                  <div class="custom-file-container__image-preview"></div>
                                </div>

                              </div>
                            </div>
                            <!-- Button -->
                            <div class="d-flex justify-content-between">
                              <button class="btn btn-secondary btn-sm" onclick="courseForm.previous()">
                                Previous
                              </button>
                              <button type="submit" id="submit" class="btn btn-success btn-sm" name="add_ap">
                                Submit
                              </button>
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
          <!-- End Modal Page -->


          <div class="">
            <div class="row">
              <!-- basic table -->
              <div class="col-md-12 col-12 mb-5">
                <div class="card">
                  <!-- card header  -->
                  <div class="card-header border-bottom-0">

                  </div>
                  <!-- table  -->
                  <div class="card-body pt-2">
                    <table id="dataTableBasic" class="table table-bordered table-hover display no-wrap" style="width:100%">
                      <thead class="bg-primary text-white">
                        <tr class="text-center">
                          <th width="10px">No.</th>
                          <th>Programme Name</th>
                          <th>Programme Field</th>
                          <th>Programme Description</th>
                          <th>Programme Level</th>
                          <th>Programme Duration</th>
                          <th>Programme Fee</th>
                          <th>Programme Total Credit</th>
                          <!-- <th>Programme Certificate</th> -->
                          <th></th>
                        </tr>
                      </thead>

                      <tbody class="align-middle">
                        <?php
                        $queryAp = $conn->query("SELECT * FROM academic_programme 
                                    INNER JOIN field ON academic_programme.ap_field_id = field.field_id
                                    WHERE ap_created_by = '$institution_id' AND ap_deleted_date IS NULL");

                        $num = 1;
                        if (mysqli_num_rows($queryAp) > 0) {
                          while ($rows = mysqli_fetch_object($queryAp)) {
                        ?>
                            <tr>
                              <td class="text-center"><?php echo $num++; ?></td>

                              <td class="border-top-0">
                                <a class="text-inherit">
                                  <div class="d-lg-flex align-items-center">
                                    <div>
                                      <img src="../assets/images/academicprogramme/<?php echo $rows->ap_image; ?>" alt="" class="img-4by3-lg rounded" />
                                    </div>
                                    <div class="ms-lg-3 mt-2 mt-lg-0">
                                      <h4 class="mb-1 text-primary-hover">
                                        <?php echo $rows->ap_name; ?>
                                      </h4>
                                      <span class="text-inherit"><?php echo date('j F Y H:i:s', strtotime($rows->ap_created_date)) ?> </span>
                                    </div>
                                  </div>
                                </a>
                              </td>

                              <td class="text-center"><?php echo $rows->field_name; ?></td>
                              <td class="wide">
                                <?= (strip_tags(substr($rows->ap_description, 0, 50))) ?>...
                                <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->ap_id; ?>">
                                  <span style="color: skyblue;">Read More</span>
                                </button>
                              </td>
                              <td class="text-center"><?php echo $rows->ap_type; ?></td>
                              <td class="text-center"><?php echo $rows->ap_duration; ?></td>
                              <td class="text-center"><?php echo $rows->ap_fee; ?></td>
                              <td class="text-center"><?php echo $rows->ap_total_credit; ?></td>

                              <td class="text-muted px-4 py-3 align-middle border-top-0">
                                <span class="dropdown dropstart">
                                  <a class="text-muted text-decoration-none" href="#" role="button" id="academicDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                    <i class="fe fe-more-vertical"></i>
                                  </a>
                                  <span class="dropdown-menu" aria-labelledby="academicDropdown"><span class="dropdown-header">Settings</span>
                                    <a class="dropdown-item" href="pages-view-courses-under-academic-programme.php?ap_id=<?php echo $rows->ap_id; ?>"><i class="fe fe-folder dropdown-item-icon"></i>View Details</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editAcademicProgramme<?php echo $rows->ap_id; ?>" title="Edit Programme"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                    <a class="dropdown-item" href="institution-function.php?delete_academic_programme=<?php echo $rows->ap_id; ?>" title="Delete Programme" onclick="return deleteAcademicProgramme()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                  </span>
                                </span>
                              </td>

                            </tr>
                            <div class="modal fade" id="editAcademicProgramme<?php echo $rows->ap_id; ?>" tabindex="-1" role="dialog" aria-labelledby="academic_programme_modal" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="academic_programme_modal">Edit Academic Programme</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>

                                  <div class="modal-body">
                                    <form action="institution-function.php" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="ap_id" value="<?php echo $rows->ap_id; ?>">
                                      <input type="hidden" name="file_url" value="<?php echo $rows->ap_image; ?>">
                                      <div class="mb-3">
                                        <label class="form-label" for="textInput">Programme Name:</label>
                                        <input type="text" name="new_programme_name" class="form-control" value="<?php echo $rows->ap_name; ?>">
                                      </div>

                                      <div class="form-group">
                                        <div class="mb-3">
                                          <label class="form-label">Program Field:</label>
                                          <select class="selectpicker" data-live-search="true" data-width="100%" name="new_programme_field">
                                            <option value="" selected disabled>Select Program Field</option>
                                            <?php $queryProgrammeField = $conn->query("SELECT * from field");
                                            if (mysqli_num_rows($queryProgrammeField) > 0) {
                                              while ($row = mysqli_fetch_object($queryProgrammeField)) {
                                            ?>
                                                <option value="<?php echo $row->field_id; ?>" <?php if ($rows->ap_field_id == $row->field_id) {
                                                                                                echo "selected";
                                                                                              } else {
                                                                                              } ?>><?php echo $row->field_name; ?>
                                                <?php }
                                            } else {
                                                ?>
                                              <?php
                                            } ?>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="mb-3">
                                        <label class="form-label" for="textInput">Program Description:</label>
                                        <textarea class="form-control" name="new_programme_description" id="editor<?php echo $rows->ap_id; ?>"><?php echo $rows->ap_description; ?></textarea>
                                        <small>A brief description of your academic programme.</small>
                                        <script>
                                          ClassicEditor
                                            .create(document.querySelector('#editor<?php echo $rows->ap_id; ?>'), {
                                              // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                                            })
                                            .then(editor<?php echo $rows->ap_id; ?> => {
                                              window.editor = editor;
                                            })
                                            .catch(err => {
                                              console.error(err.stack);
                                            });
                                        </script>
                                      </div>
                                            
                                      <div class="row" >
                                        <!-- To make form field small to the right -->
                                        <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-right: 5%;">
                                          <label class="form-label">Programme Level:</label>
                                          <select class="selectpicker" data-live-search="true" data-width="100%" name="new_programme_type">
                                            <option value="diploma" <?php if ($rows->ap_type == "Diploma") {
                                                                      echo "selected";
                                                                    } ?>>Diploma</option>
                                            <option value="degree" <?php if ($rows->ap_type == "Degree") {
                                                                      echo "selected";
                                                                    } ?>>Degree</option>
                                            <option value="master" <?php if ($rows->ap_type == "Master") {
                                                                      echo "selected";
                                                                    } ?>>Master</option>
                                            <option value="phd" <?php if ($rows->ap_type == "Phd") {
                                                                  echo "selected";
                                                                } ?>>Phd</option>
                                          </select>
                                        </div>
                                      

                                      
                                        <!-- To make form field small to the left -->
                                        <div class="mb-3 col-md-6" style="display:inline-block; width:50%; padding-left: 5%;">
                                          <label class="form-label">Program Duration:</label>
                                          <input class="form-control" type="text" name="new_programme_duration" id="ap_duration" value="<?php echo $rows->ap_duration; ?>">
                                        </div>
                                        </div>
                                            
                                        
                                      <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                        <!-- To make form field small to the right -->
                                        <div class="mb-3">
                                          <label class="control-label">Program Fee:</label>
                                          <input class="form-control" type="text" name="new_programme_fee" id="ap_fee" value="<?php echo $rows->ap_fee; ?>">
                                        </div>
                                      </div>

                                      <div class="form-group" style="display:inline-block; width:50%; padding-left: 5%; float: right;">
                                        <!-- To make form field small to the left -->
                                        <div class="mb-3">
                                          <label class="control-label">Program Total Credit:</label>
                                          <input class="form-control" type="text" name="new_programme_total_credit" id="ap_total_credit" value="<?php echo $rows->ap_total_credit; ?>">
                                        </div>
                                      </div>

                                      <div class="custom-file-container" data-upload-id="programmeCoverImg<?php echo $rows->ap_id; ?>" id="programmeCoverImg<?php echo $rows->ap_id; ?>">
                                        <label class="form-label">Academic Programme cover image
                                          <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                        </label>

                                        <label class="custom-file-container__custom-file">
                                          <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="ap_image" id="pictureUpload">
                                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                          <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <?php if ($rows->ap_image != NULL) { ?>
                                          <p>Current File Image: <a href="images/AP/<?php echo $rows->ap_image; ?>" target="_blank">
                                              <?php echo $rows->ap_image; ?></a></p>
                                        <?php } else {
                                        } ?>
                                        <small class="mt-3 d-block">Upload your academic programme image here.
                                          Important guidelines: 750x440 pixels; .jpg, .jpeg, .gif, or .png.
                                          No text on the image.
                                        </small>
                                        <div class="custom-file-container__image-preview"></div>
                                      </div>
                                      <script>
                                        if ($("#programmeCoverImg<?php echo $rows->ap_id; ?>").length)
                                          new FileUploadWithPreview("programmeCoverImg<?php echo $rows->ap_id; ?>", {
                                            showDeleteButtonOnImage: !0,
                                            text: {
                                              chooseFile: "No File Selected",
                                              browse: "Upload File"
                                            }
                                          });
                                      </script>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="edit_academic_programme">Submit</button>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>

                            <!-- Modal for More -->
                            <div class="modal fade" id="modalView<?php echo $rows->ap_id; ?>" tabindex="-1" role="dialog" aria-labelledby="apdesc" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Academic Programme Description</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="text-justify"><?php echo $rows->ap_description ?></h5>
                                  </div>

                                </div>
                              </div>
                            </div>

                            <!-- Modal for More -->

                          <?php }
                        } else {
                          ?>
                        <?php
                        } ?>

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
  </div>

  <!--Script-->
  <script>
    function deleteAcademicProgramme() {
      var x = confirm("Are sure want to delete this academic programme?");
      if (x == true) {
        return true;
      } else {
        return false;
      }
    }
  </script>

  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>

  <script src="../assets/js/ckeditor.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>