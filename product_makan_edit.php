<?php
include "crud/class_crud.php";
$db = new crud();
if(isset($_POST['id_product'])){  
        $id = $_POST['id_product'];
        $table5 = "product";
        $fild5  = "*";
        $where5 = "id_product='$id'";
        $db->select($table5,$fild5,NULL,$where5);
        if($hasil5=$db->getResult()){
        foreach ($hasil5 as $value) { ?>
         
        <input type="hidden" name="act" value="edit_makanan" />
        <input type="hidden" name="id_product" value="<?php echo $id; ?>" />
        <input type="hidden" name="outlet" value="<?php echo $value['id_outlet']; ?>" />
        <label>ID Product</label>
        <input type="text" name="id_product" class="form-control" value="<?php echo $value['id_product']; ?>" disabled="disabled"/>
        <label>Product</label>
        <input type="text" name="product_name" class="form-control" value="<?php echo $value['product_name']; ?>" required />
        <label>Price</label>
        <input type="text" name="unit_price" class="form-control" value="<?php echo $value['unit_price']; ?>" required />
        <label>Satuan</label>
        <select name="unit" class="form-control" required>
            <option value="<?php echo $value['unit']; ?>"><?php echo $value['unit']; ?></option>
            <option value="pcs">Pcs</option>
            <option value="mangkuk">Mangkuk</option>
            <option value="gelas">Gelas</option>
            <option value="botol">Botol</option>
        </select> <br />
        <label>Foto</label>
        <img src="blester/<?php echo $value['product_foto'] ?>" height="250" width="400" />
        <input type="file" name="foto" class="form-control" />
<?php } } } ?>
