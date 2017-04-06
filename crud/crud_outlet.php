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
		$dtDir_01	= "../photo/outlet/$date_y";
		$dtDir_02	= "../photo/outlet/$date_y/$date_m/";
		$link	 	= $dtDir_02;
		$linkSave	= "$date_y/$date_m";
		
                    if (!is_dir($dtDir_01))
                    {
                        mkdir($dtDir_01);
			mkdir($dtDir_02);
                    }
                    elseif (!is_dir($dtDir_02) ) 
                    {
                        mkdir($dtDir_02);
                    }
		
$act=$_POST['act'];
$tabel = "outlet";
switch ($act){ 

/* ADD Outlet */
case 'add':

$fild  = $_POST['id_outlet']; 
ECHO $where = "WHERE id_outlet='".$fild."'"; 

$db->select($tabel,$fild,$where);
$hasil = $db->getResult();
if($hasil==0){
    echo"Maaf Data sudah pernah diinput";
    exit();
}

$files	='foto';
		if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
		
				  $sizeFoto  = $_FILES[$files]['size'];
				  $compress  = compress($sizeFoto,$Mb,$Kb);
				  $imagename = $_POST['id_outlet'].'.jpg';
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
		
	$data = array( 'id_outlet' => $_POST['id_outlet'],
				   'outlet_name' => $_POST['outlet_name'],
				   'outlet_addr'=> $_POST['outlet_addr'],
				   'phone' => $_POST['phone'],
				   'logo' => $save
				  );
				
				echo $db->insert($tabel, $data);
				echo"Success";
				/*$url="../outletlist.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";*/
	
break;
/* UPDATE Outlet */
case 'edit':
	  $fild  = $_POST['id_outlet'];
	  $where = "id_outlet='".$fild."'"; 
	  
	  $files	='foto';
	  if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
		$sizeFoto  = $_FILES[$files]['size'];
		$compress  = compress($sizeFoto,$Mb,$Kb);
		$imagename = $_POST['id_outlet'].'.jpg';
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
				
		
	$data = array( 'id_outlet' => $_POST['id_outlet'],
				   'outlet_name' => $_POST['outlet_name'],
				   'outlet_addr'=> $_POST['outlet_addr'],
				   'phone' => $_POST['phone'],
				   'logo' => $save
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../outletedit.php?id_ot=$_POST[id_outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }else{
		  
		$data = array( 'id_outlet' => $_POST['id_outlet'],
				   'outlet_name' => $_POST['outlet_name'],
				   'outlet_addr'=> $_POST['outlet_addr'],
				   'phone' => $_POST['phone']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Success";
				$url="../outletedit.php?id_ot=$_POST[id_outlet]";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }
            break;

/* UPDATE Stock Outlet */
case 'edit_stock_outlet':
          $id_wh =$_POST['id_ot'];
          $tabels="outlet_stock";
	  $fild  = $_POST['id_stock_outlet'];
	  $where = "id_stock_outlet='".$fild."'"; 
	  
          //Update tabel material
             $data = array( 'qty_stock_outlet' => $_POST['qty_stock_outlet'] );
             echo $db->update($tabels,$data,$where);
                                
        
				echo"Update Success";
				$url="../outletstock.php?id_ot=$id_wh";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
            break;
	} //Switch
} // server request
?>