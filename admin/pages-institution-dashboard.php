<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include ('../database/dbcon.php');
include ('admin-function.php');
?> 



<body>
  <!-- Wrapper -->
  <div id="db-wrapper">
   <!-- navbar vertical -->
   <?php
   unset($_SESSION['pages']);
   $_SESSION['pages'] = 'institution';
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
                     <h1 class="mb-1 h2 fw-bold">Institution</h1>
                     <!-- Breadcrumb -->
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item">
                              <a href="#">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item">
                              <a href="#">Institution</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">
                              All
                           </li>
                        </ol>
                     </nav>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addInstitution">Add Institution</button>
                  </div>
               </div>
            </div>
            <!-- Start Modal Page -->
            <div class="modal fade" id="addInstitution" tabindex="-1" role="dialog" aria-labelledby="institutionmodal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg" >
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="institutionmodal">Register Institution</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                     </div>
                     <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="institutionForm">
                          <div class="mb-3">
                           <label class="form-label">University :</label>
                           <select class="selectpicker" data-width="100%" name="institution_university_id" id="institution" data-live-search="true" required>
                              <option value="" selected disabled>Select University..</option>
                              <?php  $queryCheckUni = $conn -> query ("SELECT * from university");
                              if (mysqli_num_rows($queryCheckUni) > 0) {
                                 while ($row = mysqli_fetch_object($queryCheckUni)){
                                  ?>
                                  <option value="<?php echo $row -> university_id; ?>"><?php echo $row -> university_name; ?></option>
                               <?php } 
                            }
                            else {
                               ?>
                               <?php
                            }?>
                         </select>
                      </div>
                          <!--  <div class="mb-3">
                              <label class="form-label" for="textInput">University Website :</label>
                              <input type="text" id="uni_website" name="uni_website"  value="" class="form-control" required>
                           </div> -->
                           <div class="mb-3 col-12 col-md-12">
                              <label class="form-label" for="address">University Address</label>
                              <!-- <textarea class="form-control" type="text" name="institution_address" id="address" rows="3" cols="20" ></textarea>  -->
                               <textarea class="form-control" name="institution_address" id="address" rows="3" cols="20"></textarea>
                           </div>

                           <div class="mb-3">
                              <label class="form-label" for="emailInput">University Email :</label>
                              <input type="email" id="institution_email" name="institution_email" class="form-control"
                              placeholder="name@example.com" required>
                           </div>
                           <div class="mb-3">
                              <label class="form-label" for="textInput">University Contact No :</label>
                              <input type="text" id="uni_contact_no" name="institution_contact_no"  class="form-control" required>
                           </div>
                           
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success btn-sm" name="add_institution">Submit</button>
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
                        
                        <table id="dataTableBasic" class="table  table-sm table-hover display no-wrap shadow" style="width:100%">
                           <thead class="bg-primary text-white">
                              <tr class="text-center">
                                 <th width="10px">No.</th>
                                 <th >University Name</th>
                                 <th>Email</th>
                                 <th width="120px">Contact No.</th>
                                 <th>Address</th>
                                 <th>Status</th>
                                    
                                 <th >&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody class="align-middle">
                            <?php 
                            $queryInstitution = $conn -> query("SELECT * FROM institution
                             LEFT JOIN user ON institution_user_id = user.user_id
                             LEFT JOIN university ON institution_university_id = university.university_id
                             WHERE institution_deleted_date IS NULL;");

                            $num = 1;
                            if (mysqli_num_rows($queryInstitution) > 0) {
                               while ($rows = mysqli_fetch_object($queryInstitution)){
                                ?>
                                <tr>
                                 <td class="text-center"><?php echo $num++;?></td>
                                 <td><?php echo $rows -> university_name; ?></td>
                                 <td><?php echo $rows -> institution_email; ?></td>
                                 <td class="text-center"><?php echo $rows -> institution_contact_no; ?></td>
                                 <td><?php echo $rows -> institution_address; ?></td>

                                 <td class="text-center">
                                    <span style="vertical-align: middle;" 
                                    class="<?php if ($rows -> institution_status == 'Active') { echo "badge bg-success"; } 
                                    else {echo "badge bg-danger";}?>"><?php echo $rows -> institution_status;?>
                                    </span>
                                 </td>
                                 
<!-- 
                                 <td class="text-center ">
                                    <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editInstitution<?php echo $rows -> institution_id;?><?php echo $rows -> institution_user_id;?>"><span class="hidden-sm-up"><i class="fa fa-edit" aria-hidden="true"></i></span> <span class="hidden-xs-down">Edit</button></span></a>
                                    <a class="btn btn-sm btn-danger" href="admin-function.php?delete_institution=<?php echo $rows -> institution_id;?>&institution_user_id=<?php echo $rows -> institution_user_id;?>" title="Delete Institution" onclick="return deleteinstitution()"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span> <span class="hidden-xs-down"></i> Delete</span></a>
                                 </td> -->

                                 <td class="text-muted px-4 py-3 align-middle border-top-0">
                                  <span class="dropdown dropstart">
                                     <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown"
                                     data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                     <i class="fe fe-more-vertical"></i></a>
                                     <span class="dropdown-menu" aria-labelledby="courseDropdown"><span
                                       class="dropdown-header">Settings</span>
                                       <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editInstitution<?php echo $rows ->institution_id;?>"><i class="fe fe-edit dropdown-item-icon" ></i>Edit</a>
                                        <a class="dropdown-item" href="admin-function.php?delete_institution=<?php echo $rows -> institution_id;?>&institution_user_id=<?php echo $rows -> institution_user_id;?>" title="Delete Institution" onclick="return deleteinstitution()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                        </span>
                                     </span>
                                  </td>
                              </tr>

                              <div class="modal fade" id="editInstitution<?php echo $rows -> institution_id;?>" tabindex="-1" role="dialog" aria-labelledby="institutionmodal" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-lg" >
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="institutionmodal">Edit Institution</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="" method="POST" enctype="multipart/form-data" >
                                             <input type="hidden" name="institution_id" value="<?php echo $rows -> institution_id;?>">
                                             <input type="hidden" name="institution_user_id" value="<?php echo $rows -> institution_user_id;?>">
                                           
                                           <div class="form-group">
                                            <div class="mb-3">
                                             <label class="form-label">University :</label>
                                           <!--   <select class="selectpicker" data-width="100%" name="new_institution_university_id" data-live-search="true"> -->
                                            <!--  <select data-width="100%" name="new_institution_university_id"> -->
                                             <select class="selectpicker" data-live-search ="true" data-width="100%"  name="new_institution_university_id" id="new_inst_uni_id<?php echo $rows -> institution_id;?>">
                                                <option value="" selected disabled>Select University..</option>
                                                <?php  
                                                   $queryCheckUni = $conn -> query ("SELECT * from university");

                                                   if (mysqli_num_rows($queryCheckUni) > 0) {
                                                      while ($rowuni = mysqli_fetch_object($queryCheckUni)){
                                                    ?>
                                                    <option value="<?php echo $rowuni -> university_id; ?>" <?php if($rows -> institution_university_id == $rowuni -> university_id){ echo "selected"; } else {}?>><?php echo $rowuni -> university_name; ?></option>            

                                                 <?php } 
                                                    }
                                                    else {
                                                       ?>
                                                 <?php
                                              }?>
                                           </select>
                                        </div>
                                     </div>

                                        <div class="mb-3 col-12 col-md-12">
                                          <label class="form-label" for="address">University Address</label>
                                        <!--   <textarea class="form-control" type="text" name="new_institution_address" id="address" rows="3" cols="20" ></textarea> -->
                                          <textarea class="form-control" name="new_institution_address" id="address<?php echo $rows -> institution_id;?>"><?php echo $rows -> institution_address;?></textarea> 
                                       </div>

                                       <div class="mb-3">
                                          <label class="form-label" for="emailInput">University Email :</label>
                                          <input type="email" name="new_institution_email" class="form-control" value="<?php echo $rows -> institution_email;?>">
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label" for="textInput">University Contact No :</label>
                                          <input class="form-control" type="text" id="new_uni_contact_no" name="new_institution_contact_no" value="<?php echo $rows -> institution_contact_no; ?>">
                                       </div>

                                       <div class="form-group">
                                       <div class="mb-3">
                                          <label class="form-label">Status :</label>
                                        <!--   <select class="selectpicker" data-width="100%" name="new_institution_status"> -->
                                          <select class="selectpicker" data-live-search ="true" data-width="100%" name="new_institution_status" id="new_status">
                                             <option value="Active" <?php if($rows -> institution_status == "Active"){ echo "selected"; }else {} ?>>Active</option> 
                                             <option value="Inactive" <?php if($rows -> institution_status == "Inactive"){ echo "selected"; }else {} ?>>Inactive</option> 

                                          </select>
                                       </div>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-success btn-sm" name="edit_institution">Submit</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                      <?php } 
                                       }
                                       else {
                                         ?>
                                         <?php
                                      }?>
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

<script >


 function deleteinstitution(){
  var x = confirm("Are you sure want to delete this institution?");

  if (x == true) {
   return true;
}
else {
   return false;
}
}
</script>

<script type="text/javascript">
   
     function clearForm() {
         document.getElementById("institutionForm").reset();
         // document.getElementById("editinstitution").reset();
         // $('#institution').selectpicker("refresh"); 
        
      
      }


</script>

<!-- clipboard -->



<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>
</body>

</html>