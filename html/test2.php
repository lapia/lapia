<?php
/*
 *      test2.php
 *
 *      Copyright 2010  <test@dell28>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
?>
<?php session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18.1" />
</head>

<body>

	<?php
		$host="localhost";
		$username="root";
		$password="test1";
		$database="LHR";

		mysql_connect($host, $username, $password);
		@mysql_select_db($database) or die( "Unable to select database");

		$query = "SELECT * FROM registereduser WHERE Contactperson = 'Bogdan'";
		echo $query;`
		$result = mysql_query($query);

		mysql_close();

		$name=mysql_result($result,0,"Contactperson");
		$passwd=mysql_result($result,0,"password");

		$_SESSION["raw"] = mysql_fetch_assoc($result);
		$_SESSION["xxx"] = "xxx";
		//$ud_name=$_POST['name'];
		//$ud_passwd=$_POST['passwd'];

		//mysql_connect($host,$username,$password);
		//@mysql_select_db($database) or die( "Unable to select database");
		//echo "<p>$name, $passwd</p>";
		//$query = "UPDATE registereduser SET Contactperson = '$ud_name', password = '$ud_passwd' WHERE Contactperson = 'Zenon'";

		//mysql_query($query);
		//echo "<p>$name, $passwd</p>";
		//echo "Record Updated";

		//mysql_close();
	?>


</body>
</html>
