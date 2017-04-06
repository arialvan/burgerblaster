<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
include"header.php";
 
if(isset($_GET['id_material'])){$id_mat=$_GET['id_material'];}else{$id_mat='';}
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
                                           $table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
                                            $fild  = "*";
                                            $where = "material.id_material='$id_mat'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                            foreach($hasil as $key );
                                            
                                            $label=array('ID','Material Name','unit','Sisa Stock','Harga','Tanggal');
                                            $name=array('id_material','material_name','unit','qty_material','price','date_input');
                                            $hold=array($key['id_material'],$key['material_name'],$key['unit'],$key['qty_material'],$key['price'],$key['date_input']);
                                            $dis =array('disabled','disabled','disabled','','disabled','');
                                            $count=count($name);
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_bahanbaku.php" method="post">
                                        	<input type="hidden" name="act" value="add_materialGet" />
                                                <input type="hidden" name="id_material" value="<?php echo $id_mat;?>" />
                                                <input type="hidden" name="id_wh" value="<?php echo $key['id_wh'];?>" />
                                            	<?php foreach($name as $key => $value){ ?>
                                                
                                                     <?php if($name[$key]=='date_input'){?>
                                                        <label>Tanggal Input</label>
                                                                <input type="date" name="<?php echo $name[$key]; ?>" class="form-control" required /><br />
                                                     <?php }else{?>
                                                        <label><?php echo $label[$key]; ?></label>
                                                                <input type="text" name="<?php echo $name[$key]; ?>" class="form-control" value="<?php echo $hold[$key]; ?>" <?php echo $dis[$key]; ?> required /><br />
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