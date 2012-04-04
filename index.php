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
		<button id="button-login">LOGIN</button>
        <button id="button-home" >HOME</button>
        <button id="button-about">ABOUT</button>
        <button id="button-wentry">Write Entry</button>
        <button id="button-register">Register</button>
<button id="button-admin">Admin</button>        
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

</body>
</html>
