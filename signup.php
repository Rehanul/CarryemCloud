<!DOCTYPE html>
<html>
	<head>
		<title>Signing up to Cloud Space..</title>
	</head>
	<body>
		<p>
		<?php
			//die if there no POST parameters
			if(!( isset($_POST['username']) || isset($_POST['password']) || isset($_POST['email']) || isset($_POST['contact'])))
			{
				die("Invaid Request");
			}
			//die if POST parameters are empty
			else if( $_POST['username']=='' || $_POST['password']=='' || $_POST['email']=='' || $_POST['contact']=='' )
			{
				die("Incomplete Data");
			}
			
			$con = mysql_connect("127.0.0.1", "root", "")
			or die("Unable to connect to SQL server");
			
			mysql_select_db("cloudspace",$con)
			or die("no database found");
			
			//check for unique username
			$querry = "SELECT username FROM user_info where username='".$_POST["username"]."'";
			$result = mysql_query("$querry",$con)
			or die('Invaid querry');
			
			$numofrows = mysql_num_rows($result);
			//die if user exist
			if( $numofrows >= 1 )
			{
				die("Sorry, the Username <b>".$_POST["username"]."</b> is already taken");
			}
			
			//ToDo
			//check for validations
			
			//ToDo
			//send a mail confirmation to user's email ID
			
			$sql = "INSERT INTO user_info (username, name, email, password, contact, isauthenticated , spaceused)
					VALUES
					('".$_POST['username']."', '".$_POST["username"]."', '".$_POST["email"]."', '".$_POST["password"].
					"', '".$_POST["contact"]."', '0', '0')";

			mysql_query("$sql",$con)
			or die('Invaid querry');
			
			mysql_close($con);
		?>
		</p>
		<p>Thanks for signing up</p>
		<p>Please confirm your email address by clicking on the link provided in a mail sent to your Email ID</p>
	</body>
</html>