<?php
	require_once('department.class');
	require_once('role.class');
	require_once('Employee.class');
	
	class Departments
	{
		public function __construct($connection)
		{
			$this->connection = $connection;
		}
		
		function search($term)
		{
			$departments = array();
			$query = $this->connection->prepare("SELECT name FROM departments WHERE name LIKE ?;");
			$term = $term.'%';
			$query->bind_param('s',$term);
			$query->execute();
			$result = $query->get_result();
			while ($row = $result->fetch_assoc()) {
				$name = $row['name'];
				$roles = $this->getRoles($name);
				array_push($departments, new Department($name,$roles));
			}
			return $departments;
		}
		
		function getRoles($name)
		{
			$roles = array();
			$query = $this->connection->prepare("SELECT name, employee FROM roles WHERE department = ? ;");
			$query->bind_param('s',$name);
			$query->execute();
			$result = $query->get_result();
			while ($row = $result->fetch_assoc()) {
				$employee=$this->getEmployee($row['employee']);
				array_push($roles, new Role($row['name'],$employee));
			}
			return $roles;
			
		}
		
		function getEmployee($username)
		{
			$query = $this->connection->prepare("SELECT username, firstname, surname FROM employees WHERE username = ? LIMIT 1;");
			$query->bind_param('s',$username);
			$query->execute();
			$result = $query->get_result();
			$row = $result->fetch_assoc();
			return new Employee($row['username'],$row['firstname'],$row['surname']);
		}
		private $connection;
	}
	
?>

<form action='listDepartments.php' method='POST'>
<input name='term' placeholder='search'><br/>
<input type='submit' value="Search">
</form>

<?php

if(isset($_POST['term']))
{
	$term=$_POST['term'];
	
	$connection = mysqli_connect("localhost","root","","pyus");
	$departments = new Departments($connection);
	
	foreach($departments->search($term) as $department)
	{
		echo "<b>".$department->name."</b></br>";
		foreach($department->roles as $role)
		{
			echo $role->name." ".$role->employee->firstname." ".$role->employee->surname."<br/>";
		}
	}
}
?>