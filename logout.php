<?php 
	include "methods.php";
	unset($_SESSION['username']);
	header("location:/login.php");
	die();
?>