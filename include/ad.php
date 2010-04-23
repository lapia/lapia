<?php
session_start();
include_once 'sqlconnect.php';
error_reporting(E_ALL);
ini_set('display_errors',1);


class AdminForm{

		private $resource;


		public function AdminForm()
		{

				$dbconnect= new SqlConnect("localhost","root","test1","LHR");
				$dbconnect->connectToDb();

				$this->resource= &$dbconnect->getResource();

				if(isset($_SESSION['ADMINSESSION']))
				{
					if(isset($_POST['admp'])) $this->Upadte();
				}

				$this->setSession();
				$this->ShowFrom();

				$dbconnect->disocnnect();
			}
			private function setSession()
			{
				if(isset($_POST['Start_date']))
					$adminsesion=array('Start_date'=>$_POST['Start_date'],'Finish_date'=>$_POST['Finish_date'],'area'=>$_POST['Area'],'Status'=>$_POST['Status']);
				else
				{
					if(!isset($_SESSION['ADMINSESSION'])){
						$today=date('Y-m-d');
						$adminsesion=array('Start_date'=>$today,'Finish_date'=>$today,'area'=>'ALL','Status'=>'all');
					}
					else $adminsesion=array('Start_date'=>$_POST['Start_date'],'Finish_date'=>$_POST['Finish_date'],'area'=>$_POST['Area'],'Status'=>$_POST['Status']);
				}
				$_SESSION['ADMINSESSION']=$adminsesion;

			}
		private function ShowFrom()
		{

			$result=NULL;
			if(isset($_POST['Start_date']))
			{

				if($_POST['Area'] == 'ALL') $areasub="";
				else $areasub="AND area='".$_POST['Area']."'";
				$intStatus=$this->StatusToInt($_POST['Status']);

				if($intStatus != NULL) $statuSub=" AND r.Status='".$intStatus."'";
				else $statuSub=" ";

				//select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode, ru.RegisteredEmailaddress mail from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser and Startingdate between '1999-04-21' and '2011-04-22' union all select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode, nru.UnregisteredEmailaddress mail from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '1999-04-21' and '2011-04-22' order by Startingdate,Statingtime;
				//$query="SELECT r.idReservation, r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode, ru.RegisteredEmailaddress mail from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser AND Startingdate BETWEEN '".$_POST['Start_date']."' and '".$_POST['Finish_date']."' ".$areasub." ".$statuSub." UNION ALL SELECT r.idReservation,r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode, nru.UnregisteredEmailaddress mail from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '".$_POST['Start_date']."' and '".$_POST['Finish_date']."' ".$areasub." ".$statuSub." order by Startingdate,Statingtime,area";
				$query="SELECT r.idReservation, r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode, ru.RegisteredEmailaddress mail from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser AND Startingdate BETWEEN '".$_POST['Start_date']."' and '".$_POST['Finish_date']."' ".$areasub." ".$statuSub." UNION ALL SELECT r.idReservation,r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode, nru.UnregisteredEmailaddress mail from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '".$_POST['Start_date']."' and '".$_POST['Finish_date']."' ".$areasub." ".$statuSub." order by Startingdate,Statingtime";

				//echo "<h3>" .$query."</h3><br>";
				$result=mysql_query($query,$this->resource);

			}
			$adminsesion=$_SESSION['ADMINSESSION'];


			if($_POST['Area'] == 'A'){
				$a="selected='yes'";
				$all=$ab=$b="";
			}
			else if ($_POST['Area'] == 'B')
			{
				$b="selected='yes'";
				$all=$ab=$a="";
			}
			else if($_POST['Area'] == 'A-B')
			{
				$ab="selected='yes'";
				$all=$b=$a="";
			}
			else
			{
				$all=$a=$b=$ab="";
			}


			if($_POST['Status'] == 'deny'){
				$den="selected='yes'";
				$astat=$auth=$pen="";
			}
			else if ($_POST['Status'] == 'authorize')
			{
				$auth="selected='yes'";
				$astat=$den=$pen="";
			}
			else if($_POST['Status'] == 'pending')
			{
				$pen="selected='yes'";
				$astat=$auth=$den="";
			}
			else
			{
				$astat=$auth=$den=$pen="";
			}

			$form="
			<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
				<html>
				<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
				<title>Insert title here</title>
				</head>
				<body>

				<form action=".$_SERVER['PHP_SELF']." method=\"post\" name=\"login\">
				<table border='1'>

				<tr>
				<th colspan=\"2\"><input name=\"Start_date\" type=\"text\" class=\"loginput\" id=\"email\" value='".$adminsesion['Start_date']."'/></th>
				<th>to</th>
				<th><input name=\"Finish_date\" type=\"text\" class=\"loginput\" id=\"email\" value='".$adminsesion['Finish_date']."' /></th>
				<th>yyyy-mm-dd</th>
				<th>Only show</th>
				 	<td height=\"0\"><label>Section :<select name=\"Area\"><option value=\"ALL\" $all>ALL</option><option value=\"A\" $a>A</option><option value=\"B\" $b>B</option><option value=\"A-B\" $ab>A-B</option></select></label></td>
				 <th>empty</th>
				 <td height=\"0\"><label>Status :<select name=\"Status\"><option value=\"all\" $astat>all</option><option value=\"authorize\" $auth>authorize</option><option value=\"pending\" $pen>pending</option><option value=\"deny\" $den>deny</option></select></label></td>
					<th><input name=\"Submit\" type=\"submit\" class=\"botton\" value=\"Search\" /></th>
				<td>Update</td>
				</tr>
				<tr>

					<th>Id</th>
					<th>Section</th>
					<th>date</th>
					<th>name</th>
					<th>time</th>
					<th>end time</th>
					<th>email</th>
					<th>authcode</th>
					<th>status</th>
					<th>change status</th>
					<th>update</th>
				</tr>
			";

			if($result != null)
			{
				while ($row = mysql_fetch_assoc($result)) {
					$form.="<tr>

						<td>".$row['idReservation']."</td>
						<td>".$row['area']."</td>
						<td>".$row['Startingdate']."</td>
						<td>".$row['cperson']."</td>
						<td>".$row['Statingtime']."</td>
						<td>".$row['Endingtime']."</td>
						<td>".$row['mail']."</td>
						<td>".$row['Reservecode']."</td>
						<td>".$this->StatusToString($row['Status'])."</td>
						<td><select name=\"Change-Status_".$row['idReservation']."\"><option>default</option><option value=\"pending\">pending</option><option value=\"authorize\">authorize</option><option value=\"deny\">deny</option></select></label></td>
						<td><button type=\"submit\" value=".$row['idReservation']." name=\"S_UPDATE\">Update</button> </td>
						</tr>";
				}
				$form.="</table>";
			}
			$form.="<input type='hidden' name='admp' value='0'>";
			$form.="<button type=\"submit\" name=\"A_UPDATE\">Update All</button>";
			$form.="</form></body></html>"; //finish form
			echo $form;
			mysql_free_result($result);
		}
		private function StatusToString($status)
		{
			$rstatus;
			switch($status)
			{
				case 0:
					$rstatus = 'pending';
					break;
				case 1:
					$rstatus = 'authorize';
					break;
					$rstatus = 'deny';
				case 2:
					break;
			}

			return $rstatus;
		}
		private function StatusToInt($status)
		{

			$rstatus;
			if(0 == strcmp($status,'pending')) $rstatus=0;
			else if(0 == strcmp($status,'authorize')) $rstatus=1;
			else if(0== strcmp($status,'deny')) $rstatus=2;
			else $rstatus = NULL;

			return $rstatus;
		}
		private function Upadte()
		{
			foreach ($_POST as $post=>$value)
			{
				$row = explode("_",$post);
				if((0 != strcmp($row[0],'Change-Status')) || (0 == strcmp($value,'default'))) continue;

				$query="UPDATE  Reservation SET Status='".$this->StatusToInt($value)."'  WHERE idReservation='".$row[1]."'";
				//echo $query;
				$result=mysql_query($query,$this->resource);
			}
		}
}

/*
 * test
 */


// new AdminForm();

/*
	echo '<p>post<p>';
	foreach($_POST as $post=>$wartosc)
	{

		echo "<p>".$post." = ".$wartosc."</p>";
	}
	echo '<p>session<p>';
	foreach($_SESSION as $sesja=>$wartosc){
		if (is_array($wartosc)){
			echo "zawartosc tablicy";
			foreach($wartosc as $tablica=>$pole);
				echo "<p>".$tablica." = ".$pole."</p>";
			echo "</p>koniec zawartosc tablicy</p>";
			continue;
		}
		echo "<p>".$sesja." = ".$wartosc."</p>";
	}

 */
 ?>
