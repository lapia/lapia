<?php
class ReservationRuser
{
        private $y;
        private $m;
        private $d;
        public function ReservationRuser()
        {
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
                $gkey=new GenKey($_SESSION['Loginlogin'],'Reservation','Reservecode');
                $key=$gkey->GetCode();
                $tstemp=$gkey->GetTimestemp();
                $date_start_time=mktime($_SESSION['areatime'], 0, 0,$this->m, $this->d, $this->y);
                $date_finish_time=$date_start_time+(($_SESSION['areaduration'])*60*60);
                $ds=date('Y-m-d',$date_start_time);
                $df=date('Y-m-d',$date_finish_time);
                $ts=date('H:i',$date_start_time);
                $tf=date('H:i',$date_finish_time);
                $query="insert into Reservation( idRegistereduser,area,Statingtime,Endingtime,Startingdate,Endingdate,TimeStemp) values('".$_SESSION['userid']."','".$_SESSION['areaarea']."','$ts','$tf','$ds','$df','$tstemp')";
        echo $query;
        mysql_query($query);
                echo '<br> rezerwacja <br> :' . $query . mysql_error();
        }
}
?>