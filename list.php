<?php
require_once('Employee.class');

class EmployeeList
{
	public function search($term)
	{
		$employees=array();
		$connection = mysqli_connect("localhost","root","","pyus") OR DIE (mysqli_connect_error());
		$query = $connection->prepare("SELECT username, firstname, surname FROM employees WHERE username LIKE ? OR firstname LIKE ? OR surname LIKE ?;");
		$term = $term."%";
		$query->bind_param("sss",$term,$term,$term);
		$query->execute();
		$result = $query->get_result();
		while ($row = $result->fetch_assoc()) {
			array_push($employees, new Employee($row['username'],$row['firstname'],$row['surname']));
		}
		return $employees;
	}
}
?>

<form action='list.php' method='POST'>
<input name='term' placeholder='search'><br/>
<input type='submit' value="Search">
</form>

<?php
$employees = new EmployeeList();

if(isset($_POST['term']))
{
	$term=$_POST['term'];
	foreach($employees->search($term) as $employee)
	{
		echo "<b>".$employee->surname."</b>, ".$employee->firstname." (".$employee->username.")</br>";
	}
}
?>