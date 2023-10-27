<!-- Sidebar -->
<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="#">
            <img src="../assets/images/brand/logo/logo_unicreds.png" alt="" />
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <li class="nav-item">
                <a class="<?php
                            if ($_SESSION['pages'] == 'dashboard') {
                                echo ('active');
                            }
                            ?> nav-link  " href="dashboard.php">
                    <i class="nav-icon fas fa-chart-pie  me-2"></i> Dashboard
                </a>

            </li>


          <!-- Nav item -->
          <li class="nav-item">
                <a class="nav-link   collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navAds" aria-expanded="false" aria-controls="navAds">
                    <i class="nav-icon fas fa-briefcase me-2"></i> Jobs
                </a>
                <div id="navAds" class="collapse <?php
                                                    if ($_SESSION['pages'] == 'job_advertisement' || $_SESSION['pages'] == 'job_application') {
                                                        echo ('show');
                                                    } ?>" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'job_advertisement') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="job-advertisement.php"> Job Advertisement</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'job_application') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="candidate-application.php"> Candidate Application</a>
                        </li> 


                    </ul>
                </div>
            </li>

  <!-- Nav item -->
  <li class="nav-item">
                <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navProfile" aria-expanded="false" aria-controls="navProfile">
                    <i class="nav-icon fas fa-users me-2 fs-5"></i> Career Readiness
                </a>
                <div id="navProfile" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'staff' || $_SESSION['pages'] == 'institution' || $_SESSION['pages'] == 'industry') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'staff') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-career_readiness-assessment.php">Psychometric Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'staff') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-career_readiness-skill-assessment.php">Skill Assessment Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'staff') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-language-test.php">Language Test</a>
                        </li>

                    </ul>
                </div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navProfile" aria-expanded="false" aria-controls="navProfile">
                    <i class="nav-icon fas fa-users me-2 fs-5"></i> Users
                </a>
                <div id="navProfile" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'staff' || $_SESSION['pages'] == 'institution' || $_SESSION['pages'] == 'industry') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'staff') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-manage-staff.php">Staff</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navadvt" aria-expanded="false" aria-controls="navProfile">
                    <i class="nav-icon fas fa-users me-2 fs-5"></i> Advertisement
                </a>
                <div id="navadvt" class="collapse <?php
                                                    if ($_SESSION['pages'] == 'advt') {
                                                        echo ('show');
                                                    } ?>" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="<?php
                                        if ($_SESSION['pages'] == 'advt') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="project-advertisement.php">Project Advertisement</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="<?php
                            if ($_SESSION['pages'] == 'company_profile') {
                                echo ('active');
                            }
                            ?> nav-link" href="search_talent.php">
                    <i class="nav-icon far fa-building me-2"></i> Search Talent
                </a>

            </li>
            <!-- Nav item -->
            <li class="nav-item ">
                <a class="<?php
                            if ($_SESSION['pages'] == 'company_profile') {
                                echo ('active');
                            }
                            ?> nav-link" href="company-profile.php">
                    <i class="nav-icon far fa-building me-2"></i> My Company
                </a>

            </li>

            <!-- Nav item -->
            <!-- <li class="nav-item ">
                <a class="nav-link" href="talent-search.php">
                    <i class="nav-icon fas fa-search me-2"></i> Talent Search
                </a>

            </li> -->

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

        </ul>

    </div>
</nav>