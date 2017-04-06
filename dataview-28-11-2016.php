<?php
include"userotentifikasi.php";
include"header.php";
include "crud/class_crud.php";
$db = new crud();
//$id_wh=$_SESSION['ID'];
if(isset($_GET['id_wh'])){$warehouse=$_GET['id_wh']; }else{$warehouse=5;}
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
                <hr />
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <div class="liner"></div>
                                <li class="active">
                                    <a href="#warehouse" data-toggle="tab" title="warehouse">
                                        <span class="round-tabs one">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#outlet" data-toggle="tab" title="outlet">
                                        <span class="round-tabs two">
                                            <i class="glyphicon glyphicon-cutlery"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#product" data-toggle="tab" title="product">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#user" data-toggle="tab" title="user">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#customer" data-toggle="tab" title="customer">
                                        <span class="round-tabs five">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </span> 
                                    </a>
                                </li>
                            </ul>
                    </div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="warehouse">
                          <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <form action="" method="get">
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">
                                          <?php 
                                                    $tables = "warehouse";
                                                    $filds  = "*"; 
                                                    $wheres = "id_wh='".$warehouse."'";
                                                    $db->select($tables,$filds,NULL,$wheres);
                                                    $hasil=($db->getResult());
                                                    foreach($hasil as $key);
                                                ?>
                                            <select name="id_wh" class="form-control">
                                                        <option value="<?php echo $key['name_wh'] ?>"><?php echo $key['name_wh'] ?></option>
                                                    <?php 
                                                        $tables = "warehouse";
                                                        $filds  = "*"; 
                                                        $db->select($tables,$filds);
                                                        $hasil=($db->getResult());
                                                        foreach($hasil as $key){ 
                                                    ?>
                                                        <option value="<?php echo $key['id_wh'] ?>"><?php echo $key['name_wh']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                        </td>
                                        <td valign="middle"><input type="submit" class="btn btn-sm btn-primary" value="Search" /></td>
                                     </tr>
                                </table>  
                                </form> 
                            </div>
                                <div class="panel-body">
                                <?php
                                    $table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
							$fild  = "*"; 
                                                        $where = "material_stock.id_wh='".$warehouse."'";
							$db->select($table,$fild,NULL,$where);
							$hasil=($db->getResult());
                                ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bahan Baku</th>
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
						<td><?php echo $key['material_name']?></td>
                                                <td>
                                                    <a href="#" class="editstok" data-type="text" data-pk="<?php echo $key['id_stock_material']; ?>" data-name="stock" data-url="materialstocksave.php" data-original-title="Enter Stock"><?php echo $key['qty_material']; ?></a>&nbsp;&nbsp; <?php echo $key['unit']?>
                                                </td>
                                               <td>
                                                   <a href="#myModal" class="btn btn-primary btn-xs view-outlet" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal">ke Outlet</a>
                                                   <a href="#ModalGudang" class="btn btn-primary btn-xs view-gudang" data-id="<?php echo $key['id_material']; ?>#<?php echo $key['id_wh']; ?>" data-toggle="modal">ke Gudang</a>
                                               </td>
						<td>
                                                    <a href='material_edit.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Edit"><span class="glyphicon glyphicon-edit"></span></a> |
                                                    <a href='material_move.php?id_material=<?php echo $key['id_material'] ?>&id=<?php echo $id_wh; ?>' title="Remove" onclick="return confirm('Are you sure delete this item ?')"><span class="glyphicon glyphicon-remove"></span></a> |
						</td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                                    </div>
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
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="outlet">
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                     Outlet Table
                                </div>
                                <div class="panel-body">
                                <?php
				$table = "outlet";
				$fild  = "*"; 
				$db->select($table,$fild);
				$hasil=($db->getResult());
				?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nama Outlet</th>
                                                <th>Phone</th>
                                                <th>Alamat</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php foreach($hasil as $key ) { ?>
                                        <tr>
                                            <td><?php echo $key['outlet_name'] ?></td>
                                            <td><?php echo $key['phone']?></td>
                                            <td><?php echo $key['outlet_addr']?></td>
                                            <td>
                                                <a href='outletedit.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-edit'>Edit</a>|
                                                <a href='outletmove.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-pencil'>Hapus</a>|
                                                <a href='outletstock.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-pencil'>View Stock</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                                <br />
                                    <input type="button" class="btn btn-primary btn-lg" value="Add Outlet" onclick="window.location='outletadd.php'"/>
                            </div>
                       </div> 
                    </div>
                    <div class="tab-pane fade" id="product">
                          tab 3
                      </div>
                      <div class="tab-pane fade" id="user">
                          tab 4
                      </div>
                      <div class="tab-pane fade" id="customer">
                        <div class="text-center">
                          <i class="img-intro icon-checkmark-circle"></i>
                        </div>
                        tab 5
                      </div>
                    <div class="clearfix"></div>
                    </div>
                </div>
            </div>
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
    
        $(function(){
        $('a[title]').tooltip();
        });
</script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>