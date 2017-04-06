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
if(empty($key7['id_user'])){
    echo '<h2 align=center>Sorry... No Access !!! Contact your admin.</h2>';
    $url="logout.php";
    echo "<meta http-equiv=\"REFRESH\" content=\"3;url=$url\">";
    exit();
}

$admin=$key7['admin']; $waiters=$key7['waiters']; $chasier=$key7['chasier']; $ceo=$key7['ceo']; $client=$key7['client'];

if(isset($_GET['id_outlet'])){$outlet=$_GET['id_outlet']; }else{$outlet=$_SESSION['IDOT'];}

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
                   <div class="col-md-3 col-sm-6 col-xs-6">
                        <?php 
                        $bln=date('m')-1;
                            $stmt12=$con->prepare("SELECT MONTH(date_done) AS Prev, SUM(total) AS Masuk FROM order_done where id_outlet='$outlet' AND MONTH(date_done)='$bln' GROUP BY MONTH(date_done) ASC");
                               $stmt12->execute();
                               $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                               $key2 = $stmt12->fetch();
                        ?>
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-bar-chart"></i>
                            </span>
                        <div class="text-box" >
                            <p class="text-temp">Penjualan bulan <?php echo $key2['Prev'];?></p>
                            <p class="text-muted"><?php echo rupiah($key2['Masuk']);?></p>
                        </div>
                        </div>
                    </div>
                   
                   <div class="col-md-3 col-sm-6 col-xs-6">
                        <?php 
                        $blnNow=date('m');
                            $stmt12=$con->prepare("SELECT MONTH(date_done)AS Bln, SUM(total) AS Masuk FROM order_done where id_outlet='$outlet' AND MONTH(date_done)='$blnNow' GROUP BY MONTH(date_done) ASC");
                               $stmt12->execute();
                               $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                               $key2 = $stmt12->fetch();
                        ?>
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-bar-chart"></i>
                            </span>
                        <div class="text-box" >
                            <p class="text-temp">Penjualan bulan <?php echo $key2['Bln'];?></p>
                            <p class="text-muted"><?php echo rupiah($key2['Masuk']);?></p>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <?php 
                        $month  =date('m');
                        $present=date('d')-1;
                        $today  =date('d');
                            $stmt12=$con->prepare("SELECT date_done, SUM(total) AS Masuk3 FROM order_done where id_outlet='$outlet' AND DAY(date_done)='$present' AND MONTH(date_done)='$month' GROUP BY DAY(date_done) ASC");
                               $stmt12->execute();
                               $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                               $key2 = $stmt12->fetch();
                        ?>
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-bar-chart"></i>
                            </span>
                        <div class="text-box" >
                            <p class="text-temp">Penjualan Kemarin <?php //echo DateToIndo($key2['date_done']);?></p>
                            <p class="text-muted"><?php echo rupiah($key2['Masuk3']);?></p>
                        </div>
                        </div>
                    </div>  
                   
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <?php 
                            $stmt122=$con->prepare("SELECT date_done, SUM(total) AS Masuk12 FROM order_done where id_outlet='$outlet' AND DAY(date_done)='$today' AND MONTH(date_done)='$month' GROUP BY DAY(date_done)");
                               $stmt122->execute();
                               $stmt122->setFetchMode(PDO::FETCH_ASSOC);	
                               $key122 = $stmt122->fetch();
                        ?>
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-bar-chart"></i>
                            </span>
                        <div class="text-box" >
                            <p class="text-temp">Penjualan hari ini <?php //echo $key12['date_done'];?></p>
                            <p class="text-muted"><?php echo rupiah($key122['Masuk12']);?></p>
                        </div>
                        </div>
                    </div>   
                    
		</div>
                 <!-- /. ROW  -->
                 
                 <hr />
                 <div class="row"> 
                        <div class="col-md-6">                     
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Penjualan Harian Bulan <?php echo $bln; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-line-chart"></div>
                                </div>
                            </div>            
                        </div> 
                        <div class="col-md-6">                     
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Penjualan Harian Bulan <?php echo $blnNow; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-line-chart1"></div>
                                </div>
                            </div>            
                        </div> 
                 </div>
                <hr />                
                <div class="row"> 
                    <div class="col-md-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Penjualan Bulanan
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>            
                    </div> 
                </div>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

    
    <?php
    
     // Pengeluaran Query Line chart prev month
                         $stmt12=$con->prepare("SELECT date_done, SUM(total) AS Masuk FROM order_done where id_outlet='$outlet' AND MONTH(date_done)='$bln' GROUP BY DAY(date_done) ASC");
                            $stmt12->execute();
                            $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                            while($key2 = $stmt12->fetch()){
                                  $y2[] = $key2['date_done'];
                                  $a2[] = $key2['Masuk'];
                            }

                        $json_data2=array();
                        foreach ($y2 as $rec3 => $var3)
                                {
                                    $json_array2['xx']=$y2[$rec3];
                                    $json_array2['a']=$a2[$rec3];
                                    array_push($json_data2, $json_array2);
                                }
                            $json2=json_encode($json_data2);
    
    // Pengeluaran Query Line chart this month
                         $stmt12=$con->prepare("SELECT date_done, SUM(total) AS Masuk1 FROM order_done where id_outlet='$outlet' AND MONTH(date_done)='$blnNow' GROUP BY DAY(date_done) ASC");
                            $stmt12->execute();
                            $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                            while($key21 = $stmt12->fetch()){
                                  $y21[] = $key21['date_done'];
                                  $a21[] = $key21['Masuk1'];
                            }

                        $json_data21=array();
                        foreach ($y21 as $rec31 => $var31)
                                {
                                    $json_array21['xxx']=$y21[$rec31];
                                    $json_array21['aaa']=$a21[$rec31];
                                    array_push($json_data21, $json_array21);
                                }
                            $json21=json_encode($json_data21);
                            
        // Pengeluaran Query Bar chart
         $stmt1=$con->prepare("SELECT SUM(order_detail.qty*product.unit_price) AS income,MONTH(order_detail.date_time) AS Month
                              FROM 
                                    product
                              JOIN 
                                    order_detail ON product.id_product=order_detail.product_code
                              WHERE order_detail.status_detail='3'
                              GROUP BY 
                                    MONTH(order_detail.date_time) ASC
                            ");
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);	
        while($key = $stmt1->fetch()){
              $y[] = $key['Month'];
              $a[] = $key['income'];
        }
        
        $stmt=$con->prepare("SELECT SUM(total_mp) AS spend FROM material_purchase GROUP BY MONTH(tgl_mp) ASC
                            ");
        
        //$stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);	
        while($key = $stmt->fetch()){
              $b[]=ceil($key['spend']);
        }
        
        $json_data=array();
        foreach ($y as $rec => $var)
                {
                    $json_array['y']=$y[$rec];
                    $json_array['a']=$a[$rec];
                    $json_array['b']=$b[$rec];
                    array_push($json_data, $json_array);
                }
            $json=json_encode($json_data);
    ?>

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
    <script type="text/javascript">
         /*====================================
            MORRIS BAR CHART Y=bulan a=pendapatan
         ======================================*/
            Morris.Bar({
                element: 'morris-bar-chart',
                data: <?php echo $json; ?>,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Pendapatan', 'Pengeluaran'],
                resize: true
            });
            
            Morris.Line({
                element: 'morris-line-chart',
                data: <?php echo $json2; ?>,
                xkey: 'xx',
                ykeys: ['a'],
                labels: ['Penjualan'],
                resize: true
            });
            
            Morris.Line({
                element: 'morris-line-chart1',
                data: <?php echo $json21; ?>,
                xkey: 'xxx',
                ykeys: ['aaa'],
                labels: ['Penjualan'],
                resize: true
            });
    </script>
   
</body>
</html>
