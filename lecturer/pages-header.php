<?php


if (isset($_SESSION['sess_lecturerid'])) {
    $lecturerheader = $_SESSION['sess_lecturerid'];
    $querylecturer = $conn->query("SELECT * FROM lecturer 
     WHERE lecturer_id = '$lecturerheader';");

    if (mysqli_num_rows($querylecturer) > 0) {
        $row = mysqli_fetch_object($querylecturer);
        $lecturerfname = $row->lecturer_fname;
        $lectureremail  = $row->lecturer_email;
    } else {
        $lecturerfname = " ";
        $lectureremail = " ";
        $lecturer_profile_picture = "";
    }
}

?>

<?php $lecturer_id = $_SESSION['sess_lecturerid']; ?>

<div class="header">

    <div class="topbar">

        <!-- navbar -->
        <nav class="navbar-default navbar navbar-expand-lg">
            <a id="nav-toggle" href="#">
                <i class="fe fe-menu"></i>
            </a>
            <!-- <div class="ms-lg-3 d-none d-md-none d-lg-block">
                <form class="d-flex align-items-center">
                    <span class="position-absolute ps-3 search-icon">
                        <i class="fe fe-search"></i>
                    </span>
                    <input type="search" class="form-control form-control-sm ps-6" placeholder="Search Entire Dashboard" />
                </form>
            </div> -->
            <!--Navbar nav -->
            <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                <li class="dropdown stopevent">
                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe fe-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg" aria-labelledby="dropdownNotification">
                        <div class=" ">
                            <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                <span class="h4 mb-0">Notifications</span>
                                <!-- <a href="# " class="text-muted">
                                    <span class="align-middle">
                                        <i class="fe fe-settings me-1"></i>
                                    </span>
                                </a> -->
                            </div>
                            <!-- List group -->


                            <?php
                            // Assuming you have a database connection established

                            // Query to retrieve announcements from the database
                            $query = "SELECT a.`announcement_id`, a.`announcement_title`, a.`announcement_receiver`, a.`announcement_message`, a.`announcement_attachment`, a.`announcement_created_by`, a.`announcement_created_date`, a.`announcement_updated_date`, c.`committee_logo` FROM `announcement_committee` AS a
          INNER JOIN `committee` AS c ON a.`announcement_created_by` = c.`committee_id` 
          WHERE a.`announcement_receiver` IN ('5,7', '5')
          ORDER BY a.`announcement_created_date` DESC
          LIMIT 2";

                            // Execute the query
                            $result = mysqli_query($conn, $query);

                            // Check if the query was successful
                            if ($result) {
                                // Loop through the result and display each announcement
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $announcementTitle = $row['announcement_title'];
                                    $announcementMessage = $row['announcement_message'];
                                    $announcementCreatedDate = $row['announcement_created_date'];
                                    $committeeLogo = $row['committee_logo'];

                                    // Output the announcement information
                                    echo '<ul class="list-group list-group-flush ">';
                                    echo '    <li class="list-group-item bg-light">';
                                    echo '        <div class="row">';
                                    echo '            <div class="col">';
                                    echo '                <a class="text-body" href="#">';
                                    echo '                    <div class="d-flex">';
                                    echo '                        <img src="../assets/images/avatar/' . $committeeLogo . '" alt="" class="avatar-md rounded-circle" />';
                                    echo '                        <div class="ms-3">';
                                    echo '                            <h5 class="fw-bold mb-1">' . $announcementTitle . '</h5>';
                                    echo '                            <p class="mb-3">' . $announcementMessage . '</p>';
                                    echo '                            <span class="fs-6 text-muted">';
                                    echo '                                <span><span class=" text-success me-1"></span>' . $announcementCreatedDate . '</span>';
                                    echo '                            </span>';
                                    echo '                        </div>';
                                    echo '                    </div>';
                                    echo '                </a>';
                                    echo '            </div>';
                                    echo '            <div class="col-auto text-center me-2">';
                                    echo '                <div>';
                                    echo '                    <a href="#" class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">';
                                    echo '                        <i class="fe fe-x text-muted"></i>';
                                    echo '                    </a>';
                                    echo '                </div>';
                                    echo '            </div>';
                                    echo '        </div>';
                                    echo '    </li>';
                                    echo '</ul>';
                                }

                                // Free the result set
                                mysqli_free_result($result);
                            } else {
                                // Error occurred while executing the query
                                echo 'Error: ' . mysqli_error($conn);
                            }

                            // Close the database connection
                            // mysqli_close($conn);
                            ?>






                            <div class="border-top px-3 pt-3 pb-0">
                                <a href="pages-notifications.php" class="text-link fw-semi-bold">
                                    See all Notifications
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- List -->
                <li class="dropdown ms-2">
                    <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <?php
                            $sqlProfilePic = $conn->query("SELECT lecturer_profile_picture FROM lecturer WHERE lecturer_id = '$lecturer_id'");

                            $checklectureravatar = mysqli_fetch_object($sqlProfilePic);

                            if ($checklectureravatar->lecturer_profile_picture != NULL) {
                                $ProfilePic = '../assets/images/avatar/' . $checklectureravatar->lecturer_profile_picture;
                            } else {
                                $ProfilePic = '../assets/images/avatar/avatardefault.png';
                            }
                            ?>
                            <img alt="avatar" src="<?php echo $ProfilePic; ?>" class="rounded-circle" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <div class="dropdown-item">
                            <div class="d-flex">
                                <div class="avatar avatar-md avatar-indicators avatar-online">
                                    <img alt="avatar" src="<?php echo $ProfilePic; ?>" class="rounded-circle" />
                                </div>
                                <div class="ms-3 lh-1">

                                    <h5 class="mb-1"><?php echo $lecturerfname; ?></h5>
                                    <p class="mb-0 text-muted"><?php echo $lectureremail; ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                            <!-- <li class="dropdown-submenu dropstart-lg">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                    <i class="fe fe-circle me-2"></i> Status
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="badge-dot bg-success me-2"></span> Online
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="badge-dot bg-secondary me-2"></span> Offline
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="badge-dot bg-warning me-2"></span> Away
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="badge-dot bg-danger me-2"></span> Busy
                        </a>
                    </li>
                </ul>
            </li> -->
                            <li>
                                <a class="<?php
                                            if ($_SESSION['pages'] == 'profile') {
                                                echo ('active');
                                            }
                                            ?> dropdown-item" href="../lecturer/lecturer-update-profile.php">
                                    <i class="fe fe-user me-2"></i> Profile
                                </a>
                            </li>
                            <!-- <li>
                <a class="dropdown-item" href="../pages/student-subscriptions.html">
                    <i class="fe fe-star me-2"></i> Subscription
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                    <i class="fe fe-settings me-2"></i> Settings
                </a>
            </li> -->
                        </ul>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                            <li>

                                <a class="dropdown-item" href="../logout.php">

                                    <i class="fe fe-power me-2"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Page Header -->