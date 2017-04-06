<?php 
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

if ($_SERVER["REQUEST_METHOD"]=="POST"){ 
		
$act=$_POST['act'];
$tabel = "order_first";
$tabel2= "order_detail";
$tabel3= "meja";
switch ($act){ 

/*=================================  
 * ADD ORDER 
 * ================================
 */
case 'order_add':
$id_outlet= $_SESSION['IDOT'];
$id_user  = $_SESSION['ID'];
$id_meja  = $_POST['id_meja'];
$ket_pes  = $_POST['ket_pes'];
$date     = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
$status   = 0;

    echo $data = array( 'id_outlet' => $id_outlet,
				   'id_user' => $id_user,
                                   'id_meja' => $id_meja,
                                   'ket_pes' => $ket_pes,
				   'date'=> $date,
				   'status' => $status
				  );
    $db->insert($tabel, $data);
    
// Select list order
$table5 = "order_first";
$fild5  = "id_pes";
$where5 = "id_outlet='$id_outlet' AND id_user='$id_user' AND id_meja='$id_meja' AND date='$date' AND status='$status' ";
$db->select($table5,$fild5,NULL,$where5);
$hasil5=$db->getResult();
foreach ($hasil5 as $value); 
$id_pes = $value['id_pes'];

//Insert Order Detail

    foreach($_POST['qty'] as $keys =>$val){
    $data2 = array( 'id_pes' => $id_pes,
                                   'product_code' => $_POST['id_product'][$keys],
				   'qty'=> $val,
				   'date_time' => $datetime,
                                   'status_detail' => $status
				  );
    echo $db->insert($tabel2, $data2); 
    }

//Update Status Meja
$sts_meja=1;
    $where3= "id_meja='$id_meja'";
    $data3 = array( 'status' => $sts_meja );
    $db->update($tabel3,$data3,$where3);
                                echo"Success";
				//$url="../order_bill_role.php";
				//echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	
break;


/*=================================  
 * ORDER TAMBAHAN 
 * ================================
 */

case 'order_add_tambahan':

if(isset($_POST['id_meja'])){$id_meja=$_POST['id_meja']; }else{$id_meja=0;}
$date     = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
$id_outlet= $_POST['id_outlet'];
$status   = 1;
$id_pes   = $_POST['id_pes'];   
// Insert ke order detail
if(isset($_POST['ket_opsi'])){
    foreach($_POST['ket_opsi'] as $opsi => $variable){
        echo $implode[]=$_POST['ket_opsi'][$opsi]; echo'<br />';
    } 
    $ket_opsi=  implode($implode);
    $data2 = array( 'id_pes' => $id_pes,
                                   'product_code' => $_POST['id_product'],
				   'id_user' => $id_user,
                                   'id_meja' => $id_meja,
				   'qty'=> $_POST['qty'],
				   'date_time' => $datetime,
                                   'status_detail' => $status,
                                   'ket_pes' => $_POST['ket_pes'],
                                   'ket_opsi' => $ket_opsi
				  );
    $db->insert($tabel2, $data2); 
}else{
    $ket_pes=0;
    $data2 = array( 'id_pes' => $id_pes,
                                   'product_code' => $_POST['id_product'],
				   'id_user' => $id_user,
                                   'id_meja' => $id_meja,
				   'qty'=> $_POST['qty'],
				   'date_time' => $datetime,
                                   'status_detail' => $status,
                                   'ket_pes' => $_POST['ket_pes']
				  );
    $db->insert($tabel2, $data2); 
    }

                                
                                echo"Success";
				$url="../order_bill.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	
break;


/*=================================  
 * SAVE BILL 
 * ================================
 */

case 'save_bill':
$id_pes=$_POST['id_pes'];
$status=2;
    $where= "id_pes='$id_pes'";
    $data = array( 'status' => $status );
    $db->update($tabel,$data,$where);
    
    $where1= "id_pes='$id_pes'";
    $data1 = array( 'status' => $status );
    $db->update($tabel1,$data1,$where1);
    
    echo"Success";
    $url="../payment_list.php";
    echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	
break;

	} //Switch
} // server request
?>