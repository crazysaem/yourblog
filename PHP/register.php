<?php
$uname="";
if(isset($_POST["guname"])){
	$uname=mysql_real_escape_string($_POST["guname"]);
}
$pass="";
if(isset($_POST["gpassw"])){
	$pass=md5($_POST["gpassw"]);
}
include("connect.php"); //returns $con as connection to the yourblog database
if($uname!="" && $pass!=""){
	//check if user already exists
	$checkExist="SELECT 'TRUE' AS Exist 
				FROM Users Uo
				WHERE EXISTS(
					SELECT 1 
					FROM Users U 
					WHERE U.Name='".$uname."' AND U.ID = Uo.ID)";
	$result = mysql_query($checkExist,$con);
	$res=mysql_fetch_array($result);
	if($res["Exist"]=="TRUE"){
		echo "exists";
		}
	//if not exists do...
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