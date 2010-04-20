<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>email</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18.1" />
</head>

<body>

<p>
						<?php echo "Forgot your password? Input you email below"?>
					</p>
					<p>
						<?php
							if(isset($_SESSION['lost_already_err'])){
								echo $_SESSION['lost_already_err'];
								unset($_SESSION['lost_already_err']);
							}
						?>
</p>

						<form action="lost.php" method="post">
							<p>
								<label for="username">E-mail:</label>
								<input type="text" id="username" name="username"/>
							</p>
							<p class="submit">
								<input type="submit" name="submit" value="submit" />
							</p>
						</form>
</body>
</html>
