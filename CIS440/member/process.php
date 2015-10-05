<?php

	//project
	//process.php
	//Spring 2015
	//Siqian Tong
	
	//Connect to the db
	include('../connect/local-connect.php');
	
	//Get the user-entered data via POST
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	
	//Build the user name query
	$query = "select * from project where uname = '$uname'";
	
	//run the username query
	$result = mysqli_query($dbc, $query) or die('READ error!');
	
	//see if we got a row
	if (mysqli_num_rows($result) == 0)
	{
		header('Location: login.php?rc=1');
		exit;
	}
	
	//if we get here, we can validate a username. Yay!
	
	//Build an array from the query result
	$rec = mysqli_fetch_array($result);
	
	//check password
	if ($rec['pword'] != $pword)
	{
		header('Location: login.php?rc=2');
		exit;
	}
	
	//if we get here,  we can validate a username/password combo.Double Yey!
	
	//Name and atart a session
	session_name("customer");
	session_start("customer");
	
	//Close the db connection
	mysqli_close($dbc);
	
	//Set the PHP session variable and xfer control to welcome page
	$_SESSION["customer"] =  $rec["name"];
	header("Location: welcome.php");
	exit;

	
	

	//Pass a 3 back to login.php for testing
	//THIS CODE BLOCK MUST BE AT THE BOTTOM!
	header('Location: login.php?rc=3');
	exit;
	
?>







