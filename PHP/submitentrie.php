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
		if(isset($_POST["eid"])){
			//UPDATE ENTRY
			if($lvl==0)
				$statement="UPDATE Entries SET Title = '".$title."',Text = '".$txt."',Date = CURDATE() WHERE ID = ".$_POST['eid'];
			else
				$statement="UPDATE Entries SET Title = '".$title."',Text = '".$txt."',Date = CURDATE() WHERE ID = ".$_POST['eid']." AND User_ID = ".$_SESSION['ID'] ;
		}
		else{
			//INSERT ENTRY
			$statement="INSERT INTO Entries 
						(Title,Text,User_ID,Date) 
						VALUES('".$title."','".$txt."',".$_SESSION['ID'].",CURDATE())";
		}
		$result=mysql_query($statement,$con);
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