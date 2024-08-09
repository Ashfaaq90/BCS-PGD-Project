// JavaScript Document
function checkLogin(){
	var un=document.getElementById('uname').value;
	var pwd=document.getElementById('pass').value;
	if(un=="" && pwd==""){
	document.getElementById('error').innerHTML="Blank User Name and Password";
	document.getElementById('uname').focus();
		return false;
	}
	
	if(un==""){
		document.getElementById('error').innerHTML="Blank User Name";
		document.getElementById('uname').focus();
		return false;	
		
	}
	if(pwd==""){
		document.getElementById('error').innerHTML="Blank Password";
		document.getElementById('pass').focus();
		return false;	
		
	}
	
}