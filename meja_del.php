<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
$id = $_GET['id_meja'];
	$tabel = "meja";
	$fild  = $_GET['id_meja'];
	$where = array("id_meja" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="meja_list.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";

}else{echo"No Get Data";}
?>