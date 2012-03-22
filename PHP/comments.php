<link href="../css/style.css" rel="stylesheet" type="text/css" />

<?php

//connects to the server and selects the yourblog database
include("connect.php");
//creates the SELECT statement
$Cstatement="SELECT C.ID,
				C.Comment, 
				U.Name AS User_Name,
				C.Date
			FROM Comments C
			Left Join Users U ON U.ID = C.User_ID
			WHERE Entry_ID =".$_GET["gid"]." ORDER BY ID ASC";
$Estatement="SELECT E.ID,
				E.Title,
				E.Text,
				U.Name AS User_Name,
				E.Date 
			FROM Entries E 
			LEFT JOIN Users U ON E.User_ID = U.ID 
			WHERE E.ID =".$_GET["gid"]."";
//queries the result from the database
$comresult = mysql_query($Cstatement,$con);

//get the entrie again
$enresult = mysql_query($Estatement,$con);
$entrie=mysql_fetch_array($enresult);
	//open entriediv
  echo('<div class="entry">');
  //Topic output
  echo('<div id="c_top"> <b class="topic">'.$entrie['Title'].'</b><hr /></div>');
  //Text output
  echo(' <div id="c_center">'.$entrie['Text'].'</div>');
  //Footer output
  echo('<div id="c_bottom">
	  <hr />
	  <div class="author">'.$entrie['User_Name'].'</div>
	  <div class="date">'.$entrie['Date'].'</div>
	  <div class="comment">
	  	See comments below!
	  </div>	  
	</div>'
	);
	//close entrydiv
	echo('</div>');

//output all results
$c=1;
while($row = mysql_fetch_array($comresult))
  {
	//open entriediv
  echo('<div class="entry">');
  //Topic output
  echo('<div id="c_top"> <b class="topic">Comment '.$c++.' </b><hr /></div>');
  //Text output
  echo(' <div id="c_center">'.$row['Comment'].'</div>');
  //Footer output
  echo('<div id="c_bottom">
	  <hr />
	  <div class="author">'.$row['User_Name'].'</div>
	  <div class="date">'.$row['Date'].'</div>
	  <div class="comment"></div>	  
	</div>'
	);
	//close entrydiv
	echo('</div>');
  }
//close database connection
mysql_close($con);
?>


