<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="pl">

<head>
	<title>Register</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
</head>

<body>

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
				<a href="../index.html">Home</a>
				<a href="html/costs.html">Costs</a>
				<a href="html/au.html">About Us</a>
				<a href="html/disc.html">Disclaimer</a>
				<a href="html/pp.html">Privacy Policy</a>
				<a href="html/help.html">Help</a>
			</div>
		</div>

		<div id="lewy_pasek">
			<div id="ad">
			</div>
		</div>

		<div id="srodek_pasek">
			<div id="text_field_1">
				<div id="container_middle">
					<div id="register_form">
						<form action="reg_form.php" method="post">
							<br/>
							<br/>
							<br/>
							<br/>
							<fieldset>
								<br/>
							<fieldset>
								<legend>Login Information:</legend>
								E-mail:
								<br>
								<input name="email" type="text" size="40">
								<br>
								Password:
								<br>
								<input name="password" type="password"size="40">
								<br>
								Repeat Password:
								<br>
								<input name="password2" type="password" size="40">
							</fieldset>
							<br>
							<fieldset>
								<legend>Contact Information</legend>
								Name of Organisation:
								<br>
								<input name="name_of_organisation" type="text" size="40">
								<br>
								Contact Person:
								<br>
								<input name="contact_person" type="text" size="40">
								<br>
								Address:
								<br>
								<input name="Address" type="text" size="40">
								<br>
								Phone:
								<br>
								<input name="Phone" type="int" size="40">
								<br>
							</fieldset>
							<br>
							<input type="submit" name="submit" value="Register" id="submit">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="prawy_pasek">
			<div id="webcams">
				<script type="text/javascript" language="JavaScript">
					newImage = new Image();

					function LoadNewImage() {
						var unique = new Date();
						document.images.webcam.src = newImage.src;
						newImage.src = "../images/1265849610942_20.jpg?time=" + unique.getTime();
					}

					function InitialImage() {
						var unique = new Date();
						newImage.onload = LoadNewImage;
						newImage.src = "../images/1265849610942_20.jpg?time=" + unique.getTime();
						document.images.webcam.onload="";
					}
				</script>

				<div id="webcam1">
					<!--<h3>A</h3>-->
					<img src="../images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
				<div id="webcam2">
					<!--<h3>A</h3>-->
					<img src="../images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
			</div>
		</div>

	</div>

</body>
</html>
