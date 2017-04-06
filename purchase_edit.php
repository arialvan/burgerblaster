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
                        <div class="panel-heading">Form Edit Cost</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $table = "purchase JOIN purchase_detail ON purchase.id_purchase=purchase_detail.id_purchase";
                                            $fild  = "*"; 
                                            $where = "purchase_detail.id_purchase='$_GET[id_purchase]' AND purchase_detail.id_material='$_GET[id_material]' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                                foreach($hasil as $key );
                                                
                                                $label=array('Ket','Qty','Harga');
                                                $name=array('id_material','qty_prc','price_prc');
                                                $type=array('text','text','text','text');
                                                $var =array($key['id_material'],$key['qty_prc'],$key['price_prc']);
                                                $dis =array('disabled','','');
					?>
                                        <div class="form-group">
                                            <form action="crud/crud_purchase.php" method="post">
                                        	<input type="hidden" name="act" value="editPurchase" />
                                                <input type="hidden" name="id_purchase" value="<?php echo $_GET['id_purchase'] ?>" />
                                            	<input type="hidden" name="id_material" value="<?php echo $_GET['id_material'] ?>" />
                                                <input type="hidden" name="id_outlet" value="<?php echo $key['id_outlet'] ?>" />
                                                <input type="hidden" name="tgl" value="<?php echo $key['purchase_date'] ?>" />
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label><?php echo $label[$key]; ?></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" value="<?php echo $var[$key]; ?>" <?php echo $dis[$key]; ?> /><br />
                                                <?php } ?>
                                               
                                             <br /> 
                                            <input type="submit" value="Simpan" class="btn btn-primary">
                                            <input type="button" value="Batal" onclick="self.history.back()" class="btn btn-danger">
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