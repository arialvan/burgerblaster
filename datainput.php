<?php
include"userotentifikasi.php";
include"header.php";
include "crud/class_crud.php";
include "func/sex.php";
$db = new crud();
if(isset($_GET['id_wh'])){$warehouse=$_GET['id_wh']; }else{$warehouse=5;} // ID Warehouse
if(isset($_GET['id_ot'])){$idot=$_GET['id_ot']; }else{$idot="BLS-BA-01";} // ID Outlet

//Akses
$table5 = "access";
$fild5  = "*"; 
$where5 = "id_user='$_SESSION[ID]'";
$db->select($table5,$fild5,NULL,$where5);
$hasil5=($db->getResult());
foreach($hasil5 as $key5 );
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
                    <h5><?php echo"welcom ".$_SESSION['name']; ?></h5>
                   </div>
                </div>
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <div class="liner"></div>
                                <li class="active">
                                    <a href="#warehouse" data-toggle="tab" title="+ Gudang">
                                        <span class="round-tabs one">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#outlet" data-toggle="tab" title="+ Outlet">
                                        <span class="round-tabs two">
                                            <i class="glyphicon glyphicon-cutlery"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#material" data-toggle="tab" title="+ Material">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-barcode"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#product" data-toggle="tab" title="+ Product">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#user" data-toggle="tab" title="+ user">
                                        <span class="round-tabs five">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#customer" data-toggle="tab" title="+ Customer">
                                        <span class="round-tabs one">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#dailycost" data-toggle="tab" title="+ Daily Cost">
                                        <span class="round-tabs two">
                                            <i class="glyphicon glyphicon-book"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#fixcost" data-toggle="tab" title="+ Fix Cost">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-ok"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#meja" data-toggle="tab" title="+ Meja">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-glass"></i>
                                        </span> 
                                    </a>
                                </li>
                            </ul>
                    </div>

                     <div class="tab-content">
                        <div class="tab-pane fade in active" id="warehouse">
                            <?php include_once 'datainput_warehouse.php';?>
                        </div>
                        <div class="tab-pane fade" id="outlet">
                            <?php include_once 'datainput_outlet.php';?>
                        </div>
                        <div class="tab-pane fade" id="material">
                            <?php include_once 'datainput_material.php';?>
                        </div>
                        <div class="tab-pane fade" id="product">
                          <?php include_once 'datainput_product.php';?>
                        </div>
                        <div class="tab-pane fade" id="user">
                          <?php include_once 'datainput_users.php';?>
                        </div>
                        <div class="tab-pane fade" id="customer">
                            <?php include_once 'datainput_customer.php';?>
                        </div>
                        <div class="tab-pane fade" id="dailycost">
                            <?php include_once 'datainput_dailycost.php';?>
                        </div>
                        <div class="tab-pane fade" id="fixcost">
                            <?php include_once 'datainput_fixcost.php';?>
                        </div>
                        <div class="tab-pane fade" id="meja">
                            <?php include_once 'datainput_meja.php';?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
    </div>
   </div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
<link href="assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript" src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
                  
              /* Datepicker */
                $(document).ready(function () {
                $('.example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
            
                        
                var no=2;
                function tambah(){

                   row = '<tr><td align="center">'+no+'<input name="kode[]" type="hidden" id="kode[]" value="1"></td><td><input type="text" name="id_material[]" id="id_material[]" class="form-control" size="35" placeholder="Nama Barang"></td><td><input type="text" name="qty_prc[]" id="qty_prc[]" class="form-control" required></td><td><select name="unit_prc[]" id="unit_prc[]" class="form-control" required><option value="">Pilih</option><option value="kg">Kilogram</option><option value="kg">Ons</option><option value="pcs">Pcs</option><option value="rak">Rak</option><option value="lusin">Lusin</option><option value="botol">Botol</option><option value="sendok">Sendok</option><option value="butir">Butir</option><option value="kotak">Kotak</option><option value="lembar">Lembar</option><option value="batang">batang</option></select> </td><td align="center"><input type="text" name="price_prc[]" id="price_prc[]" class="form-control" placeholder="ex: 10000" required></td></tr>';

                   $('.requang > tbody:last').append(row)

                    no++; 
                }
                function hapus(){

                        if (no>2){
                        no--;
                        $('.requang tbody tr:last-child').remove('tr:not(first)');

                        }
                }
     /* Tab Pan */
                    $(function() { 
                        // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                            // save the latest tab; use cookies if you like 'em better:
                            localStorage.setItem('lastTab', $(this).attr('href'));
                        });

                        // go to the latest tab, if it exists:
                        var lastTab = localStorage.getItem('lastTab');
                        if (lastTab) {
                            $('[href="' + lastTab + '"]').tab('show');
                        }
                    });             
    
    /* Title tooltip */
        $(function(){
        $('a[title]').tooltip();
        });
</script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>