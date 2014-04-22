<?php
# Start session:
session_start();
if (!(isset($_SESSION['username']) and isset($_SESSION['password'])))
 {
    header("Location: index.php");
    exit;
 }
else
 {

$f=0;
# Start MySQL connection:
include_once("../config.php");
$r = mysql_query("SELECT `password` from admin LIMIT 1");
$rw = mysql_fetch_array($r);

if(isset($_POST['oldpass'])){
$old=md5($_POST['oldpass']);


$newpass=md5($_POST['pass']);

if($old == $rw['password']){


$usql1="UPDATE  `admin` SET  `password` =  '$newpass'";


$upd1=mysql_query($usql1);
$f=1;
}
else {
$f=2;
}

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>Kriz Invoice - Settings</title>   
<!-- 1140px Grid styles for IE --> 
<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->  
<!-- The 1140px Grid --> 
<link rel="stylesheet" href="_layout/1140.css" type="text/css" media="screen" />   
<link rel="stylesheet" href="_layout/styles.css" type="text/css" media="screen" /> 
<link rel='stylesheet' href='_themes/default.css' type='text/css' media='screen' />   
<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers--> 
<script type="text/javascript" src="_layout/scripts/css3-mediaqueries.js"></script>   <!-- Fonts --> 
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold|PT+Sans+Narrow:regular,bold|Droid+Serif:iamp;v1' rel='stylesheet' type='text/css' />
<!-- Scripts --> <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js'></script>

<!-- Forms Elemets --> <script type='text/javascript' src='_layout/scripts/jquery.uniform/jquery.uniform.min.js'></script> 
<link rel='stylesheet' href='_layout/scripts/jquery.uniform/uniform.default.css' type='text/css' media='screen' />   
<!-- Table sorter --> <script type='text/javascript' src='_layout/scripts/jquery.tablesorter/jquery.tablesorter.min.js'></script> 
<script type='text/javascript' src='_layout/scripts/table.resizable/resizable.tables.js'></script>   <!-- Lightbox - Colorbox --> 
<script type='text/javascript' src='_layout/scripts/jquery.colorbox/jquery.colorbox-min.js'></script> 
<link rel='stylesheet' href='_layout/scripts/jquery.colorbox/colorbox.css' type='text/css' media='screen' />   
<script type='text/javascript' src='_layout/custom.js'></script>  
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
<script type="text/javascript">
    function validate(form) { 
var e = form.elements; 

/* Your validation code. */ 
if(e['pass'].value != e['rpass'].value) { 
alert('Your passwords do not match. Please type more carefully.'); 
return false; 
} 
return true; 
}
</script>


</head>  
<body>  
<div id="header-wrapper" class="container"> 
<div id="user-account" class="row" > 
<div class="threecol"> <span>&nbsp; Welcome to Kriz Invoice</span> </div> 
<div class="ninecol last"> <a href="../logout.php">Logout</a> <span>|</span></span> <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
</div>  
<div id="user-options" class="row"> <div class="threecol">
<a href="index.php">
<img class="logo" src="_layout/images/logo_by_me.png" alt="QuickAdmin" /></a></div>

<div class="ninecol last fixed">
 <ul class="nav-user-options"> 
		<?php require_once("main_menu.php");?>

</ul>  
</div> 
</div> 
</div>  

<div class="container"> 
<div class="row">  
<div id="sidebar" class="threecol"> 
<ul id="navigation"> 
	 <li class="first"><a href="index.php">+ Add User <span class="icon-users"></span> </a></li> 
	<li><a href="viewstock.php">+ View Stock<span class="icon-charts"></span></a></li>
	<li><a href="update.php">+ Update<span class="icon-faq"></span></a></li>
	<li><a href="adminUpdate.php">+ User Update<span class="icon-users"></span></a></li>
	<li><a href="category.php">+ Category<span class="icon-tables"></span></a></li>
</ul> 
</div>  

<div id="content" class="ninecol last">   
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Change Password</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
<?php if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong>Password Changed!</span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... That action is not valid.</span> </div>';}
?>
  <form action="" method="post" onsubmit="return validate(this);"> 
			<fieldset>
				Old:<input type="password" name="oldpass" value="" required="required" size="32" maxlength="20"/>
				<br/>				
				New Password:<input type="password" name="pass" value="" required="required" size="32" autocomplete="off" maxlength="20"/><br/>
				Retype Password:<input type="password"  name="rpass" value="" required="required" size="32" autocomplete="off" maxlength="20"/>					
				<br/>
				<input type="submit" class="button-blue" value="Change Password"/> 
			</fieldset>
  </form>
  
  <!-- ## / Panel Content  --> </div> </div>  
  
  <div class="shadow"></div> </div>
  
  
 

   
     </div> </div> </div>   
  </body>  
</html> 
<?php
}
?>