<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
	$tabel = "material";
	$fild  = $_GET['id_material'];
	$where = array("id_material" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="material_list.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";

}else{echo"No Get Data";}
?>