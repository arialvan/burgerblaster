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
        <div id="page-wrapper">
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
                        
			$table = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material LEFT JOIN material_price ON material.id_material=material_price.id_material";
							$fild  = "material.*,outlet_stock.*,material_price.id_material as id,material_price.id_stock_outlet as idstock,material_price.price_sub"; 
                                                        $where = "outlet_stock.id_outlet='".$id."' AND material_price.id_outlet='".$id."'";
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
                                            <th>Set HPP</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            $no=1;
                                            foreach($hasil as $key )
                                            { 
                                        ?>
                                        <tr>
						<td><?php echo $key['id_material'] ?></td>
						<td><?php echo $key['material_name']?></td>
						<td><?php echo $key['unit']?></td>
                                                <td class="text-right">
                                                    <a href="#" class="editharga" data-type="text" data-pk="<?php echo $key['id_stock_outlet'].'#'.$key['id_material']; ?>" data-name="price_sub" data-url="outlethargasave.php" data-original-title="Enter Price"><?php echo $key['price_sub']; ?></a>
                                                </td>
                                                <td>
                                                    <a href="#" class="myeditable" data-type="text" data-pk="<?php echo $key['id_stock_outlet']; ?>" data-name="stock" data-url="outletstocksave.php" data-original-title="Enter Stock"><?php echo $key['qty_stock_outlet']; ?></a> <?php echo $key['unit']; ?>
                                                </td>  
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table> 
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
    <link href="assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/js/jquery-1.8.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script> 
            /*X-Edit Table*/
            $(document).ready(function() {
                $('.editharga').editable();
            });
            
             $(document).ready(function() {
                $('.myeditable').editable();
            });
            
            /*Data table*/
            $(document).ready(function () {
                $('#dataTables-example').dataTable(
                        {
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        });
            });
            
           
        </script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>

<?php 
}else{echo"Sorry No Data";}
?>