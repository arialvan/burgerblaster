<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();

?>
<style type="text/css">
    .check
{
    opacity:0.2;
	color:#996;
	
}

</style>
<div id="wrapper">
        <?php include"header2.php"; ?>
           	<!-- /. NAV TOP  -->
              <?php include"left_menu.php"; ?>
        	<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <!--<form action="orderadd.php?ket=onplace" method="post" > -->
                <div id="page-inner">
                    <div class="row">
                       <div class="col-md-12"> 
                           <input type="button" class="btn btn-primary btn-lg" value="<< Previous" onclick="history.go(-1)"/>
                           <!--<input type="submit" class="btn btn-primary btn-lg " name="next" value="Next" style="float: right;"/>-->
                      </div>
                    </div>
                 <hr />
                 
                    <div class="panel panel-default">
                        
                            
                             <div class="row"> 
                                  <?php
                                    $id=$_SESSION['IDOT'];
                                    
                                    $stmt=$con->prepare("SELECT * FROM meja where id_outlet=:id_outlet AND id_meja!='0' ORDER BY id_meja");
                                    $stmt->bindValue(':id_outlet', $id, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);	
                                    $jumData=$stmt->rowCount();
                                   while($key = $stmt->fetch()){ 
                                       
                                   ?>  
                                 
                                    <div class="col-sm-6 col-md-4">
                                        <div class="panel panel-default">
                                            <div class="tab-content text-center">
                                                <?php if($key['status']==1){?>
                                                        <label class="btn btn-danger">
                                                            <a href="#" onclick="alert('Meja sudah di Pesan')">
                                                                <img src="blester/<?php echo $key['foto_meja'] ?>"  class="img-rounded" style="opacity:0.3; color:#e60000; " width="280" height="230" />
                                                            </a>
                                                        </label> 
                                                <?php }else{ ?>
                                                    <label class="btn btn-primary">
                                                        <a href="orderadd.php?ket=1&tb=<?php echo $key['id_meja']; ?>">
                                                            <img src="blester/<?php echo $key['foto_meja'] ?>"  class="img-rounded img-check" width="280" height="230" />
                                                        </a>
                                                    </label>
                                                <?php } ?>
                                                <div class="caption ">
                                                    <h4 class="text-danger"><?php echo $key['no_meja'] ?></h4> 
                                                    <input type="hidden" name="meja" value="<?php echo $key['id_meja'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                            </div>                       
                       
                </div>      
            </div>
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
                </script>    
                <script src="assets/js/custom.js"></script>   
