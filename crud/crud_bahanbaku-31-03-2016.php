<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

if($_SERVER['REQUEST_METHOD']=='POST'){ 
		
$act=$_POST['act'];
$iduser= $_SESSION['ID'];
$tabel = "material";
$tabel2= "material_stock";
$table3= "warehouse";
$tabel4= "outlet_stock";
switch ($act){ 

/* ADD Material */
case 'add_material':
$date  =$_POST['date_input'];
    $data = array( 'id_material' => $_POST['id_material'],
				   'material_name' => $_POST['material_name'],
				   'unit'=> $_POST['unit'],
				   'price' => $_POST['price']
				  );
                                echo $db->insert($tabel, $data);
				
    $data2 = array( 'id_wh' => $_POST['id_wh'],
                                   'id_material' => $_POST['id_material'],
				   'qty_material' => $_POST['qty_material'],
				   'date_input'=> $date,
				   'id_user' => $iduser
				  );
                                echo $db->insert($tabel2, $data2);
                                
                                echo"Success";
				$url="../material_list.php?id=$_POST[id_wh]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	
break;
/* UPDATE Material */
case 'edit_material':
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
          $id_wh = $_POST['id_wh'];
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
				$url="../material_list.php?id=$id_wh";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
            break;
/* Edit Stock */
case 'edit_stock':
          $idmaterial=$_POST['id_material'];
	  $fild  = $_POST['id_stock'];
          $date  = $_POST['date_input'];
	  $qty   = $_POST['qty_material'];
          $bln   = $_POST['bln'];
          $thn   = $_POST['thn'];
          $where = "id_stock_material='".$fild."'";
          
            $data2 = array( 'qty_material' => $qty,
				   'date_update'=> $date,
				   'user_update' => $iduser
				  );
                                echo $db->update($tabel2, $data2,$where);
                                
                                echo"Success";
				$url="../material_view.php?id_material=$idmaterial&bln=$bln&thn=$thn";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
            break;

/* Add Stock ke Outlet */
case 'add_maoutlet':
    //Filter ID Material
    $id_mat=$_POST['id_material'];
    $table5 = "outlet_stock";
        $fild5  = "*"; 
        $where5 = "id_material='".$id_mat."'";
        $db->select($table5,$fild5,NULL,$where5);
        $hasil5=$db->getResult();
        foreach($hasil5 as $key){
            echo $key['id_material'];
        if($key['id_material'] !=NULL){
            
	  $qty   = $_POST['secondBox'];
          $date  = date("Y-m-d");
          $where = "id_material='".$id_mat."'";
          
            $data2 = array( 'qty_stock_outlet' => $qty,
				   'date_update_ot'=> $date,
				   'user_update' => $iduser
				  );
                                echo $db->update($table5, $data2,$where);
                                
                                echo"Send Success";
				$url="../material_list.php";
				//echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
        }else{
	  $qty   = $_POST['secondBox'];
          $id_ot = $_POST['id_ot'];
          $date  = date("Y-m-d");
          
            $data2 = array( 'id_material' => $id_mat,
                                   'id_outlet' => $id_ot,
                                   'qty_stock_outlet' => $qty,
				   'date_input_ot'=> $date,
				   'id_user' => $iduser
				  );
                                echo $db->insert($tabel2, $data2);
                                
                                echo"Send Success";
				$url="../material_list.php";
				//echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
        }
        }
            break;

/* Add Stock ke Gudang */
case 'add_gudang':
    //Filter ID Material
    $id_mat=$_POST['id_material'];
    $id_wh1=$_POST['id_wh1'];
    $id_wh2=$_POST['id_wh2'];
    $id    =$_POST['id'];        
          $first = $_POST['gudang'];
	  $sec   = $_POST['stripgudang'];
          $trh   = $_POST['sisa'];
          $date  = date("Y-m-d");
          $where2 = "id_stock_material='".$id."'";
          $tabel2;
            $data = array( 'qty_material' => $trh,
				   'date_update'=> $date,
				   'user_update' => $iduser
				  );
                                echo $db->update($tabel2,$data,$where2);
                                
            $fild="*";
            $where3 = "id_material='".$id_mat."' AND id_wh='".$id_wh2."'";
            $db->select($tabel2,$fild,NULL,$where3);
            $hasil3=$db->getResult();
            foreach($hasil3 as $key){
            echo $qty    = $key['qty_material'];
            echo $tambah[] = $sec+$qty; 
            }
            
            $total=  array_sum($tambah);
            $data2 = array( 'qty_material' => $total,
				   'date_update'=> $date,
				   'user_update' => $iduser
				  );
                                echo $db->update($tabel2, $data2,$where3);                                
                                echo"Send Success";
				$url="../material_list.php?id=$id_wh1";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
        
            break;

/* Add Stock ke Gudang */
case 'add_shareoutlet':
    //Filter ID Material
        $id_mat=$_POST['id_material'];
        $id_ot =$_POST['id_ot'];  
        $id    =$_POST['id'];
          $first = $_POST['stok'];
	  $sec   = $_POST['kurangstok'];
          $trh   = $_POST['total'];
          $date  = date("Y-m-d");
          
    //If Row coun > 1
    $fild="*";
    $where="id_material='".$id_mat."' AND id_outlet='".$id_ot."'";
    $db->select($tabel4,$fild,NULL,$where);
    
    //foreach($hasil as $key){
        if($hasil=($db->getResult())){
            foreach($hasil as $key);
            $totaly=$key['qty_stock_outlet']+$sec;
            $data = array( 'id_material' => $id_mat,
				   'id_outlet'=> $id_ot,
				   'qty_stock_outlet' => $totaly,
                                   'date_input_ot' => $date,
                                   'id_user' => $iduser
				  );
                                echo $db->update($tabel4,$data,$where);
        }else{
            $data = array( 'id_material' => $id_mat,
				   'id_outlet'=> $id_ot,
				   'qty_stock_outlet' => $sec,
                                   'date_input_ot' => $date,
                                   'id_user' => $iduser
				  );
                                echo $db->insert($tabel4,$data);
        }
            
    //}      
                                
            $where3 = "id_stock_material='".$id."'";
            $data2 = array( 'qty_material' => $trh,
				   'date_update'=> $date,
				   'user_update' => $iduser
				  );
                                echo $db->update($tabel2, $data2,$where3);                                
                                echo"Send Success";
				$url="../material_list.php?id=$_POST[id_wh]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
        
            break;
	} //Switch
} // server request
?>