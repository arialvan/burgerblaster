<?php
include "crud/class_crud.php";
$db = new crud();
if(isset($_POST['id_product'])){  
        $id = explode("#",$_POST['id_product']);
        $idpro=$id[0];
        $idout=$id[1];
        $no =1;
        $table5 = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material";
        $fild5  = "*"; 
        $where  = "outlet_stock.id_outlet='$idout' AND material.kategori='1'";
        $db->select($table5,$fild5,NULL,$where);
        ?>
        <input type="hidden" name="act" value="add_komposisi" />            
        <input type="hidden" name="id_product" value="<?php echo $idpro; ?>" /> 
        <input type="hidden" name="id_outlet" value="<?php echo $idout; ?>" />
        <table>
            <thead>
                <th>&nbsp;</th>
                <th>Bahan Baku</th>
                <th></th>
                <th>Qty</th>
            </thead>
        <?php
            if($hasil5=$db->getResult()){
            foreach ($hasil5 as $key) { 
        ?>
                <tr>
                    <td width='20'><?php echo $no++.'.'; ?></td>
                    <td width='200'>
                        <input type="hidden" name="bb[]" id="bb" value="<?php echo $key['id_stock_outlet']; ?>" > 
                        <span><?php echo $key['material_name']; ?></span>
                    </td>
                    <td width='20'>:</td>
                    <td><input type="text" name="qty[]" size="5" value="0" /></td>
                    <td><input type="hidden" name="id_material[]" value="<?php echo $key['id_material']; ?>" class="form-control" /></td>
                </tr>
           
<?php } } } ?>
        </table>