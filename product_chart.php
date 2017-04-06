<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
$no=0;

//Access Menu
$table7="access";
$fild7  = "*"; 
$where7 = "id_user='$_SESSION[ID]'";
$db->select($table7,$fild7,NULL,$where7);
$dt7=($db->getResult());				
foreach($dt7 as $key7 );
$admin=$key7['admin']; $waiters=$key7['waiters']; $chasier=$key7['chasier']; $ceo=$key7['ceo']; $client=$key7['client'];

if(isset($_GET['id_ot'])){$outlet=$_GET['id_ot']; }else{$outlet=$_SESSION['IDOT'];}
if(isset($_GET['bln'])){$bulan=$_GET['bln'];}else{$bulan=date('m');}
if(isset($_GET['thn'])){$tahun=$_GET['thn'];}else{$tahun=date('Y');}
// Chart

?>

<div id="wrapper">
    	 <?php include"header2.php"; ?>
           <!-- /. NAV TOP  -->
                    <?php include"left_menu.php"; ?> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-sm-6"> 
                        <?php if($admin==1){?>
                        <form action="" method="get">
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">
                                          <?php 
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                                <label>Search Outlet</label>
                                                <select name="id_ot" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                        </td>
                                        <td valign="middle"><br />  
                                        <input type="submit" class="btn btn-primary" value="Search">
                                        </td>
                                     </tr>
                                </table>  
                                </form> 
                        <?php } ?>
                        
                        
                        <form action="" method="get">
                                <input type="hidden" name="id_ot" value="<?php echo $outlet;?>" />
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
                    </div>
                </div>              
                 <!-- /. ROW  -->
                
                <hr />                
                <div class="row"> 
                    <div class="col-md-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grafik Product Bulan <?php echo $bulan ." Tahun ". $tahun; ?> 
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>            
                    </div> 
                </div>
                 <!-- /. ROW  -->           
                 
                 <hr />                
                <div class="row"> 
                    <div class="col-md-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resume Product Bulan <?php echo $bulan ." Tahun ". $tahun; ?> 
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php                                            
                                            $stmt=$con->prepare("SELECT * ,SUM(order_done.qty_done) AS QTY FROM order_done JOIN product ON order_done.id_product=product.id_product
                                                                WHERE MONTH(order_done.date_done)='$bulan' AND YEAR(order_done.date_done)='$tahun' AND order_done.id_outlet='$outlet' GROUP BY order_done.id_product");
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                            $jumData=$stmt->rowCount();
                                           while($row = $stmt->fetch()){ 
                                               $sumQty[]=$row['total'];
                                        ?>
                                            <tr>
						<td><?php echo $row['product_name'];?></td>
						<td><?php echo $row['QTY']; ?></td>
                                            </tr>				
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>            
                    </div> 
                </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->

 <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
    <?php include 'product_bulanan.php';?>
</body>
</html>
