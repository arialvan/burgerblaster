<?php

//#Delete - Contoh 
if($_SERVER['REQUEST_METHOD']=='GET'){ 
include "crud/class_crud.php";
$db = new crud();
        $outlet = $_GET['outlet'];
	$table = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material";
        //$table = "outlet_stock ";
        $fild  = "*"; 
        $where = "outlet_stock.id_outlet='".$outlet."'";
        $db->select($table,$fild,NULL,$where);
        foreach($hasil as $key){
    ?>
<table>
    <thead>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    </thead>
    <tr>
        <td width='200'><input type="checkbox" name="bb[]" id="bb" value="<?php echo $key['id_stock_outlet']; ?>" > <?php echo $key['material_name']; ?></td>
        <td width='20'>:</td>
        <td><input type="text" name="qty[]" class="form-control" placeholder="@qty" /></td>
    </tr>
</table>   
    <?php    }


}else{echo"No Get Data";}
?>