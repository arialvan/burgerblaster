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
                        <div class="panel-heading">Form Edit Outlet</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $table = "outlet";
                                            $fild  = "*"; 
                                            $where = "id_outlet='$_GET[id_ot]'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                                foreach($hasil as $key );
                                                $alamat=$key['outlet_addr'];
                                                $pic   =$key['logo'];
                                                $name=array('id_outlet','outlet_name','phone');
                                                $type=array('text','text','text');
                                                $var =array($key['id_outlet'],$key['outlet_name'],$key['phone']);
                                                $dis =array('disabled','','');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_outlet.php" method="post" enctype="multipart/form-data" />
                                        	<input type="hidden" name="act" value="edit" />
                                            <input type="hidden" name="id_outlet" value="<?php echo $_GET['id_ot'] ?>" />
                                            	<label></label>
                                                <img src="<?php echo "blester/".$pic;?>" width="200" height="200"/><br /><br />
                                               		<input type="file" name="foto" placeholder="Ganti Photo" > 
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" value="<?php echo $var[$key]; ?>" <?php echo $dis[$key]; ?> required /><br />
                                                <?php } ?>
                                               <label>Alamat</label>
                                               		<textarea name="outlet_addr" class="form-control" rows="5"><?php echo $alamat; ?></textarea>
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