<?php
	include("check_session.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Cloud Space</title>
		<link rel="stylesheet" href="css/style-update.css" />
		<link rel="stylesheet" href="css/style-home.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>
		<script type="text/javascript" src="js/jquery-home.js"></script>
	</head>
	<body>
		<center>
		<div id="upper">
			<div class="upleft">
				<div id="cloud">
					<h1>Cloud Space</h1>
					<img id="cloudlogo" src="images/cloudlogo2.png"/>
				</div>
				<div id="profile">
					<img src="pic.php"  class="profile_pic"/>
					<form action="updatepic.php" method="post" enctype="multipart/form-data">
						<a onClick="document.getElementById('img').click();">
							<span id="edit"><img class="icon" src="images/photo.ico"/>upload photo</span>
						</a>
						
						<input type="file" name="file" onChange="document.getElementById('up').click();" id="img"  style="display:none"/>
						<input type="submit" id="up" value="null"/>
						</form>
				</div>		
			</div><!--end of east-->
			
			<div class="upright">
				<div id="search_logo">
					<div id="track_path">
					<!--<a href="home.php">
					<img src="images/Reminder-icon.png" id="path_root" />
					</a> -->
					<a href="home.php">
					<img src="images/Keynote-icon.png" id="path_root" />
					</a>
					<img src="images/logout.png" id="logout" />
					</div>
				</div>
		
				<hr/>
				<div id="updateinfo">
					<div class="half1">
							<b>Current Username</b><br/>
							<b>Login Name</b><br/>
							<b>Password </b><br/>
							<b>Email Id</b><br/>
							<b>Contact</b>
							
					</div>
					
				<form action="updatedata.php" method="post">
					<div class="half2">
						<?php
	
			$con = mysql_connect("127.0.0.1", "root", "")
			or die("Unable to connect to SQL server");
			
			mysql_select_db("cloudspace",$con)
			or die("no database found");
	
		
		
	$result = mysql_query("SELECT * FROM user_info WHERE  username='".$_SESSION['username']."'",$con) 
	or die("113");
		
	while($row = mysql_fetch_array($result))
	{
	echo"<input type='text' value='".$row['username']."' name='username' class='textbox' disabled/>";
	echo"<input type='text' value='".$row['name']."' name='name' class='textbox'/>";
	echo"<input type='password' placeholder='new password' name='password' class='textbox'/>";
	echo"<input type='text' value='".$row['email']."' name='email' class='textbox'/>";
	echo"<input type='text' value='".$row['contact']."' name='contact' class='textbox'/>";
	}
	mysql_close($con);
?>
							
						
					</div>
				</div>
				<input type="submit" value="Update" class="alert"/>
				</form>
				<br/>
				<!--p>0.00 GB (0%) of 10 GB used</p-->
				
				<div id="bottom_info">
					<p id="total_files">Total files <span id="count">0</span></p>
					<div id="progressbox" >
						<div id="progressbar"></div >
						<div id="statustxt">0%</div>
					</div>
					<!--div id="gb_used"><p>2.45 GB of 10 GB used</p></div-->
				</div>
			</div>
		</div>
		
		<div id="lowerbody">
			<hr/>
			<h2>Carry your data where ever you want</h2><!--Carry your data in your pocket-->
			<p>with Cloud Space you can access your data anytime, anywhere you want with just a single click</p>
			
			<div id="sociallinks" >
					<a href="https://facebook.com"  id="facebook" >Facebook</a>
					<a href="https://twitter.com" id="twitter" >Twitter</a>
					<a href="https://plus.google.com" id="googleplus" >GooglePlus</a>
					<a href="https://linkedin.com" id="linkedin" >LinkedIn</a>
					<a href="https://myspace.com"  id="myspace" >MySpace</a>
				
			</div>
			<br/>
			<p id="copy" style="margin-bottom:0">Copyright &copy All Rights Reserved</p>
			<br/>
			
		</div>
		</center>
	</body>
</html>