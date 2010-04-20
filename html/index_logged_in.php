<?php
session_start();
if(isset($_SESSION['username']) == false || empty($_SESSION['username'])){
	header("location:../index.php");
}
?>

<html>
<head>
	<title>Lappia Halli - Your Acount</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
</head>

<body>
	<?php
		include '../include/adduser.php';
		include '../include/sqlconnect.php';
		include '../include/calendar.php';
		include '../include/login.php';
		include '../include/area.php';
		include 'manuachosersdate.php';
		include '../include/genkey.php';
		include '../include/formnonregister.php';

		$_SESSION['ShowRegisterForm']='0'; // set show nonregistred user form
		if(isset($_SESSION['FIRST_OPEN_SITE'])){
			unset($_SESSION['FIRST_OPEN_SITE']);
		}


		//ini_set('display_errors',1);
	?>

	<div id="tlo">
	</div>

	<div id="strona">

		<div id="gora_pasek">
			<div id="container_top">
				<div id="logout_bar">
				<br />
				<br />
				<br />
					<div id="welcome_note">
						<p>Welcome
							<?php
								$dbconn = new SqlConnect("localhost","root","test1","LHR");
								$dbconn->connectToDb();

								$querystr = "SELECT Contactperson FROM registereduser WHERE RegisteredEmailaddress = '".$_SESSION['username']."'";
								$resource=&$dbconn->getResource();
								$result = mysql_query($querystr,$resource);
								$row = mysql_fetch_assoc($result);
								echo $row['Contactperson'];
								mysql_free_result($result);
								$dbconn->disocnnect();
							?>
						</p>
					</div>

					<div id="pass_reg">
						<a href="edit_profile.php">Edit profile</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</div>

			<div id="bottom_menu">
				<a href="index_logged_in.php">Home Page</a>
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
					<div id="calender_container">
						<div id="calender">
							<?php
								$cal=new Calendar();

								//infotab['free_time']; infotab['busy_period']
								// ManuaChosersDate class requires a second parameter an associative array of messages
								$infotab['free_time']="<br>reservations can be made<br>";
								$infotab['busy_period']="<br>time is busy<br>";
								$infotab['past_time']="<br>Sorry, the reservation is not possible.<br> Reservations must be made at least<br> 24 hours before letting the area<br>";

								$rol=new ManuaChosersDate($_POST['date'],$infotab,24);
								$rol->SetCalendar($cal);
								if($_POST['choserdate']) $cal->setBacklightDate($_SESSION['areadate']);
								$cal->sHowCalendar();
							?>
						</div>
						<div id="middlearea" style="font-size: 10pt; text-align: centered;">
							<?php
								//$phpfile = "reg_user_confirm_message.php";

								$rol->ShowForm('reg_user_confirm_message.php');
							?>
						</div>
					</div>

					<div id="colorimage_container">
						<div id="colorimage" style="font-size: 10pt;">
							<?php
								$area=new Area($_POST['date']);
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
</body>
</html>
