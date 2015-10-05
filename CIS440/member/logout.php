<?php

	//project
	//logout.php
	//Spring 2015
	//Siqian Tong
	
	session_name("customer");
	session_start("customer");
	session_unset("customer");
	session_destroy();
	header('Location: login.php');
	exit
	
?>