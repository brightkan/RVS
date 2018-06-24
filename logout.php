<?php
session_start();

session_destroy();
header("location:voter_login.php");
	exit();
 


?>