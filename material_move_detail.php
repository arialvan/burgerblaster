<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();

	$tabel = "material_stock";
	$fild  = $_GET['idstockm'];
        $idmaterial  = $_GET['id_material'];
        $bln   = $_GET['bln'];
        $thn   = $_GET['thn'];
	$where = array("id_stock_material" => $fild);
	
	echo $db->delete($tabel,$where);
	echo"Delete Success";
	$url="material_view.php?id_material=$idmaterial&bln=$bln&thn=$thn";
	echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";

}else{echo"No Get Data";}
?>