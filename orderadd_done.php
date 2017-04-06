<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
date_default_timezone_set("Asia/Jakarta");
$db = new crud();
if($_SERVER['REQUEST_METHOD']=='POST'){ 
if(isset($_POST['id_meja'])){$meja=$_POST['id_meja'];}else{$meja=0;}
?>
<style type="text/css">
    .check
{
    opacity:0.2;
	color:#996;
	
}
</style>
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <form action="crud/crud_order.php" method="POST" > 
                    <input type="hidden" name="act" value="order_add" />
                    <input type="hidden" name="id_user" value="<?php echo $_POST['id_user']; ?>" />
                    <input type="hidden" name="id_meja" value="<?php echo $_POST['id_meja']; ?>" />
                    <input type="hidden" name="ket_pes" value="<?php echo $_POST['ket_pes']; ?>" />
                    <input type="hidden" name="status" value="0" />
                <div class="row">
                   <div class="col-md-12"> 
                           <input type="button" class="btn btn-primary btn-lg" value="<< Previous" onclick="history.go(-1)"/>
                           <input type="submit" class="btn btn-primary btn-lg " name="next" value="Order Done >>" style="float: right;"/>
                  </div>
                </div>
                 <hr />
                 
                    <div class="panel panel-default">
                                 <?php
                                    $stmt1=$con->prepare("SELECT * FROM meja where id_meja=:id_meja ");
                                    $stmt1->bindValue(':id_meja', $_POST['id_meja'], PDO::PARAM_STR);
                                    $stmt1->execute();
                                    $stmt1->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData1=$stmt1->rowCount();
                                    $key1 = $stmt1->fetch(); 
                                       
                                   ?> 
                                 <div class="panel panel-heading">
                                    <h2 class="text-center"><?php echo $key1['no_meja'] ?></h2>                                    
                                </div>
                        
                                 <div class="row">
                                  <?php
                                    $id=$_SESSION['IDOT'];
                                    foreach ($_POST['qty'] as $var =>$values){
                                        if($values!=0){
                                             $products=$_POST['id_product'][$var];
                                             $stmt=$con->prepare("SELECT * FROM product where id_product='".$products."' ");
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                                $jumData=$stmt->rowCount();
                                                $key = $stmt->fetch();
                                     
                                                    
                                   ?>  
                                 
                                    <div class="col-sm-6 col-md-4">
                                        <div class="panel panel-default">
                                            <div class="tab-content text-center">
                                                <label class="btn btn-primary"><img src="blester/<?php echo $key['product_foto']; ?>"  class="img-rounded" width="280" height="230" />
                                                    <input type="checkbox" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                </label>

                                                <div class="caption ">
                                                    <h5 class="text-danger"><?php echo $key['product_name']; ?></h5>
                                                    <h5 class="text-danger"><?php echo rupiah($key['unit_price']); ?></h5> 
                                                    <h5 class="text-danger"><?php echo 'Qty '.$values; ?></h5> 
                                                    <h4 class="text-"><?php $total=$key['unit_price']*$values; echo 'Total: '.rupiah($total); ?></h4> 
                                                </div>
                                                        <div class="input-group text-center">
                                                            <input type="hidden" name="id_product[]" value="<?php echo $key['id_product']; ?>" />
                                                            <input type="hidden" name="qty[]" value="<?php echo $values; ?>" />
                                                        </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php } }?>
                            </div> 
                        </div> 
                    </form>
                </div>
            </div>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-pagination.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script> 
    <script src="assets/js/custom.js"></script>   
<?php 
}else{ 
        echo"<h2 class=text-center>
        Sorry Can't Access<br />
        <a href='orderadd_first.php'>Back</a>
        </h2>"; 
} 
?>