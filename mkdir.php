<?php
	include("check_session.php");

	if (! (isset($_GET['foldername']) || isset($_GET['path'])) ) 
	{
		die("212");
	}
	if( $_GET['foldername']=='' || $_GET['path']=='' )
	{
		die("211");
	}
	//ToDo
	//check for valid foldername
	$exist = 0;
	$entry = 0;
	
	if( file_exists($_SESSION['username'].$_GET['path'].'/'.$_GET['foldername']) )
	{
		$exist = 1;
	}
	
	$con = mysql_connect("127.0.0.1", "root", "") 
	or die("111");
			
	mysql_select_db("cloudspace",$con)
	or die("112");
	
	$check = "SELECT filename FROM file_info where username='".$_SESSION['username']."' AND path = '".$_GET['path']."' AND filename='".$_GET['foldername']."'";
	$result = mysql_query("$check",$con) or die("113");
	$numofrows = mysql_num_rows($result);
	if( $numofrows >= 1 )
	{
		$entry = 1;
	}
	
	//folder and entry both exist
	if( $exist==1 && $entry==1 )
	{
		die('876');
	}
	//entry in DB, folder does not exist
	else if( $exist==0 && $entry==1 )
	{
		//update table check inside folder
		mkdir($_SESSION['username'].$_GET['path']."/".$_GET['foldername'])
		or die("213");
		echo "986";
	}
	//folder exist, no entry in DB
	else if( $exist==1 && $entry==0 )
	{
		$querry = "INSERT INTO file_info (username, filename, size, isfile, type , path)
		VALUES('".$_SESSION['username']."','".$_GET['foldername']."','0','0','Folder','".$_GET['path']."')";
	
		mysql_query("$querry",$con) or die("113");
		echo "987";
	}
	//neither folder exist nor there's any entry in DB
	else
	{
		$querry = "INSERT INTO file_info (username, filename, size, isfile, type , path)
		VALUES('".$_SESSION['username']."','".$_GET['foldername']."','0','0','Folder','".$_GET['path']."')";
	
		mysql_query("$querry",$con) or die("113");
			
		mkdir($_SESSION['username'].$_GET['path']."/".$_GET['foldername'])
		or die("213");
		echo "success";
	}	
	mysql_close($con);
?>
