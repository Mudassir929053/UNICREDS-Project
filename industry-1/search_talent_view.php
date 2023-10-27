<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('industry-function.php');

$industry_id = $_SESSION['sess_industryid'];
// var_dump($_SESSION);
// exit;
// $checkuserrow = $conn->query("SELECT industry_user_id  from industry where industry_id  = '$industry_id'");
// $rowReadUser = $checkuserrow->fetch_object();
// $get_userID = $rowReadUser->industry_user_id;

?>
<style>
  @import url("https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    font-family: "Montserrat", sans-serif;
  }



  .bold {
    font-weight: 700;
    font-size: 20px;
    text-transform: uppercase;
  }

  .semi-bold {
    font-weight: 500;
    font-size: 16px;
  }

  .resume {
    width: 800px;
    height: auto;
    display: flex;
    margin: 50px auto;
  }

  .resume .resume_left {
    width: 280px;
    background: #0bb5f4;

  }

  .resume .resume_left .resume_profile {
    width: 100%;
    height: 280px;
  }

  .resume .resume_left .resume_profile img {
    width: 100%;
    height: 100%;
  }

  .resume .resume_left .resume_content {
    padding: 0 25px;
  }

  .resume .title {
    margin-bottom: 20px;
  }

  .resume .resume_left .bold {
    color: #fff;
  }

  .resume .resume_left .regular {
    color: #b1eaff;
  }

  .resume .resume_item {
    padding: 25px 0;
    border-bottom: 2px solid #b1eaff;
  }

  .resume .resume_left .resume_item:last-child,
  .resume .resume_right .resume_item:last-child {
    border-bottom: 0px;
  }

  .resume .resume_left ul li {
    display: flex;
    margin-bottom: 10px;
    align-items: center;
  }

  .resume .resume_left ul li:last-child {
    margin-bottom: 0;
  }

  .resume_left .li_wrap {
    width: calc(100% - 50px);
    word-break: break-word;
    color: #fff;
  }

  .resume .resume_left ul li .icon {
    width: 35px;
    height: 35px;
    background: #fff;
    color: #0bb5f4;
    border-radius: 50%;
    margin-right: 15px;
    font-size: 16px;
    position: relative;
  }

  .resume .icon i,
  .resume .resume_right .resume_hobby ul li i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .resume .resume_left ul li .data {
    color: #b1eaff;
  }

  .resume .resume_left .resume_skills ul li {
    display: flex;
    margin-bottom: 10px;
    color: #b1eaff;
    justify-content: space-between;
    align-items: center;
  }

  .resume .resume_left .resume_skills ul li .skill_name {
    width: 25%;
  }

  .resume .resume_left .resume_skills ul li .skill_progress {
    width: 60%;
    margin: 0 5px;
    height: 5px;
    background: #009fd9;
    position: relative;
  }

  .resume .resume_left .resume_skills ul li .skill_per {
    width: 15%;
  }

  .resume .resume_left .resume_skills ul li .skill_progress span {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: #fff;
  }

  .resume .resume_left .resume_social .semi-bold {
    color: #fff;
    margin-bottom: 3px;
  }

  .resume .resume_right {
    width: 520px;
    background: #fff;
    padding: 25px;
  }

  .resume .resume_right .bold {
    color: #0bb5f4;
  }

  .resume .resume_right .resume_work ul,
  .resume .resume_right .resume_education ul {
    padding-left: 40px;
    overflow: hidden;
  }

  .resume .resume_right ul li {
    position: relative;
  }

  .resume .resume_right ul li .date {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 15px;
  }

  .resume .resume_right ul li .info {
    margin-bottom: 20px;
  }

  .resume .resume_right ul li:last-child .info {
    margin-bottom: 0;
  }

  .resume .resume_right .resume_work ul li:before,
  .resume .resume_right .resume_education ul li:before {
    content: "";
    position: absolute;
    top: 5px;
    left: -25px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    border: 2px solid #0bb5f4;
  }

  .resume .resume_right .resume_work ul li:after,
  .resume .resume_right .resume_education ul li:after {
    content: "";
    position: absolute;
    top: 14px;
    left: -21px;
    width: 2px;
    height: 115px;
    background: #0bb5f4;
  }

  .resume .resume_right .resume_hobby ul {
    display: flex;
    justify-content: space-between;
  }

  .resume .resume_right .resume_hobby ul li {
    width: 80px;
    height: 80px;
    border: 2px solid #0bb5f4;
    border-radius: 50%;
    position: relative;
    color: #0bb5f4;
  }

  .resume .resume_right .resume_hobby ul li i {
    font-size: 30px;
  }

  .resume .resume_right .resume_hobby ul li:before {
    content: "";
    position: absolute;
    top: 40px;
    right: -52px;
    width: 50px;
    height: 2px;
    background: #0bb5f4;
  }

  .resume .resume_right .resume_hobby ul li:last-child:before {
    display: none;
  }

  @page {
    size: A4;
    margin: 0;
  }

  @media print {
    .page {
      margin: 0;
      border: initial;
      width: 21cm;
      min-height: 29.7cm;
      border-radius: initial;

      box-shadow: initial;
      background: initial;
      page-break-after: always;
    }
  }

  .positioned {
    position: static;
  }

  #menu {
    display: none;
  }

  #content,
  #endpage,
  #startpage {
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
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

    <style>
      .search {
        position: absolute;
        right: 6%;
      }
    </style>
    <!-- Page Content -->
    <div id="page-content">
      <?php
      include 'pages-header.php';
      ?>

      <!-- <a href="search_talent.php" class=" back bg-secondary btn-sm text-light"><-Back</a> -->
      <!-- Container fluid -->

      <div class="bg-info px-1 py-3 mx-1 my-3">
        <h1 class="text-light text-bold mx-4">Talent Search</h1>
      </div><br>

      <body>
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <a href="search_talent.php" class="btn btn-outline-info btn-sm mx-4">Back</a>

        <div class="resume" id="pdf">
          <div class="resume_left">
            <?php
            $ii = $_GET['suid'];
            $industry_id = $_GET['industry_user_id'];

            if ($industry_id != $_SESSION['get_userID']) {
            ?>
              <script>
                alert('You cannot view this page');
                window.location.href = 'search_talent.php';
              </script>
              <?php
              exit;
            }
            $querycn = $conn->query("SELECT * FROM student_university as A join resume_payment as B on A.su_id=B.r_student_id where a.su_id='$ii' and b.r_industry_user_id='$industry_id'");


            if (mysqli_num_rows($querycn) > 0) {
              while ($rows = mysqli_fetch_object($querycn)) {

              ?>
                <div class="resume_profile">
                  <img src="<?= $rows->su_profile_pic !== NULL ? "../assets/images/avatar/" . $rows->su_profile_pic : "../assets/images/avatar/avatardefault.png" ?>">
                </div>
            <?php }
            } ?>

            <div class="resume_content">
              <?php
              $ii = $_GET['suid'];

              // echo  $sql="SELECT * FROM student_university as A join resume_payment as B on A.su_id=B.r_student_id where a.su_id='$ii' and b.r_industry_user_id='$industry_id'";
              //   exit;
              $querycn = $conn->query("SELECT * FROM student_university as A join resume_payment as B on A.su_id=B.r_student_id where a.su_id='$ii' and b.r_industry_user_id='$industry_id'");


              if (mysqli_num_rows($querycn) > 0) {
                while ($rows = mysqli_fetch_object($querycn)) {
                  //    if($rows['vdo_file']){

              ?>
                  <div class="resume_item resume_info">
                    <div class="title">
                      <p class="bold"><?php echo $rows->su_fname; ?> <?php echo $rows->su_lname; ?></p>

                    </div>
                    <ul>
                      <li>
                        <div class="icon">
                          <i class="fas fa-map-signs"></i>
                        </div>
                        <div class="data li_wrap">
                          <?php echo $rows->su_address !== NULL ? $rows->su_address : 'Address not provided.'; ?>

                        </div>
                      </li>


                      <li>
                        <div class="icon">
                          <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="data li_wrap">
                          <?php echo $rows->su_contact_no !== NULL ? $rows->su_contact_no : 'number not provided.'; ?>
                        </div>
                      </li>
                      <li>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <div class="data li_wrap">
                          <?php echo $rows->su_email !== NULL ? $rows->su_email : 'Email address not provided.'; ?>
                        </div>
                      </li>
                      <li>
                        <div class="icon">
                          <i class="fab fa-weebly"></i>
                        </div>
                        <div class="data">
                          <?php echo $rows->su_linked_in !== NULL ? $rows->su_linked_in : 'LinkedIn profile not provided.'; ?>
                        </div>
                      </li>
                    </ul>
                  </div>
              <?php }
              } ?>

              <div class="resume_item resume_skills">
                <div class="title">
                  <p class="bold">skill's</p>
                </div>
                <?php
                $ii = $_GET['suid'];
                $querycn = $conn->query("SELECT * 
                    FROM `student_university_skill_set` AS sus 
                    JOIN `skill_type` AS st ON sus.sus_skill_type_id = st.skill_id 
                    WHERE sus.sus_student_university_id =$ii;");


                if (mysqli_num_rows($querycn) > 0) {
                  while ($rows = mysqli_fetch_object($querycn)) {
                    //    if($rows['vdo_file']){

                ?>
                    <ul>
                      <li>
                        <div class="skill_name">
                          <?php echo $rows->skill_name; ?>
                        </div>

                        <!-- <div class="skill_per"><?php echo $rows->sus_skill_level; ?></div> -->
                      </li>


                    </ul>
                  <?php }
                } else { ?>
                  <p class="">Skill's not provided</p>
                <?php } ?>
              </div>
              <div class="resume_item resume_skills">
                <div class="title">
                  <p class="bold">Hobbie's</p>
                </div>
                <?php

                $querycn = $conn->query("SELECT * FROM student_university_hobby_details WHERE sued_student_university_id='$ii';");


                if (mysqli_num_rows($querycn) > 0) {
                  while ($rows = mysqli_fetch_object($querycn)) {
                    //    if($rows['vdo_file']){

                ?>
                    <ul>
                      <li>
                        <div class="">
                          <?php echo $rows->sued_hobby_name; ?>
                        </div>


                      </li>


                    </ul>
                  <?php }
                } else { ?>

                  <p class="">Hobbie's not provided</p>

                <?php } ?>
              </div>

            </div>
          </div>
          <div class="resume_right">

            <div class="resume_item resume_work">
              <div class="title">
                <p class="bold">Work Experience</p>
              </div>
              <?php
              $ii = $_GET['suid'];
              $querycn = $conn->query("SELECT * FROM student_university_experience_details WHERE sued_student_university_id='$ii';");


              if (mysqli_num_rows($querycn) > 0) {
                while ($rows = mysqli_fetch_object($querycn)) {
                  //    if($rows['vdo_file']){

              ?>
                  <ul>
                    <li>
                      <div class="date"><?php echo $rows->sued_job_start_date; ?> - <?php echo $rows->sued_job_start_date; ?></div>
                      <div class="info">
                        <p class="semi-bold"><?php echo $rows->sued_language_name; ?>.</p>
                        <p><?php echo $rows->sued_job_description; ?>!</p>
                      </div>
                    </li>

                  </ul>
                <?php }
              } else { ?>
                <p class="">Experience's not provided</p>
              <?php } ?>
            </div>
            <div class="resume_item resume_education">
              <div class="title">
                <p class="bold">Education</p>
              </div>
              <?php
              $ii = $_GET['suid'];
              $querycn = $conn->query("SELECT * FROM student_university_education_details WHERE sued_student_university_id='$ii';");


              if (mysqli_num_rows($querycn) > 0) {
                while ($rows = mysqli_fetch_object($querycn)) {
                  //    if($rows['vdo_file']){

              ?>
                  <ul>
                    <li>
                      <div class="date">2010 - 2013</div>
                      <div class="info">
                        <p class="semi-bold">Web Designing (Texas University)</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                      </div>
                    </li>
                    <li>
                      <div class="date"><?php echo $rows->sued_course_start_date; ?> - <?php echo $rows->sued_course_end_date; ?></div>
                      <div class="info">
                        <p class="semi-bold"><?php echo $rows->sued_course_title; ?></p>
                        <p class="semi-bold"><?php echo $rows->sued_college_name; ?></p>
                        <p><?php echo $rows->sued_course_description; ?></p>
                      </div>
                    </li>
                  </ul>
                <?php }
              } else { ?>
                <p class="">Education's not provided</p>
              <?php } ?>
            </div>

          </div>
        </div>

        <div class="text-center">
<button type="button" class="btn btn-default btn-sm" onclick="$('#pdf').print();">
          <h1><span class="glyphicon glyphicon-print"></span> Print</h1>
        </button>
</div>

      </body>










      <!-- clipboard -->

      <script>
        var doc = new jsPDF();
        var specialElementHandlers = {
          '#editor': function(element, renderer) {
            return true;
          }
        };

        $('#cmd').click(function() {
          doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
          });
          doc.save('sample-file.pdf');
        });
      </script>

      <!-- Theme JS -->
      <script src="../assets/js/theme.min.js"></script>
      <script src="../assets/js/ckeditor.js"></script>

      <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
</body>

</html>