// JavaScript Document

loadnewentries();

function loadnewentries(){
$.get('PHP/entries.php', function(data) {
		$('#content').append(data); 
	;});
}

