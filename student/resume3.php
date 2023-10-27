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
        /* @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap'); */

*{
	margin: 0;
	padding: 0;
	list-style: none;
	box-sizing: border-box;
	font-family: 'Ubuntu', sans-serif;
}



.resume{
	width: 700px;
	background: #fff;
	margin: 25px auto;
	display: flex;
}

.left{
	background: #003D63;
	width: 250px;
	padding: 0 20px;
}

.right{
	width: calc(100% - 250px);
}

.left .img_holder{
	text-align: center;
	padding: 20px 0;
}

.left .img_holder img{
	width: 200px;
	border-radius: 30px;
}

.pb{
	padding-bottom: 20px;
}

.title{
	font-size: 13px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 5px;
	padding-bottom: 10px;
	color: #3525af;
	position: relative;
	text-align: right;
	margin-bottom: 15px;
}

.title:before{
	content: "";
	position: absolute;
	top: 35px;
	right: 0;
	width: 50px;
	height: 3px;
	background: #3525af;
}

.left .icon{
	font-size: 20px;
	color: #9153c9;
}

.left .text{
	color: #9153c9;
	text-transform: uppercase;
	font-size: 12px;
}

.contact .li_wrap{
	display: flex;
	align-items: center;
	width: 100%;
	margin-bottom: 15px;
}

.contact .li_wrap .icon{
	width: 30px;
	height: 30px;
	background: #fff;
	border-radius: 15px;
	display: flex;
	align-items: center;
	justify-content: center;
	margin-right: 15px;
}

.contact .li_wrap .text{
	width: calc(100% - 50px);
	word-break: break-word;
	color: #fff;
}

.skills ul,
.hobbies ul{
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
}

.skills .li_wrap,
.hobbies .li_wrap{
	width: 150px;
	height: 20px;
	margin-bottom: 15px;
	border-radius: 15px;
	display: flex;
	font-weight: bold;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}

.skills .li_wrap{
	background: #fff;
}

.skills .li_wrap .text,
.hobbies .li_wrap .text{
	margin-top: 5px;
}

.hobbies .li_wrap{
	border: 2px solid #fff;
}

.hobbies .li_wrap .icon,
.hobbies .li_wrap .text{
	color: #fff;
}

.hobbies .li_wrap:hover{
	background: #fff;
}

.hobbies .li_wrap:hover .icon,
.hobbies .li_wrap:hover .text{
	color: #9153c9;
}

.header{
	background: #003D63;
	padding: 15px 30px;
	color: #fff;
	height: 100px;
}

.header .name{
	font-size: 15px;
	text-transform: uppercase;
	font-weight: 600;
	color: #3525af;
}

.header .role{
	font-weight: 300;
	font-size: 20px;
}

.header .about{
	margin-top: 20px;
	line-height: 26px;
}

.right_inner{
	padding: 30px;
	color: #292b2f;
}

.right_inner .education{
	margin-top: 30px;
}

.right_inner .li_wrap{
	display: flex;
	margin-bottom: 15px;
}

.right_inner .li_wrap .date {
    width: 125px;
    color: #9153c9;
}

.right_inner .li_wrap .info{
	width: calc(100%  - 125px);
	padding-left: 25px;
	position: relative;
}

.right_inner .li_wrap .info_title{
	text-transform: uppercase;
	font-weight: 540;
	letter-spacing: 0.5px;
	color: #9153c9;
}

.right_inner .li_wrap .info_com{
	font-weight: 300;
	font-size: 14px;
	margin-top: 3px;
}
.resume {
  width: 710px;
  height: auto;
  display: flex;
  margin: 50px auto;
}


.right_inner .li_wrap .info_cont{
	margin-top: 15px;
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

.right_inner .li_wrap .info:before{
	content: "";
	position: absolute;
	top: 3px;
	left: 0;
	width: 10px;
	height: 10px;
	background: #9153c9;
	border-radius: 50%;
}
.expdesc{
	text-align: justify;
}

.right_inner .li_wrap .info:after{
	content: "";
	position: absolute;
	top: 10px;
	left: 4px;
	width: 2px;
	height: 90%;
	background: #9153c9;
}
    </style>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Resume CV Design</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<?php
	include('pages-head.php');
?>


    <!-- Top navigation -->
<?php
	include('pages-topbar.php');
?>
	<div class="resume  wrapper  " >
		<div class="resume shadow-lg page" id="pdf">
			<div class="left">
				<div class="img_holder">
        <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="" />
				</div>
				<div class="contact_wrap pb">
					<div class="title"style="color:white;">
						Contact
					</div>
					<div class="contact">
						<ul>
							<li>
								<div class="li_wrap">
									<div class="icon"><i class="fas fa-mobile-alt" aria-hidden="true"></i></div>
									<div class="text"><?= $suInfoRow["su_contact_no"] !== NULL ? $suInfoRow["su_contact_no"] : "<span class='text-muted'><em>Not specified</em></span>" ?></div>
								</div>
							</li>
							<li>
								<div class="li_wrap">
									<div class="icon"><i class="fas fa-envelope" aria-hidden="true"></i></div>
									<div class="text"><?= $suInfoRow["su_email"] ?></div>
								</div>
							</li>
							<li>
								<div class="li_wrap">
									<div class="icon"><i class="fab fa-weebly" aria-hidden="true"></i></div>
									<div class="text">www.aniabukstein.com</div>
								</div>
							</li>
							<li>
             
								<div class="li_wrap">
									<div class="icon"><i class="fas fa-map-signs" aria-hidden="true"></i></div>
									<div class="text"><?= $suInfoRow["su_address"] ?></div>
								</div>
							</li>
						</ul>
					</div>
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
				<div class="skills_wrap pb">
					<div class="title"style="color:white;">
						Skills
					</div>
					<div class="skills">
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
								<div class="li_wrap">
									<!-- <div class="icon"><i class="fab fa-html5"></i></div> -->
									<div class="text"><?= $skill["skill_name"] ?></div>
									
								</div>
							</li>
							
							
						</ul>
						<?php
                    }}
								?>
					</div>
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
				<div class="skills_wrap pb">
					<div class="title"style="color:white;">
						Hobbies
					</div>
					<div class="skills">
					<?php
												for($i = 0; $i < count($suHobbyInfo); $i++) {
										?>
						<ul>
							<li>
								<div class="li_wrap">
									<!-- <div class="icon"><i class="fab fa-html5"></i></div> -->
									<div class="text"><?= $suHobbyInfo[$i]["sued_hobby_name"] ?></div>
									
								</div>
							</li>
							
							
						</ul>
						<?php
                    }}
								?>
					</div>
				</div>
				
				
			</div>
			<div class="right">
				<div class="header">
					<div class="name_role">
						<div class="name"style="color:white;">
						<?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?>
						</div>
						<div class="">
						<a href="#" class="link-success"><?= $suInfoRow["su_linked_in"] ?></a>
						</div>
					</div>
					
				</div>
				<div class="right_inner">
					<div class="exp">
						<div class="title">
							experience
						</div>
						<div class="exp_wrap">
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
									<div class="li_wrap">
                 
										<div class="date">
										<?= date_format(date_create($suLanguageInfo[$i]["sued_job_start_date"]), "Y") ?>- <?= $suLanguageInfo[$i]["sued_com_status"] === "Current" ? "-" : date_format(date_create($suLanguageInfo[$i]["sued_job_end_date"]), "Y") ?>
										</div>
										<div class="info">
											<p class="info_title">
											<?= $suLanguageInfo[$i]["sued_language_name"] ?>
											</p>
											
											<p class="info_cont expdesc">
											<?= strip_tags($suLanguageInfo[$i]["sued_job_description"]) ?>
											</p>
										</div>
                    
									</div>
								</li>
								
								
							</ul>
							<?php
        }}
			?>
						</div>
					</div>
					<?php
																					// Fetch student university's education details.
																					$suEduInfo = $suInfo->fetch_education();

																					if($suEduInfo === NULL) {
																				?>
								<?php
									} else {
								?>
								
					<div class="education">
						<div class="title">
							Education
						</div>
						<div class="education_wrap">
						<?php
                for($i = 0; $i < count($suEduInfo); $i++) {
            ?>
							<ul>
							
								<li>
								<div class="li_wrap">
										<div class="date">
										<?= date_format(date_create($suEduInfo[$i]["sued_course_start_date"]), "d/M/Y") ?> - <?= $suEduInfo[$i]["sued_course_status"] === "Current" ? "-" : date_format(date_create($suEduInfo[$i]["sued_course_end_date"]), "d/M/Y") ?>
										</div>
										<div class="info">
										<div class="info_title">
										<?= $suEduInfo[$i]["sued_course_title"] ?>
										</div>
										<div class="info_com">
										<?= $suEduInfo[$i]["sued_college_name"] ?>
										</div>
										<div class="date">
										<?= $suEduInfo[$i]["sued_course_description"] ?>
				                        </div>
											
										</div>
									</div>
								</li>
							
							</ul>
							<?php
			     	}}
				?>
						</div>
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
								
					<div class="education">
						<div class="title">
							REFERENCE
						</div>
						<div class="education_wrap">
						<?php
												for($i = 0; $i < count($suReferenceInfo); $i++) {
										?>
							<ul>
							
							 <li>
								<div class="li_wrap">
										
										<div class="">
										<div class="">
										<?= $suReferenceInfo[$i]["sued_reference"] ?>
										</div>
										
											
										</div>
									</div>
								</li>
							
							</ul>
							<?php
			     	}}
				?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <div class="text-center">
<button type="button" class="  btn btn-success mt-4" onclick="$('#pdf').print();"><h1> Print  Resume</h1></button>
</div>
  <?php
	include('pages-footer.php');
?>
</body>
</html>
</body>
</html>