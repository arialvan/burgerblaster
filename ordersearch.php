<?php
include "connection.php";
$q = trim(strip_tags($_GET['term'])); // variabel $q untuk mengambil data produk
$stmt=$con->prepare("SELECT * FROM product where product_name LIKE '%".$q."%' ORDER BY id_product ASC");
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                   while($key = $stmt->fetch()){ 
                                         $result[] = htmlentities(stripslashes($key['product_name'])); // manempilkan nama produk
                                   }
echo json_encode($result); // menampilkan data dengan format json
?>