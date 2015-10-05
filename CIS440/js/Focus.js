//Project
//Focus.js
//Spring 2015
//Siqian Tong

function Focus() {
	// give focus to first (name) filed
	document.getElementById("name").focus();
	
	//reset all bg colors
	document.getElementById("name").style.backgroundColor="white";
	document.getElementById("username").style.backgroundColor="white";
	document.getElementById("password").style.backgroundColor="white";
	document.getElementById("reenter").style.backgroundColor="white";
	document.getElementById("email").style.backgroundColor="white";
	document.getElementById("phone").style.backgroundColor="white";
}