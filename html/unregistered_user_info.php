<?php
session_start();
?>
<?php
include 'sqlconnect.php';

if (isset ($_POST['register'])){
	$Email = $_POST['email'];
	$Address = $_POST['Address'];
	$Contactperson = $_POST['contact_person'];
	$Organisation = $_POST['name_of_organisation'];
	$phone = $_POST['Phone'];
	$update_user = $_POST['email'];
	
	$dbconn = new SqlConnect("localhost","root","sqq2q2","LHR");
	$dbconn->connectToDb();
	$resource=&$dbconn->getResource();
	
	$sql = "SELECT* FROM Unregistereduser WHERE UnregisteredEmailaddress = '".$Email."' ";
	$result = mysql_query($sql,$resource);
	$count = mysql_num_rows($result);

	if ($count > 0){
		$_SESSION['already_err'] = "<p class='kkay'>Email address already exists!</p>";
		//echo "<script type='text/javascript'>document.location ='register_second.php'</script>";
		$dbconn->disocnnect();
		header('Location:unreg_user_confirm_message.php');
		exit;
	}
	else{
		$query="INSERT INTO Unregistereduser (UnregisteredEmailaddress, Address, Contactperson, Organizationname, Phone)
		VALUES ('".$Email."','".$Address."','".$Contactperson."','".$Organisation."','".$phone."')";
		mysql_query($query,$resource);
		$_SESSION['success'] = "Thank you for your booking.<br>The reservation will be confirmed<br>by our administrator.<br><br>You will be contacted by email soon.";
		//echo "<script type='text/javascript'>document.location ='newuser.php'</script>";
		$dbconn->disocnnect();
		header('Location:unreg_user_confirm_message2.php');
		exit;
		}
	}
//if (!mysql_query($sql,$con))
//  {
  //die('Error: ' . mysql_error());
  //}
//echo "1 record added";
?>

