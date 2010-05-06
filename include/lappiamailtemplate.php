<?php
include_once 'include/sendmesage.php';
/*
rules
register $replaceRules=array('{contact_person}'=>'Benek','{username}'=>'ludo@o2.pl','{password}'=>'mypassword');
cancel $replaceRules=array('{contact_person}'=>'Benek');	
reservation $replaceRules=array('{contact_person}'=>'Benek','{rcode}'=>'reservation code');

$template = new LappiaMailTemplate();
$template->setTemplatename('register.html');
$template->setPathtoTemplate('sendpage/');
$template->setPathtoImages('sendpage/images/');
$template->setRecipients('ludomirc@gmail.com');
$template->setSubject('Lappiahally');
$template->setReplaceRules($replaceRules);
$template->factoryMail();
only for test !!! $template->showHtmlmessage();
$template->sendMail();
*/
class LappiaMailTemplate{

	private $templatename;
	private $pathtotemplate;
	private $pathtoimage;
	private $imagearray;
	private $rrulesarray; 
	private $recipients;
	private $subject;
	private $mail;
	private $htmlmessage;
	
	public 	function setTemplatename($templatename){$this->templatename=$templatename;}
	public 	function setPathtoTemplate($pathtotemplate){$this->pathtotemplate=$pathtotemplate;}
	public 	function setPathtoImages($pathtoimage){$this->pathtoimage=$pathtoimage;}
	public 	function setRecipients($recipients){$this->recipients=$recipients;}
	public 	function setSubject($subject){$this->subject=$subject;}
	public 	function showHtmlmessage() {echo $this->htmlmessage;}
	public 	function sendMail() {$this->mail->SendMesage();}
	public 	function setReplaceRules($replacerulesarray) {$this->rrulesarray=$replacerulesarray;}
	private function fathImageNametoArray($path)
	{
		$this->imagearray=array();
		$dir=$this->pathtoimage;

		if (is_dir($dir))
    		if ($dh = opendir($dir))
    		{
        		while (($file = readdir($dh)) !== false)
            		if(filetype($dir . $file) == 'file') array_push($this->imagearray,$dir.$file);
        		closedir($dh);
    		}
	}
	public function factoryMail()
	{
		$filename=$this->pathtotemplate.$this->templatename;
		$this->fathImageNametoArray($this->pathtoimage);
		
		$this->htmlmessage="";
		$template = fopen($filename, "r") or die($php_errormsg);
		while(!feof($template)) $this->htmlmessage = $this->htmlmessage . fgets($template);
		fclose ($template);
		
		foreach ($this->rrulesarray as $rules => $replace)
			$this->htmlmessage=str_replace($rules,$replace,$this->htmlmessage);
		
		$imagegroup=$this->imagearray;
		$this->mail = new SendMail();
		$this->mail->SetRecipients($this->recipients);
		$this->mail->SetSubject($this->subject);
		$this->mail->SetHtmlMesage($this->htmlmessage);
		$this->mail->SetGroupImages($imagegroup);
	}
}
?>