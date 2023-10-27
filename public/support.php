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

  <!-- Page Content -->
  <div class="py-8 bg-colors-gradient">
    <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8 col-12 ">
          <!-- caption-->
          <h1 class="fw-bold mb-0 display-4 lh-1">Support</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- container  -->
  <div class="pt-3">
    <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8 col-12">
          <div>
            <!-- breadcrumb  -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="help-center.php">Help Center</a></li>
                <li class="breadcrumb-item active" aria-current="page">Support</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container  -->
  <div class="py-10">
    <div class="container">
      <div class="row ">
        <div class="offset-md-2 col-md-8 col-12">
          <div class="mb-3">
            <!-- lead  -->
            <p class="lead mb-8">Can’t find the answer you’re looking for? Don't worry! Get in touch with the Docs
              Support team, we will be glad to assist you.
            </p>
            <div class="d-flex justify-content-between">
              <span>Contact Information</span>
              <div class="text-end">
                <span>+607 550 0077</span>
                <a href="#">support@unicreds.org</a>
              </div>
            </div>
          </div>
          <div>
            <!-- card -->
            <div class="card border">
              <!-- card body  -->
              <div class="card-body p-5">
                <h2 class="mb-4 fw-semi-bold">Submit a Request</h2>
                <!-- form  -->
                <form>
                  <!-- input  -->
                  <div class="mb-3">
                    <label class="form-label" for="name">Your Name</label>
                    <input class="form-control" type="text" placeholder="Your name" id="name" required>
                  </div>
                  <!-- input  -->
                  <div class="mb-3">
                    <label class="form-label" for="company">Company</label>
                    <input class="form-control" type="text" placeholder="Company name" id="company" required>
                  </div>
                  <!-- input  -->
                  <div class="mb-3">
                    <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" placeholder="Email address here" id="email" required>
                  </div>
                  <!-- select options  -->
                  <!-- <div class="mb-3">
                    <label class="form-label" for="select">Subject</label>
                    <select class="form-select" id="select">
                      <option selected>Select</option>
                      <option value="1">General</option>
                      <option value="2">Accounts</option>
                      <option value="3">Payment</option>
                    </select>
                  </div> -->

                  <div class="mb-3 col-12">
                    <label class="text-dark form-label" for="frustration">Subject <span class="text-danger">*</span></label>
                    <select class="selectpicker" data-width="100%">
                      <option selected>Select</option>
                      <option value="1">General</option>
                      <option value="2">Accounts</option>
                      <option value="3">Payment</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <!-- input  -->
                    <label class="form-label" for="description">Description</label>
                    <textarea placeholder="Write down here" id="description" rows="2" class="form-control"></textarea>
                  </div>
                  <!-- button  -->
                  <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                </form>
              </div>
            </div>
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