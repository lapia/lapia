<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<html>
<head>
	<title>Lappia Halli - FAQ</title>
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
					<div id="text_field_2" style="width: 511px; height: 603px; overflow: auto; border: 0px solid #666; background-color: trnsparent; padding: 0px 10px 0px 10px; margin: 25px 0px 25px 0px; text-align:left">
						<h1 style="text-align: center">FAQ:</h1>
						<p class="left">Welcome to the frequently asked question section page.</p>
						<p class="left">Listed below are a few questions from our esteemed customers and our resolute to ensure that a proper service is rendered at all time.</p>
						<ol>
							<li>What happens if I cancel a reservation made earlier, does this further affect my chances to re-booking later on?</li>
							<li>Are there any security measures put in place to ascertain safety? For an example, a first aid service.</li>
							<li>How many reservations can I make?</li>
						</ol>
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

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/~test/newuser.php'</script>"
?>

</body>
</html>
