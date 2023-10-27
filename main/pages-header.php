
<nav class="navbar navbar-expand-lg navbar-default">
	<div class="container-fluid px-0">
		<a class="navbar-brand" href="index.php"><img src="assets/images/brand/logo/Icon-256.png" alt="" width="260" height="60"/></a>
		<!-- Mobile view nav wrap -->
		<ul class="navbar-nav navbar-right-wrap ms-auto d-lg-none d-flex nav-top-wrap">
		</ul>
		<!-- Button -->
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icon-bar top-bar mt-0"></span>
			<span class="icon-bar middle-bar"></span>
			<span class="icon-bar bottom-bar"></span>
		</button>
		<!-- Collapse -->
		<div class="collapse navbar-collapse text-center" id="navbar-default">
			<div class="container" style="display: flex; justify-content: center;">
			<ul class="navbar-nav">

				<!-- Catalog dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarCatalog" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 80px;font-size: 20px;">
						Catalog
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarCatalog">
						<li>
							<h4 class="dropdown-header">Catalog</h4>
						</li>
						<li>
							<a href="./public/course-lists.php" class="dropdown-item">
								Courses
							</a>
						</li>
						<li>
							<a href="./public/micro-creds-lists.php" class="dropdown-item">
								Micro-credentials
							</a>
						</li>
					</ul>
				</li>
				<!-- Catalog dropdown -->
				<!-- Employment search dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 80px;font-size: 20px;">
						Employment Search
					</a>
					<ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarPages">
						<li>
							<h4 class="dropdown-header">Employment</h4>
						</li>
						<li class="dropdown-submenu dropend">
							<a class="dropdown-item dropdown-list-group-item" href="#">
								Job Hunting
								<span class="dropdown-toggle"></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="./public/job-search.php" class="dropdown-item">
										Search Job
									</a>
								</li>

							</ul>
						</li>
						<li>
							<a href="./public/job-industry-search.php" class="dropdown-item">
								Company Profiles
							</a>
						</li>
					</ul>

				</li>


				<!-- About dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarAbout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20px;">
						About
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarAbout">
						<li>
							<h4 class="dropdown-header">About Us</h4>
						</li>
						<li>
							<a class="dropdown-item" href="./public/about.php">
								About
							</a>
						</li>
						

						<li class="dropdown-submenu dropend">
							<a class="dropdown-item dropdown-list-group-item" href="#">
								Help Center 
								<span class="dropdown-toggle"></span>

							</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="./public/help-center.php">
										Help Center
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="./public/help-faq.php">
										FAQ's
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="./public/manual.php">
										Manual
									</a>
								</li>
								
								<li>
									<a class="dropdown-item" href="./public/support.php">
										Support
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a class="dropdown-item" href="./public/contact.php">
								Contact
							</a>
						</li>
					</ul>
				</li>
				<!-- About dropdown -->
			</ul>
			</ul>
			</div>
			<!-- <form class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center ">
				<span class="position-absolute ps-3 search-icon">
					<i class="fe fe-search"></i>
				</span>
				<input type="search" class="form-control ps-6" placeholder="Search ..." />
			</form> -->

			<!-- Login btn / Register btn -->
			<ul class="navbar-nav navbar-right-wrap ms-auto py-2">

				<div class=" nav-item dropdown tab-pane tab-example-design fade show active" id="pills-simple-button-design" role="tabpanel" aria-labelledby="pills-simple-button-design-tab">
					<a href="./sign-in.php" class="btn badge-pill" style="border-radius: 30px;font-size: 20px;color: #000000 ;padding: 10px 40px 10px 40px; border:1px solid #107575;">Login</a>
					<!-- <a href="./registerselection.php" class="btn btn-primary btn-sm">Register </a> -->

			</ul>


		</div>
	</div>
</nav>