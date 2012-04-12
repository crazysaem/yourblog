function removeUser(id){
	var params = "pid="+id;
	var url = "PHP/removeuser.php";
	sendadminpost(params,url);	
}

function deactivateUser(id){
	var params = "pid="+id;
	var url = "PHP/deactivateuser.php";
	sendadminpost(params,url);	
}

function activateUser(id){
	var params = "pid="+id;
	var url = "PHP/activateuser.php";
	sendadminpost(params,url);	
}

function removeUserComments(id){
	var params = "pid="+id;
	var url = "PHP/removecomments.php";
	sendadminpost(params,url);	
}

function changeULevel(uid,mkid){
	var params = "uid="+uid+"&mkid="+mkid;
	var url = "PHP/changeULvl.php";
	sendadminpost(params,url);	
}	

function sendadminpost(params,url){
	var http = new XMLHttpRequest();
	http.open("POST", url, true);
	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	
	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			loadadmin();
		}
	};
	http.send(params);	
}
	
function loadadmin(){
	$.get('PHP/admin.php', function(data) {
		if(data!="NULL" && data!=""){
			cur_site="admin";
			$('#content').html(data); 					
		}
	;});
}