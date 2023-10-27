<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('committee-function.php');

$committee_id = $_SESSION['sess_committeeid'];
$mcid = $_GET['mcid'];

// $content_type = "";

@$content_type = $_SESSION['content_type'];

?>



<body>
   <!-- Wrapper -->
   <div id="db-wrapper">
      <!-- navbar vertical -->
      <?php
      unset($_SESSION['pages']);
      $_SESSION['pages'] = 'mcreview';
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
                        <a class="btn btn-primary waves-effect waves-light btn-sm shadow" href="pages-microcredential-assessment-review.php?mcid=<?php echo $mcid; ?>"> View Assessment </a>
                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-microcredential-review.php"><i class="mdi mdi-keyboard-backspace"></i> Back </a>
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
                           <a class="nav-link <?php if ($content_type == "Notes") { echo "active"; } else if ($content_type == NULL) { echo "active"; } ?>" id="note-tab" data-bs-toggle="pill" href="#note" role="tab" aria-controls="note" aria-selected="true">Notes</a>
                         
                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?php if ($content_type == "Video") { echo "active"; }?>" id="video-tab" data-bs-toggle="pill" href="#video" role="tab" aria-controls="video" aria-selected="false">Video</a>
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
                     <div class="tab-pane <?php if ($content_type == "Notes") { echo "active"; } else if ($content_type == NULL) { echo "active"; } ?>" id="note" role="tabpanel" aria-labelledby="note-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querymcn = $conn->query("SELECT * FROM mc_notes
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
                                                      <span class="align-middle" data-bs-toggle="tooltip" title="View Description & Attachment"><?php echo $rows->mcn_title ?></span>
                                                   </a>
                                                </h5>
                                                <div>
 
                                                   <a href="#" class="text-inherit" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#notedetail<?php echo $rows->mcn_id ?>" aria-controls="notedetail">
                                                      <span class="chevron-arrow"><i class="fe fe-chevron-down" style="vertical-align: middle;"></i></span>
                                                   </a>
                                                </div>
                                             </div>
                                             <div class="collapse" id="notedetail<?php echo $rows->mcn_id ?>" data-bs-parent="#notelist">
                                                <div class="card-body">

                                                   <span class="hidden-xs-down" data-bs-toggle="modal" data-bs-target="#modalviewdescnote<?php echo $rows->mcn_id; ?>"><a class="btn btn-outline-info waves-effect waves-light btn-sm" href="#" data-bs-toggle="tooltip" data-placement="top" title="View Description"> 
                                                   <i class="mdi mdi-note-search-outline fs-4" aria-hidden="true"></i> Description </a></span>


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


                                                   <!--      <a href="#" class="btn btn-secondary btn-sm">View Attachment</a> -->
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

                     </div>

                     <div class="tab-pane <?php if ($content_type == "Video") { echo "active"; }?>" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">
                           <!-- List group -->
                           <?php
                           $querymcv = $conn->query("SELECT * FROM mc_video
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
                                                   <span class="align-middle" data-bs-toggle="tooltip" title="View Video"><?php echo $rows->mcv_title ?></span>
                                                </a>
                                             </h5>
                                             <div>

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
                                                      <span class="text-white">Play Video  &nbsp;<i class="fas fa-arrow-right">&nbsp;</i> <?php echo $rows->mcv_title; ?></span>

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

                     </div>

                     <div class="tab-pane <?php if ($content_type == "Slide") {
                                             echo "active";
                                          } ?>" id="slide" role="tabpanel" aria-labelledby="slide-tab">
                        <div class="bg-light-info rounded p-2 mb-3 shadow">

                           <!-- List group -->
                           <?php
                           $querymcs = $conn->query("SELECT * FROM mc_slide
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