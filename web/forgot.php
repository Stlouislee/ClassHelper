<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Password Reset::ClassHelper</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" /> 

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="doForgot.php" method="post">
					<span class="login100-form-title p-b-49">Password Reset</span>

          <div align="center" style="color:red"><?php echo $_GET["warnMsg"]; ?></div>
          <div align="center" style="color:green"><?php echo $_GET["prompt"]; ?></div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="email">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Enter the email address you used to register" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

          <div align="center">If you enter the correct email address, we will send you an email later to help you reset your password.</div>
          <div><br></div>


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">Send</button>
						</div>
					</div>



				</form>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>