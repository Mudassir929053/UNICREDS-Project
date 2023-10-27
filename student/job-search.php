<?php
    include('function/student-function.php');
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

    use DBData\Job as job;
    $jobInfo = new job();
?>

    <!-- Page Header -->
    <div class="bg-info py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="mb-4">
                        <h1 class="mb-0 text-white display-4">Search Job</h1>
                    </div>
                    <!-- Search -->
                    <div id="jobSearch" class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3" tabindex="0">
                        <div class="row d-lg-flex justify-content-between align-items-center">
                            <!-- By job title -->
                            <div id="job-title" class="col-md-4 col-lg-4 col-xl-4 mb-2">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-briefcase"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 pe-6" name="job-title" placeholder="Job title or company" autocomplete="off">
                                    </div>
                                    <span class="position-absolute pe-3 search-icon collapse">
                                        <i class="fe fe-x" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <!-- Search results -->
                                <div class="dropdown-menu dropdown-menu-lg invisible d-block overflow-auto" style="opacity: 0; max-height: 350px;">
                                </div>
                            </div>
                            <!-- By location -->
                            <div id="job-location" class="col-md-4 col-lg-4 col-xl-4 mb-2" tabindex="0">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="d-flex align-items-center w-100">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-map-pin"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 pe-6" name="job-location" placeholder="City, state, or country" autocomplete="off">
                                    </div>
                                    <span class="position-absolute pe-3 search-icon collapse">
                                        <i class="fe fe-x" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <!-- Search results -->
                                <div class="dropdown-menu dropdown-menu-lg invisible d-block overflow-auto" style="opacity: 0; max-height: 350px;">
                                </div>
                            </div>
                            <!-- By job category -->
                            <div class="col-md-3 col-lg-3 col-xl-3 mb-2">
                                <select name="job-category" id="job-categories-list" class="selectpicker" data-width="100%" title="Job category" multiple data-actions-box="true" autocomplete="off">
                        <?php
                            $jobCategory = $jobInfo->fetch_job_category();

                            if($jobCategory !== NULL) {
                                foreach($jobCategory as $val) {
                        ?>
                                    <option value="<?= $val["jc_code"] ?>"><?= $val["jc_name"] ?></option>
                        <?php
                                }
                            } else {
                        ?>
                                    <option value="" disabled>Empty categories</option>
                        <?php
                            }
                        ?>
                                </select>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 mb-2">
                                <button id="search-job" class="btn btn-dark">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <!-- Manage Content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="row d-lg-flex justify-content-between align-items-center">
                        <!-- Job Count -->
                        <div class="col-md-3 col-lg-3 col-xl-3 ">
                            <p class="mb-3 mb-lg-0 fs-4 text-dark">Displaying <span id="curr-count" class="fw-medium"></span> of <span id="total-count"></span> jobs</p>
                        </div>
                        <!-- Job Filter -->
                        <div id="job-filter" class="d-inline-flex align-items-center justify-content-end col-md-9 col-lg-9 col-xl-9">
                            <!-- Job Type -->
                            <div class="d-inline-flex col-md-3 col-lg-3 col-xl-3 justify-content-end me-2">
                                <select id="job-type-filter" class="selectpicker" data-width="100%" title="Job type" autocomplete="off" multiple>
                                    <optgroup label="Job type">
                                        <option value="Full-Time">Full-Time</option>
                                        <option value="Part-Time">Part-Time</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Internship">Internship</option>
                                    </optgroup>
                                </select>
                            </div>
                            <!-- Date Posted  -->
                            <div class="d-inline-flex col-md-3 col-lg-3 col-xl-3 justify-content-end me-2">
                                <select id="date-posted-filter" class="selectpicker" data-width="100%" autocomplete="off" title="Date posted">
                                    <optgroup label="Date posted">
                                        <option value="anytime" selected>Anytime</option>
                                        <option value="24h">Last 24 hours</option>
                                        <option value="3d">Last 3 days</option>
                                        <option value="7d">Last 7 days</option>
                                        <option value="14d">Last 14 days</option>
                                        <option value="30d">Last 30 days</option>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- <div class="d-inline-flex justify-content-end col-md-1 col-lg-1 col-xl-1">
                                <button class="btn btn-outline-warning btn-sm">Reset</button>
                            </div> -->
                            <div class="d-inline-flex justify-content-end col-md-1 col-lg-1 col-xl-1">
                                <button id="apply-filter" class="btn btn-info btn-sm">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Offers -->
                <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                    <div id="job-offers-card" class="card">
                        <div class="card-header border-bottom">
                            <h4 class="mb-0">Job Offers</h4>
                        </div>
                        <div class="card-body p-0 mb-4 scrollbar" style="min-height: 300px; max-height: 800px;">
                            <div class="d-flex justify-content-center">
                                <!-- Loading spinner -->
                                <div class="spinner-border text-info mt-8 collapse" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <!-- Job offers list -->
                            <div id="job-offers-list" class="overflow-hidden h-100">
                                <ul class="list-group overflow-auto list-group-flush">
                                    <!-- job offers list -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div id="pagination" class="card mt-3 mb-2 collapse">
                        <div class="card-body">
                            <nav aria-label="Job Offers page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                    <div id="job-desc-card" class="card">
                        <div class="card-header border-bottom">
                            <h4 class="mb-0">Job Description</h4>
                        </div>
                        <div class="card-body p-0 mb-4 scrollbar" style="min-height: 300px; max-height: 800px;">
                            <div class="d-flex justify-content-center">
                                <!-- Loading spinner -->
                                <div class="spinner-border text-info mt-8 collapse" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <!-- Job details -->
                            <div class="overflow-hidden h-100">
                                <!-- job description -->
                            </div>
                        </div>
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
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Job Search JS -->
    <script src="js/search-job.js"></script>

</body>

</html>