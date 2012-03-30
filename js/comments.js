function loadcomments(id,reload){
	if(reload==1){
		$.get('PHP/comments.php?gid='+id+'', 
			function(data) {
				$('.comments').html("");
				$('.com_load').text("show comments");
				$('#showcom_'+id).text("hide comments");
				$('#com_'+id).html(data); 				
			}
		);
	}
	if($('#com_'+id).html()!=""){
		$('#com_'+id).html("");
		$('#showcom_'+id).text("show comments");
	}
	else{
		$.get('PHP/comments.php?gid='+id+'', 
			function(data) {
			$('.comments').html("");
			$('.com_load').text("show comments");
			$('#showcom_'+id).text("hide comments");
			$('#com_'+id).html(data); 			
		});		
	}
}

function submitcomm(id){
  // if(checkCap()){
		submitcomment(id);
  // }
//   else{
//		Recaptcha.reload();
//		alert("Please reenter Captcha");
//	}	
}
com_submitting = false;
function submitcomment($id){
	if(!com_submitting){
		com_submitting=true;
		var txt=$('#write_com'+$id).html();
		txt=txt.replace(/[&]/g,"%26");
		var params = "gtxt="+txt+"&geid="+$id;
		var url = "PHP/submitcomment.php";
		var http = new XMLHttpRequest();
		http.open("POST", url, true);
		
		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		
		http.onreadystatechange = function() {//Call a function when the state changes.
			if(http.readyState == 4 && http.status == 200) {
				com_submitting = false;
				if(http.responseText=="inserted")
					loadcomments($id,1);
				else
					alert(http.responseText);
			}
		};
		http.send(params);
	}
}
