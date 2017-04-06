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
                        <div class="panel-heading">Form Add Akses</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group">
                                            <form action="crud/crud_user.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="access" />
                                                <?php 
                                                    $table = "users";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                    $name  =array('admin','waiters','chasier','ceo');
                                                ?>
                                                <label>Pilih User</label>
                                                <select name="id_user" class="form-control" required>
                                                        <option value="">Pilih User</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_user'] ?>"><?php echo $key['name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                <label>Hak Akses User</label><br />
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
                                                        <tr></tr>
                                                        <td>Customer</td>
                                                        <td>
                                                            <input type="radio" name="client" value="1">Ya
                                                            <input type="radio" name="client" value="0">Tidak
                                                        </td>
                                                    </tbody>
                                                </table>
                                                        
                                                <br /><br />
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
 <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      
    <script src="assets/js/custom.js"></script>
     <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
     <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
       
        <script src="assets/js/custom.js"></script>
 </body>
</html>