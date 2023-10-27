<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];
$course_id = $_GET['cid'];

// $content_type = "";

@$content_type = $_SESSION['content_type'];

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
         <!-- Container fluid -->
         <div class="container-fluid p-4">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-12">
                  <!-- Page Header -->
                  <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                     <div class="mb-3 mb-md-0">
                        <h1 class="mb-1 h2 fw-bold">Course Content</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="pages-course-list.php">Course</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Course Content</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>
                     <div>
                        <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-course-assessment.php?cid=<?php echo $course_id; ?>">
                           <i class="mdi mdi-note-multiple me-1"></i> Manage Assessment </a>

                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-course-list.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>
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
                           <a class="nav-link <?php if ($content_type == "Notes") {
                                                   echo "active";
                                                } else if ($content_type == NULL) {
                                                   echo "active";
                                                } ?>" id="note-tab" data-bs-toggle="pill" href="#note" role="tab" aria-controls="note" aria-selected="true">Notes</a>

                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?php if ($content_type == "Video") {
                                                   echo "active";
                                                } ?>" id="video-tab" data-bs-toggle="pill" href="#video" role="tab" aria-controls="video" aria-selected="false">Video</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link <?php if ($content_type == "Slide") {
                                                   echo "active";
                                                } ?>" id="slide-tab" data-bs-toggle="pill" href="#slide" role="tab" aria-controls="slide" aria-selected="false">Slide</a>
                        </li>

                     </ul>
                  </div>
               </div>
               <!-- Card Body -->
               <div class="card-body">
                  <div class="tab-content" id="tabContent">
                     <div class="tab-pane <?php if ($content_type == "Notes") {
                                             echo "active";
                                          } else if ($content_type == NULL) {
                                             echo "active";
                                          } ?>" id="note" role="tabpanel" aria-labelledby="note-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querycn = $conn->query("SELECT * FROM course_notes
                                                    LEFT JOIN course ON course.course_id = cn_course_id
                                                    WHERE cn_deleted_date IS NULL AND cn_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($querycn) > 0) {
                              while ($rows = mysqli_fetch_object($querycn)) {

                           ?>
                                 <div class="accordion" id="notelist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#notedetail<?php echo $rows->cn_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="notedetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->cn_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
                                                   <span class="<?php if ($rows->cn_status == 'Published') {
                                                                     echo "badge bg-success";
                                                                  } else {
                                                                     echo "badge bg-warning";
                                                                  } ?>"><?php echo $rows->cn_status; ?></span>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->cn_status == 'Published') : ?>
                                                         <a href="admin-function.php?unpublish_cn=<?php echo $rows->cn_id; ?>" title="Unpublish Note" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishnote()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->cn_status == 'Save Only') : ?>
                                                         <a href="admin-function.php?publish_cn=<?php echo $rows->cn_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Note" onclick="return publishnote()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>

                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditnote<?php echo $rows->cn_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaleditnote<?php echo $rows->cn_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editcn" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Edit Notes</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="" method="POST" enctype="multipart/form-data">
                                                                  <div class="mb-3">
                                                                     <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                     <input type="hidden" name="cn_id" value="<?php echo $rows->cn_id; ?>">

                                                                     <label class="form-label" for="textInput">Title :</label>
                                                                     <input type="text" id="new_cn_title" name="new_cn_title" value="<?php echo $rows->cn_title; ?>" class="form-control" required>
                                                                  </div>

                                                                  <div class="mb-3">
                                                                     <label class="form-label">Note Description</label>
                                                                     <textarea class="form-control" name="new_cn_desc" id="editornote<?php echo $rows->cn_id; ?>"><?php echo $rows->cn_description; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editornote<?php echo $rows->cn_id; ?>'), {

                                                                           })
                                                                           .then(editor => {
                                                                              window.editor = editor;
                                                                           })
                                                                           .catch(err => {
                                                                              console.error(err.stack);
                                                                           });
                                                                     </script>

                                                                  </div>

                                                                  <div class="mb-3 col-md-12">
                                                                     <label class="form-label" for="textInput">Attachment :</label>
                                                                     <div class="custom-file">
                                                                        <div class="input-group mb-1">
                                                                           <input type="file" onChange="readURL(this);" class="form-control custom-file-input" name="cn_attachment" id="cn_attachment<?php echo $rows->cn_id; ?>">

                                                                        </div>
                                                                     </div>

                                                                     <?php if ($rows->cn_attachment != NULL) { ?>
                                                                        <p>Current File : <a href="../assets/attachment/course/coursenote/<?php echo $rows->cn_attachment; ?>" target="_blank">
                                                                              <?php echo $rows->cn_attachment; ?></a></p>
                                                                     <?php } else {
                                                                     } ?>

                                                                  </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-success btn-sm" name="edit_cn">Save</button>
                                                            </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <a href="admin-function.php?delete_cn=<?php echo $rows->cn_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletecn()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#notedetail<?php echo $rows->cn_id ?>" aria-controls="notedetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="notedetail<?php echo $rows->cn_id ?>" data-bs-parent="#notelist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdescnote<?php echo $rows->cn_id; ?>" title="View Description"> <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>

                                                   <div class="modal fade" id="modalviewdescnote<?php echo $rows->cn_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cndesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Note Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->cn_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->cn_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/course/coursenote/<?php echo $rows->cn_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn btn-outline-secondary waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>

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
                                 <i class="mdi mdi-48px mdi-file-remove"></i>
                                 <h4 class="card-title">No Notes Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcoursenote">Add Note +</a>

                        <div class="modal fade" id="addcoursenote" tabindex="-1" role="dialog" aria-labelledby="cnotemodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="cnotemodal">Add New Note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addcnote_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                          <label class="form-label">Title :</label>
                                          <input style="text-transform:capitalize" id="cn_title" class="form-control" type="text" placeholder="Notes Title" name="cn_title" autocomplete="off" required>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label">Note Description</label>
                                          <textarea class="form-control" name="cn_desc" id="editornewnote"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editornewnote'), {

                                                })
                                                .then(editor => {
                                                   window.editor = editor;
                                                })
                                                .catch(err => {
                                                   console.error(err.stack);
                                                });
                                          </script>
                                       </div>

                                       <div class="mb-3 col-md-12">
                                          <label class="form-label" for="textInput">Attachment :</label>
                                          <div class="input-group mb-1">
                                             <input class="dropify form-control" type="file" name="cn_attachment" id="cn_attachment">
                                             <label class="input-group-text" for="cn_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="cn_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_course_note">Save</button>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>

                     <div class="tab-pane <?php if ($content_type == "Video") {
                                             echo "active";
                                          } ?>" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <!-- List group -->
                           <?php
                           $querycv = $conn->query("SELECT * FROM course_video
                                                     LEFT JOIN course ON course.course_id = cv_course_id
                                                     WHERE cv_deleted_date IS NULL AND cv_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($querycv) > 0) {
                              while ($rows = mysqli_fetch_object($querycv)) {

                           ?>

                                 <div class="list-group list-group-flush border-top-0" id="vidlist">
                                    <div>
                                       <div class="list-group-item rounded m-1">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <h5 class="mb-0">
                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#viddetail<?php echo $rows->cv_id ?>" aria-controls="viddetail">
                                                   <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                   <span class="align-middle"><?php echo $rows->cv_title ?></span>
                                                </a>
                                             </h5>
                                             <div>
                                                <span class="<?php if ($rows->cv_status == 'Published') {
                                                                  echo "badge bg-success";
                                                               } else {
                                                                  echo "badge bg-warning";
                                                               } ?>"><?php echo $rows->cv_status; ?></span>


                                                <a class="me-1 text-inherit" href="#">
                                                   <?php if ($rows->cv_status == 'Published') : ?>
                                                      <a href="admin-function.php?unpublish_cv=<?php echo $rows->cv_id; ?>" title="Unpublish Video" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishvideo()">
                                                         <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                   <?php endif ?>
                                                   <?php if ($rows->cv_status == 'Save Only') : ?>
                                                      <a href="admin-function.php?publish_cv=<?php echo $rows->cv_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Video" onclick="return publishvideo()">
                                                         <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                   <?php endif ?>
                                                </a>

                                                <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modalviewviddesc<?php echo $rows->cv_id; ?>">
                                                   <i class="fe fe-search fs-3" data-bs-toggle="tooltip" data-placement="top" title="View Description" style="vertical-align: middle;"></i></a>

                                                <div class="modal fade" id="modalviewviddesc<?php echo $rows->cv_id; ?>" tabindex="-1" role="dialog" aria-labelledby="cvdesc" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Video Description</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <h5 class="text-justify"><?php echo $rows->cv_description ?></h5>
                                                         </div>

                                                      </div>
                                                   </div>
                                                </div>

                                                <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditvideo<?php echo $rows->cv_id; ?>">
                                                   <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                <div class="modal fade" id="modaleditvideo<?php echo $rows->cv_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcv" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Edit Video</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                               <div class="mb-3">
                                                                  <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                  <input type="hidden" name="cv_id" value="<?php echo $rows->cv_id; ?>">

                                                                  <label class="form-label" for="textInput">Title :</label>
                                                                  <input type="text" id="new_cv_title" name="new_cv_title" value="<?php echo $rows->cv_title; ?>" class="form-control" required>
                                                               </div>
                                                               <div class="mb-3">
                                                                  <label class="form-label">Video Description</label>
                                                                  <textarea class="form-control" name="new_cv_desc" id="editorvid<?php echo $rows->cv_id; ?>"><?php echo $rows->cv_description; ?></textarea>

                                                                  <script>
                                                                     ClassicEditor
                                                                        .create(document.querySelector('#editorvid<?php echo $rows->cv_id; ?>'), {

                                                                        })
                                                                        .then(editor => {
                                                                           window.editor = editor;
                                                                        })
                                                                        .catch(err => {
                                                                           console.error(err.stack);
                                                                        });
                                                                  </script>
                                                               </div>

                                                               <div class="mb-3 col-md-12">
                                                                  <label class="form-label" for="textInput">Attachment :</label>
                                                                  <div class="custom-file">
                                                                     <div class="input-group mb-1">
                                                                        <input type="file" onChange="readURL(this);" class="form-control custom-file-input" accept="video/mp4, video/webm" name="cv_attachment" id="cv_attachment<?php echo $rows->cv_id; ?>">

                                                                     </div>
                                                                  </div>

                                                                  <?php if ($rows->cv_attachment != NULL) { ?>
                                                                     <p>Current File : <a href="../assets/attachment/course/coursevideo/<?php echo $rows->cv_attachment; ?>" target="_blank">
                                                                           <?php echo $rows->cv_attachment; ?></a></p>
                                                                  <?php } else {
                                                                  } ?>

                                                               </div>
                                                         </div>

                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success btn-sm" name="edit_cv">Save</button>
                                                         </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>

                                                <a href="admin-function.php?delete_cv=<?php echo $rows->cv_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletecv()">
                                                   <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#viddetail<?php echo $rows->cv_id ?>" aria-controls="viddetail">
                                                   <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                </a>
                                             </div>
                                          </div>
                                          <div id="viddetail<?php echo $rows->cv_id ?>" class="collapse" data-bs-parent="#vidlist">
                                             <div class="card-body bg-info rounded p-3 mt-2">
                                                <a class="popup-youtube d-flex justify-content-between align-items-center text-inherit text-decoration-none" href="../assets/attachment/course/coursevideo/<?php echo $rows->cv_attachment; ?>">
                                                   <div class="text-truncate">
                                                      <span class="icon-shape bg-white icon-sm rounded-circle me-2"><i class="mdi mdi-play fs-4 text-dark"></i></span>
                                                      <span class="text-white">Play Video &nbsp;<i class="fas fa-arrow-right">&nbsp;</i> <?php echo $rows->cv_title; ?></span>

                                                   </div>
                                                   <div>
                                                      <span class="text-white">
                                                         <?php echo $rows->cv_duration; ?>
                                                      </span>
                                                   </div>

                                                </a>

                                             </div>
                                          </div>

                                       </div>
                                    </div>
                                 </div>
                              <?php }
                           } else {
                              ?>
                              <div class="col-lg-12 col-md-12 col-12 text-center">
                                 <i class="mdi mdi-48px mdi-video-off"></i>
                                 <h4 class="card-title">No Video Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcvid">Add Video +</a>

                        <div class="modal fade" id="addcvid" tabindex="-1" role="dialog" aria-labelledby="cvideomodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="cvideomodal">Add New Video</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addcv_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                          <label class="form-label" for="textInput">Title :</label>
                                          <input type="text" id="cv_title" name="cv_title" class="form-control" placeholder="Video title" required>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label">Video Description</label>
                                          <textarea class="form-control" name="cv_desc" id="editorregvid"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editorregvid'), {

                                                })
                                                .then(editor => {
                                                   window.editor = editor;
                                                })
                                                .catch(err => {
                                                   console.error(err.stack);
                                                });
                                          </script>
                                       </div>

                                       <div class="mb-3 col-md-12">
                                          <label class="form-label" for="textInput">Attachment :</label>
                                          <div class="input-group mb-1">
                                             <input class="dropify form-control" type="file" accept="video/mp4, video/webm" name="cv_attachment" id="cv_attachment">
                                             <label class="input-group-text" for="cv_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="cv_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_course_video">Save</button>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>

                     <div class="tab-pane <?php if ($content_type == "Slide") {
                                             echo "active";
                                          } ?>" id="slide" role="tabpanel" aria-labelledby="slide-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querycs = $conn->query("SELECT * FROM course_slide
                                                    LEFT JOIN course ON course.course_id = cs_course_id
                                                    WHERE cs_deleted_date IS NULL AND cs_course_id = '$course_id'");

                           $num = 1;
                           if (mysqli_num_rows($querycs) > 0) {
                              while ($rows = mysqli_fetch_object($querycs)) {

                           ?>
                                 <div class="accordion" id="slidelist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#slidedetail<?php echo $rows->cs_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="slidedetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->cs_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
                                                   <span class="<?php if ($rows->cs_status == 'Published') {
                                                                     echo "badge bg-success";
                                                                  } else {
                                                                     echo "badge bg-warning";
                                                                  } ?>"><?php echo $rows->cs_status; ?></span>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->cs_status == 'Published') : ?>
                                                         <a href="admin-function.php?unpublish_cs=<?php echo $rows->cs_id; ?>" title="Unpublish Slide" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishslide()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->cs_status == 'Save Only') : ?>
                                                         <a href="admin-function.php?publish_cs=<?php echo $rows->cs_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Slide" onclick="return publishslide()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>

                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditslide<?php echo $rows->cs_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaleditslide<?php echo $rows->cs_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editcs" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Edit Slide</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="" method="POST" enctype="multipart/form-data">
                                                                  <div class="mb-3">
                                                                     <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                                                     <input type="hidden" name="cs_id" value="<?php echo $rows->cs_id; ?>">

                                                                     <label class="form-label" for="textInput">Title :</label>
                                                                     <input type="text" id="new_cs_title" name="new_cs_title" value="<?php echo $rows->cs_title; ?>" class="form-control" required>
                                                                  </div>

                                                                  <div class="mb-3">
                                                                     <label class="form-label">Slide Description</label>
                                                                     <textarea class="form-control" name="new_cs_desc" id="editorslide<?php echo $rows->cs_id; ?>"><?php echo $rows->cs_description; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editorslide<?php echo $rows->cs_id; ?>'), {

                                                                           })
                                                                           .then(editor => {
                                                                              window.editor = editor;
                                                                           })
                                                                           .catch(err => {
                                                                              console.error(err.stack);
                                                                           });
                                                                     </script>

                                                                  </div>

                                                                  <div class="mb-3 col-md-12">
                                                                     <label class="form-label" for="textInput">Attachment :</label>
                                                                     <div class="custom-file">
                                                                        <div class="input-group mb-1">
                                                                           <input type="file" onChange="readURL(this);" accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation" class="form-control custom-file-input" name="cs_attachment" id="cs_attachment<?php echo $rows->cs_id; ?>">

                                                                        </div>
                                                                     </div>

                                                                     <?php if ($rows->cs_attachment != NULL) { ?>
                                                                        <p>Current File : <a href="../assets/attachment/course/courseslide/<?php echo $rows->cs_attachment; ?>" target="_blank">
                                                                              <?php echo $rows->cs_attachment; ?></a></p>
                                                                     <?php } else {
                                                                     } ?>

                                                                  </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-success btn-sm" name="edit_cs">Save</button>
                                                            </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <a href="admin-function.php?delete_cs=<?php echo $rows->cs_id; ?>&cid=<?php echo $course_id; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletecs()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#slidedetail<?php echo $rows->cs_id ?>" aria-controls="slidedetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="slidedetail<?php echo $rows->cs_id ?>" data-bs-parent="#slidelist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdescslide<?php echo $rows->cs_id; ?>" title="View Description"> <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>

                                                   <div class="modal fade" id="modalviewdescslide<?php echo $rows->cs_id; ?>" tabindex="-1" role="dialog" aria-labelledby="csdesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Note Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->cs_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->cs_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/course/courseslide/<?php echo $rows->cs_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                   <?php
                                                   } else {
                                                   ?>
                                                      <a class="btn btn-outline-secondary waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                   <?php
                                                   }
                                                   ?>

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
                                 <i class="mdi mdi-48px mdi-book-remove"></i>
                                 <h4 class="card-title">No Slide Available</h4>
                              </div>
                           <?php
                           } ?>
                        </div>

                        <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addcslide">Add Slide +</a>

                        <div class="modal fade" id="addcslide" tabindex="-1" role="dialog" aria-labelledby="cslidemodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="cslidemodal">Add New Slide</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addcslide_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                          <label class="form-label">Title :</label>
                                         
                                          <input style="text-transform:capitalize" id="cs_title" class="form-control" type="text" placeholder="Slide Title" name="cs_title" autocomplete="off" required>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label">Slide Description</label>
                                          <textarea class="form-control" name="cs_desc" id="editornewslide"></textarea>

                                          <script>
                                             ClassicEditor
                                                .create(document.querySelector('#editornewslide'), {

                                                })
                                                .then(editor => {
                                                   window.editor = editor;
                                                })
                                                .catch(err => {
                                                   console.error(err.stack);
                                                });
                                          </script>
                                       </div>

                                       <div class="mb-3 col-md-12">
                                          <label class="form-label" for="textInput">Attachment :</label>
                                          <div class="input-group mb-1">
                                             <input class="dropify form-control" type="file" accept="application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation" name="cs_attachment" id="cs_attachment">
                                             <label class="input-group-text" for="cs_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="cs_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_cs">Save</button>
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

   <script>
      function deletecn() {
         var x = confirm("Are you sure want to delete this notes?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletecv() {
         var x = confirm("Are you sure want to delete this video?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletecs() {
         var x = confirm("Are you sure want to delete this slide?");

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

      function publishvideo() {
         var x = confirm("Are you sure want to publish this video?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function unpublishvideo() {
         var x = confirm("Are you sure want to unpublish this video?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function publishslide() {
         var x = confirm("Are you sure want to publish this slide?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function unpublishslide() {
         var x = confirm("Are you sure want to unpublish this slide?");

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
   </script>



   <!-- clipboard -->



   <!-- Theme JS -->
   <script src="../assets/js/theme.min.js"></script>
   <script src="../assets/js/ckeditor.js"></script>

   <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>