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
  <div class="py-lg-15 py-10 bg-colors-gradient">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-6  col-12 ">
          <!-- caption-->
          <h1 class="fw-bold mb-1 display-3">How can we help you?</h1>
          <!-- para -->
          <p class="mb-5 text-dark ">Have questions? Search through our Help Center</p>
          <div class="pe-md-6">
            <!-- input  -->
            <form class="d-flex align-items-center">
              <span class="position-absolute ps-3">
                <i class="fe fe-search text-muted"></i>
              </span>
              <!-- input  -->
              <input type="search" class="form-control ps-6 border-0 py-3 smooth-shadow-md"
                placeholder="Enter a question, topic or keyword">
            </form>
          </div>
          <span class=" mt-2 d-block">... or choose a category to quickly find the help you need</span>
        </div>
        <div class="col-md-6 col-12">
          <div class="d-flex align-items-center justify-content-end">
            <!-- img  -->
            <img src="../assets/images/svg/3d-girl-seeting.svg" alt="" class="text-center img-fluid">
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="mt-n8">
    <!-- container  -->
    <div class="container">
      <div class="bg-white rounded-3 shadow-sm">
        <div class="row">
          <div class="col-md-4  col-12 border-end-md ">
            <!-- features  -->
            <div class="border-bottom border-bottom-md-0 mb-3 mb-lg-0">
              <div class="p-5">
                <div class="mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-help-circle text-primary">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                  </svg>
                </div>
                <!-- heading  -->
                <h3 class="fw-semi-bold"><a href="help-faq.php" class="text-inherit">FAQs</a></h3>
                <!-- para  -->
                <p>FAQ, short for frequently asked questions, is
                  a list of commonly asked questions and
                  answers about a specific topic.</p>
                <!-- button  -->
                <a href="help-faq.php" class="link-primary fw-semi-bold">View FAQ<i
                    class="mdi mdi-arrow-right ms-1"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4  col-12  border-end-md">
            <!-- features  -->
            <div class="border-bottom border-bottom-md-0 mb-3 mb-lg-0">
              <div class="p-5">
                <div class="mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-book text-primary">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                  </svg>
                </div>
                <!-- heading  -->
                <h3 class="fw-semi-bold"><a href="manual.php" class="text-inherit">Manual & Guides</a>
                </h3>
                <!-- para  -->
                <p>First time using Unicreds? Don't really understand what Unicreds capable of? Don't worry. We prepared for you user manual documents that expose all modules and functions in our system. The user manual consist of comprehensive information on using the system. Download the user manual.</p>
                <!-- button  -->
                <a href="manual.php" class="link-primary fw-semi-bold">Browse Manual<i
                    class="mdi mdi-arrow-right ms-1"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4  col-12">
            <div class="">
              <div class="p-5">
                <div class="mb-4">
                  <!-- features  -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="#754ffe" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-life-buoy text-primary">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="4"></circle>
                    <line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line>
                    <line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line>
                    <line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line>
                    <line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line>
                    <line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line>
                  </svg>
                </div>
                <!-- heading  -->
                <h3 class="fw-semi-bold"><a href="support.php" class="text-inherit">Support</a></h3>
                <!-- para  -->
                <p>Our team are dedicated in providing a full support to all users. If you have any enquiries or stumbled upon any trouble in using the system, please contact us for more
                  detailed support.</p>
                <!-- button  -->
                <a href="support.php" class="link-primary fw-semi-bold">Submit a Request<i
                    class="mdi mdi-arrow-right ms-1"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- container  -->
  <div class="py-lg-16 py-10">
    <div class="container">
      <div class="row">
        <div class="offset-lg-2 col-lg-6  col-12">
          <div class="mb-8 pe-lg-14">
             <!-- heading  -->
            <h2 class="pe-lg-12 mb-4 h1 fw-semi-bold">Most frequently asked
              questions</h2>
            <p class="lead">Here are the most frequently asked questions
              you may check before getting started</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="offset-lg-2 col-lg-8 col-12">
           <!-- accordions  -->
          <div class="accordion accordion-flush" id="accordionExample">
            <div class="border p-3 rounded-3 mb-2" id="headingOne">
              <h3 class="mb-0 fs-4">
                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active"
                  data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                  aria-controls="collapseOne">
                  <span class="me-auto">
                    What course does Unicreds offer?
                  </span>
                  <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down text-muted "></i>
                  </span>
                </a>
              </h3>
              <!-- collapse  -->
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="pt-2">
                  Unicreds offer courses and micro-credentials from institutions and universities
                </div>
              </div>
            </div>
            <!-- Card  -->
            <!-- Card header  -->
            <div class="border p-3 rounded-3 mb-2" id="headingTwo">
              <h3 class="mb-0 fs-4">
                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none"
                  data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                  aria-controls="collapseTwo">
                  <span class="me-auto">
                  How do I take a course?
                  </span>
                  <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down text-muted"></i>
                  </span>
                </a>
              </h3>
               <!-- collapse  -->
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="pt-3">
                You can begin the course whenever you like, and there are no deadlines to complete it. Unicreds courses can be accessed from several different devices and platforms, including a desktop or laptop
                </div>
              </div>
            </div>
            <!-- Card  -->
            <!-- Card header  -->
            <div class="border p-3 rounded-3 mb-2 " id="headingThree">
              <h3 class="mb-0 fs-4">
                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active"
                  data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                  aria-controls="collapseThree">
                  <span class="me-auto">
                  Do I have to start my Unicreds course at a certain time? And how long do I have to complete it?
                  </span>
                  <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down text-muted"></i>
                  </span>
                </a>
              </h3>
              <!-- collapse  -->
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="pt-3">
                As noted above, there are no deadlines to begin or complete the course. Even after you complete the course you will continue to have access to it, provided that your account’s in good standing, and Unicreds continues to have a license to the course.
                </div>
              </div>
            </div>
            <!-- Card  -->
            <!-- Card header  -->
            <div class="border p-3 rounded-3 mb-2 " id="headingFour">
              <h3 class="mb-0 fs-4">
                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active"
                  data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                  aria-controls="collapseFour">
                  <span class="me-auto">
                    Course resources can be downloaded?
                  </span>
                  <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down text-muted"></i>
                  </span>
                </a>
              </h3>
               <!-- collapse  -->
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="pt-3">
                Many instructors add supplemental resources to their lectures, like PDFs, design templates or source code, as a means to enhance the learning experience of the course. These resources can quickly be downloaded to your computer and viewed. 
                </div>
              </div>
            </div>
            <div class="border p-3 rounded-3 mb-2 " id="headingFive">
              <h3 class="mb-0 fs-4">
                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active"
                  data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                  aria-controls="collapseFive">
                  <span class="me-auto">
                    How to get badges or certificate?
                  </span>
                  <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down text-muted"></i>
                  </span>
                </a>
              </h3>
            <!-- collapse  -->
               <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="pt-3">
                  The certificate will be issued after student finished the coourse
                </div>

              </div>
            </div>
          
     
          </div>

        </div>
      </div>
    </div>
  </div>
 <!-- container  -->
  <div class="pb-lg-16 pb-10">
    <div class="container">
      <div class="row">
        <div class="offset-lg-2 col-lg-4  col-12">
          <div class="mb-8">
            <h2 class="mb-0 h1 fw-semi-bold">Can't find what you're looking for?</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="offset-lg-2 col-lg-8  col-12">
          <div class="row">
            <div class="col-md-6 col-12">
               <!-- card  -->
              <div class="card border mb-md-0 mb-4">
                 <!-- card body  -->
                <div class="card-body">
                  <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-help-circle text-primary">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                      <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                  </div>
                   <!-- para  -->
                  <h3 class="mb-2 fw-semi-bold">Contact us</h3>
                  <p>Unicreds team is here to help. We can provide you with the support you need. Just contact us
                    and our team will reply quick to you.</p>
                     <!-- btn  -->
                  <a href="contact.php" class="btn btn-primary btn-sm">Contact us</a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12">
               <!-- card  -->
              <div class="card border">
                 <!-- card body  -->
                <div class="card-body">
                  <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                      stroke="#754ffe" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-life-buoy text-primary">
                      <circle cx="12" cy="12" r="10"></circle>
                      <circle cx="12" cy="12" r="4"></circle>
                      <line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line>
                      <line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line>
                      <line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line>
                      <line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line>
                      <line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line>
                    </svg>
                  </div>
                   <!-- para  -->
                  <h3 class="mb-2 fw-semi-bold">Support</h3>
                  <p>The good news is that you’re not alone, and you’re in the right place. Contact us for more detailed
                    support.</p>
                     <!-- btn  -->
                  <a href="support.php" class="btn btn-outline-secondary btn-sm">Submit a Ticket</a>
                </div>
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