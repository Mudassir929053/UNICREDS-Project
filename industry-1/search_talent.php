<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('industry-function.php');

$industry_id = $_SESSION['sess_industryid'];

$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->industry_user_id;

?>


<style>
  .addexp {
    left: 38%;


  }

  .addexp:target {
    left: 100%;
  }

  .addexp {
    background-color: #fefefe;
    width: 70%;
  }

  .modal-content {
    width: 130%;
    padding: 20%;
  }

  #tooltip {
    position: relative;
    cursor: pointer;

    font-size: 13px;
    /* font-weight: bold; */
    font-family: sans-serif;
  }

  #tooltipText {
    position: absolute;
    left: 100%;
    top: 0;
    transform: translateX(-50%);
    background-color: #000;
    color: #fff;
    white-space: nowrap;
    padding: 15px 20px;
    border-radius: 7px;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.5s ease;

  }

  #tooltipText::before {
    border: 15px solid;
    border-color: #000 #0000 #0000;

  }

  #tooltip:hover #tooltipText {
    top: -130%;
    visibility: visible;
    opacity: 1;
  }
</style>

<body>
  <!-- Wrapper -->
  <div id="db-wrapper">
    <!-- navbar vertical -->
    <?php
    unset($_SESSION['pages']);
    $_SESSION['pages'] = 'Skill_Assessment';
    include('pages-sidebar.php');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style3.css">

    <!-- Page Content -->
    <div id="page-content">
      <?php
      include 'pages-header.php';
      ?>

      <?php
      require_once '../stripe/config.php';
      ?>

      <!-- Container fluid -->

      <div class=" p-2 ">
        <!-- <h1 class="text-light text-bold">Talent Search</h1> -->
       
            <div class="text-white bolder clearfix">
              <div class="pull-left text-dark display-5">
                <div class="mb-3 mb-md-0">
                  <h1 class="mb-0 h1 fw-bold">Talent Search</h1>
                  <!-- Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                      <li class="breadcrumb-item">
                        <a href="#">Search Talent</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">

                        <div id="tooltip">
                          <span id="tooltipText">
                            1. Only mention the courses that you have actually attended.<br>2. Don't mention primary or secondary schools unless they are your latest education.<br>3. If you didn't fully complete a course,it can still add value to your resume or atleast explain a gap in your work history.<br>4. Please mention your accurate percentage and group(Course) in the provided fields.
                          </span>
                          <div type="button" class="border border-light"> <i class="fa bala">&#xf0eb;</i> Tips</div>
                        </div>

                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <div class="pull-right display-6">
                <div class="bg-info clearfix">
                  <div class="pull-left"></div>
                  <div class="pull-right">
                    <!-- <div id="paymentResponse" class="hidden"></div>
              <button class="stripe-button btn btn-sm btn-primary text-white" id="payButton">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Add credit Point</span>
              </button> -->
                  </div>
                </div>
              </div>
            </div>
        

      </div><br>


      <div class="row">


        <!-- Brand List  -->
        <div class="col-md-3  px-8 py-1">
          <form action="" method="GET">
            <div class="card shadow mt-3">
              <div class="card-header">
                <h5>Filter
                  <div id="paymentResponse" class="hidden"></div>
                  <button class=" stripe-button btn btn-primary btn-sm float-end" id="payButton">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="buttonText">Add credit Point</span>
                  </button>

                </h5>
              </div>
              <div class="card-body">
                <h6>Search The Talent</h6>
                <hr>
                <div class="objfilter">
                  <h4>Search</h4>
                  <input class="form-control" id="myInput" type="text" placeholder="Search.." name="search2">
                </div>
                <div class="objfilter">
                  <h4>Location</h4>
                  <input class="form-control" id="location" type="text" placeholder="Location.." name="search2">
                </div>

                <form method="POST">
                  <fieldset class="filter-group pf-checkboxes px-2 py-4 objfilter">
                    <h4>Minimum years of experience</h4>
                    <div class="pf-checkbox">
                      <input type="checkbox" name="price_filter[]" value="5">
                      <label>5 Years Below</label>
                    </div>
                    <div class="pf-checkbox">
                      <input type="checkbox" name="price_filter[]" value="5-10">
                      <label>5 - 10 years</label>
                    </div>
                    <div class="pf-checkbox">
                      <input type="checkbox" name="price_filter[]" value="10-15">
                      <label>10 - 15 years</label>
                    </div>
                    <div class="pf-checkbox">
                      <input type="checkbox" name="price_filter[]" value="15-20">
                      <label>15 - 20 years</label>
                    </div>
                    <div class="pf-checkbox">
                      <input type="checkbox" name="price_filter[]" value="20">
                      <label>20 years Above</label>
                    </div>
                    <div class="objfilter">
                      <fieldset class="filter-group pf-search">

                        <input type="submit" id="pf-reset-form" class="pf-reset my-2  px-6" value="Reset">
                      </fieldset>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </form>
        </div>

        <!-- Brand Items - Products -->
        <div class="col-md-8 mt-3">
          <div class="card" id="talent">
            <div class="card-body row">

              <?php
              $querycn = $conn->query("SELECT * FROM student_university AS st 
              JOIN student_university_experience_details AS sus ON st.su_id = sus.sued_student_university_id;");

              if (mysqli_num_rows($querycn) > 0) {
                while ($rows = mysqli_fetch_object($querycn)) {
              ?>
                  <div class="card mx-2 my-3" style="width: 18rem;">
                    <a href="" data-bs-toggle="modal" data-bs-target="#addExp_<?php echo $rows->sued_student_university_id; ?>">
                      <div class="card-body">
                        <h3 class="card-title text-info"><?php echo $rows->sued_job_title; ?></h3>
                        <span class="card-text text-dark">Company Name: <?php echo $rows->sued_company_name; ?></span>
                        <span class="card-text text-dark"><?php echo $rows->su_address; ?></span>
                        <?php
                        $sdate = $rows->sued_start_date;
                        $edate = $date = date('m/d/Y h:i:s a', time());
                        $date_diff = abs(strtotime($edate) - strtotime($sdate));
                        $years = floor($date_diff / (365 * 60 * 60 * 24));
                        $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        ?>
                        <p class="card-text text-dark">Experience: <?php printf("%d years, %d months", $years, $months); ?></p>
                        <span class="card-text text-dark"><?php echo $rows->sued_description; ?></span>
                      </div>
                    </a>

                  </div>
              <?php
                }
              }
              ?>

              <?php
              $querycn = $conn->query("SELECT * FROM student_university AS st 
              JOIN student_university_experience_details AS sus ON st.su_id = sus.sued_student_university_id
              JOIN student_university_education_details AS se ON se.sued_student_university_id = st.su_id
              JOIN student_university_skill_set AS sk ON sk.sus_student_university_id = st.su_id
              JOIN  student_university_hobby_details AS hb ON hb.sued_student_university_id = st.su_id;");

              if (mysqli_num_rows($querycn) > 0) {
                while ($rows = mysqli_fetch_object($querycn)) {
              ?>
                  <div class="modal fade addexp card shadow-lg" id="addExp_<?php echo $rows->sued_student_university_id; ?>" tabindex="-1" aria-labelledby="addExpLabel_<?php echo $rows->sued_student_university_id; ?>" aria-hidden="true">
                    <div class="modal-dialog ">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addExpLabel_<?php echo $rows->sued_student_university_id; ?>"></h5>

                        </div>


                        <div class="">
                          <h2><?php echo $rows->sued_language_name; ?><h2>
                              <h4><?php echo $rows->sued_language_name; ?> At <?php echo $rows->sued_com_name; ?><h4>
                                
                                  <button  data-bs-toggle="modal" onclick="checkPayment(this)" id="<?php echo $rows->sued_student_university_id; ?>" data-bs-target="#addExp1_<?php echo $rows->sued_student_university_id; ?>" class="btn btn-outline-secondary">Retrieve Resume</button><br><br><br>
                                  <?php
                                        $querycn2 = $conn->query("SELECT credit_point FROM `credit` WHERE cr_industry_user_id = '$get_userID
                                        ' and credit_point>0;");

                                        if (mysqli_num_rows($querycn2) > 0) {
                                          $paid_amount = 0;
                                          $remaining_amount = 0;
                                          while ($rows2 = mysqli_fetch_object($querycn2)) {
                                            if (!is_null($rows2->credit_point)) {
                                              $paid_amount = $rows2->credit_point;
                                            }
                                          
                                          $account_balance = $paid_amount;
                                          $suid = $_SESSION['bb'];
                                        ?>
                                  <div class="modal fade addexp card shadow-lg" id="addExp1_<?php echo $rows->sued_student_university_id; ?>" tabindex="-1" aria-labelledby="addExp1Label_<?php echo $_SESSION['bb'] = $rows->sued_student_university_id; ?>" aria-hidden="true">
                                    <div class="modal-dialog ">
                                      <div class="modal-content">
                                       

                                          <div class="row">
                                            <h2>To access the resume, a debit of 5 points will be made from your wallet.</h2><br>
                                            <div class="col-md-4 fw-bold">Your Credit Point is: <?php echo $account_balance; ?></div>

                                            <button class="stripe-button btn btn-info w-100 fs-3 text-dark" onclick="payWithPoints(<?php echo $account_balance; ?>, <?php echo $rows->sued_student_university_id; ?>)">pay</button>



                                          </div>

                                          <script>
                                            function payWithPoints(balance, id) {
                                              if (balance >= 5) {
                                                // subtract 5 from the account balance
                                                balance -= 5;
                                                var redirectUrl = 'search_talent_view.php?suid='+ id+'&industry_user_id=<?php echo $get_userID; ?>'
                                                var r = confirm("Payment successful! Your new account balance is: " + balance);
                                                if (r == true) {
                                                  // Send an AJAX request to pay.php to insert data into the credit table
                                                  var xmlhttp = new XMLHttpRequest();
                                                  xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                      console.log("Data inserted successfully");
                                                    }
                                                  };
                                                  xmlhttp.open("POST", "pay.php", true);
                                                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                  xmlhttp.send("submit=1&r_industry-user_id=<?php echo $get_userID; ?>&r_student_id=" + id);
                                                  window.location.href = redirectUrl; 
                                                }
                                              } else {
                                                alert("Insufficient account balance. Please add funds.");
                                              }
                                            }


                                            function checkPayment(obj){
                                              // console.log(obj.getAttribute('data-bs-target'))
                                              console.log(obj.id)

                                              let url = 'ajax.php?checkPayment=yes&stuid='+obj.id;
                                              // return false;
                                              fetch(url).then(data=>data.text()).then(data=>{
                                                console.log(data)
                                                if(data =='Payment Done'){
                                                  window.location.href='search_talent_view.php?suid='+obj.id+'&industry_user_id=<?php echo $get_userID; ?>'
                                                }
                                                else{
                                                  document.querySelector(obj.getAttribute('data-bs-target')).style.display='block'
                                                }
                                              })

                                            }
                                          </script>
                                      

                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                          }
                                        } else { ?>
                                         <div class="modal fade addexp card shadow-lg" id="addExp1_<?php echo $rows->sued_student_university_id; ?>" tabindex="-1" aria-labelledby="addExp1Label_<?php echo $_SESSION['bb'] = $rows->sued_student_university_id; ?>" aria-hidden="true">
                                    <div class="modal-dialog ">
                                      <div class="modal-content">
                                       

                                      <h1>Insufficient Wallet Balance</h1><br>
                                          Sorry! You don't have enough credit balance to retrieve the resume.<br><br>
                                          <a href="">Click Here to Recharge your Wallet!</a>
                                          <div class="mb-lg-0">
                                            <!-- <a href="stripe/public/checkout.html" class="btn btn-warning w-100 fs-3 text-dark">Place Order</a> -->
                                            <div id="paymentResponse" class="hidden"></div>
                                            <button class="stripe-button btn btn-info w-100 fs-3 text-dark"><a href="search_talent.php">Add Credit Points</a></button>


                                            </button>
                                          </div>
                                      </div>
                                    </div>
                                         </div>

                                         <?php } ?>
                                  <h3>Experience</h3>
                                  <div class="row">
                                    <div class="col-md-4 fw-bold">Language Name:</div>
                                    <div class="col-md-8"><?php echo $rows->sued_language_name; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 fw-bold">Company Name:</div>
                                    <div class="col-md-8"><?php echo $rows->sued_com_name; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 fw-bold">Date:</div>
                                    <div class="col-md-8"><?php echo $rows->sued_job_start_date; ?>--<?php echo $rows->sued_job_start_date; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 fw-bold">Description:</div>
                                    <div class="col-md-8"><?php echo $rows->sued_job_description; ?></div>
                                  </div>


                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <div class="">

                          <h3>Skill's</h3>
                          <div class="row">
                            <div class="col-md-4 fw-bold">Skill Name:</div>
                            <div class="col-md-8"><?php echo $rows->sued_language_name; ?></div>
                          </div>

                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <div class="">

                          <h3>Education</h3>
                          <div class="row">
                            <div class="col-md-4 fw-bold">Course Name</div>
                            <div class="col-md-8"><?php echo $rows->sued_course_title; ?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-4 fw-bold">College Name</div>
                            <div class="col-md-8"><?php echo $rows->sued_college_name; ?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-4 fw-bold">Complete Date</div>
                            <div class="col-md-8"><?php echo $rows->sued_course_start_date; ?>--<?php echo $rows->sued_course_end_date; ?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-4 fw-bold">Persentage</div>
                            <div class="col-md-8"><?php echo $rows->sued_course_description; ?></div>
                          </div>

                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <div class="">

                          <h3>Hobbie's</h3>
                          <div class="row">
                            <div class="col-md-4 fw-bold">Hobby</div>
                            <div class="col-md-8"><?php echo $rows->sued_hobby_name; ?></div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
              <?php
                }
              }
              ?>



              <!-- Modal -->



              <script>
                $(document).ready(function() {
                  $('#addExp').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var modal = $(this);
                    modal.find('.modal-title').text('Experience Details for ID ' + id);
                    $.ajax({
                      type: 'POST',
                      url: 'get_experience_details.php',
                      data: {
                        id: id
                      },
                      success: function(response) {
                        modal.find('.modal-body').html(response);
                      }
                    });
                  });
                });
              </script>



              <!-- Script -->


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
                  const userID = <?php echo $get_userID ?>;

                  // Create the Checkout Session with the selected product
                  return fetch("../stripe/payment_init.php", {
                      method: "POST",
                      headers: {
                        "Content-Type": "application/json",
                      },
                      body: JSON.stringify({
                        createCheckoutSession: 1,
                        userID: userID,

                      }),
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
                    messageContainer.textContent = "";
                  }, 5000);
                }
              </script>

              <script src="../assets/js/theme.min.js"></script>
              <script src="js/payment.js"></script>


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

              <!-- clipboard -->
              <!-- <script>
    $(document).ready(function() {
      $("#search-btn").on("click", function() {
        var nameValue = $("#myInput").val().toLowerCase();
        var locationValue = $("#location").val().toLowerCase();

        $("#talent a").filter(function() {
          var nameMatch = $(this).text().toLowerCase().indexOf(nameValue) > -1;
          var locationMatch = $(this).text().toLowerCase().indexOf(locationValue) > -1;
          $(this).toggle(nameMatch && locationMatch);
        });
      });
    });
  </script> -->

              <script>
                $(document).ready(function() {
                  $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#talent div").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
                $(document).ready(function() {
                  $("#location").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#talent div").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
                $(document).ready(function() {
                  $("div input[type='checkbox']").click(function() {
                    var price_filter = [];
                    $("div input[type='checkbox']:checked").each(function() {
                      price_filter.push($(this).val());
                    });
                $.ajax({
                      url: "filter.php",
                      type: "post",
                      data: {
                        price_filter: price_filter
                      },
                      success: function(response) {
                        $("#talent").html(response);
                      }
                    });
              });
                });
              </script>
              <script>
                $(document).ready(function() {
                  $checkBox.checked = $currentYear - $experienceYear;
                  if (checkBox.checked < 10) {
                    text.style.display = "block";
                  } else {
                    text.style.display = "none";
                  }
                });
              </script>
              <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
              <!-- <script>
                $(document).ready(function() {
                  $("div input[type='checkbox']").click(function() {
                    var price_filter = [];
                    $("div input[type='checkbox']:checked").each(function() {
                      price_filter.push($(this).val());
                    });
                    // console.log(price_filter);
                    // let formData = new FormData();
                    // formData.append('price_filter',JSON.stringify(price_filter));
                    $.ajax({
                      url: "filter.php",
                      type: "post",
                      data: {
                        price_filter: price_filter
                      },
                      success: function(response) {
                        $("#talent").html(response);
                      }
                    });
                    // fetch('filter.php',{
                    //   method: 'POST',
                    //   body: formData
                    // }).then(data=>data.text()).then(data=>{
                    //   console.log(data);
                    //   document.getElementById('talent').innerHTML=data;
                    // })
                  });
                });
              </script> -->
              <script>
                function openNav() {
                  document.getElementById("addExp").style.width = "750px";
                }

                function closeNav() {
                  document.getElementById("mySidenav").style.width = "0";
                }
              </script>


              <!-- Theme JS -->
              <script src="../assets/js/theme.min.js"></script>
              <script src="../assets/js/ckeditor.js"></script>

              <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>