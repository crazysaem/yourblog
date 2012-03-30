<?php
	require_once('recaptchalib.php');
	$privatekey = "6LdqcM8SAAAAAAZyHiNuxBhdvLkGrHLhBoCgvFIW";
	$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_GET["recaptcha_challenge_field"],
								$_GET["recaptcha_response_field"]);	
	if (!$resp->is_valid) {
		die ("The reCAPTCHA wasn't entered correctly. Go back and try it again."."(reCAPTCHA said: " . $resp->error . ")");
	}
	else {
		echo "true";
	}
?>