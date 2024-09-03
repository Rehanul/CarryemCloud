<?php
	include("check_session.php");
	header("Content-type: image/jpg");
//	echo $_SESSION['username'].$_GET['path'].'/'.$_GET["imagename"];
	if($_GET['path']=="/")
	readfile($_SESSION['username'].'/'.$_GET["imagename"]);
	else
	readfile($_SESSION['username'].$_GET['path'].'/'.$_GET["imagename"]);

	//readfile("Rehan/find.png");
	
?>