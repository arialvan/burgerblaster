<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
include"header.php";

if($_SERVER['REQUEST_METHOD']=='GET'){ 
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
                        <div class="panel-heading">Edit Cost</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                        <form action="crud/crud_cost.php" method="post">
                                        	<input type="hidden" name="act" value="edit_cost" />
                                                <input type="hidden" name="id_cost" value="<?php echo $_GET['id_cost']; ?>" />
                                                <?php 
                                                $table = "fixed_cost";
                                                    $fild  = "*"; 
                                                    $where = "id_cost='$_GET[id_cost]'";
                                                    $db->select($table,$fild,NULL,$where);
                                                    $hasil=($db->getResult());
                                                    foreach($hasil as $key);
                                                    
                                                    $table2 = "outlet";
                                                    $fild2  = "*"; 
                                                    $db->select($table2,$fild2);
                                                    $hasil2=($db->getResult());
                                                ?>
                                                <label>Outlet</label>
                                                <select name="id_outlet" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil2 as $key2){ ?>
                                                        <option value="<?php echo $key2['id_outlet'] ?>"><?php echo $key2['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                               <label>Information</label>
                                                    <input type="text" name="ket_cost" class="form-control" value="<?php echo $key['ket_cost']; ?>" />
                                               <label>Cost</label>
                                                    <input type="text" name="cost" class="form-control" value="<?php echo $key['cost']; ?>" />
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
<?php include"footer.php"; ?>

<?php }else{
        echo "No Data";
        $url="cost_list.php";
        echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$url\">";
} ?>