<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>YourBLog</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/commentstyle.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/dot-luv/jquery-ui-1.8.18.custom.css" rel="stylesheet">	
<link href="captcha/captcha.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="js/CollapsibleLists.compressed.js"></script>
<script type="text/javascript" src="js/helper.js"></script>
<?php if(isset($_GET["id"])){echo('<script>cur_search_id="gid='.str_replace("\"","",$_GET["id"]).'";cur_site="detail";</script> ');}?>  
<script type="text/javascript" src="js/init.js"></script>  
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/entries.js"></script>
<script type="text/javascript" src="js/comments.js"></script>
<script type="text/javascript" src="js/register.js"></script> 
<script type="text/javascript" src="js/admin.js"></script>

 
<style>
	form, .ui-dialog-titlebar, .ui-button-text { font-size: 62.5%; }
	label, input { display:block; }
	input.text {width:95%; padding: .4em; }
</style>

</head>

<body>

<div id="header">
<img src="pics//Logo.png" alt="Logo" width="358" height="105" align="left" />
</div>
<div id="center">
<div id="login_info">You are currently not logged in.</div>
<div id="titlebar">
    <!--<div id="tbutton" class="black" onclick="login();">LOGIN</div>-->
    <button class="menubutton" id="button-login">LOGIN</button>
    <button class="menubutton" id="button-home" >HOME</button>
    <button class="menubutton" id="button-about">ABOUT</button>
    <button class="menubutton" id="button-wentry">Write Entry</button>
    <button class="menubutton" id="button-register">Register</button>
    <button class="menubutton" id="button-admin">Admin</button>        
</div>

  <div id="content">

</div>
<div id="sidebar">
  <div id="s_top">
    <label for="textfield">Search</label>
    <input type="text" name="search" id="search" onkeyup="search();" />
  </div><div id="s_center">Archive:
    
    &nbsp; </div>
  <div id="s_bottom"></div>
</div>
</div>

<script type="text/javascript" src="js/harmony.js"></script>
<script>
var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
if(!is_chrome)
harmony();</script>
<script type="text/javascript" src="captcha/jquery.captcha.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script> 
<script type="text/javascript">
function setupEditor() {
tinyMCE.init({
        mode : "textareas",
        theme : "advanced" , 
		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		] 
});
}

function setupWrite(){
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "lists,style,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		]
	});
};
</script>
</body>
</html>
