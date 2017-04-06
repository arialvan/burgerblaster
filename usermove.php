<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
	$tabel = "users";
	$fild  = $_GET['id_user'];
	$where = array("id_user" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="userlist.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";

}else{echo"No Get Data";}
?>