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
                                <li class="active btn btn-lg"><a href="#dimsum" data-toggle="tab">DIMSUM</a></li>
                                <li class="btn btn-lg"><a href="#burger" data-toggle="tab">BURGER</a></li>
                            </ul>
                            <p>&nbsp;</p>
                    <div class="tab-content text-center">
                    <div class="table-responsive tab-pane fade active in" id="dimsum">        
                    <div class="panel-body">
                        
                             <div class="row"> 
                                  <?php
                                    $id=$_SESSION['IDOT'];
                                    $no=0;
                                    $stmt=$con->prepare("SELECT * FROM product where id_outlet=:id_outlet AND jenis > 5 ");
                                    $stmt->bindValue(':id_outlet', $id, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                                       
                                   ?>  
                                 
                                    <div class="col-sm-6 col-md-4">
                                        <div class="panel panel-default">
                                                <label class="btn btn-primary"><img src="blester/<?php echo $key['product_foto'] ?>"  class="img-rounded img-check" width="280" height="230" />
                                                    <input type="checkbox" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                    <input type="text" name="id_product[]" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                </label>

                                                <div class="caption ">
                                                    <h5 class="text-danger"><?php echo $key['product_name'] ?></h5>
                                                    <h5 class="text-danger"><?php echo rupiah($key['unit_price']); ?></h5>                                      
                                                </div>
                                                    <span class="text-center">Add Quantity</span>
                                                        <div class="input-group text-center">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-white btn-minuse" type="button">-</button>
                                                            </span>
                                                            <input type="text" name="qty[]" class="form-control no-padding add-color text-center height-25" value="0" /> 
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-red btn-pluss" type="button">+</button>
                                                            </span>
                                                        </div> 
                                        </div>
                                    </div>
                            <?php } ?>
                            </div> 
                            <span class="top-link-block" class="hidden">
                                <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'fast');return false;">
                                    <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
                                </a>
                            </span>
                        </div>
                    </div><!-- TAB DIMSUM -->
                    
                    
                    
                    <div class="table-responsive tab-pane fade" id="burger">        
                    <div class="panel-body">
                        
                             <div class="row"> 
                                  <?php
                                    $id=$_SESSION['IDOT'];
                                    $no=0;
                                    $stmt=$con->prepare("SELECT * FROM product where id_outlet=:id_outlet AND jenis < 6");
                                    $stmt->bindValue(':id_outlet', $id, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                                       
                                   ?>  
                                 
                                    <div class="col-sm-6 col-md-4">
                                        <div class="panel panel-default">
                                                <label class="btn btn-primary"><img src="blester/<?php echo $key['product_foto'] ?>"  class="img-rounded img-check" width="280" height="230" />
                                                    <input type="checkbox" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                    <input type="text" name="id_product[]" id="item4" value="<?php echo $key['id_product']; ?>" class="hidden" autocomplete="off" />
                                                </label>

                                                <div class="caption ">
                                                    <h5 class="text-danger"><?php echo $key['product_name'] ?></h5>
                                                    <h5 class="text-danger"><?php echo rupiah($key['unit_price']); ?></h5>                                      
                                                </div>
                                                    <span class="text-center">Add Quantity</span>
                                                        <div class="input-group text-center">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-white btn-minuse" type="button">-</button>
                                                            </span>
                                                            <input type="text" name="qty[]" class="form-control no-padding add-color text-center height-25" value="0" /> 
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-red btn-pluss" type="button">+</button>
                                                            </span>
                                                        </div> 
                                        </div>
                                    </div>
                            <?php } ?>
                            </div> 
                            <span class="top-link-block" class="hidden">
                                <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'fast');return false;">
                                    <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
                                </a>
                            </span>
                        </div>
                    </div><!-- TAB BURGER -->
                    </div><!-- TAB CONTENT -->
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
