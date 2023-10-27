<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('lecturer-function.php');

$lecturer_id = $_SESSION['sess_lecturerid'];
$mcid = $_GET['mcid'];

$querymc = $conn->query("SELECT * FROM microcredential WHERE mc_id = '$mcid'");

$checkmcstatus = mysqli_fetch_object($querymc);
$getmcstatus = $checkmcstatus->mc_status;


@$content_type = $_SESSION['content_type'];

?>



<body>
   <!-- Wrapper -->
   <div id="db-wrapper">
      <!-- navbar vertical -->
      <?php
      unset($_SESSION['pages']);
      $_SESSION['pages'] = 'mc';
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
                        <h1 class="mb-1 h2 fw-bold">Micro-credential Content</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="pages-microcredential-list.php">Micro-credential</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Micro-credential Content</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>

                     <div>
                        <?php if ($getmcstatus == "Processing") { ?>
                           <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-microcredential-assessment.php?mcid=<?php echo $mcid; ?>">
                              View Assessment </a>
                        <?php } else { ?>
                           <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-microcredential-assessment.php?mcid=<?php echo $mcid; ?>">
                              <i class="mdi mdi-note-multiple me-1"></i> Manage Assessment </a>
                        <?php } ?>

                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-microcredential-list.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>
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
                           $querymcn = $conn->query("SELECT * FROM mc_notes
                                                    LEFT JOIN microcredential ON microcredential.mc_id = mcn_mc_id
                                                     WHERE mcn_deleted_date IS NULL AND mcn_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymcn) > 0) {
                              while ($rows = mysqli_fetch_object($querymcn)) {

                           ?>
                                 <div class="accordion" id="notelist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#notedetail<?php echo $rows->mcn_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="notedetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->mcn_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
                                                   <span class="<?php if ($rows->mcn_status == 'Published') {
                                                                     echo "badge bg-success";
                                                                  } else {
                                                                     echo "badge bg-warning";
                                                                  } ?>"><?php echo $rows->mcn_status; ?></span>

                                                   <?php if ($getmcstatus == "Processing") { ?>

                                                   <?php } else { ?>

                                                      <a class="me-1 text-inherit" href="#">
                                                         <?php if ($rows->mcn_status == 'Published') : ?>
                                                            <a href="lecturer-function.php?unpublish_mcn=<?php echo $rows->mcn_id; ?>" title="Unpublish Note" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishnote()">
                                                               <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                         <?php endif ?>
                                                         <?php if ($rows->mcn_status == 'Save Only') : ?>
                                                            <a href="lecturer-function.php?publish_mcn=<?php echo $rows->mcn_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Note" onclick="return publishnote()">
                                                               <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                         <?php endif ?>
                                                      </a>

                                                      <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditnote<?php echo $rows->mcn_id; ?>">
                                                         <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                      <div class="modal fade" id="modaleditnote<?php echo $rows->mcn_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmnn" aria-hidden="true">
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
                                                                        <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">
                                                                        <input type="hidden" name="mcn_id" value="<?php echo $rows->mcn_id; ?>">

                                                                        <label class="form-label" for="textInput">Title :</label>
                                                                        <input type="text" id="new_mcn_title" name="new_mcn_title" value="<?php echo $rows->mcn_title; ?>" class="form-control" required>
                                                                     </div>

                                                                     <div class="mb-3">
                                                                        <label class="form-label">Note Description</label>
                                                                        <textarea class="form-control" name="new_mcn_desc" id="editornote<?php echo $rows->mcn_id; ?>"><?php echo $rows->mcn_description; ?></textarea>

                                                                        <script>
                                                                           ClassicEditor
                                                                              .create(document.querySelector('#editornote<?php echo $rows->mcn_id; ?>'), {

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
                                                                              <input type="file" onChange="readURL(this);" accept="image/jpeg, image/png" class="form-control custom-file-input" name="mcn_attachment" id="mnn_attachment<?php echo $rows->mcn_id; ?>">

                                                                           </div>
                                                                        </div>

                                                                        <?php if ($rows->mcn_attachment != NULL) { ?>
                                                                           <p>Current File : <a href="../assets/attachment/microcredential/mcnote/<?php echo $rows->mcn_attachment; ?>" target="_blank">
                                                                                 <?php echo $rows->mcn_attachment; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>

                                                                     </div>
                                                               </div>

                                                               <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                  <button type="submit" class="btn btn-success btn-sm" name="edit_mcn">Save</button>
                                                               </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <a href="lecturer-function.php?delete_mcn=<?php echo $rows->mcn_id; ?>&mc_id=<?php echo $mcid; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletemcn()">
                                                         <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>
                                                   <?php } ?>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#notedetail<?php echo $rows->mcn_id ?>" aria-controls="notedetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="notedetail<?php echo $rows->mcn_id ?>" data-bs-parent="#notelist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdescnote<?php echo $rows->mcn_id; ?>" title="View Description"> <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>

                                                   <div class="modal fade" id="modalviewdescnote<?php echo $rows->mcn_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcndesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Note Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->mcn_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->mcn_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/microcredential/mcnote/<?php echo $rows->mcn_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
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
                        <?php if ($getmcstatus == "Processing") { ?>

                        <?php } else { ?>
                           <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addmcnote">Add Note +</a>
                        <?php } ?>


                        <div class="modal fade" id="addmcnote" tabindex="-1" role="dialog" aria-labelledby="mcnotemodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="mcnotemodal">Add New Note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmcnote_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">

                                          <label class="form-label">Title :</label>

                                          <input style="text-transform:capitalize" id="mnn_title" class="form-control" type="text" placeholder="Notes Title" name="mcn_title" autocomplete="off" required>
                                       </div>


                                       <div class="mb-3">
                                          <label class="form-label">Note Description</label>
                                          <textarea class="form-control" name="mcn_desc" id="editornewnote"></textarea>

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
                                             <input class="dropify form-control" type="file" accept="image/jpeg, image/png" name="mcn_attachment" id="mcn_attachment">
                                             <label class="input-group-text" for="mcn_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="mcn_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="addmcn">Save</button>
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
                           $querymcv = $conn->query("SELECT * FROM mc_video
                                                     LEFT JOIN microcredential ON microcredential.mc_id = mcv_mc_id
                                                     WHERE mcv_deleted_date IS NULL AND mcv_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymcv) > 0) {
                              while ($rows = mysqli_fetch_object($querymcv)) {

                           ?>

                                 <div class="list-group list-group-flush border-top-0" id="vidlist">
                                    <div>
                                       <div class="list-group-item rounded m-1">
                                          <div class="d-flex align-items-center justify-content-between">
                                             <h5 class="mb-0">
                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#viddetail<?php echo $rows->mcv_id ?>" aria-controls="viddetail">
                                                   <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                   <span class="align-middle"><?php echo $rows->mcv_title ?></span>
                                                </a>
                                             </h5>
                                             <div>
                                                <span class="<?php if ($rows->mcv_status == 'Published') {
                                                                  echo "badge bg-success";
                                                               } else {
                                                                  echo "badge bg-warning";
                                                               } ?> me-1"><?php echo $rows->mcv_status; ?>

                                                </span>

                                                <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modalviewviddesc<?php echo $rows->mcv_id; ?>">
                                                   <i class="fe fe-search fs-3" data-bs-toggle="tooltip" data-placement="top" title="View Description" style="vertical-align: middle;"></i></a>

                                                <div class="modal fade" id="modalviewviddesc<?php echo $rows->mcv_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcvdesc" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Video Description</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <h5 class="text-justify"><?php echo $rows->mcv_description ?></h5>
                                                         </div>

                                                      </div>
                                                   </div>
                                                </div>

                                                <?php if ($getmcstatus == "Processing") { ?>

                                                <?php } else { ?>

                                                   <a class="me-1 text-inherit" href="#">
                                                      <?php if ($rows->mcv_status == 'Published') : ?>
                                                         <a href="lecturer-function.php?unpublish_mcv=<?php echo $rows->mcv_id; ?>" title="Unpublish Video" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishvideo()">
                                                            <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                      <?php if ($rows->mcv_status == 'Save Only') : ?>
                                                         <a href="lecturer-function.php?publish_mcv=<?php echo $rows->mcv_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Video" onclick="return publishvideo()">
                                                            <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                      <?php endif ?>
                                                   </a>


                                                   <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditvideo<?php echo $rows->mcv_id; ?>">
                                                      <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                   <div class="modal fade" id="modaleditvideo<?php echo $rows->mcv_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcv" aria-hidden="true">
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
                                                                     <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">
                                                                     <input type="hidden" name="mcv_id" value="<?php echo $rows->mcv_id; ?>">

                                                                     <label class="form-label" for="textInput">Title :</label>
                                                                     <input type="text" id="new_mcv_title" name="new_mcv_title" value="<?php echo $rows->mcv_title; ?>" class="form-control" required>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                     <label class="form-label">Video Description</label>
                                                                     <textarea class="form-control" name="new_mcv_desc" id="editorvid<?php echo $rows->mcv_id; ?>"><?php echo $rows->mcv_description; ?></textarea>

                                                                     <script>
                                                                        ClassicEditor
                                                                           .create(document.querySelector('#editorvid<?php echo $rows->mcv_id; ?>'), {

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
                                                                           <input type="file" onChange="readURL(this);" accept="video/mp4, video/webm" class="form-control custom-file-input" name="mcv_attachment" id="mcv_attachment<?php echo $rows->mcv_id; ?>">

                                                                        </div>
                                                                     </div>

                                                                     <?php if ($rows->mcv_attachment != NULL) { ?>
                                                                        <p>Current File : <a href="../assets/attachment/microcredential/mcvideo/<?php echo $rows->mcv_attachment; ?>" target="_blank">
                                                                              <?php echo $rows->mcv_attachment; ?></a></p>
                                                                     <?php } else {
                                                                     } ?>

                                                                  </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-success btn-sm" name="edit_mcv">Save</button>
                                                            </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <a href="lecturer-function.php?delete_mcv=<?php echo $rows->mcv_id; ?>&mc_id=<?php echo $mcid; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletemcv()">
                                                      <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                <?php } ?>

                                                <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#viddetail<?php echo $rows->mcv_id ?>" aria-controls="viddetail">
                                                   <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                </a>
                                             </div>
                                          </div>
                                          <div id="viddetail<?php echo $rows->mcv_id ?>" class="collapse" data-bs-parent="#vidlist">
                                             <div class="card-body bg-info rounded p-3 mt-2">
                                                <a class="popup-youtube d-flex justify-content-between align-items-center text-inherit text-decoration-none" href="../assets/attachment/microcredential/mcvideo/<?php echo $rows->mcv_attachment; ?>">
                                                   <div class="text-truncate">
                                                      <span class="icon-shape bg-white icon-sm rounded-circle me-2"><i class="mdi mdi-play fs-4 text-dark"></i></span>
                                                      <span class="text-white">Play Video &nbsp;<i class="fas fa-arrow-right">&nbsp;</i> <?php echo $rows->mcv_title; ?></span>

                                                   </div>
                                                   <div>
                                                      <span class="text-white">
                                                         <?php echo $rows->mcv_duration; ?>
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

                        <?php if ($getmcstatus == "Processing") { ?>

                        <?php } else { ?>
                           <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addmcvid">Add Video +</a>
                        <?php } ?>


                        <div class="modal fade" id="addmcvid" tabindex="-1" role="dialog" aria-labelledby="mcvideomodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="mcvideomodal">Add New Video</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmcn_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">

                                          <label class="form-label" for="textInput">Title :</label>
                                          <input type="text" id="mcv_title" name="mcv_title" class="form-control" placeholder="Video title" required>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label">Video Description</label>
                                          <textarea class="form-control" name="mcv_desc" id="editorregvid"></textarea>

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
                                             <input class="dropify form-control" type="file" accept="video/mp4, video/webm" name="mcv_attachment" id="mcv_attachment">
                                             <label class="input-group-text" for="mcv_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="mcv_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="add_mc_video">Save</button>
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
                           $querymcs = $conn->query("SELECT * FROM mc_slide
                                                     LEFT JOIN microcredential ON microcredential.mc_id = mcs_mc_id
                                                     WHERE mcs_deleted_date IS NULL AND mcs_mc_id = '$mcid'");

                           $num = 1;
                           if (mysqli_num_rows($querymcs) > 0) {
                              while ($rows = mysqli_fetch_object($querymcs)) {

                           ?>
                                 <div class="accordion" id="slidelist">
                                    <div class="list-group list-group-flush border-top-0">
                                       <div>
                                          <div class="list-group-item rounded m-1">
                                             <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                   <a href="#slidedetail<?php echo $rows->mcs_id ?>" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="" aria-controls="slidedetail">
                                                      <i class="fe fe-menu me-1 text-muted align-middle"></i>
                                                      <span class="align-middle"><?php echo $rows->mcs_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
                                                   <span class="<?php if ($rows->mcs_status == 'Published') {
                                                                     echo "badge bg-success";
                                                                  } else {
                                                                     echo "badge bg-warning";
                                                                  } ?>"><?php echo $rows->mcs_status; ?>
                                                   </span>

                                                   <?php if ($getmcstatus == "Processing") { ?>

                                                   <?php } else { ?>

                                                      <a class="me-1 text-inherit" href="#">
                                                         <?php if ($rows->mcs_status == 'Published') : ?>
                                                            <a href="lecturer-function.php?unpublish_mcs=<?php echo $rows->mcs_id; ?>" title="Unpublish Slide" data-bs-toggle="tooltip" data-placement="top" onclick="return unpublishslide()">
                                                               <i class="fas fa-toggle-on dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                         <?php endif ?>
                                                         <?php if ($rows->mcs_status == 'Save Only') : ?>
                                                            <a href="lecturer-function.php?publish_mcs=<?php echo $rows->mcs_id; ?>" data-bs-toggle="tooltip" data-placement="top" title="Publish Slide" onclick="return publishslide()">
                                                               <i class="fas fa-toggle-off dropdown-item-icon text-dark" style="vertical-align: middle;"></i></a>
                                                         <?php endif ?>
                                                      </a>

                                                      <a href="#" class="me-1 text-inherit" data-bs-toggle="modal" data-bs-target="#modaleditslide<?php echo $rows->mcs_id; ?>">
                                                         <i class="fe fe-edit fs-3" data-bs-toggle="tooltip" data-placement="top" title="Edit" style="vertical-align: middle;"></i></a>

                                                      <div class="modal fade" id="modaleditslide<?php echo $rows->mcs_id; ?>" tabindex="-1" role="dialog" aria-labelledby="editmcs" aria-hidden="true">
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
                                                                        <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">
                                                                        <input type="hidden" name="mcs_id" value="<?php echo $rows->mcs_id; ?>">

                                                                        <label class="form-label" for="textInput">Title :</label>
                                                                        <input type="text" id="new_mcs_title" name="new_mcs_title" value="<?php echo $rows->mcs_title; ?>" class="form-control" required>
                                                                     </div>

                                                                     <div class="mb-3">
                                                                        <label class="form-label">Slide Description</label>
                                                                        <textarea class="form-control" name="new_mcs_desc" id="editorslide<?php echo $rows->mcs_id; ?>"><?php echo $rows->mcs_description; ?></textarea>

                                                                        <script>
                                                                           ClassicEditor
                                                                              .create(document.querySelector('#editorslide<?php echo $rows->mcs_id; ?>'), {

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
                                                                              <input type="file" onChange="readURL(this);" accept="image/jpeg, image/png, video/mp4, video/webm" class="form-control custom-file-input" name="mcs_attachment" id="mcs_attachment<?php echo $rows->mcs_id; ?>">

                                                                           </div>
                                                                        </div>

                                                                        <?php if ($rows->mcs_attachment != NULL) { ?>
                                                                           <p>Current File : <a href="../assets/attachment/microcredential/mcslide/<?php echo $rows->mcs_attachment; ?>" target="_blank">
                                                                                 <?php echo $rows->mcs_attachment; ?></a></p>
                                                                        <?php } else {
                                                                        } ?>

                                                                     </div>
                                                               </div>

                                                               <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                  <button type="submit" class="btn btn-success btn-sm" name="edit_mcs">Save</button>
                                                               </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <a href="lecturer-function.php?delete_mcs=<?php echo $rows->mcs_id; ?>&mcid=<?php echo $mcid; ?>" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" title="Delete" onclick="return deletemcs()">
                                                         <i class="fe fe-trash-2 fs-3" style="vertical-align: middle;"></i></a>

                                                   <?php } ?>

                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#slidedetail<?php echo $rows->mcs_id ?>" aria-controls="slidedetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="slidedetail<?php echo $rows->mcs_id ?>" data-bs-parent="#slidelist">
                                                <div class="card-body">

                                                   <a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#modalviewdescslide<?php echo $rows->mcs_id; ?>" title="View Description"> <span class="hidden-xs-down"><i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </span></a>

                                                   <div class="modal fade" id="modalviewdescslide<?php echo $rows->mcs_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mcsdesc" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                               <h4 class="modal-title">Note Description</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                               </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <h5 class="text-justify"><?php echo $rows->mcs_description ?></h5>
                                                            </div>

                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php
                                                   if ($rows->mcs_attachment != NULL) {
                                                   ?>
                                                      <a class="btn btn-outline-primary waves-effect waves-light btn-sm" href="../assets/attachment/microcredential/mcslide/<?php echo $rows->mcs_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
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

                        <?php if ($getmcstatus == "Processing") { ?>

                        <?php } else { ?>
                           <a href="#" class="btn btn-outline-primary btn-sm shadow" data-bs-toggle="modal" data-bs-target="#addmcslide">Add Slide +</a>
                        <?php } ?>



                        <div class="modal fade" id="addmcslide" tabindex="-1" role="dialog" aria-labelledby="mcslidemodal" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="mcslidemodal">Add New Slide</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="addmcslide_form" autocomplete="off">
                                       <div class="mb-3">
                                          <input type="hidden" name="mc_id" value="<?php echo $mcid; ?>">

                                          <label class="form-label">Title :</label>

                                          <input style="text-transform:capitalize" id="mcs_title" class="form-control" type="text" placeholder="Slide Title" name="mcs_title" autocomplete="off" required>
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label">Slide Description</label>
                                          <textarea class="form-control" name="mcs_desc" id="editornewslide"></textarea>

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
                                             <input class="dropify form-control" type="file" name="mcs_attachment" id="mcs_attachment">
                                             <label class="input-group-text" for="mcs_file">Upload</label>

                                          </div>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="enumInput">Action :</label>
                                          <select class="selectpicker" data-width="100%" name="mcs_status" required>
                                             <option value="">Action</option>
                                             <option value="Published">Publish</option>
                                             <option value="Save Only">Save Only</option>
                                          </select>
                                       </div>
                                 </div>

                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm" name="addmcs">Save</button>
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
      function deletemcn() {
         var x = confirm("Are you sure want to delete this notes?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletemcv() {
         var x = confirm("Are you sure want to delete this video?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }

      function deletemcs() {
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