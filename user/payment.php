<?php
$f=0;
session_start();
include_once("../config.php");
?>

<?php 
if (isset($_POST['cust_id'])) { 
$cust_id = $_POST['cust_id'];
$amt = $_POST['amount'];

$_SESSION['amt']=$amt;

$SQL = " UPDATE `customer` SET `Balance`=`Balance`- $amt WHERE `cust_id`= $cust_id";
$result = mysql_query("$SQL");

$res = mysql_query("SELECT `cname` ,`Balance` from `customer` WHERE  `cust_id` = $cust_id");
$row = mysql_fetch_assoc($res);
$cname = $row["cname"]; 
$bal = $row["Balance"]; 

$_SESSION['cname']=$cname;
$_SESSION['bal']=$bal;


$SQL1 = "INSERT INTO `payment_history` ";
$SQL1 = $SQL1 . "(`cust_id`,`amt`) VALUES ";
$SQL1 = $SQL1 . " ('$cust_id', '$amt')";
$res = mysql_query($SQL1);



if($result){
 header('Location: pay_print.php');
	}
else { 
   echo 'No records Updated';
   }

}

else {
echo 'No records found ';
    exit;
	}
 
?>