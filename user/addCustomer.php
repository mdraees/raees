<?php
# Start session:
session_start();
if (!(isset($_SESSION['username']) and isset($_SESSION['password'])))
 {
    header("Location: ../index.php");
    exit;
 }
else
 {
$f=0;
$cid ="";
# Start MySQL connection:
include_once("../config.php");

$outlet=$_SESSION['out_id'];


if ($_SERVER['REQUEST_METHOD'] == "POST") { 

// the following 4 lines are needed if your server has register_globals set to Off
$cname = $_POST['cname'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];

$SQL = " INSERT INTO customer ";
$SQL = $SQL . " (cname, address, email, contact,out_id) VALUES ";
$SQL = $SQL . " ('$cname', '$address','$email','$contact','$outlet') ";
$result = mysql_query("$SQL");
$cid=mysql_insert_id();
$f=1;
if (!$result) { 
    $f=2;	}

} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>Kriz Invoice - Dashboard</title>   
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
<div class="threecol"> <span>&nbsp;Welcome to KriZ Invoice</span> </div> 
<div class="ninecol last">  <a href="../logout.php">Logout</a> <span>|</span></span> <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
</div>  
<div id="user-options" class="row"> <div class="threecol">
<a href="dashboard.php">
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
	<li class="first"><a href="dashboard.php">Dashboard <span class="icon-dashboard"></span> </a></li> 
	<li class="active"><a href="addCustomer.php">+ Add Customers <span class="icon-users"></span></a></li>
	<li><a href="createquotation.php">+ Create Quotation <span class="icon-users"></span></a></li>
	<li><a href="addExpense.php">+ Add Expense <span class="icon-forms"></span></a></li> 
	<li><a href="addStock.php">+ Add Stock <span class="icon-forms"></span></a></li> 
	<li><a href="viewStock.php">+ View Stock <span class="icon-charts"></span></a></li> 

</ul> 
</div>  

<div id="content" class="ninecol last">   
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Add Customer</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
  <!-- ## Panel Content  -->
  <?php if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong>New Customer Added! with Customer # '.$cid.' </span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... That action is not valid.</span> </div>';}
?>

<form method="post" action="#" >  

<div class="inline"> 
<form method="post" action="#" > 
<div class="group fixed"> 
<label>Customer Name</label> <input title="Enter Customer Name" required="required" placeholder="Customer Name" name="cname" type="text" id="cname" value="" size="32" maxlength="20" autocomplete="off"  />
<p class="note">Username should be Unique.</p>  </div>  
<div class="group fixed">
 <label>Address</label> <textarea rows="5" cols="20" name="address" placeholder="Address"></textarea></div>  
<div class="group fixed"> <label>Contact Number</label> <input title="Enter Contact Number" required="required" placeholder="Contact Number" name="contact" type="text" id="contact" value="" size="32" maxlength="20" autocomplete="off"  /></div>  
<div class="group fixed"> <label>Email</label> <input title="Enter Email" placeholder="Email" name="email" type="email" id="email" value="" size="32" maxlength="20" autocomplete="off"  /> </div>  
    <br/>
	<input type="submit" class="button-green" name="Submit" value="Create Customer" />

</form>

  <!-- ## / Panel Content  --> </div> </div>  
  <div class="shadow"></div> </div>   
  
     </div> </div> </div>   
  </body>  
</html> 
<?php
}
?>