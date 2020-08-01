<?php
//error_reporting(0);
date_default_timezone_set("Asia/Calcutta");
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
$date=date("d-m-Y");
ini_set('max_execution_time', 6000);


//database variables
$dbhost="localhost";
$dbuser="root";
$dbpass='';
$dbname="reg_form";


//database connection and settings
$con=mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname,$con) or die(mysql_error());
?>
