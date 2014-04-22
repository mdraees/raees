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

$outlet=$_SESSION['out_id'];

$res=mysql_query("SELECT `item_type` , `item_code` FROM `category` ")  or mysql_error();

$r1=mysql_query("SELECT  `item_code` FROM `category` ")  or mysql_error();

if ($_SERVER['REQUEST_METHOD'] == "POST") { 

// the following 4 lines are needed if your server has register_globals set to Off
$pname=$_POST['pname'];
$item_code=$_POST['item_code'];
$price=$_POST['price'];
$qty=$_POST['qty'];
$vendor=$_POST['vendor'];
$date=$_POST['date'];



$SQL = " INSERT INTO product ";
$SQL = $SQL . " (pname, item_code,qty, price, out_id, vendor, date ) VALUES ";
$SQL = $SQL . " ('$pname', '$item_code','$qty','$price','$outlet','$vendor','$date') ";
$result = mysql_query("$SQL");
if (!$result) { 
    echo("ERROR: " . mysql_error() . "\n$SQL\n");	}
$f=1;
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

<link rel="stylesheet" href="select/chosen.css" />
	<script src="select/jquery.js"></script>
	<script src="select/chosen.jquery.js"></script>
	
	<script>
		jQuery(document).ready(function(){
			jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
		});
	</script>

<link rel="stylesheet" type="text/css" href="date/jquery-ui.css">
		<script src="date/jquery-1.5.1.js"></script>
		<script src="date/jquery.ui.core.js"></script>
		<script src="date/jquery.ui.datepicker.js"></script>	
		<!--<script> 
			$(function() {
				var dates = $( "#from, #to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "from" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});
		</script> -->


</head>  
<body>  
<div id="header-wrapper" class="container"> 
<div id="user-account" class="row" > 
<div class="threecol"> <span>&nbsp;Welcome to Kriz Invoice</span> </div> 
<div class="ninecol last"><a href="../logout.php">Logout</a> <span>|</span></span> <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
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
	<li  class=""><a href="addExpense.php">+ Add Expense <span class="icon-forms"></span></a></li> 
	<li class="active"><a href="addStock.php">+ Add Stock <span class="icon-forms"></span></a></li> 
	<li><a href="viewStock.php">+ View Stock <span class="icon-charts"></span></a></li> 
	
</ul> 
</div>  

<div id="content" class="ninecol last">   
  <div class="panel-wrapper"> 
  <div class="panel"> 
  <div class="title"> 
  <h4>Add Stock</h4></div>  <div class="content"> 
  <!-- ## Panel Content  -->
  <?php if ($f==1)
{ echo '<div class="notice success"> <span><strong>Success:</strong> Item Added</span> </div>  ';}
else if ($f==2)
{ echo '<div class="notice error"> <span><strong>Error:</strong> Sorry... That action is not valid.</span> </div>';}
?>

<div class="inline"> 
<form method="post" action="" > 
<div class="group fixed"> <label>Product Name </label><select name="pname" class="chosen" style="width:200px;" required x-moz-errormessage="Select The Product"><option>Select The Product..</option><?php while($r=mysql_fetch_array($res)){
echo "<option > {$r['item_type']}</option>";
}?>
</select>
 </div>  
<div class="group fixed"> <label>Product Code </label> <select name="item_code" class="chosen" style="width:200px;" required x-moz-errormessage="Select The Item Code"><option value="">Select The Item Code</option><?php while($r=mysql_fetch_array($r1)){
echo "<option > {$r['item_code']}</option>";
}?>
</select></div>  
<div class="group fixed"> <label>Qty </label> <input title="Enter Amount" required="required" placeholder="Quantity" name="qty" type="text"  value="" size="32" maxlength="20" /></div>  
<div class="group fixed"> <label>Price </label> <input title="Enter Price" required="required" placeholder="Unit Price" name="price" type="text" value="" size="32" maxlength="20" /></div>  
<div class="group fixed"> <label>Vendor </label> <input title="Enter Vendor" required="required" placeholder="Vendor Name" name="vendor" type="text" value="" size="32" maxlength="20" /></div>  
<div class="group fixed"> <label>Date</label><input type="text" size="40" name="date" id="from1" placeholder="Select the Date " value="<?php echo date('Y-m-d');?>" class="input-text" readonly=" "/></div>  
 <br/>
	<input type="submit" class="button-blue" name="Submit" value="Add Product" />

</form>

  <!-- ## / Panel Content  --> </div> </div>  
  <div class="shadow"></div> </div>   
  
     </div> </div> </div>   
  </body>  
</html> 
<?php
}
?>