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
	if($('#textwrite').html() != "" && $('#titlewrite').val()!=""){
		if(sending_entry==false){
			sending_entry=true;
			var txt=$('#textwrite').html();
			var title=$('#titlewrite').val();
			txt=txt.replace(/[&]/g,"%26");
			title=title.replace(/[&]/g,"%26");
			var params = "gtxt="+txt+"&gtitle="+title+"";
			var url = "PHP/submitentrie.php";
			var http = new XMLHttpRequest();
			http.open("POST", url, true);
			
			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");
			
			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					if(http.responseText=="inserted"){
						$('#textwrite').val("");
						$('#titlewrite').val("");
						loadnewentries();
					}
					else{
						alert(http.responseText);
						}
					sending_entry=false;
				}
			};
			http.send(params);
		}
	}
	else{
		alert("You cannot submit an empty text!");
	}
}