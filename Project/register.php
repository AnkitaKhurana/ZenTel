	<?php
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$database = "Project";
	
	$name = $_POST["Name"];
	$email = $_POST["Email"];
	$pass = $_POST["Pass"];
	
	if(isset($_POST["Subscribe"]))
	{$subs = 1;}
	else
	{$subs = 0;}

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
		} 
	echo "Connected successfully <br>";
	$use = "use Project";	
	if($conn->query($use)===True)
	{
		echo "Using the Database <br>";
		}
	$insert = "insert into user(Name,Email,Password,Subscribe) values ('$name','$email','$pass','$subs')";
	if($conn->query($insert)===True)
	{
		echo "Successfully Entered The data";
	}
	header('Location: index.php');
	?>