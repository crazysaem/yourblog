<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl<=1){
	$title="";
	if(isset($_POST["gtitle"])){
		$title=$_POST["gtitle"];
	}
	$txt="";
	if(isset($_POST["gtxt"])){
		$txt=$_POST["gtxt"];
	}
	if($txt!="" && $title!=""){
		include("connect.php"); //returns $con as connection to the yourblog database
		$statement="INSERT INTO Entries 
					(Title,Text,User_ID,Date) 
					VALUES('".$title."','".$txt."',".$_SESSION['ID'].",CURDATE())";
		mysql_query($statement);
		mysql_close($con);
		echo "inserted";
	}
	else{
		echo ("empty entrie");	
	}
}
else{
	echo "no permission";
}
?>