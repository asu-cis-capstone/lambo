<!DOCTYPE html>

<!--
project
welcome.php
CIS 440
Siqian Tong
-->

<?php
	//Name and start our session
	session_name("customer");
	session_start("customer");
	
	//Check to see if user is already logged in 
	if (!isset($_SESSION["customer"]))
	{
		header('Location: login.php');
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
    <title>Welcome Page</title>

  </head>

  <body>
	
  
	<div id="header">	
      <p>
		  <a href="../index.htm">
		  <img src="../images/logo.png" alt=" On Point Logo" />
      </p>
  </div>
  		  <div id="header">
		<p class="sh2">Welcome Page</p>
	
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
		<p class="bold">Login successful!</p>
	</div>
	
	<form id="joinform" action="logout.php" method="post">
		
		<p>
			<?php
				echo "Hello! You are logged in as " . $_SESSION["customer"] . ".";
			?>
			
		</p>
		
		<p class="submit">
			<input type="submit" value="Logout!" onfocus="logoutmsg()" />
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