<?php

//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement

$username=$_POST['uname'];
$password=md5($_POST['pass']);
echo $password;
echo $username;
//$username="Tob";
//$password=md5("WebEngII");

$statement="SELECT ID FROM Users U
			WHERE U.Name='".$username."'
			AND U.Password='".$password."'";
//queries the result from the database
$result = mysql_query($statement,$con);
$res=mysql_fetch_array($result);
//return user ID
echo ($res['ID']);
//get the entrie again

mysql_close($con);
?>


