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
        <input type="text" name="product_name" class="form-control" value="<?php echo $value['product_name']; ?>" disabled="disabled" />
        <label>Price</label>
        <input type="text" name="unit_price" class="form-control" value="<?php echo $value['unit_price']; ?>" disabled="disabled" />
        <label>Satuan</label>
        <select name="unit" class="form-control" disabled="disabled">
            <option value="<?php echo $value['unit']; ?>"><?php echo $value['unit']; ?></option>
            <option value="pcs">Pcs</option>
            <option value="mangkuk">Mangkuk</option>
            <option value="gelas">Gelas</option>
            <option value="botol">Botol</option>
        </select> 
        <br /><br />
        <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Komposisi
                        </div>
                        <div class="panel-body">
                            <?php 
                                $table6 = "product_detail JOIN outlet_stock ON product_detail.id_stock_outlet=outlet_stock.id_stock_outlet
                                           RIGHT JOIN material ON outlet_stock.id_material=material.id_material";
                                $fild6  = "*";
                                $where6 = "product_detail.id_product='$value[id_product]'";
                                $db->select($table6,$fild6,NULL,$where6);
                                $hasil6 =$db->getResult();
                                foreach ($hasil6 as $key) { ?>

                                <ul>
                                    <li><?php echo $key['material_name']; ?></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Foto
                        </div>
                        <div class="panel-body">
                            <img src="blester/<?php echo $value['product_foto'] ?>" height="100" width="150" align="center" />
                        </div>
                    </div>
                </div>
        </div>
           <br /><br />
<?php } } } ?>
