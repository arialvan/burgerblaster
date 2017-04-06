<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
	$tabel = "outlet";
	$fild  = $_GET['id_ot'];
	$where = array("id_outlet" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="outletlist.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";

}else{echo"No Get Data";}
?>