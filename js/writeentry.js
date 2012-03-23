//javascript file



function convertToHtml(rawtxt){
	var html = rawtxt.replace("|B|","<b>");
	var html = html.replace("|/B|","</b>");
	var html = html.replace("|A",'<a href="');
	var html = html.replace(" www.","http://www.");
	var html = html.replace("|/A|","</a>");
	var html = html.replace("||",'">');
	return html;
}

function submitentrie(){
	$.get('PHP/getsession.php', function(data) {
		if(data!="NULL" && data!=""){
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
					alert(http.responseText);
				}
			};
			
			http.send(params);
		}
		else{
			alert("You are not logged in");
		}
	});
}

function submitcomment($id){
	//TODO
	$.get('PHP/getsession.php', function(data) {
		if(data!="NULL" && data!=""){
			var params = "guid="+data+"&gtxt="+convertToHtml($('#textwrite').val())+"&geid="+$id;
			var url = "PHP/submitcomment.php";
			var http = new XMLHttpRequest();
			http.open("POST", url, true);
			
			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");
			
			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					alert(http.responseText);
				}
			};
			
			http.send(params);
		}
		else{
			alert("You are not logged in");
		}
	});
}