<?php
$dbhost = 'localhost';
$dbuser = 'root';//user of the database
$dbpass = '';//password here

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');//Connect to MySQL

$db = 'abhatrav_cloudbill_stock';//database name
mysql_select_db($db); // choose databse
?>