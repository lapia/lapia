<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe

	$_SESSION['ShowRegisterForm']='0'; // set show nonregistred user form
	if(isset($_SESSION['FIRST_OPEN_SITE'])) unset($_SESSION['FIRST_OPEN_SITE']);
	$_SESSION['SQLSETTINGS']=array('host'=>'localhost','user'=>'root','password'=>'test1','dbname'=>'LHR');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Lappia Halli - Home Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="css/css.css" type="text/css">
	<script type="text/javascript" src="html/cameraView.js"></script>
</head>
<body onLoad="cameraView()">
	<?php
		include './include/adduser.php';
		include './include/sqlconnect.php';
		include './include/calendar.php';
		include './include/login.php';
		include './include/area.php';
		include './include/manuachosersdate.php';
		include './include/genkey.php';
		include './include/formnonregister.php';

		$dbconn = new SqlConnect("localhost","root","test1","LHR");
		//$dbconn->connectToDb();

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
						<a href="html/lost_password.php">Lost Password?</a>
						<a href="html/register_second.php">Register</a>
					</div>
				</div>
			</div>

			<div id="bottom_menu">
				<a href="./index.php">Home Page</a>
				<a href="html/costs.php">Costs</a>
				<a href="html/aboutus.php">About Us</a>
				<a href="html/faq.php">FAQ</a>
				<a href="html/privacypolicy.php">Privacy Policy</a>
				<a href="html/help.php">Help</a>
				<a href="html/contributors.php">Contributors</a>
			</div>
		</div>

		<div id="lewy_pasek">
			<div id="ad">
				<img src="images/lappia_baner.png" name="webcam" width="60" height="468">
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
						<div id="middlearea" style="font-size: 10pt; text-align: centered;">
							<p style="text-align:left; font-size: 14pt; padding-left: 60px; margin-bottom: 5px">Upcoming events:</p>
							<?php
								$sql = "SELECT * FROM UpcomingEvents";
								$resource=&$dbconn->getResource();
								$result = mysql_query($sql,$resource);

								while ($db_field = mysql_fetch_assoc($result)) {
									print "<p class='events'>".$db_field['Title'].": ".$db_field['Content']. "</p>";
								}
							?>
							<p class="more"><a href="html/more_events.php">More</a></p>
							<p class="links"><a href="html/unregistered.php">Make Reservation</a></p>
							<p class="links"><a href="html/cancel.php">Cancel Reservation</a></p>
							<br>
							<p class="ckay">COLOUR KEY:</p>
							<p class="ckay">Green = unreserved</p>
							<p class="ckay">Yellow = unconfirmed reservation</p>
							<p class="ckay">Red = reserved</p>
						</div>
					</div>

					<div id="colorimage_container">
						<div id="colorimage">
							<?php

								$area=new Area($_POST['date']);

								//echo "<br>check:" .$_POST['next_step'];

							?>
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

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/~test/newuser.php'</script>"
?>

</body>
</html>
