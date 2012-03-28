// JavaScript Document

loadnewentries();

function loadnewentries(){
$.get('PHP/entries.php?'+cur_searchString+'&'+cur_dateString, function(data) {
		$('#content').html(data); 
		cur_site="home";
	;});
}

function appendentriews(){
$.get('PHP/entries.php?goid='+cur_oldestID+'&'+cur_searchString+'&'+cur_dateString, function(data) {
		$('#content').append(data); 
		alreadyloading=false;
	;});
}

function submitentrie(){
	$.get('PHP/getsession.php', function(data) {
		if(data!="NULL" && data!=""){
			if($('#textwrite').val() != "" && $('#titlewrite').val()!=""){
				if(sending_entry==false){
					sending_entry=true;
					var params = "guid="+data+"&gtxt="+convertToHtml($('#textwrite').val())+"&gtitle="+$('#titlewrite').val();
		
					var url = "PHP/submitentrie.php";
					var http = new XMLHttpRequest();
					http.open("POST", url, true);
					
					//Send the proper header information along with the request
					http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					http.setRequestHeader("Content-length", params.length);
					http.setRequestHeader("Connection", "close");
					
					http.onreadystatechange = function() {//Call a function when the state changes.
						if(http.readyState == 4 && http.status == 200) {
							$('#textwrite').val("");
							$('#titlewrite').val("");
							sending_entry=false;
							loadnewentries();
							//alert(http.responseText);
						}
					};
					
					http.send(params);
				}
			}
			else{
				alert("You cannot submit an empty text!");
			}
		}
		else{
			alert("You are not logged in");
		}
	});
}
