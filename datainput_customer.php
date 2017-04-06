<div class="panel panel-default">
                        <div class="panel-heading">Tambah Customer</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $name=array('nama_cs','tl_cs','hp_cs','email_cs','username_cs','pass_cs');
                                            $type=array('text','date','text','email','text','password');
                                            $hold=array('Nama','Tanggal Lahir','No HP','email','Username For Login','Password');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_cs.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add" />
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" placeholder="<?php echo $hold[$key]; ?>" required /><br />
                                                <?php } ?>
                                                <label>Jenis Kelamin</label>
                                                	<select name="sex_cs" class="form-control" required>
                                                    	<option value="">Pilih</option>
                                                    	<option value="L">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                <label>Level</label>
                                                	<select name="level" class="form-control" required>
                                                    	<option value="">Pilih</option>
                                                    	<option value="1">Admin</option>
                                                        <option value="2">Chasier</option>
                                                        <option value="3">Waiters</option>
                                                        <option value="4">CEO</option>
                                                        <option value="5">Customer</option>
                                                    </select>
                                               <label>Alamat</label>
                                               		<textarea name="alamat_cs" class="form-control" rows="5"></textarea>
                                               <label>Foto</label>
                                               		<input type="file" name="foto" >
                                            <br />
                                            <input type="submit" value="Simpan" class="btn btn-primary">
											<input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
    		</div>