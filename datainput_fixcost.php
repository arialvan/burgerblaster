<div class="panel panel-default">
                        <div class="panel-heading">Pengeluaran Tetap</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                        <form action="crud/crud_cost.php" method="post">
                                        	<input type="hidden" name="act" value="add_cost" />
                                                <?php 
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                                <label>Outlet</label>
                                                <select name="id_outlet" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                               <label>Information</label>
                                                    <input type="text" name="ket_cost" class="form-control" placeholder="keterangan pengeluaran" />
                                               <label>Cost</label>
                                                    <input type="text" name="cost" class="form-control" placeholder="Biaya"/>
                                            <br />
                                            <input type="submit" value="Simpan" class="btn btn-primary">
											<input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
    		</div>