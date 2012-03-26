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
					$('#textwrite').val("");
					$('#titlewrite').val("");
					loadnewentries();
					//alert(http.responseText);
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
			var params = "guid="+data+"&gtxt="+convertToHtml($('#write_com'+$id).val())+"&geid="+$id;
			var url = "PHP/submitcomment.php";
			var http = new XMLHttpRequest();
			http.open("POST", url, true);
			
			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");
			
			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					$('#write_com'+$id).val("");
					loadcomments($id,1);
					//alert(http.responseText);
				}
			};
			
			http.send(params);
		}
		else{
			alert("You are not logged in");
		}
	});
}

function register(){
	//reset error fields
	$("#pw_error").html("");
	$("#un_error").html("");
	$("#repw_error").html("");
	
	var error = 0;
	var uname=$("#username").val();
	var pw=$("#pword").val();
	var repw=$("#repass").val();
	
	if(pw!=repw){
		error+=1;
		//TODO DISPLAY password != repassword
		$("#repw_error").html("does not match the password.");
		$("#pword").val("");
		$("#repass").val("");
	}
	
	if(pw=="" || pw.length < 5 || pw.indexOf(" ")>=0){
		//TODO DISPLAY password wrong format or empty
		error+=1;
		$("#pw_error").html("password need to contain at least 5 non-space charakters.");
		$("#pword").val("");
		$("#repass").val("");
	}
	if(uname=="" || uname.indexOf(" ")>=0){
		error+=1;
		$("#un_error").html("you entered an empty username.");
	}	
		
	if(error==0){
		var params = "guname="+uname+"&gpassw="+pw;
	
				var url = "PHP/register.php";
				var http = new XMLHttpRequest();
				http.open("POST", url, true);
				
				//Send the proper header information along with the request
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.setRequestHeader("Content-length", params.length);
				http.setRequestHeader("Connection", "close");
				
				http.onreadystatechange = function() {//Call a function when the state changes.
					if(http.readyState == 4 && http.status == 200) {
						if(http.responseText=="inserted"){
						alert("You have been registered successfully!\nPlease login if you want to comment on entries.")
						window.location.href='index.html';
						}
						else
						alert("We are sorry. An error occured, please try again later.");
					}
				};
				
				http.send(params);
		}
}