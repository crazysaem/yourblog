<?php
$con = mysql_connect("localhost","yourblog","WebEngII");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("yourblog", $con);
/*$result = mysql_query("SELECT * FROM  entries",$con);
mysql_close($con);
*/
?>