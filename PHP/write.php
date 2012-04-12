<?php 
//GET USER LEVEL
session_start();
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
?>

<?php
//init all variables
$txt="";
$title="";
$id=-1;
$bid='Sentry';
$bval='Submit entry';
//Check if there is content to update
if( isset($_POST["uid"])){
	//Check if user is an author or an admin
	if($lvl <= 1){			
			{
				//get the content and metadata of the entry
				include("connect.php"); //returns $con as connection to the yourblog database
				$statement="SELECT E.ID AS EID,
						E.Title AS TITLE,
						E.Text AS TEXT,
						E.User_ID AS UID,
					FROM Entries E 
					WHERE E.ID = ".$_POST['uid'];
				$result = mysql_query($statement,$con);
				$row = mysql_fetch_array($result);
				mysql_close($con);
			}
			//If user is an admin he can change all entries
			//if user is an author, we need to check if he wrote the entry and has the right to change it
			if(isset($row['TEXT']) && ($lvl==0 || ($lvl==1 && $_SESSION['ID']==$row['UID']))){
				//set vars
				$title=$row['TITLE'];
				$txt=$row['TEXT'];
				$id=$row['EID'];
				$bid='Uentry';
				$bval='Update entry';
			}
		}
}
?>

<div class="entry">
    <div id="c_top">
        <b class="topic">Write a new entry</b>
        <hr />
    </div>
    <div id="c_center">
    	Title:
        <br />
        <input id="titlewrite" name="Ntitle" type="text" value="<?php echo($title); ?>" size="50" maxlength="100" />
        <br />
        Text:
        <br />
        <textarea id="textwrite" cols="80" rows="25" ><?php echo ($txt); ?></textarea>
        <p style="text-align:center;">
       	<input id="<?php echo($bid); ?>" type="button" value="<?php echo($bval);?>"/>
        </p>
    </div>
    <div id="c_bottom">
    	<hr />
    </div>
</div>

<script type="text/javascript">
	setupWrite();
	sending_entry=false;
	
	<?php
	if($id==-1){
		echo('$(\'#Sentry\').button().on("click.submit",function(){
			submitentrie();
			});');
	}
	else{
		echo('$(\'#Uentry\').button().on("click.update",function(){
			updateentrie('.$id.');
			});');	
	}
	?>
</script>
