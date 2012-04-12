<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	include("connect.php");
	$statement="DELETE FROM Entries WHERE ID = ".$_POST['eid'];
	$result = mysql_query($statement,$con);
	mysql_close($con);
	echo "done";
}
?>