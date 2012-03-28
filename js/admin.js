function removeUser(id){
	$.get('PHP/getsession.php', function(data) {
		if(data!="NULL" && data!=""){	
			var params = "pid="+id+"&puid="+data;
			var url = "PHP/removeuser.php";
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
	});
}
	
	
function loadadmin(){
	$.get('PHP/getsession.php', function(data) {
		if(data!="NULL" && data!=""){
			$.get('PHP/admin.php?gid='+data, function(data) {
				$('#content').html(data); 
				cur_site="admin";
			;});
	}});
}
