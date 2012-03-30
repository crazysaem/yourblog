<?php
include("connect.php");
$username=mysql_real_escape_string($_POST['uname']);
$password=md5($_POST['pass']);
//creates the SELECT statement
$statement="SELECT ID,User_Level_ID FROM Users U
			WHERE U.Name='".$username."'
			AND U.Password='".$password."'";
//queries the result from the database
$result = mysql_query($statement,$con);
$res=mysql_fetch_array($result);
//checki if valuepair exists
if($res){
	echo ($username);
	session_destroy();
	session_start();
	$_SESSION['ID']=$res['ID'];
	$_SESSION['Name']=$username;
	$_SESSION['Level']=$res['User_Level_ID'];
}
else{
	echo "NULL";
	session_destroy();
}
mysql_close($con);
?>