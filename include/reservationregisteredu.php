<?php
require_once "Mail.php";
class SendMail
{
	private $recipients;
	private $headers;
	private $smtpinfo;
	private $mailmsg;
	private $mail_object;
	
	public function SendMail()
	{
		$this->smtpinfo["host"] = "smtp.gmail.com";
		$this->smtpinfo["port"] = "587";
		$this->smtpinfo["auth"] = true;
		$this->smtpinfo["username"] = "lappihalli@gmail.com";
		$this->smtpinfo["password"] = "testtesttest";
		$this->SetHeaders();
	}
	public function setSmtpinfo($host,$port,$auth,$username,$password)
	{
		$this->smtpinfo["host"] = $host;
		$this->smtpinfo["port"] = $port;
		$this->smtpinfo["auth"] = $auth;
		$this->smtpinfo["username"] = $username;
		$this->smtpinfo["password"] = $password;
	}
	public function SetHeaders($from='lappihalli@gmail.com',$to='ludomirc@gmail.com',$subject='User feedback')
	{
		$this->recipients=$to;
		$this->headers["From"] = $from;
		$this->headers["To"] = $to;
		$this->headers["Subject"] = $subject;
	}
	public function SendMesage()
	{
		/* SMTP server name, port, user/passwd */
		/* Create the mail object using the Mail::factory method */
		$mail_object =& Mail::factory("smtp", $this->smtpinfo);
		/* Ok send mail */
		$mail_object->send($this->recipients, $this->headers, $this->mailmsg);
        	
		if (PEAR::isError($mail))   echo("<p>" . $mail->getMessage() . "</p>");
		else echo("<p>Message successfully sent!</p>");
	
	}
	public function SetSubject($subject){ $this->headers["Subject"]=$subject;}
	public function SetRecipients($to){$this->recipients=$to;$this->headers["To"] = $to;}
	public function SetBodyMesage($mesage){$this->mailmsg=$mesage;}
}
class ReservationRuser
{
        private $y;
        private $m;
        private $d;
        private $key;
        public function ReservationRuser()
        {
                $this->ExplodeDate($_SESSION['areadate']);
                $this->AddReservation();
        }
        private function ExplodeDate($date)
        {
                $this->y=substr($date,0,4);
                $this->m=substr($date,5,2);
                $this->d=substr($date,8,2);
        }
        private function AddReservation()
        {
                $area=$area_b="";
        		$gkey=new GenKey($_SESSION['username'],'Reservation','Reservecode',6);
                $this->key=$gkey->GetCode();
                $tstemp=$gkey->GetTimestemp();
                $date_start_time=mktime($_SESSION['areatime'], 0, 0,$this->m, $this->d, $this->y);
                $date_finish_time=$date_start_time+(($_SESSION['areaduration'])*60*60);
                $ds=date('Y-m-d',$date_start_time);
                $df=date('Y-m-d',$date_finish_time);
                $ts=date('H:i',$date_start_time);
                $tf=date('H:i',$date_finish_time);
                if($_SESSION['areaarea'] == 'A&B')
                {
                	$area='A';
                	$area_b='B';		
                }
                else $area=$_SESSION['areaarea'];
                
                $subquery="(select idRegistereduser from registereduser where RegisteredEmailaddress='".$_SESSION['username']."')";
                $query="insert into Reservation( Reservecode,idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$this->key."',".$subquery.",'".$area."','$ts','$tf','$ds','$df','$tstemp')";
        		echo $query;
        		mysql_query($query);
        		if($area_b == 'B'){
        			$query="insert into Reservation( Reservecode,idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$this->key."',".$subquery.",'".$area_b."','$ts','$tf','$ds','$df','$tstemp')";
        			mysql_query($query);
        		}
                echo '<br> rezerwacja <br> :' . $query . mysql_error();
        /*        
                $smail = new SendMail();
                $smail->SetRecipients("boromil@gmail.com");
                $smail->SetBodyMesage("halo to wiadomość testowa");
                $smail->SetSubject('teścik');
                $smail->SendMesage();
                //$this->SendMail();
        */
        }
        private function SendMail()
        {
        	require_once "Mail.php";

			$recipients = "ludomirc@gmail.com";
			$headers["From"] = "lappihalli@gmail.com";
			$headers["To"] = "ludomirc@gmail.com";
			$headers["Subject"] = "User feedback";
			$mailmsg = "Hello, This is a test.";
			/* SMTP server name, port, user/passwd */
			$smtpinfo["host"] = "smtp.gmail.com";
			$smtpinfo["port"] = "587";
			$smtpinfo["auth"] = true;
			$smtpinfo["username"] = "lappihalli@gmail.com";
			$smtpinfo["password"] = "testtesttest";
			/* Create the mail object using the Mail::factory method */
			$mail_object =& Mail::factory("smtp", $smtpinfo);
			/* Ok send mail */
			$mail_object->send($recipients, $headers, $mailmsg);
        	
			
			if (PEAR::isError($mail))   echo("<p>" . $mail->getMessage() . "</p>");
			else echo("<p>Message successfully sent!</p>");
			
        }
}
?>