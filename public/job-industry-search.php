<?php
    include('function/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
?>

<body>
    <!-- Navbar -->
<?php
    include('pages-topbar.php');
?>

    <!-- Page header -->
    <div class="pt-9 pb-9 ">
        <div class="container">
            <div class="row ">
                <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="text-center mb-5">
                        <h1 class=" display-2 fw-bold">Browse Company</h1>
                        <p class=" lead">
                            Browse through hundreds of companies to see salary information, benefits, and more. Research companies that interest you to find the best employer to advance your career.
                        </p>
                    </div>
                    <!-- Form -->
                    <div id="ind-search" class="row px-md-20">
                        <div class="mb-3 col ps-3">
                            <div class="d-flex justify-content-end align-items-center w-100">
                                <input type="search" class="form-control pe-6" placeholder="Company name" autocomplete="off">
                                <span class="position-absolute pe-3 search-icon collapse">
                                    <i class="fe fe-x" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            <!-- Search results -->
                            <div class="dropdown-menu dropdown-menu-lg invisible d-block" style="opacity: 1;">
                            </div>
                        </div>
                        <div class="mb-3 col-auto ps-0">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="pb-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div id="company-list" class="row">
                        <!-- Loading spinner -->
                        <div class="d-flex justify-content-center my-3">
                            <div class="spinner-border text-info collapse" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <!-- Company Lists -->
                    </div>
                        
                    <!-- Buttom -->
                    <div class="d-flex justify-content-center mt-4">
                        <a id="load-more" class="btn btn-primary" style="cursor: pointer;">
                            <div class="spinner-border spinner-border-sm me-2 collapse" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Load More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
	include '../main/pages-footer.php';
	?>

    <!-- Script -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Industry List JS -->
    <script src="js/industry-list.js"></script>

</body>

</html>