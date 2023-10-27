<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';
include('../database/dbcon.php');
include('institution-function.php');

$institution_id = $_SESSION['sess_institutionid'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mcert';
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
                                <h1 class="mb-1 h2 fw-bold">Manage Certificate</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="../institution/dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgramme">Add New Certificate</button> <!-- addAdmin -->

                            </div>
                        </div>
                    </div>
                    <!-- Start Modal Page -->
                    <div id="addProgramme" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true"> <!-- addAdmin -->
                        <form  method="POST" enctype="multipart/form-data" id="mySchool">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="vcenter">New Academic Programme</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label">Program Name:</label>
                                            <input class="form-control" type="text" name="program_name" id="school_name" required> <!-- admin_name -->
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Programme Category:</label>
                                            <select class="form-control custom-select" name="programme_category"> <!-- admin_category -->
                                                <option value="Artificial Intelligence"> Artificial Intelligence </option> <!-- "Edess"> Edess -->
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                            <button type="submit" class="btn btn-success waves-effect" name="add_certificate">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Modal Page -->

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
                                        <table id="dataTableBasic" class="table table-bordered table-hover display no-wrap" style="width:100%">
                                            <thead class="bg-primary text-white">
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Design Certificate</th>
                                                    <th>Certificate issued to Student</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Theme JS -->
                <script src="../assets/js/theme.min.js"></script>
                </div>
                </div>
                </div>
</body>

</html>