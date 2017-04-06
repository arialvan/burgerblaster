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
    					<h5>Daily Cash Book</h5>
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
                                <?php
                                    // Pendapatan Query
                                    $table = "product JOIN order_detail ON product.id_product=order_detail.product_code";
                                            $fild  = "*"; 
                                            $where = "DATE(order_detail.date_time)='$tanggal' AND product.id_outlet='$idot' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil2=($db->getResult());
			
                                            foreach($hasil2 as $key2){
                                            $sumQty[]=$key2['unit_price']*$key2['qty'];
                                            }
                                            @$income=array_sum($sumQty);
                                            
                                     // Pengeluaran Query
                                     $stmt=$con->prepare("SELECT *,SUM(purchase_detail.total_prc) AS spending FROM purchase JOIN purchase_detail ON purchase.id_purchase=purchase_detail.id_purchase
                                                          WHERE purchase.id_outlet=:id_outlet AND purchase.purchase_date=:tanggal");
                                        $stmt->bindValue(':id_outlet', $idot, PDO::PARAM_STR);
                                        $stmt->bindValue(':tanggal', $tanggal, PDO::PARAM_STR);
                                        $stmt->execute();	
                                        $keys = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $spend=$keys['spending'];
                                        
                                      // FixCost Query
                                     $stmt1=$con->prepare("SELECT *,SUM(fixed_cost.cost) AS COST FROM fixed_cost WHERE id_outlet=:id_outlet");
                                        $stmt1->bindValue(':id_outlet', $idot, PDO::PARAM_STR);
                                        $stmt1->execute();	
                                        $keys2 = $stmt1->fetch(PDO::FETCH_ASSOC);
                                        $cost=$keys2['COST'];
                                ?>
                                <table class="table table-condensed" style="border-collapse:collapse;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Information</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                            <td>1</td>
                                            <td>Income</td>
                                            <td class="text-success"><?php echo rupiah($income); ?></td>
                                            <td class="text-success">-</td>
                                        </tr>
                                        <tr >
                                            <td colspan="6" class="hiddenRow">
                                                <div class="accordian-body collapse" id="demo1"> 
                                                    <span class="text-danger">
                                                    <?php
                                                        foreach($hasil2 as $key3){
                                                        echo "- ".$key3['product_name']." . ".rupiah($key3['unit_price']); echo'</br>';
                                                        }
                                                    ?> 
                                                    </span>
                                                </div> 
                                            </td>
                                        </tr>
                                        <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                            <td>2</td>
                                            <td>Spending</td>
                                            <td class="text-success">-</td>
                                            <td class="text-success"><?php echo rupiah($spend); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="hiddenRow">
                                                <div id="demo2" class="accordian-body collapse">
                                                    <span class="text-danger">
                                                    <?php
                                                    $stmt=$con->prepare("SELECT * FROM material JOIN purchase_detail ON material.id_material=purchase_detail.id_material JOIN
                                                                         purchase ON purchase.id_purchase=purchase_detail.id_purchase WHERE purchase.id_outlet=:id_outlet AND purchase.purchase_date=:tanggal");
                                                            $stmt->bindValue(':id_outlet', $idot, PDO::PARAM_STR);
                                                            $stmt->bindValue(':tanggal', $tanggal, PDO::PARAM_STR);
                                                            $stmt->execute();	
                                                        while($var = $stmt->fetch()){
                                                        echo "- ".$var['material_name']." . ".rupiah($var['total_prc']); echo'</br>';
                                                        }
                                                    ?> 
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                                            <td>3</td>
                                            <td>Fix Cost</td>
                                            <td class="text-success">-</td>
                                            <td class="text-success"><?php echo rupiah($cost); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"  class="hiddenRow">
                                                <div class="accordian-body collapse" id="demo3"> 
                                                    <span class="text-danger">
                                                    <?php
                                                        $stmt=$con->prepare("SELECT * FROM fixed_cost WHERE id_outlet=:id_outlet");
                                                        $stmt->bindValue(':id_outlet', $idot, PDO::PARAM_STR);
                                                        $stmt->execute();	
                                                        while($keys3 = $stmt->fetch()){
                                                        echo "- ".$keys3['ket_cost']." . ".rupiah($keys3['cost']); echo'</br>';
                                                        }
                                                    ?> 
                                                    </span>
                                                </div>                                                 
                                            </td>
                                        </tr>
                                        
                                        <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                            <td>#</td>
                                            <td>Total</td>
                                            <td class="text-success"><?php echo rupiah($income); ?></td>
                                            <td class="text-success"><?php $tospend=$cost+$spend; echo rupiah($tospend); ?></td>
                                        </tr>
                                         
                                        <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                            <td></td>
                                            <td></td>
                                            <td class="text-success"></td>
                                            <td class="text-success"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"  class="hiddenRow">
                                                <div class="accordian-body collapse" id="demo3"> 
                                                    <span class="text-danger">
                                                    </span>
                                                </div>                                                 
                                            </td>
                                        </tr>
                                         <tr data-toggle="collapse" data-target="" class="accordion-toggle">
                                            <td>#</td>
                                            <td>Revenue Today</td>
                                            <td class="text-danger"><?php $revenue=$income-$tospend; echo rupiah($revenue); ?></td>
                                            <td class="text-success"></td>
                                        </tr>
                                    </tbody>
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

        
