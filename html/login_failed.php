
<html>
<head>
	<title>Lappia Halli - Login Failed</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="css/css.css" type="text/css">
	<script type="text/javascript" src="cameraView.js"></script>
</head>
<body onLoad="cameraView()">

	<div id="tlo">
	</div>

	<div id="strona">

		<div id="gora_pasek">
			<div id="container_top">
				<div id="login_bar">
				<form action="login.php" method="post">
						<p><label for="username">E-mail:</label> <input type="text" id="username" name="username"/></p>
						<p><label for="password">Password:</label> <input type="password" id="password" name="password" /></p>
						<p class="submit"><input type="submit" name="submit" value="Login" /></p>
					</form>
					<div id="pass_reg">
						<a href="lost_password.php">Lost Password?</a>
						<a href="register_second.php">Register</a>
					</div>
				</div>
			</div>

			<div id="bottom_menu">
				<a href="../index.php">Home Page</a>
				<a href="costs.php">Costs</a>
				<a href="aboutus.php">About Us</a>
				<a href="faq.php">FAQ</a>
				<a href="privacypolicy.php">Privacy Policy</a>
				<a href="help.php">Help</a>
			</div>
		</div>
	<div id="lewy_pasek">
			<div id="ad">
				<img src="../images/lappia_baner.png" name="webcam" width="60" height="468">
			</div>
			</div>
			<div id="srodek_pasek">
			<div id="text_field_1">
				<div id="container_middle">
				<div id="alert"><p><?php echo "Email or Password incorrect!!!"?></p></div>
					<div id="login_bar2">

					<br/>
					<br/>
						<form action="login.php" method="post">
						<p><label for="username">E-mail:</label> <input type="text" id="username" name="username"/></p>
						<p><label for="password">Password:</label> <input type="password" id="password" name="password" /></p>
						<p class="submit"><input type="submit" name="submit" value="Login" /></p>
					</form>
					</div>
					<div id="pass_reg2">
						<a href="lost_password.php">Lost Password?</a>
						<a href="register_second.php">Register</a>
					</div>
				</div>
			</div>
		</div>

		<div id="prawy_pasek">
			<div id="webcams">
				<div id="webcam1">
					<img src="images/1265849610942_20.png" name="webcam1" id="camera1" width="300" height="280">
				</div>
				<div id="webcam2">
					<img src="images/rect2888.png" name="webcam2" id="camera2" width="300" height="280">
				</div>
			</div>
		</div>

	</div>

</body>
</html>
