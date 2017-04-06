<div class="panel panel-default">
                        <div class="panel-heading">Tambah User</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $name=array('id_user','name','birth','birth_place','no_identity','phone','email','account_no','bank','account_name','username','pass');
                                            $type=array('text','text','date','text','text','text','email','text','text','text','text','password');//sex,address,level,pic
                                            $hold=array('Id User','Nama','Tanggal Lahir','Tempat Lahir','No KTP','No HP','email','No Rekening','Nama Bank','Nama Akun Bank','Username For Login','Password');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_user.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add" />
                                                <?php 
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                                <label>Outlet</label>
                                                <select name="id_ot" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" placeholder="<?php echo $hold[$key]; ?>" required /><br />
                                                <?php } ?>
                                                <label>Jenis Kelamin</label>
                                                	<select name="sex" class="form-control" required>
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
                                               		<textarea name="address" class="form-control" rows="5"></textarea>
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