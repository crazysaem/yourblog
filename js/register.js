


function register(){
	
	 changeRegButoon();
	//reset error fields
	$("#pw_error").html("");
	$("#un_error").html("");
	$("#repw_error").html("");
	
	var error = 0;
	var uname=$("#regusername").val();
	var pw=$("#regpword").val();
	var repw=$("#regrepass").val();
	
	if(pw!=repw){
		error+=1;
		//TODO DISPLAY password != repassword
		$("#repw_error").html("does not match the password.");
		$("#regpword").val("");
		$("#regrepass").val("");
	}
	
	if(pw=="" || pw.length < 5 || pw.indexOf(" ")>=0){
		//TODO DISPLAY password wrong format or empty
		error+=1;
		$("#pw_error").html("password need to contain at least 5 non-space charakters.");
		$("#regpword").val("");
		$("#regrepass").val("");
	}
	if(uname=="" || uname.indexOf(" ")>=0){
		error+=1;
		$("#un_error").html("you entered an empty username.");
	}	
		
	if(error==0){
		var params = "guname="+uname+"&gpassw="+pw;
	
				var url = "PHP/register.php";
				var http = new XMLHttpRequest();
				http.open("POST", url, true);
				
				//Send the proper header information along with the request
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.setRequestHeader("Content-length", params.length);
				http.setRequestHeader("Connection", "close");
				
				http.onreadystatechange = function() {//Call a function when the state changes.
					changeRegButoon();
					if(http.readyState == 4 && http.status == 200) {
						if(http.responseText=="inserted"){
						Recaptcha.destroy();
						alert("You have been registered successfully!\nPlease login if you want to comment on entries.");
						loadnewentries();
						}
						else if(http.responseText=="exists"){
							alert("This name already exists.");
							$("#regusername").val("");
							Recaptcha.reload();		
						}
						else{	
							alert("We are sorry. An error occured, please try again later.");
							$("#regusername").val("");
							$("#regpword").val("");
							$("#regrepass").val("");	
							Recaptcha.reload();
						}
					}
				};
				http.send(params);
		}
		else{
			changeRegButoon();
			Recaptcha.reload();			
			}
}

function changeRegButoon(){
	if($('#bregister').button( "option", "label" )=="Submit"){
		$('#bregister').button( "option", "label", "Processing..." );
		$('#bregister').button().on("click.process",function(){});
		$('#bregister').button().off("click.submit");		
	}
	else{
		$('#bregister').button( "option", "label", "Submit" );
		$('#bregister').button().off("click.process");
		$('#bregister').button().on("click.submit",function(){
		   if(checkCap()){
			  register();
		   }
		   else{
			   Recaptcha.reload();
			   alert("Please reenter Captcha");
			   }
		   }	
		);	
	}
}


