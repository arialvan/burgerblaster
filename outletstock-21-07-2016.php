<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['id_ot'])){ 
    $id=$_GET['id_ot'];
    $table2 = "outlet";
    $fild2  = "*"; 
    $where2 = "id_outlet='".$id."'";
    $db->select($table2,$fild2,NULL,$where2);
    $hasil2=($db->getResult());
    foreach($hasil2 as $key2 );
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
    					<h5><?php echo"welcom ".$_SESSION['name'];?></h5>
					</div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-family:fantasy; font-weight:bold; font-size:20px; text-align: left;">Bahan Baku <?php echo $key2['outlet_name']; ?></span>
                        </div>  
                        <div class="panel-body">
                        <?php
                        
			$table = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material";
							$fild  = "*"; 
                                                        $where = "outlet_stock.id_outlet='".$id."'";
							$db->select($table,$fild,NULL,$where);
							$hasil=($db->getResult());
						?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Bahan Baku</th>
                                            <th>Satuan</th>
                                            <th>@Harga</th>
                                            <th>Stock</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            foreach($hasil as $key )
                                            { 
                                        ?>
                                            <tr>
						<td><?php echo $key['id_material'] ?></td>
						<td><?php echo $key['material_name']?></td>
						<td><?php echo $key['unit']?></td>
                                                <td class="text-right"><?php echo rupiah($key['price']);?></td>
                                                <td><input type="text" name="stock" class="form-control" size="5" id="" value="<?php echo $key['qty_stock_outlet']?>" /></td>
						<td>
                                                    <a href='outletstock_edit.php?id_material=<?php echo $key['id_material']; ?>&id=<?php echo $key['id_stock_outlet']; ?>' title="Edit"><span class="glyphicon glyphicon-edit"></span></a> 
						</td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Kirim Stok ke Outlet</h4>
                                            </div>
                                        <form action="crud/crud_bahanbaku.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="showid"></span>
                                            
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="modal fade" id="ModalGudang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Kirim Stok ke Gudang</h4>
                                            </div>
                                        <form action="crud/crud_bahanbaku.php" method="post">
                                           
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="showid2"></span>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <br />
                            <input type="button" class="btn btn-default btn-lg" value="Add Bahan Baku" onclick="window.location='material_add.php'"/>
                            
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
     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
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
        <script>
		$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
            
            
            $('.view-outlet').click(function(){
            //$(document).on("click", ".view-id", function() {
                var id = $(this).data('id');
                /*$(".modal-body #showid").text(id);
                $('#myModal').modal('show');*/
                    
                $.ajax({
                type : 'post',
                url : 'material_modal.php', //Here you should put your query 
                data :  'id_material='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid').html(data);
                    $('#myModal').modal('show');
                 }
              });

            }); 
            
            $('.view-gudang').click(function(){
            //$(document).on("click", ".view-id", function() {
                var id = $(this).data('id');
                /*$(".modal-body #showid").text(id);
                $('#myModal').modal('show');*/
                    
                $.ajax({
                type : 'post',
                url : 'material_modal2.php', //Here you should put your query 
                data :  'id_material='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid2').html(data);
                    $('#ModalGudang').modal('show');
                 }
              });

            }); 
            
        </script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>

<?php 
}else{echo"Sorry No Data";}
?>