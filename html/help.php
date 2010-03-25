<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>

<head>
	<title>Lappia Halli - Help</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="css.css" type="text/css">

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
					<!--<form action="#">
						<p><label for="e-mail">E-mail:</label> <input type="text" id="e-mail" /></p>
						<p><label for="password">Password:</label> <input type="password" id="password" /></p>
						<p class="submit"><input type="submit" value="Login" /></p>
					</form>-->
					<?php
						new Login();
					?>
					<div id="pass_reg">
					</div>
				</div>
			</div>

			<div id="bottom_menu">
				<a href="../index.php">Home Page</a>
				<a href="costs.php">Costs</a>
				<a href="aboutus.php">About Us</a>
				<a href="disclamer.php">Disclaimer</a>
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
								$rol=new ManuaChosersDate($_POST['date']);
								$rol->SetCalendar($cal);
								$cal->sHowCalendar();
							?>
						</div>
						<div id="middlearea">
							<?php
								$rol->ShowForm();
							?>
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
