<?php
include '../include/sendmesage.php';

class cancel1
{

        public function cancel1()
        {

               if(isset($_POST['inemail']))
               {
                        if($this->cHackemail() == true )
                        {
                                $d="";
                                for($i=strlen($_POST["code"]);$i > 0;$i--) $d=$d.'x';
                                $this->ShowCancel($_POST["email"],$d);
                                $_SESSION["login"]="true";
                                $_SESSION["emailemail"]=$_POST["email"];
                                $_SESSION["emailcode"]=$d;

                        }else $_SESSION["login"]= 'false';
                }

                        if($_SESSION["login"] == 'false') $this->ShowWrong($_SESSION["emailemail"],$_SESSION["emailcode"]);
                        else if(isset($_POST['inemail']))
                        {
						}
                        else
                        {
                                $this->Showemail($_SESSION["emailemail"],$_SESSION["emailcode"]);

						}

        }
		public function cancel()
		{
			if(isset($_POST['cancel']))
			{
								echo "<font color='green'>You reservation was removed.</font>";
								$pas=htmlspecialchars($_POST["code"]);
								$query= "DELETE FROM LHR.reservation WHERE idReservation ='".$pas."'";
								mysql_query($query);
								$html = '<html><body><p>wlasnie skoncylem pisac klase do mailingu :).</p><p>another image</p></body></html>';
                $smail = new SendMail();
                $smail->SetRecipients($_SESSION['emailemail']);
             	$smail->SetHtmlMesage($html);
                $smail->SetSubject('Lapiahally');
            $smail->SendMesage();
			}

		}
        public function ShowWrong($r="",$d="")
        {


                echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
                echo "<font color='red'><center>Please enter valid<br>E-Mail and Reg Code.</center></font><br>";
                echo "Email:<br> <input type=text name=email value='".$r."'><br>";
                echo "Code:<br> <input type=password name=code value='".$d."'><br>";
                echo "<input type=submit name='inemail' value='Submit!'>";
                echo "</form>";

        }
        public function ShowCancel($r="",$d="")
        {
			$pas=htmlspecialchars($_POST["code"]);
			$query  = "SELECT RegisteredEmailaddress from LHR.registereduser RU, LHR.reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."' ;";
			$result = mysql_query($query) or dir(mysql_error());
			$query1  = "SELECT Statingtime from LHR.registereduser RU, LHR.reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result1 = mysql_query($query1);
			$query2  = "select subtime(Endingtime,Statingtime) from LHR.registereduser RU, LHR.reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result2 = mysql_query($query2);
			$query3 = "SELECT area from LHR.registereduser RU, LHR.reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result3 = mysql_query($query3);
			$query4  = "SELECT Reservecode from LHR.registereduser RU, LHR.reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result4 = mysql_query($query4);

			while($row = mysql_fetch_row($result4))
			{
				$RCode= $row[0];
				echo "Reservation Code:<label>$RCode</label> <br>";
			}
			while($row = mysql_fetch_row($result))
			{
				$Email= $row[0];
				echo "Email:<label>$Email</label> <br>";
			}
			while($row = mysql_fetch_row($result1))
			{
				$STime= $row[0];
				echo "Start time:<label>$STime</label> <br>";
			}
			while($row = mysql_fetch_row($result2))
			{
				$Dur= $row[0];
				echo "Duration:<label>$Dur</label> <br>";
			}
			while($row = mysql_fetch_row($result3))
			{
				$Ares= $row[0];
				echo "Area :<label>$Ares</label> <br>";
			}

						echo	"<form action='".$_SERVER['PHP_SELF']."' method=post>";
						$login=htmlspecialchars($_POST["email"]);
						$pass1=htmlspecialchars($_POST["code"]);
						$query5="SELECT idReservation from LHR.reservation R, LHR.registereduser RU where RU.RegisteredEmailaddress='".$login."' and R.Reservecode='".$pass1."';";
						$result5=mysql_query($query5);
						$rec= mysql_fetch_assoc($result5);

						echo "<input type=hidden name=code value='".$splaszczenie['idReservation']."' />";
						echo "<center><input type=submit name=cancel value=Cancel reservation!></center>";
            echo "</form>";

        }
        public function Showemail($r="",$d="")
        {


                echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
                echo "Email:<br> <input type=text name=email value='".$r."'><br>";
                echo "Code:<br> <input type=password name=code value='".$d."'><br>";
                echo "<input type=submit name='inemail' value='Submit!'>";
                echo "</form>";

        }
        public function cHackemail()
        {
                $log=htmlspecialchars($_POST["email"]);
                $pass=htmlspecialchars($_POST["code"]);
                $query="SELECT idReservation from LHR.reservation R, LHR.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";

                $result=mysql_query($query);
                if(mysql_num_rows($result)){
                        $row = mysql_fetch_assoc($result);
                        $_SESSION['userid']=$row['idcancel'];
                        return true;
                }
                else  $_SESSION['userid']=0; //user not email
                return false;
        }
}
?>
