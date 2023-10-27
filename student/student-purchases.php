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
                    <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header border-bottom">
                            <h3 class="mb-0">Purchases</h3>
                            <p class="mb-0">List of all the purchases that you have made.</p>
                        </div>
                        <?php
                        $payment_history = $conn->query(
                            "SELECT * 
                        FROM `transactions` AS TS 
                        WHERE TS.suid = {$suInfoRow["su_user_id"]} 
                        ORDER BY TS.created DESC;"
                        );

                        if ($payment_history->num_rows > 0) {
                        ?>
                            <!-- Table -->
                            <div class="table-invoice table-responsive border-0">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-warning">
                                        <tr>
                                            <th scope="col" class="border-bottom-0 text-uppercase text-center">Transaction ID</th>
                                            <th scope="col" class="border-bottom-0 text-uppercase text-center">Date</th>
                                            <th scope="col" class="border-bottom-0 text-uppercase text-center">Amount</th>
                                            <th scope="col" class="border-bottom-0 text-uppercase text-center">View Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($payment_history->fetch_all(MYSQLI_ASSOC) as $val) {
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $val["txn_id"] ?>
                                                </td>
                                                <td class="text-center"><?= date_format(date_create($val["created"]), "j F Y, g:i a") ?></td>
                                                <td class="text-center"><strong>RM</strong> <?= $val["paid_amount"] ?></td>
                                                <td class="text-center">
                                                    <?php if ($val['payment_status'] == 'succeeded') {
                                                    ?>
                                                        <button class="btn btn-sm btn-warning text-white fw-bold">
                                                            <a href="student-purchases-details.php?order_id=<?= $val["transaction_id"] ?>">
                                                                View Bill
                                                            </a>
                                                        </button>
                                                    <?php         } else { ?>
                                                        <button class="btn btn-sm btn-primary text-white fw-bold">
                                                            <a href="student-purchases-details.php?order_id=<?= $val["transaction_id"] ?>">
                                                                View Bill
                                                            </a>
                                                        </button>
                                                    <?php     }
                                                    ?>

                                                </td>

                                            </tr>
                                        <?php
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
                                <div class="col-lg-10 col-md-12 col-12 text-center">
                                    <h2 class="mb-2 display-5 fw-bold">Oops! You didn't have any purchases.</h2>
                                    <p class="lead text-dark">
                                        Start browsing in <a href="course-lists.php" class="text-inherit">courses</a> and <a href="micro-creds-lists.php" class="text-inherit">micro-credentials</a> and <a href="micro-creds-lists.php" class="text-inherit">Employability-Program</a> now!
                                    </p>
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

    <!-- Footer -->
    <?php
    include('pages-footer.php');
    ?>


    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Security JS -->
    <script src="js/student-security.js"></script>
</body>

</html>