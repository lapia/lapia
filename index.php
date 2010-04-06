<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<head>
	<title>Lappia Halli - Home Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="css/css.css" type="text/css">

	<style type="text/css">
	<!--
	button {
		border-width:1px;
		margin: 0 0 0 0;
	 }
	td.area {
		width: 80px;
		height: 20px;
	}
	td.area_cool1{
		width: 40px;
		padding: 0px 0px 0px 0px;
		font-size: 12px;
	}
	#calendar {
		position: absolute;
		top: 40%; left: 50%;
		border-style:solid;
		border-width:1px;
		width: 253px;
		height: 147px;
		margin: 0 0 0 0;
		padding: 1 1 1 1;
	}
	#info {
		position: absolute;
		top: 60%; left: 10%;
		border-style:solid;$aray[$i][0]
		border-width:1px;
		width: 253px;
		height: 180px;

	}
	-->
	</style>

</head>

<body>
	<?php
		include 'include/adduser.php';
		include 'include/sqlconnect.php';
		include 'include/calendar.php';
		include 'include/login.php';
		include 'include/area.php';
		include 'include/manuachosersdate.php';
		include 'include/genkey.php';
		include 'include/formnonregister.php';

		$dbconn = new SqlConnect("localhost","root","test1","LHR");
		$dbconn->connectToDb();

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
				<a href="#">Home Page</a>
				<a href="html/costs.php">Costs</a>
				<a href="html/aboutus.php">About Us</a>
				<a href="html/faq.php">FAQ</a>
				<a href="html/privacypolicy.php">Privacy Policy</a>
				<a href="html/help.php">Help</a>
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
								$infotab['past_time']="<br>Sorry, the reservation is not possible.<br> Reservations must be made at least 3 hours before letting the area<br>";

								$rol=new ManuaChosersDate($_POST['date'],$infotab);
								$rol->SetCalendar($cal);
								$cal->sHowCalendar();
							?>
						</div>
						<div id="middlearea" style="font-size: 10pt; text-align: centered;">
							<h1><a href="html/cancel.php">Cancel Reservation</a></h1>
							<h1><a href="#">Unregister User Reservation Page</a></h1>
						</div>
					</div>

					<div id="colorimage_container">
						<div id="colorimage">
							<?php
								$area=new Area($_POST['date']);

								echo "<br>check:" .$_POST['next_step'];
								$dbconn->disocnnect();
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
					<img src="images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
				<div id="webcam2">
					<!--<h3>A</h3>-->
					<img src="images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
			</div>
		</div>

	</div>

<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/~test/newuser.php'</script>"
?>

</body>
</html>
