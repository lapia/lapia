<?php
include_once 'include/sqlconnect.php';
class Login
{
		private $dbconnect;
		private $resource;
        public function Login()
        {
			
        	$this->dbconnect= new SqlConnect();
        	$this->resource= &$this->dbconnect->getResource();
        	
        	if(isset($_GET["logedout"]))
	                if($_GET["logedout"]=="yes")
	                {
	                        echo "You have been loged out ";
	                        unset($_SESSION['username']);
	                        $_SESSION['userid']=0;
	                }
                
                if(isset($_POST['inlogin'])){
                        if($this->cHackLogin() == true ){
                                $p="";
                                for($i=strlen($_POST["password"]);$i > 0;$i--) $p=$p.'x';
                                $this->ShowLogin("loged in",$_POST["login"],$p);
                                $_SESSION["logedin"]="true";
                                $_SESSION['username']=$_POST["login"];
                                $_SESSION["Loginpassword"]=$p;
                                echo "<a href='index.php?logedout=yes'> loged out</a>";
                        }else echo "<script type='text/javascript'>document.location = 'http://localhost/Lapp/newuser.php'</script>";
                }else
                {
                        if(!isset($_SESSION['username'])) $this->ShowLogin("you have not logged in!!!");
                        else{
                                $this->ShowLogin("loged in",$_SESSION['username'],$_SESSION["Loginpassword"]);
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
        		$login=false;
                $log=htmlspecialchars($_POST["login"]);
                $pass=htmlspecialchars($_POST["password"]);
                $query="select idRegistereduser from registereduser where RegisteredEmailaddress='".$log."' and password='".$pass."'";
                echo $query;
                $result=mysql_query($query,$this->resource);
                if(mysql_num_rows($result)){
                        $row = mysql_fetch_assoc($result);
                        $_SESSION['userid']=$row['idRegistereduser'];
                        echo "<br>user id= ". $row['idRegistereduser'];
                        $login= true;
                }
                else  $_SESSION['userid']=0; //user not login

                $this->dbconnect->disocnnect();
                return $login;
        }
}
?>
