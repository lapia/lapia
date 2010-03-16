<?php
class GenKey{
	
	private $code;
	function GenKey($mail,$table,$col)
	{
		//$mail.=mktime();
		$code=substr(md5($mail.=mktime()),0,24);
		while(!$this->CheckCode($table,$col,$code)) $code=substr(md5($mail.=mktime()),0,24);
		
		$this->code=$code; 
	}
	private function CheckCode($table,$col,$code)
	{
		$query="select * from $table where $col='$code'";
		echo "<br>". $query;
		if(mysql_num_rows(mysql_query($query))) return false;
		return true;
	}
	public function GetCode() {return $this->code;}
}
?>