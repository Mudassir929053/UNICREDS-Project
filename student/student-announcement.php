<?php
include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('pages-head.php');
?>

<body>
    <!-- Top navigation -->
    <?php
    include('pages-topbar.php');
    ?>

    <!-- Page Content -->
    <div class="pt-5 pb-5">
        <div class="container">
            <!-- Student university info -->
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Bg -->
                    <div class="pt-16 rounded-top-md" style="
														background: url(../assets/images/background/profile-bg.jpg) no-repeat;
														background-size: cover;
						">
                    </div>
                    <div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
                        <div class="d-flex align-items-center">
                            <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n8">
                                <span class="avatar avatar-xxl">
                                    <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>" alt="" class="rounded-circle" />
                                </span>
                            </div>
                            <div class="lh-1">
                                <h2 class="mb-0">
                                    <?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?>
                                </h2>
                                <p class="mb-0 d-block"><?= $suInfoRow["su_email"] ?></p>
                            </div>
                        </div>
                        <div>
                            <a href="student-home-page.php" class="btn btn-outline-primary btn-sm d-none d-md-block">
                                Go to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row mt-0 mt-md-4">
                <div class="col-lg-3 col-md-4 col-12">
                    <?php
                    include("student-sidebar.php");
                    ?>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Announcements</h3>
                            <p class="mb-0">List of all the announcements intended for you.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <?php
                            $announcement = $annInfo->fetch_announcements();

                            if ($announcement !== NULL) {
                            ?>
                                <div class="table-responsive">
                                    <table id="dataTableBasic" class="table" style="width:100%" data-searching="false" data-order="[[ 2, &quot;desc&quot; ]]">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" data-orderable="false">From</th>
                                                <th class="text-center">Contents</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center" data-orderable="false">Attachment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($announcement as $val) {
                                            ?>
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span class="avatar avatar-lg">
                                                            <img src="<?= $val["sender_image"] ?>" alt="" class="rounded-circle" data-bs-toggle="tooltip" data-placement="top" title="<?= $val["sender"] ?>" />
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="text-truncate-line-2 mb-0">
                                                            <?= $val["message"] ?>
                                                        </div>
                                                        <p class="text-end mb-0">
                                                            <a href="#" class="text-end text-inherit fw-medium" data-bs-toggle="modal" data-bs-target="#announcementDetails<?= $i + 1 ?>"><small>Show details</small></a>
                                                        </p>
                                                        <div class="modal fade" id="announcementDetails<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-labelledby="announcementDetailsTitle<?= $i + 1 ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="announcementDetailsTitle<?= $i + 1 ?>">Announcement from <?= $val["sender_name"] ?></h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="d-flex flex-column text-center mb-3">
                                                                            <p class="mb-0 text-body fw-bold"><?= date_format(date_create($val["created_date"]), "g:i a, d F Y") ?></p>
                                                                            <p class="fs-3 mb-0 text-body fw-medium"><?= $val["title"] ?></p>
                                                                        </div>
                                                                        <div class="text-dark mb-3 bg-light rounded p-3">
                                                                            <?= $val["message"] ?>
                                                                        </div>
                                                                        <div class="text-dark mb-3 rounded p-3">
                                                                            <?php
                                                                            if ($val["attachment"] !== NULL) {
                                                                            ?>
                                                                                <a href="../assets/attachment/announcement/<?= $val["attachment"] ?>" target="_blank">
                                                                                    <span class="btn btn-sm bg-primary text-white bold">View attachment</span>
                                                                                </a>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span class="btn btn-sm bg-secondary text-white bold">No attachment</span>
                                                                            <?php
                                                                            } ?>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end">
                                                                            <div class="d-flex flex-column">
                                                                                <small class="fw-bold mb-2">From <?= $val["sender"] ?></small>
                                                                                <h5 class="mb-0 text-body fw-medium"><?= $val["sender_name"] ?></h5>
                                                                                <p class="fs-5 mb-0 text-body"><?= $val["sender_email"] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <?= date_format(date_create($val["created_date"]), "d/m/Y") ?>
                                                    </td>
                                                    <td class="align-middle text-center fs-4">
                                                        <?php
                                                        if ($val["attachment"] !== NULL) {
                                                        ?>
                                                            <a href="../assets/attachment/announcement/<?= $val["attachment"] ?>" target="_blank">
                                                                <span class="badge bg-info">View attachment</span>
                                                            </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge bg-secondary">No attachment</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            <?php
                            } else {
                            ?>
                                <!-- No contents -->
                                <div class="d-flex mt-4 mb-3 justify-content-center">
                                    <div class="col-lg-8 col-md-12 col-12 text-center">
                                        <h2 class="mb-2 display-5 fw-bold">Oops! There are no announcements for you.</h2>
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

    <!-- Footer -->
    <?php
    include('pages-footer.php');
    ?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>