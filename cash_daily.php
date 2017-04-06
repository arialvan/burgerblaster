<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['tanggal'])){$tanggal=$_GET['tanggal'];}else{$tanggal=date('Y-m-d');}    
if(isset($_GET['outlet'])){$outlet=$_GET['outlet'];}else{$outlet=$_SESSION['IDOT'];} 
    // Update Print
     $tabel = "order_first";
            $fild  = 1;
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
    <div class="container col-lg-10  ">
        
        <div id="page-wrapper" >
            <div id="page-inner">
                  <div class="col-xs-6"><a href="#"><img class="img-circle" width="100" height="90" src="photo/hamburger.png"></a></div>
                <div class="row">
                <div class="col-md-12">
                    <?php
                        //Omset harian
                        $stmt12=$con->prepare("SELECT SUM(total) AS Masuk FROM order_done where date_done='$tanggal' AND id_outlet='$outlet'");
                        $stmt12->execute();
                        $stmt12->setFetchMode(PDO::FETCH_ASSOC);	
                        $key2  = $stmt12->fetch();
                        $omset = $key2['Masuk'];
                        
                        //Fix Cost
                        $table = "fixed_cost";
                        $fild  = "*"; 
                        $where = "id_outlet='$outlet'";
                        $db->select($table,$fild,NULL,$where);
                        $hasil2=($db->getResult());
                        
                        //Bahan Baku
                        $stmt3=$con->prepare("SELECT SUM(total_mp) AS ttmp FROM material_purchase where tgl_mp='$tanggal'");
			$stmt3->execute();
                        $stmt3->setFetchMode(PDO::FETCH_ASSOC);	
                        $key3 = $stmt3->fetch();
                        $bb=$key3['ttmp'];
                        
                    ?>
                    <div class="panel panel-default">
                        <h3 class="text-center">LAPORAN KEUANGAN</h3>
                        <h3 class="text-center"><?php echo DateToIndo($tanggal); ?></h3>
                        <p>&nbsp;</p><p>&nbsp;</p>
                        <table border='0' style="width: 100%; height: 432px;">
                            <tbody>
                            <tr style="height: 21px;">
                            <td style="width: 327.25px; height: 21px;" colspan="2">Pendapatan/Omset</td>
                            <td style="width: 156.75px; height: 21px;" class="text-primary"><?php echo rupiah($omset); ?></td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 484px; height: 21px;" colspan="3">Pengeluaran</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 327.25px; text-align: center; height: 21px;" colspan="2">Fix Cost/Tetap</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                                <?php
                                    foreach($hasil2 as $key2) { 
                                    $sumQty[]=$key2['cost'];
                                ?>
                                <tr style="height: 21px;">
                                    <td style="width: 175.9px; height: 21px;"><?php echo $key2['ket_cost']; ?></td>
                                    <td style="width: 151.35px; height: 21px;" class="text-primary"><?php echo rupiah($key2['cost']); ?></td>
                                    <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                                </tr>
                                <?php } $fixcost=  array_sum($sumQty); ?>
                                
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">&nbsp;</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 327.25px; text-align: center; height: 21px;" colspan="2">Variable Cost/Tidak Tetap</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Bahan Baku</td>
                            <td style="width: 151.35px; height: 21px;" class="text-primary"><?php echo rupiah($bb); ?></td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Lain-Lain</td>
                            <td style="width: 151.35px; height: 21px;" class="text-primary">IDR.0</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">&nbsp;</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Penyusutan</td>
                            <td style="width: 151.35px; height: 21px;" class="text-primary">IDR.0</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Pengembangan</td>
                            <td style="width: 151.35px; height: 21px;" class="text-primary">IDR.0</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">&nbsp;</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Jumlah Pengeluaran</td>
                            <td style="width: 151.35px; height: 21px;"class="text-primary"><?php $pengeluaran=$fixcost+$bb; echo rupiah($pengeluaran); ?> </td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">&nbsp;</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Net Profit</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;" class="text-primary"><?php $net=$omset-$pengeluaran; echo rupiah($net); ?></td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">&nbsp;</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Revenue Sharing</td>
                            <td style="width: 151.35px; height: 21px;">&nbsp;</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Owner 60%</td>
                            <td style="width: 151.35px; height: 21px;"class="text-primary">IDR.0</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="width: 175.9px; height: 21px;">Manajemen 40%</td>
                            <td style="width: 151.35px; height: 21px;"class="text-primary">IDR.0</td>
                            <td style="width: 156.75px; height: 21px;">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                        
                        <p>&nbsp;</p>
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

