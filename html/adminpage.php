
<?php
/*
database connectioin
$sql="select * from time_table where time_id = '$need'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
if(isset($row["status"]) && $row["status"]=='authorized')
{
$sql2="update time_table set status = 'unauthorized'where time_id = '$need'";
mysql_query($sql2) or die("<script>window.alert('failed');window.history.back();</script>");
  die("<script>window.alert('you had made reservation successfully');window.location.href='config.php';</script>");
}
if(isset($row["status"]) && $row["status"]=='unauthorized')
{
$sql2="update time_table set status = 'authorized'where time_id = '$need'";
mysql_query($sql2) or die("<script>window.alert('failed');window.history.back();</script>");
  die("<script>window.alert('you had change status successfully');window.location.href='config.php';</script>");
}

if(isset($_GET['act']) && $_GET['act']=='select')
{

$exec="select * from time_table where status = '$select2'";
				//$exec="select * from time table where service_id='$id'";
				$result3=mysql_query($exec);


}
else
{

		$exec="select * from time_table ";
				//$exec="select * from time table where service_id='$id'";
				$result3=mysql_query($exec);

}

*/
$servername='localhost'; //address and name of the server (ip + name)
$database='LHR'; //name of the database in the server
$db_username='root'; //username that has access to database
$db_password='test1'; //password of the user
$connect=mysql_connect($servername,$db_username,$db_password) or die('No connection to the server');
mysql_select_db($database,$connect) or die('Database not available');
 $select=$_POST['select'];
  $id=$_POST['id'];

if(isset($_POST['select']))
{

$sql2="update time_table set status = '$select'where time_id = '$id'";
mysql_query($sql2) or die("<script>window.alert('failed');window.history.back();</script>");


}






if(isset($_GET['act']) && $_GET['act']=='date' && $_POST['select2'] != "all")
{
$date=$_POST['date'];
$date2=$_POST['date2'];
$select2=$_POST['select2'];

$sql3="select * from time_table where date >= '$date' && date <= '$date2' && status = '$select2'";
$result3=mysql_query($sql3);
}


elseif(isset($_GET['act']) && $_GET['act']=='date' && $_POST['select2'] == "all")
{
$date=$_POST['date'];
$date2=$_POST['date2'];
		$sql3="select * from time_table where date >= '$date' && date <= '$date2' ";
$result3=mysql_query($sql3);

}
else
{
$exec="select * from time_table ";
				//$exec="select * from time table where service_id='$id'";
				$result3=mysql_query($exec);
}


?>

<html >

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
  <title>administration</title>
<style type="text/css">
<!--
body {
 font-size: 12px;
filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=1, EndColorStr='#6699cc', StartColorStr='#ffffff');

 height: 100%;
 margin-left: 0px;
 margin-top: 0px;
margin-right: 0px;
 margin-bottom: 0px;
}
 -->
</style>
</head>
<b><font face="Times New Roman"><b><h1>Please change your password:</h1></b></font></b>

<body>

<?php





	?>

<table border='1'>
<form action="?act=date" method="post" name="login">
<tr>

<th><input name="date" type="text" class="loginput" id="email" value="Plase Enter Start Date" /></th>
<th>to</th>
<th><input name="date2" type="text" class="loginput" id="email" value="Plase Enter End Date" /></th>
<th>yyyy-mm-dd</th>
<th></th>
<th>Only show£º</th>

<th></th>




    <td height="0"><label>
      <select name="select2"><option>all</option><option value="authorized">authorized</option><option>pending</option><option>denied</option></select>

	</label>
	</td>

<th><input name="Submit" type="submit" class="botton" value="Search" /></th>
</tr>
<tr>
<th>Order ID</th>
<th>date</th>
<th>time</th>
<th>name</th>
<th>end time</th>
<th>email</th>
<th>authcode</th>
<th>status</th>
<th>change status</th>

</form>
</tr>";
<?php
while($row = mysql_fetch_array($result3))
  {
  echo "<tr>";
  echo "<td>" . $row['time_id'] . "</td>";
  $id = $row['time_id'];
  echo "<td>" . $row['date'] . "</td>";
  echo "<td>" . $row['time'] . "</td>";
   echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['date2'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['authcode'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";

 ?>
<form action="config.php" method="post" name="list">



    <td height="0"><label>
      <select name="select"><option value="authorized">authorized</option><option>pending</option><option>denied</option></select>
	  <input name="id" type="hidden" class="botton" value="<?php echo $id;?>" />
	  <input name="Submit" type="submit" class="botton" value="submit" />


    </label></td>
 </form>

<?php


  echo "</tr>";
  }
echo "</table>";

?>

</body>

</html>
