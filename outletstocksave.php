<?php  
include "connection.php";  

    if(!empty($_POST['name'])) {
	 $pk = $_POST['pk'];
         $name = $_POST['name'];
         $value = $_POST['value'];
                $stmt=$con->prepare("UPDATE outlet_stock SET qty_stock_outlet = '".$value."' WHERE id_stock_outlet = '".$pk."'");
                $stmt->execute();
    }else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 422 Unprocessable entity');
    }
    
   
 ?>  