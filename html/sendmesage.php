<?php
require_once "Mail.php";
require_once "Mail/mime.php";

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
		//MIME Body
		// Creating the Mime message
		$crlf = "\n";
		$text = 'This is a text message.';                                  // Text version of the email
        $html = '<p><b>This is</b> a html message</p>';  // HTML version of the email
		
				
        $mime = new Mail_mime($crlf);
 
        // Setting the body of the email
        //$mime->setTXTBody($text);
        $mime->setHTMLBody($this->mailmsg);
 
        $body = $mime->get();
		$this->headers = $mime->headers($this->headers);
		
		/* Ok send mail */
		//$mail_object->send($this->recipients, $this->headers, $this->mailmsg);
		$mail_object->send($this->recipients, $this->headers, $body);
        	
		if (PEAR::isError($mail_object))   echo("<p>" . $mail_object->getMessage() . "</p>");
		else echo("<script type='text/javascript'>document.location ='lost_password_confirm.php'</script>");
	
	}
	public function SetSubject($subject){ $this->headers["Subject"]=$subject;}
	public function SetRecipients($to){$this->recipients=$to;$this->headers["To"] = $to;}
	public function SetBodyMesage($mesage){$this->mailmsg=$mesage;}
}
?>