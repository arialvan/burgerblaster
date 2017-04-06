<?php
//include"../userotentifikasi.php";
include "class_crud.php";
$db = new crud();

$tabel = "meja";
$data = array( 'status' => 0);
echo $db->update($tabel,$data);

?>