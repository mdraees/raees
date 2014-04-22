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

$bal = $_SESSION['bal'];
$amt = $_SESSION['amt'];
$cname = $_SESSION['cname'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Pay Slip</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css'  />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>

</head>

<body>

	<div id="page-wrap">

		<p>Rs.<?php echo $amt; ?> as Balance Payment from <?php echo $cname; ?> has been accepted.</p>
		<p>Remaining Balance  for <?php echo $cname; ?> is Rs.<?php echo $bal; ?>.
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
</body>
</html>

<?php
}
?>