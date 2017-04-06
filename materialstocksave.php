<?php  
include "connection.php";  

    if(!empty($_POST['name'])) {
	 $pk = $_POST['pk'];
         $name = $_POST['name'];
         $value = $_POST['value'];
                $stmt=$con->prepare("UPDATE material_stock SET qty_material = '".$value."' WHERE id_stock_material = '".$pk."'");
                $stmt->execute();
    }else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 422 Unprocessable entity');
    }
    
   
 ?>  