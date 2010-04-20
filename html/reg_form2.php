<?php
session_start();
?>
<?php
include 'sqlconnect.php';

$dbconn = new SqlConnect("localhost","root","test1","LHR");
$dbconn->connectToDb();
$resource=&$dbconn->getResource();

if (isset ($_POST['register'])){
	$Email = $_POST['email'];
	$Address = $_POST['Address'];
	$Contactperson = $_POST['contact_person'];
	$Organisation = $_POST['name_of_organisation'];
	$password = $_POST['password'];
	$phone = $_POST['Phone'];
	$update_user = $_POST['email'];
	$sql = "SELECT* FROM registereduser WHERE RegisteredEmailaddress = '".$Email."' ";
	$result = mysql_query($sql,$resource);
	$count = mysql_num_rows($result);

	if ($count > 0){
		$_SESSION['already_err'] = "<p class='kkay'>Email address already exists!</p>";
		//echo "<script type='text/javascript'>document.location ='register_second.php'</script>";

		$dbconn->disocnnect();
		header('Location:register_second.php');

		exit;
	}
	else{
		$query="INSERT INTO registereduser (RegisteredEmailaddress, Address, Contactperson, Organizationname, password, Phone)
		VALUES ('".$Email."','".$Address."','".$Contactperson."','".$Organisation."','".$password."','".$phone."')";

		mysql_query($query,$resource);
		$_SESSION['success'] = "Successfully registerd. Now you can login with your email and password.";
		//echo "<script type='text/javascript'>document.location ='newuser.php'</script>";
		$dbconn->disocnnect();
		header('Location:newuser.php');
		exit;
		}
	}
//if (!mysql_query($sql,$con))
//  {
  //die('Error: ' . mysql_error());
  //}
//echo "1 record added";

?>

