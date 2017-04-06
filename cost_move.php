<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
	$tabel = "fixed_cost";
	$fild  = $_GET['id_cost'];
	$where = array("id_cost" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="cost_list.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";

}else{echo"No Get Data";}
?>