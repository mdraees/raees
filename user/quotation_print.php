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

$f=0;
$total=$_SESSION['total'];
$subtotal=$_SESSION['subtotal'];
$paid=$_SESSION['paid'];
$cname=$_SESSION['cname'];

$r = mysql_query("SELECT `address`,`phone` from admin");
$rw = mysql_fetch_array($r);
$add = $rw['address'];
$ph=$rw['phone'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css'  />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<style type="text/css" media="print">
	#hide {
	visibility: hidden;
	display: none;
	}
</style>
</head>

<body>

	<div id="page-wrap">

		<textarea id="header">QUOTATION</textarea>
		
		<div id="identity">
		
            <p id="address"><?php echo $add ; ?>
			Phone:<?php echo $ph ;   ?></p>
			

            <div id="logo">
              <img src="images/log.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
            <p>To,</p><h2><?php echo $cname ; ?></h2>

            <table id="meta">
               
                <tr>

                    <td class="meta-head">Date</td>
                    <td><?php echo date('Y-m-d'); ?></td>
                </tr>
				</table>
				
		
		</div>
		<div id="hide">
				<a href="dashboard.php" style="color:blue;"> << Back to Dashboard</a> &nbsp; &nbsp; 
				<input type="button" style="padding:2px;" onClick="window.print()" value="Print"/>
				<img src="images/icon-print.png"/>
				</div>
		
		<table id="items">
		
		  <tr>
		<TH>Item</TH>
		<TH>Qty</TH>
		<TH>Cost</TH>
		<TH>Price</TH>
		</tr>
		  
<?php 
			$sql1=mysql_query("SELECT  `id` ,  `item` ,  `qty` ,  `cost` ,  `price` FROM  `order` WHERE  `invoice_id` =$invoice_id");
			while($row = mysql_fetch_assoc($sql1))
			{	$item = $row["item"];
				$qty = $row["qty"];
				$cost = $row["cost"];
				$price = $row["price"];
				
			echo "<tr class=\"item-row\">
			<td align=\"left\"> $item</td>
			<td align=\"center\"> $qty</td>
			<td align=\"right\"> $cost</td>
			<td align=\"right\"> $price</td>
			<tr/>
			";
			} 
			/*	
			$sql2=mysql_query("SELECT SUM(  `price` ) FROM  `order` WHERE  `invoice_id` =$invoice_id");
			$frow = mysql_fetch_array($sql2);
			$total = $frow[0]; 
			*/
?>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"><?php echo $subtotal; ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line"><?php //echo $_SESSION['tax1']; ?></td>
		      <td class="total-value"><?php //echo $_SESSION['tax2']; ?></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Total</td>
		      <td class="total-value"><div id="total"><?php echo $total; ?></div></td>
		  </tr>
		  <!--<tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Amount Paid</td>
		      <td class="total-value">Rs.<?php //echo $paid; ?></td>
		  </tr>-->
		 <!-- <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line balance">Balance Due</td>
		      <td class="total-value balance">Rs.<?php //$bal=$total-$paid; echo $bal; ?></td>
			  </tr>-->
		
		</table>
		
		<div id="terms" >
		
		<table id="terms" width="800">
		<tr>
		<td> <h5>TERMS & CONDITION :</h5> 
		  1.Goods Once Sold Will not be taken back or exchanged. <br/>                                                                          
		  2.Ordered Items may slighty vary from the catalogue design.<br/>                                 
		  3.Vat Extra as applicable.<br/>                           
		  4.Transportation at customer's risk.<br/> 
		  5.Please ckeck your ordered products before taking delivery.<br/>
		  6.Subject to Udupi Jurisdiction. </td>                                                    
		  
		 <td align="right">Booked by .................... <br/><br/><br/><br/><br/>
		  
	                                                                                          
		 Customer's Signature</td>
		 </tr>
		 </table>
		 </div>  
		
	
	</div>
</body>
</html>
<?php
}
?>