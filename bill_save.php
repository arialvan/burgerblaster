<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
include "crud/class_crud.php";
$db = new crud();           
            $tabel = "order_first";
            $fild  = $_POST['id'];
            $where = "id_pes='".$fild."'"; 
            $status= 2;
            $data = array( 'status' => $status );
            $db->update($tabel,$data,$where);
            
            $tabel2 = "order_detail";
            $fild2  = $_POST['id'];
            $where2 = "id_pes='".$fild2."'"; 
            $data2  = array( 'status_detail' => $status );
            $db->update($tabel2,$data2,$where2);
            
            echo"<h3>Save Bill Success</h3>";
}else{
    echo "No Data Get";
}

?>

