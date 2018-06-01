<?php 
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

switch ($method) {
  case 'PUT':
      parse_str(file_get_contents("php://input"),$post_vars); 
	   $name=$post_vars['name'];
			$department=$post_vars['department'];
			$employeecode=$post_vars['employeecode']; 
			$id=$post_vars['id']; 
			if(mysqli_query($conn,"update employees set name='$name',department='$department',employeecode='$employeecode' where id=$id"))
			{ 
				$response["data"]= "data has been updated";
				echo json_encode($response);
				}else{
					$response["data"]= "Error into Save";
					echo json_encode($response);
					
				} 
    break;
  case 'POST':
          $name=$_POST['name'];
			$department=$_POST['department'];
			$employeecode=$_POST['employeecode']; 
			if(mysqli_query($conn,"insert into employees (name,department,employeecode) VALUES ('$name','$department','$employeecode')"))
			{ 
				$response["data"]= "new data has been updated";
				echo json_encode($response);
				}else{
					$response["data"]= "Error into Save";
					echo json_encode($response);
					
				} 
    break;
 case 'DELETE':
		parse_str(file_get_contents("php://input"),$post_vars);
		$id=$post_vars["id"];
        if(mysqli_query($conn,"delete from employees where id=$id"))
			{ 
				$response["data"]= " data has been Deleted";
				echo json_encode($response);
				}else{
					$response["data"]= "Error into Delete";
					echo json_encode($response);
					
				} 
    break;
  case 'GET': 
		$sth = mysqli_query($conn,"SELECT * FROM employees;");
		$rows = array();
		while($r = mysqli_fetch_assoc($sth)) { 
			$rows[] = $r;
		}
		echo json_encode($rows);
    break;
   default:
    handle_error($request);  
    break;
} 
$conn->close(); 
?>
