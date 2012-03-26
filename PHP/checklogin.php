<?php
$_SESSION['ID']="NULL";
//connects to the server and selects the yourblog database
include("connect.php");


$username=$_POST['uname'];
$password=md5($_POST['pass']);
//echo $password;
//echo $username;

//creates the SELECT statement
$statement="SELECT ID FROM Users U
			WHERE U.Name='".$username."'
			AND U.Password='".$password."'";
//queries the result from the database
$result = mysql_query($statement,$con);
$res=mysql_fetch_array($result);
if($res){
	//ret user ID
	echo ($username);
	session_destroy();
	session_start();
	$_SESSION['ID']=$res['ID'];
	$_SESSION['Name']=$username;
}
else{
	echo "NULL";
	session_destroy();
	$_SESSION['ID']="NULL";
	$_SESSION['Name']="NULL";	
}

mysql_close($con);
?>