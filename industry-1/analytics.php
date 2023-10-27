<!DOCTYPE html>
<html lang="en">


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
                    <h1 class="mb-0 h2 fw-bold">Analytics</h1>
                <!-- Breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Analytics</a>
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
                    <div class="card-body pt-2">
                        <table id="dataTableBasic" class="table" style="width:100%">
                            <thead class="table-light ">
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                <tr>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                                <tr>
                                    <td>Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr>
                                <tr>
                                    <td>Brielle Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>2012/12/02</td>
                                    <td>$372,000</td>
                                </tr>

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