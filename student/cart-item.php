<?php
include('function/student-function.php');
$queryUserID = $conn->query("SELECT su_user_id  FROM student_university WHERE su_id = '$suID';");

$userID = mysqli_fetch_object($queryUserID);
$su_userID = $userID->su_user_id;
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

    $cc = $conn->query("SELECT * FROM `cart_course` AS cc 
                        LEFT JOIN `cart` AS cart ON cc.cart_id = cart.id 
                        LEFT JOIN `course` AS c ON cc.course_id = c.course_id 
                        WHERE cart.paid = 0 AND cart.userId = '$su_userID';;");
    $cmc = $conn->query("SELECT * FROM `cart_mc` AS cmc 
                        LEFT JOIN `cart` AS cart ON cmc.cart_id = cart.id 
                        LEFT JOIN `microcredential` AS mc ON cmc.sub_id = mc.mc_id 
                        WHERE cart.paid = 0 AND cart.userId = '$su_userID';;");
    $cep = $conn->query("SELECT * FROM `cart_ep` AS cep 
                         LEFT JOIN `cart` AS cart ON cep.cart_id = cart.id 
                         LEFT JOIN `employability_program` AS ep ON cep.sub_id = ep.ep_id 
                         WHERE cart.paid = 0 AND cart.userId = '$su_userID';;");
    ?>

    <!-- Page Header -->
    <div class="py-4 py-lg-6 bg-warning">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div>
                        <h1 class="text-dark display-4 mb-0">My Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12 cart-list">
                    <?php
                    if ($cc->num_rows == 0 && $cmc->num_rows == 0 && $cep->num_rows == 0) {
                    ?>
                        <div class="d-flex flex-column align-items-center justify-content-center mt-6">
                            <h1 class="text-body fw-bold fs-1">Oops! It seems your cart is empty.</h1>
                            <br>
                            <h1 class="text-body fw-medium">Discover and enroll in <a href="course-lists.php" class="text-inherit">courses</a>, explore exciting <a href="micro-creds-lists.php" class="text-inherit">micro-credentials</a>, and join transformative <a href="ep-list.php" class="text-inherit">Employability Programs</a>.</h1>
                        </div>
                    <?php
                    } else {
                        $cart_items = array();
                        $c_data = array();
                        $mc_data = array();
                        $ep_data = array();


                        // Micro-credential cart items.
                        foreach ($cmc->fetch_all(MYSQLI_ASSOC) as $val) {
                            $data = array();

                            $data["id"] = $val["sub_id"];
                            $data["link"] = "micro-creds-enroll.php?mc_id=" . $val["sub_id"];
                            $data["image"] = "../assets/images/microcredential/" . $val["mc_image"];
                            $data["title"] = $val["mc_title"];
                            $data["type"] = "Micro-credential";
                            $data["duration"] = $val["mc_duration"];
                            $data["credit"] = $val["mc_credit_transfer"] !== NULL ? $val["mc_credit_transfer"] . " credits" : "<span class='text-muted'><em>Not set</em></span>";
                            $data["level"] = acadLevel($val["mc_level"]);
                            $data["fee"] = feeFormat($val["mc_fee"]);
                            $data["date"] = $val["createdAt"];

                            array_push($mc_data, $data);
                        }

                        // Employability Program cart items.
                        foreach ($cep->fetch_all(MYSQLI_ASSOC) as $val) {
                            $data = array();

                            $data["id"] = $val["sub_id"];
                            $data["link"] = "ep-enroll.php?ep_id=" . $val["sub_id"];
                            $data["image"] = "../assets/images/employability_program/epthumbnails/" . $val["ep_cover_attachment"];
                            $data["title"] = $val["ep_title"];
                            $data["type"] = "Employability-Program";
                            $data["duration"] = ''; //$val["ep_duration"];
                            $data["credit"] = ''; //$val["ep_credit_transfer"] !== NULL ? $val["ep_credit_transfer"]." credits" : "<span class='text-muted'><em>Not set</em></span>";
                            $data["level"] = ''; //acadLevel($val["ep_level"]);
                            $data["fee"] = feeFormat($val["ep_fee"]);
                            $data["date"] = $val["createdAt"];

                            array_push($ep_data, $data);
                        }
                        // Course cart items.
                        foreach ($cc->fetch_all(MYSQLI_ASSOC) as $val) {
                            $data = array();

                            $data["id"] = $val["course_id"];
                            $data["link"] = "course-enroll.php?course_id=" . $val["course_id"];
                            $data["image"] = "../assets/images/course/" . $val["course_image"];
                            $data["title"] = $val["course_title"];
                            $data["type"] = "Course";
                            $data["duration"] = $val["course_duration"];
                            $data["credit"] = $val["course_credit"] !== NULL ? $val["course_credit"] . " credits" : "<span class='text-muted'><em>Not set</em></span>";
                            $data["level"] = $val["course_level"] !== NULL ? acadLevel($val["course_level"]) : "<span class='text-muted'><em>Not set</em></span>";
                            $data["fee"] = feeFormat($val["course_fee"]);
                            $data["date"] = $val["createdAt"];

                            array_push($c_data, $data);
                        }

                        // if($cc->num_rows == 0) {
                        //     $cart_items = $mc_data;
                        // } else if($cmc->num_rows == 0) {
                        //     $cart_items = $c_data;
                        // } 
                        // else if($cep->num_rows == 0) {
                        //     $cart_items = $ep_data;
                        // } else {
                        //     $cart_items = array_merge_recursive($mc_data, $c_data,$ep_data);
                        // }
                        $cart_items = array_merge_recursive($mc_data, $c_data, $ep_data);
                        array_multisort(array_column($cart_items, "date"), SORT_DESC, SORT_STRING, $cart_items);

                        // var_dump($cart_items);
                        // exit;
                    ?>
                        <!-- Cart list header -->
                        <div class="card mb-3">
                            <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">List of Cart Items</h4>
                            </div>
                            <div class="card-body px-4 py-3">
                                <table class="table table-borderless m-0">
                                    <thead>
                                        <tr class="table-warning">
                                            <th scope="col" class="text-start w-auto">Items (<?= count($cart_items) ?>)</th>
                                            <th scope="col" width="25%" class="text-center">Fee</th>
                                            <th scope="col" width="10%"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <!-- Cart list content -->
                        <div class="card mb-3">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table id="cart-list-item" class="table">
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($cart_items as $val) {
                                        ?>
                                            <tr>
                                                <td class="width-auto">
                                                    <div class="d-flex">
                                                        <a href="<?= $val["link"] ?>">
                                                            <img alt="avatar" src="<?= $val["image"] ?>" class="rounded img-4by3-lg" />
                                                        </a>
                                                        <div class="ms-3">
                                                            <div class="mb-1">
                                                                <h4 class="m-0">
                                                                    <a href="<?= $val["link"] ?>" class="text-inherit"><?= $val["title"] ?></a>
                                                                </h4>
                                                                <small class="fw-medium text-muted"><em><?= $val["type"] ?></em></small>
                                                            </div>
                                                            <?php if ($val["duration"]) { ?>
                                                                <dl class="row mb-0">
                                                                    <dt class="col-sm-5">Duration :</dt>
                                                                    <dl class="col-sm-7 mb-0"><?= $val["duration"] ?></dl>

                                                                    <!-- <dt class="col-sm-5">Credit :</dt>
                                                        <dl class="col-sm-7 mb-0"><?= $val["credit"] ?></dl> -->

                                                                    <dt class="col-sm-5">Level :</dt>
                                                                    <dl class="col-sm-7 mb-0"><?= $val["level"] ?></dl>
                                                                </dl>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="25%" class="text-center fee"><?= $val["fee"] ?></td>
                                                <td class="text-end" width="10%">
                                                    <a type="button" class="btn btn-danger btn-icon remove" data-id="<?= $val["id"] ?>" data-type="<?= $val["type"] ?>">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>

                        <!-- Cart list footer -->
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-borderless m-0">
                                    <thead>
                                        <tr class="table-warning">
                                            <td scope="col" class="text-start w-auto"></td>
                                            <td scope="col" width="25%" class="text-center text-muted">
                                                Total: <span id="total-fee" class="text-dark fw-medium">RM 0.00</span>
                                            </td>
                                            <td scope="col" width="10%" class="text-end">
                                                <!-- <i class="fe fe-trash text-danger" data-bs-toggle="tooltip" data-placement="top" title="Remove Selected Item" style="cursor: pointer;"></i> -->
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="mt-3 text-end">
                                    <button id="checkout" type="button" class="btn btn-warning btn-sm w-25 fs-4">
                                        Check Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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

    <!-- Payment JS -->
    <script>
        /**
         * Calculate the total fee.
         */
        function calc_total() {
            var total_fee = 0;

            $("tbody tr").each(function() {
                var fee = ($(this).find("td.fee").text()).split(" ");

                total_fee += parseFloat(fee[1]);
            });

            return total_fee.toFixed(2);
        }

        /**
         * Print the total price. 
         */
        $("span#total-fee").html("RM " + calc_total());

        /**
         * Go to Checkout page.
         */
        $("button#checkout").on("click", function() {
            location = "cart-checkout.php";
        });

        /**
         * Remove item from cart.
         */
        $("a.remove").on("click", function() {
            var curr_elem = $(this);

            var id = $(this).data("id");
            var type = $(this).data("type");

            $.ajax({
                url: "function/payment.php",
                type: "POST",
                data: {
                    removeItem: "",
                    id: id,
                    type: type
                },
                dataType: "",
                beforeSend: function() {
                    // do something...
                },
                success: function(data) {
                    if (data == "success") {
                        curr_elem.closest("tr").remove();
                        $("span#total-fee").html("RM " + calc_total());

                        if (calc_total() == "0.00") {
                            $("div.cart-list").html(
                                '<div class="d-flex flex-column align-items-center justify-content-center mt-6">' +
                                '<h1 class="text-body fw-bold fs-1">Oops! It seems your cart is empty.</h1>' +
                                '<br>' +
                                '<h1 class="text-body fw-medium">Discover and enroll in <a href="course-lists.php" class="text-inherit">courses</a>, explore exciting <a href="micro-creds-lists.php" class="text-inherit">micro-credentials</a>, and join transformative <a href="ep-list.php" class="text-inherit">Employability Programs</a>.</h1>' +
                                '</div>'
                            );
                        }
                    }

                    footer_display();
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                    alert(error.message);
                },
                complete: function() {
                    // do something...
                }
            });
        });
    </script>

</body>

</html>