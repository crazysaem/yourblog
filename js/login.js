// JavaScript Document


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
				window.location="index.php?";
			}
			else{
				$('#login_info').text("You are currently not logged in.");
				$('#login').dialog("open");
				$('#login').parent().effect("shake", {times: 3}, 80);	
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
				window.location="index.php?";
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