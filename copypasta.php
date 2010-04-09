<?php session_start();?>

<html>
<head>
<title>NULL COPYPASTA!</title>

</head>
<body>

	<div id="login_bar">
		<form action="copypastalogin.php" method="post">
			<p><label for="username">E-mail:</label> <input type="text" id="username" name="username"/></p>
			<p><label for="password">Password:</label> <input type="password" id="password" name="password" /></p>
			<p class="submit"><input type="submit" name="submit" value="Login" /></p>
		</form>
		<div id="pass_reg">
			<a href="html/lost_password.php">Lost Password?</a>
			<a href="html/register_second.php">Register</a>
		</div>
	</div>

	<div id="register_form">
		<?php
			$con = mysql_connect("localhost","root","test1");
			if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}

			mysql_select_db("LHR", $con);

			$sql="SELECT * FROM registereduser WHERE RegisteredEmailaddress = '".$_SESSION['username']."' ";
			//echo $sql;
			$result=mysql_query($sql);
			$row1 = mysql_fetch_assoc($result);
			$_SESSION['row1'] = $row1;
		?>
	<form action="edit.php" onsubmit="return validate_form(this)" enctype="multipart/form-data" method="post">
		<div id="alert">
			<p><?php if(isset($_SESSION['already_err'])){ ?><?php echo $_SESSION['already_err']; unset($_SESSION['already_err']);?><?php }?></p>
			<p><?php if(isset($_SESSION['success'])){ ?><?php echo $_SESSION['success']; unset($_SESSION['success']);?><?php }?><p>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<fieldset>
			<br/>
			<fieldset>
				<legend>Login Information:</legend>
				E-mail:
				<br>
				<input name="email" type="text" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["RegisteredEmailaddress"] ?>">
				<br>
				Password:
				<br>
				<input name="password" type="password"size="40" value="<?$row1= $_SESSION["row1"]; print $row1["password"] ?>">
				<br>
				Repeat Password:
				<br>
				<input name="password2" type="password" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["password"] ?>">
			</fieldset>
			<br>
			<fieldset>
				<legend>Contact Information</legend>
				Name of Organisation:
				<br>
				<input name="name_of_organisation" type="text" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["Organizationname"] ?>">
				<br>
				Contact Person:
				<br>
				<input name="contact_person" type="text" size="40" value="<?  $row1= $_SESSION["row1"]; print $row1["Contactperson"] ?>">
				<br>
				Address:
				<br>
				<input name="Address" type="text" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["Address"] ?>">
				<br>
				Phone:
				<br>
				<input name="Phone" type="text" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["phone"] ?>">
				<br>
			</fieldset>
			<br>
			<input type="submit" name="register" value="Register" id="submit">
			<input type="reset" value="Reset" name= "reset"/>
		</fieldset>
		</form>
	</div>
</body>
</html>
