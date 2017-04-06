<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
include "func/sex.php";
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
                        <div class="panel-heading">Form Edit Bahan Baku</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $table= "material";
                                            $fild  = "*"; 
                                            $where = "id_material='$_GET[id_material]'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                            foreach($hasil as $key );
                                            $name=array('id_material','material_name','unit','price');
                                            $var =array($key['id_material'],$key['material_name'],$key['unit'],$key['price']);
                                            $disable=array('disabled','','','');
                                            $count=count($name);
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_bahanbaku.php" method="post">
                                        	<input type="hidden" name="act" value="edit_material" />
                                                <input type="hidden" name="id_material" value="<?php echo $_GET['id_material']?>" />
                                            	<?php foreach($name as $key2 => $value){ ?>
                                                
                                                     <?php if($name[$key2]=='unit'){ ?>
                                                        <label>Satuan</label>
                                                                <select name="unit" class="form-control" required>
                                                                    <option value="<?php echo $key['id_material']; ?>"><?php echo $key['unit']; ?></option>
                                                                    <option value="kg">Kilogram</option>
                                                                    <option value="kg">Ons</option>
                                                                    <option value="pcs">Pcs</option>
                                                                    <option value="rak">Rak</option>
                                                                    <option value="lusin">Lusin</option>
                                                                    <option value="botol">Botol</option>
                                                                    <option value="butir">Butir</option>
                                                                    <option value="kotak">Kotak</option>
                                                                </select> 
                                                     <?php }else{?>
                                                        <label></label>
                                                        <input type="text" name="<?php echo $name[$key2]; ?>" class="form-control" value="<?php echo $var[$key2]; ?>" <?php echo $disable[$key2] ?> required /><br />
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
    			</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
<?php
include"footer.php";	
?>