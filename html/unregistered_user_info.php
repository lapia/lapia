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
	$phone = $_POST['Phone'];
	$update_user = $_POST['email'];
	$sql = "SELECT* FROM Unregistereduser WHERE UnregisteredEmailaddress = '".$Email."' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count > 0){
		$_SESSION['already_err'] = "<p class='kkay'>Email address already exists!</p>";
		//echo "<script type='text/javascript'>document.location ='register_second.php'</script>";
		header('Location:unreg_user_confirm_message.php');
		exit;
	}
	else{
		mysql_query("INSERT INTO Unregistereduser (UnregisteredEmailaddress, Address, Contactperson, Organizationname, Phone)
		VALUES ('".$Email."','".$Address."','".$Contactperson."','".$Organisation."','".$phone."')");

		$_SESSION['success'] = "Thank you for your booking.<br>The reservation will be confirmed<br>by our administrator.<br><br>You will be contacted by email soon.";
		//echo "<script type='text/javascript'>document.location ='newuser.php'</script>";
		header('Location:unreg_user_confirm_message2.php');
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

