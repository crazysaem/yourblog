<?php
session_start();
include("escape.php");
function getwhere(){
	$statements = array ("","","","","","");
	if(isset($_GET["gid"]) && mysql_real_escape_string($_GET["gid"])!= ""){
		$statements[3]="E.ID = ".mysql_real_escape_string($_GET["gid"]);
		}
	if(isset($_GET["gtitle"]) && mysql_real_escape_string($_GET["gtitle"])!= ""){
		$statements[1]="E.Title LIKE '%".mysql_real_escape_string($_GET["gtitle"])."%'";
		}
	if(isset($_GET["gtxt"]) && mysql_real_escape_string($_GET["gtxt"])!= ""){
		$statements[2]="E.Text LIKE '%".mysql_real_escape_string($_GET["gtxt"])."%'";
		}
	if(isset($_GET["gauth"]) && mysql_real_escape_string($_GET["gauth"])!= ""){
		$statements[0]='E.User_ID IN (SELECT ID 
								FROM Users 
								WHERE Name LIKE "%'.mysql_real_escape_string($_GET["gauth"]).'%")';
		}
	if(isset($_GET["gdate"]) && mysql_real_escape_string($_GET["gdate"])!= ""){
		$date=mysql_real_escape_string($_GET["gdate"]);
		$date=str_replace("\\","",$date);
		$statements[4]="(MONTH(E.Date) = MONTH(".$date.") AND YEAR(E.Date) = YEAR(".$date.") )";
	}
	//check for oldest ID to get only newer entries
	if(isset($_GET["goid"]) && mysql_real_escape_string($_GET["goid"])!= ""){
		$statements[5]="E.ID < ".mysql_real_escape_string($_GET["goid"]);
		}	
	$count = 0;
	$or=0;
	$res="";
	//create THE OR statements
	while($count<=2){
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
	$count=3;
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
//queries the result from the database
$result = mysql_query($statement,$con);
//output all results
$oldestID=0;
$count=0;
while($row = mysql_fetch_array($result))
  {
	//open entriediv
  echo('<div class="entry">');
  //Topic output	?>	
  <div id="c_top">
  	<b class="topic">
    	<a style="color:white;" href="javascript:loaddetail(<?php echo($row['ID']); ?>);"><?php echo(htmlspecialchars($row['Title'])); ?>
        </a>
    </b>
    <?php if(isset($_SESSION['Level']) && $_SESSION['Level']==0){?>    
    <a style="color:white;float:right;padding-left:10px" href="javascript:removeentry(<?php echo($row['ID']); ?>);">x
    </a>
    <?php } ?>  
	<?php if(isset($_SESSION['Level']) && $_SESSION['Level']<=1){?>
    <a style="color:white;float:right;" href="javascript:editentry(<?php echo($row['ID']); ?>);">e
    </a>
    <?php } ?>    
    <hr />
  </div>
	<?php
   //Text output
  echo(' <div id="c_center">'.escapebadTags($row['Text']).'</div>');
  //Footer output
  echo('<div id="c_bottom">
	  <hr />
	  <div class="author">'.htmlspecialchars($row['User_Name']).'</div>
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
 		</script><font color="white">No results found</font>');
	  }
mysql_close($con);
?>