<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

if($_SERVER['REQUEST_METHOD']=='POST'){ 
		
$act=$_POST['act'];
$iduser= $_SESSION['ID'];
$tabel = "warehouse";

switch ($act){ 

/* ADD Material */
case 'add_warehouse':
    $data = array( 'id_provinsi' => $_POST['propinsi'],
				   'id_kabupaten' => $_POST['kota'],
				   'name_wh'=> $_POST['namagudang'],
				   'address_wh' => $_POST['address']
				  );
                                $db->insert($tabel, $data);
                                echo"Success";
				$url="../warehouse_list.php";
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
	} //Switch
} // server request
?>