<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
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
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Meja 
                        </div>
                        <div class="panel-body">
                        <?php
							$table = "meja";
							$fild  = "*"; 
							$db->select($table,$fild);
							$hasil=($db->getResult());
						?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID Meja</th>
                                            <th>Keterangan</th>
                                            <th>Foto Meja</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
					foreach($hasil as $key )
					{ 
					?>
                                        <tr>
                                            <td><?php echo $key['id_meja'] ?></td>
                                            <td><?php echo $key['no_meja']?></td>
                                            <td><img src="photo/<?php echo $key['foto_meja']?>" width="100" height="80" /></td>
                                            <td>
                                                <a href='meja_edit.php?id_meja=<?php echo $key['id_meja'] ?>' class='fa fa-edit'>Edit</a>
						<a href='meja_del.php?id_meja=<?php echo $key['id_meja'] ?>' class='fa fa-pencil'>Hapus</a>
                                            </td>
					</tr>
					<?php } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                            <br />
                            <input type="button" class="btn btn-default btn-lg" value="Add Table" onclick="window.location='meja_add.php'"/>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
     <?php include 'footer.php';?>