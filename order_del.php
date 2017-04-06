<?php

if($_SERVER['REQUEST_METHOD']=='POST'){ 
include "crud/class_crud.php";
$db = new crud();
	$tabel = "order_detail";
	$fild  = $_POST['id'];
	$where = array("id_index_pes" => $fild);
	$db->delete($tabel,$where);
	echo"Delete Success";

}else{echo"No Get Data";}
?>