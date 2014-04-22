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
# Start MySQL connection:
include_once("../config.php");
$outlet=$_SESSION['out_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>Kriz Invoice - Payment History</title>   
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
	<li><a href="addCustomer.php">+ Add Customers <span class="icon-users"></span></a></li>
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
  <h4>Payment History</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
  <form action="" method="post">
			<fieldset>
				Customer ID:<input type="text" name="cust_id" value="" required="required" placeholder="Enter Customer ID" size="32" maxlength="20"/><br/>
				<input type="submit" value="Submit" class="button-blue"/> 
				</fieldset>
  </form>	
  
  <!-- ## / Panel Content  --> </div> </div>  
  
  <div class="shadow"></div> </div>
 
  
<?php 

if (isset($_POST['cust_id'])) {
 
$cust_id=$_POST['cust_id'];


$s=mysql_query("select `cname`, `contact` from `customer` where `cust_id`=$cust_id and out_id='$outlet'");
$rw = mysql_fetch_array($s);

$cname=$rw['cname'];
$contact=$rw['contact'];


?>		
		
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Search</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
  <!-- ## Panel Content  --> 
  <br/>
<p style="font-size:15px;margin-left:15px">Customer Name:<b> <?php echo $cname; ?></b> | Contact:<b> <?php echo $contact; ?></b></p>
  <form action="#">
			<fieldset>
				<input type="text" name="search" value="" id="id_search" placeholder="Search" ize="32" maxlength="20"/> <span class="loading">Loading...</span>
			</fieldset>
		</form>	
<?php
$sql2=mysql_query("SELECT sum( amt ) AS total FROM `payment_history` WHERE `cust_id`=$cust_id and out_id='$outlet' ") or die(mysql_error());
while($row = mysql_fetch_assoc($sql2))
{	
$total = $row['total'];
echo "
<p style=\"margin-left:15px\"><b>Total Amount</b>:
<b>Rs. $total</b></p>
";
} 
?>
<table id="sample-table-sortable" class="sortable resizable"> 
<thead>
<tr>
	<th>Amount</th>
	<th>Date</th>
</tr>
</thead>
<tbody>

<?php

$sql1=mysql_query("SELECT `amt` ,`date` FROM `payment_history` WHERE `cust_id` =$cust_id order by date and out_id='$outlet'") or die(mysql_error());
while($row = mysql_fetch_assoc($sql1))
{	
	$amt = $row["amt"];
	$date = $row["date"];

echo "<tr>
<td> $amt</td>
<td> $date</td>
<tr/>
";
} 
?>

</tbody>
</table>

<?php

}

?>

  <!-- ## / Panel Content  --> </div> </div>  
  <div class="shadow"></div> </div>   
  
     </div> </div> </div>   
  </body>  
</html> 

<?php
}
?>