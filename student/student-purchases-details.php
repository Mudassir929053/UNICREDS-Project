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

    $payment_history = $conn->query(
        "SELECT * 
         FROM `transactions` AS TS 
         WHERE TS.transaction_id = {$_GET["order_id"]} 
         ORDER BY TS.created DESC;"
    );

    $ph_info = $payment_history->fetch_all(MYSQLI_ASSOC)[0];
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
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <a href="student-purchases.php" class="text-muted fs-3">
                                <i class="fe fe-arrow-left"></i>
                            </a>
                            <h4 class="mb-0">Receipt for Transaction ID: <span class="text-warning"><?= $ph_info["transaction_id"] ?></span></h4>
                        </div>
                        <!-- Card body -->
                        <div class="card-body" id="invoice">
                            <div class="mb-6">
                                <div class="d-flex justify-content-between mb-3">
                                    <img src="../assets/images/logo/logo 1.png" alt="" class="img-4by3-md">
                                    <a href="#" class="text-muted print-link no-print">
                                        <i class="fe fe-printer fs-3" data-bs-toggle="tooltip" data-placement="top" title="Print receipt"></i>
                                    </a>
                                </div>
                                <h4 class="mb-1 mt-1">UNICREDS</h4>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <small class="text-uppercase">Transaction ID: <span class="text-dark fw-medium"><?= $ph_info["transaction_id"] ?></span></small>
                                        <br>
                                        <small class="text-uppercase">Reference ID: <span class="text-dark fw-medium"><?= $ph_info["txn_id"] !== NULL ? $ph_info["txn_id"] : "<em class='text-muted'>Not specified</em>" ?></span></small>
                                    </div>
                                    <div>
                                        <small class="text-uppercase">Time: <span class="text-dark fw-medium"><?= date_format(date_create($ph_info["created"]), "h:i a") ?></span></small>
                                        <br>
                                        <small class="text-uppercase">Date: <span class="text-dark fw-medium"><?= date_format(date_create($ph_info["created"]), "d/m/Y") ?></span></small>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                            <div class="row mb-5">
                                <div class="col-md-8 col-12">
                                    <span class="fs-6">From</span>
                                    <h5 class="mb-0">EDESS Sdn Bhd</h5>
                                    <small>edessmalaysia@edess.asia</small>
                                    <p class="mt-3">201, Level 2, Industry Centre,<br>UTM Technovation Park,<br>81300 Skudai, Johor Darul Takzim</p>
                                </div>
                                <div class="col-md-4 col-12">
                                    <span class="fs-6">To</span>
                                    <h5 class="mb-0"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></h5>
                                    <small><?= $suInfoRow["su_email"] ?></small>
                                    <?php
                                    if ($suInfoRow["su_address"] !== NULL) {
                                    ?>
                                        <p class="mt-3">
                                            <?= $suInfoRow["su_address"] ?> <br>
                                            <?= $suInfoRow["postcode_number"] ?> <?= $suInfoRow["city_name"] ?>, <br>
                                            <?= $suInfoRow["state_name"] ?>, <?= $suInfoRow["country_name"] ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Table -->
                            <div class="table-responsive mb-12">
                                <table class="table mb-0 text-nowrap table-borderless">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Course Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $transactionId = 1; // Replace with the actual transaction ID

                                        // Query to fetch data from cart_order_course table
                                        $cocQuery = "SELECT * FROM cart_order_course LEFT JOIN course ON cart_order_course.c_id = course.course_id WHERE 
             WHERE transaction_id = $transactionId";

                                        $cocResult = $conn->query($cocQuery);

                                        // Query to fetch data from cart_order_ep table
                                        $epQuery = "SELECT order_id, ep_id, cost, discount, transaction_id, createdAt, updatedAt
            FROM cart_order_ep
            WHERE transaction_id = $transactionId";

                                        $epResult = $conn->query($epQuery);

                                        // Query to fetch data from cart_order_mc table
                                        $mcQuery = "SELECT order_id, mc_id, cost, discount, transaction_id, createdAt, updatedAt
            FROM cart_order_mc
            WHERE transaction_id = $transactionId";

                                        $mcResult = $conn->query($mcQuery);

                                        $item = array();

                                        // Fetch data from cart_order_course table
                                        if ($cocResult && $cocResult->num_rows > 0) {
                                            while ($row = $cocResult->fetch_assoc()) {
                                                $data = array(
                                                    "order_id" => $row["course_title"],
                                                    "item_id" => $row["c_id"],
                                                    "cost" => $row["cost"],
                                                    "discount" => $row["discount"],
                                                    "transaction_id" => $row["transaction_id"],
                                                    "type" => "Course"
                                                );

                                                $item[] = $data;
                                            }
                                        }

                                        // Fetch data from cart_order_ep table
                                        if ($epResult && $epResult->num_rows > 0) {
                                            while ($row = $epResult->fetch_assoc()) {
                                                $data = array(
                                                    "order_id" => $row["order_id"],
                                                    "item_id" => $row["ep_id"],
                                                    "cost" => $row["cost"],
                                                    "discount" => $row["discount"],
                                                    "transaction_id" => $row["transaction_id"],
                                                    "type" => "EP"
                                                );

                                                $item[] = $data;
                                            }
                                        }

                                        // Fetch data from cart_order_mc table
                                        if ($mcResult && $mcResult->num_rows > 0) {
                                            while ($row = $mcResult->fetch_assoc()) {
                                                $data = array(
                                                    "order_id" => $row["order_id"],
                                                    "item_id" => $row["mc_id"],
                                                    "cost" => $row["cost"],
                                                    "discount" => $row["discount"],
                                                    "transaction_id" => $row["transaction_id"],
                                                    "type" => "Micro-credential"
                                                );

                                                $item[] = $data;
                                            }
                                        }

                                        // Display the fetched data
                                        if (!empty($item)) {
                                            foreach ($item as $val) {
                                        ?>
                                                <tr class="text-dark">
                                                    <td><?= $val["order_id"] ?></td>
                                                    <td><?= $val["type"] ?></td>
                                                    <td><?= $val["cost"] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "No items found for the transaction ID: $transactionId";
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="pb-0">Total</td>
                                            <td class="pb-0">RM <?= $ph_info["item_price"] ?></td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="py-0">Discount</td>
                                            <td class="py-0">RM <?= $ph_info["item_discount"] ?: 'RM 0.00' ?></td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="pt-0">Tax*</td>
                                            <td class="pt-0">RM 0.00</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="border-top py-1 fw-bold">Grand Total</td>
                                            <td class="border-top py-1 fw-bold">RM <?= $ph_info["paid_amount"] ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Short note -->
                            <p class="border-top pt-3 mb-0 ">
                                Notes: Invoice was created on a computer and is valid without the signature and seal.
                            </p>
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
    <!-- Security JS -->
    <script src="js/student-security.js"></script>
</body>

</html>