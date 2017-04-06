<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
$db = new crud();
include"header.php";
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
                 <!-- /. ROW  -->
                 <hr />
                 <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Form Add Product</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	<?php
                                        //Outlet
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                    
                                                    //Outlet Material
                                                    $table2 = "material JOIN outlet_stock ON material.id_material=outlet_stock.id_material";
                                                    $fild2  = "*"; 
                                                    $db->select($table2,$fild2);
                                                    $hasil2=($db->getResult());
                                                    
                                            $name=array('id_product','product_name','unit','unit_price');
                                            $type=array('text','text','text','text');//sex,address,level,pic
                                            $hold=array('Id Product','Nama Product','Satuan','Harga');
					?>
                                        <div class="form-group">
                                        <form action="crud/crud_product.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add_product" />
                                                
                                            	<?php foreach($name as $key => $value){ ?>
                                                
                                                <?php if($name[$key]=='unit'){ ?>
                                                        <label>Satuan</label>
                                                                <select name="unit" class="form-control" required>
                                                                    <option value="">Pilih</option>
                                                                    <option value="pcs">Pcs</option>
                                                                    <option value="mangkuk">Mangkuk</option>
                                                                    <option value="gelas">Gelas</option>
                                                                    <option value="botol">Botol</option>
                                                                </select> 
                                                <?php }else{?>
                                                <label></label>
                                                	<input type="<?php echo $type[$key]; ?>" name="<?php echo $name[$key]; ?>" class="form-control" placeholder="<?php echo $hold[$key]; ?>" required /><br />
                                                <?php } }?>
                                                <br />
                                                
                                                <label>Outlet</label>
                                                <select name="outlet" id="outlet" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                
                                                <label>Bahan Baku</label><br />
                                                <label id="bb"></label>
                                                <br />
                                                <br />
                                               <label>Foto Product</label>
                                               		<input type="file" name="foto" >
                                            <br />
                                            <input type="submit" value="Simpan" class="btn btn-primary">
											<input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
    		</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#outlet").change(function(){
    var outlet = $("#outlet").val();
    $.ajax({
        url: "ambiloutlet.php",
        data: "outlet="+outlet,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#bb").html(msg);
        }
    });
  });
   $("#bb").change(function(){
    var kota = $("#bb").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "bb="+bb,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

 </script>
<?php
include"footer.php";	
?>