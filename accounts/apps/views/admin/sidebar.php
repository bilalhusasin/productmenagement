 <aside class="main-sidebar">
 	<!-- sidebar: style can be found in sidebar.less -->
 	<section class="sidebar">

 		<!-- Sidebar user panel -->
 		<div class="user-panel">
 			<div class="pull-left image">
 				<img src="assets/images/avatar-mini.png" class="img-circle" alt="User Image">
 			</div>
 			<div class="pull-left info">
 				<p><?php echo $this->session->user_name; ?></p>
 			</div>
 		</div>

 		<!-- BEGIN SIDEBAR MENU -->
 		<ul class="sidebar-menu" data-widget="tree">
 			<li class="header">MAIN NAVIGATION</li>
 			<li class="<?php if ($menu == 'dashboard') : ?>active<?php endif; ?>">
 				<a href="dashboard">
 					<i class="fa fa-dashboard"></i>
 					<span>Dashboard</span>
 				</a>
 			</li>
 			<?php if ($privileges['inventory_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'inventory') : ?>active<?php endif; ?>">
 					<a href="inventory" class="">
 						<i class="fa fa-balance-scale"></i>
 						<span>Inventory</span>
 					</a>
 				</li>
 			<?php endif; ?>
 			<?php if ($privileges['accounts_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'accounts') : ?>active<?php endif; ?>">
 					<a href="accounts" class="">
 						<i class="fa fa-calculator"></i>
 						<span>Accounts</span>
 					</a>
 				</li>
 			<?php endif; ?>
 			<?php if ($privileges['hr_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'hr') : ?>active<?php endif; ?>">
 					<a href="hr/emp-list" class="">
 						<i class="fa fa-users"></i>
 						<span>H R</span>
 					</a>
 				</li>
 			<?php endif; ?>
 			<?php if ($privileges['report_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'report') : ?>active<?php endif; ?>">
 					<a href="report" class="">
 						<i class="fa fa-columns"></i>
 						<span>Reports</span>
 					</a>
 				</li>
 			<?php endif ?>
 			<?php if ($privileges['settings_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'settings') : ?>active<?php endif; ?>">
 					<a href="settings" class="">
 						<i class="fa fa-gear"></i>
 						<span>Settings</span>
 					</a>
 				</li>
 			<?php endif ?>
 			<?php if ($privileges['user_menu'] == 1) : ?>
 				<li class="<?php if ($menu == 'user') : ?>active<?php endif; ?>">
 					<a href="user/list-all" class="">
 						<i class="fa fa-user"></i>
 						<span>Users</span>
 					</a>
 				</li>
 			<?php endif; ?>
 		</ul>
 		<!-- END SIDEBAR MENU -->
 	</section>
 </aside>