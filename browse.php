<?php
	include("check_session.php");

	if (! isset($_GET['explore']) ) 
	{
		die("212");//Invalid Request
	}
	if( $_GET['explore'] == '' )
	{
		die("214");//Empty Request
	}
	
	
	$reqtype="web";
	//check if request from android or webpage
	if(isset($_GET['req_type']))
	{
		$reqtype = $_GET['req_type'];
	}
	
	//$con = mysqli_connect("127.0.0.1","carryem_carryem","$3cureDatabase","carryem_cloudspace")
	$con = mysqli_connect("127.0.0.1", "root", "","cloudspace")
	or die("111");//Unable to connect to SQL server
	

	if( $reqtype == "android" && $_GET['explore'] == "*" )
	{
		$result = mysqli_query($con, "SELECT * FROM file_info WHERE username='".$_SESSION['username']
		."' ORDER BY isfile")
		or die("113");//Querry failed
	}
	else
	{
		$result = mysqli_query($con, "SELECT * FROM file_info WHERE username='".$_SESSION['username']
		."' AND path='".$_GET['explore']."' ORDER BY isfile") 
		or die("113");//Querry failed
	}
	$count =0; //count the number of items[file+folder] returned

	//if req is from android
	if( $reqtype=="android" && $_GET['explore']=="*" )
	{
		while($row = mysqli_fetch_array($result))
		{
			$output[$count++] = array('filename' => $row['filename'], 'size' => $row['size'],
			'isfile' => $row['isfile'], 'type' => $row['type'], 'uploadedon' => $row['uploadedon'],
			'path' => $row['path']);
		}
		echo json_encode($output);
	}
	else//if req is from web
	{
		$size = 0;
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
			
			//calculating size of folder
			if($row['type']=="Folder")
			{
				if($_GET['explore']=="/")
					$sizequery = "SELECT SUM(size) AS size FROM file_info WHERE username='".$_SESSION['username'].
					"' AND path LIKE('/".$row['filename']."%')";
				else
					$sizequery = "SELECT SUM(size) AS size FROM file_info WHERE username='".$_SESSION['username'].
					"' AND path LIKE ('".$_GET['explore']."/".$row['filename']."%')";
			
				$output = mysqli_query($con, $sizequery) or die('113');
				$rowsize = mysqli_fetch_array($output);
				$size = $rowsize['size'];
			}
			else
			$size = $row["size"];
			
			//converting size in Bytes KB MB GB
			$sizetype = "Bytes";
			
			if($size>900)
			{
				$size = $size/1024;
				$sizetype = "KB";
			}
			if($size>900)
			{
				$size = $size/1024;
				$sizetype = "MB";
			}
			if($size>900)
			{
				$size = $size/1024;
				$sizetype = "GB";

			}
			
			echo 			"<div id='filesize'>".round($size,2).$sizetype."</div>";
			echo 			"<div id='filetime'>".$row["uploadedon"]."</div>";
			echo 		"</div>";
			echo 	"</div>";	
		}
		echo "<p id='hidden'>$count</p>";
	}
	mysqli_close($con);
?>