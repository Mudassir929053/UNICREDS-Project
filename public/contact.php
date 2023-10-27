<!-- <?php
        include 'function.php';
        ?> -->

<!DOCTYPE html>

<html lang="en">

<?php
include 'pages-head.php';
?>

<body class="bg-white">
    <!-- Navbar -->
    <?php
    include 'pages-topbar.php';
    ?>


    <div class="container-fluid">
        <div class="row align-items-center min-vh-100">
            <!-- col -->
            <div class="col-lg-6 col-md-12 col-12">
                <div class="px-xl-20 px-md-8 px-4 py-8 py-lg-0">
                    <!-- content -->
                    <div class="d-flex justify-content-between mb-7 align-items-center">
                    <a class="navbar-brand" href="../index.php"><img src="../assets/images/brand/logo/Icon-256.png" alt="" /></a>
                        </a>
                    </div>
                    <div class="text-dark">
                        <h1 class="display-4 fw-bold">Get In Touch.</h1>
                        <p class="lead text-dark">
                            Fill in the form to the right to get in touch with someone on
                            our
                            team, and we will reach out shortly.
                        </p>
                        <div class="mt-8">
                            <p class="fs-4 mb-4">
                                If you are seeking support please visit our <a href="#">support
                                    portal</a> before
                                reaching out directly.
                            </p>
                            <!-- address -->

                            <p class="fs-4"><i class="bi bi-telephone text-primary
                    me-2"></i>+607 550 0077</p>
                            <p class="fs-4"><i class="bi bi-envelope-open
                    text-primary me-2"></i>support@unicreds.org</p>
                            <p class="fs-4 d-flex"><i class="bi bi-geo-alt
                    text-primary me-2"></i> 201, Industry Centre Building, ICC, UTM Technovation Park, Jalan Pontian Lama, 81300 Skudai, Johor</p>
                        </div>
                        <div class="mt-10">
                            <!--Facebook-->
                            <a href="#" class="text-muted me-3">
                                <i class="fab fa-facebook fs-3"></i>
                            </a>
                            <!--Twitter-->
                            <a href="#" class="text-muted me-3">
                                <i class="fab fa-twitter fs-3"></i>
                            </a>

                            <!--GitHub-->
                            <a href="#" class="text-muted">
                                <i class="fab fa-github fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- background color -->
            <div class="col-lg-6 d-lg-flex align-items-center w-lg-50 min-vh-lg-100 position-fixed-lg top-0 right-0 bg-light-warning bg-gradient">
                <div class="px-4 px-xl-20 py-8 py-lg-0 ">
                    <!-- form section -->
                    <div id="form">
                        <!-- form row -->
                        <form class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="fname">First Name:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="last name" id="fname" placeholder="First Name" required />
                            </div>
                            <!-- form group -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="lname">Last Name:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="last name" id="lname" placeholder="Last Name" required />
                            </div>
                            <!-- form group -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="email">Email:<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required />
                            </div>
                            <!-- form group -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="phone">Phone Number:<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone" required />
                            </div>
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="text-dark form-label" for="frustration">Contact Reason:<span class="text-danger">*</span></label>
                                <select class="selectpicker" data-width="100%">
                                    <option selected>Select</option>
                                    <option value="1">Design</option>
                                    <option value="2">Development</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="text-dark form-label" for="messages">Message:</label>
                                <textarea class="form-control" id="messages" rows="3" placeholder="Messages"></textarea>
                            </div>
                            <!-- button -->
                            <div class=" col-12">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include 'pages-footer.php';
    ?>



    <script src="../assets/js/theme.min.js"></script>

</body>

</html>