<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
date_default_timezone_set("Asia/Jakarta");
$db = new crud();
@$get=$_GET['ket'];
if(@$get!='1' && @$get!='2' ){
 echo"<h2 class=text-center>
        Sorry Can't Access<br />
        <a href='orderadd_first.php'>Back</a>
     </h2>";   
exit;
}
?>
<style type="text/css">
    .check
{
    opacity:0.2;
	color:#996;
	
}

.top-link-block.affix-top {
    position: absolute; /* allows it to "slide" up into view */
    bottom: -82px; /* negative of the offset - height of link element */
    left: 10px; /* padding from the left side of the window */
}
.top-link-block.affix {
    position: fixed; /* keeps it on the bottom once in view */
    bottom: 18px; /* height of link element */
    left: 10px; /* padding from the left side of the window */
}
</style>
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <form action="orderadd_done.php" method="post" > 
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID']; ?>" />
                    <input type="hidden" name="id_meja" value="<?php echo $_GET['tb']; ?>" />
                    <input type="hidden" name="ket_pes" value="<?php echo $get; ?>" />
                    <input type="hidden" name="status" value="0" />
                <div class="row">
                   <div class="col-md-12"> 
                           <input type="button" class="btn btn-primary btn-lg" value="<< Previous" onclick="history.go(-1)"/>
                           <input type="submit" class="btn btn-primary btn-lg " name="next" value="Order >>" style="float: right;"/>
                  </div>
                </div>
                 <hr />
                 
                 <!-- TAB PANE -->
                 <div class="panel panel-default">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active btn btn-sm"><a href="#dimsum" data-toggle="tab">DIMSUM</a></li>
                                <li class="btn btn-sm"><a href="#dimsumgoreng" data-toggle="tab">DIMSUM GORENG</a></li>
                                <li class="btn btn-sm"><a href="#burger" data-toggle="tab">BURGER</a></li>
                                <li class="btn btn-sm"><a href="#omellete" data-toggle="tab">OMELLETE</a></li>
                                <li class="btn btn-sm"><a href="#frenchfries" data-toggle="tab">FRENCH FRIES</a></li>
                                <li class="btn btn-sm"><a href="#friedrise" data-toggle="tab">FRIED RISE</a></li>
                                <li class="btn btn-sm"><a href="#friedchicken" data-toggle="tab">FRIED CHICKEN</a></li>
                                <li class="btn btn-sm"><a href="#chickenkatsu" data-toggle="tab">CHICKEN KATSU</a></li>
                                <li class="btn btn-sm"><a href="#softdrink" data-toggle="tab">SOFT DRINK</a></li>
                                <li class="btn btn-sm"><a href="#prave" data-toggle="tab">FRAPE</a></li>
                                <li class="btn btn-sm"><a href="#mocktail" data-toggle="tab">MOCKTAIL</a></li>
                                <li class="btn btn-sm"><a href="#hoticed" data-toggle="tab">HOT/ICED</a></li>
                                <li class="btn btn-sm"><a href="#yoghurt" data-toggle="tab">YOGHURT</a></li>
                            </ul>
                            <p>&nbsp;</p>
                    <div class="tab-content text-center">
                        <!-- DIMSUM -->
                        <?php include_once 'order_dimsum.php'; ?>
                        <!-- DIMSUM GORENG -->
                        <?php include_once 'order_dimsumgoreng.php'; ?>
                        <!-- BURGER -->                  
                        <?php include_once 'order_burger.php'; ?>
                        <!-- OMELLETE -->                  
                        <?php include_once 'order_omellete.php'; ?>
                        <!-- FRENCH FRIES -->                  
                        <?php include_once 'order_frenchfries.php'; ?>
                        <!-- FRIED RISE -->                  
                        <?php include_once 'order_friedrise.php'; ?>
                        <!-- FRIED CHICKEN -->                  
                        <?php include_once 'order_friedchicken.php'; ?>
                        <!-- CHICKEN KATSU -->                  
                        <?php include_once 'order_chickenkatsu.php'; ?>
                        <!-- SOFT DRINK -->                  
                        <?php include_once 'order_softdrink.php'; ?>
                        <!-- PRAVE -->                  
                        <?php include_once 'order_prave.php'; ?>
                        <!-- MOCKTAIL -->                  
                        <?php include_once 'order_mocktail.php'; ?>
                        <!-- HOT ICED -->                  
                        <?php include_once 'order_hoticed.php'; ?>
                        <!-- YOGHURT -->                  
                        <?php include_once 'order_yoghurt.php'; ?>
                    </div>
                    <!-- TAB CONTENT -->
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
        
                <script type="text/javascript">
                    $(document).ready(function(e){
                        $(".img-check").click(function(){
				$(this).toggleClass("check");
			});
                    });
        
                    $('.btn-minuse').on('click', function(){
                       $(this).parent().siblings("input").val(parseInt($(this).parent().siblings("input").val()) - 1)
                    })

                    $('.btn-pluss').on('click', function(){
                        $(this).parent().siblings("input").val(parseInt($(this).parent().siblings("input").val()) + 1)
                    })
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
                    
                    /* Link Back Top */
                    if ( ($(window).height() + 100) < $(document).height() ) {
                          $('.top-link-block').removeClass('hidden').affix({
                            // how far to scroll down before link "slides" into view
                            offset: {top:100}
                        });
                    }
                </script>    
                <script src="assets/js/custom.js"></script>   
