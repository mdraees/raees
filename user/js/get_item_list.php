<?php
require_once "..config/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT pname, item_code from product where pname LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$pname = $rs['pname'];
	$item_code = $rs['item_code'];
	echo "$pname | $item_code\n";
}
?><p><font color="#000000">recognize </font></p>
