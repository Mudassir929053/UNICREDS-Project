<nav class="navbar navbar-expand-lg navbar-default">
	<div class="container-fluid px-0">
		<a class="navbar-brand" href="../index.php"><img src="../assets/images/brand/logo/Icon-256.png" alt="" /></a>
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
		<div class="collapse navbar-collapse" id="navbar-default">
			<ul class="navbar-nav ">

				<!-- Catalog dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarCatalog" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Catalog
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarCatalog">
						<li>
							<h4 class="dropdown-header">Catalog</h4>
						</li>
						<li>
							<a href="course-lists.php" class="dropdown-item">
								Courses
							</a>
						</li>
						<li>
							<a href="micro-creds-lists.php" class="dropdown-item">
								Micro-credentials
							</a>
						</li>
					</ul>
				</li>
				<!-- Catalog dropdown -->


				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Employment Search
					</a>
					<ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarPages">
						<li>
							<h4 class="dropdown-header">Employment</h4>
						</li>
						<li class="dropdown-submenu dropend">
							<a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
								Job Hunting
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="job-search.php" class="dropdown-item">
										Search Job
									</a>
								</li>

							</ul>
						</li>
						<li>
							<a href="job-industry-search.php" class="dropdown-item">
								Company Profiles
							</a>
						</li>
					</ul>

				</li>


				<!-- About dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarAbout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						About
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarAbout">
						<li>
							<h4 class="dropdown-header">About Us</h4>
						</li>
						<li>
							<a class="dropdown-item" href="about.php">
								About
							</a>
						</li>
						

						<li class="dropdown-submenu dropend">
							<a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
								Help Center 
							</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="help-center.php">
										Help Center
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="help-faq.php">
										FAQ's
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="manual.php">
										Manual
									</a>
								</li>
								
								<li>
									<a class="dropdown-item" href="support.php">
										Support
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a class="dropdown-item" href="contact.php">
								Contact
							</a>
						</li>
					</ul>
				</li>
				<!-- About dropdown -->






			</ul>


			</ul>
			<!-- Search bar -->
			<form id="searchBox" action="search-results.php" method="post" enctype="multipart/form-data" class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center">
				<span class="position-absolute ps-3 search-icon">
					<i class="fe fe-search"></i>
				</span>
				<input type="search" class="form-control ps-6" name="query" placeholder="Search Catalog" autocomplete="off">
				<!-- Search results -->
				<!-- class property: `invisible - visible`, `opacity: 0 - opacity: 1` -->
				<div id="search-result" class="dropdown-menu dropdown-menu-lg mw-50 invisible" style="opacity: 0;">
					<h6 class="dropdown-header text-primary">Matched</h6>
					<div class="scrollbar" style="max-height: 300px;">
						<ul id="matched-result" class="list-group overflow-auto list-group-flush">
							<!-- contents here -->
						</ul>
					</div>
					<!-- <h6 class="dropdown-header text-primary mt-3">Relevant</h6>
					<div class="scrollbar" style="max-height: 300px;">
						<ul id="relevant-result" class="list-group overflow-auto list-group-flush">

						</ul>
					</div> -->
				</div>
			</form>

			<!-- Login btn / Register btn -->
			<ul class="navbar-nav navbar-right-wrap ms-auto py-2">

				<div class=" nav-item dropdown tab-pane tab-example-design fade show active" id="pills-simple-button-design" role="tabpanel" aria-labelledby="pills-simple-button-design-tab">
					<a href="../sign-in.php" class="btn btn-info btn-sm">Login</a>
					<a href="../registerselection.php" class="btn btn-primary btn-sm">Register </a>

			</ul>


		</div>
	</div>
</nav>