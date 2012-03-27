// JavaScript Document
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
	$('#button-home').button().click(function(){loadnewentries();});
	$('#button-about').button();
	$('#button-wentry').button().click(function(){
		$.get('writeentry.html', function(data) {
			$('#content').html(data);
			});
		});
	//check if there is an open Session
	getrunningSession();
	$("#button-register").button().click(function(){
		$.get('register.html', function(data) {
			$('#content').html(data);
			});
		});
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

function submitlogin(){
	var http = new XMLHttpRequest();
	var url = "PHP/checklogin.php";
	var params = "uname="+$('#username').val() +"&pass="+$('#password').val();
	$('#username').val("");
	$('#password').val("");
	http.open("POST", url, true);
	
	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	
	http.onreadystatechange = function() {//Call a function when the state changes.
		if(http.readyState == 4 && http.status == 200) {
			var res = http.responseText;		
			if(res.indexOf('<')>-1)
				res=res.substring(0,res.indexOf('<'));
			if(res!="NULL"){
				$('#login_info').text("Welcome "+res);
				changeLoginButton();
			}
			else{
				$('#login_info').text("You are currently not logged in.");	
			}
		}
	}
	http.send(params);
	$('#login_wrapper').remove();
}
//Change state of the Login/Logout Button
function changeLoginButton(){
	if($('#button-login').button( "option", "label" )=="LOGIN")
	{
		$('#button-login').button( "option", "label", "LOGOUT" )
			$('#button-login').button().on("click.logout",
			function(){
				$.get("PHP/endsession.php");
				$('#login_info').text("You are currently not logged in.");
				changeLoginButton();	
			});
		$('#button-login').button().off("click.login");		
	}
	else
	{
		$('#button-login').button( "option", "label", "LOGIN" )
		$('#button-login').button().off("click.logout");	
		$('#button-login').button().on("click.login",
		function(){
			$('#login').dialog("open");
		});	
	}
}