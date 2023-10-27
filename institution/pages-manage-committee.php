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
        $_SESSION['pages'] = 'committee';
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
                                <h1 class="mb-1 h2 fw-bold">Manage Committee</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Committee</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCommittee">Add New Committee</button>

                            </div>
                        </div>
                    </div>
                    <!-- Start Modal Page -->
                    <div id="addCommittee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="vcenter">New Committee</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </div>
                                <form action="institution-function.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="committee_institution_id" value="<?php echo $institution_id; ?>">

                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Committee Name :</label>
                                                <input class="form-control" type="text" name="committee_name" id="committee_name" required>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                            <div class="mb-3">
                                                <label class="form-label">Committee Email :</label>
                                                <input class="form-control" type="email" name="committee_email" id="committee_email" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:inline-block; width:50%; padding-left: 5%; float: right;">
                                            <div class="mb-3">
                                                <label class="form-label">Committee Contact Number :</label>
                                                <input class="form-control" type="text" name="committee_contact_no" id="committee_contact_no" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label class="form-label">Committee Address :</label>
                                                <textarea class="form-control" type="text" name="committee_address" id="committee_address" rows="2" cols="20"></textarea>
                                            </div>
                                        </div>

                                        

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                        <button type="submit" class="btn btn-sm btn-success waves-effect" name="add_committee">Submit</button>
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
                                        <table id="dataTableBasic" class="table table-sm table-hover display no-wrap shadow" style="width:100%">
                                            <thead class="bg-primary text-white">
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                <?php

                                                $queryCommittee = $conn->query("SELECT * FROM committee WHERE committee_institution_id = '$institution_id' AND committee_deleted_date IS NULL");

                                                $num = 1;
                                                if (mysqli_num_rows($queryCommittee) > 0) {
                                                    while ($rows = mysqli_fetch_object($queryCommittee)) {
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $num++; ?></td>
                                                            <td class="text-center"><?php echo $rows->committee_name; ?></td>
                                                            <td class="text-center"><?php echo $rows->committee_email; ?></td>
                                                            <td class="text-center"><?php echo $rows->committee_contact_no; ?></td>
                                                            <td class="text-center"><?php echo $rows->committee_address; ?></td>
                                                            <td class="text-center">
                                                                <span style="vertical-align: middle;" class="<?php if ($rows->committee_status == 'Active') {
                                                                                                                    echo "badge bg-success";
                                                                                                                } else {
                                                                                                                    echo "badge bg-danger";
                                                                                                                } ?>"><?php echo $rows->committee_status; ?>
                                                                </span>
                                                            </td>

                                                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                                                                <span class="dropdown dropstart">
                                                                    <a class="text-muted text-decoration-none" href="#" role="button" id="committeeDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                        <i class="fe fe-more-vertical"></i>
                                                                    </a>
                                                                    <span class="dropdown-menu" aria-labelledby="committeeDropdown"><span class="dropdown-header">Settings</span>
                                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editcommittee<?php echo $rows->committee_id; ?>" title="Edit committee"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                                        <a class="dropdown-item" href="institution-function.php?delete_committee=<?php echo $rows->committee_id; ?>&committee_user_id=<?php echo $rows->committee_user_id; ?>" title="Delete committee" onclick="return deleteCommittee()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                                                    </span>
                                                                </span>
                                                            </td>

                                                        </tr>
                                                        <div class="modal fade" id="editcommittee<?php echo $rows->committee_id; ?>" tabindex="-1" role="dialog" aria-labelledby="committee_modal" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="committee_modal">Edit committee</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="institution-function.php" method="POST" enctype="multipart/form-data">
                                                                            <input type="hidden" name="committee_id" value="<?php echo $rows->committee_id; ?>">
                                                                            <input type="hidden" name="committee_user_id" value="<?php echo $rows->committee_user_id; ?>">


                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Committee Name :</label>
                                                                                    <input class="form-control" type="text" name="new_committee_name" id="new_committee_name" value="<?php echo $rows->committee_name; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Committee Email :</label>
                                                                                    <input class="form-control" type="email" name="new_committee_email" id="new_committee_email" value="<?php echo $rows->committee_email; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group" style="display:inline-block; width:50%; padding-left: 5%; float: right;">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Committee Contact Number :</label>
                                                                                    <input class="form-control" type="text" name="new_committee_contact_no" id="new_committee_contact_no" value="<?php echo $rows->committee_contact_no; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Committee Address :</label>
                                                                                    <textarea class="form-control" type="text" name="new_committee_address" id="new_committee_address"><?php echo $rows->committee_address; ?></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Status :</label>
                                                                                    <!--   <select class="selectpicker" data-width="100%" name="new_institution_status"> -->
                                                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="new_committee_status" id="new_status">
                                                                                        <option value="Active" <?php if ($rows->committee_status == "Active") {
                                                                                                                    echo "selected";
                                                                                                                } else {
                                                                                                                } ?>>Active</option>
                                                                                        <option value="Inactive" <?php if ($rows->committee_status == "Inactive") {
                                                                                                                        echo "selected";
                                                                                                                    } else {
                                                                                                                    } ?>>Inactive</option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>



                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-sm btn-success waves-effect" name="edit_committee">Submit</button>
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

                <!-- Script -->

                <script>
                    function deleteCommittee() {
                        var x = confirm("Are sure want to delete this committee?");
                        if (x == true) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    $(document).ready(function() {
                        $('.dropify').dropify();
                    });
                </script>

                <!-- Theme JS -->
                <script src="../assets/js/theme.min.js"></script>
</body>

</html>