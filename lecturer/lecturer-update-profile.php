<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';
include('../database/dbcon.php');
include('lecturer-function.php');
$lecturer_id = $_SESSION['sess_lecturerid'];
?>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->

        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'profile';
        include('pages-sidebar.php');
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
                                            <a href="#">Account</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Profile Details
                                        </li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>



                </div>

                <div class="">
                    <div class="row">
                        <!-- basic table -->
                        <div class="col-lg-10 col-md-8 col-12 mx-auto">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header">
                                    <h3 class="mb-0">Profile Details</h3>
                                    <p class="mb-0">
                                        You have full control to manage your own account setting.
                                    </p>
                                </div>
                                <?php
                                $queryLect = $conn->query("SELECT * FROM lecturer
                                                               
                                                                WHERE lecturer_id = '$lecturer_id'");

                                $num = 1;
                                if (mysqli_num_rows($queryLect) > 0) {
                                    while ($rows = mysqli_fetch_object($queryLect)) {
                                ?>
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="d-lg-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center mb-4 mb-lg-0">

                                                    <?php
                                                    $sqlProfilePic = $conn->query("SELECT lecturer_profile_picture FROM lecturer WHERE lecturer_id = '$lecturer_id'");

                                                    $checklectureravatar = mysqli_fetch_object($sqlProfilePic);

                                                    if ($checklectureravatar->lecturer_profile_picture != NULL) {
                                                        $ProfilePic = '../assets/images/avatar/' . $checklectureravatar->lecturer_profile_picture;
                                                    } else {
                                                        $ProfilePic = '../assets/images/avatar/avatardefault.png';
                                                    }
                                                    ?>
                                                    <img alt="avatar" src="<?php echo $ProfilePic; ?>" class="avatar-xl rounded-circle" />


                                                    <div class="ms-3">
                                                        <h4 class="mb-0"><?php echo $rows->lecturer_fname; ?>'s picture</h4>
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
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="profilepicModal">Update Profile Picture</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="lecturer_id" value="<?php echo $rows->lecturer_id; ?>">
                                                                <div class="mb-3 col-md-12 text-center">

                                                                <a href="javascript:void(0)" class="custom-file-container__image-clear" >
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Click Here">
                                                                        <img src="<?php echo $ProfilePic; ?>" onclick="triggerClick()" id="profileDisplay" style="display: block; width: 25%; margin: 10px auto; border-radius: 80%; clip-path: circle();" />
                                                                    </span>
                                                                </a>

                                                                    <label class="form-label" for="textInput">Profile Picture</label>
                                                                    <div class="input-group mb-1">
                                                                        <input class="dropify form-control" type="file" name="lecturer_profile_picture" accept="image/jpeg, image/png" onchange="displayImage(this)" id="lecturer_profile_picture" style="display: none;">
                                                                    </div>
                                                                    
                                                                    <small class="mt-1 d-block">
                                                                        Important guidelines: no bigger than 800 pixels; .jpg, .jpeg, or .png.
                                                                    </small>
                                                                </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-success" name="update_ProfilePic">Update</button>
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
                                                <form class="row" action="lecturer-function.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="lecturer_id" value="<?php echo $rows->lecturer_id; ?>">
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="fname">First Name</label>
                                                        <input type="text" name="lecturer_fname" class="form-control" value="<?php echo $rows->lecturer_fname; ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="lname">Last Name</label>
                                                        <input type="text" name="lecturer_lname" class="form-control" value="<?php echo $rows->lecturer_lname; ?>" required />
                                                    </div>



                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" name="lecturer_email" class="form-control" value="<?php echo $rows->lecturer_email; ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="gender">Gender</label>
                                                        <select name="lecturer_gender" class="selectpicker" data-width="100%" required>
                                                            <option value="<?php if ($rows->lecturer_gender == NULL) {
                                                                                echo "-";
                                                                            } else {
                                                                                echo $rows->lecturer_gender;
                                                                            } ?>"><?php if ($rows->lecturer_gender == NULL) {
                                                                                        echo "-";
                                                                                    } else {
                                                                                        echo $rows->lecturer_gender;
                                                                                    } ?></option>
                                                            <option value="Male"> Male </option>
                                                            <option value="Female"> Female </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="phone">Phone</label>
                                                        <input type="text" name="lecturer_contact_no" class="form-control" value="<?php if ($rows->lecturer_contact_no == NULL) {
                                                                                                                                        echo "-";
                                                                                                                                    } else {
                                                                                                                                        echo $rows->lecturer_contact_no;
                                                                                                                                    } ?>" required />
                                                    </div>

                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="address">Address</label>
                                                        <textarea type="text" name="lecturer_address" class="form-control" required><?php if ($rows->lecturer_address == NULL) {
                                                                                                                                        echo "-";
                                                                                                                                    } else {
                                                                                                                                        echo $rows->lecturer_address;
                                                                                                                                    } ?></textarea>
                                                    </div>

                                                    <hr class="my-5" />

                                                    <h4 class="mb-0">Academic Profile</h4>
                                                    <p class="mb-4">
                                                        Edit your academic profile.
                                                    </p>

                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="phone">Title</label>
                                                        <input type="text" name="lecturer_title" class="form-control" value="<?php if ($rows->lecturer_title == NULL) {
                                                                                                                                    echo "-";
                                                                                                                                } else {
                                                                                                                                    echo $rows->lecturer_title;
                                                                                                                                } ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="phone">Faculty</label>
                                                        <input type="text" name="lecturer_faculty" class="form-control" value="<?php if ($rows->lecturer_faculty == NULL) {
                                                                                                                                    echo "-";
                                                                                                                                } else {
                                                                                                                                    echo $rows->lecturer_faculty;
                                                                                                                                } ?>" required />
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="phone">Department</label>
                                                        <input type="text" name="lecturer_department" class="form-control" value="<?php if ($rows->lecturer_department == NULL) {
                                                                                                                                        echo "-";
                                                                                                                                    } else {
                                                                                                                                        echo $rows->lecturer_department;
                                                                                                                                    } ?>" required />
                                                    </div>

                                                <?php }
                                        } else {
                                                ?>
                                            <?php
                                        } ?>


                                            </div>
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
    </div>


    <!-- Script -->
    <!-- Libs JS -->


    <script type="text/javascript">
        function FetchState(id, lecturer_id) {

            $('#state').html('');
            $('#city').html('<option>Select City</option>');
            $.ajax({
                type: 'POST',
                url: 'lecturer-function.php',
                data: {
                    country_id: id,
                    lecturer_id: lecturer_id
                },
                success: function(data) {
                    $('#state').html(data).selectpicker('refresh');
                }
            })
        }

        function FetchCity(id) {

            $('#city').html('');
            $.ajax({
                type: 'POST',
                url: 'lecturer-function.php',
                data: {
                    state_id: id
                },
                success: function(data) {
                    $('#city').html(data).selectpicker('refresh');
                }
            })
        }
    </script>



    <!-- clipboard -->



    <!-- Theme JS -->
    <script>
        function triggerClick() {
            document.querySelector('#lecturer_profile_picture').click();
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