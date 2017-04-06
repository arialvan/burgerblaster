<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
include"header.php";
?>
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12"> 
    					<h5><?php echo"welcom ".$_SESSION['name']; ?></h5>
					</div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Form Add Bahan Baku</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $name=array('id_material','material_name','unit','qty_material','price','date_input');
                                            $hold=array('Id Bahan Baku','Nama Bahan Baku','Satuan','Quantity (Isi dengan Angka)','Harga','tanggal');
                                            $count=count($name);
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_bahanbaku.php" method="post">
                                        	<input type="hidden" name="act" value="add_material" />
                                                
                                                <?php 
                                                    $table = "warehouse";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                                <select name="id_wh" class="form-control" required>
                                                        <option value="">Pilih Ware House</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_wh'] ?>"><?php echo $key['name_wh']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                
                                            	<?php foreach($name as $key => $value){ ?>
                                                
                                                     <?php if($name[$key]=='unit'){ ?>
                                                        <label>Satuan</label>
                                                                <select name="unit" class="form-control" required>
                                                                    <option value="">Pilih</option>
                                                                    <option value="kg">Kilogram</option>
                                                                    <option value="kg">Ons</option>
                                                                    <option value="pcs">Pcs</option>
                                                                    <option value="rak">Rak</option>
                                                                    <option value="lusin">Lusin</option>
                                                                    <option value="botol">Botol</option>
                                                                    <option value="sendok">Sendok</option>
                                                                    <option value="butir">Butir</option>
                                                                    <option value="kotak">Kotak</option>
                                                                    <option value="lembar">Lembar</option>
                                                                    <option value="batang">batang</option>
                                                                </select> 
                                                     <?php }elseif($name[$key]=='date_input'){?>
                                                        <label>Tanggal Input</label>
                                                                <input type="date" name="<?php echo $name[$key]; ?>" class="form-control" required /><br />
                                                     <?php }else{?>
                                                        <label></label>
                                                                <input type="text" name="<?php echo $name[$key]; ?>" class="form-control" placeholder="<?php echo $hold[$key]; ?>" required /><br />
                                                     <?php } } ?>
                                                        
                                                    <br />
                                            <input type="submit" value="Simpan" class="btn btn-primary">
											<input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
    		</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
<?php
include"footer.php";	
?>