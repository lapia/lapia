<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

	//ini_set('display_errors',1);

?>

<head>
	<title>Lappia Halli - Reservation</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">

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
		include '../include/adduser.php';
		include '../include/sqlconnect.php';
		include '../include/calendar.php';
		include '../include/login.php';
		include	'../include/area.php';
		include '../include/manuachosersdate.php';
		include '../include/genkey.php';
		include '../include/formnonregister.php';
		include '../include/reservationregisteredu.php';

		$dbconn = new SqlConnect("localhost","root","test1","LHR");
		$dbconn->connectToDb();

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
							<?php $con = mysql_connect("localhost","root","test1");
								if (!$con) {
									die('Could not connect: ' . mysql_error());
								}

								mysql_select_db("LHR", $con);
								$querystr = "SELECT Contactperson FROM registereduser WHERE RegisteredEmailaddress = '".$_SESSION['username']."'";
								$result = mysql_query($querystr);
								$row = mysql_fetch_assoc($result);
								echo $row['Contactperson']
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
								$cal->ButtonOff();
								$cal->setBacklightDate($_SESSION['areadate']);
								$cal->sHowCalendar();

							?>
						</div>
						<div id="middlearea" style="font-size: 10pt; text-align: centered;">
						<?php
							if(isset($_SESSION['username']))
							{
								if(!isset($_SESSION['FIRST_OPEN_SITE']))
								{
									new ReservationRuser();
									$_SESSION['FIRST_OPEN_SITE']=0;
								}
								echo "<br>Thank you for the reservation.<br>";
							}
							else
							{
								echo '<h1>unregistered user</h1>';
								if(!isset($_SESSION['FIRST_OPEN_SITE'])){
									new FormNonRegister();
									$_SESSION['FIRST_OPEN_SITE']=0;
								}
								echo "<br>Thank you for the reservation.<br>";

							}
							?>
							<a href='index_logged_in.php' style="font-size: 16pt">go back</a>
						</div>
					</div>

					<div id="colorimage_container">
						<div id="colorimage">
							<?php
							if(isset($_POST['date'])){
								$area=new Area($_POST['date']);
								$_SESSION['areadate'] =$_POST['date'];
							}
							else $area=new Area($_SESSION['areadate']);
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
