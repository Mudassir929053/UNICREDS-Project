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
    $_SESSION['pages'] = 'courses';
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
                <h1 class="mb-1 h2 fw-bold">Manage Courses</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Courses</a>
                      <!--../institution/pages-manage-courses.php-->
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      All
                    </li>
                  </ol>
                </nav>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">Add New Course</button> <!-- addAdmin -->

              </div>
            </div>
          </div>

          <!-- Start Modal Page -->
          <div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="camodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="apmodal">New Courses</h5>
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
                              <span class="bs-stepper-label">Course Information</span>
                            </button>
                          </div>
                          <div class="bs-stepper-line"></div>
                          <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                              <span class="bs-stepper-circle">2</span>
                              <span class="bs-stepper-label">Course Media</span>
                            </button>
                          </div>
                        </div>
                      </div>
                      <!-- Stepper content -->
                      <div class="bs-stepper-content mt-5">
                        <form action="" method="POST" enctype="multipart/form-data" id="coursedetail">
                          <!-- Content one -->
                          <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                            <!-- Card -->
                            <div class="card mb-3 ">
                              <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Course Information</h4>
                              </div>
                              <!-- Card body -->

                              <div class="card-body">
                                <div class="row">
                                  <div class="mb-3 col-md-7">
                                    <label class="form-label">Course Name:</label>
                                    <input class="form-control" type="text" name="course_name" autocomplete="off">
                                  </div>

                                  <div class="mb-3 col-md-5">
                                    <label class="form-label">Course Code:</label>
                                    <input class="form-control" type="text" name="course_code" autocomplete="off">
                                  </div>

                                </div>



                                <div class="mb-3">
                                  <label class="form-label" for="textInput">Course Description:</label>
                                  <textarea class="form-control" name="course_description" id="editorreg"></textarea>
                                  <small>A brief description of your courses.</small>
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

                                  <div class="mb-3 col-md-6">
                                    <label class="form-label">Course Field:</label>
                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="course_field" id="field_id">
                                      <option value="" selected disabled>Select Course Field</option>
                                      <?php $queryField = $conn->query("SELECT * from field");
                                      if (mysqli_num_rows($queryField) > 0) {
                                        while ($row = mysqli_fetch_object($queryField)) {
                                      ?>
                                          <option value="<?php echo $row->field_id; ?>"><?php echo $row->field_name; ?></option>
                                        <?php }
                                      } else {
                                        ?>
                                      <?php
                                      } ?>
                                    </select>
                                  </div>


                                  <div class="mb-3 col-md-3">
                                    <label class="form-label">Course Level:</label>
                                    <select class="selectpicker" data-width="100%" name="course_level">
                                      <option value="">Select Course Level</option>
                                      <option value="Diploma"> Diploma </option>
                                      <option value="Degree"> Degree </option>
                                      <option value="Master"> Master </option>
                                      <option value="PhD"> PhD </option>
                                    </select>
                                  </div>

                                  <div class="mb-3 col-md-3">
                                    <label class="form-label">Course Type:</label>
                                    <select class="selectpicker" data-width="100%" name="course_type">
                                      <option value="">Select Course Level</option>
                                      <option value="Academic"> Academic </option>
                                      <option value="Non-academic"> Non-academic </option>

                                    </select>
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="mb-3 col-md-4">
                                    <label class="form-label">Course Fee:</label>
                                    <div class="input-group">
                                      <span class="input-group-text">RM</span>
                                      <input class="form-control" type="text" name="course_fee" aria-label="Amount (with dot and two decimal places)" autocomplete="off" required>
                                    </div>

                                  </div>

                                  <div class="mb-3 col-md-4">
                                    <label class="form-label">Course Duration:</label>
                                    <input class="form-control" type="text" name="course_duration" autocomplete="off">
                                  </div>

                                  <div class="mb-3 col-md-4">
                                    <label class="form-label">Course Credit:</label>
                                    <input class="form-control" type="text" name="course_credit" autocomplete="off">
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
                                <h4 class="mb-0">Course Media</h4>
                              </div>
                              <!-- Card body -->
                              <div class="card-body">
                                <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
                                  <label class="form-label">Course cover image
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                  </label>
                                  <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="coursecoverimage" id="pictureUpload" required>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                  </label>
                                  <small class="mt-3 d-block">Upload your Course image here.
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
                              <button type="submit" id="submit" class="btn btn-success btn-sm" name="add_course">
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
        </div>
        <!-- End Modal Page -->

        <div class="">
          <div class="row">
            <!-- basic table -->
            <div class="col-md-12 col-12 mb-5">
              <div class="card">
                <!-- card header  -->

                <!-- table  -->
                <div class="card-body">
                  <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap" style="width:100%">
                    <thead class="bg-primary text-white">
                      <tr class="text-center">
                        <th width="5px">No.</th>
                        <th> Name</th>
                        <th> Code</th>
                        <th> Description</th>
                        <th> Duration</th>
                        <th> Fee</th>
                        <th> Credit</th>
                        <th> Level</th>
                        <th> Type</th>
                        <th> Field</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody class="align-middle">
                      <?php
                      $queryCa = $conn->query("SELECT * FROM course
                                    INNER JOIN field ON course.course_field_id = field.field_id
                                    WHERE course_created_by = '$institution_id' AND course_deleted_date IS NULL");

                      $num = 1;
                      if (mysqli_num_rows($queryCa) > 0) {
                        while ($rows = mysqli_fetch_object($queryCa)) {
                      ?>
                          <tr>
                            <td class="text-center" ><?php echo $num++; ?></td>

                            <td class="border-top-0">

                              <div class="d-lg-flex align-items-center">
                                <div>
                                  <img src="../assets/images/course/<?php echo $rows->course_image; ?>" alt="" class="img-4by3-lg rounded" />
                                </div>
                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                  <h4 class="mb-0 text-primary-hover">
                                    <?php echo $rows->course_name; ?>
                                  </h4>
                                  <h6 class="text-inherit mb-0"><?php echo date('j F Y', strtotime($rows->course_created_date)) ?> </h6>
                                  <h6 class="text-inherit"><?php echo date('H:i:s', strtotime($rows->course_created_date)) ?> </h6>
                                </div>
                              </div>

                            </td>
                            <td class="text-center"><?php echo $rows->course_code; ?></td>
                            <td class="wide">
                              <?= (strip_tags(substr($rows->course_description, 0, 35))) ?>...
                              <button type="button" class="btn btn-sm btn-gradient-05" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $rows->course_id; ?>">
                                <span style="color: skyblue;">Read More</span>
                              </button>
                            </td>
                            <td class="text-center"><?php echo $rows->course_duration; ?></td>
                            <td class="text-center"><?php echo $rows->course_fee; ?></td>
                            <td class="text-center"><?php echo $rows->course_credit; ?></td>
                            <td class="text-center"><?php echo $rows->course_level; ?></td>
                            <td class="text-center"><?php echo $rows->course_type; ?></td>
                            <td class="text-center"><?php echo $rows->field_name; ?></td>

                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                              <span class="dropdown dropstart">
                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                  <i class="fe fe-more-vertical"></i>
                                </a>
                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Settings</span>

                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCourse<?php echo $rows->course_id; ?>" title="Edit Course"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                  <a class="dropdown-item" href="institution-function.php?delete_course=<?php echo $rows->course_id; ?>" title="Delete Course" onclick="return deleteCourse()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                </span>
                              </span>
                            </td>

                          </tr>
                          <div class="modal fade" id="editCourse<?php echo $rows->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="course_modal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="course_modal">Edit Course</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                  <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="course_id" value="<?php echo $rows->course_id; ?>">

                                    <div class="row">
                                      <div class="mb-3 col-md-7">
                                        <label class="form-label" for="textInput">Course Name:</label>
                                        <input type="text" name="new_course_name" class="form-control" value="<?php echo $rows->course_name; ?>" autocomplete="off">
                                      </div>

                                      <div class="mb-3 col-md-5">
                                        <label class="form-label">Course Code:</label>
                                        <input class="form-control" type="text" name="new_course_code" value="<?php echo $rows->course_code; ?>">
                                      </div>

                                    </div>

                                    <div class="mb-3">
                                      <label class="form-label" for="textInput">Course Description:</label>
                                      <textarea class="form-control" name="new_course_description" id="editor<?php echo $rows->course_id; ?>"><?php echo $rows->course_description; ?></textarea>
                                      <small>A brief description of your courses.</small>
                                      <script>
                                        ClassicEditor
                                          .create(document.querySelector('#editor<?php echo $rows->course_id; ?>'), {
                                            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                                          })
                                          .then(editor<?php echo $rows->course_id; ?> => {
                                            window.editor = editor;
                                          })
                                          .catch(err => {
                                            console.error(err.stack);
                                          });
                                      </script>
                                    </div>

                                    <div class="row">
                                      <div class="mb-3 col-md-6">
                                        <label class="form-label">Course Field:</label>
                                        <select class="selectpicker" data-live-search="true" data-width="100%" name="new_course_field">
                                          <option value="" selected disabled>Select Course Field</option>
                                          <?php $queryField = $conn->query("SELECT * from field");
                                          if (mysqli_num_rows($queryField) > 0) {
                                            while ($rowfield = mysqli_fetch_object($queryField)) {
                                          ?>
                                              <option value="<?php echo $rowfield->field_id; ?>" <?php if ($rows->course_field_id == $rowfield->field_id) {
                                                                                                    echo "selected";
                                                                                                  } else {
                                                                                                  } ?>><?php echo $rowfield->field_name; ?>
                                              <?php }
                                          } else {
                                              ?>
                                            <?php
                                          } ?>
                                        </select>
                                      </div>

                                      <div class="mb-3 col-md-3">
                                        <label class="form-label">Course Level:</label>
                                        <select class="selectpicker" data-live-search="true" data-width="100%" name="new_course_level">
                                          <option value="Diploma" <?php if ($rows->course_level == "Diploma") {
                                                                    echo "selected";
                                                                  } ?>>Diploma</option>
                                          <option value="Degree" <?php if ($rows->course_level == "Degree") {
                                                                    echo "selected";
                                                                  } ?>>Degree</option>
                                          <option value="Master" <?php if ($rows->course_level == "Master") {
                                                                    echo "selected";
                                                                  } ?>>Master</option>
                                          <option value="PhD" <?php if ($rows->course_level == "PhD") {
                                                                echo "selected";
                                                              } ?>>PhD</option>
                                        </select>
                                      </div>

                                      <div class="mb-3 col-md-3">
                                        <label class="form-label">Course Type:</label>
                                        <select class="selectpicker" data-width="100%" name="new_course_type">
                                          <option value="">Select Course Level</option>
                                          <option value="Academic" <?php if ($rows->course_type == "Academic") {
                                                                      echo "selected";
                                                                    } ?>> Academic </option>
                                          <option value="Non-academic" <?php if ($rows->course_type == "Non-academic") {
                                                                          echo "selected";
                                                                        } ?>> Non-academic </option>

                                        </select>
                                      </div>


                                    </div>

                                    <div class="row">
                                      <div class="mb-3 col-md-4">
                                        <label class="form-label">Course Fee:</label>
                                        <input class="form-control" type="text" name="new_course_fee" value="<?php echo $rows->course_fee; ?>">
                                      </div>

                                      <div class="mb-3 col-md-4">
                                        <label class="form-label">Course Duration:</label>
                                        <input class="form-control" type="text" name="new_course_duration" value="<?php echo $rows->course_duration; ?>">
                                      </div>

                                      <div class="mb-3 col-md-4">
                                        <label class="form-label">Course Credit:</label>
                                        <input class="form-control" type="text" name="new_course_credit" value="<?php echo $rows->course_credit; ?>">
                                      </div>
                                    </div>

                                    <div class="custom-file-container" data-upload-id="courseCoverImg<?php echo $rows->course_id; ?>" id="courseCoverImg<?php echo $rows->course_id; ?>">
                                      <label class="form-label">Course cover image
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"></a>
                                      </label>

                                      <label class="custom-file-container__custom-file">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="coursecoverimage" id="pictureUpload">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                      </label>
                                      <?php if ($rows->course_image != NULL) { ?>
                                        <p class="mt-2">Current File Image: <a href="../assets/images/course/<?php echo $rows->course_image; ?>" target="_blank">
                                            <?php echo $rows->course_image; ?></a></p>
                                      <?php } else {
                                      } ?>
                                      <small class="mt-3 d-block">Upload your course image here.
                                        Important guidelines: 750x440 pixels; .jpg, .jpeg, .gif, or .png.
                                        No text on the image.
                                      </small>
                                      <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    <script>
                                      if ($("#courseCoverImg<?php echo $rows->course_id; ?>").length)
                                        new FileUploadWithPreview("courseCoverImg<?php echo $rows->course_id; ?>", {
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
                                  <button type="submit" class="btn btn-success btn-sm" name="edit_course">Submit</button>
                                </div>
                              </div>
                            </div>
                            </form>
                          </div>

                          <!-- Modal for More -->
                          <div class="modal fade" id="modalView<?php echo $rows->course_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cadesc" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Course Description</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5 class="text-justify"><?php echo $rows->course_description ?></h5>
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

      <!--Script-->
      <script>
        function deleteCourse() {
          var x = confirm("Are sure want to delete this course?");
          if (x == true) {
            return true;
          } else {
            return false;
          }
        }

        function clearForm() {

          document.getElementById("coursedetail").reset();
          document.getElementById("pictureUpload").value = null;
          $('#field_id').selectpicker("refresh");

        }

        $('#addCourse').on('hidden.bs.modal', function() {
          $(this).find('form').trigger('reset');
        });
      </script>

      <!-- Theme JS -->
      <script src="../assets/js/theme.min.js"></script>

      <script src="../assets/js/ckeditor.js"></script>
      <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>