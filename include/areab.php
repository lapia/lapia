<?php
class Area
{
	private $adate;
	private $acoll;
	private $acolorc1;
	private $acolorc2c3;
	private $acolorreservednotchack;
	private $acolorreserved;
	public function Area($date,$colorc1='c9cfc4',$colorc2c3='91d94a',$colorreservednotchack='yellow',$colorreserved='red')
	{
		$this->acolorc1=$colorc1;
		$this->acolorc2c3=$colorc2c3;
		$this->acolorreservednotchack=$colorreservednotchack;
		$this->acolorreserved=$colorreserved;

		if($_SESSION["area"]!='set')
		{
			$_SESSION["area"]='set';
			$this->adate=$_SESSION["areadate"]=date("Y-m-d");
			$this->ShowArea();
		}
		else if($_POST['changedate'] != 'next' && $_POST['changedate'] != 'last'){

				$_SESSION["areadate"]=$this->adate=$date;
				$this->ShowArea();
		}else{
			$this->adate=$_SESSION["areadate"];
			$this->ShowArea();
		}
	}
	private function getReservationTable($date) //2010-11-01
	{
		$nquwey="select  r.area, r.Statingtime, r.Endingtime, ru.Contactperson cperson , Rstat from Reservation r ,registereduser ru where r.RegisteredEmailaddress=ru.RegisteredEmailaddress and Startingdate='".$date."' union all select  r.area, r.Statingtime, r.Endingtime, nru.Contactperson cperson, Rstat from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate='".$date."' order by Statingtime";
//		echo "<br>" .$nquwey. "<br>";
		$query="select r.Statingtime,r.area,r.Rstat,reg.Contactperson from Reservation r,registereduser reg where r.RegisteredEmailaddress=reg.RegisteredEmailaddress and Startingdate='".$date."' order by Statingtime";
		$result=mysql_query($query);
		if(!mysql_num_rows($result))
		{
			$query="select r.Statingtime,r.area,r.Rstat,reg.Contactperson from Reservation r, Unregistereduser reg where r.idUnregistereduser=reg.idUnregistereduser and Startingdate='".$date."' order by Statingtime";
			$result=mysql_query($query);
		}

		$array;
		$i=0;
	 	while($row = mysql_fetch_array($result, MYSQL_NUM)){
	 		$array[$i]=$row;
	 		$i++;
        }
        $this->coll=$i;
		return  $array;
	}
	private function ChangeColor($time, $area)
	{

		$tmp=$this->getReservationTable($this->adate);
		for($i=0; $i < $this->coll ; $i++)
		{
			if(substr($tmp[$i][0],0,5) == $time && $area == $tmp[$i][1])
			{
				$color;
				if($tmp[$i][2] == 1) $color=$this->acolorreserved;
				else if( $tmp[$i][2]==0) $color=$this->acolorreservednotchack;
				return "<td BGCOLOR='".$color."'>".$tmp[$i][3]."</td>\n";
			}

		}
		return null;
	}
	/*
	 *+------+-------------+------------+---------+-------+
	 *| area | Statingtime | Endingtime | cperson | Rstat |
	 *+------+-------------+------------+---------+-------+
	 *| A    | 00:00:00    | 01:00:00   | x       |  NULL |
	 *+------+-------------+------------+---------+-------+
	 */
	public function ShowArea()
	{
	 	$mtable="<table>";
        $mtable.="<tr><td></td><td>A</td><td>B</td></tr>";
	 	echo $_SESSION["areadate"].'<br>';
	   	for($i=0;$i <= 23;$i++)
        {
        	$mtable .= "<tr>\n";
            for($j=0; $j < 3;$j++)
            {
            	$ltime=sprintf("%02d:00",$i);
                switch($j)
                {
                	case 0:
                    	$mtable .= '<td class="area_cool1" BGCOLOR='.$this->acolorc1.'>'.$ltime.'</td>'."\n";
                    break;
                    	case 1:
                    	if(($tmpstr=$this->ChangeColor($ltime, 'A')) != null) $mtable.=$tmpstr;
                    	else $mtable .= '<td class="area" BGCOLOR='.$this->acolorc2c3.'> </td>'."\n";
                    break;
                    case 2:
                    	if(($tmpstr=$this->ChangeColor($ltime, 'B')) != null) $mtable.=$tmpstr;
                    	else $mtable .= '<td class="area" BGCOLOR='.$this->acolorc2c3.'> </td>'."\n";
                    break;
                }
	        }
            $mtable .= "</tr>\n";
		}
        $mtable .= "</table>";
        echo $mtable;
     }
}
?>
