<?php
//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement
$lvl=4;
if(isset($_POST['puid'])){
$checkPermission="SELECT UL.ID 
					FROM Users U,User_Levels UL
					WHERE U.User_Level_ID = UL.ID
					AND U.ID=".$_POST['puid']."";
$result = mysql_query($checkPermission,$con);
$Level=mysql_fetch_array($result);
$lvl=$Level['ID'];
}
if($lvl==0){
	$statement="DELETE FROM Users WHERE ID = ".$_POST['pid'];
	//echo($statement);
	//queries the result from the database
	$result = mysql_query($statement,$con);
	//close database connection
}
mysql_close($con);
//<a href="PHP/comments.php?gid='.$row['ID'].'">comments</a>
?>


