<?php
session_start();
include '../include/sqlconnect.php';
$con = new SqlConnect("localhost","root","test1","LHR");
$con ->connectToDb();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$resource=&$con->getResource();

// username and password sent from form
$username=$_POST['username'];
$password=$_POST['password'];


if($username='administrator@lappia.fi') {
	$sql="SELECT* FROM adminusers WHERE AdminEmailaddress ='*@*' and password ='$password'";
	$result=mysql_query($sql);
}
else {
	$sql="SELECT* FROM registereduser WHERE RegisteredEmailaddress ='$username' and password='$password'";
	$result=mysql_query($sql);
}

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
mysql_free_result($result);
$con->disocnnect();

if($count==1 && $username == 'administrator@lappia.fi'){
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];

	echo "<script type='text/javascript'>document.location ='adminpage.php'</script>";
}
elseif($count==1){
	// Register $myusername, $mypassword and redirect to file "index_logged_in.php"
	//sssion_register("username");
	//session_register("password");
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];

	echo "<script type='text/javascript'>document.location ='index_logged_in.php'</script>";
}
else {
	echo "<script type='text/javascript'>document.location ='login_failed.php'</script>";
}
?>
