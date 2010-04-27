<?php
session_start();

include 'sendmesage.php';
include 'sqlconnect.php';

$dbconn = new SqlConnect("localhost","root","test1","LHR");
$dbconn->connectToDb();
$resource=&$dbconn->getResource();

$sql="SELECT password FROM registereduser WHERE RegisteredEmailaddress = '".$_POST['username']."'";
$result=mysql_query($sql,$resource);
$row = mysql_fetch_assoc($result);
$value="Hello, your lost password is <font color = \"Blue\">".$row['password']."</font>";
$dbconn->disocnnect();
if ($row == 0){
		$_SESSION['lost_already_err'] = "Email address Does not exist in our database";
		echo "<script type='text/javascript'>document.location ='lost_password.php'</script>";
		exit;}
else{
		/*gropu of images
		*$html = '<html><body><img src="rumianek.jpg"> <p>wlasnie skoncylem pisac klase do mailingu :).</p><br><img src="software-update-300x300.jpg"><br><p>another image</p></body></html>';
		*$imagegroup=array('software-update-300x300.jpg','rumianek.jpg',);
		*$smail = new SendMail();
		*$smail->SetRecipients($_SESSION['username']);
		*$smail->SetHtmlMesage($html);
		*$smail->SetGroupImage($imagegroup);
		*$smail->SetSubject('Lapiahally');
		*$smail->SendMesage();
		*/
		//$emails = 'boromil@gmail.com';
		//$emails = $_POST['username'];
		$smail = new SendMail();
		$smail->SetRecipients($_POST["username"]);
		$smail->SetHtmlMesage($value);
		$smail->SetSubject('Lapiahally');
		$smail->SendMesage();

		$_SESSION['lost_success'] = "Your password has been sent to your email address.";
		echo"<script type='text/javascript'>document.location ='lost_password_confirm.php'</script>";
}
?>
