<?php
	include("check_session.php");
	
	//die if there no POST parameters
			if(!(isset($_POST['password']) || isset($_POST['email']) || isset($_POST['contact']) || isset($_POST['name'])))
			{
				die("Invaid Request");
			}
			//die if POST parameters are empty
			else if(  $_POST['password']=='' || $_POST['email']=='' || $_POST['contact']=='' ||$_POST['name']=='' )
			{
				die("Incomplete Data");
			}
			
			$con = mysql_connect("127.0.0.1", "root", "")
			or die("Unable to connect to SQL server");
			
			mysql_select_db("cloudspace",$con)
			or die("no database found");
	
	
		$sql = "UPDATE user_info SET  password='".$_POST["password"]."',name='".$_POST["name"]."',email='".$_POST["email"]."',contact='".$_POST["contact"]."' WHERE username='".$_SESSION['username']."'";
					

			mysql_query("$sql",$con)
			or die('Invaid querry');
			
  mysql_close($con);

    header("Location:home.php");

		?>