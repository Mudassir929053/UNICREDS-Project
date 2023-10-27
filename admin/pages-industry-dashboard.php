<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');
?>



<body>
   <!-- Wrapper -->
   <div id="db-wrapper">
      <!-- navbar vertical -->
      <?php
      unset($_SESSION['pages']);
      $_SESSION['pages'] = 'industry';
      include 'pages-sidebar.php';
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
                        <h1 class="mb-1 h2 fw-bold">Industry</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="#">Dashboard</a>
                              </li>
                              <li class="breadcrumb-item">
                                 <a href="#">Industry</a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">
                                 All
                              </li>
                           </ol>
                        </nav>
                     </div>
                     <div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addIndustry">Add Industry</button>
                     </div>
                  </div>
               </div>
               <!-- Start Modal Page -->
               <div class="modal fade" id="addIndustry" tabindex="-1" role="dialog" aria-labelledby="industrymodal" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-xl">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="industrymodal">Register Industry</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                        </div>
                        <div class="modal-body">
                           <form action="" method="POST" enctype="multipart/form-data" id="companyDetails">
                              <div class="mb-3">
                                 <label class="form-label">Company Name :</label>
                                 <input type="text" id="industry_name" name="industry_name" class="form-control" autocomplete="nope" required>
                              </div>


                              <div class="row">
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Company Sector :</label>
                                    <select class="selectpicker" data-width="100%" name="industry_field_id" data-live-search="true" id="industryfield" required>
                                       <option value="" selected disabled>Select Sector..</option>
                                       <?php $queryCheckSector = $conn->query("SELECT * from industry_field");
                                       if (mysqli_num_rows($queryCheckSector) > 0) {
                                          while ($row = mysqli_fetch_object($queryCheckSector)) {
                                       ?>
                                             <option value="<?php echo $row->industry_field_id; ?>"><?php echo $row->industry_field_name; ?></option>
                                          <?php }
                                       } else {
                                          ?>
                                       <?php
                                       } ?>
                                    </select>
                                 </div>

                                 <div class="mb-3 col-md-6">
                                    <label class="form-label" for="textInput">Company SSM :</label>
                                    <div class="input-group mb-1">
                                       <input class="dropify form-control" type="file" name="ssm_attachment" id="input-file-max-fs" data-max-file-size="10M">
                                       <label class="input-group-text" for="ssm_file">Upload</label>
                                    </div>

                                 </div>
                              </div>

                              <div class="row">
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label" for="emailInput">Company Email :</label>
                                    <input type="email" id="industry_email" name="industry_email" class="form-control" placeholder="name@example.com" autocomplete="nope" required>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label" for="textInput">Company Contact No :</label>
                                    <input type="text" id="industry_contact_no" name="industry_contact_no" class="form-control" autocomplete="nope" required>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Company Website :</label>
                                    <input type="text" id="industry_website" name="industry_website" class="form-control" autocomplete="nope">
                                 </div>
                              </div>


                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success btn-sm" name="add_industry">Submit</button>
                        </div>
                     </div>
                  </div>
                  </form>
               </div>
               <!-- End Modal Page -->
            </div>
            <div class="">
               <div class="row">
                  <!-- basic table -->
                  <div class="col-md-12 col-12 mb-5">
                     <div class="card smooth-shadow-md">
                        <!-- card header  -->

                        <!-- table  -->
                        <div class="card-body">

                           <table id="dataTableBasic" class="table table-hover display no-wrap table-sm shadow" style="width:100%">
                              <thead class="bg-primary text-white">
                                 <tr class="text-center">
                                    <th width="10px">No.</th>
                                    <th>Company Name</th>
                                    <th>Company Sector</th>
                                    <th>Email</th>
                                    <th width="120px">Contact No.</th>
                                    <!-- <th>Address</th> -->
                                    <th>SSM attachment</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                 </tr>
                              </thead>
                              <tbody class="align-middle">
                                 <?php
                                 $queryIndustry = $conn->query("SELECT * FROM industry
                    LEFT JOIN user ON industry_user_id = user.user_id
                    LEFT JOIN industry_field ON industry_industry_field_id  = industry_field_id
                    WHERE industry_deleted_date IS NULL;");

                                 $num = 1;
                                 if (mysqli_num_rows($queryIndustry) > 0) {
                                    while ($rows = mysqli_fetch_object($queryIndustry)) {
                                 ?>
                                       <tr>
                                          <td class="text-center"><?php echo $num++; ?></td>
                                          <td><?php echo $rows->industry_name; ?></td>
                                          <td><?php echo $rows->industry_field_name; ?></td>
                                          <td><?php echo $rows->industry_email; ?></td>
                                          <td class="text-center"><?php echo $rows->industry_contact_no; ?></td>
                                          <!--   <td><?php echo $rows->industry_address1; ?></td> -->

                                          <td class="text-center">
                                             <?php
                                             if ($rows->industry_ssm != NULL) {
                                             ?>
                                                <a class="btn btn-info btn-sm" href="attachment/industry_attachment/<?php echo $rows->industry_ssm; ?>" target="_blank" title="View"><span class="hidden-xs-down"><i class="fa fa-search" aria-hidden="true"></i> View Attachment</span></a>
                                             <?php
                                             } else {
                                             ?>
                                                <a class="btn btn-secondary btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                             <?php
                                             }
                                             ?>

                                          </td>

                                          <td class="text-center ">
                                             <span style="vertical-align: middle;" class="<?php if ($rows->industry_status == 'Active') {
                                                                                             echo "badge bg-success";
                                                                                          } else {
                                                                                             echo "badge bg-danger";
                                                                                          } ?>"><?php echo $rows->industry_status; ?>
                                             </span>
                                          </td>

                                          <td class="text-muted px-4 py-3 align-middle border-top-0">
                                             <span class="dropdown dropstart">
                                                <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                   <i class="fe fe-more-vertical"></i></a>
                                                <span class="dropdown-menu" aria-labelledby="courseDropdown"><span class="dropdown-header">Settings</span>
                                                   <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editIndustry<?php echo $rows->industry_id; ?><?php echo $rows->industry_user_id; ?>"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                   <a class="dropdown-item" href="admin-function.php?delete_industry=<?php echo $rows->industry_id; ?>&industry_user_id=<?php echo $rows->industry_user_id; ?>" title="Delete Industry" onclick="return deleteindustry()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                                </span>
                                             </span>
                                          </td>

                                          <!-- <td class="text-center ">
                           <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editInstitution<?php echo $rows->institution_id; ?><?php echo $rows->institution_user_id; ?>"><span class="hidden-sm-up"><i class="fa fa-edit" aria-hidden="true"></i></span> <span class="hidden-xs-down">Edit</button></span></a>
                           <a class="btn btn-sm btn-danger" href="admin-function.php?delete_institution=<?php echo $rows->institution_id; ?>&institution_user_id=<?php echo $rows->institution_user_id; ?>" title="Delete Institution" onclick="return deleteinstitution()"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span> <span class="hidden-xs-down"></i> Delete</span></a>
                        </td> -->
                                       </tr>

                                       <div class="modal fade" id="editIndustry<?php echo $rows->industry_id; ?><?php echo $rows->industry_user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="industrymodal" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-xl">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="adminmodal">Edit Industry</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <form action="" method="POST" enctype="multipart/form-data">
                                                      <input type="hidden" name="industry_id" value="<?php echo $rows->industry_id; ?>">
                                                      <input type="hidden" name="industry_user_id" value="<?php echo $rows->industry_user_id; ?>">


                                                      <div class="mb-3">
                                                         <label class="form-label">Company Name :</label>
                                                         <input type="text" id="new_industry_name" name="new_industry_name" value="<?php echo $rows->industry_name; ?>" class="form-control" autocomplete="nope" required>
                                                      </div>


                                                      <div class="row">
                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label">Company Sector :</label>
                                                            <select class="selectpicker" data-width="100%" data-live-search="true" name="new_industry_field_id" required>
                                                               <option value="" selected disabled>Select Sector..</option>
                                                               <?php $queryCheckSector = $conn->query("SELECT * from industry_field");
                                                               if (mysqli_num_rows($queryCheckSector) > 0) {
                                                                  while ($rowsec = mysqli_fetch_object($queryCheckSector)) {
                                                               ?>
                                                                     <option value="<?php echo $rowsec->industry_field_id; ?>" <?php if ($rows->industry_industry_field_id == $rowsec->industry_field_id) {
                                                                                                                                    echo "selected";
                                                                                                                                 } else {
                                                                                                                                 } ?>><?php echo $rowsec->industry_field_name; ?></option>

                                                                  <?php }
                                                               } else {
                                                                  ?>
                                                               <?php
                                                               } ?>
                                                            </select>
                                                         </div>

                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="textInput">Company SSM :</label>
                                                            <div class="custom-file">
                                                               <div class="input-group mb-1">

                                                                  <input type="file" onChange="readURL(this);" class="form-control custom-file-input" name="ssm_attachment" id="ssm_attachment<?php echo $rows->industry_id; ?>">

                                                               </div>
                                                            </div>
                                                            <?php if ($rows->industry_ssm != NULL) { ?>
                                                               <p>Current File : <a href="attachment/industry_attachment/<?php echo $rows->industry_ssm; ?>" target="_blank">
                                                                     <?php echo $rows->industry_ssm; ?></a></p>
                                                            <?php } else {
                                                            } ?>

                                                         </div>
                                                      </div>

                                                      <div class="row">
                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="emailInput">Company Email :</label>
                                                            <input type="email" id="new_industry_email" name="new_industry_email" class="form-control" placeholder="name@example.com" autocomplete="nope" value="<?php echo $rows->industry_email; ?>" required>
                                                         </div>
                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="textInput">Company Contact No :</label>
                                                            <input type="text" id="new_industry_contact_no" name="new_industry_contact_no" class="form-control" autocomplete="nope" value="<?php echo $rows->industry_contact_no; ?>" required>
                                                         </div>
                                                      </div>

                                                      <div class="row">
                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label">Company Website :</label>
                                                            <input type="text" id="new_industry_website" name="new_industry_website" value="<?php echo $rows->industry_website; ?>" class="form-control" autocomplete="nope">
                                                         </div>

                                                         <div class="mb-3 col-md-6">
                                                            <label class="form-label">Status :</label>
                                                            <!--   <select class="selectpicker" data-width="100%" name="new_institution_status"> -->
                                                            <select class="selectpicker" data-live-search="true" data-width="100%" name="new_industry_status" id="new_status">
                                                               <option value="Active" <?php if ($rows->industry_status == "Active") {
                                                                                          echo "selected";
                                                                                       } else {
                                                                                       } ?>>Active</option>
                                                               <option value="Inactive" <?php if ($rows->industry_status == "Inactive") {
                                                                                             echo "selected";
                                                                                          } else {
                                                                                          } ?>>Inactive</option>

                                                            </select>
                                                         </div>
                                                      </div>

                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-success btn-sm" name="edit_industry">Submit</button>
                                                </div>
                                             </div>
                                          </div>
                                          </form>
                                       </div>
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
   <!-- Script -->
   <!-- Libs JS -->

   <script>
      function deleteindustry() {
         var x = confirm("Are you sure want to delete this industry?");

         if (x == true) {
            return true;
         } else {
            return false;
         }
      }
   </script>


   <?php
   $querySSM = $conn->query("SELECT industry_id FROM industry WHERE industry_deleted_date IS NULL;");

   if (mysqli_num_rows($querySSM)) {
      while ($rowSSM = mysqli_fetch_object($querySSM)) {
   ?>

         <script>
            var uploadField = document.getElementById("ssm_attachment<?php echo $rowSSM->industry_id; ?>");
            uploadField.onchange = function() {
               if (this.files[0].size > 10485760) {
                  alert("The file size is too big (10MB max).");
                  this.value = null;
               };
            };
         </script>
   <?php
      }
   }
   ?>
   <script type="text/javascript">
      function FetchState(id) {

         $('#state').html('');
         $('#city').html('<option>Select City</option>');
         $.ajax({
            type: 'POST',
            url: 'admin-function.php',
            data: {
               country_id: id
            },
            success: function(data) {
               $('#state').html(data).selectpicker('refresh');

            }
         })
      }

      function FetchnewState(id, industryID) {

         $('#new_state').html('');
         // $('#new_city').html('<option>Select City</option>');
         $.ajax({
            type: 'POST',
            url: 'admin-function.php',
            data: {
               new_country_id: id,
               industry_id: industryID
            },
            success: function(data) {
               $('#new_state').html(data);
            }
         })
      }


      function FetchCity(id) {

         $('#city').html('');
         $.ajax({
            type: 'POST',
            url: 'admin-function.php',
            data: {
               state_id: id
            },
            success: function(data) {
               $('#city').html(data).selectpicker('refresh');
            }
         })
      }

      function FetchCity(id, industryID) {

         $('#city').html('');
         $.ajax({
            type: 'POST',
            url: 'admin-function.php',
            data: {
               new_state_id: id,
               industry_id: industryID
            },
            success: function(data) {
               $('#city').html(data).selectpicker('refresh');
            }
         })
      }
   </script>

   <script type="text/javascript">
      $(document).ready(function() {
         $('.dropify').dropify();
      });

      function clearForm() {

         document.getElementById("companyDetails").reset();
         document.getElementById("ssm_attachment").value = "";
         $('.dropify-clear').click();

         $('#industryfield').selectpicker("refresh");
         $('#country').selectpicker("refresh");
         $('#state').selectpicker("refresh");
         $('#city').selectpicker("refresh");


      }
   </script>


   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149371669-1"></script>
   <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
         dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-149371669-1');
   </script>
   <!-- Theme JS -->
   <script src="../assets/js/theme.min.js"></script>
   <script src="../assets/js/countrystatecity.js"></script>
</body>

</html>