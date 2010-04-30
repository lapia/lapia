<?php
class Calendar 
{
	private $days; //how many days in month
	private $year;
	private $day;
	private $month;
	private $cday; //current day
	private $startmonth;
	private $firstdayofmonth;
	private $backlight;
	private $button;
	public function Calendar() //get curent month, year, day;
	{
		$this->backlight['year']=0;
        $this->backlight['mounth']=0;
        $this->backlight['day']=0;
        $this->button="";
		
        $this->cday=date("j");
		$this->day=0;
		if(!isset($_POST['date'])) $_POST['date']=$_SESSION['lastdate'];
		else $_SESSION['lastdate']=$_POST['date'];
		
		if(isset($_SESSION['cmonth'])) //sprawdzam czy istnieje cmonth w danych sesji
		{
			//ustawiam dni w zaleznosci od wcisnietego przycisku
			if($_POST['changedate'] == 'next')
			{
				if( $_SESSION["cmonth"] == 12) 
				{
					$_SESSION["cmonth"]=1;
					$_SESSION["cyear"]+=1; 
					
				}
				else $_SESSION["cmonth"]+=1;
				$_POST['date']=$_SESSION['cyear'].'-'.$_SESSION['cmonth'].'-'.'01';
			}
			else if ($_POST['changedate'] == 'last')
			{ 
				if( $_SESSION["cmonth"] == 1) 
				{
					$_SESSION["cmonth"]=12;
					$_SESSION["cyear"]-=1; 
					
				}
				$_SESSION["cmonth"]-=1;
				$_POST['date']=$_SESSION['cyear'].'-'.$_SESSION['cmonth'].'-'.'01';
			}
			$this->month=$_SESSION['cmonth'];
			$this->year=$_SESSION['cyear'];
			$this->startmonth=$_SESSION['cstartmonth'];
			
		}
		else //if don't exist put to session
		{
			$this->year=date("Y");
			$this->startmonth=$this->month=date("n");
			
			$_SESSION["cmonth"]=$this->getMonth();
			$_SESSION["cyear"]=$this->getYear();
			$_SESSION['cstartmonth']=$this->getStartMonth();
		}
		
		$this->setDaysInmonth();
	}
	public function setBacklightDate($date) 
   	{
                $this->backlight['year']=substr($date,0,4);
                $this->backlight['mounth']=substr($date,5,2);
                $this->backlight['day']=substr($date,8,2);
     }
    public function ButtonOff()
    {
    	$this->button="disabled='disabled'";
    }
    public function  ButtonOn()
    {
    	$this->button="";
    }
	private function checkBacklight($d,$m,$y)
	{
		if($this->backlight['year'] == $y && $this->backlight['mounth'] == $m && $this->backlight['day'] == $d) return true;
		return false;
	}
	public function getFirstDayofmonth()
	{
		$FirstDay = mktime(0, 0, 0, $this->month, 1, $this->year);
		return date("N", $FirstDay); //set the na
	}
	public function getYear(){return $this->year;}
	public function setYear($yr){$this->year= $yr;}
	public function getMonth(){ return $this->month;}
	public function setMonth($mnth){$this->month=$mnth;}
	public function getStartMonth() {return $this->startmonth;}
	public function getCday(){ return $this->cday; }
	public function setCday($cd){ $this->cday=$cd; }	
	public function getDaysInmonth(){ return $this->days;}
	public function getMonthName()
	{
    	$strTime=mktime(1,1,1,$this->month,1,$this->year);
    	return date("M",$strTime);
	} 
	public function getDaysInmonthManual($mnth){
		$year=$this->year;
		if($mnth = 1) $year--;
		else if($mnth = 12) $year++;
		return cal_days_in_month(CAL_GREGORIAN, $mnth, $year);
	}
	public function setDaysInmonth(){ 
		return $this->days=cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
	}
	public function SetDate($year,$month,$day){
		 $this->month=$month;
		 $this->year=$year;
		 $this->day=$day;
		 
	}
	public function sHowCalendar()
	{
			
			$this->setDaysInmonth();
			$firstday=$this->getFirstDayofmonth();
			//$_SERVER['PHP_SELF']
			echo "<form method='POST' name='Calendar' action='".$_SERVER['PHP_SELF'] ."'>";
			echo sprintf("<button type=\"submit\" value='last' ".$this->button." name=changedate class='cleft'>%s</button>","<<");
			echo sprintf("<button type=\"submit\" disabled=\"disabled\" class='cdate' >%s %d</button>",$this->getMonthName(),$this->getYear());
			
			echo sprintf("<button type=\"submit\" ".$this->button." value='next' name=changedate class='cright'>%s</button>",">>"); 
			echo "<br>"; 
			
			$i;
			$dayslastmonth=$this->getDaysInmonthManual($this->month-1); //ustawiam miesiac na wczesniejszy aby obliczyc ostatnie dni bylego miesica
			if($firstday == 1)
			{
				for($i=1,$dayslastmonth-=6; $i <= 7; $i++,$dayslastmonth++) echo "<button disabled='disabled' class='cdisabled'>",sprintf("%02d",$dayslastmonth),'</button>';
				echo '<br>';
				$diferentdays=$i;
			}
			else
			{
				for($i=1,$dayslastmonth-=($firstday-2); $i < $firstday; $i++,$dayslastmonth++) echo "<button disabled='disabled' class='cdisabled'>",sprintf("%02d",$dayslastmonth),'</button>';
				$diferentdays=$i;
			}
			
			for($i; $i < $this->days+$diferentdays ;$i++ )
			{
				$day=$i-$diferentdays+1;
				
				if((substr($_POST['date'],8,2) ==  $day && !isset($_POST['changedate']) && $_POST['callendar']=='send' ) || $this->checkBacklight($day,$this->month,$this->getYear()) == true  )//|| ($this->day == $day))
				{ 
					echo '<button style="background-color:red" name=date'.sprintf("%02d-%02d-%02d",$this->year,$this->month,$day).'type="submit" disabled="disabled" class="cselected">';
					echo '<font color=white>';
					echo sprintf("%02d",$day);
					echo '</font>';
					echo '</button>';
				}
				else if($this->cday == $day && $this->startmonth == $this->month) //curent day
				{
					echo sprintf("<button type=\"submit\" name=date value='".date("Y-m")."-%02d' ".$this->button." class='ctoday'>",$day); 
					echo '<font color=red>';
					echo sprintf("%02d",$day);
					echo '</font>';
					echo '</button>';
				}else echo sprintf("<button type=\"submit\" name=date value='%02d-%02d-%02d' ".$this->button." class='cenabled'>%02d</button>",$this->year,$this->month,$day,$day);
				if(($i%7)==0) echo '<br>';
			}
			
			for($i,$y=1; $i <= 42;$i++,$y++){
				echo '<button disabled="disabled" class="cdisabled">',sprintf("%02d",$y),'</button>';
				if(($i%7)==0) echo '<br>';
			}
			echo '<INPUT TYPE=hidden NAME=callendar VALUE="send">';
			echo '</form>';
	}
}
?>
