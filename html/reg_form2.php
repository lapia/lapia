<?php
session_start();
$con = mysql_connect("localhost","root","test1");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("LHR", $con);?>
<?php
if (isset ($_POST['register'])){
	$Email = $_POST['email'];
	$Address = $_POST['Address'];
	$Contactperson = $_POST['contact_person'];
	$Organisation = $_POST['name_of_organisation'];
	$password = $_POST['password'];
	$phone = $_POST['Phone'];
	$update_user = $_POST['email'];
	$sql = "SELECT* FROM registereduser WHERE RegisteredEmailaddress = '".$Email."' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0){
		$_SESSION['already_err'] = "<p class='kkay'>Email address already exists!</p>";
		//echo "<script type='text/javascript'>document.location ='register_second.php'</script>";
		header('Location:register_second.php');
		exit;
	}
	else{
		mysql_query("INSERT INTO registereduser (RegisteredEmailaddress, Address, Contactperson, Organizationname, password, Phone)
		VALUES ('".$Email."','".$Address."','".$Contactperson."','".$Organisation."','".$password."','".$phone."')");

		$_SESSION['success'] = "Successfully registerd. Now you can login with your email and password.";
		//echo "<script type='text/javascript'>document.location ='newuser.php'</script>";
		header('Location:newuser.php');
		exit;
		}
	}
//if (!mysql_query($sql,$con))
//  {
  //die('Error: ' . mysql_error());
  //}
//echo "1 record added";
mysql_close($con);
?>

