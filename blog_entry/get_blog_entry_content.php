<?php include '../connect.php'; 

$result = mysql_query("SELECT * FROM blog_entry WHERE id=".$_GET["id"]);

while($row = mysql_fetch_array($result))
{
	echo $row['content'];
	echo "<sep>";
}
mysql_close($con);
?>