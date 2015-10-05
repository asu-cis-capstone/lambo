<!DOCTYPE html>

<!--
project
login.php
CIS 440
Siqian Tong
-->

<?php
	//Name and start our session
	session_name("customer");
	session_start("customer");
	
	//Check to see if user is already logged in 
	if (isset($_SESSION["customer"]))
	{
		header('Location: welcome.php');
		exit;
	}

?>

<html lang="en">
  	
  <head>
    <!-- Meta tag -->
    <meta name="robots" content="noindex,nofollow" />
	<meta charset="utf-8" />
	
    <!-- Link tag for CSS -->
    <link type="text/css" rel="stylesheet" href="../stylesheet/member.css" />
	
	<!-- Link tag for Favicon -->
	<link type="image/logo" rel="icon" href="../images/smalllogo.PNG" />
	
	<!-- JavaAcript tags-->
	<script type="text/javascript" src="../js/message.js"></script>
	
	<!-- Web Page Title -->
    <title>Login Page</title>

  </head>

  <body>
	<div id="header">	
      <p>
		  <a href="../index.htm">
		  <img src="../images/logo.png" alt=" On Point Logo" />
      </p>
  </div>
  		  
		  
		<!--Account-->
		<p>
   <div id="navbars">
  
          <tr>
				<td><a href="../member/login.php"> Login</a></td>
				<td>or</td>
				<td><a href="../member"> Register</a></td>
		   </tr>     
	   </div >
	   </p>
  
  	<div id="navbars2">
			<p><a href="../index.htm"> Home</a></p>
			<p><a href="../serves"> Serves</a></p>
			<p><a href="../aboutus"> About Us</a></p>
			<p><a href="../conntactus"> Conntact Us</a></p>
			<p><a href="../gallery"> Gallery</a></p>
  </div >
  
 
	
	
	<div id="main">
		<p class="bold">Please enter your Username and Password below to login...</p>
	</div>
	
	<form id="joinform" action="process.php" method="post">
		<p class="fh1">Login Form</p>
		
		<?php
		if (isset($_GET["rc"]))
		{
			// Check return codes from process.php
			if ($_GET["rc"] == 1)
			{
				echo '<p class="logerr">Invalid Username!</p>';
			}
			if ($_GET["rc"] == 2)
			{
				echo '<p class="logerr">Invalid Password!</p>';
			}
			if ($_GET["rc"] == 3)
			{
				echo '<p class="logerr">Returned from process...</p>';
			}
		}
		
		
		
		?>
		<p>
			
			<!-- username -->
			<label for="username">UserName:</label>
			<input type="text" id="username" name="username" placeholder="username"
			required
			title="UserName: 4-15 chars, u/1 case letters, 0-9, and -_!$ only!"
			pattern="[a-zA-Z0-9-_!$]{4,15}"
			onfocus="usermsg()" autofocus
			/>
			<br />	

			<!-- password -->
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" placeholder="password"
			required
			title="Password: 5-15 chars, u/1 case letters, 0-9, and -_!$ only!"
			pattern="[a-zA-Z0-9-_!$]{5,15}"
			onfocus="passmsg()"   
			/>
			<br />			
			
		</p>
		
		<p class="submit">
			<input type="submit" value="Login!" onfocus="loginmsg()" />
			<span class="reset">
				<input type="reset" value="Clear Form!" 
				onclick="history.go(0)"
				onfocus="clearmsg()" />
			</span>
		</p>
	
	</form>
	
	<p id="jsmsgs"> </p>
	

	<div id="footer">
	<div id= "community">
   <td> Community </td>
   <p>
   <td><img src="../images/facebook.ico" alt=" Facebook Icon" /></td>
   <td><img src="../images/twitter.ico" alt=" Twitter Icon" /></td>
   <td><img src="../images/instagram.ico" alt=" Instagram Icon" /></td>
   </p>
   
   </div>
   
   <div id="information">
   <p> Scottsdale, Arizona </p>
   <p> 480-707-7744</p>
   <p> Be sure to check us out on Instagram</p>
   <p> @OnPointDetailing_Az</p>
   </div>
	
	<div id="paymentoptions"> 
	<td> Payment Options </td>
	<p>
   <td><img src="../images/cash.ico" alt="Cash Icon" /></td>
   <td><img src="../images/check.ico" alt="Check Icon" /></td>
   <td><img src="../images/visa.ico" alt="Visa Icon" /></td>
   <td><img src="../images/mastercard.ico" alt="Mastercard Icon" /></td>
   </p>
	
	</div>
 
  </div>
	
  </body>

</html>