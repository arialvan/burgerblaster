<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
$id = $_GET['id'];
$ot = $_GET['ot'];
	$tabel = "product";
	$fild  = $id;
	$where = array("id_product" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="product_list.php?id=$ot";
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";

}else{echo"No Get Data";}
?>