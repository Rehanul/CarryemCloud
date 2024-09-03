<?php
//ToDo
//some error in anonymous access
include("check_session.php");
header("Content-type: image/png");
if(!file_exists($_SESSION['username'].'/'.'profile_pic.png'))
{
	readfile("images/profile_pic.png");
}
readfile($_SESSION['username']."/profile_pic.png");
?>