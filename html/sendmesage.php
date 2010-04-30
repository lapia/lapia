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
	private $mine;

	public function SendMail()
	{
		$this->smtpinfo["host"] = "smtp.gmail.com";
		$this->smtpinfo["port"] = "587";
		$this->smtpinfo["auth"] = true;
		$this->smtpinfo["username"] = "lappihalli@gmail.com";
		$this->smtpinfo["password"] = "testtesttest";
		$this->mine=NULL;
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
		$this->headers = $this->mine->headers($this->headers);
		$this->mailmsg=$this->mine->get();
		$mail_object->send($this->recipients, $this->headers, $this->mailmsg);

		if (PEAR::isError($mail_object))   echo("<p>" . $mail_object->getMessage() . "</p>");
		else echo("<p>Message successfully sent!</p>");

	}
	public function SetHtmlMesage($htmlbody)
	{
		$crlf = "\n";
		$this->mine = new Mail_mime($crlf);
		$this->mine->setHTMLBody($htmlbody);
	}
	/*$patandimage='patch/image'*/
	public function SetImage($pathandimage)
	{
		$start=strlen($pathandimage)-3;
		$type=substr($pathandimage,$start,3);

		$this->mine->addHTMLImage($pathandimage, 'image/'.$type);
	}
	/*array image with patch arr[]='path/imagename'*/
	public function SetGroupImages($imagegroup)
	{
		if (is_array($imagegroup)){
			foreach($imagegroup as $image){
				$this->SetImage($image,true);
			}
		}else echo 'err: variable must be type array';
	}
	public function SetHost($host){$this->smtpinfo['host']=$host;}
	public function SetPort($port){$this->smtpinfo['port']=$port;}
	public function SetAuth($auth){$this->smtpinfo['auth']=$auth;}
	public function SetUsername($username){$this->smtpinfo["username"]=$username;}
	public function SetPassword($password){$this->smtpinfo["password"]=$password;}
	public function SetSubject($subject){ $this->headers['Subject']=$subject;}
	public function SetRecipients($to){$this->recipients=$to;$this->headers['To'] = $to;}
	public function SetBodyMesage($mesage){$this->mailmsg=$mesage;}
}
?>
