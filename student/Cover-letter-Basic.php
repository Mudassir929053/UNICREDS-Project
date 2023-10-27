<?php
include 'function/student-function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Document</title>
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
      font-size: 14px;
      text-transform: uppercase;
    }

    .semi-bold {
      font-weight: 300;
      font-size: 13px;
    }

    .resume {
      width: 800px;
      height: auto;
      display: flex;
      margin: 50px auto;
    }

    .resume .resume_left {
      width: 240px;
      background: #26252d;
    }

    .resume .resume_left .resume_profile {
      width: 100%;
      height: 180px;
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
      padding: 11px 0;
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

    .page {
      width: 21cm;
      min-height: 29.7cm;
      padding: 2cm;
      /* padding-top:5px; */
      margin: 1cm auto;
      border: 1px #D3D3D3 solid;
      border-radius: 5px;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

    .expdesc {
      text-align: justify;
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
</head>

<body>
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <?php
  include 'pages-head.php';
  ?>


  <!-- Top navigation -->
  <?php
  include 'pages-topbar.php';
  ?>
  
<?php 
  $query = $conn->query("SELECT * FROM cover_letter
   where user_id = '$suID' 
   order by coverletter_id desc
                         limit 1;");

if (mysqli_num_rows($query) > 0) {
  while ($rows = mysqli_fetch_object($query)) {
    

 ?> <div>

 </div>

  <div class="resume  shadow-lg p-3  bg-body rounded page" id="pdf">
    
    <div class="resume_left">
      <div class="resume_profile">
      <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="" />
      </div>
      <div class="resume_content">
        <div class="resume_item resume_info">
          <div class="title">

            <p class="bold">Cover letter</p>
            <p class="regular"></p>
            <hr>
          </div>
          <p class="bold">Contact</p>
          
              <ul>

                <li>

                  <div class="">


                  </div>
                  <div class="data">
                    <div style="color:white;">Address</div>
                    <?php echo $rows->address; ?>
                  </div>
                </li>
                <div style="color:white;">Phone</div>
                <li>
                  <div class="data">
                  <?php echo $rows->contact_no; ?>
                  </div>

          
                </li>
                <div style="color:white;">Email</div>
                <li>
                  <div class="data">
                  <?php echo $rows->email; ?>
                  </div>
                  <div class="data">
                    
                  </div>
                </li>

              </ul>
        </div>




        <div class="resume">

        </div>

      </div>
    </div>
    <div class="resume_right">
      <div class="resume_item resume_namerole">
        <div class="name">
        <h1><?php echo $rows->name; ?></h1>
        </div>
       
      </div>

      <div class="resume_item resume_work">
        <div class="title">
          <p class="name">
          <h3> Cover letter</h3>
          </p>
        </div>
        

      
      <div class="date">
<p> <?php echo $rows->created_date; ?></p>
    </div>
    <br>
      <div class="title1">
        <p>  
        </p>
      </div>

      <div class="title1">
        <p> <?php echo $rows->introduction; ?></p>
      </div>
      
      <div class="title1">
        <p> <?php echo $rows->current_situation; ?></p>
      </div>
      <div class="title1">
        <p> <?php echo $rows->motivation; ?></p>
        <div class="title1">
        <p> <?php echo $rows->closing; ?></p>
      </div>
      <br>

        <b>Sincerely,</b><br>
        <strong> <?php echo $rows->name; ?></strong>
      </div><br>
      <br>

      <div class="title">
        <b>Thank you</b>
      </div>

      </div>




    </div>
  </div>

  <div class="text-center">
  <button type="button" name="updatecoverletter" id="updatecoverletter" class="btn btn-success mt-4"onclick="window.location.href='cover-templates.php'">Back</button>
			<button type="button" class="  btn btn-success mt-4" onclick="$('#pdf').print();">
				Print Cover Letter
			</button>
		</div>


  

<?php
                      }
          ?>
          <?php

} else {
    echo "data not found";
}
?>

<?php
            include 'pages-footer.php';
       
?>
</body>

</html>