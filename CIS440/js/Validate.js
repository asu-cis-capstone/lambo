//project
//Validate.js
//Spring 2015
//Siqian Tong

function Validate() {
	//We need 1 JS variable for each HTML element we want to validate
	var name = document.getElementById("name").value;
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var reenter = document.getElementById("reenter").value;
	var email = document.getElementById("email").value;
	var phone = document.getElementById("phone").value;
	
	//This variable will tell us when a field fails validation
	var failed = false;
	
	//This variable is used to display the messages in the alert box
	var msg="Please fill in/fix/select:";
	
	//These variables will be used to help validate username, pw, and email
	var dot = 0;
	var space = 0;
	var atSign = 0;
	
	//floating focus flags
	var f1 = 0;
	var f2 = 0;
	var f3 = 0;
	var f4 = 0;
	var f5 = 0;
	var f6 = 0;
	
	
	//Code  starts here
	//Validate name
	if (name=="")
	{
		document.getElementById("name").style.backgroundColor="yellow";
		f1 = 1;
		failed = true;
		msg = msg + "\n   Name";
	}
	else
	{
		if (name.trim().length < 4 || name.trim().length > 30)
		{
			document.getElementById("name").style.backgroundColor="red";
			document.getElementById("name").value="";
			f1 = 1;
			failed = true;
			msg = msg + "\n   Name: must be between 4 and 30 chars!";
		}
		else
		{
			document.getElementById("name").style.backgroundColor="white";
		}
			
	}
	
	//username
	if (username=="")
	{
		document.getElementById("username").style.backgroundColor="yellow";
		f2 = 1;
		failed = true;
		msg = msg + "\n   Username";
	}
	else
	{
		space = username.indexOf(" ");
		if (space != -1 || username.length < 4 || username.length > 15)
		{
			document.getElementById("username").style.backgroundColor="red";
			document.getElementById("username").value="";
			f2 = 1;
			failed = true;
			msg = msg + "\n   Username: 4-15 chars - no spaces!";
		}
		else
		{
			document.getElementById("username").style.backgroundColor="white";
		}
	}
	
	//password
	if (password=="")
	{
		document.getElementById("password").style.backgroundColor="yellow";
		f3 = 1;
		failed = true;
		msg = msg + "\n   Password";
	}
	else
	{
		space = password.indexOf(" ");
		if (space != -1 || password.trim().length < 4 || password.length > 15)
		{
			document.getElementById("password").style.backgroundColor="red";
			document.getElementById("reenter").style.backgroundColor="red";
			document.getElementById("password").value="";
			document.getElementById("reenter").value="";
			f3 = 1;
			failed = true;
			msg = msg + "\n   Password: 4-15 chars - no spaces!";
		}
		else
		{
			document.getElementById("password").style.backgroundColor="white";
		}
	}
	
	//reenter
	if (reenter=="")
	{
		document.getElementById("reenter").style.backgroundColor="yellow";
		f4 = 1;
		failed = true;
		msg = msg + "\n   Re-enter Password";
	}
	else
	{
		if (f3==0) {document.getElementById("reenter").style.backgroundColor="white";}
	}
	
	// do password match?
	if (password != reenter)
	{
		document.getElementById("password").style.backgroundColor="red";
		document.getElementById("reenter").style.backgroundColor="red";
		document.getElementById("password").value="";
		document.getElementById("reenter").value="";
		f3 = 1;
		failed = true;
		msg = msg + "\n   Password must match!";
	}
	
	//email
	if (email=="")
	{
		document.getElementById("email").style.backgroundColor="yellow";
		f5 = 1;
		failed = true;
		msg = msg + "\n   Email";
		
	}
	else
	{
		dot = email.lastIndexOf(".");
		space = email.indexOf(" ");
		atSign= email.indexOf("@");
		if (dot == -1 || space != -1 || atSign == -1 || email.length < 6 || email.length > 50)
		{
			document.getElementById("email").style.backgroundColor="red";
			document.getElementById("email").value="";
			f5 = 1;
			failed = true;
			msg = msg + "\n   Email: -50chars - no spaces - valid emails only!";
		}
		else
		{
			document.getElementById("email").style.backgroundColor="white";
		}
	}

	//Validate phone
	if (phone=="")
	{
		document.getElementById("phone").style.backgroundColor="yellow";
		f1 = 1;
		failed = true;
		msg = msg + "\n   Phone";
	}
	else
	{
		if (phone.trim().length == 10)
		{
			document.getElementById("phone").style.backgroundColor="red";
			document.getElementById("phone").value="";
			f1 = 1;
			failed = true;
			msg = msg + "\n   Phone: must be 10 numbers!";
		}
		else
		{
			document.getElementById("phone").style.backgroundColor="white";
		}
			
	}
	}
	
	//Code from here down stays at bottom!
	// Did anything fail?
	if (failed) {
		// massage box on -screen
		alert(msg);
		
		//check ff flags
		if (f6==1){document.getElementById("phone").focus();}
		if (f5==1){document.getElementById("email").focus();}
		if (f4==1){document.getElementById("reenter").focus();}
		if (f3==1){document.getElementById("password").focus();}
		if (f2==1){document.getElementById("username").focus();}
		if (f1==1){document.getElementById("name").focus();}
		
		// return control to the html
		return false;
	}
	
	//If we got to here, we passed validation, Yay!
	return true;
	
	
	
	
	
	
	

	
}