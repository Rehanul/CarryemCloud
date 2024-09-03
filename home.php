<?php
	include("check_session.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carry'em Home</title>
		<link rel="shortcut icon" href="images/favicon.png" type="image/png">
		<link rel="stylesheet" href="css/style-home.css" />
		<link rel="stylesheet" href="css/style-lightbox.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>
		<script type="text/javascript" src="js/jquery-home.js"></script>
	</head>
	<body>
		<center>
		<div id="upperbody">
			<div id="east">
					<div id="tagline">
						<h1>Carry'em</h1>
						<h2><sub>cloud</sub></h2>
					</div>
					
					<div id="profile">
						<img src="pic.php"  id="profile_pic"/>
						<a href="update.php">
								<span id="edit"><img src="images/gear-2-24.ico" class="icon"/>Edit profile</span>
						</a>
					</div>
				<h1><?php echo $_SESSION['name'] ?></h1>
				<h2 id="fileinfotext">File Information</h2>
				<div id="fileinfo" >
					<p id="filename"><b >Name : </b><span  id="displayname" ></span></p>
					<p id="filetype"><b>Type : </b><span  id="displaytype" ></span></p>
					<p id="filesize"><b>Size : </b><span id="displaysize" ></span></p>
					<p  id="filetime"><b>Uploaded on : </b><span id="displaytime" ></span></p>	
				</div>
			
			</div><!--end of east-->
			
			<div id="west">
				
				<div id="header_container">
						
						<div id="logo_container"><img src="images/cloudlogo2.png" id="logo"></div>
						<div id="searchbox">
							<input type="text" id="search_field" placeholder="Search.." />
							<input type="button" id="searchbtn" value="" />
						</div>
					<div id="dock">
						<img src="images/box-dock.png" title="show all files" class="dock-item" id="showall" />
						<img src="images/text-dock.png" class="dock-item" id="showtext" />
						<img src="images/image-dock.png" class="dock-item" id="showimage" />
						<img src="images/audio-dock.png" class="dock-item" id="showaudio" />
						<img src="images/video-dock.png" class="dock-item" id="showvideo" />
						<img src="images/application-dock.png" class="dock-item" id="showapplication" />
						<img src="images/logout.png" class="dock-item" id="logout" />
					</div>
					<div id="track_path">
						<img src="images/home.png" id="path_root" />
					</div>
					<hr/>
				</div>
				
				<div id="browse">
				
					<div class="item" tabindex='0'>
						<img id="icon" src="images/addfolder.png" /><br/>
						<input type="text" id="foldername" id="foldername" placeholder="Folder name"/>
						<input type="button" id="addfolderbtn" class="custombutton" value="Add Folder">
					</div>
					<div class="item" tabindex='0'>
						<div id="loading">
							<img src="images/loading.gif" id="loading_image">
							<p id="statustext">0%</p>
							<p>Uploading..</p>
						</div>
						<img src="images/uploadfile.png" id="icon" ><br/>
						<form action="save.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
							<input name="file" type="file" id="uploadfield" />
							<input type="submit" class="custombutton" value="Upload File" />
						</form>
					</div>
					
				</div>
				<!--p>0.00 GB (0%) of 10 GB used</p-->
				
				<div id="bottom_info">
					<p id="total_files">Total <span id="count">0</span> items..</p>
					<div id="progressbox" >
						<div id="progressbar" style="width:<?php include"width_progress.php" ?>"></div >
						<div id="statustxt"><?php include"width_progress.php" ?></div>
					</div>
					<p id="space_used"><?php include"gb.php" ?> of 5GB used</p>
					<!--div id="gb_used"><p>2.45 GB of 10 GB used</p></div-->
				</div>
			</div>
		</div>
		
		<div id="lowerbody">
			<hr/>
			
			<div id="sociallinks" >
			
					<a href="https://facebook.com" >
						<img src="images/facebook_logo.png" class="social_item" />
					</a>
					<a href="https://twitter.com" >
						<img src="images/twitter_logo.png" class="social_item" />
					</a>
					<a href="https://plus.google.com" >
						<img src="images/googleplus_logo.png" class="social_item" />
					</a>
					<a href="https://linkedin.com" >
						<img src="images/in_logo.png" class="social_item" />
					</a>
					<a href="https://myspace.com" >
						<img src="images/myspace_logo.png" class="social_item" />
					</a>
				
			</div>
			<p id="copy" style="margin-bottom:0">Copyright &copy All Rights Reserved</p>
			<br/>
			
			<div id="shadow">
				<img src="images/done.png" id="shadow_image"/>
				<p id="shadow_text">Some Error...!!</p>
			</div>
			
		</div>
		</center>
		<div id="lightbox" >
			<div class="nav">
				<img src="images/prev.ico" class="prev" title="Previous Image" id="lightbox35Prev" />
				<img src="images/next.ico" class="next" title="Next Image" id="lightbox35Next" />
			</div>
			<img id="lightbox_image" src="images/info.png" />
			<p title="close" id="close" >X</p>
			<p id="image_info">imagename</p>
		</div>
	</body>
</html>