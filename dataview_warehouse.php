<div class="panel panel-default">
    <div class="panel-heading">
        <form action="" method="get">
            <table  cellpadding="6" >
                <tr>
                    <td valign="middle">
                        <?php 
                            $tables = "warehouse";
                            $filds  = "*"; 
                            $wheres = "id_wh='".$warehouse."'";
                            $db->select($tables,$filds,NULL,$wheres);
                            $hasil=($db->getResult());
                            foreach($hasil as $key);
                        ?>
                        <select name="id_wh" class="form-control">
                            <option value="<?php echo $key['name_wh'] ?>"><?php echo $key['name_wh'] ?></option>
                            <?php 
                                $tables = "warehouse";
                                $filds  = "*"; 
                                $db->select($tables,$filds);
                                $hasil=($db->getResult());
                                foreach($hasil as $key){ 
                            ?>
                            <option value="<?php echo $key['id_wh'] ?>"><?php echo $key['name_wh']; ?></option>;
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
            $table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
            $fild  = "*"; 
            $where = "material_stock.id_wh='".$warehouse."'";
            $db->select($table,$fild,NULL,$where);
            $hasil=($db->getResult());
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Bahan Baku</th>
                        <th>Stock</th>
                        <th>Share Bahan Baku</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($hasil as $key ) { ?>
                    <tr>
                        <td><?php echo $key['material_name']?></td>
                        <td>
                            <a href="#" class="editstok" data-type="text" data-pk="<?php echo $key['id_stock_material']; ?>" data-name="stock" data-url="materialstocksave.php" data-original-title="Enter Stock"><?php echo $key['qty_material']; ?></a>&nbsp;&nbsp; <?php echo $key['unit']?>
                        </td>
                        <td>
                            <a href="#myModal" class="view-outlet" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal"><span class="text small">-Outlet</span></a><br/>
                            <a href="#ModalGudang" class="view-gudang" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal"><span class="text small">-Gudang</span></a>
                        </td>
			<td>
                            <a href='material_edit.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Edit"><span class="glyphicon glyphicon-edit"></span></a> |
                            <a href='material_move.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Remove" onclick="return confirm('Are you sure delete this item ?')"><span class="glyphicon glyphicon-remove"></span></a> |
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