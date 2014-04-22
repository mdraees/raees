<?php
session_start();
if (!(isset($_SESSION['username']) and isset($_SESSION['password'])))
 {
    header("Location: index.php");
    exit;
 }
else
 {
 
$f=0;
include_once("../config.php");

// your database code 

if (count($_POST)) {

   if (isset($_POST['cust_id'])) { 

/*do whatever is needed*/
$cust_id = $_POST['cust_id'];
$_SESSION['cust_id']=$cust_id;
$tax = $_POST['tax']; 
$r = mysql_query("SELECT `service`, `vat` from tax");
$rw = mysql_fetch_array($r);


if ($tax == 1)
{
$tax=$rw['vat'];
$tax1="VAT";
$tax2="14%";

}
else
{
$tax=$rw['service'];
$tax1="Service";
$tax2="12.36%";
}
$_SESSION['tax']=$tax;
$_SESSION['tax1']=$tax1;
$_SESSION['tax2']=$tax2;

$res = mysql_query("SELECT `cust_id`, `cname`,`Address` from customer WHERE  `cust_id` = '$cust_id'");
if(mysql_num_rows($res)!=0) {
$row = mysql_fetch_array($res);
$cust_id = $row['cust_id']; 
$cname=$_SESSION['cname'] = $row['cname']; 
$_SESSION['Address']= $row['Address'];


$SQL = " INSERT INTO invoices ";
$SQL = $SQL . " (cust_id,cname) VALUES ";
$SQL = $SQL . " ('$cust_id','$cname') ";
$result = mysql_query("$SQL");
$_SESSION['invoice_id']=mysql_insert_id();
$f=1;
if (!$result) { 
    $f=2;	}
}

else {
echo 'No records found ';
    exit;
	}


 
        header('Location: invoice.php?success');
    }
} else if (isset($_GET['success'])) {

     echo "";

}
$outlet=$_SESSION['out_id'];
$info=mysql_query("SELECT `item_code` from product where `out_id`='$outlet'");
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

<SCRIPT language="javascript">
function calc(idx) {
  var price = parseFloat(document.getElementById("cost"+idx).value)*
              parseFloat(document.getElementById("qty"+idx).value);
  //  alert(idx+":"+price);  
  document.getElementById("price"+idx).value= isNaN(price)?"0.00":price.toFixed(2);
   
}

function totalIt() {
  var qtys = document.getElementsByName("qty[]");
  var total=0;
  for (var i=1;i<=qtys.length;i++) {
    calc(i);  
    var price = parseFloat(document.getElementById("price"+i).value);
    total += isNaN(price)?0:price;
  }
  document.getElementById("total").value=isNaN(total)?"0.00":total.toFixed(2);
  total= total + ( total * <?php echo $_SESSION['tax']; ?>);
  document.getElementById("total1").value=isNaN(total)?"0.00":total.toFixed(2);
}      

window.onload=function() {
  document.getElementsByName("qty[]")[0].onkeyup=function() {calc(1)};
  document.getElementsByName("cost[]")[0].onkeyup=function() {calc(1)};
}

var rowCount =0;
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chk[]";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;

        var cell3 = row.insertCell(2);
        var element3 = document.createElement("input");
        element3.type = "text";
        element3.name = "item[]";
        element3.required = "required";
        cell3.appendChild(element3);

        var cell4 = row.insertCell(3);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "qty[]";
        element4.id = "qty"+rowCount;
        element4.onkeyup=function() {calc(rowCount);}
        cell4.appendChild(element4);

        var cell5 = row.insertCell(4);
        var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "cost[]";
        element5.id = "cost"+rowCount;
        element5.onkeyup=function() {calc(rowCount);}
        cell5.appendChild(element5);

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("input");
        element6.type = "text";
        element6.name = "price[]";
        element6.id = "price"+rowCount
        cell6.appendChild(element6);



    }

    function deleteRow(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
            }


        }
        }catch(e) {
            alert(e);
        }
    }
</SCRIPT>

<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Confirm the Order ?");
if (agree){
if( document.getElementById("total1").value <  document.getElementById("paid").value){
confirm("paid amount is greater than total amount");
return false;
}
else 
return true;
}
else
	return false ;
}
// -->
</script>


</head>  
<body>  
<div id="header-wrapper" class="container"> 
<div id="user-account" class="row" > 
<div class="threecol"> <span>Welcome to Kriz Invoice</span> </div> 
<div class="ninecol last"> <a href="#">Logout</a> <span>|</span> <span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span> </div>
</div>  
<div id="user-options" class="row"> <div class="threecol">
<a href="dashboard.html">
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
  <h4>My Expenses</h4> <div class="collapse">collapse</div> </div>  <div class="content"> 
  <br/>
  <INPUT type="button" class="button-white" value="Add Row" onclick="addRow('dataTable')" />

<INPUT type="button" class="button-white" value="Delete Row" onclick="deleteRow('dataTable')" />

<form action="bill_insert.php" method="post" enctype="multipart/form-data">
invoice:<INPUT type="text" value="<?php echo $_SESSION['invoice_id']; ?>" name="invoice_id" readonly="readonly"/><br/>
Customer:<INPUT type="text" value="<?php echo $_SESSION['cname']; ?>" name="cname" readonly="readonly"/> <br/>

            <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;">
        <TR>
        <TH>Select</TH>
        <TH>Sr. No.</TH>
        <TH>Item</TH>
        <TH>Qty</TH>
        <TH>Cost</TH>
        <TH formula="cost*qty"summary="sum">Price</TH>
        </TR>
                <TR>
                    <TD><INPUT type="checkbox" name="chk[]"/></TD>
                    <TD> 1 </TD>
                    <TD><INPUT type="text" name="item[]" id="item" onkeyup="item()"/></TD>
                    <TD> <INPUT type="text" id="qty1" name="qty[]"/> </TD>
                    <TD> <INPUT type="text" id="cost1" name="cost[]" /> </TD>
                    <TD> <INPUT type="text" id="price1" name="price[]" /> </TD>
                </TR>

            </TABLE>
			<br/>
			<br/>
			
            Subtotal: <input type="text" readonly="readonly" name="subtotal" id="total" /><br/>
			
			<?php echo $_SESSION['tax1']; ?>: <?php echo $_SESSION['tax2']; ?><br/>
			
			Total: <input type="text" readonly="readonly" name="total" id="total1" />
			<br/>
        <input class="button-white" type="button" value="Total" onclick="totalIt()" />
		<br/>
	
		Pay Now: <input type="text" name="paid" id="paid" /><br/>
<input type="submit" value="Submit" class="button-blue" onClick="return confirmSubmit()"/>
 </form>

  
  
  
  <!-- ## / Panel Content  --> </div> </div>  
  
  <div class="shadow"></div> </div>
    
  
     </div> </div> </div>   
  </body>  
</html> 
<?php 
}
?>