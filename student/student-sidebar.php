<?php
    $curr_filename = basename($_SERVER["PHP_SELF"]);
    $link_announcement = "student-announcement.php";
    $link_enrollment = "student-manage-enrollment.php";
    $link_job_app  = "student-job-application.php";
    $link_purchase = "student-purchases.php";
    $link_purchase_details = "student-purchases-details.php";
    $link_profile = "student-manage-profile.php";
    $link_portfolio = "student-manage-portfolio.php";
    $link_security = "student-manage-security.php";
    $link_video = "student-manage-video.php";

?>
<!-- Side navbar -->
<nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
    <!-- Menu -->
    <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
    <!-- Button -->
    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="fe fe-menu"></span>
    </button>
    <!-- Collapse navbar -->
    <div class="collapse navbar-collapse" id="sidenav">
        <div class="navbar-nav flex-column">
            <!-- Activity -->
            <span class="navbar-header">Activity</span>
            <ul class="list-unstyled ms-n2 mb-4">
            <?php
                $announcement_active = strcmp($curr_filename, $link_announcement) == 0 ? "active" : "";
            ?>
                <!-- Enrollment -->
                <li class="nav-item <?= $announcement_active ?>">
                    <a class="nav-link" href="<?= $link_announcement ?>"><i class="fe fe-bell nav-icon"></i>Announcement</a>
                </li>
            <?php
                $enrollment_active = strcmp($curr_filename, $link_enrollment) == 0 ? "active" : "";
            ?>
                <!-- Enrollment -->
                <li class="nav-item <?= $enrollment_active ?>">
                    <a class="nav-link" href="<?= $link_enrollment ?>?tab=course"><i class="fe fe-clipboard nav-icon"></i>Enrollment</a>
                </li>
            <?php
                $job_app_active = strcmp($curr_filename, $link_job_app) == 0 ? "active" : "";
            ?>
                <!-- Job Application -->
                <li class="nav-item <?= $job_app_active ?>">
                    <a class="nav-link" href="<?= $link_job_app ?>"><i class="mdi mdi-briefcase-clock-outline nav-icon"></i>Job Application</a>
                </li>
            <?php
                $purchase_active = strcmp($curr_filename, $link_purchase) == 0 || strcmp($curr_filename, $link_purchase_details) == 0 ? "active" : "";
            ?>
                <!-- Job Application -->
                <li class="nav-item <?= $purchase_active ?>">
                    <a class="nav-link" href="<?= $link_purchase ?>"><i class="fe fe-shopping-bag nav-icon"></i>Purchases</a>
                </li>
            </ul>

            <!-- Account settings -->
            <span class="navbar-header">Account Settings</span>
            <ul class="list-unstyled ms-n2 mb-0">
            <?php
                $profile_active = strcmp($curr_filename, $link_profile) == 0 ? "active" : "";
            ?>
                <!-- Profile Info -->
                <li class="nav-item <?= $profile_active ?>">
                    <a class="nav-link" href="<?= $link_profile ?>"><i class="fe fe-user nav-icon"></i>Profile Info</a>
                </li>
            <?php
                $portfolio_active = strcmp($curr_filename, $link_portfolio) == 0 ? "active" : "";
            ?>
                <!-- Portfolio -->
                <li class="nav-item <?= $portfolio_active ?>">
                    <a class="nav-link" href="<?= $link_portfolio ?>?tab=skill"><i class="fe fe-briefcase nav-icon"></i>Portfolio</a>
                </li>
                <?php
                $portfolio_active = strcmp($curr_filename, $link_video) == 0 ? "active" : "";
            ?>
                <!-- Portfolio -->
                <li class="nav-item <?= $portfolio_active ?>">
                    <a class="nav-link" href="<?= $link_video ?>?tab=exp"><i class="bi bi-camera-video"></i>  Video profile</a>
                </li>
            <?php
                $security_active = strcmp($curr_filename, $link_security) == 0 ? "active" : "";
            ?>
                <!-- Security -->
                <li class="nav-item <?= $security_active ?>">
                    <a class="nav-link" href="<?= $link_security ?>"><i class="fe fe-lock nav-icon"></i>Security</a>
                </li>
                <!-- Logout -->
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="if(confirm('Are you sure to logout?') == true) { location.href = '../logout.php'; }"><i class="fe fe-power nav-icon"></i>Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>