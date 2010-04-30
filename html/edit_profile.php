<?php  session_start(); ?>

<html>
<head>
	<title>Lappia Halli - Edit Profile</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
	<link rel="stylesheet" href="../css/css.css" type="text/css">
	<script type="text/javascript" src="form_validation.js"></script>
</head>

<body>

	<div id="tlo">
	</div>

	<div id="strona">

		<div id="gora_pasek">
			<div id="container_top">
				<div id="logout_bar">
				<br />
				<br />
				<br />
					<div id="welcome_note">
						<p class="welcome">Welcome
							<?php $con = mysql_connect("localhost","root","test1");
								if (!$con) {
									die('Could not connect: ' . mysql_error());
								}

								mysql_select_db("LHR", $con);
								$querystr = "SELECT Contactperson FROM registereduser WHERE RegisteredEmailaddress = '".$_SESSION['username']."'";
								$result = mysql_query($querystr);
								$row = mysql_fetch_assoc($result);
								echo $row['Contactperson']
							?>
						</p>
					</div>

					<div id="pass_reg">
						<a href="edit_profile.php">Edit profile</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</div>

			<div id="bottom_menu">
				<a href="index_logged_in.php">Home Page</a>
				<a href="costs.php">Costs</a>
				<a href="aboutus.php">About Us</a>
				<a href="faq.php">FAQ</a>
				<a href="privacypolicy.php">Privacy Policy</a>
				<a href="help.php">Help</a>
			</div>
		</div>

		<div id="lewy_pasek">
			<div id="ad">
			</div>
		</div>

		<div id="srodek_pasek">
				<div id="container_middle">
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

							<p>
								<?php if(isset($_SESSION['already_err'])) {
									?>
									<?php echo $_SESSION['already_err'];
									unset($_SESSION['already_err']);?>
								<?php }?>
							</p>
							<p>
								<?php if(isset($_SESSION['success'])) {
									?>
									<?php echo $_SESSION['success'];
									unset($_SESSION['success']);?>
								<?php }?>
							<p>

							<fieldset>
								<br/>
							<fieldset>
								<legend>Login Information:</legend>
								E-mail:
								<br>
								<input name="email" type="text" size="40" value="<? $row1= $_SESSION["row1"]; print $row1["RegisteredEmailaddress"] ?>">
								<br>
								Password [6 - 12 chars]:
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
							<input type="submit" name="register" value="Update" id="submit">
							<input type="reset" value="Reset" name= "reset"/>
							</fieldset>
						</form>
				</div>
			</div>
		</div>

		<div id="prawy_pasek">
			<div id="webcams">
				<script type="text/javascript" language="JavaScript">
					newImage = new Image();

					function LoadNewImage() {
						var unique = new Date();
						document.images.webcam.src = newImage.src;
						newImage.src = "../images/1265849610942_20.jpg?time=" + unique.getTime();
					}

					function InitialImage() {
						var unique = new Date();
						newImage.onload = LoadNewImage;
						newImage.src = "../images/1265849610942_20.jpg?time=" + unique.getTime();
						document.images.webcam.onload="";
					}
				</script>

				<div id="webcam1">
					<!--<h3>A</h3>-->
					<img src="../images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
				<div id="webcam2">
					<!--<h3>A</h3>-->
					<img src="../images/1265849610942_20.jpg" name="webcam" width="300" height="280">
				</div>
			</div>
		</div>

	</div>

</body>
</html>
