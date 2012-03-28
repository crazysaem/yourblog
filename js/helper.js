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
//used to identify the oldest loaded element
cur_oldestID=0;
//used for supporting search within the database
cur_searchString="";
cur_dateString="";
is_archive_search=false;
//used to check which site is currently loaded
cur_site="home";
//infinite scrolling...
alreadyloading = false;
$(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){
           if (alreadyloading == false && cur_oldestID!=-1) {
            alreadyloading = true;
            appendentriews();
        }
        }
});

function search(){
	cur_searchString="gtxt="+$('#search').val()+"&gtitle="+$('#search').val()+"&gauth="+$('#search').val();
	loadnewentries();
}

function update_date_search(year,month){
	is_archive_search=true;
	cur_dateString='gdate="'+year+"-"+month+'-01"';
	loadnewentries();
}

function reset_date_search(){
	if(is_archive_search){
		cur_dateString='';	
		loadnewentries();
		is_archive_search=false;
	}
}