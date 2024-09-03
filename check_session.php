<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		if(isset($_GET['req_type']))
		{
			if($_GET['req_type']=="android")
			{
				die("767");
			}
		}
		else
		{
			echo	"<script type='text/javascript'>
						alert('Please Login to view contents');
						location.href='index.html';
					</script>";
		}
	}
?>