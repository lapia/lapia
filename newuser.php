<?php session_start();?>
<?php
	$_SESSION['newuser']=true; ///potrzeben do logowania żeby sprawdzić czy użytkownik nie chce się logować
?>
<?php
include 'include/sqlconnect.php';
include 'include/login.php';
include 'include/adduser.php'
?>
<html>
<head>
<title>Lapia</title>
</head>
<body>
<?php
$dbconn = new SqlConnect("localhost","root","test1","LHR");
$dbconn->connectToDb();
$login= new Login();
new AddUser();

$dbconn->disocnnect();

$_SESSION["logedin"]='not loged'; //resetowanie ustawień potrzebne !!!!
?>
<a href=index.php>return to main page</a>
</body>
</html>
