<h1>Latest News</h1>
<?php
$connection = mysqli_connect("localhost","root","","pyus") OR DIE (mysqli_connect_error());
		$query = $connection->prepare("SELECT ID, Author, Title, Published, Content FROM news ORDER BY Published DESC;");
		$query->execute();
		$result = $query->get_result();
		while ($row = $result->fetch_assoc()) {
			$time=strtotime($row['Published']);
		echo "<article>";
		echo "<header>";
		echo "<div class='date'>".date("d",$time)."</br>".date("M",$time)."</div>";
		echo "<div class='title'>".$row['Title']."</div>";
		echo "</header>";
		echo "<p>".$row['Content']."</p>Written By: ".$row['Author'];
		echo "</article>";
    }
?>