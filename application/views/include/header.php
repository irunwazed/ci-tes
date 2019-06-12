	<div class="pre-loader"></div>
	<div class="header clearfix">
	<!-- background-image: url('<?=base_url()?>public/images/atas.png'); -->
		<div class="header-right"  style="background-position: right; background-size: cover;background-repeat: no-repeat; background-color: #d1ecf8; ">
			<div class="brand-logo">
				<a href="index.php">
					<!-- <img src="<?=$baseTemplate?>vendors/images/logo.png" alt="" class="mobile-logo"> -->
					<img src="<?=$baseTemplate?>vendors/images/logo1.png" alt="">
				</a>
			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o"></i></span>
						<span class="user-name"><?=$this->session->userdata('username')?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a class="dropdown-item" href="profile.php"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a>
						<a class="dropdown-item" href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
						<a class="dropdown-item" href="faq.php"><i class="fa fa-question" aria-hidden="true"></i> Help</a> -->
						<a class="dropdown-item" href="<?=$baseUrl."logout"?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>