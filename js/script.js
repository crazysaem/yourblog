//GLOBAL VARS BEGIN
cur_oldestID=0; //used to identify the oldest loaded element
cur_search_id="";//used for supporting search within the database
cur_searchString="";
cur_dateString="";
is_archive_search=false;
solved=false;
cur_site="home";//used to check which site is currently loaded
alreadyloading = false;//infinite scrolling...
//GLOBAL VARS END
//function for invinite Scrolling
$(window).scroll(function() {
	var totalHeight, currentScroll, visibleHeight;
	
	if (document.documentElement.scrollTop){ 
		currentScroll = document.documentElement.scrollTop; }
	else{
		currentScroll = document.body.scrollTop; 
	}
	
	totalHeight = $(document).height();
	visibleHeight = document.documentElement.clientHeight;
	
	if (totalHeight <= currentScroll + visibleHeight + 2){
		if (alreadyloading == false && cur_oldestID!=-1 && cur_site=="home") {
			alreadyloading = true;
			appendentriews();
		}
	}
});
//SEARCH FUNTIONALITY BEGIN 
function search(){
	cur_searchString="gtxt="+$('#search').val()+"&gtitle="+$('#search').val()+"&gauth="+$('#search').val();
	loadnewentries();
}

function update_date_search(year,month){
	is_archive_search=true;
	cur_dateString='gdate="'+year+"-"+month+'-01"';
	loadnewentries();
}

function reset_date_search(){
	if(is_archive_search){
		cur_dateString='';	
		loadnewentries();
		is_archive_search=false;
	}
}
//SEARCH FUNTIONALITY END
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
			cur_search_id="";
			window.location="index.php?";
		}
	});
	$('#button-about').button();
	$('#button-wentry').button().click(function(){
		if(cur_site!="wentry"){
			$.get('PHP/write.php', function(data) {
				cur_site="wentry";
				$('#content').html(data);
			});
		}
	});
	
	$("#button-register").button().click(function(){
		if(cur_site!="register"){
			$.get('register.html', function(data) {
				cur_site="register";
				$('#content').html(data);
				});
			}
		});
	
	$("#button-about").button().click(function(){
		if(cur_site!="about"){
			$.get('about.html', function(data) {
				cur_site="about";
				$('#content').html(data);
				});
			}
		});	
	$('#button-admin').button().click(function(){
		if(cur_site!="admin"){
			loadadmin();
		}
		});
	//get the current entrie history
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
//HANDLE LOGIN/LOGOUT BEGIN
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
				//window.location="index.php?";
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
				$.get("PHP/endsession.php",function(data){
					$('#login_info').text("You are currently not logged in.");
					changeLoginButton();	
					window.location="index.php";
				});
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
//HANDLE LOGIN/LOGOUT END
//ENTRIE FUNCTIONS BEGIN
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
//ENTRIE FUNCTIONS END
//COMMENT FUNCTIONS BEGIN
function loadcomments(id,reload){
	//if html is not loaded or should be reloaded
	if(reload==1 || $('#com_'+id).html()==""){
		$.get('PHP/comments.php?gid='+id+'', 
			function(data) {
				$('.comments').hide();
				$('.com_load').text("show comments");
				$('#showcom_'+id).text("hide comments");
				$('#com_'+id).show();
				$('#com_'+id).focus();
				$('#com_'+id).html(data);
				$('.captch').html("");
				solved=false;
				$('#ajax-fc-container_'+id).captcha({
					text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
				});
			}
		);
	}
	else{
		//html already loaded
		if($('#showcom_'+id).text()!="show comments"){
			$('#com_'+id).hide();
			$('#showcom_'+id).text("show comments");			
		}
		else{
			$('.comments').hide();
			$('.com_load').text("show comments");
			$('#showcom_'+id).text("hide comments");
			$('#com_'+id).show();
			$('.captch').html("");
			solved=false;
			$('#ajax-fc-container_'+id).captcha({
				text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
			});
		}
	}
}

function submitcomm(id){
	var text=tinyMCE.get('write_com'+id).getContent();
  if(solved && text != ""){
		submitcomment(id);
   }
   else{
		$('#ajax-fc-container_'+id).captcha({
				text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
			});
		solved=false;
		//alert("Please reenter Captcha");
	}	
}
com_submitting = false;
function submitcomment(id){
	if(!com_submitting){
		com_submitting=true;
		var txt=tinyMCE.get('write_com'+id).getContent();
		txt=txt.replace(/[&]/g,"%26");
		var params = "gtxt="+txt+"&geid="+id;
		var url = "PHP/submitcomment.php";
		var http = new XMLHttpRequest();
		http.open("POST", url, true);
		
		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		
		http.onreadystatechange = function() {//Call a function when the state changes.
			if(http.readyState == 4 && http.status == 200) {
				solved=false;
				com_submitting = false;
				if(http.responseText=="inserted"){
					loadcomments(id,1);					
				}
				else
					alert(http.responseText);
					$('#ajax-fc-container_'+id).captcha({
				text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
			});					
			}
		};
		http.send(params);
	}
}

function removecom(comid,entid){
	$.post("PHP/removecomments.php", { cid: comid },
		   		function(data) {
					 if(data=="done")
						loadcomments(entid,1);					
		   		}
			);
}
//COMMENT FUNCTIONS END
//REGISTER / CAPTCHA BEGIN
function loadcaptcha(){
	$(".ajax-fc-container").captcha({
				text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
			});
	}
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
		if(!solved){
			changeRegButoon();
			solved=false;
			loadcaptcha();
			$('#captch_error').html("Captcha was not solved correctly");
			$("#regpword").val("");
			$("#regrepass").val("");
		}
		else{
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
							//Recaptcha.destroy();
							alert("You have been registered successfully!\nPlease login if you want to comment on entries.");
							cur_site="home";
							solved=false;
							loadnewentries();
							}
							else if(http.responseText=="exists"){
								alert("This name already exists.");
								$("#regusername").val("");
								solved=false;
								loadcaptcha();		
							}
							else{	
								alert("We are sorry. An error occured, please try again later.");
								$("#regusername").val("");
								$("#regpword").val("");
								$("#regrepass").val("");	
								solved=false;
								loadcaptcha();
							}
						}
					};
					http.send(params);
			}
	}
	else{
		changeRegButoon();
		solved=false;
	    loadcaptcha();		
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
		   	  register();});
	}
}
//REGISTER / CAPTCHA END
//ADMIN BEGIN
function removeUser(id){
	var params = "pid="+id;
	var url = "PHP/removeuser.php";
	sendadminpost(params,url);	
}

function deactivateUser(id){
	var params = "pid="+id;
	var url = "PHP/deactivateuser.php";
	sendadminpost(params,url);	
}

function activateUser(id){
	var params = "pid="+id;
	var url = "PHP/activateuser.php";
	sendadminpost(params,url);	
}

function removeUserComments(id){
	var params = "pid="+id;
	var url = "PHP/removecomments.php";
	sendadminpost(params,url);	
}

function changeULevel(uid,mkid){
	var params = "uid="+uid+"&mkid="+mkid;
	var url = "PHP/changeULvl.php";
	sendadminpost(params,url);	
}	

function sendadminpost(params,url){
	var http = new XMLHttpRequest();
	http.open("POST", url, true);
	//Send the proper header information along with the request
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	
	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			loadadmin();
		}
	};
	http.send(params);	
}
	
function loadadmin(){
	$.get('PHP/admin.php', function(data) {
		if(data!="NULL" && data!=""){
			cur_site="admin";
			$('#content').html(data); 					
		}
	;});
}
//ADMIN END