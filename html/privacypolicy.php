<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<html>
<head>
	<title>Lappia Halli - Privacy Policy</title>
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
			</div>
		</div>

		<div id="srodek_pasek">
				<div id="text_field_1">
					<div id="text_field_2" style="width: 511px; height: 603px; overflow: auto; border: 0px solid #666; background-color: trnsparent; padding: 0px 10px 0px 10px; margin: 25px 0px 25px 0px; text-align:left">
						<h1 style="text-align: center">PRIVACY POLICY:</h1>
						<p class="left">Lappia Halli’s Privacy Policy:</p>
						<p class="left">Your trust is of utmost importance to us and by being transparent as best as we can. We would be glad to render our services making sure every of the detail provided by you is kept private.</p>
						<p class="left">We have a guiding rule set aside to ensure the effectiveness of our pledge and these policies which are in 4 sections are listed below:</p>
						<ol>
							<li>The information we receive:<br><p>When we receive info through your consent such as e-mail, phone number, card info e.t.c under no condition except if instructed by you do we disclose them.</p></li>
							<li>How we use your information:<br><p>After receiving your supply of info, we match the date of choice to the available dates and if this is vacant an authorization is made but your details are never disclosed to any other party.</p></li>
							<li>How you can view, change or delete:<br><p>You have the sole responsibility to manage your account and play around whatever bookings you have made. Whatever you do to your account is highly in your care as there are different options to choose.</p></li>
							<li>How to protect information:<br><p>We do our maximum best to protect your details you must also help us.</p></li>
						</ol>
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

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/~test/newuser.php'</script>"
?>

</body>
</html>
