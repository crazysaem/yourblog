<?php include '../connect.php'; 

if(isset($_GET["get"])) {

	$query = "SELECT * FROM blog_entry";
	
	if(isset($_GET["id"])) {
		$query = $query.' id='.$_GET["id"];
	}
	
	$query = $query." ORDER BY date_time ASC";

	$result = mysql_query($query);

	while($row = mysql_fetch_array($result))
	{
		echo $row[$_GET["get"]];
		echo "<sep>";
	}
	mysql_close($con);
}
?>