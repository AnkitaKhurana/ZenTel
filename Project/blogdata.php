<?php
			$servername = "localhost";
			$username = "root";
			$password = "1234";
			$conn = new mysqli($servername, $username, $password);
			$use = "use project;";	
			$conn->query($use);
			$title=$_POST['Title'];
            $postname=$_POST['PostName'];
            $author=$_POST['Author'];
            $content=$_POST['Content'];
            $query="INSERT INTO bloggeneral(Title,Post_Name,Content,Author)VALUES('$title','$postname','$content','$author')";
          //  $query2="INSERT INTO account(accountno,balance) VALUES('$account','$balance');
            
            $result=$conn->query($query);
            if($result)
            echo "data inserted properly";
            else
            echo "data not inserted";
  ?>













