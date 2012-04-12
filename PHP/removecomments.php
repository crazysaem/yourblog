<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	include("connect.php");
	if(isset($_POST['pid']))
		$statement="DELETE FROM Comments WHERE User_ID = ".$_POST['pid'];
	else if(isset($_POST['cid']))
		$statement="DELETE FROM Comments WHERE ID = ".$_POST['cid'];
	$result = mysql_query($statement,$con);
	mysql_close($con);
	echo "done";
}
?>