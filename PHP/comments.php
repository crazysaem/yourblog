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
?>
    <div class="commentdiv">
        <div id="com_top">
            <b class="topic">
                Comment <?php echo($c++); ?>
            </b>
            <hr />
        </div>
        <div id="com_center">
            <?php echo(escapebadTags($row['Comment'])); ?>
        </div>
        <div id="com_bottom">
            <hr />
            <div class="author">
                <?php echo(htmlspecialchars($row['User_Name'])); ?>
            </div>
            <div class="date">
                <?php echo($row['Date']); ?>
            </div>
            <div class="comment">
            </div>	  
        </div>
    </div>
<?php
//end while loop 
} 
//close database connection
mysql_close($con);
?>

<?php
//APPEND A DIALOG TO WRITE A NEW COMMENT
?>

<div class="commentdiv">
    <div id="com_top">
        <b class="topic">
            Write Comment
        </b>
        <hr />
    </div>
    <div id="com_center">
       <form>
        <textarea name="write_com<?php echo(htmlspecialchars($_GET["gid"]));?>" id="write_com<?php echo(htmlspecialchars($_GET["gid"]));?>" cols="73" rows="10"></textarea>
</form>
        <br/>
        <!-- Begin of captcha -->	
        <div class="captch" id="ajax-fc-container_<?php echo(htmlspecialchars($_GET["gid"]));?>">
            You must enable javascript to see captcha here!
        </div>
        <!-- End of captcha -->
        <p style="text-align:center;">
            <button id="submit_com<?php echo(htmlspecialchars($_GET["gid"]));?>" >
                comment
            </button>
        </p>
    </div>
    <div id="com_bottom">
          <hr />
          <div class="author">
          </div>
          <div class="date">
          </div>
          <div class="comment">
              <a href="javascript:loadcomments(<?php echo(htmlspecialchars($_GET["gid"]));?>,0);" id="showcom_<?php echo(htmlspecialchars($_GET["gid"]));?>" class="com_load" >
                hide comments
              </a>
          </div>	  
    </div>
</div>

<script type="text/javascript">
	setupEditor();
	$("#submit_com<?php echo(htmlspecialchars($_GET["gid"]));?>").button().click(function(){
		submitcomm(<?php echo(htmlspecialchars($_GET["gid"]));?>)
	});
	//CKEDITOR.replace("write_com<?php echo(htmlspecialchars($_GET["gid"]));?>");
	//var myNicEditor = new nicEditor({maxHeight : 100});
	//myNicEditor.setPanel("myNicPanel<?php echo(htmlspecialchars($_GET["gid"]));?>");
	//new nicEditor({maxHeight : 100}).panelInstance("write_com<?php echo(htmlspecialchars($_GET["gid"]));?>");
	//myNicEditor.addInstance("write_com<?php echo(htmlspecialchars($_GET["gid"]));?>");
</script>