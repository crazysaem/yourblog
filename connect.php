<?php
$con = mysql_connect("localhost","root","");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("yourblog", $con);
mysql_query("SELECT * FROM blog_entry;",$con);
?>