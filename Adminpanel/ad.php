<?php
include_once 'sqlconnect.php';
/*
 * class AdminForm
 * Author ludo@gmail.com
 *
 * usage
 * new AdminForm();
 *
 * use with debug mode
 *
 * new AdminForm('on') turn on debug mode
 */
class AdminForm{

	private $resource;
	private $db;
	private $debugmode;
	private $date;

	public function AdminForm($debugmode='off')
	{	
		$this->debugmode=$debugmode;
		$this->InitComponent($debugmode);
		if(isset($_POST['S_UPDATE']) || isset($_POST['A_UPDATE'])) $this->Upadte();
	}
	private function InitComponent()
	{
		
		if(isset($_SESSION['SQLSETTINGS']))
		{
			$row=$_SESSION['SQLSETTINGS'];
			$this->db= new SqlConnect($row['host'],$row['user'],$row['password'],$row['dbname']);
			$this->db->connectToDb();
			$this->resource= &$this->db->getResource();
		}
		else
		{
			echo 'err class AdminForm: not set $_SESSION[\'SQLSETTINGS\']';
			echo "<br> example setings \$_SESSION['SQLSETTINGS']=array('host'=>'url','user'=>'root','password'=>'password','dbname'=>'dbmane');";
			return NULL;
		}
			
		if(strcmp($this->debugmode,'on') == 0)
		{
			error_reporting(E_ALL);
			ini_set('display_errors',1);
			echo 'debugmode on class AdminForm <br>';
		}
		
		if(isset($_POST['admp'])) $adminsesion=array('Start_date'=>$_POST['Start_date'],'Finish_date'=>$_POST['Finish_date'],'area'=>$_POST['Area'],'Status'=>$_POST['Status']);
		else
		{
			if(!isset($_SESSION['ADMINSESSION']))
			{
				$today=date('Y-m-d');
				$adminsesion=array('Start_date'=>$today,'Finish_date'=>$today,'area'=>'ALL','Status'=>'all');
			}
			else if ($this->date != NULL)
			{
				$adminsesion=$_SESSION['ADMINSESSION'];
				$adminsesion['Start_date']=$this->date;
				$adminsesion['Finish_date']=$this->date;
			}
			else $adminsesion=$_SESSION['ADMINSESSION'];	//else $adminsesion=array('Start_date'=>$_POST['Start_date'],'Finish_date'=>$_POST['Finish_date'],'area'=>$_POST['Area'],'Status'=>$_POST['Status']);
	
		}
		$_SESSION['ADMINSESSION']=$adminsesion;
	}
	public function ShowFrom()
	{
			
		$result=NULL;
		$adminsesion=$_SESSION['ADMINSESSION'];
			
		if(isset($_POST['admp']))
		{

			if($_POST['Area'] == 'ALL') $areasub="";
			else $areasub="AND area='".$_POST['Area']."'";
			
			$intStatus=$this->StatusToInt($_POST['Status']);
			if($intStatus > -1) $statuSub=" AND r.Status='".$intStatus."'";
			else $statuSub=" ";
			
		}else $statuSub=$areasub=" ";

		$query="SELECT r.idReservation, r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode, ru.RegisteredEmailaddress mail from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser AND Startingdate BETWEEN '".$adminsesion['Start_date']."' and '".$adminsesion['Finish_date']."' ".$areasub." ".$statuSub." UNION ALL SELECT r.idReservation,r.Status, r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode, nru.UnregisteredEmailaddress mail from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '".$adminsesion['Start_date']."' and '".$adminsesion['Finish_date']."' ".$areasub." ".$statuSub." order by Startingdate,Statingtime,area";

		if(strcmp($this->debugmode,'on') == 0) echo "debugmode on : private function ShowFrom() " .$query."<br>";
		
		$result=mysql_query($query,$this->resource);

		if(isset($_POST['admp'])){
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
			else $all=$a=$b=$ab="";
				
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
			else $astat=$auth=$den=$pen="";

		}else $all=$a=$b=$ab=$astat=$auth=$den=$pen="";
			
		/*
		 * <tr class=\"color\">
					<th colspan=\"2\"></th>
					<th>to</th>
					<th></th>
					<th>yyyy-mm-dd</th>
					<th>Only show</th>
					<td height=\"0\"><label>Section :</label></td>
					<th>empty</th>
					<td height=\"0\"><label>Status :</label></td>
					<th><button name=\"Submit\" type=\"submit\" value=\"Search\" />Search</th>
					<td>Update</td>
				</tr>
		 */
		$xform="<form action=".$_SERVER['PHP_SELF']." method=\"post\" name=\"login\">\n";		
		
					
			$xform.=	"<div class=\"theader\">
					
					<div class=\"ID\">Id</div>
					<div class=\"SECTION\">Area</div>
					<div class=\"DATE\">Dare</div>
					<div class=\"NAME\">Name</div>
					<div class=\"TIME\">Time</div>
					<div class=\"ENDTIME\">End T</div>
					<div class=\"EMAIL\">Email</div>
					<div class=\"AUTHCODE\">A.code</div>
					<div class=\"STAT\">Stat</div>
					<div class=\"CHSTAT\">Ch.sta</div>
					<div class=\"UPDATE\">Update</div>
					
					";
			$xform.="\n</div>\n";
			
		if($result != null)
		{
			$i=1;
			while ($row = mysql_fetch_assoc($result)) {

				
				if(($i%2) == 0) $xform.="\n<div class=\"color\">\n";
				else $xform.="
				\n<div class=\"bcolor\">\n";
				$xform.="
						<div class=\"ID\">".$row['idReservation']."</div>
						<div class=\"SECTION\">".$row['area']."</div>
						<div class=\"DATE\">".$row['Startingdate']."</div>
						<div class=\"NAME\">".$row['cperson']."</div>
						<div class=\"TIME\">".$row['Statingtime']."</div>
						<div class=\"ENDTIME\">".$row['Endingtime']."</div>
						<div class=\"EMAIL\">".$row['mail']."</div>
						<div class=\"AUTHCODE\">".$row['Reservecode']."</div>
						<div class=\"STAT\">".$this->StatusToString($row['Status'])."</div>
						<div class=\"CHSTAT\"><select name=\"Change-Status_".$row['idReservation']."\"><option>default</option><option value=\"pending\">pending</option><option value=\"authorize\">authorize</option><option value=\"deny\">deny</option></select></label></div>
						<div class=\"UPDATE\"><button type=\"submit\" value=".$row['idReservation']." name=\"S_UPDATE\">Update</button></div>
						
				\n</div>";
				$i++;
			}
		}
	
	$xform.="
	<div class=\"Search\">
	<table>
	<tr>
		<td>from</td>
		<td><input name=\"Start_date\" type=\"text\"  value='".$adminsesion['Start_date']."' size=\"10\"></td>
	</tr>
	<tr>
		<td>to</td>
		<td><input name=\"Finish_date\" type=\"text\" value='".$adminsesion['Finish_date']."' size=\"10\"><br></td>
	</tr>
	<tr>
		<td>Status</td> 
		<td>
		<select name=\"Status\"><option value=\"all\" $astat>all</option><option value=\"authorize\" $auth>authorize</option><option value=\"pending\" $pen>pending</option><option value=\"deny\" $den>deny</option></select><br>
		</td>
	</tr>
	<tr>
		<td>Section</td>
		<td>
		<select name=\"Area\"><option value=\"ALL\" $all>ALL</option><option value=\"A\" $a>A</option><option value=\"B\" $b>B</option><option value=\"A-B\" $ab>A-B</option></select><br>
		</td>
	</tr>
	<tr>
		<td colspan=\"2\" align=\"center\">
		<button name=\"Submit\" type=\"submit\" value=\"Search\">Search</button>
		<button type=\"submit\" name=\"A_UPDATE\" value=\"1\">Update All</button>
		</td>
	</tr>
	</table>";
		
		$xform.="<input type='hidden' name='admp' value='0'>\n";
		$xform.="</form></div>"; //finish form
		
		echo $xform;
		mysql_free_result($result);
		$this->db->disocnnect();
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
			case 2:
				$rstatus = 'deny';
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
		else $rstatus = -1;
			
		return $rstatus;
	}
	private function Upadte()
	{
		foreach ($_POST as $post=>$value)
		{
			$row = explode("_",$post);
			if((0 != strcmp($row[0],'Change-Status')) || (0 == strcmp($value,'default'))) continue;
	
			$query="UPDATE  Reservation SET Status='".$this->StatusToInt($value)."'  WHERE idReservation='".$row[1]."'";
			if(strcmp($this->debugmode,'on') == 0) echo "debugmode on : private function Upadte()" .$query."<br>";		
			
			$result=mysql_query($query,$this->resource);
			
			if(isset($_POST["S_UPDATE"])) break;
		}
	}
	public function SetDate($date)
	{
		$this->date=$date;
		$this->InitComponent();
	}
		
}
?>