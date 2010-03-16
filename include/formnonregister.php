<?php
class FormNonRegister
{
	private $mail; 
	private $adr;  	//addres
	private $ca;   	//contatact person
	private $or;   	//name of organization 
	private $ph;   	//phone
	private $added;
	private $y;
	private $m;
	private $d;
	public function FormNonRegister()
	{	
		if($_SESSION['ShowRegisterForm'] == 0){
			$this->added=false;
			if(!isset($_POST['ShowRegisterForm']) )
			{
					$this->showNonRegisterForm($mesage="");
			}else{
				if($this->aHeckForm())
				{
					if($this->CheckUser()){
						$this->aDdUserToDb();
						$this->added=true;
						$this->AdReservation();
					}else {
						echo 'this user already exists in db';
						$this->AdReservation();
						$this->added=true;
					}
					$this->added=true;
					$_SESSION['ShowRegisterForm']=1;
				}
				else $this->added=false;
			}
		}
	}
	function aHeckForm()
	{
		if(!empty($_POST["mail"]) && !empty($_POST["noforganization"]) && !empty($_POST["addres"]) && !empty($_POST["phone"]) && !empty($_POST["cpersopn"])) return true;
		return false;
	}
	function CheckUser()
	{
		$query="select * from Unregistereduser where UnregisteredEmailaddress='".$_POST['mail']."' and Address='".$_POST["addres"]."' and Contactperson='".$_POST["cpersopn"]."' and OrganizatioNname='".$_POST["noforganization"]."' and phone='".$_POST["phone"]."'";
		echo "<br>". $query;
		if(mysql_num_rows(mysql_query($query))) return false;
		return true;
	}
	function AdReservation()
	{
		$this->ExplodeDate($_SESSION['areadate']);
		
		$key=new GenKey($_POST['mail'],'Reservation','Reservecode');
		$key=$key->GetCode();
		$date_start_time=mktime($_SESSION['areatime'], 0, 0,$this->m, $this->d, $this->y);
		$date_finish_time=$date_start_time+(($_SESSION['areaduration'])*60*60);
		$ds=date('Y-m-d',$date_start_time);
		$df=date('Y-m-d',$date_finish_time);
		$ts=date('H:i',$date_start_time);
		$tf=date('H:i',$date_finish_time);
		$query="(select idUnregistereduser from Unregistereduser where UnregisteredEmailaddress='".$_POST['mail']."' and Address='".$_POST["addres"]."' and Contactperson='".$_POST["cpersopn"]."' and OrganizatioNname='".$_POST["noforganization"]."' and phone='".$_POST["phone"]."')";
		$aquery="insert into Reservation( Reservecode,area,Statingtime,Endingtime,Startingdate,Endingdate,idUnregistereduser) values('$key','".$_SESSION['areaarea']."','$ts','$tf','$ds','$df',$query)";
		mysql_query($aquery);
		echo '<br> rezerwacja <br> :' . $aquery . mysql_error();
		
	}
	private function ExplodeDate($date)
	{
		$this->y=substr($date,0,4);
		$this->m=substr($date,5,2);
		$this->d=substr($date,8,2);	
	}
	function aDdUserToDb()
	{
		$this->ra=htmlspecialchars($_POST["mail"]);
		$this->adr=htmlspecialchars($_POST["addres"]);
		$this->ca=htmlspecialchars($_POST["cpersopn"]);
		$this->or=htmlspecialchars($_POST["noforganization"]);
		$this->ph=htmlspecialchars($_POST["phone"]);

		$query="insert into Unregistereduser(UnregisteredEmailaddress,Address,Contactperson, OrganizatioNname,phone) values('$this->ra','$this->adr','$this->ca','$this->or','$this->ph')";
		echo '<br>'.$query.'<br>';
		mysql_query($query) ; // zapisywanie rekordu do bazy	
		echo   mysql_error();
	}
	function showNonRegisterForm($mesage="")
	{
		echo "$mesage<br>";
		echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
		echo "Email: <input type=text name=mail><br>";
		echo "Name of Organization: <input type=text name=noforganization><br>";
		echo "Contact persopn: <input type=text name=cpersopn><br>";
		echo "Addres: <input type=text name=addres><br>";
		echo "Phone: <input type=text name=phone><br>";
		echo "<input type=submit name=ShowRegisterForm value='Submit'>";
		echo "</form>";
	}
}
?>