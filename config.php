<?php
$dbhost = '127.0.250.1:3306';
$dbuser = 'adminQMjwDl7';//user of the database
$dbpass = 'qbgK6Ym6ZjF2';//password here

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');//Connect to MySQL

$db = 'rkinvoice';//database name
mysql_select_db($db); // choose databse
?>