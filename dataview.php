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
                                    <a href="#warehouse" data-toggle="tab" title="Bahan Baku Gudang">
                                        <span class="round-tabs one">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#outlet" data-toggle="tab" title="Bahan Baku Outlet">
                                        <span class="round-tabs two">
                                            <i class="glyphicon glyphicon-cutlery"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#product" data-toggle="tab" title="Product">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#user" data-toggle="tab" title="user">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#customer" data-toggle="tab" title="customer">
                                        <span class="round-tabs five">
                                            <i class="glyphicon glyphicon-star"></i>
                                        </span> 
                                    </a>
                                </li>
                            </ul>
                    </div>

                     <div class="tab-content">
                        <div class="tab-pane fade in active" id="warehouse">
                            <?php include_once 'dataview_warehouse.php';?>
                        </div>
                        <div class="tab-pane fade" id="outlet">
                            <?php include_once 'dataview_outlet.php';?>
                        </div>
                        <div class="tab-pane fade" id="product">
                          <?php include_once 'dataview_product.php';?>
                        </div>
                        <div class="tab-pane fade" id="user">
                          <?php include_once 'dataview_users.php';?>
                        </div>
                        <div class="tab-pane fade" id="customer">
                            <div class="text-center">
                                <i class="img-intro icon-checkmark-circle"></i>
                            </div>
                            <?php include_once 'dataview_customer.php';?>
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
     /*X-EditTables*/
            $(document).ready(function() {
                $('.editharga').editable();
            });
            
            $(document).ready(function() {
                $('.editstok').editable();
            });
    
    /*X-Edit Table*/
            $(document).ready(function() {
                $('.editharga2').editable();
            });
            
             $(document).ready(function() {
                $('.myeditable').editable();
            });
            
    /*DataTables*/
		$(document).ready(function () {
                $('.dataTables-example').dataTable(
                        {
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                        });
            });
            
            
            
            $('.view-outlet').click(function(){
            //$(document).on("click", ".view-id", function() {
                var id = $(this).data('id');
                /*$(".modal-body #showid").text(id);
                $('#myModal').modal('show');*/
                    
                $.ajax({
                type : 'post',
                url : 'material_modal.php', //Here you should put your query 
                data :  'id_material='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid').html(data);
                    $('#myModal').modal('show');
                 }
              });

            }); 
            
            $('.view-gudang').click(function(){
            //$(document).on("click", ".view-id", function() {
                var id = $(this).data('id');
                /*$(".modal-body #showid").text(id);
                $('#myModal').modal('show');*/
                    
                $.ajax({
                type : 'post',
                url : 'material_modal2.php', //Here you should put your query 
                data :  'id_material='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid2').html(data);
                    $('#ModalGudang').modal('show');
                 }
              });

            });   
    
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
                    
                    
    /* MODAL BOOTSTRAP */
    $('.view-makanan').click(function(){
                var id = $(this).data('id');
                $.ajax({
                type : 'post',
                url : 'product_makan_edit.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid').html(data);
                    $('#EdMakanan').modal('show');
                 }
              });

            }); 
            
            $('.view-kommakanan').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_makan_komposisi.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #showid2').html(data);
                    $('#KomMakanan').modal('show');
                 }
              });

            });
            
            $('.view-detil-makanan').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_detail_makanan.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_ViewMakanan').html(data);
                    $('#ViewMakanan').modal('show');
                 }
              });

            });
            
            $('.view-minuman').click(function(){
                var id = $(this).data('id');
                $.ajax({
                type : 'post',
                url : 'product_minum_edit.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_EdMinuman').html(data);
                    $('#EdMinuman').modal('show');
                 }
              });

            }); 
            
            $('.view-komminuman').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_minum_komposisi.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_KomMinuman').html(data);
                    $('#KomMinuman').modal('show');
                 }
              });

            }); 
            
            $('.view-detil-minuman').click(function(){
                var id = $(this).data('id');                    
                $.ajax({
                type : 'post',
                url : 'product_detail_minuman.php', //Here you should put your query 
                data :  'id_product='+ id, //Here you pass your image id via ajax .
                success : function(data){
                    // Open modal and show output data from file.php 
                    $('.modal-body #show_ViewMinuman').html(data);
                    $('#ViewMinuman').modal('show');
                 }
              });

            });
    
    /* Title tooltip */
        $(function(){
        $('a[title]').tooltip();
        });
</script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>