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
		/* @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap'); */

		* {
			margin: 0;
			padding: 0;
			list-style: none;
			box-sizing: border-box;
			font-family: 'Ubuntu', sans-serif;
		}



		.resume {
			width: 800px;
			background: #fff;
			margin: 25px auto;
			display: flex;
		}

		.left {
			background: #003D63;
			width: 250px;
			padding: 0 20px;
		}

		.right {
			width: calc(100% - 250px);
		}

		.left .img_holder {
			text-align: center;
			padding: 20px 0;
		}

		.left .img_holder img {
			width: 200px;
			border-radius: 30px;
		}

		.pb {
			padding-bottom: 20px;
		}

		.title {
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

		.title:before {
			content: "";
			position: absolute;
			top: 35px;
			right: 0;
			width: 50px;
			height: 3px;
			background: #3525af;
		}

		.left .icon {
			font-size: 20px;
			color: #9153c9;
		}

		.left .text {
			color: #9153c9;
			text-transform: uppercase;
			font-size: 13px;
		}

		.contact .li_wrap {
			display: flex;
			align-items: center;
			width: 100%;
			margin-bottom: 15px;
		}

		.contact .li_wrap .icon {
			width: 30px;
			height: 30px;
			background: #fff;
			border-radius: 15px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 15px;
		}

		.contact .li_wrap .text {
			width: calc(100% - 50px);
			word-break: break-word;
			color: #fff;
		}

		.skills ul,
		.hobbies ul {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		.skills .li_wrap,
		.hobbies .li_wrap {
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

		.skills .li_wrap {
			background: #fff;
		}

		.skills .li_wrap .text,
		.hobbies .li_wrap .text {
			margin-top: 5px;
		}

		.hobbies .li_wrap {
			border: 2px solid #fff;
		}

		.hobbies .li_wrap .icon,
		.hobbies .li_wrap .text {
			color: #fff;
		}

		.hobbies .li_wrap:hover {
			background: #fff;
		}

		.hobbies .li_wrap:hover .icon,
		.hobbies .li_wrap:hover .text {
			color: #9153c9;
		}

		.header {

			padding: 15px 30px;
			color: #fff;
			height: 100px;
		}

		.header .name {
			font-size: 18px;
			text-transform: uppercase;
			font-weight: 700;
			color: #3525af;
		}

		.header .role {
			font-weight: 300;
			font-size: 20px;
		}

		.header .about {
			margin-top: 20px;
			line-height: 26px;
		}

		.right_inner {
			padding: 30px;
			color: #292b2f;
		}

		.right_inner .education {
			margin-top: 30px;
		}

		.right_inner .li_wrap {
			display: flex;
			margin-bottom: 15px;
		}

		.right_inner .li_wrap .date {
			width: 125px;
			color: #9153c9;
		}

		.right_inner .li_wrap .info {
			width: calc(100% - 125px);
			padding-left: 25px;
			position: relative;
		}

		.right_inner .li_wrap .info_title {
			text-transform: uppercase;
			font-weight: 600;
			letter-spacing: 1px;

		}

		.right_inner .li_wrap .info_com {
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


		.right_inner .li_wrap .info_cont {
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
				min-height: 28.5cm;
				border-radius: initial;

				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}

		.right_inner .li_wrap .info:before {
			content: "";
			position: absolute;
			top: 3px;
			left: 0;
			width: 10px;
			height: 10px;
			background: #9153c9;
			border-radius: 50%;
		}

		.expdesc {
			text-align: justify;
		}

		.right_inner .li_wrap .info:after {
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
		include 'pages-head.php';
		?>

<?php 
  $query = $conn->query("SELECT * FROM cover_letter
   where user_id = '$suID' 
   order by coverletter_id desc
                         limit 1;");

if (mysqli_num_rows($query) > 0) {
  while ($rows = mysqli_fetch_object($query)) {
    

 ?> 
		<!-- Top navigation -->
		<?php
		include 'pages-topbar.php';
		?>
		<div class="resume  wrapper  ">
			<div class="resume shadow-lg page" id="pdf">
				<div class="left bg-warning">
					<div class="img_holder">
					<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="" />
                                        
						<h3>
							<div class="name" style="color:white;">
							<?php echo $rows->name; ?>
							</div>
						</h3>
						<hr>

					</div>
					<div class="contact_wrap ">
						<h4>
							<div class="">
								CONTACT
							</div>
						</h4>
						<div class="contact">
							<ul>
								<li>
									<div>Phone</div>
									<div class="li_wrap">
										<div class="text"><?php echo $rows->contact_no; ?></div>
									</div>
								</li>
								<li>
									<div>Email</div>
									<div class="li_wrap">

										<div class="text"><?php echo $rows->email; ?></div>
									</div>
								</li>
								<li>
									<div>Address</div>
									<div class="li_wrap">

										<div class="text"><?php echo $rows->address; ?></div>
									</div>
								</li>


							</ul>
						</div>
					</div>

					

				</div>
				<div class="right bg-dark">
					<div class="header">
						<div class="">
							<h2>Cover letter</h2>
						</div>
						<hr>
					</div>
					<div class="right_inner">
						<div class="date">
							<p><?php echo $rows->created_date; ?></p>
						</div>
						
						<div class="title1">
							<p> <?php echo $rows->introduction; ?>
							</p>
						</div>

						<div class="title1">
							<p><?php echo $rows->current_situation; ?></p>
						</div>
						
						<div class="title1">
							<p><?php echo $rows->motivation; ?></p>
						</div>
						<div class="title1">
							<p><?php echo $rows->closing; ?></p><br>

							<b>Sincerely,</b><br>
							<strong><?php echo $rows->name; ?></strong>
						</div><br>
						<br>

						<div class="title">
							<b>Thank you</b>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="text-center">
  <button type="button" name="updatecoverletter" id="updatecoverletter" class="  btn btn-success mt-4"onclick="window.location.href='cover_letter_templates.php'">Back</button>
			<button type="button" class="  btn btn-success mt-4" onclick="$('#pdf').print();">
				Print Cover Letter
			</button>
		</div>

		<?php
		include 'pages-footer.php';

		?>
	</body>
	<?php
                      }
          ?>
          <?php

} else {
    echo "data not found";
}
?>
	</html>
</body>

</html>