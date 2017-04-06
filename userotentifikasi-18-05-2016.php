<?php
session_set_cookie_params(0);
session_start();
 if(!isset($_SESSION['ID']))
 {
	echo "<script>alert('Anda Belum Login')</script>";	
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=login.php\">";
	exit();
 } 
?>