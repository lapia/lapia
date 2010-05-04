<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
body
{
	position: absolute;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
	width: 100%;
}
div.header {
	position:relative;
	margin:0 0 0 0;
	padding-top: 2%;
	padding-bottom: 2%;
	margin-bottom: 5px;
	background-image: url("baner.jpg");
	background-attachment: fixed;
  	background-position: 99% 99%;
}
div.header span
{
	position: relative;
	margin: 0 0 0 0;
	left:28%;
	color: #12b152;
	font-size: 24pt;
	text-align: center;
}
div.link
{
	position: absolute;
	top: 77px;
	height: 12px;
	padding: 2px 2px 2px 2xp;
	margin: 0 0 0 0;
	margin-left: 20px;
	width: 97%;
	font-size: x-small;
	font-weight: bold;
	background-color: #daead0;
}
.feuser,.fereservation
{
	background-color: white;

}
.flogout
{
	position: relative;
	left: 80%;
	background-color: white;
}
div.link a
{
	color: #12b152;
	margin-left: 5px;
	text-decoration: none;
	font-family: "Arial";
	font-style: italic;
}
div.link a.focus
{
	color: white;
	margin-left: 5px;
	text-decoration: none;
	font-family: "Arial";
	font-style: italic;
}
div.link a.euser{
	margin-left: 10px;
}
div.link a.logout
{
	left: 80%;
	position: relative;
}
div.adminform, div.edituser
{
	position:relative;
	float:none;
	background-color: white;
	margin: 0 0 0 0;
	margin-bottom:20px;
	margin-left:10px;
	padding: 0 0 0 0;
}
div.adminform
{
	width: 74%;
	font-family: "Arial";
	font-size: 8pt;
}
div.Search{
	position: fixed ;
	top: 270px;
	left:76%;
	width: 16,5%;
	background-color: #c5efbb;
	padding: 10px 10px 10px 10px;
}
div.theader
{
	margin:0 0 0 0;
	padding: 0 0 0 0;
	background-color: #c5efbb;
	float: none;
	border: solid 1px;
	border-color:  white;
	font-style: italic;
}
.bcolor
{
	margin: 0 0 0 0;
	width: 100%;
	float: none;
}
.color {
	width:100%;
	background-color: #c5efbb;
	margin: 0 0 0 0;
	width: 100%;
	float: none;
}
.ID,.SECTION,.DATE,.NAME,.TIME,.ENDTIME,.EMAIL,.AUTHCODE,.STAT,.CHSTAT,.UPDATE{
	background-color: inherit;
	float: left;
	border: none;
	height: 27px;
	text-align: center;
	border-bottom: solid 1px #c5efbb;
	text-align: center;
	font-family: "Arial";
	font-size: small;
}
div.UPDATE button{

}
.ID{
	width: 7%;
	border-left: solid 1px #c5efbb;
}
.SECTION{
	width: 8%;
}
.DATE {
	width: 10%;
}
.TIME,.ENDTIME {
	width: 9%;
}
.NAME,.EMAIL
{
	width: 11%;
}
.AUTHCODE {
	width: 7%;
}
.STAT{
	width: 8%;
}
div.CHSTAT select{
}
.CHSTAT{
	padding-left:1px;
	padding-right:1px;
	width: 10%;
}
div.UPDATE button{
	margin: 1px 1px 1px 1px;
}
.UPDATE{
	padding: 0 0 0 0;
	width: 9%;
	border-right: solid 1px #c5efbb;
}
div.calendar {
	position: fixed;
	top: 93px;
	left:76%;
	background-color: #c5efbb;
	max-height: 200px;
	max-width: 350px;
}
div.calendar .cdate
{
	padding-left: 61px;
	padding-right: 62px;

}
div.edituser{
	position: relative;
	font-family: "Arial";
	font-size: small;

}
div.edituser table
{
	border: solid 1px #c5efbb;
	margin-bottom: 5px;
}
.ttheader{
	background-color: #c5efbb;
}
div.edituser th
{
	font-weight: normal;
	font-style: italic;
}
div.edituser td,th
{
	padding-left: 5px;
	padding-right: 5px;
}
.tbcolor
{

}
.tcolor,.esingleuser{
	background-color: #c5efbb;
}
.esingleuser{
	margin-top: 3px;
	margin-bottom: 3px;
	font-family: "Arial";
	font-size: small;
	font-style: italic;
}
div.Footer{
	position: relative;
	top: 1px;
	width: 99%;
	margin-left:5px;
	margin-bottom:20px;
	font-family:monospace;
	font-size: xx-small;
	border: 1px solid #c5efbb;
	color: #c5efbb;
}
</style>
<title>Insert title here</title>
</head>
<body>
<?php
	include_once 'ad.php';
	include_once 'calendar.php';
	include_once 'edutuser.php';
	$_SESSION['SQLSETTINGS']=array('host'=>'localhost','user'=>'root','password'=>'test1','dbname'=>'LHR');
?>
<div class="header">
	<span><em>Lappia Halli Admin Panel</em></span>
</div>
<div class="link">
<?php

		if(($_GET['action'] == 'euser') || isset($_POST['euser']) || isset($_POST['callendar'])){
			$link="<a href=\"".$_SERVER['PHP_SELF']."?action=euser\" class=\"feuser\">Edit User</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=ereservation\">Edit Reservation</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=logout\" class=\"logout\" >Logout</a>";
		}
		else if(($_GET['action'] == 'ereservation') || isset($_POST['admp'])){
			$link="<a href=\"".$_SERVER['PHP_SELF']."?action=euser\" class=\"euser\">Edit User</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=ereservation\" class=\"fereservation\">Edit Reservation</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=logout\" class=\"logout\" >Logout</a>";
		}
		else if($_GET['action'] == 'logout'){
			$link="<a href=\"".$_SERVER['PHP_SELF']."?action=euser\" class=\"euser\">Edit User</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=ereservation\">Edit Reservation</a>";
			$link.="<a href=\"".$_SERVER['PHP_SELF']."?action=logout\" class=\"flogout\" >Logout</a>";
		}

	echo $link;
	?>
</div>
<?php

	if(($_GET['action'] == 'ereservation') || (isset($_POST['admp']) == TRUE) || (isset($_POST['callendar']) == true))
	{
		$cal=new Calendar();

		$adm=new AdminForm();
		$adm->SetDate($_POST['date']);

		echo "<div class=\"adminform\">";
		$adm->ShowFrom();
		echo "</div>";
		echo "<div class=\"calendar\">";
	 	$cal->sHowCalendar();
	 	echo "</div>";

	}
	else if(($_GET['action'] == 'euser') || isset($_POST['euser']))
	{
		echo "<div class=\"edituser\">";
		$eu = new EditUsers();
		echo "</div>";

		$footer= "<div class=\"Footer\">";
		$footer.= "<center>powered by PP-2010</center>";
		$footer.= "</div>";
		//echo $footer;
	}else if(($_GET['action'] == 'logout') )
	{
		session_destroy();
		echo "xYou are logout";
	}
	else echo "You are logout";
?>
</body>
</html>
<?php

	echo '<br>';
	$a=1; $b=0; $x=10;
	if((($a == 1) || ($b == 7)) && ($x==10))
	{
		echo 'all is ok<br>';
	}
	if((($a == 1) || ($b == 7)) && ($x!=10))
	{
		echo 'x!=10 <br>';
	}
?>

