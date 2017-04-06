<?php
session_start();
//Unset Session
unset($_SESSION['ID'],$_SESSION['name'],$_SESSION['level'],$_SESSION['IDPES']);
session_destroy();

$url="login.php";
echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
exit();
?>