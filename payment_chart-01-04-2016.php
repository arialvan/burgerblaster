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
                    <div class="col-md-12"> <h3>Selling Products</h3></div>
                    <?php
                               
                                    $stmt=$con->prepare("SELECT * FROM product JOIN order_done ON
                                                        product.id_product=order_done.id_product 
                                                        where product.id_outlet=:id_outlet ORDER BY order_done.total DESC LIMIT 4");
                                    $stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                    ?>    
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon"><img src="blester/<?php echo $key['product_foto'] ?>" width="40" height="40" /></i></span>
                                <div class="text-box" >
                                    <small ><a href="#"><?php echo $key['product_name'] ?></a></small>
                                </div>       
                            </div>
                        </div>
                    <?php $no++; } ?> 
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div class="row">
                    <div class="col-md-12"> <h3>Lowest Products</h3></div>
                    <?php
                               
                                    $stmt=$con->prepare("SELECT * FROM product JOIN order_done ON
                                                        product.id_product=order_done.id_product 
                                                        where product.id_outlet=:id_outlet ORDER BY order_done.total ASC LIMIT 2");
                                    $stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                    ?>    
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon"><img src="blester/<?php echo $key['product_foto'] ?>" width="40" height="40" /></i></span>
                                <div class="text-box" >
                                    <small ><a href="#"><?php echo $key['product_name'] ?></a></small>
                                </div>       
                            </div>
                        </div>
                    <?php $no++; } ?> 
                        <img src="./photo/kapalo.gif" width="50" height="50" />
                                 
                </div>
                <hr />                
                <div class="row"> 
                    <div class="col-md-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Chart This Month
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
    
    <?php
        // Pengeluaran Query
         $stmt1=$con->prepare("SELECT SUM(order_detail.qty*product.unit_price) AS income,MONTH(order_detail.date_time) AS Month
                              FROM 
                                    product
                              JOIN 
                                    order_detail ON product.id_product=order_detail.product_code
                              GROUP BY 
                                    MONTH(order_detail.date_time) ASC
                            ");
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);	
        while($key = $stmt1->fetch()){
              $y[] = $key['Month'];
              $a[] = $key['income'];
        }
        
        $stmt=$con->prepare("SELECT SUM(purchase_detail.total_prc) AS spend
                             FROM
                                    purchase 
                             JOIN 
                                    purchase_detail ON purchase.id_purchase=purchase_detail.id_purchase 
                             GROUP BY MONTH(purchase.purchase_date) ASC
                            ");
        
        //$stmt->bindValue(':id_outlet', $outlet, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);	
        while($key = $stmt->fetch()){
              $b[]=$key['spend'];
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
    </script>
   
</body>
</html>
