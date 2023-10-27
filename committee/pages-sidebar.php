  <!-- Sidebar -->
  <nav class="navbar-vertical navbar">
      <div class="nav-scroller">
          <!-- Brand logo -->
          <a class="navbar-brand" href="../index.html">
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
                      <i class="nav-icon fas fa-chart-pie  me-2"></i> Dashboard
                  </a>

              </li>


              <!-- Nav item -->

              <li class="nav-item">
                  <a class="nav-link  " href="#!" data-bs-toggle="collapse" data-bs-target="#mc" aria-expanded="false" aria-controls="navDashboard">
                  <i class="nav-icon fe fe-book me-2"></i> Micro-Credential
                  </a>
                  <div id="mc" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'mcreview' || $_SESSION['pages'] == 'mcregister') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column ">
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'mcregister') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-microcredential-list.php"> Register Micro-Credential</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'mcreview') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-microcredential-review.php">Review Request</a>
                          </li>
                          
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'course') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-course-list.php">
                      <i class="nav-icon fe fe-book-open me-2"></i> Course
                  </a>
              </li>

            
              <!-- Nav item -->
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

      </div>


  </nav>