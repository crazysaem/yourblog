<?php
//get Input
$uid="";
if(isset($_POST["guid"])){
	$uid=$_POST["guid"];
}

$eid="";
if(isset($_POST["geid"])){
	$eid=$_POST["geid"];
}

$txt="";
if(isset($_POST["gtxt"])){
	$txt=$_POST["gtxt"];
}

//connects to the server and selects the yourblog database
include("connect.php"); //returns $con as connection to the yourblog database
if($uid!="" && $uid!="NULL" && $txt!=""){
	//get the users permission level
	$checkPermission="SELECT UL.ID 
					FROM Users U,User_Levels UL
					WHERE U.User_Level_ID = UL.ID
					AND U.ID=".$uid."";
	$result = mysql_query($checkPermission,$con);
	$Level=mysql_fetch_array($result);
	//echo $Level['ID'];
	//only User with level < 2 can write an Entry
	if($Level['ID']<3){
		//creates the Insert statement
		$statement="INSERT INTO Comments 
					(Entry_ID,Comment,User_ID,Date) 
					VALUES('".$eid."','".$txt."',".$uid.",CURDATE())";
					//echo $statement;
		mysql_query($statement);
		echo "Comment was inserted into the database;";
	}
	else{
		echo ("You have no permission to write a comment!");	
	}
	//close database connection
	mysql_close($con);
}
else{
	echo "You have no permission to write a comment!";
}
?>