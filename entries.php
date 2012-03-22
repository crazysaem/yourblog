<link href="css/style.css" rel="stylesheet" type="text/css" />

<?php
function getwhere(){
	$statements = array ("","","","","");
	if(isset($_GET["gid"])){
		$statements[0]="ID = ".$_GET["gid"];
		}
	if(isset($_GET["gtitle"])){
		$statements[1]="Title LIKE '%".$_GET["gtitle"]."%'";
		}
	if(isset($_GET["gtxt"])){
		$statements[2]="Text LIKE '%".$_GET["gtxt"]."%'";
		}
	if(isset($_GET["gauth"])){
		$statements[3]='User_ID IN (SELECT ID 
								FROM Users 
								WHERE Name LIKE "%'.$_GET["gauth"].'%")';
		}
	if(isset($_GET["gdate"])){
		$statements[4]="Date = ".$_GET["gdate"];
		}
	$count = 0;
	$and=0;
	$res="";
	//create where statement
	while($count<=4){
		if($statements[$count]!=""){
			if($and>0){
				$res.='AND '.$statements[$count];
			}
			else{
				$res.="WHERE ".$statements[$count];
				$and+=1;
			}
			$res.=" ";
		}
		$count++;
	}
	return $res;
}
//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement
$statement="SELECT E.ID,
				E.Title,
				E.Text,
				U.Name AS User_Name,
				E.Date 
			FROM Entries E 
			LEFT JOIN Users U ON E.User_ID = U.ID ".getwhere();
echo($statement);
//queries the result from the database
$result = mysql_query($statement,$con);

//output all results
while($row = mysql_fetch_array($result))
  {
	//open entriediv
  echo('<div class="entry">');
  //Topic output
  echo('<div id="c_top"> <b class="topic">'.$row['Title'].'</b><hr /></div>');
  //Text output
  echo(' <div id="c_center">'.$row['Text'].'</div>');
  //Footer output
  echo('<div id="c_bottom">
	  <hr />
	  <div class="author">'.$row['User_Name'].'</div>
	  <div class="date">'.$row['Date'].'</div>
	  <div class="comment">
	  	<a href="comments.php?gid='.$row['ID'].'">comments</a>
	  </div>	  
	</div>'
	);
	//close entrydiv
	echo('</div>');
  }
//close database connection
mysql_close($con);
?>


