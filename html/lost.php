<?php
session_start();
$con = mysql_connect("localhost","root","test1");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("LHR", $con);
include 'sendmesage.php';
$sql="SELECT password FROM registereduser WHERE RegisteredEmailaddress = '".$_POST['username']."'";
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$value="Hello, your lost password is <font color = \"Blue\">".$row['password']."</font>";

if ($row == 0){
		$_SESSION['lost_already_err'] = "Email address Does not exist in our database";
		echo "<script type='text/javascript'>document.location ='lost_password.php'</script>";
		exit;}
else{
		$sendmail = new SendMail();
		$sendmail ->SetRecipients($_POST['username']);
		$sendmail ->SetBodyMesage($value);
		$sendmail ->SetSubject('Lost Password');
		$sendmail ->SendMesage();

		$_SESSION['lost_success'] = "Your password has been sent to your email address.";
		echo"<script type='text/javascript'>document.location ='lost_password_confirm.php'</script>";
}
mysql_close($con);

?>
<?php
/*
session_start();
$con = mysql_connect("localhost","root","test");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("lhr", $con);



$sql="SELECT password FROM registereduser WHERE RegisteredEmailaddress = '".$_POST['username']."'";
$result=mysql_query($sql);
if($result == 1){
$row = mysql_fetch_assoc($result);
//.$row['password'].
  require_once "Mail.php";
  //$_SESSION['test_username']= $_POST['username'];
  //echo $_POST['username'];
            $recipients = "isaakay111@yahoo.com";//$_POST['username'];
            $headers["From"] = "lappihalli@gmail.com";
            $headers["To"] = "isaakay111@yahoo.com";//$_POST['username'];
            $headers["Subject"] = "Lost password";
            $mailmsg = "Hello,This is your password.".$row['password'];
            /* SMTP server name, port, user/passwd */
            //$smtpinfo["host"] = "smtp.gmail.com";
            //$smtpinfo["port"] = "587";
            //$smtpinfo["auth"] = true;
            //$smtpinfo["username"] = "lappihalli@gmail.com";
            //$smtpinfo["password"] = "testtesttest";
            /* Create the mail object using the Mail::factory method */
            //$mail_object =& Mail::factory("smtp", $smtpinfo);
            /* Ok send mail */
            //$mail_object->send($recipients, $headers, $mailmsg);



            //if (PEAR::isError($mail))   echo("<p>" . $mail->getMessage() . "</p>");
            //else echo("<p>Message successfully sent!</p>");
       //}*/
			//echo "<script type='text/javascript'>document.location ='lost_password.php'</script>";

?>
