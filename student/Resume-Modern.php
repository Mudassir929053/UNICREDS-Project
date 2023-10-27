<?php
    include('function/student-function.php');
?>
   <?php
	include('pages-head.php');
?>

<?php
	include('pages-topbar.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
<style>
    body{
	margin: 0px;
	padding: 0px;
	background-image: radial-gradient(#c7c7c7 25%, #c7c7c7 74%);
	height: 100vh;
	font-family: system-ui;

}
.clearfix{
	clear: both;
}
.main{
	height: 1150px;
	width: 800px;
	background-color: white;
	box-shadow: 5px 7px 15px 5px #b9b6b6;
	margin: 20px auto;

}

.top-section{
	background-color:#151b29;
	text-align: center;
	padding: 6px;
}

.p1{
	color: white;
	font-size: 20px;
	font-weight: ;
	margin: 0px;
	margin-top: 4px;
}
.p1 span{
	font-weight: 100;
	color: #c7c7c7;
}
.p2{
	font-size: 15px;
	color: #c7c7c7;
	margin: 0px;
	margin-top: 3px;
}
.col-div-4{
	width: 35%;
	float: left;

}

.col-div-8{
	width: 62%;
	float: left;
}
.line{
	border-left: 1px solid #c7c7c7;
  height: 800px;
  width: 2%;
  margin-top: 30px;
  float:left;
}
.content-box{
	padding: 20px;
}
.head{
	font-size: 15px;
	text-transform: uppercase;
	font-weight: 500;
}
.p3{
	color: #7b7b7b;
	margin-bottom: -5px;
    

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
.fa{
	color: #151b29;
}
.skills{
	margin-left: -20px;
	    margin-bottom: 0px;
}
.skills li{
	padding: 5px;
}
.skills li span{
	color: #7b7b7b;
}
.p-4{
	font-size: 14px;
	color: #7b7b7b;
}
html,body{overflow-y: scroll; }
</style>
</head>
   


<div class="main">
    <div class="container page"id="pdf">
		<div class="top-section">
        <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										  width="180px"/>
			<p class="p1"><?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?></p>
			<p class="p2">UI / UX Designer</p>
		</div>
		<div class="clearfix"></div>

		<div class="col-div-4">
			<div class="content-box" style="padding-left: 40px;">

				
			<p class="head">Contact</p>
			<p class="p3"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;  <?= $suInfoRow["su_contact_no"] !== NULL ? $suInfoRow["su_contact_no"] : "<span class='text-muted'><em>Not specified</em></span>" ?></p>
			<p class="p3"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;&nbsp;<?= $suInfoRow["su_email"] ?></p>
			<p class="p3"><i class="fa fa-home" aria-hidden="true"></i> &nbsp;&nbsp;<?= $suInfoRow["city_name"] ?>,<?= $suInfoRow["state_name"] ?>,<?= $suInfoRow["country_name"] ?></p>
			

			<br/>
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
			<p class="head">my skills</p>
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
			<ul class="skills">
				<li><span><?= $skill["skill_name"] ?>---<?= skillLevel($skill["sus_skill_level"]) ?></span></li>
				
				

			</ul>
            <?php
                    }}
								?>
			<br/>
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
			<p class="head">my skills</p>
			<?php
												for($i = 0; $i < count($suHobbyInfo); $i++) {
										?>
			<ul class="skills">
				<li><span><?= $suHobbyInfo[$i]["sued_hobby_name"] ?></span></li>
				
				

			</ul>
            <?php
                    }}
								?>
			
			<br>
			</div>
		</div>
		<div class="line"></div>
		<div class="col-div-8">
			<div class="content-box">
			
			<br/>
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
                 
			<p class="head">EXPERIENCE</p>
			<?php
											for ($i = 0; $i < count($suLanguageInfo); $i++) {
											?>
			<p><?= $suLanguageInfo[$i]["sued_language_name"] ?> (<?= date_format(date_create($suLanguageInfo[$i]["sued_job_start_date"]), "Y") ?>- <?= $suLanguageInfo[$i]["sued_com_status"] === "Current" ? "-" : date_format(date_create($suLanguageInfo[$i]["sued_job_end_date"]), "Y") ?>)</p>
			<p class="p-2">
			<?= strip_tags($suLanguageInfo[$i]["sued_job_description"]) ?></p>

			
			

			
            <?php
			     	}}
				?>

			<br/>
            <?php
																					// Fetch student university's education details.
																					$suEduInfo = $suInfo->fetch_education();

																					if($suEduInfo === NULL) {
																				?>
								<?php
									} else {
								?>
			<p class="head">Education</p>
            <?php
										for($i = 0; $i < count($suEduInfo); $i++) {
								?>
								<div class="">
								<?= $suEduInfo[$i]["sued_course_title"] ?>(<?= date_format(date_create($suEduInfo[$i]["sued_course_start_date"]), "d/m/Y") ?>-<?= $suEduInfo[$i]["sued_course_status"] === "Current" ? "-" : date_format(date_create($suEduInfo[$i]["sued_course_end_date"]), "d/m/Y") ?>)
							     </div>
								 <div class="">
								<?= $suEduInfo[$i]["sued_college_name"] ?>
							     </div>
								 <div class="">
								 <?= $suEduInfo[$i]["sued_course_description"] ?>
							     </div>
								 
			
            <?php
			     	}}
				?>

			</div>
		</div>

		<div class="clearfix"></div>
                </div>
	</div>
    <div class="text-center">
<button type="button" class="btn btn-default btn-sm" onclick="$('#pdf').print();">
          <h1><span class="glyphicon glyphicon-print"></span> Print</h1>
        </button>
		<br/>
 
</div>
</body>
</html>