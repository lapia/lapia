<?php
include_once 'include/sqlconnect.php';
class GenKey{
	
	private $code;
	private $timestemp;
	private $dbconnect;
	private $resource;
	function GenKey($mail,$table,$col,$lenght)
	{
		
		$this->dbconnect= new SqlConnect();
		$this->resource = &$this->dbconnect->getResource();
		
		$this->timestemp=time();
		$code=substr(md5($mail.$this->timestemp),0,$lenght);
		$test;
		while(!($test=$this->CheckCode($table,$col,$code))){
			if (!test)
			{
				$this->timestemp=time();
				$code=substr(md5($mail.$timestemp));
			}
		}
		
		$this->code=$code; 
	}
	private function CheckCode($table,$col,$code)
	{
		$test=true;
		$query="select * from $table where $col='$code'";
	//	echo "<br>". $query;
		if(mysql_num_rows(mysql_query($query,$this->resource))) $test=false;
		$this->dbconnect->disocnnect();
		
		return $test;
	}
	public function GetCode() {return $this->code;}
	public function GetTimestemp() { return $this->timestemp;}
}
?>