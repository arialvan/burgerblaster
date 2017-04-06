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

//Access Menu
$table7="access";
$fild7  = "*"; 
$where7 = "id_user='$_SESSION[ID]'";
$db->select($table7,$fild7,NULL,$where7);
$dt7=($db->getResult());				
foreach($dt7 as $key7 );
$admin=$key7['admin']; $waiters=$key7['waiters']; $chasier=$key7['chasier']; $ceo=$key7['ceo']; $client=$key7['client'];

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
                             <?php if($admin==1){?>
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
                             <?php } ?>
                        </div>
                        <div class="panel-body">
                            <?php if($admin==1){?>
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
                            <?php } ?>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Amount</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $table = "order_first ";
                                                    $fild  = "id_pes,id_meja,date,status"; 
                                                    $where = "DATE(date)='$tanggal' AND id_outlet='$idot' order by id_pes"; //order_detail.status_detail='1' AND
                                                    $db->select($table,$fild,NULL,$where);
                                                    $hasil2=($db->getResult());

                                                    foreach($hasil2 as $key2) { 
                                                ?>
                                                    <tr class="showmove">
                                                        <td><?php echo meja($key2['id_meja']); ?></td>
                                                        <td><?php echo DateToIndo($key2['date']); ?></td>
                                                        <td>
                                                            <?php
                                                                   $table1 = "order_detail JOIN product ON order_detail.product_code=product.id_product";
                                                                   $fild1  = "order_detail.qty,order_detail.date_time,order_detail.status_detail,product.product_name,product.unit_price, 
                                                                             DATE_FORMAT(order_detail.date_time,'%H:%i:%s') AS time"; 
                                                                   $where1 = "order_detail.id_pes='$key2[id_pes]'"; //order_detail.status_detail='1' AND
                                                                   $db->select($table1,$fild1,NULL,$where1);
                                                                   $hasil1=($db->getResult());

                                                                   foreach($hasil1 as $key1) { 
                                                                   $mount=$key1['qty']*$key1['unit_price'];
                                                                   $tomount[]=$mount;
                                                            ?>
                                                            <span class=" text-lowercase"><?php echo $key1['product_name'].'('.$key1['qty'].')'.' = '.$mount. '';?></span><hr style="border:0;border-bottom: 1px dashed #ccc;background: #999;" />
                                                            <?php }  ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                   $table11 = "order_detail JOIN product ON order_detail.product_code=product.id_product";
                                                                   $fild11  = "SUM(order_detail.qty*product.unit_price) AS Total"; 
                                                                   $where11 = "order_detail.id_pes='$key2[id_pes]'"; //order_detail.status_detail='1' AND
                                                                   $db->select($table11,$fild11,NULL,$where11);
                                                                   $hasil11=($db->getResult());
                                                                   foreach($hasil11 as $key11);
                                                                   $mount1=$key11['Total'];
                                                            ?>
                                                            <h4><?php echo rupiah($mount1); ?></h4>
                                                        </td>
                                                        <td><?php echo status($key2['status']);?></td>
                                                        <?php if($key2['status']!=3){?>
                                                        <td>
                                                        <?php if($admin==1){?>
                                                                <a href="bill_print.php?id_pes=<?php echo $key2['id_pes']; ?>" class="btn btn-primary btn-xs text-left" title="Print Bill"><span class="glyphicon glyphicon-print"></span></a>&nbsp;&nbsp;
                                                                <a href="bill_done.php?id=<?php echo $key2['id_pes']; ?>&id_meja=<?php echo $key2['id_meja']; ?>&tgl=<?php echo $key2['date']; ?>" class="btn btn-primary btn-xs text-right" title="Save as Payment" onclick="return confirm('Save sebagai pembelian ?')"><span class="glyphicon glyphicon-save"></span></a>&nbsp;&nbsp;
                                                                <a href="bill_del.php?id=<?php echo $key2['id_pes']; ?>&id_meja=<?php echo $key2['id_meja']; ?>" class="btn btn-primary btn-xs text-right" onclick="return confirm('Are You Sure Delete This Item ?')" title="Delete" ><span class="glyphicon glyphicon-remove"></span></a>
                                                        <?php }elseif($chasier==1){ ?>
                                                                <a href="bill_print.php?id_pes=<?php echo $key2['id_pes']; ?>" class="btn btn-primary btn-xs text-left" ><span class="glyphicon glyphicon-print"></span></a>&nbsp;&nbsp;
                                                                <a href="bill_done.php?id=<?php echo $key2['id_pes']; ?>&id_meja=<?php echo $key2['id_meja']; ?>" class="btn btn-primary btn-xs text-right" title="Save as Payment" ><span class="glyphicon glyphicon-save"></span></a>
                                                        <?php }else{ echo'-';} ?>
                                                        </td>
                                                        <?php }else{ ?>
                                                        <td><a href="#" class="btn btn-primary btn-xs text-left" title="Payment Done" ><span class="glyphicon glyphicon-usd"></span></a></td>
                                                        <?php } ?>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                                <tfoot>
                                                    <tr class="bg-color-green">
                                                        <th colspan="3" style="text-align:right"><h4>Total Amount:</h4></th>
                                                        <th colspan="3" class="text-left"><h4><?php echo rupiah(@$sum=array_sum($tomount)); ?></h4></th>
                                                    </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                            <br />
                                <input type="button" class="btn btn-primary btn-lg" value="Order Page" onclick="window.location='orderadd_first.php'" />   
                        </div>
                    </div>
                </div>
            </div>
            </div>    
    </div>
  </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      
      <script src="assets/js/datepicker.js"></script>
     
        <script type="text/javascript">		
                $(document).ready(function () {
                $('#example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script> 
        <script src="assets/js/custom.js"></script> 

        
