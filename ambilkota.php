<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
        $propinsi = $_GET['propinsi'];
	$table = "kabupaten";
        $fild  = "*"; 
        $where = "id_prov='".$propinsi."'";
        $db->select($table,$fild,NULL,$where);
        $hasil=($db->getResult());
        echo "<option>-- Pilih Kabupaten/Kota --</option>";
        foreach($hasil as $key){
            echo"<option value='$key[id]'>$key[nama]</option>";
        }


}else{echo"No Get Data";}
?>