<?php
	include("check_session.php");

	if (! isset($_GET['search']) ) 
	{
		die("212");
	}
	if( $_GET['search']=='' )
	{
		die("214");
	}
	
	$con = mysqli_connect("127.0.0.1", "root", "","cloudspace")
	or die("111");
	
	$result = mysqli_query($con, "SELECT * FROM file_info WHERE username='".$_SESSION['username']
	."' AND filename LIKE('%".$_GET['search']."%') ORDER BY isfile") 
	or die("113");
	
	$count =0; //count the number of items[file+folder] returned

	while($row = mysqli_fetch_array($result))
	{
		$count++;
		$type = (explode("/",$row['type'])[0]);
		echo 	"<div class='item' tabindex='0'>";
		echo 		"<img id='icon' src=images/".$type.".png><br/>";
		echo 		"<p>".$row['filename']."</p>";
		echo 		"<div id='hidden'>";
		echo 			"<div id='filename' >".$row["filename"]."</div>";
		echo 			"<div id='filetype'>".$row["type"]."</div>";
		//ToDo
		//last 2 decimal points
		//MB
		echo 			"<div id='filesize'>".round($row["size"]/1024)."KB</div>";
		echo 			"<div id='filetime'>".$row["uploadedon"]."</div>";
		echo 		"</div>";
		echo 	"</div>";	
	}
	echo "<p id='hidden'>$count</p>";
	
	mysqli_close($con);
?>