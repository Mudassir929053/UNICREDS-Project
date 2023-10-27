<?php
include('function/student-function.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
$suID = $_SESSION['sess_studentid'];

?>

<body>
    <!-- Navbar -->
    <?php
    include('pages-topbar.php');

    ?>
    <!-- Page header -->
    <div class="bg-info py-4 py-lg-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="mb-0 text-white display-5">Document Manager</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media only screen and (max-width: 600px) {
            table#dataTableBasic {
                width: 100%;
            }

            table#dataTableBasic th,
            table#dataTableBasic td {
                display: inline-block;
            }

            table#dataTableBasic thead {
                display: none;
            }

            table#dataTableBasic tr {
                border: 1px solid #ddd;
            }

            table#dataTableBasic td {
                text-align: right;
                padding-right: 10px;
            }

            table#dataTableBasic td:last-child {
                text-align: left;
            }
        }
    </style>


    <!-- Content -->
    <div class="py-6">

        <div class="container">
            <div class="row">


                <div class="container">
                    <div class="row">
                        <div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewFile">Add New File</button>
                        </div>
                        <!-- price Items - Products -->
                        <div class="col-md-12 mt-3">
                            <div class="">
                                <div class="row">
                                    <!-- basic table -->
                                    <div class="col-md-12 col-12 mb-5">
                                        <div class="card shadow">
                                            <!-- card header  -->

                                            <!-- table  -->
                                            <div class="card-body">
                                                <table id="dataTableBasic" class="table table-sm table-bordered table-hover display no-wrap shadow " style="width:100%">
                                                    <thead class="bg-primary text-white">
                                                        <tr class="text-center">
                                                            <th>S. No.</th>
                                                            <th>File Name</th>
                                                            <th>Date/Time Upload</th>
                                                            <th>Attachment</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        <?php
                                                        $x = 1;

                                                        function my_function()
                                                        {
                                                            global $x;
                                                            return $x++;
                                                        }

                                                        ?>

                                                        <?php
                                                        $querycq = $conn->query("SELECT * FROM student_university WHERE su_id =$suID ; ");
                                                        $num = 1;
                                                        if (mysqli_num_rows($querycq) > 0) {
                                                            while ($rows = mysqli_fetch_object($querycq)) {
                                                        ?>
                                                                <?php
                                                                if ($rows->su_cv != NULL) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo my_function(); ?></td>
                                                                        <td>Curriculam Vitae (CV)</td>
                                                                        <td><?php echo $rows->su_created_date; ?></td>
                                                                        <td class="text-center ">


                                                                            <span style="vertical-align: middle;">
                                                                                <?php
                                                                                if ($rows->su_cv != NULL) {
                                                                                ?>
                                                                                    <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/student/<?php echo $rows->su_id; ?>/cv/<?php echo $rows->su_cv; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <td class="text-center ">
                                                                            <button type="button" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editfileupload<?php echo $rows->su_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i>Update</button></a>

                                                                            <a class="btn btn-sm btn-danger" href="function/student-function.php?dm_cv_delete_file=<?php echo $rows->su_cv; ?>" title="Delete Vacancy" onclick="return deletefile()">
                                                                                <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete</a>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- Start Modal Page Edit -->
                                                                    <div class="modal fade" id="editfileupload<?php echo $rows->su_id; ?>" role="dialog" aria-labelledby="editfileupload" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-primary text-white">
                                                                                    <h5 class="modal-title text-white" id="fileuploadmodal">Upload File</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                                                </div>
                                                                                <div class="modal-body p-5">
                                                                                    <form action="" method="POST" enctype="multipart/form-data" id="fileupload" autocomplete="off">
                                                                                        <div class="text-center mb-3">
                                                                                            <img src="../assets/images/file_upload/file-upload.png" class="img-fluid" alt="Upload Image">
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="st_user_id" value="<?php echo $suID; ?>">
                                                                                            <input type="hidden" name="su_id" value="<?php echo $rows->su_id; ?>">
                                                                                            <div class="mb-3 col-md-6">
                                                                                                <label class="form-label" for="fileInput">File Attachment:</label>
                                                                                                <input type="file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" id="dm_attachment" name="new_cv_attachment" class="form-control" required>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary btn-sm" name="dm_cv_edit_file_upload">Update</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- End Modal Page Edit-->
                                                                <?php
                                                                }
                                                                ?>
                                                        <?php }
                                                        }
                                                        ?>
                                                        <?php
                                                        $querycq = $conn->query("SELECT * FROM document_manager WHERE dm_created_by=$suID ; ");
                                                        $num = 2;
                                                        if (mysqli_num_rows($querycq) > 0) {
                                                            while ($rows = mysqli_fetch_object($querycq)) {
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo my_function(); ?></td>
                                                                    <td><?php echo $rows->dm_file_name; ?></td>
                                                                    <td><?php echo $rows->dm_created_date; ?></td>
                                                                    <td class="text-center ">


                                                                        <span style="vertical-align: middle;">
                                                                            <?php
                                                                            if ($rows->dm_file_upload != NULL) {
                                                                            ?>
                                                                                <a class="btn waves-effect waves-light btn-sm" href="../assets/attachment/document_manager/<?php echo $rows->dm_file_upload; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View Attachment"> <span class="hidden-xs-down"><i class="text-primary mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> Attachment </span></a>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <a class="btn  waves-effect waves-light btn-sm"> <i class="bi bi-file-earmark-excel"></i> No Attachment</a>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-center ">
                                                                        <button type="button" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editfileupload<?php echo $rows->dm_id; ?>"><i class="fa fa-edit" aria-hidden="true"></i>Update</button></a>

                                                                        <a class="btn btn-sm btn-danger" href="function/student-function.php?dm_delete_file=<?php echo $rows->dm_id; ?>" title="Delete Vacancy" onclick="return deletefile()">
                                                                            <i class="fa fa-trash me-1" aria-hidden="true"></i>Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <!-- Start Modal Page Edit -->
                                                                <div class="modal fade" id="editfileupload<?php echo $rows->dm_id; ?>" role="dialog" aria-labelledby="editfileupload" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-primary text-white">
                                                                                <h5 class="modal-title text-white" id="fileuploadmodal">Upload File</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                                                            </div>
                                                                            <div class="modal-body p-5">
                                                                                <form action="" method="POST" enctype="multipart/form-data" id="fileupload" autocomplete="off">
                                                                                    <div class="text-center mb-3">
                                                                                        <img src="../assets/images/file_upload/file-upload.png" class="img-fluid" alt="Upload Image">
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <input type="hidden" name="st_user_id" value="<?php echo $suID; ?>">
                                                                                        <input type="hidden" name="dm_id" value="<?php echo $rows->dm_id; ?>">

                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">File Name:</label>
                                                                                            <input type="text" id="file_name" name="new_file_name" class="form-control" autocomplete="nope" value="<?php echo $rows->dm_file_name; ?>" required>
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label" for="fileInput">File Attachment:</label>
                                                                                            <input type="file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" id="dm_attachment" name="new_dm_attachment" class="form-control" required>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary btn-sm" name="dm_edit_file_upload">Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                                <!-- End Modal Page Edit-->
                                                        <?php }
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
                        <!-- Start Modal Page -->
                        <div class="modal fade" id="addNewFile" role="dialog" aria-labelledby="fileuploadmodal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title text-white" id="fileuploadmodal">Upload File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clearForm()"></button>
                                    </div>
                                    <div class="modal-body p-5">
                                        <form action="" method="POST" enctype="multipart/form-data" id="fileupload" autocomplete="off">
                                            <div class="text-center mb-3">
                                                <img src="../assets/images/file_upload/file-upload.png" class="img-fluid" alt="Upload Image">
                                            </div>
                                            <div class="row">
                                                <input type="hidden" name="st_user_id" value="<?php echo $suID; ?>">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">File Name:</label>
                                                    <input type="text" id="file_name" name="file_name" class="form-control" autocomplete="nope" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="fileInput">File Attachment:</label>
                                                    <input type="file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" id="pa_attachment" name="pa_attachment" class="form-control" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm" name="add_document_manager_file">Upload</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- End Modal Page -->

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    require_once("pages-footer.php");
    ?>
    <!-- Script -->
    <script>
        function deletefile() {
            var x = confirm("Are you sure want to delete this File?");
            if (x == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script src="C:\xampp\htdocs\employability-platform\student\js\ep.js"></script>


    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Job Search JS -->
    <script src="js/search-job.js"></script>

    </script>


</body>

</html>