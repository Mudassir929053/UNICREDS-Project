<!DOCTYPE html>
<html lang="en">
<?php include('../database/dbcon.php');?>

<?php
  include 'pages-head.php';
?> 

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
       <!-- navbar vertical -->

       <?php
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
            <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-0 h2 fw-bold">Overview</h1>
                 <!-- Breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Overview</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        All
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin">Add New Admin</button>

                        </div>
                    </div>
                </div>

                <!-- Start Modal Page -->
                <div id="addAdmin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                    <form action="" method="POST" enctype="multipart/form-data" id="mySchool">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="vcenter">Register Admin</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label">Admin Name:</label>
                                        <input class="form-control" type="text" name="admin_name" id="school_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Admin Category:</label>
                                        <select class="form-control custom-select" name="admin_category">
                                            <option value="Edess">Edess</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                        <button type="submit" class="btn btn-success waves-effect" name="add_admin_edess">Submit</button>
                                    </div>
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
                     <table id="dataTableBasic" class="table" style="width:100%">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    
                                    <th>Job Code</th>
                                    <th>Job Title</th>
                                    <th>Job Description</th>
                                    <th>Job Salary(MYR)</th>
                                    <th>Job Date Posted</th>
                                    <th>Job No. of Vacancies</th>
                                    <th>Job Category</th>
                                    <th>Job Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $qry = $conn->query("SELECT * FROM job WHERE job_industry_id=$i");
                                while($row= $qry->fetch_assoc()):
                                 ?>
                                <tr>
                                    <td><?php echo ucwords($row['job_code']) ?></td>
                                    <td><?php echo ucwords($row['job_title']) ?></td>
                                    <td><?php echo ucwords($row['job_description']) ?></td>
                                    <td><?php echo ucwords($row['job_salary']) ?></td>
                                    <td><?php echo date("M d, Y",strtotime($row['job_date_posted']));?></td>
                                    <td><?php echo ucwords($row['job_no_of_vacancies']) ?></b></td>
                                    <td><?php $from=$row['job_category_id']; $cat_name=$conn->query("SELECT jc_name FROM job_category WHERE jc_id=$from"); while($find= $cat_name->fetch_assoc()){ echo ucwords($find['jc_name']); } ?></td>
                                    <td><?php $from=$row['job_position_id']; $pos_name=$conn->query("SELECT jp_name FROM job_position WHERE jp_id=$from"); while($find= $pos_name->fetch_assoc()){ echo ucwords($find['jp_name']); }?></td>
                                    <td><button type="button" class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editJob<?php echo $row['job_id']; ?>"><span class="hidden-sm-up"><i class="fa fa-edit" aria-hidden="true"></i></span><span class="hidden-xs-down">Edit</button></span></a>
                                    <a class="btn btn-sm btn-danger" href="industry-function.php?delete_job_ads=<?php echo $row['job_id']; ?>" title="Delete Job Ads" onclick="return deleteJobAds()"><span class="hidden-sm-up"><i class="fa fa-trash" aria-hidden="true"></i></span><span class="hidden-xs-down"></i> Delete</span></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
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





<!-- clipboard -->



<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>
</body>

</html>