<?php session_start(); ?>
<?php

$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	
	include("connect.php");

	$statement="SELECT Password FROM user_save WHERE User_ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	$res = mysql_fetch_array($result);

	$statement="UPDATE Users SET Password = '".$res['Password']."' WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);

	$statement="DELETE FROM user_save WHERE User_ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);

	mysql_close($con);
}
?>


