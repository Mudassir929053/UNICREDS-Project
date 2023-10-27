<?php
include './database/dbcon.php';
include 'function.php';



$user_role_id = $_SESSION['role_id'];

if ($_SESSION['role_id'] == '9') {
    $suemail = $_SESSION['email'];
    $user_id =  $_SESSION['user'];
    $sufname = $_SESSION['fname'];
    $sulname = $_SESSION['lname'];
    $institution_id = $_SESSION['institution_id'];
}

elseif ($_SESSION['role_id'] == '7') {
    $lectemail = $_SESSION['email'];
    $user_id =  $_SESSION['user'];
    $lectfname = $_SESSION['fname'];
    $lectlname = $_SESSION['lname'];
    $institution_id = $_SESSION['institution_id'];
}
?>

<!DOCTYPE html>
<html lang="en">


<title>Sign up </title>

<?php
include 'main/pages-head.php';
?>

<body>
    <!-- Page content -->

    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-lg-6 col-md-8 py-8 py-xl-0">
                <!-- Card -->
                <div class="card shadow">
                    <!-- Card body -->

                    <div class="card-body p-6">

                        <div class="mb-3" style="text-align: center;">
                            <a href="index.php"><img src="assets/images/brand/logo/Icon-196.png" class="mb-1" alt=""></a>

                        </div>
                        <?php if ($_SESSION['role_id'] == '9') { ?>
                        <div class="mb-4 alert bg-info text-white">We've send a verification code to your email address - <?php echo $suemail; ?></div>
                        
                        <form action="" method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="institution_id" value="<?php echo $institution_id; ?>">
                                <input type="hidden" name="role_id" value="<?php echo $user_role_id; ?>">
                                <input type="hidden" name="su_fname" value="<?php echo $sufname; ?>">
                                <input type="hidden" name="su_lname" value="<?php echo $sulname; ?>">
                                <input type="hidden" name="su_email" value="<?php echo $suemail; ?>">

                                <input type="text" class="form-control" name="vcode" placeholder="Enter Verification Code" required>

                                <!-- Button Student-->
                                <div class="d-grid sm-col-4"><br>

                                    <button type="submit" class="btn btn-success" name="verify_account_student">
                                        Verify Account
                                    </button>
                                    <!-- onclick="doThisOnClick(); -->

                                </div>
                            </div>
                        </form>
                        <?php }?>

                        <?php if ($_SESSION['role_id'] == '7') { ?>

                        <div class="mb-4 alert bg-info text-white">We've send a verification code to your email address - <?php echo $lectemail; ?></div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="institution_id" value="<?php echo $institution_id; ?>">
                                <input type="hidden" name="role_id" value="<?php echo $user_role_id; ?>">
                                <input type="hidden" name="lect_fname" value="<?php echo $lectfname; ?>">
                                <input type="hidden" name="lect_lname" value="<?php echo $lectlname; ?>">
                                <input type="hidden" name="lect_email" value="<?php echo $lectemail; ?>">

                                <input type="text" class="form-control" name="vcode" placeholder="Enter Verification Code" required>

                                <!-- Button Student-->
                                <div class="d-grid sm-col-4"><br>

                                    <button type="submit" class="btn btn-success" name="verify_account_lecturer">
                                        Verify Account
                                    </button>
                                    <!-- onclick="doThisOnClick(); -->

                                </div>
                            </div>
                        </form>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div>
    </div>





    <!-- clipboard -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>

    <!-- Theme JS -->
    <script src="assets/js/theme.min.js"></script>
</body>

</html>