<?php
session_start();
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$database = "Project";
	
	$pid = $_POST['PID'];
	$content = $_POST["review_text"];
	$uid = $_SESSION["UID"];


	

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
		} 

	$use = "use Project";	
	if($conn->query($use)===True)
	{
		echo "Using the Database <br>";
		}
	
	$insert = "insert into reviews(UID,PID,Content) values ('$uid','$pid','$content')";
	if($conn->query($insert)===True)
	{
		echo "Successfully Entered The data";
	}
	$sendto = 'Location: product.php?PID='.$pid;
	//echo $sendto;
	header($sendto);
	?>