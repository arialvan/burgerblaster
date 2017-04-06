<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
$iduser=$_SESSION['ID'];

?>
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                   <div class="col-md-12"> 
    					<h5><?php echo"welcom ".$_SESSION['name'];?></h5>
					</div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <?php 
                    $table = "product JOIN order_detail ON product.id_product=order_detail.product_code";
                                    $fild  = "*"; 
                                    $where = "order_detail.id_user='$iduser' AND order_detail.status_detail='1'";
                                    $db->select($table,$fild);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row){
                                        $total=($row['qty']*$row['unit_price']);
                ?>
                    <div class="col-sm-3">
                        <div class="panel panel-danger text-left">
                          <div class="panel-heading">
                            <h3><?php echo $row['product_name']; ?></h3>
                          </div>
                          <ul class="list-group">
                            <li class="list-group-item">Quantity <?php echo $row['qty']; ?></li>
                            <li class="list-group-item">Price <?php  echo rupiah($row['unit_price']); ?></li>
                            <li class="list-group-item">Status <?php  echo status($row['status_detail']); ?></li>
                          </ul>
                            <div class="panel-body">
                            <h3 class="panel-title price"><?php echo rupiah($total); ?></h3>
                          </div>
                        </div>          
                    </div>
                                <?php } ?>
                </div>
            </div>
        </div>
</div>
 
<?php include 'footer.php';?>