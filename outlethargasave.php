<?php  
include "connection.php";  

    if(!empty($_POST['name'])) {
         $pk = $_POST['pk'];
         $pecah=  explode("#",$pk);
         $pk1  = $pecah[0];
	 $pk2  = $pecah[1];
         $name = $_POST['name'];
         $value = $_POST['value'];
         
         /*Filter*/
            $stmt=$con->prepare("select * from material_price WHERE id_stock_outlet = '".$pk1."'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);	
            $key = $stmt->fetch();
            if($key['id_stock_outlet']!=NULL){

                $stmt=$con->prepare("UPDATE material_price SET $name = '".$value."' WHERE id_stock_outlet = '".$pk1."'");
                $stmt->execute();
            }else{
                $stmt=$con->prepare("insert into material_price (id_material,id_stock_outlet,price_sub) values ('".$pk2."','".$pk1."','".$value."')");
                $stmt->execute();
            }
    }else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 422 Unprocessable entity');
    }
    
   
 ?>  