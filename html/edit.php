<?php
session_start();
$con = mysql_connect("localhost","root","test1");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("LHR", $con);
?>
<?php
	$Email = $_POST['email'];
	$Address = $_POST['Address'];
	$Contactperson = $_POST['contact_person'];
	$Organisation = $_POST['name_of_organisation'];
	$password = $_POST['password'];
	$phone = $_POST['Phone'];

	if (isset($_SESSION['username']))
		$query = "UPDATE registereduser set Address='$Address', Contactperson='$Contactperson', Organizationname='$Organisation', password='$password',
		Phone='$phone'
		WHERE RegisteredEmailaddress = '".$_SESSION['username']."'";
		//echo $query;
		$result=mysql_query($query);
		$_SESSION['edit'] = "Your profile has been successfully edited.";
		echo "<script type='text/javascript'>document.location ='index_logged_in.php'</script>";
?>
