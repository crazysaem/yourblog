// JavaScript Document

loadnewentries();

function loadnewentries(){
$.get('PHP/entries.php', function(data) {
		$('#content').html(data); 
	;});
}

function appendentriews(){
$.get('PHP/entries.php', function(data) {
		$('#content').append(data); 
	;});
}	

function loadcomments(id,reload){
	if(reload==1){
		$.get('PHP/comments.php?gid='+id+'', 
			function(data) {
			$('#com_'+id).html(data); 
		});
		$('#showcom_'+id).text("hide comments");
		}
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