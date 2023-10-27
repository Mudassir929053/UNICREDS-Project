<?php
include './database/dbcon.php';
include 'function.php';

?>

<!DOCTYPE html>
<html lang="en">


<title>Sign up </title>

<?php
include 'main/pages-head.php';
?>

<body>
	<!-- Page content -->

	<div class="container d-flex flex-column">
		<div class="row align-items-center justify-content-center g-0 min-vh-100">
			<div class="col-lg-6 col-md-8 py-8 py-xl-0">
				<!-- Card -->
				<div class="card shadow">
					<!-- Card body -->

					<div class="card-body p-6">
						<div id="studentuni">

							<div class="mb-1" style="text-align: center;">
								<a href="index.php"><img src="assets/images/brand/logo/Icon-196.png" class="mb-1" alt=""></a>

							</div>
							<h1 class="mb-2 fw-bold">Sign Up</h1>
							<div class="mb-2">
								<span>Already have an account?
									<a href="sign-in.php" class="mb-2 ms-2">Sign In</a></span>
							</div>



							<div class="mb-2">
								<label class="form-label">Currently I am :</label>
								<label for="student" class="ms-2">Student</label>
								<input type="radio" onchange="swapConfig(this)" name="user_role_id" id="student" value="9" checked="checked" />

								<label for="expert" class="ms-2">Lecturer</label>
								<input type="radio" onchange="swapConfig(this)" name="user_role_id" id="expert" value="7" />
							</div>
							<!-- Form -->

							<!-- Radio Button-->

							<!-- Form -->
							<!-- Student-->


							<div class="mb-3" id="studentSettings">
								<label for="p1" class="form-label">Institution you learn</label>

								<div class="col-sm-12">
									<select class="form-control selectpicker " id="institution" value="institution" data-live-search="true" placeholder=" Search for School" name="uni">
										<option value="" selected disabled>Select University..</option>

										<?php $queryCheckInst = $conn->query("SELECT * from institution left join university ON institution_university_id = university.university_id where institution_deleted_date is null and institution_status = 'Active'");

										if (mysqli_num_rows($queryCheckInst) > 0) {
											while ($row = mysqli_fetch_object($queryCheckInst)) {
										?>
												<option value="<?php echo $row->institution_id; ?>" <?php if ($row->university_name == 'Unicreds' && $row->institution_id == '1') {
																										echo 'selected';
																									} ?>><?php echo $row->university_name; ?></option>

											<?php }
										} else {
											?>
										<?php
										} ?>
									</select>

								</div>

								<!-- Button Student-->
								<div class="d-grid sm-col-4"><br>

									<button class=" btn btn btn-primary" id="submit">
										Register
									</button>
									<!-- onclick="doThisOnClick(); -->

								</div>
							</div>


							<!-- Lecturer -->
							<form action="" method="POST">
								<div class="mb-3" id="expertSettings" style="display:none">

									<div class="row">
										<div class="mb-3 col-md-6">
											<label for="d1" class="form-label">First Name </label>
											<input style="text-transform:capitalize" type="text" id="name" class="form-control" name="lecturer_fname" placeholder="First Name" name="d1" autocomplete="off" required>
										</div>
										<div class="mb-3 col-md-6">
											<label for="d1" class="form-label">Last Name </label>
											<input style="text-transform:capitalize" type="text" id="name" class="form-control" name="lecturer_lname" placeholder="Last Name" name="d1" autocomplete="off" required>
										</div>
									</div>
									<label for="d1" class="form-label">Institution you teach</label>


									<!-- DropDown -->
									<div class="mb-3 col-sm-12">

										<select class="form-control selectpicker " id="select-institution" value="select-institution" data-live-search="true" placeholder=" Search for School" name="lecturer_uni">

											<option value="" selected disabled>Select University..</option>

											<?php
											$queryCheckInst = $conn->query("SELECT * from institution left join university ON institution_university_id = university.university_id where institution_deleted_date is null and institution_status = 'Active'");

											if (mysqli_num_rows($queryCheckInst) > 0) {
												while ($row = mysqli_fetch_object($queryCheckInst)) {
											?>
													<option value="<?php echo $row->institution_id; ?>" <?php if ($row->university_name == 'Unicreds' && $row->institution_id == '1') {
																											echo 'selected';
																										} ?>><?php echo $row->university_name; ?></option>
												<?php }
											} else {
												?>
											<?php
											} ?>
										</select>
									</div>



									<div class="mb-3">
										<label for="d1" class="form-label">Education email</label>
										<input type="email" id="email" class="form-control" name="lecturer_email" placeholder="eg. xxx@edu.com.my" name="d1" autocomplete="off" required/>
									</div>

									<div class="mb-4">
										<label name="d1" class="form-label">Password</label>
										<input type="password" id="password" class="form-control" name="user_password" placeholder="**************" name="d1" autocomplete="off" required/>
									</div>

									<!-- Checkbox -->
									<div class="mb-3">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="agreeCheck" value="check" id="agree" required />
											<label class="form-check-label" for="agreeCheck"><span>I agree to the <a href="#">Terms of
														Service </a>and
													<a href="#">Privacy Policy.</a></span></label>
										</div>
									</div>
									<!-- Button -->
									<div class="d-grid">
										<button type="submit" class="btn btn-primary" name="lectregister">

											Sign Up
										</button>
									</div>

								</div>


							</form>
						</div>



						<div style="display:none" id="inputform">
							<div class="mb-2 ms-0">
								<div class="row align-items-center">
									<div class="col-lg-6 col-md-6 col-12">
										<a href="index.php"><img src="assets/images/brand/logo/Icon-196.png"></a>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="fs-5 mt-4 mt-lg-0 pb-2 pb-lg-0 d-lg-flex justify-content-end">

											<span><a href="registerselection.php">Back</a></span>

										</div>
									</div>
								</div>

							</div>

							<h2 class="mb-2 fw-bold">Create your free account and let's study</h2>

							<!-- Form -->
							<form action="" method="POST" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }">

								<!-- Radio Button-->

								<!-- Form -->
								<!-- Student-->
								<div class="mb-1" id="studentSettings">


									<!-- <input type="text" id="institution_name" name="student_institution_name"> -->
									<div class="mb-2">
										<input type="hidden" id="institution_id" name="student_institution_id">
										<label class="form-label">Student at : <input type="text" name="institution_name" id="institution_name" style="border: none; font-weight: bold;" readonly>
										</label>
									</div>



									<div class="row">
										<div class="mb-3 col-md-6">
											<label for="p1" class="form-label">First Name </label>
											<input style="text-transform:capitalize" type="text" id="name" class="form-control" name="student_fname" placeholder="First Name" autocomplete="off" required>
										</div>

										<div class="mb-3 col-md-6">
											<label for="p1" class="form-label">Last Name </label>
											<input style="text-transform:capitalize" type="text" id="name" class="form-control" name="student_lname" placeholder="Last Name" autocomplete="off" required>
										</div>
									</div>

									<div class="mb-3">
										<label for="p1" class="form-label">Email </label>
										<input type="email" id="email" class="form-control" name="user_username" placeholder="Email address here" autocomplete="off" required>
									</div>

									<div class="mb-3">
										<label class="form-label">Password </label>
										<input type="password" id="password" class="form-control" name="user_password" placeholder="**************" autocomplete="off" required>
									</div>
								</div>

								<!-- Checkbox -->
								<div class="mb-3">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="agreeCheck" value="check" id="agree" required />
										<label class="form-check-label" for="agreeCheck"><span>I agree to the <a href="#">Terms of
													Service </a>and
												<a href="#">Privacy Policy.</a></span></label>
									</div>
								</div>

								<!-- Button -->
								<div class="d-grid">

									<button type="submit" class="btn btn-primary" name="stdntregister">
										Create Account
									</button>
								</div>
							</form>

						</div>


					</div>

				</div>
			</div>
		</div>
	</div>







	<script type="text/javascript">
		$(document).ready(function() {
			$("#submit").click(function() {
				var id = $('#student').val();
				var student_uni_id = $('#institution').val();

				$.ajax({
					method: 'POST',
					url: 'function.php',
					data: {
						type: 'read_university_name',
						role: id,
						uni_id: student_uni_id
					},
					success: function(data) {
						var result = JSON.parse(data);
						console.log(data);
						$("#inputform").show();
						$("#institution_name").val(result.uniname);
						$("#institution_id").val(result.institutionID);
						$("#studentuni").hide();

					}
				});


			});
		});




		function swapConfig(x) {
			var radioName = document.getElementsByName(x.name);
			console.log(radioName)
			for (i = +0; i < radioName.length; i++) {
				document.getElementById(radioName[i].id.concat("Settings")).style.display = "none";
			}
			document.getElementById(x.id.concat("Settings")).style.display = "initial";
		}

		$('.selectpicker').selectpicker({});
	</script>







	<!-- clipboard -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
	<script src="/js/Bootstrap/Select/bootstrap-select.js"></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script> -->



	<!-- Theme JS -->
	<script src="assets/js/theme.min.js"></script>
</body>

</html>