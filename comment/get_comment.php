<?php include '../PHP/connect.php'; 

//$result = mysql_query("SELECT * FROM comment WHERE blog_entry_id=".$_GET["blog_entry_id"]);

$query = "SELECT * FROM comment";

if(isset($_GET["id"]) or isset($_GET["blog_entry_id"]) or isset($_GET["user_id"])) {
	$query = $query." WHERE";
}

$a = 0;

if(isset($_GET["id"])) {
	$query = $query.' id='.$_GET["id"];
	$a = 1;
}

if(isset($_GET["blog_entry_id"])) {
	if($a==1) {
		$query = $query." AND"; 
	}
	$query = $query.' blog_entry_id='.$_GET["blog_entry_id"];
	$a = 1;
}

if(isset($_GET["user_id"])) {
	if($a==1) {
		$query = $query." AND"; 
	}
	$query = $query.' id='.$_GET["user_id"];
	$a = 1;
}

$query = $query." ORDER BY date_time ASC";

//echo "!".$query."!<br><br>";

$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
	echo $row['content'];
	echo "<sep>";
}
mysql_close($con);
?>