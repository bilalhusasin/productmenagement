<!-- BEGIN TOP NAVIGATION BAR -->
<header id="header" class="main-header">
	<!-- BEGIN LOGO -->
	<a class="logo" href="dashboard">
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b><img src="assets/images/logo_top.png" width="100"></b></span>
	</a>
	<!-- END LOGO -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/avatar-mini.png" class="user-image" alt="User Image">
						<span class="hidden-xs"><?php echo $this->session->user_name; ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="assets/images/avatar.png" class="img-circle" alt="User Image">
							<p>
								<?php echo $this->session->user_name . ' - (' . $this->session->user_type . ')'; ?>
							</p>
						</li>

						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="user/change-password" class="btn btn-default btn-flat">Change Password</a>
							</div>
							<div class="pull-right">
								<a href="auth/logout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
			</ul>
		</div>
	</nav>
</header><!-- /header -->
<!-- END TOP NAVIGATION BAR -->
