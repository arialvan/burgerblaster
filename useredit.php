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
                                                
                                                $label=array('User ID','Name','Birth','Birth Place','No Identity','Phone','Email','Account Number','Bank','Account Name');
                                                $name=array('id_user','name','birth','birth_place','no_identity','phone','email','account_no','bank','account_name');
                                                $type=array('text','text','date','text','text','text','email','text','text','text');//sex,address,level,pic
                                                $var =array($key['id_user'],$key['name'],$key['birth'],$key['birth_place'],$key['no_identity'],$key['phone'],$key['email'],$key['account_no'],$key['bank'],$key['account_name']);
                                                $dis =array('disabled','','','','','','','','','','');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_user.php" method="post" enctype="multipart/form-data" >
                                        	<input type="hidden" name="act" value="edit" />
                                                <input type="hidden" name="id_user" value="<?php echo $_GET['id_user'] ?>" />
                                            	<label></label>
                                                        <img src="<?php echo "blester/".$pic;?>" width="200" height="200"/><br /><br />
                                               		<input type="file" name="foto" class="form-group-sm" /> 
                                            	<?php foreach($name as $key => $value){ ?>
                                                <label><?php echo $label[$key]; ?></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" value="<?php echo $var[$key]; ?>" <?php echo $dis[$key]; ?> required /><br />
                                                <?php } ?>
                                                <label>Sex</label>
                                                	<select name="sex" class="form-control" required >
                                                    	<option value="<?php echo $sex; ?>" ><?php echo jenisKelamin($sex); ?></option>
                                                    	<option value="L">Male</option>
                                                        <option value="P">Female</option>
                                                    </select>
                                                <label>Level</label>
                                                	<select name="level" class="form-control" required>
                                                    	<option value="<?php echo $level; ?>" ><?php echo lev($level); ?></option>
                                                    	<option value="1">Admin</option>
                                                        <option value="2">Kasir</option>
                                                        <option value="3">Pelayan</option>
                                                        <option value="4">CEO</option>
                                                    </select>
                                               <label>Address</label>
                                               		<textarea name="address" class="form-control" rows="5"><?php echo $alamat; ?></textarea>
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