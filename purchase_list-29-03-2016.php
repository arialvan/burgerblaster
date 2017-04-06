<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['tanggal'])){$tanggal=$_GET['tanggal'];}else{$tanggal=date('Y-m-d');}
if(isset($_GET['id_ot'])){$idot=$_GET['id_ot'];}else{$idot=$_SESSION['IDOT'];}
?>
<link href="assets/css/datetimepicker.css" rel="stylesheet" />
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                   <div class="col-md-12"> 
    					<h5>Daily Purchase</h5>
					</div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                                <form action="" method="get">  
                                  <?php 
                                    $table = "outlet";
                                    $fild  = "*"; 
                                    $db->select($table,$fild);
                                    $hasil=($db->getResult());
                                  ?>
                                    <div class="form-group input-group col-sm-12">
                                        <select name="id_ot" class="form-control" required>
                                                <option value="">Pilih Outlet</option>
                                                <?php foreach($hasil as $key){ ?>
                                                <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                <?php } ?>
                                        </select>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                    </div>
                                </form>
                            
                        </div>
                        <div class="panel-body">
                            <!-- TABEL HARIAN-->
                            <div class="table-responsive">
                                <form action="" method="get">
                                    <input type="hidden" name="id_ot" value="<?php echo $idot; ?> " />
                                        <div class="form-group input-group col-sm-3">
                                            <input type="text" name="tanggal" class="form-control" id="example1" placeholder="Search Date">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                        </div>
                                </form>   
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Information</th>
                                            <th>Qty</th>
                                            <th>@Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            $table = "purchase JOIN purchase_detail ON purchase.id_purchase=purchase_detail.id_purchase 
                                                      JOIN material ON purchase_detail.id_material=material.id_material";
                                            $fild  = "*"; 
                                            $where = "purchase.purchase_date='$tanggal' AND purchase.id_outlet='$idot' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil2=($db->getResult());
			
                                            foreach($hasil2 as $key2) { 
                                            $sumQty[]=$key2['total_prc'];
                                        ?>
                                            <tr>
						<td><?php echo $key2['material_name'];?></td>
						<td><?php echo $key2['qty_prc']."-".$key2['unit_prc']; ?></td>
                                                <td class="text-right"><?php echo rupiah($key2['price_prc']);?></td>
                                                <td class="text-right"><?php echo rupiah($key2['total_prc']);?></td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                        <tfoot>
                                            <tr class="bg-color-green">
                                                <th colspan="3" style="text-align:right">Total:</th>
                                                <th class="text-right"><?php @$totalnya=array_sum($sumQty); echo rupiah($totalnya); ?></th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br />
                                <input type="button" class="btn btn-primary btn-lg" value="Add Purchase" onclick="window.location='purchase_add.php'" />
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
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
     
        <script>
		$(document).ready(function () {
                $('.dataTables-example').dataTable();
            });
		
                $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
            
           
        </script>
        <script src="assets/js/custom.js"></script>     
   
</body>
</html>

        
