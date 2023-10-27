<?php
    include("function/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include("pages-head.php");
?>

<body>
    <!-- Navbar -->
<?php
    include("pages-topbar.php");

    $jobID = $_GET["job_id"];
    $job = $jobInfo->fetch_job($jobID);


?>

    <!-- Page Header -->
    <div class="bg-info py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="mb-0 text-white display-4">Job Details</h1>
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
                    <div class="card mt-4">
                        <div style="height: 300px;">
                            <img src="../assets/images/background/slider_1024.jpg" class="card-img-top" alt="" height="300">
                        </div>
                        <div class="card-body px-6">
                    <?php
                        if($job["industry_logo"] !== NULL) {
                    ?>
                            <img src="../assets/images/industry/<?= $job["industry_logo"] ?>" class="rounded img-4by3-xl" alt="">
                    <?php
                        } else {
                    ?>
                            <span class="avatar avatar-xxl avatar-info">
                                <span class="avatar-initials rounded fs-1"><?= $job["industry_name"][0].$job["industry_name"][1] ?></span>
                            </span>
                    <?php
                        }
                    ?>
                            <div class="mt-3 mb-3">
                                <h1 class="mb-0 fw-bold"><?= $job["job_title"] ?></h1>
                                <h3 class="mb-0">
                                    <?= $job["industry_name"] ?>
                                    <a href="job-industry-profile.php?ind_id=<?= $job["industry_id"] ?>"><i class="fe fe-info fs-4 ms-3"></i></a>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <p class="mb-1 fw-medium fs-4">
                                        <i class="fe fe-map-pin me-1" data-bs-toggle="tooltip" data-placement="top" title="Location"></i>
                                        <?= $job["industry_city_id"] !== NULL ? $job["industry_city_id"].", ".$job["state_name"] : '<em class="text-muted fs-4">Not specified</em>' ?>
                                    </p>
                                    <p class="mb-1 fw-medium fs-4">
                                        <i class="fe fe-dollar-sign me-1" data-bs-toggle="tooltip" data-placement="top" title="Salary"></i>
                                        <?= salary($job["job_min_salary"], $job["job_max_salary"]) ?>
                                    </p>
                                    <p class="mb-1 fw-medium fs-4">
                                        <i class="fe fe-book me-1" data-bs-toggle="tooltip" data-placement="top" title="Type"></i>
                                        <?= $job["job_type"] ?>
                                    </p>
                                    <p class="mb-0 fw-medium fs-4">
                                        <i class="fe fe-zoom-in me-1" data-bs-toggle="tooltip" data-placement="top" title="Vacancy"></i>
                                        <?= $job["job_no_of_vacancies"]." position" ?>
                                    </p>
                                </div>
                          
                            </div>
                            <div class="mb-5">
                                <!-- <h3>Job Position: <span class="fw-normal text-body"><?= $job["jp_name"] ?></span></h3> -->
                                <!-- <h4 class="mb-1 text-body">.$job["job_pos"].</h4>
                                <div class="text-body mb-0">
                                    $job["job_pos_desc"]
                                </div> -->
                            </div>
                            <div class="mb-5">
                                <h3>Job Details</h3>
                                <h4 class="mb-1 text-body">Job Descriptions:</h4>
                                <div class="text-body mb-4 fs-4">
                                    <?= $job["job_description"] ?>
                                </div>

                                <!-- <h4 class="mb-1 text-body">Job Responsibilities:</h4>
                                <div class="text-body mb-4 fs-4">
                                    <?= $job["job_responsibility"] ?>
                                </div> -->

                                <!-- <h4 class="mb-1 text-body">Job Requirements:</h4>
                                <div class="text-body mb-0 fs-4">
                                    <?= $job["job_requirement"] ?>
                                </div> -->
                            </div>
                            <div class="mb-0 row">
                                <h3>Additional Information</h3>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                    <div class="mb-3">
                                        <h4 class="mb-1 text-body">Career Level</h4>
                                        <span class="text-dark fs-4">
                                            <?= $job["job_level"] ?>
                                        </span>
                                    </div>
                                    <div class="mb-1">
                                        <h4 class="mb-1 text-body">Years of Experience</h4>
                                        <span class="text-dark fs-4">
                                            <?= $job["job_experience_year"] !== NULL ? ($job["job_experience_year"] > 1 ? $job["job_experience_year"]." years" : $job["job_experience_year"]." year") : "<em>Not set</em>" ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-12">
                                    <div class="mb-3">
                                        <h4 class="mb-1 text-body">Job Category</h4>
                                        <span class="text-dark fs-4">
                                            <?= $job["jc_name"] ?>
                                        </span>
                                    </div>
                                    <div class="mb-1">
                                        <h4 class="mb-1 text-body">Qualifications</h4>
                                        <span class="text-dark fs-4">
                                            <?= $job["job_qualification"] !== NULL ? $job["job_qualification"] : "<em class='text-muted'>Not specified</em>" ?>
                                        </span>
                                    </div>
                                </div>
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