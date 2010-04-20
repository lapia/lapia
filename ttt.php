<?php session_start();?>
<?php
//	if($_SESSION["logedin"] == 'false')  header('Location: http://localhost/Lapia/newuser.php');
//	echo  '<br>logedin :'.$_SESSION["logedin"].'<br> newuser:'.$_SESSION['newuser'] .'<br>'; // potrzebne do przekierowania jeżeli chasło nieprawidłowe
	$_SESSION['ShowRegisterForm']='-2'; // set show nonregistred user form

?>
<html>
<head>
<title>Lapia</title>

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

	//ini_set('display_errors',1);

	include 'include/adduser.php';
	include 'include/sqlconnect.php';
	include 'include/calendar.php';
	include 'include/login.php';
	include	'include/area.php';
	include 'include/manuachosersdate.php';
	include 'include/genkey.php';
	include 'include/formnonregister.php';

	$dbconn = new SqlConnect("localhost","root","test1","LHR");
	$dbconn->connectToDb();
	new Login();

	$cal=new Calendar();
	$rol=new ManuaChosersDate($_POST['date']);
	$rol->SetCalendar($cal);
	$cal->sHowCalendar();
	$rol->ShowForm();

	$area=new Area($_POST['date']);

	echo "<br>check:" .$_POST['next_step'];

	//echo  mysql_error();
	/*
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    	printf("ID: %s  Name: %s", $row[0], $row[1]);
	}
	*/
///	$key=new GenKey(cos,'Reservation','Reservecode');
//	$nr=new FormNonRegister();
//	$nr->showNonRegisterForm();
	$dbconn->disocnnect();
?>
<?php if($_SESSION["logedin"] == 'false')
echo "<script type='text/javascript'>document.location = 'http://localhost/Lapia/newuser.php'</script>"
?>
</body>
</html>
