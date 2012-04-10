<?php
include("escape.php");
include("connect.php");
//creates the SELECT statement
$Cstatement="SELECT C.ID,
				C.Comment, 
				U.Name AS User_Name,
				C.Date
			FROM Comments C
			Left Join Users U ON U.ID = C.User_ID
			WHERE Entry_ID =".mysql_real_escape_string($_GET["gid"])." ORDER BY ID ASC";
$comresult = mysql_query($Cstatement,$con);
//output all results
$c=1;  //count the comments
while($row = mysql_fetch_array($comresult))
  {
	//open entriediv
  echo('<div class="commentdiv">');
  //Topic output
  echo('<div id="com_top"> <b class="topic">Comment '.$c++.' </b><hr /></div>');
  //Text output
  echo(' <div id="com_center">'.escapebadTags($row['Comment']).'</div>');
  //Footer output
  echo('<div id="com_bottom">
	  <hr />
	  <div class="author">'.htmlspecialchars($row['User_Name']).'</div>
	  <div class="date">'.$row['Date'].'</div>
	  <div class="comment"></div>	  
	</div>'
	);
	//close entrydiv
	echo('</div>');
  }
//close database connection
mysql_close($con);
echo('
<div class="commentdiv">
<div id="com_top"> <b class="topic">Write Comment </b><hr /></div>
<div id="com_center">
<div id="myNicPanel'.htmlspecialchars($_GET["gid"]).'" style="width: 614px; color:#000;"></div>
<div id="write_com'.htmlspecialchars($_GET["gid"]).'" style="color:black; font-size: 16px; background-color: #FFF; padding: 3px; width: 610px;">
</div>


 <!-- Begin of captcha -->	
            <div class="captch" id="ajax-fc-container_'.htmlspecialchars($_GET["gid"]).'">You must enable javascript to see captcha here!</div>
            <!-- End of captcha -->
<p style="text-align:center;"><button id="submit_com'.htmlspecialchars($_GET["gid"]).'" >comment</button></p>
</div>
<div id="com_bottom">
	  <hr />
	  <div class="author"></div>
	  <div class="date"></div>
	  <div class="comment">
	  <a href="javascript:loadcomments('.htmlspecialchars($_GET["gid"]).',0);" id="showcom_'.htmlspecialchars($_GET["gid"]).'" class="com_load" >hide comments</a></div>	  
</div>
</div>
<script type="text/javascript">
   $("#submit_com'.htmlspecialchars($_GET["gid"]).'").button().click(function(){submitcomm('.htmlspecialchars($_GET["gid"]).')});
</script>
<script type="text/javascript" src="js/nicEdit.js"></script> 
<script type="text/javascript">
	var myNicEditor = new nicEditor();
	myNicEditor.setPanel("myNicPanel'.htmlspecialchars($_GET["gid"]).'");
	myNicEditor.addInstance("write_com'.htmlspecialchars($_GET["gid"]).'");
	</script>
');
?>