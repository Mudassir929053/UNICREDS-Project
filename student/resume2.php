<?php
    include('function/student-function.php');
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
  width: 270px;
  background: #0bb5f4;
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
  font-size: 14px;
  font-weight: 450;
  margin-bottom: 13px;
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
.expdesc{
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
.positioned {position:static;}

#menu {display:none;}  
#content, #endpage, #startpage {
    -webkit-box-shadow: none;
    -moz-box-shadow:    none;
    box-shadow:         none; 
  }          

 
    </style>
</head>
<body>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <?php
	include('pages-head.php');
?>


    <!-- Top navigation -->
<?php
	include('pages-topbar.php');
?>

<div class="resume  shadow-lg p-3  bg-body rounded page" id="pdf">
   <div class="resume_left">
     <div class="resume_profile">
     <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="" />
     </div>
     <div class="resume_content">
       <div class="resume_item resume_info">
         <div class="title">
        
           <p class="bold"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></p>
           <p class="regular"><?= $suInfoRow["su_linked_in"] ?></p><hr>
         </div>
         <p class="bold">Contact</p>
        
         <ul>
            
           <li>
            
             <div class="icon">
               <i class="fas fa-map-signs"></i>
               
             </div>
             <div class="data">
            
             <?= $suInfoRow["su_address"] ?>
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fas fa-mobile-alt"></i>
             </div>
             <div class="data">
             <?= $suInfoRow["su_contact_no"] !== NULL ? $suInfoRow["su_contact_no"] : "<span class='text-muted'><em>Not specified</em></span>" ?>
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fas fa-envelope"></i>
             </div>
             <div class="data">
             <?= $suInfoRow["su_email"] ?>
             </div>
           </li>
          
         </ul>
       </div>







       <?php
											$sql = "SELECT * 
                      FROM `student_university_skill_set` AS sus 
                      JOIN `skill_type` AS st ON sus.sus_skill_type_id = st.skill_id 
                      WHERE sus.sus_student_university_id = $suID
                      ORDER BY sus_skill_level desc;";
                      $student = $conn->query($sql);
                      $student->num_rows > 0;
                      $suSkillInfo = $student->fetch_all(MYSQLI_ASSOC);
                      rsort($suSkillInfo,1);

									if($suSkillInfo === NULL) {
								?>
               <?php 
									} else {
								?>



       
       <div class="resume_item resume_skills">
         <div class="title">
           <p class="bold">skill's</p>
         </div>
         <?php
													$i = 0;
													foreach($suSkillInfo as $skill) {
														$skill_id = $skill["skill_id"];
														$su_skill_id = $skill["sus_id"];

														if($skill["sus_skill_certificate"] !== NULL) {
															$certName = "<mark>".$skill["sus_skill_certificate"]."</mark>";
															$certDate = "<span class='text-body'>".date_format(date_create($skill["sus_certificate_date"]), "d/m/Y")."</span>";
															$certPrvd = "<span class='text-body'>".$skill["sus_certificate_provider"]."</span>";
															$certLink = "../assets/attachment/student/$suID/skillcert/".$suSkillInfo[$i]["sus_skill_certificate"];
														} else {
															$certName = "<span class='text-muted'><em>Certificate not provided</em></span>";
															$certDate = "<span class='text-muted'><em>Not available</em></span>";
															$certPrvd = "<span class='text-muted'><em>Not available</em></span>";
															$certLink = NULL;
														}
											?>
         <ul>
           <li>
             <div class="skill_name">
             <?= $skill["skill_name"] ?>
             </div>
             <div>
             <?= skillLevel($skill["sus_skill_level"]) ?>
             </div>
            
           </li>
           
           
          
         </ul>
         <?php
                    }}
								?>
       
       </div>
       <?php
																				$sql = "SELECT * 
																				FROM `student_university_hobby_details`           
																				WHERE sued_student_university_id = $suID ;"	;
																				$student = $conn->query($sql);
																				$student->num_rows > 0;
																				$suHobbyInfo = $student->fetch_all(MYSQLI_ASSOC);
																					
																				if($suHobbyInfo === NULL) {
																					
																					
																			
																			?>
               <?php 
									} else {
								?>



       
       <div class="resume_item resume_skills">
         <div class="title">
           <p class="bold">Hobbies's</p>
         </div>
         <?php
												for($i = 0; $i < count($suHobbyInfo); $i++) {
			  	?>
         <ul>
           <li>
             <div class="">
             <?= $suHobbyInfo[$i]["sued_hobby_name"] ?>
             </div>
             
            
           </li>
           
           
          
         </ul>
         <?php
                    }}
								?>
       
       </div>
       
      
     </div>
  </div>
  <div class="resume_right">
    
    <div class="resume_item resume_work">
        <div class="title">
           <p class="bold">Work Experience</p>
         </div>
         <?php
										$sql = "SELECT * 
										FROM `student_university_language_details`           
										WHERE sued_student_university_id = $suID ;";
										$student = $conn->query($sql);
										$student->num_rows > 0;
										$suLanguageInfo = $student->fetch_all(MYSQLI_ASSOC);

										if ($suLanguageInfo === NULL) {



										?>
                    <?php
										} else {
										?>
                    <?php
											for ($i = 0; $i < count($suLanguageInfo); $i++) {
											?>
        <ul>
            <li>
           
                <div class="date"><?= date_format(date_create($suLanguageInfo[$i]["sued_job_start_date"]), "Y") ?>- <?= $suLanguageInfo[$i]["sued_com_status"] === "Current" ? "-" : date_format(date_create($suLanguageInfo[$i]["sued_job_end_date"]), "Y") ?></div> 
                <div class="info">
                     <p class="semi-bold"><?= $suLanguageInfo[$i]["sued_language_name"] ?></p> 
                  <p class="expdesc"><?= strip_tags($suLanguageInfo[$i]["sued_job_description"]) ?></p>
                </div>
               
            </li>
           
            
        </ul>
        <?php
                }}
			?>
    </div>
    <?php
																					// Fetch student university's education details.
																					$suEduInfo = $suInfo->fetch_education();

																					if($suEduInfo === NULL) {
																				?>
								<?php
									} else {
								?>
               
    <div class="resume_item resume_education">
      <div class="title">
           <p class="bold">Education</p>
         </div>
         <?php
										for($i = 0; $i < count($suEduInfo); $i++) {
								?>
      <ul>
            <li>
                <div class="date"><?= $suEduInfo[$i]["sued_course_title"] ?>(<?= date_format(date_create($suEduInfo[$i]["sued_course_start_date"]), "d/M/Y") ?>-<?= $suEduInfo[$i]["sued_course_status"] === "Current" ? "-" : date_format(date_create($suEduInfo[$i]["sued_course_end_date"]), "d/M/Y") ?>)</div> 
                <div class="info">
                     <p class="semi-bold"><?= $suEduInfo[$i]["sued_college_name"] ?></p> 
                  <p><?= $suEduInfo[$i]["sued_course_description"] ?></p>
                </div>
            </li>
           
        </ul>
        <?php
			     	}}
				?>
    </div>
    <?php
																				$sql = "SELECT * 
																				FROM `student_university_reference_details`           
																				WHERE sued_student_university_id = $suID ;"	;
																				$student = $conn->query($sql);
																				$student->num_rows > 0;
																				$suReferenceInfo = $student->fetch_all(MYSQLI_ASSOC);
																				rsort($suReferenceInfo,1);
																					// Fetch student university's experience details.
																					// $suEduInfo = $suInfo->fetch_education();

																					if($suReferenceInfo === NULL) {
																				?>
                                        <?php
									} else {
								?>
               
    <div class="resume_item resume_education">
      <div class="title">
           <p class="bold">Education</p>
         </div>
         <?php
												for($i = 0; $i < count($suReferenceInfo); $i++) {
										?>
      <ul>
            <li>
                <div class="date"><?= $suReferenceInfo[$i]["sued_reference"] ?></div> 
               
            </li>
           
        </ul>
        <?php
			     	}}
				?>
    </div>
  </div>
</div>

<div class="text-center">
<button type="button" class="btn btn-default btn-sm" onclick="$('#pdf').print();">
          <h1><span class="glyphicon glyphicon-print"></span> Print</h1>
        </button>
</div>
<?php
	include('pages-footer.php');
?>
</body>
</html>