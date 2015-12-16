<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$connection = mysqli_connect("localhost","root","","pyus") OR DIE (mysqli_connect_error());
		$query = $connection->prepare("SELECT username, firstname, surname FROM employees WHERE username = ? AND password = PASSWORD(?) LIMIT 1;");
		$query->bind_param("ss",$_POST['username'],$_POST['password']);
		$query->execute();
		$result = $query->get_result();
		if($result->num_rows == 1)
		{
			setcookie("username",$_POST['username']);
			header('Location: ./');
		}
		else
		{
			echo "Login Failed";
		}
	}
	else
	{
		setcookie("username", "", time()-3600);
		header('Location: ./');
	}
?>