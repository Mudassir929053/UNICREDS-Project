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
      $_SESSION['pages'] = 'university';
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
                     <h1 class="mb-1 h2 fw-bold">University</h1>
                     <!-- Breadcrumb -->
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item">
                              <a href="#">Dashboard</a>
                           </li>
                           <li class="breadcrumb-item">
                              <a href="#">University</a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page">
                              All
                           </li>
                        </ol>
                     </nav>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#adduni">Add New University</button>
                  </div>
               </div>
            </div>
            <!-- Start Modal Page -->
            <div class="modal fade" id="adduni" tabindex="-1" role="dialog" aria-labelledby="unimodal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg" >
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="unimodal">Register University</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                     </div>
                     <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="unireg" autocomplete="off">
                           <div class="mb-3">
                              <label class="form-label" for="textInput">University Name :</label>
                              <input class="form-control"  type="text" style="text-transform: capitalize;" id="uni_name" name="uni_name"  required>
                           </div>
                           <div class="mb-3">
                              <label class="form-label" for="textInput">University Website :</label>
                              <input class="form-control"  type="text" id="uni_website" name="uni_website" required>
                           </div>
                          
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success btn-sm" name="add_uni">Submit</button>
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
                                 <th>University Name</th>
                                 <th>Website</th>
                                 <th width="160px">&nbsp;</th>
                              </tr>
                           </thead>
                           <tbody class="align-middle">
                              <?php 
                                 $queryUniversity = $conn -> query("SELECT * FROM university;");
                                 
                                 $num = 1;
                                 if (mysqli_num_rows($queryUniversity) > 0) {
                                     while ($rows = mysqli_fetch_object($queryUniversity)){
                                         ?>
                              <tr>
                                 <td class="text-center"><?php echo $num++;?></td>
                                 <td><?php echo $rows -> university_name; ?></td>
                                 <td><?php echo $rows -> university_website; ?></td> 
                                 <td class="text-center ">
                                    <button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editUni<?php echo $rows -> university_id ;?>"><span class="hidden-sm-up"><i class="fa fa-edit" aria-hidden="true"></i></span> <span class="hidden-xs-down">Edit</button></span></a>
                                    <a class="btn btn-sm btn-danger" href="admin-function.php?delete_uni=<?php echo $rows -> university_id ;?>" title="Delete University" onclick="return deleteuni()"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span> <span class="hidden-xs-down"></i> Delete</span></a>
                                 </td>
                              </tr>
                              <div class="modal fade" id="editUni<?php echo $rows -> university_id ;?>" tabindex="-1" role="dialog" aria-labelledby="unimodal" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-lg" >
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="unimodal">Edit University/Institution</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="" method="POST" enctype="multipart/form-data" >
                                             <input type="hidden" name="university_id" value="<?php echo $rows -> university_id ;?>">
                                           
                                             <div class="mb-3">
                                                <label class="form-label" for="textInput">Name :</label>
                                                <input type="text" name="new_uni_name" class="form-control" value="<?php echo $rows -> university_name;?>">
                                             </div>
                                             <div class="mb-3">
                                             <label class="form-label" for="textInput">Website :</label>
                                                <input type="text" name="new_uni_website" class="form-control" value="<?php echo $rows -> university_website;?>">
                                             </div>
                                           
                                       </div>
                                       <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-success btn-sm" name="edit_uni">Submit</button>
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
    function deleteuni(){
        var x = confirm("Are you sure want to delete this university?");

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