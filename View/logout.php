<?php 
	session_start();
	setcookie('telefone');
	session_destroy();
	header("location:index.php");
?>