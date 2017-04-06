<div class="panel panel-default">
    <div class="panel-heading">
        <form action="" method="get">
            <table  cellpadding="6" >
                <tr>
                    <td valign="middle">
                        <?php 
                            $tables4 = "outlet";
                            $filds4  = "*"; 
                            $wheres4 = "id_outlet='".$idot."'";
                            $db->select($tables4,$filds4,NULL,$wheres4);
                            $hasil4=($db->getResult());
                            foreach($hasil4 as $key4);
                        ?>
                        <select name="id_ot" class="form-control">
                            <option value="<?php echo $key4['id_outlet'] ?>"><?php echo $key4['outlet_name'] ?></option>
                            <?php 
                                $tables6 = "outlet";
                                $filds6  = "*"; 
                                $db->select($tables6,$filds6);
                                $hasil6=($db->getResult());
                                foreach($hasil6 as $key6){ 
                            ?>
                            <option value="<?php echo $key6['id_outlet'] ?>"><?php echo $key6['outlet_name']; ?></option>;
                            <?php } ?>
                        </select>
                    </td>
                    <td valign="middle"><input type="submit" class="btn btn-sm btn-primary" value="Search" /></td>
                </tr>
            </table>  
        </form> 
    </div>
    <div class="panel-body">
        <?php
            $table7 = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material LEFT JOIN material_price ON material.id_material=material_price.id_material";
            $fild7  = "material.*,outlet_stock.*,material_price.id_material as id,material_price.id_stock_outlet as idstock,material_price.price_sub"; 
            $where7 = "outlet_stock.id_outlet='".$idot."' AND material_price.id_outlet='".$idot."'";
            $db->select($table7,$fild7,NULL,$where7);
            $hasil7=($db->getResult());
        ?>
        <div class="table">
            <table class="table table-striped table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Bahan Baku</th>
                        <th>Set HPP</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($hasil7 as $key7 ) { 
                        if($key7['price_sub']<0){$price="empty";}else{$price=$key7['price_sub'];}
                        if($key7['qty_stock_outlet']<0){$unit="empty";}else{$unit=$key7['qty_stock_outlet'];}
                    ?>
                    <tr>
			<td><?php echo $key7['material_name']?></td>
                        <td>
                            <a href="#" class="editharga2" data-type="text" data-pk="<?php echo $key7['id_stock_outlet'].'#'.$key['id_material']; ?>" data-name="price_sub" data-url="outlethargasave.php" data-original-title="Enter Price"><?php echo $price; ?></a>
                        </td>
                        <td>
                            <a href="#" class="myeditable" data-type="text" data-pk="<?php echo $key7['id_stock_outlet']; ?>" data-name="stock" data-url="outletstocksave.php" data-original-title="Enter Stock"><?php echo $unit; ?></a>&nbsp; <?php echo $key7['unit']; ?>
                        </td>  
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Kirim Stok ke Outlet</h4>
                    </div>
                    <form action="crud/crud_bahanbaku.php" method="post" >
                        <div class="modal-body"><span id="showid"></span></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                                    
        <div class="modal fade" id="ModalGudang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Kirim Stok ke Gudang</h4>
                    </div>
                    <form action="crud/crud_bahanbaku.php" method="post">
                        <div class="modal-body"><span id="showid2"></span></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>