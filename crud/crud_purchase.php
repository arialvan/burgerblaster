<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

if($_SERVER['REQUEST_METHOD']=='POST'){ 
		
$act=$_POST['act'];
$iduser= $_SESSION['ID'];
$tabel = "purchase";
$tabel2= "purchase_detail";

switch ($act){ 

/* ADD Material */
case 'add_purchase':
    $data = array( 'id_outlet' => $_POST['id_outlet'],'purchase_date' => $_POST['purchase_date']);
    $db->insert($tabel, $data);

// Menampilkan id terakhir
    $fild  = "*"; 
    $where = "purchase_date='$_POST[purchase_date]' AND id_outlet='$_POST[id_outlet]' ORDER BY id_purchase DESC ";
    $db->select($tabel,$fild,NULL,$where);
    $hasil=($db->getResult());
    foreach($hasil as $key);
    $id_purchase=$key['id_purchase'];
    //$id_purchase=1;
    
    if(isset($_POST['id_material'])){
    $tabel2= "purchase_detail";       
            foreach($_POST['id_material'] as $keys => $values){
                    $price=$_POST['price_prc'][$keys];
                    $qty  =$_POST['qty_prc'][$keys];
                
                    echo $total=($price*$qty);                    echo '<br />';
               
                $data2 = array( 'id_purchase' => $id_purchase,
                                'id_material' => $_POST['id_material'][$keys],
                                'qty_prc' => $qty,
                                'unit_prc' => $_POST['unit_prc'][$keys],
                                'price_prc' => $price,
                                'total_prc' => $total
                                );
               $db->insert($tabel2, $data2);
            }
    }
    echo"Success";
    $url="../purchase_list.php";
    echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	
break;
/* UPDATE Material */
case 'edit_warehouse':
	  $fild  = $_POST['id_material'];
	  $where = "id_material='".$fild."'"; 
	  
             $data = array( 'id_material' => $_POST['id_material'],
				   'material_name' => $_POST['material_name'],
				   'unit'=> $_POST['unit'],
				   'price' => $_POST['price']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../material_edit.php?id_material=$_POST[id_material]";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
            break;
        
/* Add Stock baru */
case 'add_materialGet':
	  $fild  = $_POST['id_material'];
          $where = "id_material='".$fild."'";
          $date  = $_POST['date_input'];
	  $bln   = date('m');
          $thn   = date('Y');
            $data2 = array( 'id_material' => $_POST['id_material'],
				   'qty_material' => $_POST['qty_material'],
				   'date_update'=> $date,
				   'id_user' => $iduser
				  );
                                echo $db->update($tabel2, $data2, $where);
                                
                                echo"Success";
				$url="../material_view.php?id_material=$fild&bln=$bln&thn=$thn";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
            break;
        
/* Edit Purchase */
case 'editPurchase':
	  $fild  = $_POST['id_purchase'];
          $total = $_POST['qty_prc']*$_POST['price_prc'];
          $where = "id_purchase='".$fild."' AND id_material='".$_POST['id_material']."' ";
            $data2 = array( 'qty_prc' => $_POST['qty_prc'],
				   'price_prc'=> $_POST['price_prc'],
                                   'total_prc'=> $total
				  );
                                echo $db->update($tabel2, $data2, $where);
                                
                                echo"Success";
				$url="../purchase_list.php?id_ot=$_POST[id_outlet]&tanggal=$_POST[tgl]";
                                echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
            break;
	} //Switch
} // server request
?>