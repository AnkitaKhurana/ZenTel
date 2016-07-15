<?php session_start();?>
<html>
	<head>
		<title>Product</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="header.css">
		<link rel="stylesheet" href="footer.css">
		<link rel="stylesheet" href="product.css">
		<link rel="stylesheet" href="Signup.css">
		<script src="smoothscroll.js"></script>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
		<script>
			$(document).ready(function(){
				$(".others").click(function(){
					var attrib = $(this).attr("src");
					$(".main").attr("src",attrib);
				});
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
			$shop[0][0] = $shop_row['A_Price'];
			$shop[0][1] = $shop_row['A_Link'];
			$shop[0][2] = "esite/amazon.jpg";
			$shop[1][0] = $shop_row['F_Price'];
			$shop[1][1] = $shop_row['F_Link'];
			$shop[1][2] = "esite/flipkart.png";
			$shop[2][0] = $shop_row['S_Price'];
			$shop[2][1] = 'http://www.snapdeal.com/product/samsung-galaxy-s7-32gb-4g/671145658672';//$shop_row['S_Link'];
			$shop[2][2] = "esite/snapdeal.jpg";
			
			$s_row['RAM'] = $s_row['RAM']."GB";
			$s_row['ROM'] = $s_row['ROM']."GB";
			$s_row['Battery'] = $s_row['Battery']."mAh";
			$s_row['Screen_Size'] = $s_row['Screen_Size']."in";
			$s_row['Front_Camera'] = $s_row['Front_Camera']."MP";
			$s_row['Rear_Camera'] = $s_row['Rear_Camera']."MP";
			$s_row['Height'] = $s_row['Height']."mm";
			$s_row['Width'] = $s_row['Width']."mm";
			$s_row['Thickness'] = $s_row['Thickness']."mm";
			$s_row['Weight'] = $s_row['Weight']."g";
		?>
		<div class="header">
			<h1 id="webname" style="cursor:pointer;" onclick="window.location='index.php'"><span style="color:yellow; ">&nbsp Zen</span><span style="color:white;">Tel</span></h1>
			<div class="nav-bar">
				<ul class="menu">
					<li style="margin-left:-25px;"><a class="type">Smartphones</a></li
					><li><a class="type">Tablets</a></li
					><li><a onclick="window.location='index.php#brands'">Brands</a></li
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
		<div class="row general" style="width:101.2%;">
			<div class="col-md-5 pic">
				<img class="main" src="<?php echo $Pic_Link[0]; ?>" alt="Pic">
				<img class="others" src="<?php echo $Pic_Link[0]; ?>" alt="Pic1" style="margin-top:22px;">
				<img class="others" src="<?php echo $Pic_Link[1]; ?>" alt="Pic2">
				<img class="others" src="<?php echo $Pic_Link[2]; ?>" alt="Pic3">
				<img class="others" src="<?php echo $Pic_Link[3]; ?>" alt="Pic4">
 			</div>
			<div class="col-md-7 info">
				<div class="name">
					<h1><?php echo $g_row['Name']; ?></h1>
				</div>
				<div class="details">
					<div style="width:100%;height:50%;">
						<div class="specs-brief">
							<p><?php echo $s_row['Screen_Size']."  " ?><?php echo $s_row['Screen_Resolution'] ?></p>
							<p><?php echo $s_row['Rear_Camera']."  Camera" ?></p>
							<p><?php echo $s_row['Battery'] ?></p>
							<p style="margin-bottom:20px;"><?php echo $s_row['RAM'] ?></p>
							<a href="#specs">Veiw Full Specs</a>
						</div
						><div class="rating-brief">
							<p>Average rating: <?php echo $g_row['Avg_Rating'] ?>/5</p>
							<p style="margin-bottom:20px;"><?php echo $g_row['Rated_By'] ?> Ratings , <?php echo $g_row['Reviewed_By'] ?> Reviews</p>
							<a href="#rev"><div class="icon" >
								<i class="fa fa-edit" style="font-size:35px;margin-right:10px;"></i>
								<p>Write A Review</p>
							</div></a>
						</div>
					</div>
					<div class="shop">
						<?php
							for($i = 0;$i < 3;$i++)
							{
								if($shop[$i][0] == 2000000)
									$shop[$i][0] = "Not Available";
								else
									$shop[$i][0] = "Rs ".$shop[$i][0];
								$print = "
										<div class=\"esite\" onclick=\"window.location='".$shop[$i][1]."'\">
											<img src=\"".$shop[$i][2]."\" alt=\"pic\" />
											<p>".$shop[$i][0]."</p>
										</div>
								";
								echo $print;
								}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
		<div id="specs">
			<h1>Specifications</h1>
			<div class="specs-panel">
				<div class="specs">
						<div class="title">
							<p>Platform</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>OS</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['OS'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Processor</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Processor'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Memory</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>RAM</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['RAM'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>ROM</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['ROM'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Expandable Srorage</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Expandable_Storage'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Display</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>Screen Size</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Screen_Size'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Screen Resolution</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Screen_Resolution'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Camera</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>Rear Camera</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Rear_Camera'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Front Camera</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Front_Camera'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Communications</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>SIM</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['SIM'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Wifi</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Wifi'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Bluetooth</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Bluetooth'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>NFC</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['NFC'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>USB Version</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['USB_Version'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Body</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>Height</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Height'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Width</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Width'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Thickness</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Thickness'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Weight</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Weight'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="specs">
						<div class="title">
							<p>Others</p>
						</div>
						<div class="contents">
							<div class="single">
								<div class=	"key">
									<p>Battery</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Battery'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Removable Battery</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Removable_Battery'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Fingerprint</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Fingerprint_Sensor'] ?></p>
								</div>
							</div>
							<div class="single">
								<div class=	"key">
									<p>Sensors</p>
								</div>
								<div class=	"value">
									<p><?php echo $s_row['Sensors'] ?></p>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		</div>
		<div class="review-section">
			

<div class="row">
	<div class="col-sm-3">
			<div class="rating">
				<div class="overall">
					<i class="fa fa-star"></i>
					<h1 style="margin-top:30px">4.1</h1>
					<p>Out of 5</p>
				</div>
				<div class="breakdown">
				</div>
			</div>
	</div>
	<div class="col-sm-8">		
		<h1 id="rev">REVIEWS</h1>

<?php 
					if(!(!(isset($_SESSION["Flag"])) || $_SESSION["Flag"]==0))
						echo '<div class="well">
                    <h4>Leave a Review:</h4>
                    <form role="form" action="review.php" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="review_text"></textarea>
                            <input type="hidden" value="'.$PID.'" name="PID">
                        </div>

                        <button type="submit" class="btn btn-primary" id="revsub">Submit</button>
                    </form>
                </div>

                <hr>';
                else
						echo '<br/>
					<div class="alert alert-warning">
															<strong>Sign In with a user account to post a review.</strong>
														</div>';
					

?>		

<?php
			$servername = "localhost";
			$username = "root";
			$password = "1234";
			$PID = $_GET['PID'];
			$conn = new mysqli($servername, $username, $password);
			$use = "use project;";	
			$conn->query($use);
			//$select = "Select * from reviews where PID = ".$_GET[PID]." order by rtimestamp desc;";
			$select = "Select * from reviews where PID = $PID";
			$result = $conn->query($select);
			$i = -1;
			while(($row = $result->fetch_assoc()) && ($i<=15))
			{
				$i++;
				$UID[$i] = $row['UID'];
				$Time[$i] = $row['rtimestamp'];
				$content[$i] = $row['Content'];
				$select_path = "Select Name from user where UID = $UID[$i]";
				$retrieve = $conn->query($select_path);
				$fetch = $retrieve->fetch_assoc();
				$Username[$i] = $fetch['Name'];
				}

                $j = 0;	
				while($i != -1)
				{
                $print = "<div class=\"media\">
                    
                    <div class=\"media-body\">
                        <h4 class=\"media-heading\">$Username[$j]
                        <small>$Time[$j]</small>
                        </h4>
                        $content[$j]
                    </div>
                </div>";
					echo $print;
					$j++;
					$i--;
					}	

?>
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