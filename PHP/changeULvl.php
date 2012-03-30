<?php session_start(); ?>
<?php
include("connect.php");
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	$statement="UPDATE Users
				SET User_Level_ID = ".$_POST['mkid']."
				WHERE ID = ".$_POST['uid'];
	$result = mysql_query($statement,$con);
mysql_close($con);
}
?>