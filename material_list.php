<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['id'])){ 
$id_wh=$_GET['id'];
$table2 = "warehouse";
$fild2  = "*"; 
$where2 = "id_wh='".$id_wh."'";
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
                            <span style="font-family:fantasy; font-weight:bold; font-size:20px; text-align: left;">Bahan Baku <?php echo $key2['name_wh']; ?></span>
                        </div>  
                        <div class="panel-body">
                        <?php
			$table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
							$fild  = "*"; 
                                                        $where = "material_stock.id_wh='".$id_wh."'";
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
                                            <th>Stock</th>
                                            <th>Share Bahan Baku</th>
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
                                                <td>
                                                    <a href="#" class="editstok" data-type="text" data-pk="<?php echo $key['id_stock_material']; ?>" data-name="stock" data-url="materialstocksave.php" data-original-title="Enter Stock"><?php echo $key['qty_material']; ?></a>
                                                </td>
                                               <td>
                                                   <a href="#myModal" class="btn btn-primary btn-xs view-outlet" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal">ke Outlet</a>
                                                   <a href="#ModalGudang" class="btn btn-primary btn-xs view-gudang" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal">ke Gudang</a>
                                               </td>
						<td>
                                                    <a href='material_addGet.php?id_material=<?php echo $key['id_material'] ?>&bln=<?php echo date("m") ?>&thn=<?php echo date("Y") ?>' title="Add Stock" ><span class="glyphicon glyphicon-book"></span></a> |
                                                    <a href='material_view.php?id_material=<?php echo $key['id_material'] ?>&bln=<?php echo date("m") ?>&thn=<?php echo date("Y") ?>' title="View Detail"><span class="glyphicon glyphicon-arrow-right"></span></a> |
                                                    <a href='material_edit.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Edit"><span class="glyphicon glyphicon-edit"></span></a> |
                                                    <a href='material_move.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Remove"><span class="glyphicon glyphicon-remove"></span></a> |
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
                            <input type="button" class="btn btn-primary btn-lg" value="Add Material" onclick="window.location='material_add.php'"/>
                            
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
    <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
    <link href="assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/js/jquery-1.8.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    
    <script src="assets/bootstrap3-editable/js/bootstrap-editable.js"></script>
     <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            /*X-EditTables*/
            $(document).ready(function() {
                $('.editharga').editable();
            });
            
            $(document).ready(function() {
                $('.editstok').editable();
            });
                     
            
            /*DataTables*/
		$(document).ready(function () {
                $('#dataTables-example').dataTable(
                        {
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        });
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