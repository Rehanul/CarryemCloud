<?php
	include("check_session.php");
	
	if (!isset($_FILES["file"]))
	{
		die("563");
	}
	
	// ?? Whats this ??
	if ($_FILES["file"]["error"] > 0)
	{
		echo "564";
	}
	if(! isset($_GET['path']) ) 
	{
		die("212");
	}
	if( $_GET['path']=='' )
	{
		die("212");
	}
	
	//ToDo
	//check for valid filename
	
	$exist = 0;
	$entry = 0;
	$filename = $_FILES["file"]["name"];//str_replace(' ', '_',$_FILES["file"]["name"]);
	
	if( file_exists($_SESSION['username'].$_GET['path'].'/'.$filename) )
	{
		$exist = 1;
	}
	
	$con = mysql_connect("127.0.0.1", "root", "")
	or die("111");

	mysql_select_db("cloudspace",$con)
	or die("112");
	//ToDo
	// replace ' from string
	$check = "SELECT filename FROM file_info where username='".$_SESSION['username']."' AND path = '".$_GET['path']."' AND filename='".$_FILES["file"]["name"]."'";
	
	$result = mysql_query("$check",$con) or die("113");
	$numofrows = mysql_num_rows($result);
	if( $numofrows >= 1 )
	{
		$entry = 1;
	}
	
	if( $exist==1 && $entry==1 )
	{
		mysql_close($con);
		die('876');
	}
	//entry in DB, file does not exist
	else if( $exist==0 && $entry==1 )
	{
		//ToDo
		//update entry
		move_uploaded_file($_FILES['file']['tmp_name'],$_SESSION['username'].$_GET['path']."/".$filename)
		or die("672");
		mysql_close($con);
		die("986");
	}
	else
	{
		if($exist==1)
		{
			//delete file
		}
		
		$sql = "INSERT INTO file_info (username, filename, size, type , path)
		VALUES('".$_SESSION['username']."','".$_FILES["file"]["name"]."','".$_FILES["file"]["size"]."','".$_FILES["file"]["type"]."','".$_GET['path']."')";

		
		mysql_query("$sql",$con)
		or die("113");
		
		move_uploaded_file($_FILES['file']['tmp_name'],$_SESSION['username'].$_GET['path']."/".$filename)
		or die("311");
		
		$type = (explode("/",$_FILES["file"]["type"])[0]);
		echo 	"<div class='item' tabindex='0'>";
		echo 		"<img id='icon' src=images/".$type.".png><br/>";
		echo 		"<p>".$_FILES["file"]["name"]."</p>";
		echo 		"<div id='hidden'>";
		echo 			"<div id='filename' >".$_FILES["file"]["name"]."</div>";
		echo 			"<div id='filetype'>".$_FILES["file"]["type"]."</div>";
		echo 			"<div id='filesize'>".$_FILES["file"]["size"]."MB</div>";
		echo 			"<div id='filetime'>".date("Y-m-d").' '.time()."</div>";
		//ToDo error in time
		echo 		"</div>";
		echo 	"</div>";
	}
	mysql_close($con);
?>
