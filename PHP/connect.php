<?php
//$con = mysql_connect("localhost","yourblog","WebEngII");
$con = mysql_connect("localhost","root","");
if (!$con)
	die('Could not connect: ' . mysql_error());
mysql_select_db("yourblog", $con);
?>