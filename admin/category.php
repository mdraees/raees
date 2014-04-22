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

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
$item=$_POST['item'];
$code=$_POST['code'];

$res=mysql_query("INSERT INTO category VALUES ( '' ,'$item' , '$code' )")   or mysql_error();
$f=1;
if (!$res) { 
    $f=2;	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>Kriz Invoice - Category</title>   
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
<div class="threecol"> <span>&nbsp;Welcome to Kriz Invoice</span> </div> 
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
	<li  ><a href="viewstock.php">+ View Stock<span class="icon-charts"></span></a></li>
	<li><a href="update.php">+ Update<span class="icon-faq"></span></a></li>
	<li><a href="adminUpdate.php">+ User Update<span class="icon-users"></span></a></li>
	<li class="active"><a href="category.php">+ Category<span class="icon-tables"></span></a></li>

</ul> 
</div>  
<div id="content" class="ninecol last">
<div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Add Product</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
   <?php if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong>New Product is  Added!</span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... Product Already Exists.</span> </div>';}
?>
  <form action="" method="post">
			<fieldset>
			Product Name:
			<input type="text" name="item" value="" placeholder="Enter the Product" required="required"/><br/>
			Product Code:
			<input type="text" name="code" value="" placeholder="Enter the Code" required="required"/><br/>
			
				<input type="submit" value="Submit" class="button-blue"/> 
				</fieldset>
  </form>	
  
  <!-- ## / Panel Content  --> </div> </div>  
  <div class="shadow"></div> </div>
 
  
  
   
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Search</h4></div>  <div class="content"> 
  <!-- ## Panel Content  -->  
  <form action="#">
			<fieldset>
				<input type="text" name="search" value="" id="id_search" placeholder="Search" ize="32" maxlength="20"/> <span class="loading">Loading...</span>
			</fieldset>
		</form>	
<table id="sample-table-sortable" class="sortable resizable"> 
 <thead> 
  <tr> 
  <th>Product Name</th>
	<th>Item Code </th>
	
  </tr> 
 </thead> 
 
  <tbody> 
 <?php 
 

$sql1=mysql_query("SELECT  `item_type` ,  `item_code` FROM  `category`");
while($row = mysql_fetch_assoc($sql1))
{	$pname = $row["item_type"];
	$item_code = $row["item_code"];
	
	

echo "<tr>
<td> $pname</td>
<td> $item_code</td>

<tr/>
";
} 

?>
  </tbody> 
  </table>  
  <!-- ## / Panel Content  --> </div> </div>  
  <div class="shadow"></div> </div>   
  
     </div> </div> </div>   
  </body>  
</html>
<?php 
}
?> 