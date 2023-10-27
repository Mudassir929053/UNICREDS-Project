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
      $_SESSION['pages'] = 'indfield';
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
                     <h1 class="mb-1 h2 fw-bold">Industry Field</h1>
                     <!-- Breadcrumb -->
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item">
                              <a href="#">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item">
                              <a href="#">Industry Field</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">
                              All
                           </li>
                        </ol>
                     </nav>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addindustryfield">Add New Field</button>
                  </div>
               </div>
            </div>
            <!-- Start Modal Page -->
            <div class="modal fade" id="addindustryfield" tabindex="-1" role="dialog" aria-labelledby="ifmodal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg" >
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="ifmodal">Register Industry Field</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                     </div>
                     <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="unireg" autocomplete="off">
                           <div class="mb-3">
                              <label class="form-label" for="textInput">Field Name :</label>
                              <input class="form-control"  type="text" style="text-transform: capitalize;"  name="field_name"  required>
                           </div>
                          
                          
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success btn-sm" name="add_industry_field">Submit</button>
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
                  <div class="card">
                     <!-- card header  -->
                     <div class="card-header border-bottom-0">
                     </div>
                     <!-- table  -->
                     <div class="card-body pt-2">
                        <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                           <thead class="bg-primary text-white">
                              <tr class="text-center">
                                 <th width="10px">No.</th>
                                 <th>Field Name</th>
                               
                                 <th width="160px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody class="align-middle">
                              <?php 
                                 $queryEdufield = $conn -> query("SELECT * FROM industry_field;");
                                 
                                 $num = 1;
                                 if (mysqli_num_rows($queryEdufield) > 0) {
                                     while ($rows = mysqli_fetch_object($queryEdufield)){
                                         ?>
                              <tr>
                                 <td class="text-center"><?php echo $num++;?></td>
                                 <td><?php echo $rows -> industry_field_name; ?></td>
                               
                                 <td class="text-center ">
                                    <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editIndField<?php echo $rows -> industry_field_id;?>"><i class="fa fa-edit" aria-hidden="true"></i>Edit</button></a>
                                    <a class="btn btn-sm btn-danger" href="admin-function.php?delete_industry_field=<?php echo $rows -> industry_field_id;?>" title="Delete Industry Field" onclick="return deleteindField()">
                                       <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                 </td>
                              </tr>
                              <div class="modal fade" id="editIndField<?php echo $rows -> industry_field_id;?>" tabindex="-1" role="dialog" aria-labelledby="indfield" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-lg" >
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="indfield">Edit Industry Field</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="" method="POST" enctype="multipart/form-data" >
                                             <input type="hidden" name="industry_field_id" value="<?php echo $rows -> industry_field_id ;?>">
                                             
                                             <div class="mb-3">
                                                <label class="form-label" for="textInput">Name :</label>
                                                <input type="text" name="new_indusfield_name" class="form-control" value="<?php echo $rows -> industry_field_name;?>">
                                             </div>
                                            
                                       </div>
                                       <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-success btn-sm" name="edit_industry_field">Submit</button>
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
    function deleteindField(){
        var x = confirm("Are you sure want to delete this industry field?");

        if (x == true) {
            return true;
        }
        else {
            return false;
        }
    }


    function clearForm() {
         document.getElementById("unireg").reset();
         $('#admindept').selectpicker("refresh"); 
       
      }

 </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
</body>

</html>