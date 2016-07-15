<?php session_start();?>
<html>
	<head>
		<title>Home page</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="slider.js"></script>
		<script src="smoothscroll.js"></script>
		<link rel="stylesheet" href="slider.css">
		<link rel="stylesheet" href="header.css">
		<link rel="stylesheet" href="columns.css">
		<link rel="stylesheet" href="footer.css">
		<link rel="stylesheet" href="Signup.css">
		<script>
			$(document).ready(function(){
				$(".type").click(function(){
					var type = $(this).text();
					window.location = "list.php?type=" + type[0];
				});
				$(".brand").click(function(){
					var brand = $(this).children("p:first").text();
					window.location = "list.php?brand=" + brand;
				});
			});
		</script>
	</head>
	<body>
		<?php
			if(isset($_GET['login']))
			{
				if($_GET['login'] = 0)
					$login = 0;
				else
					$login = 1;
				}
			$servername = "localhost";
			$username = "root";
			$password = "1234";
			$conn = new mysqli($servername, $username, $password);
			$use = "use project";	
			$conn->query($use);
			$select_s = "Select PID,Name from general where Type = 'S' order by Avg_Rating desc limit 4";
			$result = $conn->query($select_s);
			$i = -1;
			while($row = $result->fetch_assoc())
			{
				$i++;
				$S_PID[$i] = $row['PID'];
				$S_Name[$i] = $row['Name'];
				$select_p = "Select Pic_Link from pic where PID = $S_PID[$i] limit 1";
				$retrieve = $conn->query($select_p);
				$fetch = $retrieve->fetch_assoc();
				$S_Pic_Link[$i] = $fetch['Pic_Link']; 
				}
			$select_t = "Select PID,Name from general where Type = 'T' order by Avg_Rating desc limit 4";
			$result = $conn->query($select_t);
			$i = -1;
			while($row = $result->fetch_assoc())
			{
				$i++;
				$T_PID[$i] = $row['PID'];
				$T_Name[$i] = $row['Name'];
				$select_p = "Select Pic_Link from pic where PID = $T_PID[$i] limit 1";
				$retrieve = $conn->query($select_p);
				$fetch = $retrieve->fetch_assoc();
				$T_Pic_Link[$i] = $fetch['Pic_Link']; 
				}				
		?>
		<div class="header">
			<h1 id="webname" style="cursor:pointer;" onclick="window.location='index.php'"><span style="color:yellow; ">&nbsp Zen</span><span style="color:white;">Tel</span></h1>
			<div class="nav-bar">
				<ul class="menu">
					<li style="margin-left:-25px;"><a class="type">Smartphones</a></li
					><li><a class="type">Tablets</a></li
					><li><a href="#brands">Brands</a></li
					><li><a onclick="window.location='bloglist.php'">Posts</a></li>
				</ul>
				<ul class="signin">
					<?php 
					if(!(isset($_SESSION["Flag"])) || $_SESSION["Flag"]==0)
						echo '<li style="margin-right:30;cursor:pointer"><a data-toggle="modal" data-target="#sign">Sign In</a></li>';
					else
						echo '<li style="margin-right:30;cursor:pointer"><a onclick="window.location = \'logout.php\'">Sign Out</a></li>';
					?>
				</ul>
			</div>
		</div>
		<div class="slider-container">
			<canvas id="Canvas1" width="20" height="60" style="right:20;">Your browser does not support the canvas element.</canvas>
			<canvas id="Canvas2" width="20" height="60" style="left:20;">Your browser does not support the canvas element.</canvas>
			<div class="slider">
				<div>
					<img src="slider\pic1.jpg">
				</div>
				<div>
					<img src="phones/Moto-G4-Plus-1.jpg" onclick="window.location='product.php?PID=20'">
				</div>
				<div>
					<img src="slider\pic5.jpg" onclick="window.location='product.php?PID=21'">
				</div>
			</div>
			<div class="indicator">
				<input type="radio" name="slider" id="r1"><label for="r1"><span></span></label>
				<input type="radio" name="slider" id="r2"><label for="r2"><span></span></label>
				<input type="radio" name="slider" id="r3"><label for="r3"><span></span></label>
			</div>
		</div>
		<div class="row" style="height:600px;width:100%;">
			<div class="col-md-6" style="text-align:center;">
				<p class="title">Top Rated Smartphones</p>
				<div class="column" onclick="window.location='product.php?PID=<?php echo $S_PID[0] ?>'">
					<img src="<?php echo $S_Pic_Link[0] ?>"/>
					<div class="caption">
						<p><?php echo $S_Name[0] ?></p>
					</div>
				</div>
				<div class="column" style="margin-right:-3px" onclick="window.location='product.php?PID=<?php echo $S_PID[1] ?>'">
					<img src="<?php echo $S_Pic_Link[1] ?>"/>
					<div class="caption">
						<p><?php echo $S_Name[1] ?></p>
					</div>
				</div>
				<div class="column" onclick="window.location='product.php?PID=<?php echo $S_PID[2] ?>'">
					<img src="<?php echo $S_Pic_Link[2] ?>"/>
					<div class="caption">
						<p><?php echo $S_Name[2] ?></p>
					</div>
				</div>
				<div class="column" style="margin-right:-3px" onclick="window.location='product.php?PID=<?php echo $S_PID[3] ?>'">
					<img src="<?php echo $S_Pic_Link[3] ?>"/>
					<div class="caption">
						<p><?php echo $S_Name[3] ?></p>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="text-align:center;">
				<p class="title">Top Rated Tablets</p>
				<div class="column" onclick="window.location='product.php?PID=<?php echo $T_PID[0] ?>'">
					<img alt="Tablet Pic" src="<?php echo $T_Pic_Link[0] ?>" />
					<div class="caption">
						<p><?php echo $T_Name[0] ?></p>
					</div>
				</div>
				<div class="column" style="margin-right:-3px" onclick="window.location='product.php?PID=<?php echo $T_PID[1] ?>'">
					<img alt="Tablet Pic" src="<?php echo $T_Pic_Link[1] ?>" />
					<div class="caption">
						<p><?php echo $T_Name[1] ?></p>
					</div>
				</div>
				<div class="column" onclick="window.location='product.php?PID=<?php echo $T_PID[2] ?>'">
					<img alt="Tablet Pic" src="<?php echo $T_Pic_Link[2] ?>" />
					<div class="caption">
						<p><?php echo $T_Name[2] ?></p>
					</div>
				</div>
				<div class="column" style="margin-right:-3px" onclick="window.location='product.php?PID=<?php echo $T_PID[3] ?>'">
					<img alt="Tablet Pic" src="<?php echo $T_Pic_Link[3] ?>" />
					<div class="caption">
						<p><?php echo $T_Name[3] ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="height:450px;width:100%;">
			<div class="col-md-12" style="text-align:center;">
				<p class="title" style="width:60%;" id="brands">Brands</p>
				<div class="column brand" style="margin-left:35px;">
					<p style="display:none;">Samsung</p>
					<img src="brands/samsung.png"/>
				</div>
				<div class="column brand">
					<p style="display:none;">Apple</p>
					<img src="brands/apple.png"/>
				</div>
				<div class="column brand">
					<p style="display:none;">Lenovo</p>
					<img src="brands/lenovo.jpg"/>
				</div>
				<div class="column brand">
					<p style="display:none;">Motorola</p>
					<img src="brands/motorola.jpg"/>
				</div>
				<div class="column brand">
					<p style="display:none;">Sony</p>
					<img src="brands/Sony.jpg"/>
				</div>
				<div class="column brand">
					<p style="display:none;">One Plus</p>
					<img src="brands/oneplus.png"/>
				</div>
				<div class="column brand">
					<p style="display:none;">LYF</p>
					<img src="brands/lyf.png"/>
				</div>
				<div class="column brand">
					<p style="display:none;">HTC</p>
					<img src="brands/htc.png"/>
				</div>
				<div class="column brand">
					<p style="display:none;">Asus</p>
					<img src="brands/Asus.jpg"/>
				</div>
			</div>
		</div>
		<div class="footer row" style="width:101.2%;">
			<div class="container">
			<div class="col-md-6">
			<br>
				<h3>Explore/Connect</h3>
				<br>
				<p><a href="">Sign In</a></p>
				<p><a href="">Smartphones</a></p>
				<p><a href="">Tablets</a></p>
			</div>
			<div class="col-md-6">
				<br>
				<h3>About Us</h3>
				<br>
				<p>Abhishek Jain</p>
				<p>Ankita Khurrana</p>
				<p>Nihal Chauhan</p>
				<p>Kavya Sharma</p>
			</div>
			</div>
		</div>
		
    <!-- Modal content-->
    
		<div class="modal fade" id="sign" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="row"  style="margin-top:15px">
						<div class="col-md-12" style="height:auto">
							<div class="panel panel-login">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6">
											<a href="#" class="active" id="login-form-link">Login</a>
										</div>
										<div class="col-xs-6">
											<a href="#" id="register-form-link">Register</a>
										</div>
									</div>
									<hr>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<form id="login-form" action="login.php" method="post" role="form" style="display: block;">
											<br>
											<?php
												if(isset($_GET['login']) && $_GET['login']==0)
													echo '  
														<div class="alert alert-danger">
															<strong>Wrong Username or Password</strong>
														</div>
														';
											?>
												<div class="form-group">
													<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Username" value="" required>
												</div>
												<div class="form-group">
													<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
												</div>
											<!-- <div class="form-group text-center">
													<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
													<label for="remember"> Remember Me</label>
												</div> -->
												<div class="form-group">
													<div class="row">
														<div class="col-sm-6 col-sm-offset-3">
															<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
														</div>
													</div>
												</div>
											<!-- <div class="form-group">
													<div class="row">
														<div class="col-lg-12">
															<div class="text-center">
																<a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
															</div>
														</div>
													</div>
												</div>-->
											</form>
											<form id="register-form" action="register.php" method="post" role="form" style="display: none;">
												<div class="form-group">
													<input type="text" name="Name" id="name" tabindex="1" class="form-control" placeholder="Username" value="" required>
												</div>
												<div class="form-group">
													<input type="email" name="Email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
												</div>
												<div class="form-group">
													<input type="password" name="Pass" id="pass" tabindex="2" class="form-control" placeholder="Password" required>
												</div>
												<div class="form-group text-center">
													<input type="checkbox" tabindex="3" class="" name="Subscribe" id="subs">
													<label for="remember"> Subscribe</label>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-sm-6 col-sm-offset-3">
														<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
														<!--<button name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Register Now</button>-->
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		
		if(isset($_GET["login"]))
		{echo '
				<script type="text/javascript">
					$(document).ready(function () {
						$("#sign").modal("show");
					});
				</script>
				';		}
		?><!--
		<script type="text/javascript">
			$(document).ready(function () {
				$("#sign").modal("show");
					}
					});
		</script>-->
		<!--
		<script>
			$(document).ready(function(){
				$("#register-submit").click(function(){	
					var name = $("#name");
					var email = $("#email");
					var pass = $("#pass");
					var subs = $("#subs");
					$.post("register.php",{Name:name,Email:email,Pass:pass,Subscribe:subs},function(){alert("success");});
					});
				});
		</script>-->
		<script>
			$('#login-form-link').click(function(e) {
				$("#login-form").delay(100).fadeIn(100);
				$("#register-form").fadeOut(100);
				$('#register-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
				});
			$('#register-form-link').click(function(e) {
				$("#register-form").delay(100).fadeIn(100);
				$("#login-form").fadeOut(100);
				$('#login-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});
		</script>
	</body>
</html>