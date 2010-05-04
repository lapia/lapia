<?php
//DA2010-03-21
include_once 'sqlconnect.php';
class UserRecord
{
	public $cperson;
	public $area;
	public $rstat;
	public function UserRecord($cperson,$area,$rstat)
	{
		$this->cperson=$cperson;
		$this->area=$area;
		if($rstat == NULL) $this->rsta=NULL;
		$this->rstat=$rstat;
	}
}

	/*
	 * pending 	 0
	 * authorize 1
	 * deny		 2
	 */

	/*
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*| area | Statingtime | Endingtime | Startingdate | Endingdate | cperson | idAdminuser | Reservecode |
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*| A    | 08:00:00    | 18:00:00   | 2010-03-05   | 2010-03-05 | x       |        NULL | NULL        |
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*/
class DataTable
{
	public  $areaA;
	public  $areaB;
	public  $areaAB;

	public function DataTable($result)
	{
		for($i=0;$i < 24;$i++) $this->areaA[$i]=NULL;
		for($i=0;$i < 24;$i++) $this->areaB[$i]=NULL;
		for($i=0;$i < 24;$i++) $this->areaAB[$i]=NULL;
		$this->CreateTable($result);
	}
	public function CreateTable($result)
	{
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$row;
			if($row['Startingdate']!=$row['Endingdate']) $row['Statingtime']='00';
			$startime=(int)substr($row['Statingtime'],0,2);
			$endtime=(int)substr($row['Endingtime'],0,2);
			for($i=$startime;$i < $endtime;$i++)
			{
					$tmpobject= new UserRecord($row['cperson'],$row['area'],$row['Status']);
					if($row['area'] == 'A')
					{
						if($this->areaA[$i] == NULL) $this->areaA[$i]=array();
						array_push($this->areaA[$i],$tmpobject);
					}
					else if($row['area'] == 'B')
					{
						if($this->areaB[$i] == NULL) $this->areaB[$i]=array();
						array_push($this->areaB[$i],$tmpobject);
					}
					else
					{
						if($this->areaAB[$i] == NULL) $this->areaAB[$i]=array();
						array_push($this->areaAB[$i],$tmpobject);
					}
			}
		}
	}
}
class Area
{
	private $adate;
	private $acoll;
	private $acolorc1;
	private $acolorc2c3;
	private $acolorreservednotchack;
	private $acolorreserved;
	private $dbconnect;
	private $resource;

	public function Area($date/*YYYY-MM-DD*/,$colorc1='c9cfc4',$colorc2c3='86c856',$colorreservednotchack='fbf963',$colorreserved='red')
	{
		$this->dbconnect= new SqlConnect();
        $this->resource= &$this->dbconnect->getResource();
		$this->acolorc1=$colorc1;
		$this->acolorc2c3=$colorc2c3;
		$this->acolorreservednotchack=$colorreservednotchack;
		$this->acolorreserved=$colorreserved;

		if(isset($_POST['changedate'])) $testvalue=$_POST['changedate'];
		else $testvalue=false;

		if($_SESSION["area"]!='set')
		{
			$_SESSION["area"]='set';
			$this->adate=$_SESSION["areadate"]=date("Y-m-d");
			$this->ShowArea();
		}
		else if($testvalue != 'next' && $testvalue != 'last'){

				$_SESSION["areadate"]=$this->adate=$date;
				$this->ShowArea();
		}else{
			$this->adate=$_SESSION["areadate"];
			$this->ShowArea();
		}
	}
	private function getReservationTable($sdate)
	{
	$y=substr($sdate,0,4);
		$m=substr($sdate,5,2);
		$d=substr($sdate,8,2);
		$mkt=mktime(0,0,0,$m,$d,$y);
		$edate=date('Y-m-d',$mkt-24*60*60);
		$query_part2="select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode, r.Status from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '".$edate."' and '".$sdate."' and Endingdate!= '".$edate."'";
		$query_part1="select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode, r.Status from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser and Startingdate between '".$edate."' and '".$sdate."' and Endingdate!= '".$edate."'";
		$query= $query_part1 . " union all " . $query_part2 ." order by Startingdate,Statingtime";
		$result=mysql_query($query,$this->resource);
		//echo "<br> $query<br>";
		$dtable= new DataTable($result);
		$this->dbconnect->disocnnect();
		return  $dtable;
	}

	/*
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*| area | Statingtime | Endingtime | Startingdate | Endingdate | cperson | idAdminuser | Reservecode |
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*| A    | 08:00:00    | 18:00:00   | 2010-03-05   | 2010-03-05 | x       |        NULL | NULL        |
	*+------+-------------+------------+--------------+------------+---------+-------------+-------------+
	*/
	public function ShowArea()
	{

		$dtab= $this->getReservationTable($this->adate);
		$mtable="<table>";
		$mtable.= "<caption>".$this->adate.'</caption>'."\n";
        $mtable.="<tr><td></td><th>A</th><th>B</th></tr>";

	   	for($i=0;$i <= 23;$i++)
        {
        	$mtable .= "<tr>\n";
            for($j=0; $j < 3;$j++)
            {
            	$ltime=sprintf("%02d:00",$i);
                switch($j)
                {
                	case 0:
                    	$mtable .= "<td class='area_cool1' BGCOLOR='$this->acolorc1'>$ltime</td>";
                    break;
                    	case 1:
                    	$mtable.="<td class='area'";
                    	$info;
                    	$a=count($dtab->areaA[$i]);
                    	$ab=count($dtab->areaAB[$i]);
                    	if( ($a > 0) || ($ab >0)){
                    		$objectA= $dtab->areaA[$i];
                    		$objectAB= $dtab->areaAB[$i];
                    		$mtable.=$this->ChangeColor($objectA,$objectAB,$i);
                    	}
                    	else $mtable.=" BGCOLOR='$this->acolorc2c3'>";
                    	$mtable.="</td>";
                   break;
                    case 2:
                    	case 1:
                    	$mtable.="<td class='area'";
                    	$info;
                    	$b=count($dtab->areaB[$i]);
                    	$ab=count($dtab->areaAB[$i]);
                    	if( ($b > 0) || ($ab >0)){
                    		$objectB= $dtab->areaB[$i];
                    		$objectAB= $dtab->areaAB[$i];
                    		$mtable.=$this->ChangeColor($objectB,$objectAB,$i);
                    	}
                    	else $mtable.=" BGCOLOR='$this->acolorc2c3'>";
                    	$mtable.="</td>";
                    break;
                }
	        }
            $mtable .= "</tr>\n";
		}
        $mtable .= "</table>";
        echo $mtable;
     }
     public function ChangeColor($arrobject,$areaABobject,$i)
     {
     	$change=0;
		if($arrobject != null)
	     	foreach ($arrobject as $object)
	     	{
	     		$change=$object->rstat;
	     		if($change == 1) break;
	     	}

	     if(($areaABobject != null) && ($change != 1))
	     {
	     	foreach ($areaABobject as $object)
	     	{
	     		$change=$object->rstat;
	     		if($change == 1) break;
	     	}
	     }
     		if(($change == 0) || ($change == 2)) return " BGCOLOR='$this->acolorreservednotchack'>";
     		else if( $change == 1) return " BGCOLOR='$this->acolorreserved'>";
     }
}
?>
