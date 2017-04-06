<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
include "func/sex.php";
$db = new crud();
include"header.php";
@$id_wh=$_GET['id'];
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
                                            $table= "material JOIN material_stock ON material.id_material=material_stock.id_material";
                                            $fild  = "material.id_material,material.material_name,material.unit,material.price,material_stock.qty_material"; 
                                            $where = "material.id_material='$_GET[id_material]'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                            foreach($hasil as $key );
                                            $label=array('ID','Material Name','Satuan','Price','Qty');
                                            $name=array('id_material','material_name','unit','price','qty_material');
                                            $var =array($key['id_material'],$key['material_name'],$key['unit'],$key['price'],$key['qty_material']);
                                            $disable=array('disabled','','','','');
                                            $count=count($name);
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_bahanbaku.php" method="post">
                                        	<input type="hidden" name="act" value="edit_material" />
                                                <input type="hidden" name="id_material" value="<?php echo $_GET['id_material'];?>" />
                                                <input type="hidden" name="id" value="<?php echo $id_wh;?>" />
                                            	<?php foreach($name as $key2 => $value){ ?>
                                                
                                                     <?php if($name[$key2]=='unit'){ ?>
                                                        <label>Satuan</label>
                                                                <select name="unit" class="form-control" required>
                                                                    <option value="<?php echo $key['unit']; ?>"><?php echo $key['unit']; ?></option>
                                                                    <option value="kg">Kilogram</option>
                                                                    <option value="ons">Ons</option>
                                                                    <option value="gr">Gram</option>
                                                                    <option value="ml">ml</option>
                                                                    <option value="pcs">Pcs</option>
                                                                    <option value="sendok">Sendok Makan</option>
                                                                    <option value="butir">Butir</option>
                                                                    <option value="lembar">Lembar</option>
                                                                    <option value="batang">batang</option>
                                                                </select> 
                                                     <?php }else{?>
                                                        <label><?php echo $label[$key2]; ?></label>
                                                        <input type="text" name="<?php echo $name[$key2]; ?>" class="form-control" value="<?php echo $var[$key2]; ?>" <?php echo $disable[$key2] ?> required /><br />
                                                     <?php } } ?>
                                                        
                                                    <br />
                                                <input type="submit" value="Simpan" class="btn btn-primary">
                                                <input type=button value=Batal onclick="window.location='material_list.php?id=<?php echo $id_wh; ?>'" class="btn btn-danger">
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