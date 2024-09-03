<?php

	$con = mysql_connect("127.0.0.1", "root", "")
	or die("111");

	mysql_select_db("cloudspace",$con)
	or die("112");
		
	$result=mysql_query("SELECT SUM(size) FROM file_info WHERE username='".$_SESSION['username']
	."'") or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){
	$gb=(($row['SUM(size)'])/1048576)/1024;
	$mb=($row['SUM(size)'])/1048576;
	if(round($gb) <= 0)
	{
		if( round($mb) <= 0)
		{
			$total=($row['SUM(size)'])/1024;
			echo round($total,3) ."KB";
		}
		else
		{
		$total=($row['SUM(size)'])/1048576;
		echo  round($total,3) ."MB";
		}
	}
	else
	{
		$total=(($row['SUM(size)'])/1048576)/1024;
		echo  round($total,3) ."GB";
	}
	
	
	}
	mysql_close($con);
?>