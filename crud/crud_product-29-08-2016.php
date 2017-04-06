<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();
//function Compress Photo
$Kb	 = 1024;	// 1 Kb
$Mb	 = 1048576;	// 1 Mb

function compress($a,$Kb,$Mb){
	if ($a < (200*$Kb) ) {
		$compress='80';
		
	}elseif($a > $Mb && $a < (2*$Mb) ){
		$compress='20';
	
	}elseif($a > (200*$Kb) && $a < $Mb ){
		$compress='40';
	}else{
		$compress='10';	
	}
  return $compress;	
}


		$allow=array('image/jpeg','image/jpg');
		if($_SERVER['REQUEST_METHOD']=='POST'){ 
		
					//Create folder
					$date_y		= date('Y');
					$date_m		= date('F');
					$dtDir_01	= "../photo/produk/$date_y";
					$dtDir_02	= "../photo/produk/$date_y/$date_m/";
					$link	 	= $dtDir_02;
					$linkSave	= "$date_y/$date_m";
	
						if (!is_dir($dtDir_01)){
							mkdir($dtDir_01);
							mkdir($dtDir_02);
						}
						elseif (!is_dir($dtDir_02) ) {
							mkdir($dtDir_02);
						}
		
$act=$_POST['act'];
$tabel = "product";
$tabel2= "product_detail";
switch ($act){ 

/* ADD product */
case 'add_product':

$fild  = "id_product"; 
$where = "id_product='".$_POST['id_product']."'"; // tampilkan yang nim -> 0612502526

$db->select($tabel,$fild,NULL,$where);
if($hasil = $db->getResult()){ 
echo"Data Sudah pernah diinput";
}else{

$files	='foto';
		if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
		
				  $sizeFoto  = $_FILES[$files]['size'];
				  $compress  = compress($sizeFoto,$Mb,$Kb);
				  $imagename = $_POST['id_product'].'.jpg';
				  $source    = $_FILES[$files]['tmp_name'];
				  $target    = $link.$imagename;
				  move_uploaded_file($source, $target);
				  $imagepath = $imagename;
				  $save = $link.$imagepath; //This is the new file you saving
				  $file = $link.$imagepath; //This is the original file
				  list($width, $height) = getimagesize($file) ; 
				  $tn = imagecreatetruecolor($width, $height) ; 
				  $image = imagecreatefromjpeg($file) ; 
				  imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
		
				  imagejpeg($tn, $save, $compress) ; 
		}
		
	$data = array( 'id_product' => $_POST['id_product'],
                                   'id_outlet' => $_POST['outlet'],
                                   'kategori' => $_POST['kategori'],
                                   'jenis' => $_POST['jenis'],
                                   'product_name' => $_POST['product_name'],
				   'unit' => $_POST['unit'],
				   'unit_price'=> $_POST['unit_price'],
				   'product_foto' => $save
				  );
				
				echo $db->insert($tabel, $data);
				echo"Success";
				$url="../product_list.php?id=$_POST[outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
}	
break;
/* EDIT MAKANAN */
case 'edit_makanan':
	  $fild  = $_POST['id_product'];
	  $where = "id_product='".$fild."'"; 
	  
	  $files	='foto';
	  if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
				
						  $sizeFoto  = $_FILES[$files]['size'];
						  $compress  = compress($sizeFoto,$Mb,$Kb);
						  $imagename = $_POST['id_product'].'.jpg';
						  $source    = $_FILES[$files]['tmp_name'];
						  $target    = $link.$imagename;
						  move_uploaded_file($source, $target);
						  $imagepath = $imagename;
						  $save = $link.$imagepath; //This is the new file you saving
						  $file = $link.$imagepath; //This is the original file
						  list($width, $height) = getimagesize($file) ; 
						  $tn = imagecreatetruecolor($width, $height) ; 
						  $image = imagecreatefromjpeg($file) ; 
						  imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
						  imagejpeg($tn, $save, $compress) ; 
				
		
	$data = array( 'product_name' => $_POST['product_name'],
				   'unit' => $_POST['unit'],
				   'unit_price'=> $_POST['unit_price'],
				   'product_foto' => $save
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../product_list.php?id=$_POST[outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	  }else{
		  
		  $data = array( 'product_name' => $_POST['product_name'],
				   'unit' => $_POST['unit'],
				   'unit_price'=> $_POST['unit_price']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../product_list.php?id=$_POST[outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	  }
break;

/* ADD AKSES */
case 'add_komposisi':
$fild  = $_POST['id_product']; 
$where = "id_product='".$fild."'"; 
$db->select($tabel2,$fild,NULL,$where);

if($hasil = $db->getResult()){ 
//Delete
    $tabel2= "product_detail";
    $where1 = array("id_product" => $fild);
    echo $db->delete($tabel2,$where1);
//Insert Baru       
        foreach($_POST['bb'] as $keys => $val){
            
        $data2 = array( 'id_product' => $_POST['id_product'],
			'id_material' => $_POST['id_material'][$keys],
                                   'id_stock_outlet' => $_POST['bb'][$keys],
				   'stock_qty' => $_POST['qty'][$keys]
				  );
				
				echo $db->insert($tabel2,$data2);
        }
				echo"Data Update";
				//$url="../product_list.php?id=$_POST[id_outlet]";
				//echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
}else{
        foreach($_POST['bb'] as $keys => $val){
            
        $data2 = array( 'id_product' => $_POST['id_product'],
			'id_material' => $_POST['id_material'][$keys],
                                   'id_stock_outlet' => $_POST['bb'][$keys],
				   'stock_qty' => $_POST['qty'][$keys]
				  );
				
				echo $db->insert($tabel2, $data2);
        }
				echo"Success";
				$url="../product_list.php?id=$_POST[id_outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
}
break;

/* UPDATE AKSES */
case 'accessedit':
    $table2="access";
    $where ="id_user='$_POST[id_user]'";
       $data = array( 'id_user' => $_POST['id_user'],
				   'admin' => $_POST['admin'],
				   'waiters'=> $_POST['waiters'],
				   'chasier' => $_POST['chasier'],
				   'ceo' => $_POST['ceo']
				  );
				
				echo $db->update($table2, $data, $where);
				echo"Success";
				$url="../useraccess_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">"; 
	} //Switch
} // server request
?>