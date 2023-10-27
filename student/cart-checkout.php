<?php
    include('function/student-function.php');
require_once '../stripe/config.php';


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

    $cart_items = array();
    $c_data = array();
    $mc_data = array();
    $cep_data = array();


    if(isset($_GET["r"])) {
        if($_GET["r"] === "microcredential") {
            $cmc = $conn->query("SELECT * FROM `cart_mc` AS cmc 
                                LEFT JOIN `cart` AS cart ON cmc.cart_id = cart.id 
                                LEFT JOIN `microcredential` AS mc ON cmc.sub_id = mc.mc_id 
                                WHERE cart.paid = 1 AND cart.userId = '$su_userID'; ");
        } else if($_GET["r"] === "course") {
            $cc = $conn->query("SELECT * FROM `cart_course` AS cc 
                                LEFT JOIN `cart` AS cart ON cc.cart_id = cart.id 
                                LEFT JOIN `course` AS c ON cc.course_id = c.course_id 
                                WHERE cart.paid = 1 AND cart.userId = '$su_userID';");
        }
        else if($_GET["r"] === "employability") {
            $cep = $conn->query("SELECT * FROM `cart_ep` AS cep
                                LEFT JOIN `cart` AS cart ON cep.cart_id = cart.id 
                                LEFT JOIN `employability_program` AS ep ON cep.sub_id = ep.ep_id 
                                WHERE cart.paid = 1 AND cart.userId = '$su_userID';");
        }
    } else {
        $cc = $conn->query("SELECT * FROM `cart_course` AS cc 
                            LEFT JOIN `cart` AS cart ON cc.cart_id = cart.id 
                            LEFT JOIN `course` AS c ON cc.course_id = c.course_id 
                            WHERE cart.paid = 0 AND cart.userId = '$su_userID';");
        $cmc = $conn->query("SELECT * FROM `cart_mc` AS cmc 
                            LEFT JOIN `cart` AS cart ON cmc.cart_id = cart.id 
                            LEFT JOIN `microcredential` AS mc ON cmc.sub_id = mc.mc_id 
                            WHERE cart.paid = 0 AND cart.userId = '$su_userID';");
        $cep = $conn->query("SELECT * FROM `cart_ep` AS cep
        LEFT JOIN `cart` AS cart ON cep.cart_id = cart.id 
        LEFT JOIN `employability_program` AS ep ON cep.sub_id = ep.ep_id 
        WHERE cart.paid = 0 AND cart.userId = '$su_userID';");
    }

    // Micro-credential cart items.
    if(isset($cmc)) {
        foreach($cmc->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();
    
            $data["image"] = "../assets/images/microcredential/".$val["mc_image"];
            $data["title"] = $val["mc_title"];
            $data["duration"] = $val["mc_duration"];
            $data["credit"] = $val["mc_credit_transfer"] !== NULL ? $val["mc_credit_transfer"]." credits" : "<span class='text-muted'><em>Not set</em></span>";
            $data["level"] = acadLevel($val["mc_level"]);
            $data["fee"] = feeFormat($val["mc_fee"]);
            $data["date"] = $val["createdAt"];
    
            array_push($mc_data, $data);
        }
    }

    // Employability-Program cart items.
    if(isset($cep)) {
        foreach($cep->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();
    
            $data["image"] = "../assets/images/employability_program/epthumbnails/".$val["ep_cover_attachment"];
            $data["title"] = $val["ep_title"];
            $data["duration"] = '';//$val["ep_duration"];
            $data["credit"] = '';//$val["ep_credit_transfer"] !== NULL ? $val["ep_credit_transfer"]." credits" : "<span class='text-muted'><em>Not set</em></span>";
            $data["level"] = '';//acadLevel($val["ep_level"]);
            $data["fee"] = feeFormat($val["ep_fee"]);
            $data["date"] = $val["createdAt"];
    
            array_push($cep_data, $data);
        }
    }

    // Course cart items.
    if(isset($cc)) {
        foreach($cc->fetch_all(MYSQLI_ASSOC) as $val) {
            $data = array();
    
            $data["image"] = "../assets/images/course/".$val["course_image"];
            $data["title"] = $val["course_title"];
            $data["duration"] = $val["course_duration"];
            $data["credit"] = $val["course_credit"] !== NULL ? $val["course_credit"]." credits" : "<span class='text-muted'><em>Not set</em></span>";
            $data["level"] = $val["course_level"] !== NULL ? acadLevel($val["course_level"]) : "<span class='text-muted'><em>Not set</em></span>";
            $data["fee"] = feeFormat($val["course_fee"]);
            $data["date"] = $val["createdAt"];
    
            array_push($c_data, $data);
        }
    }

    // if(!isset($cc) || $cc->num_rows == 0) {
    //     $cart_items = $mc_data;
    // } else if(!isset($cmc) || $cmc->num_rows == 0) {
    //     $cart_items = $c_data;
    // } else {
    //     $cart_items = array_merge_recursive($mc_data, $c_data);
    // }
    $cart_items = array_merge_recursive($mc_data, $c_data,$cep_data);
    array_multisort(array_column($cart_items, "date"), SORT_DESC, SORT_STRING, $cart_items);
?>

    <!-- Page header -->
    <div class="py-lg-6 py-4 bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="text-dark display-4 mb-0">Check Out</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-3 mb-lg-0">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Order Details</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <h4 class="mb-3 text-body">List of items</h4>

                            <div id="item-list" class="row">
                                <!-- Item list -->
                        <?php
                            foreach($cart_items as $val) {
                        ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="card mb-4 card-hover border">
                                        <div class="d-flex justify-content-between align-items-center p-4">
                                            <div class="d-flex w-100">
                                                <div>
                                                    <img alt="avatar" src="<?= $val["image"] ?>" class="rounded img-4by3-lg" />
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 text-truncate-line-2">
                                                        <span class="text-inherit"><?= $val["title"] ?></span>
                                                    </h4>
                                                    <?php if($val["duration"]){ ?>
                                                    <p class="mb-0 fs-6 d-flex flex-column">
                                                        <span class="me-2">Duration <span class="text-dark fw-medium">: <?= $val["duration"] ?></span></span>
                                                        <!-- <span class="me-2">Credit <span class="text-dark fw-medium">: <?= $val["credit"] ?></span></span> -->
                                                        <span>Level <span class="text-dark fw-medium">: <?= $val["level"] ?></span></span>
                                                    </p>
                                                    <?php } ?>
                                                    <p class="mb-0 mt-1 fs-5 text-dark fw-medium fee"><?= $val["fee"] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                            </div>
                        </div>
                        <!-- Payment method -->
                        <!-- <form> -->
                        <!-- <div class="card-footer border-top">
                            <h4 class="mb-3 text-body">Choose payment method</h4>

                            <div class="d-flex mb-2">
                                <div class="me-3">
                                    <input type="radio" class="btn-check" name="paymentmethod" value="BP-FKR01" id="billplz" autocomplete="off" required>
                                    <label class="btn btn-outline-warning" for="billplz">
                                        <span class="avatar avatar-lg">
                                            <img alt="avatar" src="../assets/images/creditcard/billplz.png" class="rounded" />
                                        </span>
                                        <br>
                                        BillPlz
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="paymentmethod" value="BP-PPL01" id="paypal" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="paypal">
                                        <span class="avatar avatar-lg">
                                            <img alt="avatar" src="../assets/images/creditcard/paypal.svg" class="rounded" />
                                        </span>
                                        <br>
                                        PayPal
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Billing details -->
                    <div class="card  border-0 mb-3">
                        <!-- Card body -->
                        <div class="px-3 py-5">
                            <div class="text-center">
                                <span class="badge bg-warning fs-4">Billing Details</span>
                                <h2 class="mt-3 mb-1 fw-bold"><?= $suInfoRow["su_fname"]." ".$suInfoRow["su_lname"] ?></h2>
                                <p class="fs-4"><?= $suInfoRow["su_email"] ?></p>
                            </div>
                        </div>
                        <div class="border-top p-3 mb-2">
                            <h4 class="fw-bold mb-4">Total payment:</h4>
                            <div class="d-flex justify-content-center">
                                <span class="h3 mb-0 fw-bold text-primary">RM</span>
                                <div id="total-fee" class="display-4 fw-bold text-primary">0.00</div>
                            </div>
                        </div>
                    </div>
                    <!-- Discount -->
                    <!-- <div class="card border-0 mb-3">
                      
                        <div class="card-body">
                            <h3 class="mb-2">Discount Codes</h3>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter your code" aria-describedby="couponCode">
                                    <button class="btn btn-secondary" id="couponCode">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div> -->
                    <div class="mb-lg-0">
                        <!-- <a href="stripe/public/checkout.html" class="btn btn-warning w-100 fs-3 text-dark">Place Order</a> -->
                        <div id="paymentResponse" class="hidden"></div>
                        <button class="stripe-button btn btn-warning w-100 fs-3 text-dark" id="payButton">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="buttonText">Place Order</span>
                        </button>
                    </div>
                    <!-- </form> -->
                    <div class="col-md-12 col-12 d-flex align-items-center mt-2">
                        <small class="mb-0">
                            By completing your purchase, you agree to these <a href="#">Terms of Service.</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
	    <!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');
    // Select payment button
    const payBtn = document.querySelector("#payButton");
    // Payment request handler
    payBtn.addEventListener("click", function(evt) {
        setLoading(true);
        createCheckoutSession().then(function(data) {
            console.log("data: ", data);
            if (data && data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        }).catch(function(error) {
            console.error(error);
            setLoading(false);
        });
    });
// Create a Checkout Session with the selected product
const createCheckoutSession = function() {
  const userID = <?php echo $su_userID?>;
  // Fetch the product data from the server
  return fetch('get_products.php')
    .then(response => response.json())
    .then(data => {

      // Use the returned data to create the products array
      const products = data.map(product => {
        return {
          id: product.id,
          name: product.title,
          price: product.fee,
        //   image: product.image,
          type: product.coursetype,
          enrolluserid: product.enrolluserid,
          cartid:product.cartid,
        };
      });
      // Check for zero price
      const hasZeroPrice = products.some(product => product.price === 0);
      if (hasZeroPrice) {
        console.error("Product price cannot be zero");
        throw new Error("Product price cannot be zero");
      }

      // Create the Checkout Session with the selected product
      return fetch("../stripe/payment_init.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          createCheckoutSession: 1,
          userID: userID,
          products: products,
          type: products[0].type, // add the course type to the request
        }),
      });
    })
    .then(function(result) {
      return result.text(); // get the response as text
    })
    .then(function(response) {
      console.log(response); // log the response as text
      return JSON.parse(response); // parse the response as JSON
    })
    .catch(function(error) {
      console.error(error);
    });
};

    // Handle any errors returned from Checkout
    const handleResult = function(result) {
        if (result && result.error) {
            showMessage(result.error.message);
        }
        setLoading(false);
    };
    
    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
        }
    }
    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");
        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;
        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>
    <!-- Footer -->
<?php
    require_once("pages-footer.php");
?>

    <!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <script src="js/payment.js"></script>

    <!-- Payment JS -->
    <script>
        /**
         * Calculate the total fee.
         */
        function calc_total() {
            var total_fee = 0;

            $("div#item-list div.col-12").each(function() {
                var fee = ($(this).find("p.fee").text()).split(" ");

                total_fee += parseFloat(fee[1]);
            });

            return total_fee.toFixed(2);
        }

        /**
         * Print the total price. 
         */
        $("div#total-fee").html(calc_total());
    </script>

</body>

</html>