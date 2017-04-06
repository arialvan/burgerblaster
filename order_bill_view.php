<?php
include "crud/class_crud.php";
include "func/sex.php";
$db = new crud();


if(isset($_POST['id_pes'])){  
        $id = $_POST['id_pes'];
        $table5 = "order_detail JOIN product ON order_detail.product_code=product.id_product";
        $fild5  = "*";
        $where5 = "order_detail.id_pes='$id'";
        $db->select($table5,$fild5,NULL,$where5);
        $hasil5=$db->getResult();
        
?>
<input type="hidden" name="act" value="save_bill" />
<input type="hidden" name="id_pes" value="<?php echo $id; ?>" />
        <div class="panel panel-default">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Order Detail ID Pesanan <?php echo $id; ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hasil5 as $value){ $total=($value['qty']*$value['unit_price']); $totalPrice[]= $total; ?>
                                        <tr class="success">
                                            <td><?php echo $value['product_name'];?></td>
                                            <td><?php echo $value['qty'];?></td>
                                            <td><?php echo $value['unit_price'];?></td>
                                            <td class="text-right"><?php echo rupiah($total);?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align:right"String colspan="3"String>Total Price:</th>
                                            <th class="text-right"><?php echo @$harga=rupiah(array_sum($totalPrice)); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php } ?>