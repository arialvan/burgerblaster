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
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span style="font-family:fantasy; font-weight:bold; font-size:20px; text-align: left;">Order Chart</span>
                            </div>  
                            <div class="panel-body">
                                <?php
                                if(isset($_SESSION['IDPES'])){
                                    $table = "product JOIN order_detail ON product.id_product=order_detail.product_code";
                                    $fild  = "*"; 
                                    $where = "order_detail.id_pes='$_SESSION[IDPES]' AND order_detail.id_user='$iduser' AND status_detail='0'";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                }else{
                                    $table = "product JOIN order_detail ON product.id_product=order_detail.product_code";
                                    $fild  = "*"; 
                                    $where = "order_detail.id_user='$iduser' AND status_detail='0'";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                }
                                    foreach ($hasil as $row){
                                        $total=($row['qty']*$row['unit_price']);
                                        $ket_pes[]=$row['ket_pes'];
                                ?>
                                <div class="show col-md-3 col-sm-12 col-xs-12">
                                    <div class="panel bg-warning text-capitalize text-success">
                                           <i class="fa fa-5x"></i><strong><img src="blester/<?php echo $row['product_foto'] ?>"  class="img-circle" width="180" height="160" /></strong>
                                           <p><?php echo $row['product_name']; ?><hr />
                                                                                  Quantity <?php echo $row['qty']; ?><br />
                                                                                  Total Price <?php  echo rupiah($total); ?><br />
                                           </p>
                                           <div class="form-group text-capitalize text-box text-success">
                                                    <label>Optional Order</label>
                                                    <select multiple class="form-control disabled">
                                                        <?php foreach(explo($row['ket_opsi']) as $key => $values){ ?>
                                                        <option><?php echo $values; ?></option>
                                                        <?php } ?>
                                                    </select>
                                            </div>
                                           <a href="#" id="<?php echo $row['id_index_pes']; ?>" class="delete glyphicon glyphicon-remove btn-lg"></a>
                                    </div>
                                </div>
                                <?php 
                                } 
                                    @$implo=implode($ket_pes); 
                                    if($implo=='1'){
                                        $ket="onplace";
                                    }else{
                                        $ket="takehome";
                                    }
                                ?> 
                                
                            </div>
                            <div class="btn col-md-12 left">
                            <?php if(isset($_SESSION['IDPES'])){ ?>
                                <button class="btn btn-danger btn-lg" onclick="window.location='orderadd.php?ket=<?php echo $ket; ?>'" > + Order</button>
                                <button class="btn btn-success btn-lg" onclick="window.location='orderdone.php'" > Done Order</button>
                            <?php }else{  ?>
                                <button class="btn btn-primary btn-lg" onclick="window.location='orderadd_first.php'" > + New Order</button>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
 
      <!-- BOOTSTRAP SCRIPTS -->
      <script src="assets/js/jquery-1.10.2.js"></script>
       <script src="assets/js/bootstrap.min.js"></script>
       <script src="assets/js/jquery.metisMenu.js"></script>
        <script src="assets/js/custom.js"></script> 
<script type="text/javascript">

    $(".delete").click(function(){
    var element = $(this);
    var del_id = element.attr("id");
    var info = 'id=' + del_id;
    if(confirm("Are you sure you want to delete this?"))
    {
     $.ajax({
       type: "POST",
       url: "order_del.php",
       data: info,
       success: function(){
     }
    });
      $(this).closest(".show").animate({ backgroundColor: "#003" }, "slow")
      .animate({ opacity: "0.2" }, "fast");
     }
     
    return false;
    });


</script>