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
                        <div class="panel-heading">Form Edit Bahan Baku</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $idstockm=$_GET['idstockm'];
                                            $table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
                                            $fild  = "*"; 
                                            $where = " material_stock.id_stock_material='$idstockm'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                            
                                            foreach($hasil as $key );
                                            $name=array('id_material','material_name','qty_material','date_input');
                                            $var =array($key['id_material'],$key['material_name'],$key['qty_material'],$key['date_input']);
                                            $disable=array('','disabled','','');
                                            $count=count($name);
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_bahanbaku.php" method="post">
                                        	<input type="hidden" name="act" value="edit_stock" />
                                                <input type="hidden" name="id_stock" value="<?php echo $idstockm;?>" />
                                                <input type="hidden" name="bln" value="<?php echo $_GET['bln'];?>" />
                                                <input type="hidden" name="thn" value="<?php echo $_GET['thn']?>" />
                                            	<?php foreach($name as $key2 => $value){ ?>
                                                
                                                     <?php if($name[$key2]=='date_input'){ ?>
                                                        <label>Tanggal</label>
                                                        <input type="date" name="<?php echo $name[$key2]; ?>" class="form-control" value="<?php echo $var[$key2]; ?>" required />
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