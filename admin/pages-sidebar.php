  <!-- Sidebar -->
  <nav class="navbar-vertical navbar">
      <div class="nav-scroller">
          <!-- Brand logo -->
          <a class="navbar-brand" href="#">
              <img src="../assets/images/logo/logo_unicreds.png" alt="" />
          </a>
          <!-- Navbar nav -->
          <ul class="navbar-nav flex-column" id="sideNavbar">
              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'dashboard') {
                                echo ('active');
                            }
                            ?> nav-link  " href="dashboard.php">
                      <i class="nav-icon mdi mdi-view-dashboard me-2"></i> Dashboard
                  </a>

              </li>



              <li class="nav-item">
                  <a class="nav-link  " href="#!" data-bs-toggle="collapse" data-bs-target="#mc" aria-expanded="false" aria-controls="navDashboard">
                      <i class="nav-icon fe fe-book me-2"></i> Micro-Credential
                  </a>
                  <div id="mc" class="collapse <?php
                                                if ($_SESSION['pages'] == 'mcrequest' || $_SESSION['pages'] == 'mcregister') {
                                                    echo ('show');
                                                } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column ">
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'mcregister') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-microcredential-list.php">Register Micro-Credential</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'mcrequest') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-mcreq-list.php">Request Micro-Credential</a>
                          </li>

                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'course') {
                                echo ('active');
                            }
                            ?> nav-link  " href="pages-employability-program.php">
                      <i class="nav-icon fe fe-book-open me-2"></i> Employability-Program
                  </a>

              </li>
              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'employability-program') {
                                echo ('active');
                            }
                            ?> nav-link  " href="pages-course-list.php">
                      <i class="nav-icon fe fe-book-open me-2"></i> Course
                  </a>

              </li>

              <li class="nav-item">
                  <div class="nav-divider"></div>
              </li>

              <!-- Nav item -->
              <li class="nav-item">
                  <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navProfile" aria-expanded="false" aria-controls="navProfile">
                      <i class="nav-icon fas fa-users me-2 fs-5"></i> Users
                  </a>
                  <div id="navProfile" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'admin' || $_SESSION['pages'] == 'institution' || $_SESSION['pages'] == 'industry') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">

                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'admin') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-admin-dashboard.php">Admin</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'institution') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-institution-dashboard.php">Institution</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'industry') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-industry-dashboard.php">Industry</a>
                          </li>


                      </ul>
                  </div>
              </li>
            <!-- Nav item -->
            <li class="nav-item">
                  <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navProfile1" aria-expanded="false" aria-controls="navProfile">
                      <i class="nav-icon fas fa-users me-2 fs-5"></i> Career Readiness
                  </a>
                  <div id="navProfile1" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'admin' || $_SESSION['pages'] == 'Career_Readiness' || $_SESSION['pages'] == 'Career_skill_Readiness' || $_SESSION['pages'] == 'industry') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">

                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'Career_Readiness') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-career_readiness-assessment.php">Psychometric Test</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'Career_skill_Readiness') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-career_readiness-skill-assessment.php">Skill Assessment Test</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'Career_Readiness') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-language-test.php">Language Test</a>
                          </li>



                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <div class="nav-divider"></div>
              </li>

              <!-- <li class="nav-item ">
                  <a class="nav-link " href="#">
                      <i class="nav-icon fas fa-align-justify me-2"></i> Micro-Credential Framework
                  </a>

              </li>
              
              <li class="nav-item ">
                  <a class="nav-link " href="#">
                      <i class="nav-icon fas fa-file-invoice-dollar me-2"></i> Fee Management
                  </a>

              </li> -->


              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'university') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-university.php">
                      <i class="nav-icon far fa-building me-2"></i> University

                  </a>
              </li>



              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'edufield') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-education-field.php">
                      <i class="nav-icon fas fa-book me-2"></i> Education Field

                  </a>
              </li>


              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'indfield') {
                                echo ('active');
                            }
                            ?> nav-link " href="pages-industry-field.php">
                      <i class="nav-icon fas fa-industry me-2"></i> Industry Field

                  </a>
              </li>

              <li class="nav-item">
                  <div class="nav-divider"></div>
              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'announcement') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-announcement.php">
                      <i class="nav-icon mdi mdi-bullhorn me-2"></i> Announcement
                  </a>
              </li>


              <!-- Nav item -->
              <li class="nav-item">
                  <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navForum" aria-expanded="false" aria-controls="navForum">
                  <i class="nav-icon mdi mdi-comment-multiple-outline me-2"></i> Forum
                  </a>
                  <div id="navForum" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'forummc' || $_SESSION['pages'] == 'forumcourse') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">

                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'forumcourse') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-forum-course.php">Course</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'forummc') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-forum-mc.php">Micro-Credential</a>
                          </li>

                      </ul>
                  </div>
              </li>




          </ul>

      </div>
  </nav>