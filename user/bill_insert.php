<?php
# Start session:
session_start();
$f=0;
# Start MySQL connection:
include_once("../config.php");

$f=0;
if (isset($_POST['cname']))  { 
$cname = $_POST['cname'];
$invoice_id = $_POST['invoice_id'];

$paid = $_POST['paid'];

if (isset($paid)){ 
$SQL1 = "INSERT INTO `payment_history` ";
$SQL1 = $SQL1 . "(`cust_id`,`amt`) VALUES ";
$SQL1 = $SQL1 . " ('{$_SESSION['cust_id']}', '$paid')";
$res = mysql_query($SQL1);
}


$_SESSION['paid']=$paid;
$tax= $_SESSION['tax'];
$total=$_POST['total'];
$subtotal=$_POST['subtotal'];

$_SESSION['total']=$total;
$_SESSION['subtotal']=$subtotal;
$_SESSION['cname']=$cname;

//echo $_SESSION['total'];



$size = count($_POST['item']);
$i = 0;
$SQL = "INSERT INTO `order` ";
$SQL = $SQL . "(`item`, `qty`, `cost`, `price`, `invoice_id`) VALUES ";
while ($i < $size) {
	$item= $_POST['item'][$i];
	$qty = $_POST['qty'][$i];
	$cost = $_POST['cost'][$i];
	$price = $_POST['price'][$i];
	$up=mysql_query("update product set qty = qty - $qty where pname like '$item' and out_id=1"); 
	if ($i == $size-1){
		$SQL = $SQL . " ('$item', '$qty','$cost','$price','$invoice_id'); ";
	}
	else
	{
	$SQL = $SQL . " ('$item', '$qty','$cost','$price','$invoice_id'),";
	}

	$i++;
}
//echo $SQL;

$result1 = mysql_query("$SQL");

if ($result1){
$msg="Invoice Saved";

//update the invoice table amount

$usql="UPDATE `invoices` SET `Amount`= $total , `paid`= $paid, `tax`=$tax  WHERE invoice_id= $invoice_id";

$upd=mysql_query($usql);

$bal=$total-$paid; 

$usql1="UPDATE  `customer` SET  `Balance` =  `Balance` + $bal WHERE  `cname` =  '$cname'";

$upd1=mysql_query($usql1);


header('Location: bill_print.php');
}
if (!$result1){
echo (" Error Occured : Invoice was not saved");
}
}
?>