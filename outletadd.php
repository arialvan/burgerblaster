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
                        <div class="panel-heading">Add Outlet</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $name=array('id_outlet','outlet_name','phone');
                                            $type=array('text','text','number');
                                            $hold=array('Id Outlet','Nama Outlet','Phone');
                                            $requir=array('required','required','');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_outlet.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add" />
                                            
                                            	<?php foreach($name as $key => $value){ ?>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" placeholder="<?php echo $hold[$key]; ?>" required="<?php echo $requir[$key]; ?>"/><br />
                                                <?php } ?>
                                               <label>Alamat</label>
                                               		<textarea name="outlet_addr" class="form-control" rows="5"></textarea>
                                               <label>Logo</label>
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