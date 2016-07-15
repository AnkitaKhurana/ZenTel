<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	
	$email = $_POST["email"];
	$pass = $_POST["password"];
	
	
	
	if($email=="admin@admin.com"&&$pass=="1234")
	{
		header('Location: blog.php');
	}
else
{
	$conn = new mysqli($servername, $username, $password);
	$use = "use project";	
	$conn->query($use);
	
	$select = "select UID from user where Email = '$email' and Password = '$pass'";
	$result = $conn->query($select);
	if($result->num_rows>0)
	{
		$row = $result->fetch_assoc();
		$_SESSION["UID"] = $row['UID'];
		$_SESSION["Flag"] = 1;	
		header('Location: index.php');
		}
	else
	{
		header('Location: index.php?login=0');
		}

}		
	?>