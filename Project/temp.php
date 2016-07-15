<?php
			if(isset($_GET['PID']))
			{
				$PID = $_GET['PID'];
				}		
			$servername = "localhost";
			$username = "root";
			$password = "1234";
			$conn = new mysqli($servername, $username, $password);
			$use = "use project";	
			$conn->query($use);
			$select = "Select * from specs where PID = $PID";
			$result = $conn->query($select);
			$s_row = $result->fetch_assoc();
			
			$select = "Select Name, Avg_Rating,Rated_By,Reviewed_By from general where PID = $PID";
			$result = $conn->query($select);
			$g_row = $result->fetch_assoc();
			
			$select = "Select Pic_Link from pic where PID = $PID";
			$result = $conn->query($select);
			$i = -1;
			while($p_row = $result->fetch_assoc())
			{
				$i++;
				$Pic_Link[$i] = $p_row['Pic_Link']; 
				}
			
			$select = "Select * from shop where PID = $PID";
			$result = $conn->query($select);
			$shop_row = $result->fetch_assoc();
			/*
			echo $g_row['Name'];
			
			foreach($s_row as $key => $value)
			{
				echo "$key:  $value<br>";
				}
			foreach($g_row as $key => $value)
			{
				echo "$key:  $value<br>";
				}		
			foreach($shop_row as $key => $value)
			{
				echo "$key:  $value<br>";
				}
			for($i = 0;$i < 4;$i++)
			{
				echo "PIC$i:  $Pic_Link[$i]<br>";
				}*/

			$shop[0][0] = $shop_row['A_Price'];
			$shop[0][1] = $shop_row['A_Link'];
			$shop[0][2] = "amazon.jpg";
			$shop[1][0] = $shop_row['F_Price'];
			$shop[1][1] = $shop_row['F_Link'];
			$shop[1][2] = "flipkart.png";
			$shop[2][0] = $shop_row['S_Price'];
			$shop[2][1] = $shop_row['S_Link'];
			$shop[2][2] = "snapdeal.jpg";
			echo $shop[0][0]."<br>";
			echo $shop[0][1]."<br>";
			echo $shop[0][2]."<br>";
			echo $shop[1][0]."<br>";
			echo $shop[1][1]."<br>";
			echo $shop[1][2]."<br>";
			echo $shop[2][0]."<br>";
			echo $shop[2][1]."<br>";
			echo $shop[2][2]."<br>";
		?>
