<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
?>

<body>
    <!-- Navbar -->
<?php
    include('pages-topbar.php');

    $date_time = $_GET["date_created"];
    $date = explode(" ", $date_time)[0];
    $time = explode(" ", $date_time)[1];
?>

    <!-- Page Header -->
    <div class="py-4 py-lg-6 bg-warning">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="text-dark display-4 mb-0">Payment Receipt</h1>
                        <h1 class="mb-0"><a href="student-home-page.php" class="text-inherit"><i class="fe fe-arrow-right" data-bs-toggle="tooltip" data-placement="top" title="Go to home page"></i></a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="card-header border-bottom">
                            <h4 class="mb-0">Payment Details</h4>
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
                                        <small class="text-uppercase">Transaction ID: <span class="text-dark fw-medium"><?= $_GET["transaction_id"] ?></span></small>
                                        <br>
                                        <small class="text-uppercase">Reference ID: <span class="text-dark fw-medium"><?= $_GET["reference_id"] ?></span></small>
                                    </div>
                                    <div>
                                        <small class="text-uppercase">Time: <span class="text-dark fw-medium"><?= date_format(date_create($date_time), "h:i a") ?></span></small>
                                        <br>
                                        <small class="text-uppercase">Date: <span class="text-dark fw-medium"><?= date_format(date_create($date_time), "d/m/Y") ?></span></small>
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
                                    <h5 class="mb-0"><?= $suInfoRow["su_fname"]." ".$suInfoRow["su_lname"] ?></h5>
                                    <small><?= $suInfoRow["su_email"] ?></small>
                            <?php
                                if($suInfoRow["su_address"] !== NULL) {
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
                                            <th scope="col">Item</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                    $item = array();

                                    $cart_order = $conn->query("SELECT co.order_id, co.order_type FROM `cart_order` AS co WHERE co.transaction_id = '{$_GET["transaction_id"]}';");
                                    $order_info = $cart_order->fetch_all(MYSQLI_ASSOC)[0];

                                    if($order_info["order_type"] === "c") {
                                        $coc = $conn->query("SELECT coc.course_id FROM `cart_order_course` AS coc WHERE coc.order_id = {$order_info["order_id"]};");

                                        foreach($coc->fetch_all(MYSQLI_ASSOC) as $val) {
                                            $data = array();

                                            $course = $courseInfo->fetch_course($val["course_id"]);

                                            $data["title"] = $course["course_title"];
                                            $data["type"] = "Course";
                                            $data["fee"] = feeFormat($course["course_fee"]);

                                            array_push($item, $data);
                                        }
                                    } else if($order_info["order_type"] === "mc") {
                                        $comc = $conn->query("SELECT comc.sub_id FROM `cart_order_mc` AS comc WHERE comc.order_id = {$order_info["order_id"]};");

                                        foreach($comc->fetch_all(MYSQLI_ASSOC) as $val) {
                                            $data = array();

                                            $mc = $mcInfo->fetch_microcredential($val["sub_id"]);

                                            $data["title"] = $mc["mc_title"];
                                            $data["type"] = "Micro-credential";
                                            $data["fee"] = feeFormat($mc["mc_fee"]);

                                            array_push($item, $data);
                                        }
                                    }

                                    foreach($item as $val) {
                                ?>
                                        <tr class="text-dark">
                                            <td class="text-wrap"><?= $val["title"] ?></td>
                                            <td class="fw-medium text-dark"><?= $val["type"] ?></td>
                                            <td><?= $val["fee"] ?></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="pb-0">Total</td>
                                            <td class="pb-0"><?= feeFormat($_GET["total"]) ?></td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="py-0">Discount</td>
                                            <td class="py-0">RM 0.00</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="pt-0">Tax*</td>
                                            <td class="pt-0">RM 0.00</td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td colspan="1"></td>
                                            <td colspan="1" class="border-top py-1 fw-bold">Grand Total</td>
                                            <td class="border-top py-1 fw-bold"><?= feeFormat($_GET["total"]) ?></td>
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
    require_once("pages-footer.php");
?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>

</body>

</html>