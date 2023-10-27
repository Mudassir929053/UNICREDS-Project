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
        $_SESSION['pages'] = 'profile';
        include 'pages-sidebar.php';
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
                                <h1 class="mb-1 h2 fw-bold">Profile</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="pages-institution-update-profile.php">Institution Profile</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">




                    <div class="col-lg-10 col-md-8 col-12 mx-auto">
                        <!-- Card -->
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">Profile Details</h3>
                                <p class="mb-0">
                                    You have full control to manage your own account setting.
                                </p>
                            </div>
                            <?php
                            $queryInstitution = $conn->query("SELECT * FROM institution
                             LEFT JOIN user ON institution_user_id = user.user_id
                             LEFT JOIN university ON institution_university_id = university.university_id
                             WHERE institution_deleted_date IS NULL
                             AND institution_id = '$institution_id';");

                            $num = 1;
                            if (mysqli_num_rows($queryInstitution) > 0) {
                                while ($rows = mysqli_fetch_object($queryInstitution)) {
                            ?>

                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="d-lg-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center mb-4 mb-lg-0">
                                                <?php

                                                if ($rows->institution_logo != NULL) {
                                                    $ProfilePic = '../assets/images/avatar/' . $rows->institution_logo;
                                                } else {
                                                    $ProfilePic = '../assets/images/avatar/university_default.jpg';
                                                }
                                                ?>
                                                <img src="<?php echo $ProfilePic; ?>" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
                                                <div class="ms-3">
                                                    <h4 class="mb-0"><?php echo $rows->university_name; ?>'s picture</h4>
                                                    <p class="mb-0">
                                                        PNG or JPG no bigger than 800px wide and tall.
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfilePicture">Update Profile Picture</a>
                                            </div>
                                        </div>

                                        <!-- Modal: Update Profile Picture -->
                                        <div class="modal fade" id="updateProfilePicture" tabindex="-1" role="dialog" aria-labelledby="updateProfilePictureLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="profilepicModal">Update Profile Picture</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="institution_id" value="<?php echo $rows->institution_id; ?>">
                                                            

                                                            <div class="mb-3 col-md-12 text-center">

                                                                <a href="javascript:void(0)" class="custom-file-container__image-clear">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Click Here">
                                                                        <img src="<?php echo $ProfilePic; ?>" onclick="triggerClick()" id="profileDisplay" style="display: block; width: 25%; margin: 10px auto; border-radius: 80%; clip-path: circle();" />
                                                                    </span>
                                                                </a>

                                                                <label class="form-label" for="textInput">Profile Picture</label>
                                                                <div class="input-group mb-1">
                                                                    <input class="dropify form-control" type="file" name="institution_logo" onchange="displayImage(this)" id="institution_logo" style="display: none;">
                                                                </div>

                                                                <small class="mt-1 d-block">
                                                                    Important guidelines: no bigger than 800 pixels; .jpg, .jpeg, or .png.
                                                                </small>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm" name="update_ProfilePic">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- Modal: Update Profile Picture -->

                                        <hr class="my-5" />
                                        <div>
                                            <h4 class="mb-0">Personal Details</h4>
                                            <p class="mb-4">
                                                Edit your personal information and address.
                                            </p>
                                            <!-- Form -->
                                            <form class="row" action="institution-function.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="institution_id" value="<?php echo $rows->institution_id; ?>">
                                                        <input type="hidden" name="institution_user_id" value="<?php echo $rows->institution_user_id; ?>">

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="email">University Email</label>
                                                                    <input type="email" name="institution_email" class="form-control" value="<?php echo $rows->institution_email; ?>" required />

                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="phone">University Contact No:</label>
                                                                    <input type="text" name="institution_contact_no" class="form-control" value="<?php echo $rows->institution_contact_no; ?>" required />
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="address">University Address</label>
                                                            <textarea type="text" name="institution_address" class="form-control" required><?php echo $rows->institution_address; ?></textarea>
                                                        </div>
                                                        </div>
                                                        <!-- <div class="form-group" style="display:inline-block; width:50%; padding-right: 5%;">
                                                            <div class="mb-3">
                                                                <label class="control-label">Status</label>
                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="new_institution_status">
                                                                    <option value="Active" <?php if ($rows->institution_status == "Active") {
                                                                                                echo "selected";
                                                                                            } ?>>Active</option>
                                                                    <option value="Inactive" <?php if ($rows->institution_status == "Inactive") {
                                                                                                    echo "selected";
                                                                                                } ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                    <?php }
                                            } else {
                                                    ?>
                                                <?php
                                            } ?>
                                                <div class="d-md-flex align-items-center justify-content-between">
                                                    <div class="mb-3 mb-md-0">

                                                    </div>
                                                    <div>
                                                        <button class="btn btn-sm btn-primary" type="submit" name="edit_profile">
                                                            Update Profile
                                                        </button>
                                                    </div>
                                                </div>

                                                    </form>
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
        <script>
            function triggerClick() {
                document.querySelector('#institution_logo').click();
            }

            function displayImage(e) {
                if (e.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
        </script>
        <script src="../assets/js/theme.min.js">
        </script>
</body>

</html>