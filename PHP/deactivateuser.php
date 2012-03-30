<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	include("connect.php");
	//get the current password of the user
	$statement="SELECT Password FROM Users WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	$res = mysql_fetch_array($result);
	//...and save it to the user_save table
	$statement="INSERT INTO user_save (User_ID,Password) VALUES(".$_POST['pid'].",'".$res['Password']."')";
	$result = mysql_query($statement,$con);
	//remove the password from the User table
	$statement="UPDATE Users SET Password = '' WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	mysql_close($con);
}
?>