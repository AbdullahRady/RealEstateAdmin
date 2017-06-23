<?php

	//Connect to Database

	//Connection variables
	$host = "localhost";
	$db_username = "root";
	$db_password = "12345";
	$db_name = "elsawy";
	
	//Connection string
	mysql_connect("$host", "$db_username", "$db_password") or die("unable to connect to Database");
	
	//Selct Database
	mysql_select_db("$db_name") or die ("unable to select Database");

?>