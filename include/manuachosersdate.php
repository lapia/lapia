<?php
class ManuaChosersDate
{
	private $y;
	private $m;
	private $d;
	private $dayinmonth;
	private $time;
	private $duration;
	private $area;
	public function ManuaChosersDate($date)
	{
		if(isset($_POST['choserdate']))
		{
			$this->time=$_POST['areatime'];
			$this->duration=$_POST['areaduration'];
			$this->area=$_POST['areaarea'];
			$this->SetSessiondata();
		}

		if(!isset($_POST['date'])){
			$date=date("Y-m-d");
		}
		$this->ExplodeDate($date);
		if(isset($_POST['areaday'])) $_SESSION["areadate"]=$_POST['areayear'].'-'.$_POST['areamonth'].'-'.$_POST['areaday'];

		$this->dayinmonth=cal_days_in_month(CAL_GREGORIAN, $this->m, $this->y);
	}
	private function ExplodeDate($date)
	{
		$this->y=substr($date,0,4);
		$this->m=substr($date,5,2);
		$this->d=substr($date,8,2);
	}
	private function SetSessiondata(){
		$_SESSION['areatime']=$this->time;
	//	$_SESSION['areamonth']=
	//	$_SESSION['areaday']=
	//	$_SESSION['areayear']=
		$_SESSION['areaduration']=$this->duration;
		$_SESSION['areaarea']=$this->area;
	}
	public function ShowForm()
	{

			$test=false;
			if(isset($_POST['next_step'])) $test=$this->CheckAvailability();

			echo "<form action='index.php' method=post>";
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
			echo '<INPUT TYPE=hidden NAME=choserdate VALUE="send">';
			echo "<br><input type=submit name=next_step value='Check'>";
			echo "</form>";

			echo "<FORM METHOD='LINK' action='test.php'>";
			if($test) echo "<button type='submit' name='next_step' value='true'>Go to reservation</button>";
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

		$date_start_time=mktime($_POST['areatime'], 0, 0,$_POST['areamonth'], $_POST['areaday'], $_POST['areayear']);
		$date_finish_time=$date_start_time+(($_POST['areaduration'])*60*60);
		$ds=date('Y-m-d',$date_start_time);
		$df=date('Y-m-d',$date_finish_time);
		$ts=date('H:i',$date_start_time);
		$tf=date('H:i',$date_finish_time);
		$tfm=date('H:i',$date_finish_time-(60*60));
		$tsm=date('H:i',$date_start_time-(60*60));
		$tsu=date('H:i',$date_start_time+(60*60));
		$area=$_POST['areaarea'];

		//select * from Reservation where Startingdate BETWEEN '2010-10-01' AND '2010-12-01' and Endingdate BETWEEN '2010-10-01' AND '2010-12-01' and Statingtime BETWEEN '08:00' and '17:00' and Endingtime BETWEEN '08:00' and '17:00';

		$query="select * from Reservation where Startingdate BETWEEN '$ds' AND '$df' and Endingdate BETWEEN '$ds' AND '$df' and Statingtime BETWEEN '$ts' and '$tfm' and Endingtime BETWEEN '$tsu' and '$tf' and area='$area' and Rstat is NULL or Rstat='0'";

	//	echo $query;
		if(mysql_num_rows(mysql_query($query)))
		{
			echo '<br>'.mysql_error();
			$_POST['next_step']='inclorect';
			return false;
		}
		$_POST['next_step']='corect';
		return true;
	}
	public function SetCalendar($calendar)
	{
		if(isset($_POST['choserdate']))
		{
			$this->d=$d=$_POST['areaday'];
			$this->m=$m=$_POST['areamonth'];
			$this->y=$y=$_POST['areayear'];
			$_POST['date']=$y.'-'.$m.'-'.$d;
			$calendar->SetDate($y,$m,$d);
		}
	}
	private function ShowList($name,$start,$stop,$test=-1)
	{
		$menu.= "<select name='".$name."'>";
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
		echo "<select name='".$name."'>";
		if(isset($_POST['areaarea']))
		{
			echo "area ".$_POST['areaarea'];
			if($_POST['areaarea'] == "A")
			{
				echo "<option selected='selected' value='A'>Area A</option>";
				echo "<option value='B'>Area B</option>";
			}else
			{
				echo "<option value='A'>Area A</option>";
				echo "<option selected='selected' value='B'>Area B</option>";
			}
		}else
		{
			echo "<option value='A'>Area A</option>";
			echo "<option value='B'>Area B</option>";
		}
		echo "</select>";
	}
}
?>
