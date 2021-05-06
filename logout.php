<?php		
	session_start();
	session_destroy();
	session_unset($_SESSION['NAME']);
	session_unset($_SESSION['LAST_ACTIVE_TIME']);
	header("Location:index.php");
	die();	
?>