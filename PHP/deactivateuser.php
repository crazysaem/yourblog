<?php session_start(); ?>
<?php
//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	echo "1";
	$statement="SELECT Password FROM Users WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	$res = mysql_fetch_array($result);
	echo "2";
	$statement="INSERT INTO user_save (User_ID,Password) VALUES(".$_POST['pid'].",'".$res['Password']."')";
	$result = mysql_query($statement,$con);
	echo "3";
	$statement="UPDATE Users SET Password = '' WHERE ID = ".$_POST['pid'];
	$result = mysql_query($statement,$con);
	echo "4";
	//close database connection
}
mysql_close($con);
//<a href="PHP/comments.php?gid='.$row['ID'].'">comments</a>
?>