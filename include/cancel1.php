<?php
include 'sendmesage.php';

class email
{

        public function email()
        {

               if(isset($_POST['inemail']))
               {


                        if($this->cHackemail() == true )
                        {
                                $d="";
                                for($i=strlen($_POST["code"]);$i > 0;$i--) $d=$d.'x';

                                $this->ShowCancel($_POST["email"],$d);
                                $_SESSION["login"]="true";
                                $_SESSION["emailcode"]=$d;

																$_SESSION["emailemail"]=$_POST["email"];
																$_SESSION["cancel_code"]=$_POST["code"];


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
		 	$l=$this->sprawdz();
			if(isset($_POST['cancel']))
			{

								if($l){
								$pas=htmlspecialchars($_POST["code"]);
								echo "<font color='green'>Your reservation was removed<br></font>";
								$query= "DELETE FROM LHR.Reservation WHERE idReservation ='".$pas."'";
								mysql_query($query);
								$html = '<html><body><p><h1>You\'re reservation has been canceled.</h1></p><p>If you have not authorised this cancellation, please contact the lappihalli@gmail.com or visit www.lapia.fi.</p></body></html>';
								$smail = new SendMail();
								$smail->SetRecipients($_SESSION["emailemail"]);
								$smail->SetHtmlMesage($html);
								$smail->SetSubject('Lapiahally');
								$smail->SendMesage();
											}
								else echo "<font color='red'><br>
								It's to late to cancel reservation.<br>
								Please contact with administrator.</font>";

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
			$query  = "SELECT RegisteredEmailaddress from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.Reservecode='".$pas."' ;";
			$result = mysql_query($query) or dir(mysql_error());
			$query1  = "SELECT Statingtime from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result1 = mysql_query($query1);
			//$query2  = "select subtime(Endingtime,Statingtime) from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.Reservecode='".$pas."';";
			//$result2 = mysql_query($query2);
			$query3 = "SELECT area from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result3 = mysql_query($query3);
			$query4  = "SELECT Reservecode from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.Reservecode='".$pas."';";
			$result4 = mysql_query($query4);
			$query5="SELECT Endingtime from LHR.registereduser RU, LHR.Reservation R where RU.idRegistereduser=R.idRegistereduser and R.reservecode='".$pas."';";
			$result5=mysql_query($query5);

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
			while($row = mysql_fetch_row($result5))
			{
				$RTime= $row[0];
				echo "Ending time:<label>$RTime</label> <br>";
			}
			echo "Duration:". "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$this->dur();
			echo "<br>";


			while($row = mysql_fetch_row($result3))
			{
				$Ares= $row[0];
				echo "Area :<label>$Ares</label> <br>";
			}


						echo "<form action='".$_SERVER['PHP_SELF']."' method=post>";
						$login=htmlspecialchars($_POST["email"]);
						$passw=htmlspecialchars($_POST["code"]);
						$query5="SELECT idReservation from LHR.Reservation R, LHR.registereduser RU where RU.RegisteredEmailaddress='".$login."' and R.Reservecode='".$passw."';";
						$result5=mysql_query($query5);
						$rec= mysql_fetch_assoc($result5);

						echo "<input type=hidden name=code value='".$rec['idReservation']."' />";
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
                $query="SELECT idReservation from LHR.Reservation R, LHR.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";

                $result=mysql_query($query);
                if(mysql_num_rows($result)){
                        $row = mysql_fetch_assoc($result);
                        $_SESSION['userid']=$row['idcancel'];
                        return true;
                }
                else  $_SESSION['userid']=0; //user not email
                return false;
        }

				public function dur()
				{
				$log=htmlspecialchars($_POST["email"]);
				$pass=htmlspecialchars($_POST["code"]);

				$query10="SELECT Statingtime from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";
										$result10=mysql_query($query10);
										$rec10= mysql_fetch_assoc($result10);


										$sthour=substr($rec10['Statingtime'],0,2);
										$stmin=substr($rec10['Statingtime'],3,2);
									  $stsec=substr($rec10['Statingtime'],6,2);

										$query12="SELECT Endingtime from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";
										$result12=mysql_query($query12);
										$rec12= mysql_fetch_assoc($result12);


										$ethour=substr($rec12['Endingtime'],0,2);
										$etmin=substr( $rec12['Endingtime'],3,2);
									  $etsec=substr( $rec12['Endingtime'],6,2);


										$query11="SELECT Startingdate from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";

										$result11=mysql_query($query11);
										$rec11= mysql_fetch_assoc($result11);

										//$sdyear=substr($rec11['Startingdate'],0,4);
										//$sdmonth=substr($rec11['Startingdate'],5,2);
										$sdday=substr($rec11['Startingdate'],8,2);

										$query13="SELECT Endingdate from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";

										$result13=mysql_query($query13);
										$rec13= mysql_fetch_assoc($result13);

										//$edyear=substr($rec13['Endingdate'],0,4);
										//$edmonth=substr($rec13['Endingdate'],5,2);
										$edday=substr($rec13['Endingdate'],8,2);

										if($ethour==$sthour)
										$liczgodz=(($ethour+($edday-$sdday)*24)-$sthour);
										else
										$liczgodz=(($ethour+($edday-$sdday)*24)-$sthour)-1;
										$liczmin=(($etmin+($ethour-$sthour)*60)-$stmin)%60;
										$liczsek=(($etsec+($etmin-$stmin)*60)-$stsec)%60;
										if($liczsek<0)
										{
											$liczsek=60+$liczsek;
										}
										$godzmod=$liczgodz;
										$minmod=$liczmin;
										$sekmod=$liczsek;

										if ($liczgodz<10){
										$godzmod="0".$liczgodz;
										}

										if ($liczmin<10){
										$minmod="0".$liczmin;
										}

										if ($liczsek<10){
										$sekmod="0".$liczsek;
										}
										echo $godzmod.":". $minmod.":". $sekmod;


				}
				public function sprawdz ()

				{
				//prefix r- retur date from db
				//prefix t- retur substruct date
				//prefix (null)- retur actual date

										$log= $_SESSION["emailemail"];
										$pass=$_SESSION["cancel_code"];


										$data= getdate(time());
										$sec=  $data['seconds'];
										$min= $data['minutes'];
										$hour= $data['hours'];

										$day=  $data['mday'];
										$month=  $data['mon'];
										$year= $data['year'];

										$query6="SELECT Statingtime from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";
										$result6=mysql_query($query6);
										$rec6= mysql_fetch_assoc($result6);


										$rhour=substr($rec6['Statingtime'],0,2);
										$rmin=substr($rec6['Statingtime'],3,2);
										$rsec=substr($rec6['Statingtime'],6,2);

										$query7="SELECT Startingdate from lhr.reservation R, lhr.registereduser RU where RU.RegisteredEmailaddress='".$log."' and R.Reservecode='".$pass."';";

										$result7=mysql_query($query7);
										$rec7= mysql_fetch_assoc($result7);

										$ryear=substr($rec7['Startingdate'],0,4);
										$rmonth=substr($rec7['Startingdate'],5,2);
										$rday=substr($rec7['Startingdate'],8,2);


										$tyear= $ryear - $year;
										$tmonth= $rmonth - $month;
										$tday= $rday - $day;

										$thour=$rhour - $hour;
										$tmin=$rmin - $min;
										$sec=$rsec - $sec;
										if ($tyear > 0)
										{
											return 1;
										}
										else if ($tyear==0)
										{
											if ($tmonth > 0)
											{
											return 1;
											}
											else if ($tmonth == 0)
											{
												if ($tday > 1)
												{
												return 1;
												}
												else if($tday == 1 )
												{
													if($thour > 0)
													{
													return 1;
													}
													else if ($thour==0)
													{
														if ($tmin>0)
														{
														return 1;
														}
														else if ($tmin==0)
														  {
															if ($tsec >= 0)
														   {
															return 1;
														   }else return 0;

														  }else return 0;


													}else return 0;

												}else return 0;




											}else return 0;

										}else return 0;
				}



}




?>
