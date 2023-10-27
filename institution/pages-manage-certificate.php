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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcertificate_type">Add New Certificate Type</button> <!-- addAdmin -->

                            </div>
                        </div>
                    </div>
                    <!-- Start Modal Page -->
                    <div id="addcertificate_type" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true"> <!-- addAdmin -->
                        <form method="POST" enctype="multipart/form-data" id="mySchool">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="vcenter">New Certificate Types</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label">Certificate Name:</label>
                                            <input class="form-control" type="text" name="certificate_name" id="school_name" required> <!-- admin_name -->
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Certificate Type:</label>
                                            <input class="form-control" type="text" name="certificate_type" id="school_name" required> <!-- admin_name -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                            <button type="submit" class="btn btn-success waves-effect" name="add_certificate_type">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Modal Page -->

                    <div class="Container">
    <div class="row">
        <!-- basic table -->
        <div class="col-md-12 col-12 mb-5">
            <div class="card">
                <!-- card header -->
                <div class="card-header border-bottom-0"></div>
                <!-- table -->
                <div class="card-body pt-2">
                    <table id="dataTableBasic" class="table table-bordered table-hover display no-wrap" style="width:100%">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Certificate Name</th>
                                <th>Certificate Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch data from the database
                            $sql = "SELECT `ct_id`, `ct_type`, `ct_name` FROM `certificate_type`";
                            $result = $conn->query($sql);

                            // Check if any rows are returned
                            if ($result->num_rows > 0) {
                                $counter = 1;

                                // Loop through each row and display the data
                                while ($row = $result->fetch_assoc()) {
                                    $ctId = $row['ct_id'];
                                    $ctType = $row['ct_type'];
                                    $ctName = $row['ct_name'];
                                    // Output the row in the table
                                    echo "<tr>
                                        <td class='text-center'>$counter</td>
                                        <td>$ctName</td>
                                        <td>$ctType</td>
                                        <td>
                                            <button class='btn btn-info btn-sm' onclick=\"window.location.href = 'pages-manage-certificate-content.php?ct_id=$ctId'\">View</button>
                                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#updateModal$ctId'>Update</button>
                                            <form action='institution-function.php' method='POST' class='d-inline'>
                                                <input type='hidden' name='ct_id' value='$ctId'>
                                                <button type='submit' class='btn btn-danger btn-sm' name='delete_certificate' onclick='return confirm(\"Are you sure you want to delete this certificate?\")'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";

                                    // Update Modal
                                    echo "<div class='modal fade' id='updateModal$ctId' tabindex='-1' role='dialog' aria-labelledby='updateModalLabel$ctId' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='updateModalLabel$ctId'>Update Certificate</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='institution-function.php' method='POST'>
                                                        <input type='hidden' name='ct_id' value='$ctId'>
                                                        <div class='form-group'>
                                                            <label for='certificate_name'>Certificate Name:</label>
                                                            <input type='text' class='form-control' id='certificate_name' name='certificate_name' value='$ctName' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='certificate_type'>Certificate type:</label>
                                                            <input type='text' class='form-control' id='certificate_type' name='certificate_type' value='$ctType' required>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                            <button type='submit' class='btn btn-primary' name='update_certificate'>Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                                    $counter++;
                                }
                            } else {
                                echo "<tr>
                                    <td colspan='4'>No data found.</td>
                                </tr>";
                            }
                            ?>
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