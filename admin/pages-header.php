<script>
    <?php
    if (!isset($_SESSION['sess_adminid'])) {
    ?>
        location.href = "../session-expired.php";
    <?php
    }
    ?>
</script>

<?php
if (isset($_SESSION['sess_adminid'])) {
    $adminheader = $_SESSION['sess_adminid'];
    $queryadmin = $conn->query("SELECT * FROM admin 
       WHERE admin_id = '$adminheader';");

    if (mysqli_num_rows($queryadmin) > 0) {
        $row = mysqli_fetch_object($queryadmin);
        $adminname = $row->admin_name;
        $adminemail  = $row->admin_email;
    } else {
        $adminname = " ";
        $adminemail = " ";
    }
}

?>


<?php $admin_id = $_SESSION['sess_adminid']; ?>






<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg">
        <a id="nav-toggle" href="#">
            <i class="fe fe-menu"></i>
        </a>

        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
           
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <?php
                        $sqlProfilePic = $conn->query("SELECT admin_logo FROM admin WHERE admin_id = '$admin_id'");

                        $checkadminavatar = mysqli_fetch_object($sqlProfilePic);

                        if ($checkadminavatar->admin_logo != NULL) {
                            $ProfilePic = 'images/profilepicture/' . $checkadminavatar->admin_logo;
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
                                <h5 class="mb-1"><?php echo $adminname;  ?></h5>
                                <p class="mb-0 text-muted"><?php echo $adminemail; ?></p>
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
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-user me-2"></i> Profile
                            </a>
                        </li>
                        <!--  <li>
                <a class="dropdown-item" href="../pages/student-subscriptions.html">
                    <i class="fe fe-star me-2"></i> Subscription
                </a>
            </li> -->
                        <!-- <li>
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