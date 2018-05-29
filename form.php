<HTML>
<HEAD>
<title>This is form </title>
</HEAD>
<body>

<form name="f1" action="form.php" method="post">
<table>
<tr><td>Name</td><td><input type="text" name="name" size="20" placeholder="enter your name" /></td></tr>
<tr><td>Department</td><td><input type="text" name="department" size="20" placeholder="enter your father's name" /></td></tr>
<tr><td>Employee Code</td><td><input type="text" name="employeecode"/><br /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="OK" /></td></tr>

</table>
</form>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="test";
$conn=mysqli_connect($servername,$username,$password,$dbname);


if($_POST)
{
$name=$_POST['name'];
$department=$_POST['department'];
$employeecode=$_POST['employeecode'];
$sql="insert into employees (name,department,employeecode) VALUES ('$name','$department','$employeecode')";
if(mysqli_query($conn,$sql))
{
echo "new data has been updated";
}
}
$sql = "SELECT * FROM employees;";
$sth = mysqli_query($conn,$sql);
$rows = array();?>
<table border="1" cellspacing="0" cellpadding="0"> 
<?php
while($r = mysqli_fetch_assoc($sth)) 
{
	?>
	<tr>
	<td><?php
     echo $r["name"];?></td>
	<td><?php
     echo $r["department"];?></td>
	<td><?php
     echo $r["employeecode"];?></td>
	</tr>
	
	 <?php
} 
$conn->close(); 
?>
</table>  

</body>
</HTML>