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
                    </div>
                </div>              
                 <!-- /. ROW  -->
                
                <hr />                
                <div class="row"> 
                    <div class="col-md-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grafik Penjualan Bulanan
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
                                Grafik Penjualan Harian
                            </div>
                            <div class="panel-body">
                                <div id="morris-line-chart"></div>
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
    
    <?php include 'payment_bulanan.php';?>
    <?php include 'payment_harian.php';?>
</body>
</html>
