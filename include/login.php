<?php
class Login
{
	
	public function Login()
	{
		
		if($_GET["logedout"]=="yes")
		{	
			echo "You have been loged out ";
			$_SESSION["logedin"]="logedout";
		}
		if(isset($_POST['inlogin'])){
			if($this->cHackLogin() == true ){
				$p="";
				for($i=strlen($_POST["password"]);$i > 0;$i--) $p=$p.'x';
				$this->ShowLogin("loged in",$_POST["login"],$p);
				$_SESSION["logedin"]="true";
				$_SESSION["Loginlogin"]=$_POST["login"];
				$_SESSION["Loginpassword"]=$p;
				echo "<a href='index.php?logedout=yes'> loged out</a>";
			}else $_SESSION["logedin"]= 'false';
		}else
		{
			if($_SESSION["logedin"] == 'false') $this->ShowLogin("Wrong password or login!!!"); 
			else{
				$this->ShowLogin("loged in",$_SESSION["Loginlogin"],$_SESSION["Loginpassword"]); 
				echo "<a href='index.php?logedout=yes'> loged out</a>";
			}
		}
	}
	public function ShowLogin($mesage="",$l="",$p="")
	{
		echo "$mesage<br>";
		echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
		echo "Login: <input type=text name=login value='".$l."'><br>";
		echo "Password: <input type=password name=password value='".$p."'><br>";
		echo "<input type=submit name='inlogin' value='Login!'>";
		echo "</form>";
		echo "<a href='newuser.php?register=yes'> Register!</a>";
		echo "<a href='index.php?lostpassword=yes'> Lost password</a>";
	}
	public function cHackLogin()
	{
		$log=htmlspecialchars($_POST["login"]);
		$pass=htmlspecialchars($_POST["password"]);
		$query="select * from registereduser where RegisteredEmailaddress='".$log."' and password='".$pass."'";
		
		if(mysql_num_rows(mysql_query($query))) return true;
		return false;	
	}
}
?>