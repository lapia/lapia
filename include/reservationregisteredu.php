<?php
//include 'include/sendmesage.php';
class ReservationRuser
{
        private $y;
        private $m;
        private $d;
        private $key;
        private $reservation;
        private $dbconnect;
		private $resource;
        public function ReservationRuser()
        {
                $this->dbconnect= new SqlConnect();
				$this->resource = &$this->dbconnect->getResource();
        		
				$this->InitComponenet();
                $this->AddReservation();
        }
        private function InitComponenet()
        {
        	//$reservation=array('date' => $_SESSION['areadate'], 'time' => $_SESSION['areatime'],'duration' => $_SESSION['areaduration'],'area'=>$_SESSION['areaarea']);
        	$this->reservation=$_SESSION['reservation']; 
        	$this->ExplodeDate($this->reservation['date']);
        }
        private function ExplodeDate($date)
        {
                $this->y=substr($date,0,4);
                $this->m=substr($date,5,2);
                $this->d=substr($date,8,2);
        }
        private function AddReservation()
        {
                $area;
        		$gkey=new GenKey($_SESSION['username'],'Reservation','Reservecode',6);
                $this->key=$gkey->GetCode();
                $tstemp=$gkey->GetTimestemp();
                $date_start_time=mktime($this->reservation['time'], 0, 0,$this->m, $this->d, $this->y);
                $date_finish_time=$date_start_time+(($this->reservation['duration'])*60*60);
                $ds=date('Y-m-d',$date_start_time);
                $df=date('Y-m-d',$date_finish_time);
                $ts=date('H:i',$date_start_time);
                $tf=date('H:i',$date_finish_time);
               
                $area=$this->reservation['area'];
                
                $subquery="(select idRegistereduser from registereduser where RegisteredEmailaddress='".$_SESSION['username']."')";
                $query="insert into Reservation( Reservecode,idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$this->key."',".$subquery.",'".$area."','$ts','$tf','$ds','$df','$tstemp')";
        	//	echo $query;
        		mysql_query($query,$this->resource);
        		$this->dbconnect->disocnnect();
           //    echo '<br> rezerwacja <br> :' . $query . mysql_error();
            /*   
                $html = '<html><body><img src="rumianek.jpg"> <p>wlasnie skoncylem pisac klase do mailingu :).</p><br><img src="software-update-300x300.jpg"><br><p>another image</p></body></html>';
                $imagegroup=array('software-update-300x300.jpg','rumianek.jpg',);
                $smail = new SendMail();
                $smail->SetRecipients($_SESSION['username']);
             	$smail->SetHtmlMesage($html);
                $smail->SetGroupImages($imagegroup);
                $smail->SetSubject('Lapiahally');
                $smail->SendMesage(); */
        	
        }
       
}
?>