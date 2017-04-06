<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['id'])){ 
$id_wh=$_GET['id'];
$table2 = "outlet";
$fild2  = "*"; 
$where2 = "id_outlet='".$id_wh."'";
$db->select($table2,$fild2,NULL,$where2);
$hasil2=($db->getResult());
foreach($hasil2 as $key2 );

//Akses
$table5 = "access";
$fild5  = "*"; 
$where5 = "id_user='$_SESSION[ID]'";
$db->select($table5,$fild5,NULL,$where5);
$hasil5=($db->getResult());
foreach($hasil5 as $key5 );
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
                            <span style="font-family:fantasy; font-weight:bold; font-size:20px; text-align: left;">Product <?php echo $key2['outlet_name']; ?></span>
                        </div>  
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#makanan" data-toggle="tab">Makanan</a></li>
                                <li class=""><a href="#minuman" data-toggle="tab">Minuman</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="table-responsive tab-pane fade active in" id="makanan">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>@Harga</th>
                                            <th>Foto</th>
                                            <th>Add</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        $table = "product";
							$fild  = "*"; 
                                                        $where = "id_outlet='".$id_wh."' AND kategori='1'";
							$db->select($table,$fild,NULL,$where);
							$hasil=($db->getResult());
                                            foreach($hasil as $key )
                                            { 
                                        ?>
                                            <tr>
						<td><?php echo $key['id_product'] ?></td>
						<td><?php echo $key['product_name']?></td>
						<td><?php echo rupiah($key['unit_price']);?></td>
                                                <td><img src="<?php echo "blester/".$key['product_foto'];?>" width="50" height="50"/></td>
                                                <td>
                                                   <a href="#KomMakanan" class="btn btn-primary btn-xs view-kommakanan" data-id="<?php echo $key['id_product']; ?>#<?php echo $key['id_outlet']; ?>" data-toggle="modal">Add Komposisi</a> 
                                                </td>
						<td>
                                                    <a href="#ViewMakanan" class="btn btn-primary btn-xs view-detil-makanan" data-id="<?php echo $key['id_product']; ?>" data-toggle="modal">View</a>
                                                    <a href="#EdMakanan" class="btn btn-primary btn-xs view-makanan" data-id="<?php echo $key['id_product']; ?>" data-toggle="modal">Edit</a>
                                                    <?php if($key5['admin']==1){ ?>
                                                    <a href="product_move.php?id=<?php echo $key['id_product']; ?>&ot=<?php echo $id_wh; ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to delete this product?')" >Delete</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                <div class="table-responsive tab-pane fade" id="minuman">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>@Harga</th>
                                            <th>Foto</th>
                                            <th>Add</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                        $table = "product";
							$fild  = "*"; 
                                                        $where = "id_outlet='".$id_wh."' AND kategori='2'";
							$db->select($table,$fild,NULL,$where);
							$hasil=($db->getResult());
                                            foreach($hasil as $key )
                                            { 
                                        ?>
                                            <tr>
						<td><?php echo $key['id_product'] ?></td>
						<td><?php echo $key['product_name']?></td>
						<td><?php echo rupiah($key['unit_price']);?></td>
                                                <td><img src="<?php echo "blester/".$key['product_foto'];?>" width="50" height="50"/></td>
                                                <td>
                                                    <a href="#KomMinuman" class="btn btn-primary btn-xs view-komminuman" data-id="<?php echo $key['id_product']; ?>#<?php echo $key['id_outlet']; ?>" data-toggle="modal">Add Komposisi</a>
                                                </td>
						<td>
                                                    <a href="#ViewMinuman" class="btn btn-primary btn-xs view-detil-minuman" data-id="<?php echo $key['id_product']; ?>" data-toggle="modal">View</a>
                                                    <a href="#EdMinuman" class="btn btn-primary btn-xs view-minuman" data-id="<?php echo $key['id_product']; ?>" data-toggle="modal">Edit</a>
                                                    <?php if($key5['admin']==1){?>
                                                    <a href="product_move.php?id=<?php echo $key['id_product']; ?>&ot=<?php echo $id_wh; ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to delete this product?')" >Delete</a>
                                                    <?php } ?>
						</td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            <!-- MODAL BOOTSTRAP -->
                            <!-- EDIT MAKANAN -->
                                 <div class="modal fade" id="EdMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" enctype="multipart/form-data" >
                                            
                                            <div class="modal-body">
                                        
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
                            <!-- KOMPOSISI MAKANAN -->
                                 <div class="modal fade" id="KomMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Komposisi Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
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
                            <!-- VIEW DETAIL MAKANAN -->
                                 <div class="modal fade" id="ViewMakanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">View Detail Makanan</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_ViewMakanan"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- EDIT MINUMAN -->
                                 <div class="modal fade" id="EdMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_EdMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- KOMPOSISI MINUMAN -->
                                 <div class="modal fade" id="KomMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Komposisi Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_KomMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- VIEW DETAIL MAKANAN -->
                                 <div class="modal fade" id="ViewMinuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">View Detail Minuman</h4>
                                            </div>
                                            <form action="crud/crud_product.php" method="post" >
                                            
                                            <div class="modal-body">
                                            <!-- this is modal -->
                                        
                                                <span id="show_ViewMinuman"></span>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- CLOSE MODAL BOOTSTRAP -->
                            <br />
                            <input type="button" class="btn btn-primary btn-lg" value="Add Product" onclick="window.location='product_add.php'"/>
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
    <?php include 'footer.php'; ?>
     <script type="text/javascript">       
            $('.view-makanan').click(function(){
                var id = $(this).data('id');
                $.ajax({
                type : 'post',
                url : 'product_makan_edit.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid').html(data);
                    $('#EdMakanan').modal('show');
                 }
              });

            }); 
            
            $('.view-kommakanan').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_makan_komposisi.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid2').html(data);
                    $('#KomMakanan').modal('show');
                 }
              });

            });
            
            $('.view-detil-makanan').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_detail_makanan.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_ViewMakanan').html(data);
                    $('#ViewMakanan').modal('show');
                 }
              });

            });
            
            $('.view-minuman').click(function(){
                var id = $(this).data('id');
                $.ajax({
                type : 'post',
                url : 'product_minum_edit.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_EdMinuman').html(data);
                    $('#EdMinuman').modal('show');
                 }
              });

            }); 
            
            $('.view-komminuman').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_minum_komposisi.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_KomMinuman').html(data);
                    $('#KomMinuman').modal('show');
                 }
              });

            }); 
            
            $('.view-detil-minuman').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_detail_minuman.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_ViewMinuman').html(data);
                    $('#ViewMinuman').modal('show');
                 }
              });

            });
            
        </script>
<?php 
}else{echo"Sorry No Data";}
?>