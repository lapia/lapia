<?php
class SqlConnect {
	private $host;
	private $user;
	private $password;
	private $db;
	
	public function  SqlConnect($ho,$us,$pas,$d)
	{
		$this->host=$ho;
		$this->user=$us;
		$this->password=$pas;
		$this->db=$d;
	}
	function connectToDb()
	{
		mysql_connect($this->host,$this->user,$this->password)or die("can't tonnect to db server"); //połączenie z bazą danych
		mysql_select_db($this->db)or die("There was an error selecting database");
	}
	function disocnnect() { mysql_close() or die("disocnect error") ;}
	
}
?>