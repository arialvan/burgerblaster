<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();

//if(isset($_GET['kategori'])){$kategori=$_GET['kategori']; $id=$_SESSION['IDOT'];}else{$kategori=1; $id=$_SESSION['IDOT'];}
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
                       <h3 class="text-uppercase"><?php echo"welcom ".$_SESSION['name'];?></h3>
                  </div>
                </div>
                 <hr />
                 
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="orderadd_tables.php"><div class="well well-lg text-uppercase text-center bg-color-red"> <h1>IN PLACE</h1> </div></a>
                            </div>
                    </div>     
                 
                 <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="orderadd.php?ket=1"><div class="well well-lg text-uppercase text-center bg-color-red"> <h1>TAKE AWAY</h1> </div></a>
                            </div>
                    </div>      
            </div>
            </div>
</div>
<?php include 'footer.php'; ?>
     