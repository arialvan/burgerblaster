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
                        <div class="panel-heading">Form Add Meja</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $name=array('id_meja','no_meja');
                                            $type=array('text','text');
                                            $hold=array('Id Meja','Keterangan');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_meja.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="edit" />
                                                <?php 
                                                    $table = "outlet JOIN meja ON outlet.id_outlet=meja.id_outlet";
                                                    $fild  = "*"; 
                                                    $where = "meja.id_meja='$_GET[id_meja]'";
                                                    $db->select($table,$fild,NULL,$where);
                                                    $hasil=($db->getResult());
                                                    foreach($hasil as $row );
                                                ?>
                                                <label>Outlet</label>
                                                <?php 
                                                    $table1 = "outlet";
                                                    $fild1  = "*"; 
                                                    $db->select($table1,$fild1);
                                                    $hasil1=($db->getResult());
                                                ?>
                                                <select name="id_outlet" class="form-control" required>
                                                        <option value="<?php echo $row['id_outlet']; ?>"><?php echo $row['outlet_name']; ?></option>
                                                    <?php foreach($hasil1 as $key1){ ?>
                                                        <option value="<?php echo $key1['id_outlet'] ?>"><?php echo $key1['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <label></label>
                                                <input type="text" name="id_meja" value="<?php echo $row['id_meja']; ?>" class="form-control" readonly="readonly" />
                                                <label></label>
                                                    <input type="text" name="no_meja" value="<?php echo $row['no_meja']; ?>" class="form-control" /><br />
                                               <label>Foto Meja</label>
                                                    <span class="icon-box bg-color-red set-icon">
                                                        <i class=""><img src="<?php echo "burgerblaster/".$row['foto_meja']; ?>" class="user-image img-responsive" /></i>
                                                    </span>
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
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
<?php
include"footer.php";	
?>