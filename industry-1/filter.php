<?php
$conn = mysqli_connect("localhost", "root", "", "employability_platform");
include('industry-function.php');

$industry_id = $_SESSION['sess_industryid'];

$checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
$rowReadUser = $checkuserrow->fetch_object();
$get_userID = $rowReadUser->industry_user_id;

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if a minimum years of experience filter has been selected
if (isset($_POST["price_filter"])) {
  $price_filters = $_POST["price_filter"];
  $query = "SELECT * FROM student_university_experience_details WHERE ";
  foreach ($price_filters as $price_filter) {
    switch ($price_filter) {
      case '5':
        $query .= "DATEDIFF(NOW(), sued_job_start_date) <= 1825 OR ";
        break;
      case '5-10':
        $query .= "DATEDIFF(NOW(), sued_job_start_date) > 1825 AND DATEDIFF(NOW(), sued_job_start_date) <= 3650 OR ";
        break;
      case '10-15':
        $query .= "DATEDIFF(NOW(), sued_job_start_date) > 3650 AND DATEDIFF(NOW(), sued_job_start_date) <= 5475 OR ";
        break;
      case '15-20':
        $query .= "DATEDIFF(NOW(), sued_job_start_date) > 5475 AND DATEDIFF(NOW(), sued_job_start_date) <= 7300 OR ";
        break;
      case '20':
        $query .= "DATEDIFF(NOW(), sued_job_start_date) > 7300 OR ";
        break;
    }
  }
  $query = rtrim($query, " OR ");
} else {
  $query = "SELECT * FROM student_university AS st 
  JOIN student_university_experience_details AS sus ON st.su_id = sus.sued_student_university_id";
}
?>
<link rel="stylesheet" href="..\assets\css\style3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="row">
<div class="col-md-12 mt-3">
          <div class="card " id="talent">
            <div class="card-body row">
        <?php
        // Execute the SQL query and display the results
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $sdate = new DateTime($row["sued_job_start_date"]);
            $edate = new DateTime();
            $interval = $sdate->diff($edate);
            $years = $interval->y;
            $months = $interval->m;
            // echo "<div>";
            // echo "<h3>" . $row["sued_language_name"] . "</h3>";
            // echo "<p>Year-$years Month-$months</p>";
            // echo "</div>";
        ?>
             <div class="card mx-2 my-3" style="width: 18rem;">
             <a href="" data-bs-toggle="modal" data-bs-target="#addExp_<?php echo $row['sued_student_university_id']; ?>">
                  
                  <div class="card-body">
                    <h3 class="card-title text-info"><?php echo  $row["sued_language_name"];  ?></h3>

                    <span class="card-text text-dark">Company Name : <?php echo  $row["sued_com_name"]; ?></span>
                   
                    <?php
                    $sdate = $row["sued_job_start_date"];
                    $edate = $date = date('m/d/Y h:i:s a', time());

                    $date_diff = abs(strtotime($edate) - strtotime($sdate));

                    $years = floor($date_diff / (365 * 60 * 60 * 24));
                    $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    // $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));




                    ?>
                    <p class="card-text text-dark">Experience :<?php printf("%d years, %d months", $years, $months);
                                                      printf("\n") ?></p>
                    <span class="card-text text-dark"><?php echo  $row["sued_job_description"]; ?></span>
                </a>
                </div>
                
              </div>
          <?php
          }} ?>
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

      </div>
    </div>


 

<?php
        

        $conn->close();
?>
