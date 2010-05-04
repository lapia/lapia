<?php
class SqlConnect {

	private $resource;

	public function SqlConnect()
	{
		$this->iNitComponents();
	}
	private function iNitComponents()
	{
		if(isset($_SESSION['SQLSETTINGS']))
		{
			$row=$_SESSION['SQLSETTINGS'];
			$this->resource= mysql_connect($row['host'],$row['user'],$row['password'])or die("can't tonnect to db server");
			mysql_select_db($row['dbname'],$this->resource)or die("There was an error selecting database");
		}
		else
		{
			echo 'err class AdminForm: not set $_SESSION[\'SQLSETTINGS\']';
			echo "<br> example setings \$_SESSION['SQLSETTINGS']=array('host'=>'url','user'=>'root','password'=>'password','dbname'=>'dbmane');";
			return false;
		}
		return true;
	}
	public function disocnnect() { mysql_close($this->resource) or die("disocnect error") ;}
	public function &getResource() { return $this->resource;}
}
?>
