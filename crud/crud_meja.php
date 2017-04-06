<?php
include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();
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
					$dtDir_01	= "../photo/meja/$date_y";
					$dtDir_02	= "../photo/meja/$date_y/$date_m/";
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
$tabel = "meja";
switch ($act){ 

/* ADD USER */
case 'add':

$fild  = $_POST['id_meja']; 
$where = "id_meja='".$fild."'"; 
$db->select($tabel,$fild,$where);
if($hasil = $db->getResult()){ 
   $hasil;
}

$files	='foto';
		if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
				  $sizeFoto  = $_FILES[$files]['size'];
				  $compress  = compress($sizeFoto,$Mb,$Kb);
				  $imagename = $_POST['id_meja'].'.jpg';
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
                                  
                                  
                     $data = array( 'id_meja' => $_POST['id_meja'],
                                   'id_outlet' => $_POST['id_ot'],
				   'no_meja' => $_POST['no_meja'],
				   'foto_meja' => $save
				  );
				
				echo $db->insert($tabel, $data);
				echo"Success";
				$url="../meja_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
                }else {
                    $data = array( 'id_meja' => $_POST['id_meja'],
                                   'id_outlet' => $_POST['id_ot'],
				   'no_meja' => $_POST['no_meja']
				  );
				
				echo $db->insert($tabel, $data);
				echo"Success";
				$url="../meja_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
                    
                    
                    
                }
		
	
	
break;
/* UPDATE Meja */
case 'edit':
	  $fild  = $_POST['id_meja'];
	  $where = "id_meja='".$fild."'"; 
	  
	  $files	='foto';
	  if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
				
						  $sizeFoto  = $_FILES[$files]['size'];
						  $compress  = compress($sizeFoto,$Mb,$Kb);
						  $imagename = $_POST['id_meja'].'.jpg';
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
				   'no_meja' => $_POST['no_meja'],
				   'foto_meja' => $save
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../meja_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }else{
		  
		  $data = array( 'id_outlet' => $_POST['id_outlet'],
				   'no_meja' => $_POST['no_meja']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../meja_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }
break;
	} //Switch
} // server request
?>