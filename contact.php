<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Combination     
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20101222

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex,follow" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>Tobi's little Site</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("Include/analystics.php") ?>
</head>
<body>
<div id="wrapper">
      <?php require_once("Include/menu.php")?>
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <div id="content">
          <div class="post">
            <h2 class="title"><a href="#">Conntact Me</a></h2>
            <div class="entry">
              <form id="form1" method="post" action="contact.php">
                <?php 
					include_once ("securimage/securimage.php");

					$securimage = new Securimage();
					
					$submit=$_POST[submit];
					$fail=0;
					if($submit=="abschicken"){
						
						$message=$_POST["text"];
						$mail=$_POST["email"];
						$subject2=$_POST["betreff"];
						
						if ($securimage->check($_POST['captcha_code']) == false) {
						  // the code was incorrect
						  // handle the error accordingly with your other error checking
						
						  // or you can do something really basic like this
						  echo('The code you entered was incorrect. Try again.');
						  $fail=1;
						}
						else{
						$to="tobit@arcor.de";
						$subject1="website: ";
						$subject=$subject1.$subject2;
						$headers="From: $mail";
							mail($to,$subject,$message."\n\n".$headers," ") or die("could not be sent") ;
							echo "thanks for your feedback";
						}
					}
				?>
                <p>
                  <label>
                    <input name="betreff" type="text" id="Betreff" value="<?php if($fail==0){echo"subject";}else{echo($_POST["betreff"]);}; ?>" />
                  </label>
                </p>
                <p>
                  <label>
                    <textarea name="text" id="Text" cols="50" rows="5"><?php if($fail==0){echo"your message";}else{echo($_POST["text"]);}; ?></textarea>
                  </label>
                </p>
                <p>
                  <label>
                    <input name="email" type="text" id="email" value="<?php if($fail==0){echo"your mail-adress";}else{echo($_POST["email"]);}; ?>" />
                  </label>
                </p>
                <hr />
                <p><img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">New Captcha</a></p>
                Enter Captcha Code: <input type="text" name="captcha_code" size="10" maxlength="6" />
                <hr />
                <p>
                  <label>
                    <input type="submit" name="submit" id="Submit" value="abschicken" />
                  </label>
                </p>
              </form>
            </div>
            <div class="byline"></div>
          </div>
          <div style="clear: both;">&nbsp;</div>
        </div>
        <!-- end #content -->
        <?php include_once("Include/Sidebar.php");?>
        <!-- end #sidebar -->
        <div style="clear: both;">&nbsp;</div>
      </div>
    </div>
  </div>
  <!-- end #page -->
  <div id="footer">
    <p>Copyright (c) 2011 Tobi&nbsp; All rights reserved. Design by <a href="http://www.freecsstemplates.org/"> CSS Templates</a>.</p>
  </div>
</div>
<!-- end #footer -->
</body>
</html>
