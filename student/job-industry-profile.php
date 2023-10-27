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

    $ind_id = $_GET["ind_id"];

    $indInfo = $jobInfo->fetch_industry($ind_id);

    $sql_opr = "ind.industry_id = {$ind_id}";
    $jobs = $jobInfo->fetch_jobs($sql_opr);
?>


    <!-- Bg cover -->
    <div class="py-6" style="background: linear-gradient(270deg, #E1F6FF 0%, #6AD2FF 100%);"></div>
    <!-- Page header -->
    <div class="bg-white shadow-sm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="d-md-flex align-items-center justify-content-between bg-white  pt-3 pb-3 pb-lg-5">
                        <div class="d-md-flex align-items-center text-lg-start text-center ">
                            <div class="me-3 mt-n8">
                        <?php
                            if($indInfo["industry_logo"] !== NULL) {
                        ?>
                                <img src="../assets/images/industry/<?= $indInfo["industry_logo"] ?>" class="rounded img-4by3-xl" alt="">
                        <?php
                            } else {
                        ?>
                                <span class="avatar avatar-xxl avatar-info">
                                    <span class="avatar-initials rounded fs-1"><?= $indInfo["industry_name"][0].$indInfo["industry_name"][1] ?></span>
                                </span>
                        <?php
                            }
                        ?>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <h1 class="mb-0 fw-bold me-3"><?= $indInfo["industry_name"] ?></h1>
                                <p class="fs-3 mb-0 text-muted"><?= $indInfo["industry_field_name"] ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Nav tab -->
                    <ul class="nav nav-lt-tab" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-about-tab" data-bs-toggle="pill" href="#pills-about" role="tab"
                                aria-controls="pills-about" aria-selected="false">
                                About
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-job-tab" data-bs-toggle="pill" href="#pills-job" role="tab"
                                aria-controls="pills-job" aria-selected="false">
                                Jobs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Content  -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Tab content -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- About tab pane -->
                        <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <!-- Company overview -->
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3 class="mb-0">Company Overview</h3>
                                        </div>
                                        <div class="card-body px-6 fs-4 text-dark">
                                            <?= $indInfo["ii_overview"] === "" || $indInfo["ii_overview"] === NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_overview"] ?>
                                        </div>
                                    </div>
                                    <!-- Company Information -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Company Information</h3>
                                        </div>
                                        <div class="card-body p-6">
                                            <div class="row mb-4">
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-map-pin icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Location</h4>
                                                <?php
                                                    if($indInfo["industry_address1"] !== NULL) {
                                                ?>
                                                        <p class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["industry_address1"] ?><br>
                                                            <?= $indInfo["industry_address2"] ?><br>
                                                            <?= $indInfo["industry_city_id"] ?>, <?= $indInfo["state_name"] ?><br>
                                                            <?= $indInfo["industry_country_id"] ?>
                                                        </p>
                                                <?php
                                                    } else {
                                                ?>
                                                        <em class="text-muted fs-4">Not specified</em>
                                                <?php
                                                    }
                                                ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-link icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Website</h4>
                                                <?php
                                                    if($indInfo["industry_website"] !== "") {
                                                ?>
                                                        <a href="<?= $indInfo["industry_website"] ?>" class="fs-4" target="_blank"><?= ltrim($indInfo["industry_website"], "https://") ?></a>
                                                <?php
                                                    } else {
                                                ?>
                                                        <em class="text-muted fs-4">Not specified</em>
                                                <?php
                                                    }
                                                ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-users icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Company Size</h4>
                                                        <div class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["ii_company_size"] === "" || $indInfo["ii_company_size"] === NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_company_size"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-gift icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Benefits</h4>
                                                        <div class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["ii_benefit"] === "" || $indInfo["ii_benefit"] === NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_benefit"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="mdi mdi-hanger icon-shape icon-lg mdi-24px rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Dress Code</h4>
                                                        <div class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["ii_dress_code"] !== "" || $indInfo["ii_dress_code"] !== NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_dress_code"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-message-circle icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Spoken Language</h4>
                                                        <div class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["ii_spoken_language"] !== "" || $indInfo["ii_spoken_language"] !== NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_spoken_language"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-12 d-flex flex-row">
                                                    <div>
                                                        <i class="fe fe-clock icon-shape icon-lg fs-3 rounded-3 bg-light-info text-dark-info"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="text-muted fw-normal text-uppercase">Work Hours</h4>
                                                        <div class="mb-0 fs-4 text-dark">
                                                            <?= $indInfo["ii_working_hours"] !== "" || $indInfo["ii_working_hours"] !== NULL ? "<em class='text-muted'>Not specified</em>" : $indInfo["ii_working_hours"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Jobs tab pane -->
                        <div class="tab-pane fade" id="pills-job" role="tabpanel" aria-labelledby="pills-job-tab">
                            <div class="row">
                                <!-- Job offered lists -->
                    <?php
                        $jsua_arr = array();
                        $suJob = $jobInfo->fetch_job_applications($suID);
                        if($suJob !== NULL) {
                            foreach($suJob as $val) {
                                array_push($jsua_arr, $val["jsua_job_id"]);
                            }
                        }
                        
                        $i = 0;
                        if($jobs !== NULL) {
                            foreach($jobs as $val) {
                    ?>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="d-lg-flex">
                                                <div class="w-100">
                                                    <h2 class="mb-0"><?= $val["job_title"] ?></h2>
                                                    <p class="fs-4"><?= $val["industry_name"] ?></p>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                            <h5 class="mb-0 text-muted">Job Location</h5>
                                                            <p class="fs-4 text-dark">
                                                                <?= $val["industry_city_id"] !== NULL ? $val["industry_city_id"].", ".$val["state_name"] : '<em class="text-muted fs-4">Not specified</em>' ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                            <h5 class="mb-0 text-muted">Salary</h5>
                                                            <p class="fs-4 text-dark">
                                                                <?= salary($val["job_min_salary"], $val["job_max_salary"]) ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                            <h5 class="mb-0 text-muted">Job Type</h5>
                                                            <p class="fs-4 text-dark">
                                                                <?= $val["job_type"] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                                            <h5 class="mb-0 text-muted">Job Vacancy</h5>
                                                            <p class="fs-4 text-dark">
                                                                <?= $val["job_no_of_vacancies"]." position" ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <a href="job-details.php?job_id=<?= $val["job_id"] ?>" class="btn btn-outline-white btn-sm">
                                                            View Details
                                                        </a>
                                                <?php
                                                    if(!(in_array($val["job_id"], $jsua_arr, TRUE))) {
                                                ?>
                                                        <a type="button" href="job-apply.php?job_id=<?= $val["job_id"] ?>" class="btn btn-outline-primary btn-sm ms-3">
                                                            Apply Now
                                                        </a>
                                                <?php
                                                    } else {
                                                ?>
                                                        <button class="btn btn-primary btn-sm ms-3 disabled">Applied <i class="fe fe-check ms-1"></i></button>
                                                <?php
                                                    }
                                                ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                                $i++;
                            }
                        } else {
                    ?>
                            <div class="d-flex justify-content-center mt-8">
                                <div>
                                    <h1 class="fw-bold">There's no job offered by this company.</h1>
                                    <p class="fs-3 text-center">Please go to <a href="job-search.php">Search Job</a> to find more job offers.</p>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
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

</body>

</html>