<div class="panel panel-default">
    <div class="panel-heading">
        <form action="" method="get">
            <table  cellpadding="6" >
                <tr>
                    <td valign="middle">
                        <?php 
                            $tables1 = "outlet";
                            $filds1  = "*"; 
                            $wheres1 = "id_outlet='".$idot."'";
                            $db->select($tables1,$filds1,NULL,$wheres1);
                            $hasil1=($db->getResult());
                            foreach($hasil1 as $key1);
                        ?>
                        <select name="id_ot" class="form-control">
                            <option value="<?php echo $key1['id_outlet'] ?>"><?php echo $key1['outlet_name'] ?></option>
                            <?php 
                                $tables2 = "outlet";
                                $filds2  = "*"; 
                                $db->select($tables2,$filds2);
                                $hasils2=($db->getResult());
                                foreach($hasils2 as $keys2){ 
                            ?>
                            <option value="<?php echo $keys2['id_outlet'] ?>"><?php echo $keys2['outlet_name']; ?></option>;
                            <?php } ?>
                        </select>
                    </td>
                    <td valign="middle"><input type="submit" class="btn btn-sm btn-primary" value="Search" /></td>
                </tr>
            </table>  
        </form> 
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>@Harga</th>
                                            <th>Add</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        $tables3 = "product";
							$filds3  = "*"; 
                                                        $wheres3 = "id_outlet='".$idot."'";
							$db->select($tables3,$filds3,NULL,$wheres3);
							$hasils3=$db->getResult();
                                            foreach($hasils3 as $keys3 )
                                            { 
                                        ?>
                                            <tr>
						<td>
                                                    <img src="<?php echo "blester/".$keys3['product_foto'];?>" width="50" height="50"/>
                                                    <span class="text-danger small"><?php echo $keys3['product_name']?></span>
                                                </td>
						<td><?php echo rupiah($keys3['unit_price']);?></td>
                                                <td>
                                                    <a href="#KomMakanan" class="view-kommakanan" data-id="<?php echo $keys3['id_product']; ?>#<?php echo $keys3['id_outlet']; ?>" data-toggle="modal"><span class="text small">Add Komposisi</span></a> 
                                                </td>
						<td>
                                                    <a href="#ViewMakanan" class="view-detil-makanan" data-id="<?php echo $keys3['id_product']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-arrow-right"></span></a>
                                                    <a href="#EdMakanan" class="view-makanan" data-id="<?php echo $keys3['id_product']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span></a>
                                                    <?php if($key5['admin']==1){ ?>
                                                    <a href="product_move.php?id=<?php echo $keys3['id_product']; ?>&ot=<?php echo $id_wh; ?>" onclick="return confirm('Are you sure you want to delete this product?')" ><span class="glyphicon glyphicon-remove"></span></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
        </div>
    </div>
</div><!-- MODAL BOOTSTRAP -->
                            <!-- EDIT MAKANAN -->
                                 <div class="modal fade" id="EdMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" enctype="multipart/form-data" >
                                            
                                            <div class="modal-body">
                                        
                                                <span id="showid"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- KOMPOSISI MAKANAN -->
                                 <div class="modal fade" id="KomMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Komposisi Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="showid2"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- VIEW DETAIL MAKANAN -->
                                 <div class="modal fade" id="ViewMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">View Detail Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_ViewMakanan"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- EDIT MINUMAN -->
                                 <div class="modal fade" id="EdMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_EdMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- KOMPOSISI MINUMAN -->
                                 <div class="modal fade" id="KomMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Komposisi Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_KomMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- VIEW DETAIL MAKANAN -->
                                 <div class="modal fade" id="ViewMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">View Detail Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_ViewMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- CLOSE MODAL BOOTSTRAP -->