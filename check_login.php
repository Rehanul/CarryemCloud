<?php
	if( !( isset($_POST['username']) || isset($_POST['password']) ) || $_POST['username']=="" || $_POST['password']=="" )
	{
		echo '<script type="text/javascript"> alert(\'Please provide Username and Password\'); location.href = "index.html"; </script>';
		die('');
	}
	
	$con = mysql_connect("127.0.0.1", "root", "") or die("There was some error in connecting to database");
	mysql_select_db("cloudspace",$con) or die("There was some error in selecting the database");
	
	$sql="SELECT name,username,isauthenticated FROM user_info WHERE username='".$_POST['username']."' and password='".$_POST['password']."'";
	$result = mysql_query($sql) or die ("There was some error in processing the Query");

	$numofrows = mysql_num_rows($result);
	if( $numofrows==1 )
	{
		$row = mysql_fetch_array($result);
		
		if($row['isauthenticated']!="1")
		{
			echo '<script type="text/javascript"> alert(\'You Email has not been confirmed yet!\nPlease, verify your email address by clicking on the link provided in Email sent to your mail address\'); location.href = "index.html"; </script>';
			die('');
		}
		
		session_start();
		$_SESSION['name'] = $row["name"];
		$_SESSION['username'] = $row["username"];
		if($_POST["req_type"]=="android")
		{
			echo "true";
		}
		else
		{
			header("location:home.php");
		}
	}
	else if( $numofrows>1 )
	{
		die("More than two users found");
	}
	else
	{
		if($_POST["req_type"]=="android")
		{
			echo "incorrect";
		}
		else
		{
			echo '<script type="text/javascript"> alert(\'Incorrect Username or Password\'); location.href = "index.html"; </script>';
		}
	}
mysql_close($con);
?>