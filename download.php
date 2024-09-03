<?php
	include("check_session.php");
	
	if (! isset($_GET['filename']) ) 
	{
		die("212");
	}
	if( $_GET['filename']=='' )
	{
		die("211");
	}
	//$tr = $_GET['path'];
	if(!file_exists($_SESSION['username'].$_GET['path'].'/'.$_GET['filename']))
	{
		echo $_SESSION['username'].$_GET['path'].'/'.$_GET['filename'];
		die('555');
	}
	else
	{
$path = $_SESSION['username'].$_GET['path'].'/'.$_GET['filename'];

$size=filesize($path);

$fm=@fopen($path,'rb');
if(!$fm) {
  // You can also redirect here
  header ("HTTP/1.0 404 Not Found");
  die();
}

$begin=0;
$end=$size;

if(isset($_SERVER['HTTP_RANGE'])) {
  if(preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)) {
    $begin=intval($matches[0]);
    if(!empty($matches[1])) {
      $end=intval($matches[1]);
    }
  }
}

if($begin>0||$end<$size)
  header('HTTP/1.0 206 Partial Content');
else
  header('HTTP/1.0 200 OK');

//header("Content-Type: image/jpg");
header('Accept-Ranges: bytes');
header('Content-Length:'.($end-$begin));
header("Content-Disposition: attachment; filename=".basename($path));
header("Content-Range: bytes $begin-$end/$size");
header("Content-Transfer-Encoding: binary\n");
header('Connection: close');

$cur=$begin;
fseek($fm,$begin,0);

while(!feof($fm)&&$cur<$end&&(connection_status()==0))
{ 
	print fread($fm,min(1024*16,$end-$cur));
	$cur+=1024*16;
	usleep(1000);
}
die();
}
 ?>