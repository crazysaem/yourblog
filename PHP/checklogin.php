<?php session_start(); ?>
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
<<<<<<< HEAD:PHP/checklogin.php
	session_start();
=======
>>>>>>> 52efc761b7f347d866192c86f4a1a8218009b060:PHP/checklogin.php
	$_SESSION['ID']=$res['ID'];
	$_SESSION['Name']=$username;
}
else{
	echo "NULL";
	$_SESSION['ID']="NULL";
	$_SESSION['Name']="NULL";	
}

mysql_close($con);
?>