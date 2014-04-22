<?php

# Start session:
session_start();

if (!(isset($_SESSION['username']) and isset($_SESSION['password'])) and isset($_COOKIE['username']) and isset($_COOKIE['password']))
{
?>
<p>You must first logon before you can access this page.</p>
<?php 
}
else
{?>

<?php 
$f=0;
# Start MySQL connection:
include_once("../config.php");

$res=mysql_query("SELECT `out_id`,`location` FROM `outlets` ")  or mysql_error();

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
$name=$_POST["name"];
$addrs=$_POST['address'];
$cno=$_POST['number'];
$email=$_POST['email'];
$uname=$_POST['username'];
$pass=md5($_POST['password']);
$outlet=$_POST['outlet'];


$sql=mysql_query("INSERT INTO user VALUES ('','$name','$addrs','$cno','$email','$uname','$pass','$outlet')") or mysql_error();

$f=1;
if (!$sql) { 
    $f=2;	}

} 



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>Kriz Invoice - Add User</title>   
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
			$(document).ready(function () {
				$("#id_search").quicksearch("table tbody tr", {
					noResults: '#noresults',
					stripeRows: ['odd', 'even'],
					loader: 'span.loading'
				});
			});
</script>

<script type="text/javascript">
    function validate(form) { 
var e = form.elements; 

/* Your validation code. */ 
if(e['password'].value != e['cpassword'].value) { 
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
<div class="threecol"> <span>&nbsp;Welcome to Kriz Invoice</span> </div> 
<div class="ninecol last"> <a href="../logout.php">Logout</a> <span>|</span>  <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
</div>  
<div id="user-options" class="row"> <div class="threecol">
<a href="index.php">
<img src="_layout/images/logo_by_me.png" alt="QuickAdmin" class="logo" /></a></div>

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
    <li class="active"><a href="index.php">+ Add User <span class="icon-users"></span> </a></li> 
	<li><a href="viewstock.php">+ View Stock<span class="icon-charts"></span></a></li>
	<li><a href="update.php">+ Update<span class="icon-faq"></span></a></li>
	<li><a href="adminUpdate.php">+ User Update<span class="icon-users"></span></a></li>
	<li><a href="category.php">+ Category<span class="icon-tables"></span></a></li>
	
</ul> 
</div>  

<div id="content" class="ninecol last">   
  
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="tabs"> 
  <ul> 
  <li ><a href="" rel="tab-01-content">ADD NEW USER</a></li> 
    
	   
  </ul> 
  </div>  
  <div class="tabs-content"> <!-- ## Panel Content  -->  
  
  <div id="tab-01-content" class="active">
  <?php if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong>New Admin is  Added!</span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... User Already Exists.</span> </div>';}
?>
  
  <form target="_self" method="post" onSubmit="return validate(this);"> 

 
  <fieldset>
				
	<table class="nostyle">
					
 Name :
<span style="margin-left:80px"> 
<input type="text" size="28" autocomplete="off"  pattern="[a-zA-Z ]+" required="required" placeholder="Name" required title="Insert only letters of the alphabet" id="input01" name="name" class="input-text" />
</span>

<br/>
						


Mobile Number:
<span style="margin-left:30px">
<input type="text" size="28" autocomplete="off" name="number" required="required"  pattern="[0-9]+" placeholder="Mobile Number" maxlength="10" required  title="Insert only numbers"class="input-text" />
</span>

<br/>

Email:
<span style="margin-left:88px">
<input type="email"  id="email"  size="28" name="email" placeholder="Email" autocomplete="off"  class="input-text" />
</span>
<br/>
				
Address:
<span style="margin-left:68px">
<input type="text" size="28" name="address" autocomplete="off" required="required" placeholder="Address" class="input-text" />
</span>
<br/>
					
User Name:
<span style="margin-left:58px">
<input type="text" size="28" name="username" autocomplete="off"  required="required" placeholder="user Name" class="input-text" />
</span> <p class="note">User Name should be Unique.</p>

					
Password:
<span style="margin-left:63px">
<input type="password" size="28" name="password" autocomplete="off" required="required" placeholder="Password" class="input-text" />
</span>
<br/>
					
Confirm Password:
<span style="margin-left:63px">
<input type="password" size="28" name="cpassword" autocomplete="off" required="required" placeholder="Confirm Password" class="input-text" />
</span>
<br/>
					
Outlet:<br/> 
<select name="outlet" required x-moz-errormessage="Select The Outlet" >
<option value="" selected="selected">Please Select</option>
<?php while($r=mysql_fetch_array($res)){
echo "<option value='{$r['out_id']}'> {$r['location']}</option>";
}?>
</select>
<br/> 
<br/>					 

<input type="submit" class="button-green"  name="submit" value="Add User"/>	

</table>

</fieldset>
</form>					 
					 
					
					
					
					
					
					
			

			
				
		

  </div>  
  
   

  <!-- ## / Panel Content  --> </div> </div>  
  
  <div class="shadow"></div> </div>
 
  
		
		
  <div class="panel-wrapper"> 
   </div> </div>
<div class="shadow"></div> </div>   
  
     </div> </div> </div>   
  </body>  
</html> 

<?php
}
?>
