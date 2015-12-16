<!doctype html>
<html>
	<head>
		<title>Pyus Pyxidis - Home</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php
			include("header.php");
			if(isset($_COOKIE['username']))
			{
				include("navigation.php");
				include("home.php");
			}
			else
			{
				include("login.php");
			}
		?>
		<?php include ("footer.php")?>
	</body>
</html>