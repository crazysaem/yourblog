<?php
//get Input
$uid="";
if(isset($_POST["guid"])){
	$uid=$_POST["guid"];
}

$title="";
if(isset($_POST["gtitle"])){
	$title=$_POST["gtitle"];
}

$txt="";
if(isset($_POST["gtxt"])){
	$txt=$_POST["gtxt"];
}

//connects to the server and selects the yourblog database
include("connect.php"); //returns $con as connection to the yourblog database
if($uid!=""){
	//get the users permission level
	$checkPermission="SELECT UL.ID 
					FROM Users U,User_Levels UL
					WHERE U.User_Level_ID = UL.ID
					AND U.ID=".$uid."";
	$result = mysql_query($checkPermission,$con);
	$Level=mysql_fetch_array($result);
	//echo $Level['ID'];
	//only User with level < 2 can write an Entry
	if($Level['ID']<2){
		//creates the Insert statement
		$statement="INSERT INTO Entries 
					(Title,Text,User_ID,Date) 
					VALUES('".$title."','".$txt."',".$uid.",CURDATE())";
					//echo $statement;
		mysql_query($statement);
		echo "Entry was inserted into the database;";
	}
	else{
		echo ("You have no permission to write an entry!");	
	}
	//close database connection
	mysql_close($con);
}
else{
	echo "You have no permission to write an entry!";
}
?>