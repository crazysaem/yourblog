<?php session_start(); ?>
<?php
//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	$statement="DELETE FROM Users WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	$statement="DELETE FROM Comments WHERE User_ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	//close database connection
}
mysql_close($con);
//<a href="PHP/comments.php?gid='.$row['ID'].'">comments</a>
?>


