// JavaScript Document

loadnewentries();

function loadnewentries(){
$.get('PHP/entries.php?'+cur_searchString+'&'+cur_dateString+'&'+cur_search_id, function(data) {
		$('#content').html(data); 		
	;});
}

function appendentriews(){
$.get('PHP/entries.php?goid='+cur_oldestID+'&'+cur_searchString+'&'+cur_dateString+'&'+cur_search_id, function(data) {
		$('#content').append(data); 
		alreadyloading=false;
	;});
}

function submitentrie(){
	var text=tinyMCE.get('textwrite').getContent();
	if(text != "" && $('#titlewrite').val() != ""){
		if(sending_entry==false){
			sending_entry=true;
			var txt=text;
			var title=$('#titlewrite').val();

			$.post("PHP/submitentrie.php", { gtxt: txt, gtitle: title },
		   		function(data) {
					 if(data=="inserted"){
						$('#textwrite').val("");
						$('#titlewrite').val("");
						cur_site="home";
						loadnewentries();
					}
					else{
						alert(data);
						}
					sending_entry=false;
		   		}
			);
		}
	}
	else{
		alert("You cannot submit an empty text or title!");
	}
}

function loaddetail(id){
	cur_site="detail";
	window.location="index.php?id="+id;
}

function editentry(eid){
	$.post('PHP/write.php', {eid: eid},function(data) {
		cur_site="wentry";
		$('#content').html(data);
	});
}

function removeentry(id){
	$.post('PHP/remove.php', {eid: id},function(data) {
		if(data=="done"){
			cur_site="home";
			loadnewentries();
		}
	});
}

function updateentrie(id){
	var text=tinyMCE.get('textwrite').getContent();
	if(text != "" && $('#titlewrite').val() != ""){
		if(sending_entry==false){
			sending_entry=true;
			var txt=text;
			var title=$('#titlewrite').val();

			$.post("PHP/submitentrie.php", { gtxt: txt, gtitle: title,eid: id },
		   		function(data) {
					 if(data=="inserted"){
						$('#textwrite').val("");
						$('#titlewrite').val("");
						cur_site="detail";
						loaddetail(id);
					}
					else{
						alert(data);
						}
					sending_entry=false;
		   		}
			);
		}
	}
	else{
		alert("You cannot submit an empty text or title!");
	}
}