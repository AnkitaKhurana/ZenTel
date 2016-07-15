<?php
		$servername = "localhost";
		$username = "root";
		$password = "1234";
		$conn = new mysqli($servername, $username, $password);
		$sql = "";
		//$sql.= "drop database project;";
		$sql.= "CREATE DATABASE IF NOT EXISTS project;";
		$sql.= "use project;";
		$sql.= "Create table general(PID int primary key,Name varchar(35),Brand varchar(15),Type char(1),Avg_Rating float(2,1),Rated_By int,Reviewed_By int);";
		$sql.= "Create table pic(PID int,Pic_Link varchar(50),Foreign Key(PID) References general(PID));";
		$sql.= "Create table shop(PID int,A_Price int,A_Link text,F_Price int,F_Link text,S_Price int,S_Link text,Foreign Key(PID) References general(PID));";
		$sql.= "Create table user(UID int primary key auto_increment,Name varchar(35),Email varchar(30), Password varchar(30), Subscribe bit(1));";
		$sql.= "Create table specs(PID int,Processor varchar(30),RAM float(2,1),ROM int,OS varchar(15),Battery int,Screen_Size float(2,1),Screen_Resolution varchar(25),Rear_Camera float(3,1),Front_Camera float(3,1),USB_Version varchar(20),Fingerprint_Sensor varchar(3),Expandable_Storage varchar(20),Removable_Battery varchar(3),Wifi varchar(25),Bluetooth varchar(10),NFC varchar(3),SIM varchar(20),Sensors varchar(200),Height float(4,1),Width float(4,1),Thickness float(3,1),Weight float(4,1),Foreign Key(PID) References general(PID));";
		$sql.= "Create table reviews(PID int, UID int, rtimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, Content text);";
        $sql.= "Create table bloggeneral(Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,Title varchar(30),Post_Name varchar(35),Content text,Author varchar(30),Post_ID int primary key Auto_increment);";
		$sql.= "LOAD DATA INFILE 'C:/wamp/www/Project/csv/general.csv' INTO TABLE general FIELDS TERMINATED BY ',' ENCLOSED BY '\"'LINES TERMINATED BY '\\n'IGNORE 1 ROWS;";
		$sql.= "LOAD DATA INFILE 'C:/wamp/www/Project/csv/pic.csv' INTO TABLE pic FIELDS TERMINATED BY ',' ENCLOSED BY '\"'LINES TERMINATED BY '\\n'IGNORE 1 ROWS;";
		$sql.= "LOAD DATA INFILE 'C:/wamp/www/Project/csv/shop.csv' INTO TABLE shop FIELDS TERMINATED BY ',' ENCLOSED BY '\"'LINES TERMINATED BY '\\n'IGNORE 1 ROWS;";
		$sql.= "LOAD DATA INFILE 'C:/wamp/www/Project/csv/specs.csv' INTO TABLE specs FIELDS TERMINATED BY ',' ENCLOSED BY '\"'LINES TERMINATED BY '\\n'IGNORE 1 ROWS;";
		if ($conn->multi_query($sql) === TRUE) 
			echo "Task Completed successfully";
		else
			echo "Error: " . $sql . "<br>" . $conn->error;
		?>