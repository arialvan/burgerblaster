<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){ 
include "crud/class_crud.php";
$db = new crud();	

if(!isset($_POST['username']) && !isset($_POST['password'])){
    echo '<h2 align=center>Enter your username and password</h2>';
    $url="login.php";
    echo "<meta http-equiv=\"REFRESH\" content=\"3;url=$url\">";
    exit();
}
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	
	$table="users JOIN outlet ON users.id_outlet=outlet.id_outlet";
	$fild ="*";
	$where="username='$username' AND pass='$password'";
	$db->select($table,$fild,NULL,$where);
	$hasil=($db->getResult());
	foreach($hasil as $key );
        if(@$key['id_user']==''){
            echo '<h2 align=center>Username atau password  salah</h2>';
            $url="login.php";
            echo "<meta http-equiv=\"REFRESH\" content=\"3;url=$url\">";
        }else{
				$id=$key['id_user'];
				$name=$key['name'];
				$lev =$key['level'];
                                $idOt=$key['id_outlet'];
		if($hasil>0){
					$_SESSION['ID']   = $id;
                                        $_SESSION['IDOT']   = $idOt;
					$_SESSION['name'] = $name;
					$_SESSION['level']= $lev;
					session_write_close();
					echo "berhasil";
			if($_SESSION['level']==3){
                            $url="orderadd_first.php";
                            echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
                        }else{
                            $url="index.php";
                            echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";
                        }
		}else{
			echo"Login Gagal";	
			$url="login.php";
			echo "<meta http-equiv=\"REFRESH\" content=\"1;url=$url\">";	
		}
        }

}else{
	echo"Error";	
}
?>