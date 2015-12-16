<!doctype html>
<html>
	<head>
	<title>Pyus Pyidis - Support</title>
	<link rel="stylesheet" href="style.css"
	</head>
	<body>
	<?php
	include ("header.php");
	include ("navigation.php")
	?>
	<h1> IT Support<h1>
	<form class='ticket' action=''method='post'>
	<input name='subject' placeholder='Subject'><br/>
	<textarea name= 'description' cols='140' rows='10'></textarea><br/>
	<input type='submit' value="send ticket">
	</form>
	<?php
	include ("footer.php")
	?>
	</body>
</html>