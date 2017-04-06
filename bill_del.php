<?php 
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
if($_SERVER['REQUEST_METHOD']=='GET'){
$id_pes=$_GET['id'];
//Insert Record
$table5 = "order_detail";
$fild5  = "*";
$where5 = "id_pes='$id_pes'";
$db->select($table5,$fild5,NULL,$where5);
$hasil5=$db->getResult();
foreach ($hasil5 as $keys){ 

    $tables="order_detail_rec";
    $data = array( 'id_index_pes' => $keys['id_index_pes'],
				   'id_pes' => $keys['id_pes'],
                                   'product_code' => $keys['product_code'],
                                   'qty' => $keys['qty'],
				   'date_time'=> $keys['date_time'],
				   'status_detail' => $keys['status_detail'],
                                   'id_user' => $_SESSION['ID']
				  );
    $db->insert($tables, $data);
}
//Delete Table Order
	$tabel = "order_first";
	$fild  = $id_pes;
	$where = array("id_pes" => $fild);
	echo $db->delete($tabel,$where);
        
//Update Status Meja
$tabel3 = "meja";
$id_meja=$_GET['id_meja'];
$sts_meja=0;
    $where3= "id_meja='$id_meja'";
    $data3 = array( 'status' => $sts_meja );
    $db->update($tabel3,$data3,$where3);
    
	echo"Delete Success";
	$url="order_bill_role.php";
	echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";

}else{echo"No Get Data";}
?>