<?php  
include "connection.php";  

    if(!empty($_POST['name'])) {
	 $pk = $_POST['pk'];
         $name = $_POST['name'];
         $value = $_POST['value'];
                $stmt=$con->prepare("UPDATE material SET price = '".$value."' WHERE id_material = '".$pk."'");
                $stmt->execute();
    }else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 422 Unprocessable entity');
    }
    
   
 ?>  