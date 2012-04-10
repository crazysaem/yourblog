<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl<=2){
	$eid="";
	if(isset($_POST["geid"])){
		$eid=$_POST["geid"];
	}
	$txt="";
	if(isset($_POST["gtxt"])){
		$txt=$_POST["gtxt"];
	}
	if(trim($txt)!="" ){
		include("connect.php");
		//creates the Insert statement
		$statement="INSERT INTO Comments 
					(Entry_ID,Comment,User_ID,Date) 
					VALUES('".$eid."','".$txt."',".$_SESSION['ID'].",CURDATE())";
					//echo $statement;
		mysql_query($statement);
		mysql_close($con);
		echo "inserted";		
	}
	else{
		echo ("error");	
	}
}
else{
	echo "no permission";
}
?>