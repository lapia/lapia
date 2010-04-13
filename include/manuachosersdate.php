<?php
echo "<script src='submitform.js' type='text/javascript'></script>";
class ManuaChosersDate
{
	private $y;
	private $m;
	private $d;
	private $dayinmonth;
	private $time;
	private $duration;
	private $area;
	private $infotab;
	private $disablebutton;
	public function ManuaChosersDate($date,$infotab)
	{
		$this->disablebutton=FALSE;
		$this->infotab=$infotab;
		if(isset($_POST['choserdate']))
		{
			$this->time=$_POST['areatime'];
			$this->duration=$_POST['areaduration'];
			$this->area=$_POST['areaarea'];
			$this->SetSessiondata();
		}
		else
		{
			$this->ExplodeDate($_POST['date']);
			$this->area='A';
			$this->time=0;
			$this->duration=1;
			$this->SetSessiondata();
		}


		if(!isset($_POST['date'])){
			$date=date("Y-m-d");
		}

		$this->ExplodeDate($date);
		if(isset($_POST['areaday'])) $_SESSION["areadate"]=$_POST['areayear'].'-'.$_POST['areamonth'].'-'.$_POST['areaday'];

		$this->dayinmonth=cal_days_in_month(CAL_GREGORIAN, $this->m, $this->y);
	}
	public function DisableButton($disable=TRUE){$this->disablebutton=$disable;}
	private function ExplodeDate($date)
	{
		$this->y=substr($date,0,4);
		$this->m=substr($date,5,2);
		$this->d=substr($date,8,2);
	}
	private function SetSessiondata(){
		$_SESSION['areatime']=$this->time;
		$_SESSION['areaduration']=$this->duration;
		$_SESSION['areaarea']=$this->area;
	}
	public function ShowForm()
	{

			$test=false;
			$test=$this->CheckAvailability();

			echo "<form name='ManuaChosers' action='".$_SERVER['PHP_SELF']."' method=post>";
			echo "Select Area:";
			$this->ShowListArea("areaarea");
			echo "<br>Date";
			$this->ShowList("areaday",1,$this->dayinmonth,$this->d);
			$this->ShowList("areamonth",1,12,$this->m);
			$this->ShowList("areayear",$this->y-1,$this->y+1,$this->y);
			echo "<br>Hour";
			$this->ShowList("areatime",0,23,$this->time);
			echo "<br>Duration";
			$this->ShowList("areaduration",1,24,$this->duration);
			echo "<INPUT TYPE=hidden NAME=choserdate VALUE='send'>";
			echo "</form>";

			echo "<FORM METHOD='LINK' action='../html/reg_user_confirm_message.php'>";
			//echo "<FORM METHOD='LINK' action='../test.php'>";
			if($test && !$this->disablebutton){
				echo "<button type='submit' name='next_step' id='xx' value='true'>Go to reservation</button>";
				//"fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
				$reservation=array('date' => $_SESSION['areadate'], 'time' => $_SESSION['areatime'],'duration' => $_SESSION['areaduration'],'area'=>$_SESSION['areaarea']);
				$_SESSION['reservation']=$reservation;
			}
			else echo "<button type='submit' disabled='disabled' name='next_step' value='false'>Go to reservation</button>";
			echo "</FORM>";
		/*
		areaday
		areamonth
		areayear
		areatime
		areaduration
		*/
	}

	private function CheckAvailability()
	{



		/*private $y;
		private $m;
		private $d;
		private $dayinmonth;
		private $time;
		private $duration;
		private $area;
		private $infotab;
		*/
		$date_start_time=mktime($this->time, 0, 0,$this->m,$this->d,$this->y);
		$curentdate=time();
		$calendardate=$date_start_time;
		$calendatrdate-=3*60*60*1000;

		/**
		 * prevents the reservation in the past
		 */
		if($curentdate >= $calendardate)
		{
			echo $this->infotab['past_time'];
			return false;
		}


		$date_finish_time=$date_start_time+(($this->duration)*60*60);
		$ds=date('Y-m-d',$date_start_time);
		$ds0=date('Y-m-d',$date_start_time-24*60*60); //startdate -24 h
		$df=date('Y-m-d',$date_finish_time);
		$df1=date('Y-m-d',$date_finish_time+24*60*60); //finishdate +24 h



		//$area=$_POST['areaarea'];
		if($this->area == 'A&B'){ $area_a='A';$area_b='B';}
		else { $area_b=$area_a=$this->area;}
		//select * from Reservation where Startingdate BETWEEN '2010-10-01' AND '2010-12-01' and Endingdate BETWEEN '2010-10-01' AND '2010-12-01' and Statingtime BETWEEN '08:00' and '17:00' and Endingtime BETWEEN '08:00' and '17:00';
		$query="select Startingdate, Statingtime,Endingdate, Endingtime from Reservation where Startingdate BETWEEN '$ds0' AND '$df' and Endingdate BETWEEN '$ds' AND '$df1' and (area='$area_a' or area='$area_b') and idAdminuser is not NULL";

		//echo $query;
		$result=mysql_query($query);
		if(mysql_num_rows($result))
		{
			echo '<br>' .mysql_num_rows($result);
			while($row=mysql_fetch_assoc($result))
				if(!$this->CheckTime($row,$date_start_time,$date_finish_time)) { echo $this->infotab['busy_period'];$_POST['next_step']='incorect';return false;}
		}
		echo $this->infotab['free_time'];
		$_POST['next_step']='corect';
		return true;
	}
	public function CheckTime($assocarray,$stime,$ftime)
	{
		$arr=$assocarray;
		$sm=substr($arr['Startingdate'],5,2);
		$sd=substr($arr['Startingdate'],8,2);
		$sy=substr($arr['Startingdate'],0,4);
		$sh=substr($arr['Statingtime'],0,2);
		$smin=substr($arr['Statingtime'],3,2);
		$fm=substr($arr['Endingdate'],5,2);
		$fd=substr($arr['Endingdate'],8,2);
		$fy=substr($arr['Endingdate'],0,2);
		$fh=substr($arr['Endingtime'],0,2);
		$fmin=substr($arr['Endingtime'],3,2);

		$start=mktime($sh,$smin,0,$sm,$sd,$sy);
		$finish=mktime($fh,$fmin,0,$fm,$fd,$fy);

		//echo "<br>data $sy $sm $sd time $sh $smin finish date $fy $fm $fd time $fh $fmin<br>";
		if(($start > $stime && $start >= $ftime) || ($finish <= $stime && $finish < $ftime)) return true;

		return false;
	}
	public function SetCalendar($calendar)
	{
		if(isset($_POST['choserdate']))
		{
			$this->d=$d=$_POST['areaday'];
			$_SESSION['cmonth']=$this->m=$m=$_POST['areamonth'];
			$_SESSION['cyear']=$this->y=$y=$_POST['areayear'];
			$_POST['date']=$y.'-'.$m.'-'.$d;
			$calendar->SetDate($y,$m,$d);
		}
	}
	private function ShowList($name,$start,$stop,$test=-1)
	{
		$menu.= "<select name='".$name."' onChange='submitManuaChosers()'>";
			for($i=$start; $i <= $stop;$i++)
			{
				if($test== $i) $menu.= "<option selected='selected' value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
				else $menu.= "<option value='".sprintf("%02d",$i)."'>".sprintf("%02d",$i)."</option>";
			}
		$menu.= "</select>";

		echo  $menu;
	}
	private function ShowListArea($name)
	{
		echo "<select name='".$name."' onChange='submitManuaChosers()'>";
		if(isset($_POST['areaarea']))
		{
			echo "area ".$_POST['areaarea'];
			if($_POST['areaarea'] == "A")
			{
				echo "<option selected='selected' value='A'>Area A</option>";
				echo "<option value='B'>Area B</option>";
				echo "<option value='A&B'>Area A&B</option>";
			}
			else if($_POST['areaarea'] == "B")
			{
				echo "<option value='A'>Area A</option>";
				echo "<option selected='selected' value='B'>Area B</option>";
				echo "<option value='A&B'>Area A&B</option>";
			}
			else
			{
				echo "<option value='A'>Area A</option>";
				echo "<option value='B'>Area B</option>";
				echo "<option selected='selected' value='A&B'>Area A&B</option>";
			}
		}else
		{
			echo "<option value='A'>Area A</option>";
			echo "<option value='B'>Area B</option>";
			echo "<option value='A&B'>Area A&B</option>";
		}
		echo "</select>";
	}
}
?>
