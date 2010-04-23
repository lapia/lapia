<?php
include 'sendmesage.php';
class ReservationRuser
{
        private $y;
        private $m;
        private $d;
        private $key;
        private $dbconn;
        public function ReservationRuser()
        {

        		$this->dbconn = new SqlConnect("localhost","root","test1","LHR");
				$this->dbconn->connectToDb();

                $this->ExplodeDate($_SESSION['areadate']);
                $this->AddReservation();
        }
        private function ExplodeDate($date)
        {
                $this->y=substr($date,0,4);
                $this->m=substr($date,5,2);
                $this->d=substr($date,8,2);
        }
        private function AddReservation()
        {


                $area=$area_b="";
        		$gkey=new GenKey($_SESSION['username'],'Reservation','Reservecode',6);
                $this->key=$gkey->GetCode();
                $tstemp=$gkey->GetTimestemp();
                $date_start_time=mktime($_SESSION['areatime'], 0, 0,$this->m, $this->d, $this->y);
                $date_finish_time=$date_start_time+(($_SESSION['areaduration'])*60*60);
                $ds=date('Y-m-d',$date_start_time);
                $df=date('Y-m-d',$date_finish_time);
                $ts=date('H:i',$date_start_time);
                $tf=date('H:i',$date_finish_time);
                if($_SESSION['areaarea'] == 'A&B')
                {
                	$area='A';
                	$area_b='B';
                }
                else $area=$_SESSION['areaarea'];

                $resource=&$this->dbconn->getResource();

                $subquery="(select idRegistereduser from registereduser where RegisteredEmailaddress='".$_SESSION['username']."')";
                $query="insert into Reservation( Reservecode,idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$this->key."',".$subquery.",'".$area."','$ts','$tf','$ds','$df','$tstemp')";
        		//echo $query;
        		mysql_query($query,$resource);
        		if($area_b == 'B'){
        			$query="insert into Reservation( Reservecode,idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$this->key."',".$subquery.",'".$area_b."','$ts','$tf','$ds','$df','$tstemp')";
        			mysql_query($query,$resource);
        		}
           //    echo '<br> rezerwacja <br> :' . $query . mysql_error();


				$this->dbconn->disocnnect();


                $html = '<html><body><img src="rumianek.jpg"> <p>wlasnie skoncylem pisac klase do mailingu :).</p><br><img src="software-update-300x300.jpg"><br><p>another image</p></body></html>';
                $imagegroup=array('software-update-300x300.jpg','rumianek.jpg',);
                $smail = new SendMail();
                $smail->SetRecipients($_SESSION['username']);
             	$smail->SetHtmlMesage($html);
                $smail->SetGroupImages($imagegroup);
                $smail->SetSubject('Lapiahally');
                $smail->SendMesage();

        }

}
?>
