<?php
include "crud/class_crud.php";
$db = new crud();
if(isset($_POST['id_product'])){  
        $id = explode("#",$_POST['id_product']);
        $idpro=$id[0];
        $idout=$id[1];
        $table5 = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material";
        $fild5  = "*"; 
        $where  = "outlet_stock.id_outlet='$idout' AND material.kategori='1'";
        $db->select($table5,$fild5,NULL,$where);
        if($hasil5=$db->getResult()){
        foreach ($hasil5 as $key) { ?>
        <input type="hidden" name="act" value="add_komposisi" />            
        <input type="hidden" name="id_product" value="<?php echo $idpro; ?>" /> 
        <input type="hidden" name="id_outlet" value="<?php echo $idout; ?>" />
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
<?php } } } ?>
