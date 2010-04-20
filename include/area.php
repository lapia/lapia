<?php
//DA2010-03-21

class UserRecord
{
	public $cperson;
	public $area;
	public $rstat;
	public function UserRecord($cperson,$area,$rstat=0)
	{
		$this->cperson=$cperson;
		$this->area=$area;
		if($rstat == NULL) $this->rsta=NULL;
		$this->rstat=$rstat;
	}
}
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
public function DataTable($result)
	{
		for($i=0;$i < 24;$i++) $this->areaA[$i]=NULL;
		for($i=0;$i < 24;$i++) $this->areaB[$i]=NULL;
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
					$rstat=0;
					if($row['idAdminuser'] != NULL) $rstat=1;
					$tmpobject= new UserRecord($row['cperson'],$row['area'],$rstat);
					if($row['area'] == 'A')
					{
						if($this->areaA[$i] == NULL) $this->areaA[$i]=array();
						array_push($this->areaA[$i],$tmpobject);
					}
					else
					{
						if($this->areaB[$i] == NULL) $this->areaB[$i]=array();
						array_push($this->areaB[$i],$tmpobject);
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
	private $dbconn;
	public function Area($date/*YYYY-MM-DD*/,$colorc1='c9cfc4',$colorc2c3='86c856',$colorreservednotchack='fbf963',$colorreserved='red')
	{

		$this->dbconn = new SqlConnect("localhost","root","test1","LHR");
		$this->dbconn->connectToDb();

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
	private function getReservationTable($sdate)
	{
	$y=substr($sdate,0,4);
		$m=substr($sdate,5,2);
		$d=substr($sdate,8,2);
		$mkt=mktime(0,0,0,$m,$d,$y);
		$edate=date('Y-m-d',$mkt-24*60*60);
		$query_part2="select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,nru.Contactperson cperson, r.idAdminuser,r.Reservecode from Reservation r ,Unregistereduser nru where r.idUnregistereduser=nru.idUnregistereduser and Startingdate between '".$edate."' and '".$sdate."' and Endingdate!= '".$edate."'";
		$query_part1="select r.area, r.Statingtime, r.Endingtime,r.Startingdate,r.Endingdate,ru.Contactperson cperson,r.idAdminuser,r.Reservecode from Reservation r ,registereduser ru where r.idRegistereduser=ru.idRegistereduser and Startingdate between '".$edate."' and '".$sdate."' and Endingdate!= '".$edate."'";
		$query= $query_part1 . " union all " . $query_part2 ." order by Startingdate,Statingtime";
		$resource=&$this->dbconn->getResource();
		$result=mysql_query($query,$resource);
	//	echo "<br> AREA query<br> $query<br>".mysql_errno();
		$dtable= new DataTable($result);
		mysql_free_result($result);
		$this->dbconn->disocnnect();
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
                    	$c=count($dtab->areaA[$i]);
                    	if( $c > 0 ){
                    		$object= $dtab->areaA[$i];
                    		if( $c == 1 ) $mtable.=$this->ChangeColor($object[0]->rstat);
                    		else{
                    			$setcolor=0;
                   				for($x=0;$x < count($object);$x++) if($object[$x]->rstat == 1) $setcolor=$object[$x]->rstat;
                    			$mtable.=$this->ChangeColor($setcolor);
                    		}
                    	}
                    	else $mtable.=" BGCOLOR='$this->acolorc2c3'>";
                    	$mtable.="</td>";
                   break;
                    case 2:
                    	$mtable.="<td class='area'";
                    	$info;
                    	$c=count($dtab->areaB[$i]);
                    	if( $c > 0 ){
                    		$object= $dtab->areaB[$i];
                    		if( $c == 1 ) $mtable.=$this->ChangeColor($object[0]->rstat);
                    		else{
                    			$setcolor=0;
                   				for($x=0;$x < count($object);$x++) if($object[$x]->rstat == 1) $setcolor=$object[$x]->rstat;
                    			$mtable.=$this->ChangeColor($setcolor);
                    		}
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
     public function ChangeColor($change)
     {
     	if($change == 0) return " BGCOLOR='$this->acolorreservednotchack'>";
     	return " BGCOLOR='$this->acolorreserved'>" .$info;
     }
}
?>
