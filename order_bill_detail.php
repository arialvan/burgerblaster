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
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                             Price Table 
                        </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $table = "product JOIN order_detail ON product.id_product=order_detail.product_code";
                                    $fild  = "*"; 
                                    $where = "order_detail.id_user='$iduser' AND order_detail.status_detail='1'";
                                    $db->select($table,$fild);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row){
                                    $total=($row['qty']*$row['unit_price']);
                                    $totalPrice[]= $total;
                                ?>
                                <tr>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td class="text-right"><?php  echo rupiah($row['unit_price']); ?></td>
                                    <td  class="text-center"><?php echo $row['qty']; ?></td>
                                    <td><?php  echo status($row['status_detail']); ?></td>
                                    <td class="text-right"><?php echo rupiah($total); ?></td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align:right"String colspan="4"String>Total:</th>
                                    <th class="text-right"><?php echo $harga=rupiah(array_sum($totalPrice)); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <br />
                            <input type="button" class="btn btn-danger btn-lg" value="Back to Order Page" onclick="window.location='orderadd_first.php'"/>
                  </div>    
                </div>
            </div>
                </div>
            </div>
        </div>
</div>
<?php include 'footer.php';?>