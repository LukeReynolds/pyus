<?php
$connection = mysqli_connect("localhost","root","","pyus") OR DIE (mysqli_connect_error());
		$query = $connection->prepare("SELECT username, firstname, surname FROM employees;");
		$query->execute();
		$result = $query->get_result();
		while ($row = $result->fetch_assoc()) {
		
		echo "<article>".$row['firstname']." ".$row['surname']."</article>";

    }
?>