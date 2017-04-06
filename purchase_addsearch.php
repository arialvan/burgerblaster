<?php
//include"userotentifikasi.php";
include "connection.php";
  
$q = trim(strip_tags($_POST['query'])); // variabel $q untuk mengambil inputan user
$sql = $con->prepare("SELECT * FROM material WHERE material_name LIKE '%".$q."%'"); // menampilkan data yg ada didatabase yg sesuai dengan inputan user
$sql->execute();
$sql->setFetchMode(PDO::FETCH_ASSOC);	

while ($key2 = $sql->fetch()){
	$result[] = htmlentities(stripslashes($key2['material_name'])); // manempilkan nama jabatan
}
                               
echo json_encode($result); // menampilkan data dengan format json
?>