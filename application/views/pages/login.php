<!DOCTYPE html>
<html>
<head>
	<?=$head?>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="<?=$baseTemplate?>vendors/images/logo1.png" alt="login" style=" display: block; margin: 0 auto 20px; max-width: 200px;">
			<!-- <h2 class="text-center mb-30">Login</h2> -->
			<form method="POST" action="<?=$baseUrl?>login/cek">
				<div class="input-group custom input-group-lg">
					<input type="text" class="form-control" placeholder="Username" name="user">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" class="form-control" placeholder="**********" name="pass">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<!--
								use code for form submit
								<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Sign In">
							-->
							<button class="btn btn-outline-primary btn-lg btn-block">Masuk</button>
						</div>
					</div>
					<!-- <div class="col-sm-6">
						<div class="forgot-password padding-top-10"><a href="forgot-password.php">Forgot Password</a></div>
					</div> -->
				</div>
			</form>
		</div>
	</div>
	<?=$script ?>
</body>
</html>