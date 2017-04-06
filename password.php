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
                        <div class="panel-heading">Form Edit User</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $table = "users";
                                            $fild  = "*"; 
                                            $where = "id_user='$_GET[id_user]'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                                foreach($hasil as $key );
                                                $sex=$key['sex'];
                                                $level=$key['level'];
                                                $alamat=$key['address'];
                                                $pic   =$key['pic'];
                                                
                                                $label=array('User ID','Name','Username','Password');
                                                $name=array('id_user','name','username','pass');
                                                $type=array('text','text','text','password');//sex,address,level,pic
                                                $var =array($key['id_user'],$key['name'],$key['username'],$key['pass']);
                                                $dis =array('disabled','disabled','','');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_user.php" method="post" enctype="multipart/form-data" >
                                        	<input type="hidden" name="act" value="password" />
                                                <input type="hidden" name="id_user" value="<?php echo $_GET['id_user'] ?>" />
                                            	
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label><?php echo $label[$key]; ?></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" value="<?php echo $var[$key]; ?>" <?php echo $dis[$key]; ?> required /><br />
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