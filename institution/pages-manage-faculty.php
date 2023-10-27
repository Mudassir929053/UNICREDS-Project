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
        $_SESSION['pages'] = 'faculty';
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
                                <h1 class="mb-1 h2 fw-bold">Manage Faculty</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Faculty</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <!--../institution/pages-manage-faculty.php-->
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addFaculty">Add New Faculty</button>

                            </div>
                        </div>
                    </div>
                    <!-- Start Modal Page -->
                    <div id="addFaculty" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="vcenter">New Faculty</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </div>

                                <div class="modal-body">
                                    <form action="institution-function.php" method="POST">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Faculty Name :</label>
                                                <input class="form-control" type="text" name="faculty_name" id="faculty_name" required>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                            <div class="mb-3">
                                                <label class="form-label">Faculty Email :</label>
                                                <input class="form-control" type="email" name="faculty_email" id="faculty_email" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:inline-block; width:50%; padding-left: 5%; float:right;">
                                            <div class="mb-3">
                                                <label class="form-label">Faculty Contact Number :</label>
                                                <input class="form-control" type="text" name="faculty_contact_no" id="faculty_contact_no" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label class="form-label">Faculty Address :</label>
                                                <textarea class="form-control" type="text" name="faculty_address" id="faculty_address" rows="2" cols="20"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label class="form-label">Institution :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="faculty_institution" required>
                                                    <option value="" selected disabled>Select Institution</option>
                                                    <?php $queryInstitution = $conn->query("SELECT * FROM institution
                                            INNER JOIN university ON institution.institution_university_id = university.university_id");
                                                    if (mysqli_num_rows($queryInstitution) > 0) {
                                                        while ($row = mysqli_fetch_object($queryInstitution)) {
                                                    ?>
                                                            <option value="<?php echo $row->institution_id; ?>"><?php echo $row->university_name; ?></option>
                                                        <?php }
                                                    } else {
                                                        ?>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                    <button type="submit" class="btn btn-sm btn-success waves-effect" name="add_faculty">Submit</button>
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
                                        <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap" style="width:100%">
                                            <thead class="bg-primary text-white">
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Address</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                <?php
                                                //  $queryFaculty = $conn -> query("SELECT * FROM faculty 
                                                //     JOIN user ON faculty_user_id = user.user_id
                                                //     JOIN institution ON faculty_institution_id = institution.institution_id
                                                //     WHERE faculty_deleted_date IS NULL");
                                                $queryFaculty = $conn->query("SELECT * FROM faculty 
                                   
                                    WHERE faculty_deleted_date IS NULL");

                                                $num = 1;
                                                if (mysqli_num_rows($queryFaculty) > 0) {
                                                    while ($rows = mysqli_fetch_object($queryFaculty)) {
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $num++; ?></td>
                                                            <td class="text-center"><?php echo $rows->faculty_name; ?></td>
                                                            <td class="text-center"><?php echo $rows->faculty_email; ?></td>
                                                            <td class="text-center"><?php echo $rows->faculty_contact_no; ?></td>
                                                            <td class="text-center"><?php echo $rows->faculty_address; ?></td>

                                                            <td class="text-muted px-4 py-3 align-middle border-top-0">
                                                                <span class="dropdown dropstart">
                                                                    <a class="text-muted text-decoration-none" href="#" role="button" id="facultyDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                        <i class="fe fe-more-vertical"></i>
                                                                    </a>
                                                                    <span class="dropdown-menu" aria-labelledby="facultyDropdown"><span class="dropdown-header">Settings</span>
                                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editfaculty<?php echo $rows->faculty_id; ?>" title="Edit faculty"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                                        <a class="dropdown-item" href="institution-function.php?delete_faculty=<?php echo $rows->faculty_id; ?>&faculty_user_id=<?php echo $rows->faculty_user_id; ?>" title="Delete faculty" onclick="return deleteFaculty()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                                                    </span>
                                                                </span>
                                                            </td>

                                                        </tr>
                                                        <div class="modal fade" id="editfaculty<?php echo $rows->faculty_id; ?>" tabindex="-1" role="dialog" aria-labelledby="faculty_modal" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="faculty_modal">Edit Faculty</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="institution-function.php" method="POST" enctype="multipart/form-data">
                                                                            <input type="hidden" name="faculty_id" value="<?php echo $rows->faculty_id; ?>">
                                                                            <input type="hidden" name="faculty_user_id" value="<?php echo $rows->faculty_user_id; ?>">


                                                                            <div class="mb-3">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Faculty Name :</label>
                                                                                    <input class="form-control" type="text" name="new_faculty_name" id="new_faculty_name" value="<?php echo $rows->faculty_name; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Faculty Email :</label>
                                                                                    <input class="form-control" type="email" name="new_faculty_email" id="new_faculty_email" value="<?php echo $rows->faculty_email; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group" style="display:inline-block; width:50%; padding-left: 5%; float: right;">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Faculty Contact Number :</label>
                                                                                    <input class="form-control" type="text" name="new_faculty_contact_no" id="new_faculty_contact_no" value="<?php echo $rows->faculty_contact_no; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Faculty Address :</label>
                                                                                    <textarea class="form-control" type="text" name="new_faculty_address" id="editor3<?php echo $rows->faculty_id; ?>"><?php echo $rows->faculty_address; ?></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div >
                                                                                    <label class="form-label">Institution :</label>
                                                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="new_faculty_institution">
                                                                                        <option value="" selected disabled hidden>Select Institution</option>
                                                                                        <?php $queryInstitution = $conn->query("SELECT * FROM institution
                                                JOIN university ON institution.institution_university_id = university.university_id");
                                                                                        if (mysqli_num_rows($queryInstitution) > 0) {
                                                                                            while ($row = mysqli_fetch_object($queryInstitution)) {
                                                                                        ?>
                                                                                                <option value="<?php echo $row->institution_id; ?>" <?php if ($rows->faculty_institution_id == $row->institution_id) {
                                                                                                                                                            echo "selected";
                                                                                                                                                        } else {
                                                                                                                                                        } ?>><?php echo $row->university_name; ?></option>

                                                                                            <?php }
                                                                                        } else {
                                                                                            ?>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div style="clear:both;">&nbsp;</div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-sm btn-success waves-effect" name="edit_faculty">Submit</button>
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
                    function deleteFaculty() {
                        var x = confirm("Are sure want to delete this faculty?");
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