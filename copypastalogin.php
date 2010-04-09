<?php
$con = mysql_connect("localhost","root","test1");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("LHR", $con);
session_start();

// username and password sent from form
$username=$_POST['username'];
$password=$_POST['password'];


$sql="SELECT* FROM registereduser WHERE RegisteredEmailaddress ='$username' and password='$password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "index_logged_in.php"
session_register("username");
session_register("password");
echo "<script type='text/javascript'>document.location ='html/edit_profile.php'</script>";
}
else {
echo "<script type='text/javascript'>document.location ='html/login_failed.php'</script>";
}
?>
