<?php

	session_start();

	unset($_SESSION['adminlogin']);

	session_unset();

	session_destroy();
	
	header("location:login.php");

?>