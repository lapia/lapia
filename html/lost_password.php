<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='0'; // set show nonregistred user form
	if(isset($_SESSION['FIRST_OPEN_SITE'])) unset($_SESSION['FIRST_OPEN_SITE']);
	$_SESSION['SQLSETTINGS']=array('host'=>'localhost','user'=>'root','password'=>'test1','dbname'=>'LHR');
	//ini_set('display_errors',1);

?>

<html>
<head>
	<title>Lappia Halli - Password recovery</title>
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
				<img src="../images/lappia_baner.png" name="webcam" width="60" height="468">
			</div>
			</div>
			<div id="srodek_pasek">
			<div id="text_field_1">
				<div id="container_middle">
				<div id="alert">
					<p>
						<?php echo "Forgot your password? Input you email below";?>
					</p>
					<p>
						<?php
							if(isset($_SESSION['lost_already_err'])){
								echo $_SESSION['lost_already_err'];
								unset($_SESSION['lost_already_err']);
							}
						?>
					</p>
				</div>
					<div id="login_bar2">

					<br/>
					<br/>
						<form action="lost.php" method="post">
							<p>
								<label for="username">E-mail:</label>
								<input type="text" id="username" name="username"/>
							</p>
							<p class="submit">
								<input type="submit" name="submit" value="submit" />
							</p>
						</form>
					</div>
					<div id="pass_reg2">
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
