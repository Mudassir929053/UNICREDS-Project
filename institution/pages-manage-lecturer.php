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
        $_SESSION['pages'] = 'lecturer';
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
                                <h1 class="mb-1 h2 fw-bold">Manage Lecturer</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Lecturer</a>
                                            <!--../institution/pages-manage-lecturer-or-tutor.php-->
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addLecturer">Add New Lecturer</button> <!-- addAdmin -->

                            </div>
                        </div>
                    </div>
                    <!-- Start Modal Page -->
                    <div id="addLecturer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="vcenter">New Lecturer </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        

                                        <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name :</label>
                                                <input class="form-control" type="text" style="text-transform: capitalize;" name="lecturer_fname" id="lecturer_fname" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name :</label>
                                                <input class="form-control" type="text" style="text-transform: capitalize;" name="lecturer_lname" id="lecturer_lname" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        </div>

                                      
                                        <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                                <label class="form-label">Contact Number :</label>
                                                <input class="form-control" type="text" name="lecturer_contact_no" id="lecturer_contact_no" autocomplete="nope" required>
                                            </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email :</label>
                                                <input class="form-control" type="email" name="lecturer_email" id="lecturer_email" autocomplete="nope" required>
                                            </div>
                                        </div>

                                        
                                        </div>

                                        <div class="row">   
                                        <div class="mb-3 col-12 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Gender :</label>
                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="lecturer_gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"> Male </option>
                                                    <option value="Female"> Female </option>
                                                </select>
                                            </div>
                                        </div>
                                            
                                        </div>
                                       
                                        <hr>

                                        <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                            <input type="hidden" name="institution_id" value="<?php echo $institution_id; ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Title :</label>
                                                <input class="form-control" type="text" style="text-transform: capitalize;" name="lecturer_title" id="lecturer_title" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Faculty :</label>
                                                <input class="form-control" type="text" name="lecturer_faculty" id="lecturer_faculty" autocomplete="nope" required>
                                            </div>
                                        </div>


                                       
                                        </div>

                                        <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                            <label class="form-label">Department :</label>
                                            <input class="form-control" style="text-transform: capitalize;" type="text" name="lecturer_department" id="lecturer_department" autocomplete="nope" required>
                                        </div>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal" onClick="clearForm()">Close</button>
                                    <button type="submit" class="btn btn-sm btn-success waves-effect" name="add_lecturer">Submit</button>
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
                                        <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow" style="width:100%">
                                            <thead class="bg-primary text-white">
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Faculty</th>
                                                    <th>Department</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                <?php
                                                $queryLecturer = $conn->query("SELECT * FROM lecturer 
                                                                               LEFT JOIN user ON lecturer_user_id = user.user_id
                                                                               LEFT JOIN institution ON lecturer_institution_id = institution.institution_id
                                                                               WHERE lecturer_institution_id = '$institution_id' 
                                                                               AND lecturer_deleted_date IS NULL");

                                                $num = 1;
                                                if (mysqli_num_rows($queryLecturer) > 0) {
                                                    while ($rows = mysqli_fetch_object($queryLecturer)) {
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $num++; ?></td>
                                                            <td class="text-center"><?php echo $rows->lecturer_title, ' ', $rows->lecturer_fname, ' ', $rows->lecturer_lname; ?></td>
                                                            <td class="text-center"><?php echo $rows->lecturer_email; ?></td>
                                                            <td class="text-center"><?php if ($rows->lecturer_contact_no == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo $rows->lecturer_contact_no;
                                                                                    } ?></td>
                                                            <td class="text-center"><?php if ($rows->lecturer_faculty == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo $rows->lecturer_faculty;
                                                                                    } ?></td>
                                                            <td class="text-center"><?php if ($rows->lecturer_department == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo $rows->lecturer_department;
                                                                                    } ?></td>

                                                            <td class="text-center">
                                                                <span style="vertical-align: middle;"  class="<?php if ($rows->lecturer_status == 'Active') {
                                                                                    echo "badge bg-success";
                                                                                } else {
                                                                                    echo "badge bg-danger";
                                                                                } ?> "><?php echo $rows->lecturer_status; ?></span>
                                                            </td>

                                                            <td class="text-muted px-4 py-3 align-middle border-top-0 text-center">
                                                                <span class="dropdown dropstart">
                                                                    <a class="text-muted text-decoration-none" href="#" role="button" id="lecturerDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                        <i class="fe fe-more-vertical"></i>
                                                                    </a>
                                                                    <span class="dropdown-menu" aria-labelledby="lecturerDropdown"><span class="dropdown-header">Settings</span>
                                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editLecturer<?php echo $rows->lecturer_id; ?>" title="Edit Lecturer"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                                        <a class="dropdown-item" href="institution-function.php?delete_lecturer=<?php echo $rows->lecturer_id; ?>&lecturer_user_id=<?php echo $rows->lecturer_user_id; ?>" title="Delete Lecturer" onclick="return deleteLecturer()"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                                                    </span>
                                                                </span>
                                                            </td>

                                                        </tr>
                                                        <div class="modal fade" id="editLecturer<?php echo $rows->lecturer_id; ?>" tabindex="-1" role="dialog" aria-labelledby="lecturer_modal" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="lecturer_modal">Edit Lecturer</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <form action="institution-function.php" method="POST" enctype="multipart/form-data">
                                                                            <input type="hidden" name="lecturer_id" value="<?php echo $rows->lecturer_id; ?>">
                                                                            <input type="hidden" name="lecturer_user_id" value="<?php echo $rows->lecturer_user_id; ?>">

                                                                            
                                                                            
                                                                            <div class="row">
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">First Name :</label>
                                                                                    <input class="form-control" type="text" style="text-transform: capitalize;" name="new_lecturer_fname" id="new_lecturer_fname" value="<?php echo $rows->lecturer_fname; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Last Name :</label>
                                                                                    <input class="form-control" type="text" style="text-transform: capitalize;" name="new_lecturer_lname" id="new_lecturer_lname" value="<?php echo $rows->lecturer_lname; ?>">
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            
                                                                            <div class="row">

                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Email :</label>
                                                                                    <input class="form-control" type="email" name="new_lecturer_email" id="new_lecturer_email" value="<?php echo $rows->lecturer_email; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Contact Number :</label>
                                                                                    <input class="form-control" type="text" name="new_lecturer_contact_no" id="new_lecturer_contact_no" value="<?php echo $rows->lecturer_contact_no; ?>">
                                                                                </div>
                                                                            </div>

                                                                           
                                                                            </div>
                                                                            
                                                                            <div class="row">
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Gender :</label>
                                                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="new_lecturer_gender">
                                                                                        <option value="Male" <?php if ($rows->lecturer_gender == "Male") {
                                                                                                                    echo "selected";
                                                                                                                } ?>> Male </option>
                                                                                        <option value="Female" <?php if ($rows->lecturer_gender == "Female") {
                                                                                                                    echo "selected";
                                                                                                                } ?>> Female </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            </div>

                                                                            <hr>                                       

                                                                            <div class="row">       
                                                                                
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Title :</label>
                                                                                    <input class="form-control" type="text" style="text-transform: capitalize;" name="new_lecturer_title" id="new_lecturer_title" value="<?php echo $rows->lecturer_title; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Faculty :</label>
                                                                                    <input class="form-control" type="text" name="new_lecturer_faculty" id="new_lecturer_faculty" value="<?php echo $rows->lecturer_faculty; ?>">
                                                                                </div>
                                                                            </div>

                                                                            
                                                                            </div>

                                                                            <div class="row">  
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Department :</label>
                                                                                    <input class="form-control" type="text" name="new_lecturer_department" id="new_lecturer_department" value="<?php echo $rows->lecturer_department; ?>">
                                                                                </div>
                                                                            </div>                                  
                                                                            <div class="mb-3 col-12 col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Status :</label>
                                                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="new_lecturer_status">

                                                                                        <option value="Active" <?php if ($rows->lecturer_status == "Active") {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Active</option>
                                                                                        <option value="Inactive" <?php if ($rows->lecturer_status == "Inactive") {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>Inactive</option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-sm btn-success waves-effect" name="edit_lecturer">Submit</button>
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
                    function deleteLecturer() {
                        var x = confirm("Are sure want to delete this lecturer?");
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