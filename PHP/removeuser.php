<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	include("connect.php");
	//remove user...
	$statement="DELETE FROM Users WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	//and all his/her comments
	$statement="DELETE FROM Comments WHERE User_ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	mysql_close($con);
}
//TODO WHAT DO WE DO WITH ENTRYS OF AN AUTHOR
?>