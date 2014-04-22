<?php
session_start();
session_destroy();
setcookie('username',$user,time() - 1*24*60*60);
setcookie('password',$password,time() - 1*24*60*60);
//you can change index.php with any url
header( 'Location: index.php' ) ;
?>