<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<html>
<head>
	<title>Lappia Halli - Registration</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
	<script type="text/javascript" src="form_validation.js"></script>
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
				<div id="register_form">
					<form action="reg_form2.php" onsubmit="return validate_form(this)" enctype="multipart/form-data" method="post">

					<p>
						<?php if(isset($_SESSION['already_err'])) {
							?>
							<?php echo $_SESSION['already_err'];
							unset($_SESSION['already_err']);?>
						<?php }?>
					</p>
					<p>
						<?php if(isset($_SESSION['success'])) {
							?>
							<?php echo $_SESSION['success'];
							unset($_SESSION['success']);?>
						<?php }?>
					</p>


						<fieldset>
							<br/>
						<fieldset>
							<legend>Login Information:</legend>
							E-mail:
							<br>
							<input name="email" type="text" size="40">
							<br>
							Password [6 - 12 chars]:
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
							<input name="Phone" type="text" size="40">
							<br>
						</fieldset>
						<br>
						<input type="submit" name="register" value="Register" id="submit">
						<input type="reset" value="Reset" name= "reset"/>
						</fieldset>
					</form>
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
						newImage.src = "images/1265849610942_20.jpg?time=" + unique.getTime();
					}

					function InitialImage() {
						var unique = new Date();
						newImage.onload = LoadNewImage;
						newImage.src = "images/1265849610942_20.jpg?time=" + unique.getTime();
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
