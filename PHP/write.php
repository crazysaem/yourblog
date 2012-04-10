<?php $update=false; ?>
<div class="entry">
    <div id="c_top">
        <b class="topic">Write a new entry</b>
        <hr />
    </div>
    <div id="c_center">
    	Title:
        <br />
        <input id="titlewrite" name="Ntitle" type="text" value="
		<?php
        if(isset($_POST['title'])){
			echo $_POST['title'];
			}
		?>
        " size="50" maxlength="100" />
        <br />
        Text:
        <br />
        <div id="myNicPanel" style="width: 650px; color:#000;">
        </div>
        <div id="textwrite" style="font-size: 16px; color:black; background-color: #FFF; padding: 3px; width: 646px; ">
		<?php
        if(isset($_POST['text'])){
			echo $_POST['text'];
			}
		?>
        </div>
        <p style="text-align:center;">
       	<?php
        if(isset($_POST['text']) && isset($_POST['title'])){
			$update = true;
			echo('<input id="Uentry" type="button" value="Update entry" />');
		}
		else{
			echo('<input id="Sentry" type="button" value="Submit entry" />');
		}
		?>
        </p>
    </div>
    <div id="c_bottom">
    	<hr />
    </div>
</div>

<script type="text/javascript" src="js/nicEdit.js"></script> 
<script type="text/javascript">
	var myNicEditor = new nicEditor();
	myNicEditor.setPanel('myNicPanel');
	myNicEditor.addInstance('textwrite');

	sending_entry=false;
	<?php
	if(!$update){
		echo('$(\'#Sentry\').button().on("click.submit",function(){
			submitentrie();
			});');
	}
	else{
		echo('$(\'#Uentry\').button().on("click.update",function(){
			updateentrie();
			});');	
	}
	?>
	
</script>
