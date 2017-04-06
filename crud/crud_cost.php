<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

if($_SERVER['REQUEST_METHOD']=='POST'){ 
		
$act=$_POST['act'];
$iduser= $_SESSION['ID'];
$tabel = "fixed_cost";

switch ($act){ 

/* ADD Cost */
case 'add_cost':
    $data = array( 'id_outlet' => $_POST['id_outlet'],'ket_cost' => $_POST['ket_cost'],'cost' => $_POST['cost'] );
    $db->insert($tabel, $data);


    echo"Success";
    $url="../cost_list.php";
    echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	
break;
/* UPDATE Cost*/
case 'edit_cost':
	  $fild  = $_POST['id_cost'];
	  $where = "id_cost='".$fild."'"; 
	  
             $data = array( 'id_outlet' => $_POST['id_outlet'],
				   'ket_cost' => $_POST['ket_cost'],
				   'cost'=> $_POST['cost']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../cost_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
            break;
	} //Switch
} // server request
?>