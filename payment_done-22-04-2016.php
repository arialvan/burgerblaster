<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['tanggal'])){$tanggal=$_GET['tanggal'];}else{$tanggal=date('Y-m-d');}
if(isset($_GET['bln'])){$bulan=$_GET['bln'];}else{$bulan=date('m');}
if(isset($_GET['thn'])){$tahun=$_GET['thn'];}else{$tahun=date('Y');}
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
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#harian" data-toggle="tab">Harian</a></li>
                                <li class=""><a href="#bulanan" data-toggle="tab">Bulanan</a></li>
                                <li class=""><a href="#tahunan" data-toggle="tab">Tahunan</a></li>
                            </ul>
                            <p>&nbsp;</p>
                        
                        <div class="tab-content">   
                            
                            <!-- TABEL HARIAN-->
                            <div class="table-responsive tab-pane fade active in" id="harian">
                                <form action="" method="get">
                                <div class="form-group input-group col-sm-5">
                                    <input type="hidden" name="id_ot" value="<?php echo $idot;?>" />
                                    <input type="text" name="tanggal" class="form-control" id="example1" placeholder="Search Date">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                </form>   
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Date</th>
                                            <th>Type Order</th>
                                            <th>Total Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            $table = "order_detail JOIN product ON order_detail.product_code=product.id_product";
                                            $fild  = "*"; 
                                            $where = "order_detail.status_detail='3' AND DATE(date_time)='$tanggal' AND product.id_outlet='$idot' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil2=($db->getResult());
			
                                            foreach($hasil2 as $key2) { 
                                                $sumQty[]=$key2['unit_price'];
                                        ?>
                                            <tr>
						<td><?php echo $key2['product_name'];?></td>
						<td><?php echo DateToIndo($key2['date_time']); ?></td>
                                                <td><?php echo type($key2['ket_pes']);?></td>
                                                <td class="text-right"><?php echo rupiah($key2['unit_price']);?></td>
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
                            
                            <!-- TABEL BULANAN-->
                            <div class="table-responsive tab-pane fade " id="bulanan">
                                <form action="" method="get">
                                <input type="hidden" name="id_ot" value="<?php echo $idot;?>" />
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">
                                        Bulan &nbsp;<select name="bln" class="form-control">
                                        <?php $bln=array(1=>"Jan","Feb","Mar","April","Mei","Juni","Juli","Agus","Sep","Okt","Nov","Dec"); ?>
                                        <option><?php echo $bulan; ?></option>
                                        <?php 
                                                        for($i=1;$i<=12;$i++){
                                                                if(strlen($i)==1){ 
                                                                        echo "<option value='0$i'>$bln[$i]</option>";
                                                                }else{
                                                                        echo "<option value=$i>$bln[$i]</option>";
                                                                }
                                                        }
                                                ?>
                                        </select>
                                        </td>
                                        <td valign="middle">Tahun 
                                          &nbsp; <select name="thn" id="tahun" class="form-control">
                                          <option><?php echo $tahun; ?></option>
                                          <?php 
                                                        $th=date('Y')+2;
                                                        for($t=2012;$t<$th;$t++){
                                                                if($t==($th-2)){ 
                                                                echo "<option selected>$t</option>";
                                                                }else{ 
                                                                echo "<option>$t</option>";
                                                                }			
                                                        }
                                                   ?>
                                               </select>
                                        </td>
                                        <td valign="middle"><br />  
                                        <input type="submit" class="btn btn-primary" value="Search">
                                        </td>
                                     </tr>
                                </table>  
                                </form>   
                                <br />  
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Date</th>
                                            <th>Time Order</th>
                                            <th>Total Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            $table = "order_detail JOIN product ON order_detail.product_code=product.id_product";
                                            $fild  = "*, DATE_FORMAT(date_time,'%H:%i:%s') AS Time"; 
                                            $where = "order_detail.status_detail='3' AND MONTH(date_time)='$bulan' AND YEAR(date_time)='$tahun' AND product.id_outlet='$idot' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil2=($db->getResult());
                                            foreach($hasil2 as $key2) { $total=($key2['qty']*$key2['unit_price']); $totalPrice[]= $total;
                                        ?>
                                            <tr>
						<td><?php echo $key2['product_name'];?></td>
						<td><?php echo DateToIndo($key2['date_time']); ?></td>
                                                <td class="text-center"><?php echo $key2['Time'];?></td>
                                                <td class="text-right"><?php echo rupiah($total); ?></td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                        <tfoot>
                                            <tr class="bg-color-green">
                                                <th colspan="3" style="text-align:right">Total:</th>
                                                <th class="text-right"><?php @$totalnya=array_sum($totalPrice); echo rupiah($totalnya); ?></th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <!-- TABEL TAHUNAN-->
                            <div class="table-responsive tab-pane fade " id="tahunan">
                                <form action="" method="get">
                                    <input type="hidden" name="id_ot" value="<?php echo $idot;?>" />
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">Tahun 
                                          &nbsp; <select name="thn" id="tahun" class="form-control">
                                          <option><?php echo $tahun; ?></option>
                                          <?php 
                                                        $th=date('Y')+2;
                                                        for($t=2012;$t<$th;$t++){
                                                                if($t==($th-2)){ 
                                                                echo "<option selected>$t</option>";
                                                                }else{ 
                                                                echo "<option>$t</option>";
                                                                }			
                                                        }
                                                   ?>
                                               </select>
                                        </td>
                                        <td valign="middle"><br />  
                                        <input type="submit" class="btn btn-primary" value="Search">
                                        </td>
                                     </tr>
                                </table>  
                                </form>   
                                
                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th>Product</th>
                                            <th>@Price</th>
                                            <th>Qty</th>
                                            <th class="text-center">Income</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php                                            
                                            $stmt=$con->prepare("SELECT * ,SUM(qty) AS Quantity  FROM product LEFT JOIN order_detail ON product.id_product=order_detail.product_code
                                                                WHERE status_detail='3' AND YEAR(order_detail.date_time)='$tahun' AND product.id_outlet='$idot' GROUP BY order_detail.product_code");
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                            $jumData=$stmt->rowCount();
                                           while($row = $stmt->fetch()){ 
                                               $total=($row['Quantity']*$row['unit_price']);
                                               $sumPrice[]=$total;
                                               $sumQty[]=$row['Quantity'];
                                        ?>
                                            <tr>
						<td><?php echo $row['product_name'];?></td>
                                                <td><?php echo rupiah($row['unit_price']);?></td>
						<td><?php echo $row['Quantity']; ?></td>
                                                <td class="text-right"><?php echo rupiah($total); ?></td>
                                                
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                        <tfoot>
                                            <tr class="bg-color-green">
                                                <th colspan="3" style="text-align:right">Total:</th>
                                                <th class="text-right"><?php @$totalnya=array_sum($sumPrice); echo rupiah($totalnya); ?></th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                            <br />
                                <input type="button" class="btn btn-primary btn-lg" value="Order Page" onclick="window.location='orderadd_first.php'" />
                                
                                <div class="modal fade" id="ViewDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="crud/crud_order.php" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Blaster</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <span id="show_View"></span>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary btn-circle" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
            
            $(function() { 
                // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    // save the latest tab; use cookies if you like 'em better:
                    localStorage.setItem('lastTab', $(this).attr('href'));
                });

                // go to the latest tab, if it exists:
                var lastTab = localStorage.getItem('lastTab');
                if (lastTab) {
                    $('[href="' + lastTab + '"]').tab('show');
                }
            });
            
           
        </script>
        <script src="assets/js/custom.js"></script>     
   
</body>
</html>

        
