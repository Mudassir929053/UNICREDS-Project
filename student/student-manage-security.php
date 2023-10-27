<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
	include('pages-head.php');
?>

<body>
    <!-- Top navigation -->
<?php
	include('pages-topbar.php');
?>

	<!-- Page Content -->
	<div class="pt-5 pb-5">
		<div class="container">
			<!-- Student university info -->
			<div class="row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<!-- Bg -->
					<div class="pt-16 rounded-top-md" style="
														background: url(../assets/images/background/profile-bg.jpg) no-repeat;
														background-size: cover;
						">
					</div>
					<div class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
						<div class="d-flex align-items-center">
							<div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n8">
								<span class="avatar avatar-xxl">
									<img src="<?= $suInfoRow["su_profile_pic"] !== NULL ? "../assets/images/avatar/" . $suInfoRow["su_profile_pic"] : "../assets/images/avatar/avatardefault.png" ?>"
										 alt="" class="rounded-circle" />
								</span>
							</div>
							<div class="lh-1">
								<h2 class="mb-0">
									<?= $suInfoRow["su_fname"] . " " . $suInfoRow["su_lname"] ?>
								</h2>
								<p class="mb-0 d-block"><?= $suInfoRow["su_email"] ?></p>
							</div>
						</div>
						<div>
							<a href="student-home-page.php" class="btn btn-outline-primary btn-sm d-none d-md-block">
								Go to Dashboard
							</a>
						</div>
					</div>
				</div>
			</div>

            <!-- Content -->
            <div class="row mt-0 mt-md-4">
                <div class="col-lg-3 col-md-4 col-12">
			<?php
				include("student-sidebar.php");
			?>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
							<h3 class="mb-0">Email & Password</h3>
							<p class="mb-0 ">Update your email and change your password here.</p>
                        </div>
						<!-- Alert icons -->
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                              <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                              </symbol>
                              <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                              </symbol>
                              <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </symbol>
                        </svg>
                        <!-- Card body -->
						<div class="card-body ps-6">
							<!-- Change email address -->
							<h4 class="mb-0">Email Address </h4>
							<p>
								Your current email address is <span class="text-success"><?= $suInfoRow["su_email"] ?></span>
							</p>
							<!-- Email update notification alert -->
							<div id="emailAlert"></div>
							<!-- Email update -->
							<div class="row">
								<div class="mb-3 col-lg-6 col-md-12 col-12">
									<label class="form-label" for="email">New email address</label>
									<input id="email" type="email" name="new_email" class="form-control" placeholder="New email address" required="">
									<button type="button" id="changeEmail" class="btn btn-primary mt-4">Update Details</button>
								</div>
							</div>
							<hr class="my-5">
							<!-- Change password -->
							<div>
								<h4 class="mb-0">Change Password</h4>
								<p>
									You can change your password here.<br>
									<span class="text-warning fw-medium">Choose a strong password and don't reuse your old password.</span>
								</p>
								<!-- Password update notification alert -->
								<div id="pwdAlert"></div>
								<div class="row">
									<div class="col-lg-6 col-md-12 col-12">
										<!-- Current password -->
										<div class="mb-1">
											<label class="form-label" for="currentpassword">Current password</label>
											<input id="currentpassword" type="password" name="currentpassword" class="form-control" placeholder="Current password" required="">
											<div class="form-check pt-0 mt-1 d-flex justify-content-end">
												<input class="form-check-input me-2" type="checkbox" value="" id="showPwd">
												<label class="form-check-label fs-5 text-muted" for="showPwd">Show password</label>
											</div>
										</div>
										<!-- New password -->
										<div class="mb-1 "> <!-- [password-field] -->
											<label class="form-label" for="newpassword">New password</label>
											<input id="newpassword" type="password" name="newpassword" class="form-control" placeholder="New password" aria-label="New password" aria-describedby="new-password">
											<div class="form-check pt-0 mt-1 d-flex justify-content-end">
												<input class="form-check-input me-2" type="checkbox" value="" id="showPwd0">
												<label class="form-check-label fs-5 text-muted" for="showPwd0">Show password</label>
											</div>
											<!-- Password strength meter -->
											<!-- <div class="row align-items-center g-0">
												<div class="col-6 ">
													<span>
														Password strength <i class="fas fa-question-circle ms-1 imgtooltip" data-template="pwdRequirement"></i>
														<div id="pwdRequirement" class="d-none">
															<div class="d-flex align-items-center">
																<h5 class="mb-0">Password requirements:</h5>
															</div>
															<ul>
																<li class="text-body">At least 8 characters</li>
																<li class="text-body">A mixture of both Uppercase and Lowercase letters.</li>
																<li class="text-body">A mixture of letters and numbers.</li>
																<li class="text-body">Inclusion of at least one special character (eg. !, @, #, ?, ]).</li>
															</ul>
														</div>
													</span>
												</div>
											</div> -->
										</div>
										<!-- Confirm new password -->
										<div class="mb-3">
											<label class="form-label" for="confirmpassword">Confirm new password</label>
											<small id="alert_msg" class="ms-3"></small>
											<input type="password" name="confirmpassword" class="form-control" placeholder="Confirm new password" aria-label="Confirm password" aria-describedby="confirm-password">
											<div class="form-check pt-0 mt-1 d-flex justify-content-end">
												<input class="form-check-input me-2" type="checkbox" value="" id="showPwd1">
												<label class="form-check-label fs-5 text-muted" for="showPwd1">Show password</label>
											</div>
										</div>
										<button type="button" id="resetPassword" href="#" class="btn btn-primary" disabled>Save Password</button>
										<div class="col-6"></div>
									</div>
									<div class="col-12 mt-4">
										<p class="mb-0 ">
											Can't remember your current password? <a href="#">Reset your password via email</a>
										</p>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Footer -->
<?php
	include('pages-footer.php');
?>


	<!-- Scripts -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
	<!-- Security JS -->
	<script src="js/student-security.js"></script>
</body>

</html>