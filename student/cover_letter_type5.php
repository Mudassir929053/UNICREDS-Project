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
	
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<style>
    body{
	margin: 0px;
	padding: 0px;
	/* background-image: radial-gradient(#c7c7c7 25%, #c7c7c7 74%); */
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
	padding: 20px;
}

.p1{
	color: white;
	font-size: 40px;
	font-weight: bold;
	margin: 0px;
	margin-top: 10px;
}
.p1 span{
	font-weight: 100;
	color: #c7c7c7;
}
.p2{
	font-size: 20px;
	color: #c7c7c7;
	margin: 0px;
	margin-top: 10px;
	font-weight: bold;

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
	font-size: 20px;
	text-transform: uppercase;
	font-weight: 600;
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
        min-height: 28.5cm;
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
   
<?php 
  $query = $conn->query("SELECT * FROM cover_letter
   where user_id = '$suID' 
   order by coverletter_id desc
                         limit 1;");

if (mysqli_num_rows($query) > 0) {
  while ($rows = mysqli_fetch_object($query)) {
    

 ?> 

<div class="main">
    <div class="container page"id="pdf">
		<div class="top-section">
	    <img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										  width="180px"/>
			<p class="p1"> <?php echo $rows->name; ?></p>
			<p class="p2">Cover Letter</p>
		</div>
		<div class="clearfix"></div>

		<div class="col-div-4">
			<div class="content-box" style="padding-left: 40px;">

				
			<p class="head">Contact</p>
			<p class="p3"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;   <?php echo $rows->contact_no; ?></p>
			<p class="p3"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;&nbsp; <?php echo $rows->email; ?></p>
			<p class="p3"><i class="fa fa-home" aria-hidden="true"></i> &nbsp;&nbsp; <?php echo $rows->address; ?></p>
			<br/>
			<br/>	
			</div>
		</div>
		<div class="line"></div>
		<div class="col-div-8">
			<div class="content-box"><br>
			<div class="date">
			<?php echo $rows->created_date; ?>
						</div>
						<br>
						<div class="title1">
							<p>  <?php echo $rows->introduction; ?>
							</p>
						</div>

						<div class="title1">
							<p> <?php echo $rows->current_situation; ?></p>
						</div>
						
						<div class="title1">
							<p> <?php echo $rows->motivation; ?></p>
						</div>
						<div class="title1">
							<p> <?php echo $rows->closing; ?></p><br>

							<b>Sincerely,</b><br>
							<strong> <?php echo $rows->name; ?></strong>
						</div><br>
						

						<div class="title">
							<b>Thank you</b>
						</div>
	
			<br/>
           
			<p class="head"></p>
           

			<br/>
           
			<p class="head"></p>
           

			</div>
		</div>

		<div class="clearfix"></div>
                </div>
	</div>
    <div class="text-center">
			<button type="button" class="  btn btn-success mt-4" onclick="$('#pdf').print();">
				<h3> Print Cover Letter</h3>
			</button>
		</div>
		<br/>
 
</div>
<?php
                      }
          ?>
          <?php

} else {
    echo "data not found";
}
?>
</body>
</html>