<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Lappia Halli - Edit Profile</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
</head>
<body>

</head>

<body>

	<div id="tlo">
	</div>

	<div id="strona">

		<div id="gora_pasek">
			<div id="container_top">
				<div id="login_bar">
					<form action="html/login.php" method="post">
						<p><label for="username">E-mail:</label> <input type="text" id="username" name="username"/></p>
						<p><label for="password">Password:</label> <input type="password" id="password" name="password" /></p>
						<p class="submit"><input type="submit" name="submit" value="Login" /></p>
					</form>
					<div id="pass_reg">
						<a href="html/lost_password.php">Lost Password?</a>
						<a href="html/register_second.php">Register</a>
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
					<div id="editprofile_form">
						<form method="get">
						<div class="row">
							<label for="txt_E-mail" id="E-mail-ariaLabel">E-mail: </label>
							<input id="txt_E-mail" name="txt_E-mail" type="text" aria-labelledby="E-mail-ariaLabel" />
						</div>
						<div class="row">
							<label for="pwd_Password" id="Password-ariaLabel">Password: </label>
							<input id="pwd_Password" name="pwd_Password" type="password" aria-labelledby="Password-ariaLabel" />
						</div>
						<div class="row">
							<label for="pwd_RepeatPassword" id="RepeatPassword-ariaLabel">Repeat Password: </label>
							<input id="pwd_RepeatPassword" name="pwd_RepeatPassword" type="password" aria-labelledby="RepeatPassword-ariaLabel" />
						</div>
						<div class="row">
							<label for="txt_NameofOrganisation" id="NameofOrganisation-ariaLabel">Name of Organisation: </label>
							<input id="txt_NameofOrganisation" name="txt_NameofOrganisation" type="text" aria-labelledby="NameofOrganisation-ariaLabel" />
						</div>
						<div class="row">
							<label for="txt_ContactPerson" id="ContactPerson-ariaLabel">Contact Person: </label>
							<input id="txt_ContactPerson" name="txt_ContactPerson" type="text" aria-labelledby="ContactPerson-ariaLabel" />
						</div>
						<div class="row">
							<label for="txt_Address" id="Address-ariaLabel">Address: </label>
							<input id="txt_Address" name="txt_Address" type="text" aria-labelledby="Address-ariaLabel" />
						</div>
						<div class="row">
							<label for="txt_Phone" id="Phone-ariaLabel">Phone: </label>
							<input id="txt_Phone" name="txt_Phone" type="text" aria-labelledby="Phone-ariaLabel" />
						</div>
						<!--<div class="row">
						<input type="submit" value="Save" />
						</div>-->
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

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/~test/newuser.php'</script>"
?>

</body>
</html>
