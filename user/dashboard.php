<?php
# Start session:
session_start();
if (!(isset($_SESSION['username']) and isset($_SESSION['password']))and isset($_COOKIE['username']) and isset($_COOKIE['password']))
 {
    header("Location: ../index.php");
    exit;
 }
else
 {
$f=0;
# Start MySQL connection:
include_once("../config.php");
$user= $_SESSION['username'];
$res = mysql_query("SELECT  `out_id` FROM user WHERE username =  '$user'")  or die(mysql_error());
$row1 =mysql_fetch_array( $res);
$outlet=$_SESSION['out_id']=$row1['out_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
<title>My Invoice</title>   
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
<div class="threecol"> <span>Welcome to Kriz Invoice System</span> </div> 
<div class="ninecol last"> <a href="../logout.php">Logout</a> <span>|</span> </span> <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
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
	<li class="first active"><a href="dashboard.php">Dashboard <span class="icon-dashboard"></span> </a></li> 
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
  <div class="tabs"> 
  <ul> 
  <li class="active"><a href="#" rel="tab-01-content">Welcome</a></li> 
    <li><a href="#" rel="tab-02-content">Create Invoice</a></li> 
  <li><a href="#" rel="tab-03-content">Make Payment</a></li> 
  </ul> 
  </div>  
  <div class="tabs-content"> <!-- ## Panel Content  -->  
  
  <div id="tab-01-content" class="active"> 
  <h2>Welcome</h2>
  <p> Some Message to be Displayed</p>

  </div>  
  
  <div id="tab-02-content"> 
  <h2> Create Invoice</h2>

<form id="" action="invoice.php" method="post" enctype="multipart/form-data">
  Customer ID : <input title="Enter Customer ID" required="required" placeholder="Customer ID" name="cust_id" type="text" id="cust_id" value="" size="32" maxlength="20" /><br/>
  TAX:<br/><select name="tax">
  <option value="">Select...</option>
  <option value="1">VAT Tax</option>
  <option value="2">Service TAX</option>
</select>
<br/>
&nbsp; <br/> <input type="submit" name="Submit" class="button-white" value="Create Invoice" />

</form>
  </div>  
  
  <div id="tab-03-content"> 
<h2> Make payment</h2>

<form id="add customer" action="payment.php" method="post" enctype="multipart/form-data">
Customer ID : <input title="Enter Customer ID" required="required" placeholder="Customer ID" name="cust_id" type="text" id="cust_id" value="" size="32" maxlength="20" />
<br/>  Amount: <input title="Enter Amount" required="required" placeholder="Amount" name="amount" type="text" id="amount" value="" size="32" maxlength="20" />
<br/>
 <input type="submit" class="button-white" name="Submit" value="Payment" />
</form>
</div>  

  <!-- ## / Panel Content  --> </div> </div>  
  
  <div class="shadow"></div> </div>
 
  
		
		
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>My Customers</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
  <!-- ## Panel Content  -->  
  <form action="#">
			<fieldset>
				<input type="text" name="search" value="" id="id_search" placeholder="Search" ize="32" maxlength="20"/> <span class="loading">Loading...</span>
			</fieldset>
		</form>	
<table id="sample-table-sortable" class="sortable resizable"> 
 <thead> 
  <tr> 
  <th>CustID</th>
	<th>Name </th>
	<th>Address</th>
	<th>Email</th>
	<th>Contact</th>
	<th>Balance</th>
  </tr> 
 </thead> 
 
  <tbody> 
 <?php 
$sql1=mysql_query("SELECT  `cust_id` ,  `cname` ,  `Address` ,  `Email` ,  `Contact`, `Balance` FROM  `customer` Where out_id='$outlet' ORDER BY `cust_id`  ");
while($row = mysql_fetch_assoc($sql1))
{	$cust_id = $row["cust_id"];
	$cname = $row["cname"];
	$address = $row["Address"];
	$email = $row["Email"];
	$contact = $row["Contact"];
	$bal = $row["Balance"];

echo "<tr>
<td> $cust_id</td>
<td> $cname</td>
<td> $address</td>
<td> $email</td>
<td> $contact</td>
<td align=right><b> $bal</b></td>
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