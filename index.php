<?php


/*
		Author: Varadaraj (Project Manager)
		Description: login page entering
		Copyright: trionixit.com
*/

# Connect to file that makes MySQL work:
include_once("config.php");



# Process form when $_POST data is found for the specified form:
if((isset($_POST['login'])) and (!empty($_POST['password']))) {

# Start session:
session_start();

# Define variables from Login form:
$user = $_POST['username'];
$password = md5($_POST['password']);

$sql = mysql_query("SELECT * FROM  `admin` WHERE `username` = '$user' and `password`='$password'");
$info = mysql_fetch_array($sql);

$res = mysql_query("SELECT * FROM `user` WHERE `username`='$user' and `password`='$password'");
$row = mysql_fetch_array($res);	


 
# Forward if email and password match user table:
if($info['password'] == $password) {
        
 		   
		   header("Location: admin/index.php");
		   $_SESSION['username']=$_POST['username'];
		   $_SESSION['password']=$_POST['password'];
		   setcookie('username',$user,time() + 1*24*60*60);
		   setcookie('password',$password,time() + 1*24*60*60);
	}
		   
elseif($row['password'] == $password) {
 		   
		   header("Location: user/dashboard.php");
		   $_SESSION['username']=$_POST['username'];
		   $_SESSION['password']=$_POST['password'];
		   setcookie('username',$user,time() + 1*24*60*60);
		   setcookie('password',$password,time() + 1*24*60*60);
}
		   		   

else {

$w="Invalid Username or Password";
}
 		   

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 <html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
 <title>Quickadmin - Dashboard</title>  
 <!-- 1140px Grid styles for IE --> 
 <!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->  
 <!-- The 1140px Grid --> 
 <link rel="stylesheet" href="_layout/1140.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="_layout/styles.css" type="text/css" media="screen" />
<link rel='stylesheet' href='_themes/default.css' type='text/css' media='screen' />   
<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers--> 

<script type="text/javascript">
	//function validateForm()
	//{
	//var x=document.forms["Login_form"]["username"].value;
	//var y=document.forms["Login_form"]["password"].value;
	//if (x==null || x=="" || y==null || y=="")
	//  {
	//  alert("Both Fields must be filled out");
	//   return false;
	//  }
	//}
	</script>
	
</head>  
<body class="texture">    

<div class="container"> 

<div class="row">  
<div class="panel-wrapper panel-login"> 
<div class="panel"> <div class="title"> <h4>Login</h4></div>  
<?php { ?>
<div class="content"> <!-- ## Panel Content  -->  
<form  name="Login_form" method="post" target="_self"  onSubmit="return validateForm()">
<b style="color:#FF0000" style="font-size:14px"> <?php //echo $w;?> 
<div> <input type="text"  name="username" placeholder="username"  required title="Please enter the user name"/></div>  
<div> <input type="password" name="password"  placeholder="password" required title="Please enter the password"/> </div>  
<div> <input type="submit" name="login" value="Login" class="button-blue submit"/>  </div> </form>  

<!-- ## / Panel Content  --> </div>


<?php  } ?> 
</div>  <div class="shadow"></div> </div>  
<div class="login-details"> <!--<p>Forgot your password? &nbsp;&nbsp;&nbsp;<a href="">Click here</a></p>--> </div>
</div> </div>    
</body>  
</html> 