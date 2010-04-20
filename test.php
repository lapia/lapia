<?php session_start();?>
<?php

	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);

	include 'include/adduser.php';
	include 'include/sqlconnect.php';
	include 'include/calendar.php';
	include 'include/login.php';
	include	'include/area.php';
	include 'include/manuachosersdate.php';
	include 'include/genkey.php';
	include 'include/formnonregister.php';
	include 'include/reservationregisteredu.php';

	$dbconn = new SqlConnect("localhost","root","test1","LHR");
	$dbconn->connectToDb();
?>
<html>
<head>
<title>Lapia 2</title>
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
	border-style:solid;
	border-width:1px;
	width: 253px;
	height: 180px;

}
#area {
	position: absolute;
	border-style:solid;
	border-width:1px;
	top: 1%; left: 50%;
	width: 210px;
	height: 530px;
	font: 10px Verdana, sans-serif;
	text-align: center;
}
td.area {
	width: 80px;
	height: 15px;
}
td.area_cool1{
	width: 40px;
	height: 15px;
	font: 12px Verdana, sans-serif;
	text-align: center;
}
-->
</style>
</head>
<body>
<a href='index.php'> return to reservation</a>
<?php
/*
 * $_SESSION['FIRST_OPEN_SITE'] This prevents the execution of the value of re-booking
 *
 */
	$cal=new Calendar();
	$cal->ButtonOff();
	$cal->setBacklightDate($_SESSION['areadate']);
	$cal->sHowCalendar();
if(isset($_SESSION['username']))
{
	if(!isset($_SESSION['FIRST_OPEN_SITE']))
	{
		new ReservationRuser();
		$_SESSION['FIRST_OPEN_SITE']=0;
	}
	echo "<br> dziękuje za rezewację <br>";
}
else
{
	echo '<h1> nie zarejestrowany uzytkownik</h1>';
	if(!isset($_SESSION['FIRST_OPEN_SITE'])){
		new FormNonRegister();
		$_SESSION['FIRST_OPEN_SITE']=0;
	}
	echo "<br> dziękuje za rezewację <br>";

}
?>
<div id='area'>
<div id="links">
<?php
	if(isset($_POST['date'])){
		$area=new Area($_POST['date']);
		$_SESSION['areadate'] =$_POST['date'];
	}
	else $area=new Area($_SESSION['areadate']);
?>
</div>
</div>
<?php $dbconn->disocnnect();?>
<a href='index.php'> return to reservation</a>
<?php

foreach($_SESSION as $sesja=>$wartosc){
	if (is_array($wartosc)){
		echo "zawartosc tablicy";
		foreach($wartosc as $tablica=>$pole);
			echo "<p>".$tablica." = ".$pole."</p>";
	}
	echo "<p>".$sesja." = ".$wartosc."</p>";
}
?>
</body>
</html>
