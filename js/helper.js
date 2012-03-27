//javascript file
function convertToHtml(rawtxt){
	var html = rawtxt.replace("|B|","<b>");
	var html = html.replace("|/B|","</b>");
	var html = html.replace("|A",'<a href="');
	var html = html.replace(" www.","http://www.");
	var html = html.replace("|/A|","</a>");
	var html = html.replace("||",'">');
	//var html = html.replace("|R|","<font color='red'>");
	//var html = html.replace("|/R|","</font>");
	return html;
}

function checkCap(){
	if(Recaptcha.get_response().length>4 && Recaptcha.get_response())
		return true;
	else 
		return false;
//	$.get('PHP/evalcaptcha.php?recaptcha_challenge_field='+Recaptcha.get_challenge()+'&recaptcha_response_field='+Recaptcha.get_response(), 
//		function(data) {
//			alert(data); 
//		}
//	);
}