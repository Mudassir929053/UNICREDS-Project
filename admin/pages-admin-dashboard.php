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
      $_SESSION['pages'] = 'admin';
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
                     <h1 class="mb-1 h2 fw-bold">Admin</h1>
                     <!-- Breadcrumb -->
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item">
                              <a href="#">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item">
                              <a href="#">Admin</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">
                              All
                           </li>
                        </ol>
                     </nav>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAdmin">Add New Admin</button>
                  </div>
               </div>
            </div>
            <!-- Start Modal Page -->
            <div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="adminmodal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg" >
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="adminmodal">Register Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                     </div>
                     <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="adminreg" autocomplete="off">
                           <div class="mb-3">
                              <label class="form-label" for="textInput">Name :</label>
                              <input class="form-control"  type="text" style="text-transform: uppercase;" id="admin_name" name="admin_name"   required>
                           </div>
                           <div class="mb-3">
                              <label class="form-label" for="emailInput">Email :</label>
                              <input type="email" id="admin_email" name="admin_email" class="form-control"
                                 placeholder="name@example.com" required>
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Department :</label>
                              <select class="selectpicker" data-width="100%" name="admin_department" data-live-search="true" id="admindept" required>
                                 <option value="" selected disabled hidden >Select department</option>
                                 
                                 <?php  $queryAdminRole = $conn -> query ("SELECT * from role where role_id <= '4'");
                                    if (mysqli_num_rows($queryAdminRole) > 0) {
                                        while ($rowrole = mysqli_fetch_object($queryAdminRole)){
                                           ?>
                                 <option value="<?php echo $rowrole -> role_id; ?>"><?php echo $rowrole -> role_name; ?></option>
                                 <?php } 
                                    }
                                    else {
                                     ?>
                                 <?php
                                    }?>
                              </select>
                           </div>
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success btn-sm" name="add_admin_unicreds">Submit</button>
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
                        <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                           <thead class="bg-primary text-white">
                              <tr class="text-center">
                                 <th width="10px">No.</th>
                                 <th>Name</th>
                                 <th>Username</th>
                                 <th width="120px">Department</th>
                                 <th width="160px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody class="align-middle">
                              <?php 
                                 $queryAdmin = $conn -> query("SELECT * FROM user
                                     LEFT JOIN admin ON user_id = admin.admin_user_id
                                     LEFT JOIN role ON user_role_id = role.role_id
                                     WHERE role.role_id <= '4' AND user_deleted_date IS NULL;");
                                 
                                 $num = 1;
                                 if (mysqli_num_rows($queryAdmin) > 0) {
                                     while ($rows = mysqli_fetch_object($queryAdmin)){
                                         ?>
                              <tr>
                                 <td class="text-center"><?php echo $num++;?></td>
                                 <td><?php echo $rows -> admin_name; ?></td>
                                 <td><?php echo $rows -> user_username; ?></td>
                                 <td class="text-center"><?php echo $rows -> role_name; ?></td>
                                 <td class="text-center ">
                                    <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editAdmin<?php echo $rows -> admin_id;?><?php echo $rows -> admin_user_id;?>"><span class="hidden-sm-up"><i class="fa fa-edit" aria-hidden="true"></i></span> <span class="hidden-xs-down">Edit</button></span></a>
                                    <a class="btn btn-sm btn-danger" href="admin-function.php?delete_admin_unicreds=<?php echo $rows -> admin_id;?>&admin_user_id=<?php echo $rows -> admin_user_id;?>" title="Delete Admin" onclick="return deleteadmin()"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span> <span class="hidden-xs-down"></i> Delete</span></a>
                                 </td>
                              </tr>
                              <div class="modal fade" id="editAdmin<?php echo $rows -> admin_id;?><?php echo $rows -> admin_user_id;?>" tabindex="-1" role="dialog" aria-labelledby="adminmodal" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-lg" >
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="adminmodal">Edit Admin</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="" method="POST" enctype="multipart/form-data" >
                                             <input type="hidden" name="admin_id" value="<?php echo $rows -> admin_id;?>">
                                             <input type="hidden" name="admin_user_id" value="<?php echo $rows -> admin_user_id;?>">
                                             <div class="mb-3">
                                                <label class="form-label" for="textInput">Name :</label>
                                                <input type="text" name="new_admin_name" class="form-control" value="<?php echo $rows -> admin_name;?>">
                                             </div>
                                             <div class="mb-3">
                                                <label class="form-label" for="emailInput">Email :</label>
                                                <input type="email" name="new_admin_email" class="form-control" value="<?php echo $rows -> admin_email;?>">
                                             </div>
                                             <div class="mb-3">
                                                <label class="form-label">Department :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="new_admin_department"  id="new_admin_department<?php echo $rows -> admin_id;?>">
                                                   <?php  $queryAdminRole = $conn -> query ("SELECT * from role where role_id <= '4'");
                                                      if (mysqli_num_rows($queryAdminRole) > 0) {
                                                        while ($rowrole = mysqli_fetch_object($queryAdminRole)){
                                                           ?>
                                                   <option value="<?php echo $rowrole -> role_id; ?>" <?php if($rows -> admin_role_id == $rowrole -> role_id){echo "selected";} else {}?>><?php echo $rowrole -> role_name; ?></option>
                                                   <?php } 
                                                      }
                                                      else {
                                                         ?>
                                                   <?php
                                                      }?>
                                                </select>
                                             </div>
                                       </div>
                                       <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-success btn-sm" name="edit_admin_unicreds">Submit</button>
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
    function deleteadmin(){
        var x = confirm("Are you sure want to delete this admin?");

        if (x == true) {
            return true;
        }
        else {
            return false;
        }
    }


    function clearForm() {
         document.getElementById("adminreg").reset();
         $('#admindept').selectpicker("refresh"); 
       
      }

 </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>