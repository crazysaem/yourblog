<?php
//get Input
$uname="";
if(isset($_POST["guname"])){
	$uname=$_POST["guname"];
}

$pass="";
if(isset($_POST["gpassw"])){
	$pass=md5($_POST["gpassw"]);
}

//connects to the server and selects the yourblog database
include("connect.php"); //returns $con as connection to the yourblog database
if($uname!=""){
	//get the users permission level
	$checkExist="SELECT U.Name FROM Users U WHERE U.Name = '".$uname."'";
	$result = mysql_query($checkExist,$con);
	if(!$result){
		echo "exists";
		}
	else{
		$statement="INSERT INTO Users 
					(User_Level_ID,Name,Password) 
					VALUES(2,'".$uname."','".$pass."')";
		$result	= mysql_query($statement);
		if($result){
			echo "inserted";
			}
		else{
			echo "error";
			}
		}
	}
else{
	echo "error";
	}
mysql_close($con);
?>