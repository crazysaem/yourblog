//initialise the Login Dialog
$(function() {
	$.get('login.html', function(data) {
	$('body').prepend(data);  
	$('#login').dialog({
			autoOpen: false,
			title: "Login",
			height: 'auto',
			width: 350,
			resizable: false,
			modal: true,
			buttons: {
				"Ok": function() { 
					submitlogin();
					$(this).dialog("close"); 
					$(this).addClass("dialog-button");
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
					$(this).addClass("dialog-button");
				} 
			}
			
		}); 
	});
});
//init the login Button
$(function() {
	$('#button-login').button().on("click.login",
		function(){
			$('#login').dialog("open");
		});	
	$('#button-home').button().click(function(){
		if(cur_site!="home"){
			cur_site="home";
			loadnewentries();
		}
	});
	$('#button-about').button();
	$('#button-wentry').button().click(function(){
		if(cur_site!="wentry"){
			$.get('writeentry.html', function(data) {
				cur_site="wentry";
				$('#content').html(data);
			});
		}
	});
		
	//check if there is an open Session
	getrunningSession();
	$("#button-register").button().click(function(){
		if(cur_site!="register"){
			$.get('register.html', function(data) {
				cur_site="register";
				$('#content').html(data);
				});
			}
		});
		
	$('#button-admin').button().click(function(){
		if(cur_site!="admin"){
			loadadmin();
		}
		});
		
	$.get('PHP/gethistory.php', function(data) {
			$('#s_center').html(data);
			CollapsibleLists.apply();
		;});
});

//Checks if a Session is still open
function getrunningSession(){
	$.get('PHP/getsessionName.php', function(data) {
		if(data!="NULL" && data!=""){
			$('#login_info').text("Welcome "+data);
			changeLoginButton()
		} 
	})
;}