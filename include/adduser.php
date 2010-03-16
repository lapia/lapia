<?php
class AddUser
{
	private $ra;   	//login
	private $adr;  	//addres
	private $ca;   	//contatact person
	private $or;   	//name of organization 
	private $pass; 	//password
	private $ph;   	//phone
	private $ccode; //confirmationcode
	
	public function AddUser()
	{	
		if($_GET['register']=="yes") $_SESSION["ShowRegisterForm"]=0;
		if($_SESSION["ShowRegisterForm"] == 0)
		{
			$this->sHowRegisterForm();
			$_SESSION["ShowRegisterForm"]=1;
			echo "<br>1<br>";
		}
		else
		{
			if($_SESSION["ShowRegisterForm"]!=2){
				if($this->aHeckForm())
				{
					if($this->cHackLogin() == true) $this->ShowRegisterForm("Login has already used. Change login and try again");
					else{ 
						$this->aDdUserToDb();
						$_SESSION["ShowRegisterForm"]=2;
					}
				}
				else if($_POST['RegForm']=='yes'){ 
					echo "<br>nie wypelniono wszystkich pol error<br>"; 
					$this->sHowRegisterForm();
					$_SESSION["ShowRegisterForm"]=3;
				}	
			}
		}
	}
	function cHackLogin()
	{
		if(mysql_num_rows(mysql_query("select * from registereduser where RegisteredEmailaddress='".htmlspecialchars($_POST["alogin"]."'")))) return true; // sprawdzanie czy użytkownik o podanej nazwie już istnieje
		return false;
	}
	function aHeckForm()
	{
		if(!empty($_POST["alogin"]) && !empty($_POST["apassword"]) && $_POST["apassword"]==$_POST["arpassword"] && !empty($_POST["anoforganization"]) && !empty($_POST["aaddres"]) && !empty($_POST["aphone"])) return true;
		return false;
	}
	function aDdUserToDb()
	{
					$this->ra=htmlspecialchars($_POST["alogin"]);
					$this->adr=htmlspecialchars($_POST["aaddres"]);
					$this->ca=htmlspecialchars($_POST["acpersopn"]);
					$this->or=htmlspecialchars($_POST["anoforganization"]);
					$this->pass=htmlspecialchars($_POST["apassword"]);
					$this->ph=htmlspecialchars($_POST["aphone"]);
				
					$query="INSERT INTO registereduser(RegisteredEmailaddress, Address, Contactperson, Organizationname,password,phone) VALUES ('".$this->ra."','".$this->adr."','".$this->ca."','".$this->or."','".$this->pass."','".$this->ph."')";
					echo $query;
					$result=mysql_query($query) ; // zapisywanie rekordu do bazy	
					echo "Thank you for registering :"; //. myesysql_error();
		//			mysql_free_result($result);
	}
	function showRegisterForm($mesage="")
	{
		echo "$mesage<br>";
		echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
		echo "Email: <input type=text name=alogin><br>";
		echo "Password: <input type=password name=apassword><br>";
		echo "Repeat password: <input type=password name=arpassword><br>";
		echo "Name of Organization: <input type=text name=anoforganization><br>";
		echo "Contact persopn: <input type=text name=acpersopn><br>";
		echo "Addres: <input type=text name=aaddres><br>";
		echo "Phone: <input type=text name=aphone><br>";
		echo "<button type='submit' name=RegForm value='yes'>Register </button>";
		echo "</form>";
	}
}
?>