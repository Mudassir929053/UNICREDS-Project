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
                    <h1 class="mb-0 h2 fw-bold">Change Password</h1>
                               <!-- Breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Change Password</a>
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

<div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 border-right">
                <div class="form-group">
                    <label class="control-label">Current password</label>
                    <input type="text">
                    </div>
                    <br></br>
                <div class="form-group">
                    <label class="control-label">New password</label>
                    <input type="text">
                    </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</div>
<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>
<!-- Style -->
<style>
    label{
        cursor: pointer;
        display: inline-block;
        padding: 3px 6px;
        text-align: left;
        width: 150px;
        vertical-align: top;
    }
</style>
</body>

</html>