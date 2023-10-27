<?php
include('database/dbcon.php');
include('function.php');
?>
<!DOCTYPE html>
<html lang="en">



<title>Sign in </title>
<?php
include 'main/pages-head.php';
?>

<body>
  <!-- Page content -->
  <div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
      <div class="col-lg-5 col-md-8 py-8 py-xl-0">
        <!-- Card -->
        <div class="card shadow ">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4">
              <a href="index.php"><img src="assets/images/brand/logo/Icon-196.png" class="mb-4" alt=""></a>
              <h1 class="mb-1 fw-bold">Sign In</h1>

              <span>Don’t have an account? <a href="registerselection.php" class="ms-1">Sign Up</a></span>

            </div>
            <!-- Form -->
            <form method="POST" id="form" action="">
              <!-- Username -->
              <div class="mb-3">
                <label for="email" class="form-label">Username or email</label>
                <input type="email" id="email" class="form-control" name="user_username" placeholder="Email address here" required>
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="user_password" placeholder="******" required>
              </div>
              <!-- Checkbox -->
              <div class="d-lg-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="rememberme">
                  <label class="form-check-label " for="rememberme">Remember me</label>
                </div>
                <div>
                  <a href="forget-password.php">Forgot your password?</a>
                </div>
              </div>
              <div>
                <!-- Button -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary " name="btnLogin" id="btnLogin">Sign In</button>
                </div>
              </div>
              <hr class="my-4">
              <div class="mt-4 text-center">
                <!--Facebook-->
                <a href="#" class="btn-social btn-social-outline btn-facebook">
                  <i class="fab fa-facebook"></i>
                </a>
                <!--Twitter-->
                <a href="#" class="btn-social btn-social-outline btn-twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <!--LinkedIn-->
                <a href="#" class="btn-social btn-social-outline btn-linkedin">
                  <i class="fab fa-linkedin"></i>
                </a>
                <!--GitHub-->
                <a href="#" class="btn-social btn-social-outline btn-github">
                  <i class="fab fa-github"></i>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/odometer/odometer.min.js"></script>
  <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
  <script src="assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="assets/libs/flatpickr/dist/flatpickr.min.js"></script>
  <script src="assets/libs/inputmask/dist/jquery.inputmask.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/quill/dist/quill.min.js"></script>
  <script src="assets/libs/file-upload-with-preview/dist/file-upload-with-preview.min.js"></script>
  <script src="assets/libs/dragula/dist/dragula.min.js"></script>
  <script src="assets/libs/bs-stepper/dist/js/bs-stepper.min.js"></script>
  <script src="assets/libs/dropzone/dist/min/dropzone.min.js"></script>
  <script src="assets/libs/jQuery.print/jQuery.print.js"></script>
  <script src="assets/libs/prismjs/prism.js"></script>
  <script src="assets/libs/prismjs/components/prism-scss.min.js"></script>
  <script src="assets/libs/@yaireo/tagify/dist/tagify.min.js"></script>
  <script src="assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
  <script src="assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
  <script src="assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
  <script src="assets/libs/typed.js/lib/typed.min.js"></script>
  <script src="assets/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
  <script src="assets/libs/jsvectormap/dist/maps/world.js"></script>
  <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>




  <!-- clipboard -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>


  <!-- Theme JS -->
  <script src="assets/js/theme.min.js"></script>
</body>

</html>