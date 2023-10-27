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
                      <i class="nav-icon mdi mdi-view-dashboard me-2"></i> Dashboard
                  </a>

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
              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'employability') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-employability-program.php">
                      <i class="nav-icon mdi mdi-bullhorn me-2"></i> Employability Program
                  </a>
              </li> 
            
              <!-- Nav item -->
              <li class="nav-item ">
                  <a class="nav-link collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navLecturer" aria-expanded="false" aria-controls="navLecturer">
                      <i class="nav-icon fas fa-users-cog me-2"></i> User
                  </a>
                  <div id="navLecturer" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'lecturer' || $_SESSION['pages'] == 'faculty' || $_SESSION['pages'] == 'committee') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'lecturer') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-manage-lecturer.php">
                                  <i class="nav-icon fas fa-chalkboard-teacher me-2"></i>
                                  Manage Lecturer
                              </a>
                          </li>
                          <!-- <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'faculty') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-manage-faculty.php">
                                  <i class="nav-icon bi bi-building me-2"></i>
                                  Manage Faculty
                              </a>
                          </li> -->

                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'committee') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-manage-committee.php">
                                  <i class="nav-icon fas fa-users me-2"></i>
                                  Manage Committee
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <!-- Nav item -->
              <li class="nav-item ">
                  <a class="nav-link collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navbadgecert" aria-expanded="false" aria-controls="navbadgecert">
                      <i class="nav-icon fa fa-certificate me-2"></i> Badge & Certificate
                  </a>
                  <div id="navbadgecert" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'certificate' || $_SESSION['pages'] == 'badge') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'certificate') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-manage-certificate.php">
                                  <!-- <i class="nav-icon fas fa-chalkboard-teacher me-2"></i> -->
                                  Manage Certificate
                              </a>
                          </li>


                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'badge') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="#">
                                  <!-- <i class="nav-icon fas fa-users me-2"></i> -->
                                  Manage Badge
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>  
              <!-- Nav item -->

              <!-- Nav item -->
              <!-- <li class="nav-item">
                <a class="nav-link collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navFaculty" aria-expanded="false" aria-controls="navFaculty">
                <i class="nav-icon bi bi-building me-2"></i></i></i> Faculty
                </a>
                <div id="navFaculty" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="pages-manage-faculty.php">
                                Manage Faculty
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->

              <!-- Nav item -->
              <!-- <li class="nav-item ">
                <a class="nav-link collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navCertificate" aria-expanded="false" aria-controls="navCertificate">
                <i class="nav-icon fa fa-id-card me-2" ></i> Bagdes & Certificate
            </a>
            <div id="navCertificate" class="collapse  " data-bs-parent="#sideNavbar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link   active  " href="pages-manage-certificate.php">
                            Manage Certificate
                        </a>
                    </li>

                </ul>
            </div>
        </li> -->

              <!-- Nav item -->
              <li class="nav-item">
                  <div class="nav-divider"></div>
              </li>
      </div>


  </nav>