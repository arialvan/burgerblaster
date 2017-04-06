<div class="panel panel-default">
                        <div class="panel-heading">Tambah Warehouse</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	
                                        <div class="form-group">
                                            <form action="crud/crud_warehouse.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add_warehouse" />
                                                <?php 
                                                //Provinsi
                                                    $table = "provinsi";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                    
                                                    //Kabupaten/kota
                                                    $table2 = "kabupaten";
                                                    $fild2  = "*"; 
                                                    $db->select($table2,$fild2);
                                                    $hasil2=($db->getResult());
                                                ?>
                                                
                                                <label>Nama Gudang</label>
                                                    <input type="text" name="namagudang" class="form-control" required />
                                                <br />
                                                <label>Provinsi</label>
                                                <select name="propinsi" id="propinsi" class="form-control" required>
                                                        <option value="">Pilih Provinsi</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id'] ?>"><?php echo $key['nama']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                <label>Kabupaten / Kota</label>
                                                <select name="kota" id="kota" class="form-control" required>
                                                        <option value="">Pilih Kabupaten/Kota</option>
                                                    <?php foreach($hasil2 as $key2){ ?>
                                                        <option value="<?php echo $key2['id'] ?>"><?php echo $key2['nama']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                <label>Alamat</label>
                                               		<textarea name="address" class="form-control" rows="5"></textarea>
                                            <br />
                                            <input type="submit" value="Simpan" class="btn btn-primary">
                                            <input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
    		</div>