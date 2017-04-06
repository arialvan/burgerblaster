<?php
include "crud/class_crud.php";
$db = new crud();
$table = "users";
$fild  = "*"; 
$db->select($table,$fild);
$hasil=$db->getResult();
echo ($hasil);
?>