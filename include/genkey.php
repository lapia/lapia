<?php
class GenKey{
	
	private $code;
	private $timestemp;
	function GenKey($mail,$table,$col,$lenght)
	{
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
		$query="select * from $table where $col='$code'";
		echo "<br>". $query;
		if(mysql_num_rows(mysql_query($query))) return false;
		return true;
	}
	public function GetCode() {return $this->code;}
	public function GetTimestemp() { return $this->timestemp;}
}
?>