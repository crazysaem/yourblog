
<?php
function getwhere(){
	$statements = array ("","","","","","");
	if(isset($_GET["gid"]) && $_GET["gid"]!= ""){
		$statements[0]="E.ID = ".$_GET["gid"];
		}
	if(isset($_GET["gtitle"]) && $_GET["gtitle"]!= ""){
		$statements[1]="E.Title LIKE '%".$_GET["gtitle"]."%'";
		}
	if(isset($_GET["gtxt"]) && $_GET["gtxt"]!= ""){
		$statements[2]="E.Text LIKE '%".$_GET["gtxt"]."%'";
		}
	if(isset($_GET["gauth"]) && $_GET["gauth"]!= ""){
		$statements[3]='E.User_ID IN (SELECT ID 
								FROM Users 
								WHERE Name LIKE "%'.$_GET["gauth"].'%")';
		}
	if(isset($_GET["gdate"]) && $_GET["gdate"]!= ""){
		$statements[4]="(MONTH(E.Date) = MONTH(".$_GET["gdate"].") AND YEAR(E.Date) = YEAR(".$_GET["gdate"].") )";
	}
		
	//check for oldest ID to get only newer entries
	if(isset($_GET["goid"]) && $_GET["goid"]!= ""){
		$statements[5]="E.ID < ".$_GET["goid"];
		}	
	$count = 0;
	$or=0;
	$res="";
	//create THE OR statements
	while($count<=3){
		if($statements[$count]!=""){
			if($or>0){
				$res.='OR '.$statements[$count];
			}
			else{
				$res.="WHERE (".$statements[$count];
				$or+=1;
			}
			$res.=" ";
		}
		$count++;
	}
	if($or>0)
		$res.=")";
	$count=4;
	//DO THE AND PART
	while($count<=5){
		if($statements[$count]!=""){
				if($or>0){
					$res.=' AND '.$statements[$count];
				}
				else{
					$res.="WHERE ".$statements[$count];
					$or++;
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
			LEFT JOIN Users U ON E.User_ID = U.ID ".getwhere()."
			ORDER BY E.Date DESC,E.ID DESC
			LIMIT 0,5";
//echo($statement);
//queries the result from the database
$result = mysql_query($statement,$con);

//output all results
$oldestID=0;
$count=0;
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
	  	<a href="javascript:loadcomments('.$row['ID'].',0);" id="showcom_'.$row['ID'].'" class="com_load">show comments</a>
	  </div>	  
	</div>'
	);
	echo('<div class="comments" id="com_'.$row['ID'].'"></div>');
	//close entrydiv
	echo('</div>');
	$oldestID=$row['ID'];
	$count++;
  }
  if($count>0){
 echo('<script type="text/javascript">
			cur_oldestID='.$oldestID.';
 		</script>');
		//<a onclick="appendentriews();">load more</a>');
  }
  else{echo('<script type="text/javascript">
			cur_oldestID=-1;			
 		</script>');
	  }
//close database connection
mysql_close($con);
//<a href="PHP/comments.php?gid='.$row['ID'].'">comments</a>
?>


