<?php
# Start session:
session_start();

if (!(isset($_SESSION['username']) and isset($_SESSION['password'])))
{
?>
<p>You must first logon before you can access this page.</p>
<?php 
}
else
{

$f=0;
# Start MySQL connection:
include_once("../config.php");

if(isset($_POST['submit']))
{
$user=$_POST['user'];
$sql1=mysql_query("select * from user where username='$user'") or die("select the user");
while($row=mysql_fetch_array($sql1))
{
$id= $row['user_id'];
$name=$row['user_name'];
$address=$row['address'];
$mobile=$row['mobile'];
$email=$row['email'];
$username=$row['username'];
} 
}



if(isset($_POST['update'])){
$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$username=$_POST['username'];
$sql2=mysql_query("update user set user_name='$name',address='$address', mobile='$mobile',email='$email',username='$username' where user_id='$id' ") or die();
$f=1;

if(!$sql2) {
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
<title>Kriz Invoice - AdminUpdate</title>   
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


</head>  
<body>  
<div id="header-wrapper" class="container"> 
<div id="user-account" class="row" > 
<div class="threecol"> <span>&nbsp;Welcome to Kriz Invoice  </span> </div> 
<div class="ninecol last"> <a href="../logout.php">Logout</a> <span>|</span>  <span>Welcome, <strong>Admin!</strong></span> </div>
</div>  
<div id="user-options" class="row"> <div class="threecol">
<a href="index.php">
<img src="_layout/images/logo_by_me.png" alt="QuickAdmin"  class="logo" /></a></div>

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
	<li ><a href="update.php">+ Update<span class="icon-faq"></span></a></li>
	<li class="active"><a href="adminUpdate.php">+ User Update<span class="icon-users"></span></a></li>
	<li><a href="category.php">+ Category<span class="icon-tables"></span></a></li>
	
</ul> 
</div>  

<div id="content" class="ninecol last">   
  
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="tabs"> 
  <ul> 
  <li ><a href="#" rel="tab-01-content">User Update</a></li> 
    
	   
  </ul> 
  </div>  
  <div class="tabs-content"> <!-- ## Panel Content  -->  
  
  <div id="tab-01-content" class="active">
  <fieldset> 
  
  <?php
  
 if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong>User updated!</span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... That action is not valid.</span> </div>';}

  echo "<form target='_self' method='post'>";
echo "<fieldset>";
echo "<table class='nostyle'>";

echo "User Id:";
echo "<input type='text' size='40'  autocomplete='off' readonly='' name='id' class='input-text' value='$id'  />";
echo "<br/>";
echo "User Name:";
echo "<input type='text' size='40'  autocomplete='off' required title='Insert only letters of the alphabet'  pattern='[a-zA-Z ]+' name='name' class='input-text' value='$name'  />";
echo "<br/>";
echo "Address:";
echo  "<input type='text' required='required' size='40' name='address' class='input-text' value='$address'/>";
echo "<br/>";
echo "Mobile:";
echo "<input type='text' size='40' pattern='[0-9]+'  required  title='Insert only numbers' name='mobile' class='input-text' value='$mobile'  />";
echo "<br/>";
echo "Email";
echo "<input type='email' size='40' required title='Insert a valid email' name='email' class='input-text' 
value='$email' />";
echo "<br/>";
echo "User Name";
echo "<input type='text' size='40' autocomplete='off' required title='required'    name='username' class='input-text' value='$username' />";
echo " <p class='note'>User Name should be Unique.</p>";
echo "</table>";
echo "<br/>";
echo "<input type='submit' class='button-green' value='Update' name='update'/>";
echo "</fieldset>";
echo "</form>";


?>
  

</fieldset>


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