// JavaScript Document

loadnewentries();

function loadnewentries(){
$.get('PHP/entries.php', function(data) {
		$('#content').append(data); 
	;});
}

function loadcomments(id){
	if($('#com_'+id).html()!=""){
		$('#com_'+id).html("");
		$('#showcom_'+id).text("show comments");
	}
	else{
		$.get('PHP/comments.php?gid='+id+'', 
			function(data) {
			$('#com_'+id).html(data); 
		});
		$('#showcom_'+id).text("hide comments");
	}
}