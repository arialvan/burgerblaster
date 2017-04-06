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
                        <div class="panel-heading">Form Edit Hak Akses</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                            $table= "access JOIN users ON access.id_user=users.id_user";
                                            $fild  = "*"; 
                                            $where = "access.id_user='$_GET[id_user]'";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil=($db->getResult());
                                                foreach($hasil as $key );
                                                $name=$key['name'];
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_user.php" method="post" enctype="multipart/form-data" />
                                        	<input type="hidden" name="act" value="accessedit" />
                                                <input type="hidden" name="id_user" value="<?php echo $_GET['id_user'] ?>" />
                                                <label>Nama User</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $name;?>" disabled="disabled" /><br />
                                                    
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <tbody>
                                                        <td>Admin</td>
                                                        <td><input type="radio" name="admin" value="1">Ya
                                                            <input type="radio" name="admin" value="0">Tidak
                                                        </td>
                                                        <tr></tr>
                                                        <td>Waiters</td>
                                                        <td>
                                                            <input type="radio" name="waiters" value="1">Ya
                                                            <input type="radio" name="waiters" value="0">Tidak
                                                        </td>
                                                        <tr></tr>
                                                        <td>Chasier</td>
                                                        <td>    
                                                            <input type="radio" name="chasier" value="1">Ya
                                                            <input type="radio" name="chasier" value="0">Tidak
                                                        </td>
                                                        <tr></tr>
                                                        <td>CEO</td>
                                                        <td>
                                                            <input type="radio" name="ceo" value="1">Ya
                                                            <input type="radio" name="ceo" value="0">Tidak
                                                        </td>
                                                    </tbody>
                                                </table>
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