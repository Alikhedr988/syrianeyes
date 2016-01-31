<?php
//1. create the db connection
//it's better to define constants than to define variables for the db connections as in the following
if( $_SERVER['HTTP_HOST']=="localhost"){
	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","syrianeyes");
	//define("DATABASE_NAME","apw");
}else{
define("DB_SERVER","syrianeyes.org");
	define("DB_USER","U2151994");
	define("DB_PASS","najda123now");
	define("DB_NAME","DB2151994");
}
//some call the next one sql or db or mysqli.. depends on the developer
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
mysqli_query($connection,"SET NAMES 'utf8'"); 
mysqli_query($connection,'SET CHARACTER SET utf8');
//test if connection occured
if (mysqli_connect_errno())
{
    die('Database connection failed: ' . mysqli_connect_error() . " (" . mysqli_connect_errno() . ") "); 
}
?>