<?php

	$con = mysql_connect("127.0.0.1", "root", "")
	or die("111");

	mysql_select_db("cloudspace",$con)
	or die("112");
		
	$result=mysql_query("SELECT SUM(size) FROM file_info WHERE username='".$_SESSION['username']
	."'") or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){
	$gb=(($row['SUM(size)'])/1048576)/1024;
	$percnt=($gb/5)*100;
			echo round($percnt,3). "%";
		
	}
	mysql_close($con);
?>