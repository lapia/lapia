<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='0'; // set show nonregistred user form
	if(isset($_SESSION['FIRST_OPEN_SITE'])) unset($_SESSION['FIRST_OPEN_SITE']);
	$_SESSION['SQLSETTINGS']=array('host'=>'localhost','user'=>'root','password'=>'test1','dbname'=>'LHR');
?>

<html>
<head>
	<title>Lappia Halli - Cancel Reservation Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
</head>

<body>
	<?php
		include '../include/adduser.php';
		include 'sqlconnect.php';
		include '../include/calendar.php';
		include '../include/login.php';
		include '../include/area.php';
		include 'manuachosersdate.php';
		include '../include/genkey.php';
		include '../include/formnonregister.php';
		include 'cancel1.php';


		//ini_set('display_errors',1);

	?>

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
					<div id="calender_container">
						<div id="calender">
							<?php
								$cal=new Calendar();

								//infotab['free_time']; infotab['busy_period']
								// ManuaChosersDate class requires a second parameter an associative array of messages
								$infotab['free_time']="<br>reservations can be made<br>";
								$infotab['busy_period']="<br>time is busy<br>";
								$infotab['past_time']="<br>Sorry, the reservation is not possible.<br> Reservations must be made at least<br> 24 hours before letting the area<br>";

								$rol=new ManuaChosersDate($_POST['date'],$infotab,1,true);
	                            $rol->SetCalendar($cal);
	                            if(isset($_POST['choserdate'])) $cal->setBacklightDate($_SESSION['areadate']);
	                            else if (isset($_GET['rt']) ) $cal->setBacklightDate($_SESSION['lastdate']);
								$cal->sHowCalendar();
							?>
						</div>
						<div id="cancelarea" style="font-size: 10pt; text-align: centered;">
							<?php
								$mail = new email();
								$mail->cancel();
							?>
						</div>
					</div>

					<div id="colorimage_container">
						<div id="colorimage">
							<?php
								$area = new Area($_POST['date']);
							?>
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

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = './newuser.php'</script>"
?>

</body>
</html>
