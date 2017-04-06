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
					$dtDir_01	= "../photo/user/$date_y";
					$dtDir_02	= "../photo/user/$date_y/$date_m/";
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
$tabel = "users";
switch ($act){ 

/* ADD USER */
case 'add':

$fild  = "no_identity"; 
$where = "no_identity='".$_POST['no_identity']."'"; // tampilkan yang nim -> 0612502526

$db->select($tabel,$fild,$where);
if($hasil = $db->getResult()){ 
$hasil; //data di tampilkan dalam format json
}

$files	='foto';
		if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
		
				  $sizeFoto  = $_FILES[$files]['size'];
				  $compress  = compress($sizeFoto,$Mb,$Kb);
				  $imagename = $_POST['id_user'].'.jpg';
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
		
	$data = array( 'id_user' => $_POST['id_user'],
                                   'id_outlet' => $_POST['id_ot'],
				   'name' => $_POST['name'],
				   'birth'=> $_POST['birth'],
				   'birth_place' => $_POST['birth_place'],
				   'sex' => $_POST['sex'],
				   'no_identity' => $_POST['no_identity'],
				   'address' => $_POST['address'],
				   'phone' => $_POST['phone'],
				   'email' => $_POST['email'],
				   'account_no' => $_POST['account_no'],
				   'bank' => $_POST['bank'],
				   'account_name' => $_POST['account_name'],
				   'pass' => md5($_POST['pass']),
                                   'username' => $_POST['username'],
				   'level' => $_POST['level'],
				   'pic' => $save
				  );
				
				echo $db->insert($tabel, $data);
				echo"Success";
				$url="../userlist.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
	
break;
/* UPDATE USER */
case 'edit':
	  $fild  = $_POST['id_user'];
	  $where = "id_user='".$fild."'"; 
	  
	  $files	='foto';
	  if (isset($_FILES[$files]['name']) && $_FILES[$files]['name'] !=''){
				
						  $sizeFoto  = $_FILES[$files]['size'];
						  $compress  = compress($sizeFoto,$Mb,$Kb);
						  $imagename = $_POST['id_user'].'.jpg';
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
				
		
	$data = array( 'id_user' => $_POST['id_user'],
				   'name' => $_POST['name'],
				   'birth'=> $_POST['birth'],
				   'birth_place' => $_POST['birth_place'],
				   'sex' => $_POST['sex'],
				   'no_identity' => $_POST['no_identity'],
				   'address' => $_POST['address'],
				   'phone' => $_POST['phone'],
				   'email' => $_POST['email'],
				   'account_no' => $_POST['account_no'],
				   'bank' => $_POST['bank'],
				   'account_name' => $_POST['account_name'],
				   'level' => $_POST['level'],
				   'pic' => $save
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Update Success";
				$url="../useredit.php?id_user=$_POST[id_user]";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }else{
		  
		  $data = array( 'id_user' => $_POST['id_user'],
				   'name' => $_POST['name'],
				   'birth'=> $_POST['birth'],
				   'birth_place' => $_POST['birth_place'],
				   'sex' => $_POST['sex'],
				   'no_identity' => $_POST['no_identity'],
				   'address' => $_POST['address'],
				   'phone' => $_POST['phone'],
				   'email' => $_POST['email'],
				   'account_no' => $_POST['account_no'],
				   'bank' => $_POST['bank'],
				   'account_name' => $_POST['account_name'],
				   'level' => $_POST['level']
				  );
				
				echo $db->update($tabel,$data,$where);
				echo"Success";
				$url="../useredit.php?id_user=$_POST[id_user]";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">";
	  }
break;

/* ADD AKSES */
case 'access':
$table2="access";
       $data = array( 'id_user' => $_POST['id_user'],
				   'admin' => $_POST['admin'],
				   'waiters'=> $_POST['waiters'],
				   'chasier' => $_POST['chasier'],
				   'ceo' => $_POST['ceo'],
                                   'client' => $_POST['client']
				  );
				
				echo $db->insert($table2, $data);
				echo"Success";
				$url="../useraccess_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">"; 
break;

/* UPDATE AKSES */
case 'accessedit':
    $table2="access";
    $where ="id_user='$_POST[id_user]'";
       $data = array( 'id_user' => $_POST['id_user'],
				   'admin' => $_POST['admin'],
				   'waiters'=> $_POST['waiters'],
				   'chasier' => $_POST['chasier'],
				   'ceo' => $_POST['ceo'],
                                   'client' => $_POST['client']
				  );
				
				echo $db->update($table2, $data, $where);
				echo"Success";
				$url="../useraccess_list.php";
				echo "<meta http-equiv=\"REFRESH\" content=\"2;url=$url\">"; 
	} //Switch
} // server request
?>