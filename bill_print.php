<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
$id_pes=$_GET['id_pes'];
    
    // Update Print
     $tabel = "order_first";
            $fild  = $id_pes;
            $where = "id_pes='".$fild."'"; 
            $print = 1;
            $data = array( 'print' => $print );
            $db->update($tabel,$data,$where);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Sample Invoice</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
      
      @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
          float: center;
        }
        .col-sm-12 {
          width: 100%;
        }
        .col-sm-11 {
          width: 91.66666667%;
        }
        .col-sm-10 {
          width: 83.33333333%;
        }
        .col-sm-9 {
          width: 75%;
        }
        .col-sm-8 {
          width: 66.66666667%;
        }
        .col-sm-7 {
          width: 58.33333333%;
        }
        .col-sm-6 {
          width: 50%;
        }
        .col-sm-5 {
          width: 41.66666667%;
        }
        .col-sm-4 {
          width: 33.33333333%;
        }
        .col-sm-3 {
          width: 25%;
        }
        .col-sm-2 {
          width: 16.66666667%;
        }
        .col-sm-1 {
          width: 8.33333333%;
        }
        .col-sm-pull-12 {
          right: 100%;
        }
        .col-sm-pull-11 {
          right: 91.66666667%;
        }
        .col-sm-pull-10 {
          right: 83.33333333%;
        }
        .col-sm-pull-9 {
          right: 75%;
        }
        .col-sm-pull-8 {
          right: 66.66666667%;
        }
        .col-sm-pull-7 {
          right: 58.33333333%;
        }
        .col-sm-pull-6 {
          right: 50%;
        }
        .col-sm-pull-5 {
          right: 41.66666667%;
        }
        .col-sm-pull-4 {
          right: 33.33333333%;
        }
        .col-sm-pull-3 {
          right: 25%;
        }
        .col-sm-pull-2 {
          right: 16.66666667%;
        }
        .col-sm-pull-1 {
          right: 8.33333333%;
        }
        .col-sm-pull-0 {
          right: auto;
        }
        .col-sm-push-12 {
          left: 100%;
        }
        .col-sm-push-11 {
          left: 91.66666667%;
        }
        .col-sm-push-10 {
          left: 83.33333333%;
        }
        .col-sm-push-9 {
          left: 75%;
        }
        .col-sm-push-8 {
          left: 66.66666667%;
        }
        .col-sm-push-7 {
          left: 58.33333333%;
        }
        .col-sm-push-6 {
          left: 50%;
        }
        .col-sm-push-5 {
          left: 41.66666667%;
        }
        .col-sm-push-4 {
          left: 33.33333333%;
        }
        .col-sm-push-3 {
          left: 25%;
        }
        .col-sm-push-2 {
          left: 16.66666667%;
        }
        .col-sm-push-1 {
          left: 8.33333333%;
        }
        .col-sm-push-0 {
          left: auto;
        }
        .col-sm-offset-12 {
          margin-left: 100%;
        }
        .col-sm-offset-11 {
          margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
          margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
          margin-left: 75%;
        }
        .col-sm-offset-8 {
          margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
          margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
          margin-left: 50%;
        }
        .col-sm-offset-5 {
          margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
          margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
          margin-left: 25%;
        }
        .col-sm-offset-2 {
          margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
          margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
          margin-left: 0%;
        }
        .visible-xs {
          display: none !important;
        }
        .hidden-xs {
          display: block !important;
        }
        table.hidden-xs {
          display: table;
        }
        tr.hidden-xs {
          display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
          display: table-cell !important;
        }
        .hidden-xs.hidden-print {
          display: none !important;
        }
        .hidden-sm {
          display: none !important;
        }
        .visible-sm {
          display: block !important;
        }
        table.visible-sm {
          display: table;
        }
        tr.visible-sm {
          display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
          display: table-cell !important;
        }
    }
    
    @media print {
   .noprint{
      display: none !important;
   }
}

    </style>
  </head>
  
  <body>
    <div class="container col-sm-6  ">
        
        <div id="page-wrapper" >
            <div id="page-inner">
                  <div class="col-xs-6"><a href="#"><img class="img-circle" width="50" height="40" src="photo/hamburger.png"></a></div>
                <div class="row">
                <div class="col-md-12">
                    <?php
                        $table = "order_first JOIN access ON order_first.id_user=access.id_user";
                                    $fild  = "*"; 
                                    $where = "order_first.id_pes='$id_pes'";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row);
                    ?>
                    <div class="panel panel-default">
                        <h5 class="text-right"><small>Bill #<?php echo $row['id_pes']; ?></small></h5>
                      <div class="panel-body">
                        <?php if($row['client']==1){ ?> 
                          
                             <?php
                                    $table1 = "users";
                                    $fild1  = "*"; 
                                    $where1 = "id_user='$row[id_user]'";
                                    $db->select($table1,$fild1,NULL,$where1);
                                    $hasil1=$db->getResult();
                                    foreach ($hasil1 as $row1);
                                ?>
                         <address>
                                <small><?php echo $row1['name']; ?></small><br>
                                    <?php echo $row1['address']; ?><br>
                                    <abbr title="Phone">P:</abbr> <?php echo $row1['phone']; ?>
                                </address>
                        <?php }else{ echo 'Burger Blaster';}?>
                      </div>
                    </div>
                    <?php
                        $table5 = "order_detail JOIN product ON order_detail.product_code=product.id_product";
                        $fild5  = "*";
                        $where5 = "order_detail.id_pes='$row[id_pes]'";
                        $db->select($table5,$fild5,NULL,$where5);
                        $hasil5=$db->getResult();
                    ?>
                    <table class=" table-bordered">
                            <thead>
                                <tr>
                                    <th  class=" text-center">Product</th>
                                    <th  class=" text-center">Qty</th>
                                    <th  class=" text-center">Price</th>
                                    <th  class=" text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($hasil5 as $row5){ $total=($row5['qty']*$row5['unit_price']); $totalPrice[]= $total;
                                ?>
                                <tr class="showmove">
                                    <td class=" text-left"><?php echo $row5['product_name']; ?></td>
                                    <td class="text-center"><?php  echo $row5['qty']; ?></td>
                                    <td class="text-right"><small><?php echo rupiah($row5['unit_price']); ?></small></td>
                                    <td class="text-right"><small><?php  echo $type=  rupiah($total); ?></small></td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                                <tfoot>
                                        <tr>
                                            <th class="text-right" colspan="3"><small>Total Price &nbsp;</small></th>
                                            <th class="text-left"><small><?php echo @$harga=rupiah(array_sum($totalPrice)); ?></small></th>
                                        </tr>
                                </tfoot>
                         </table>
                       
                        <div class="btn">
                            <a href="" class="btn btn-success btn-lg noprint" onclick="window.print()"><span class="glyphicon glyphicon-print"></span></a>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
  </body>
</html>

