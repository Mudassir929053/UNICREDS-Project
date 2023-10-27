<html>
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Favicon icon -->
		<link rel="icon" href="assets/images/favicon/unicreds_1.png">
		<title>Unicreds - Session Expired</title>
		<!-- Bootstrap Core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="assets/css/style.css" rel="stylesheet">
		<!-- You can change the theme colors from here -->
		<link href="assets/css/colors/default-dark.css" id="theme" rel="stylesheet">
		<style>
			.vertical-center {
				margin: 0;
				position: absolute;
				top: 50%;
				-ms-transform: translateY(-50%);
				transform: translateY(-50%);
			}
		</style>
	</head>

<script>
		<?php 
			include('assets/js/loading.js');
		?>
		setTimeout(function(){location.href = "index.php";}, 4000);
	</script>
	<?php
		session_start();
		session_unset();
		session_destroy();
		$_SESSION = array();
	?>
	<body>
		<div class="h-100">
			<div class="col-12 vertical-center">
				<div class="card" style="background: transparent; border: none;">
					<div class="card-body text-center">
						<h3><img src="assets/images/logo/logo 1.png"><br><br>Your session has expired. Please login to continue.</h3>
						<h3>This page will redirect you to login page automatically.<br><br>.<span id="wait"></span></h3>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>