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
                        <div class="panel-heading">Form Add Ware House</div>
                        	<div class="panel-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                    	
                                        <div class="form-group">
                                            <form action="crud/crud_warehouse.php" method="post" enctype="multipart/form-data">
                                        	<input type="hidden" name="act" value="add_warehouse" />
                                                <?php 
                                                //Provinsi
                                                    $table = "provinsi";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                    
                                                    //Kabupaten/kota
                                                    $table2 = "kabupaten";
                                                    $fild2  = "*"; 
                                                    $db->select($table2,$fild2);
                                                    $hasil2=($db->getResult());
                                                ?>
                                                
                                                <label>Nama Gudang</label>
                                                    <input type="text" name="namagudang" class="form-control" required />
                                                <br />
                                                <label>Provinsi</label>
                                                <select name="propinsi" id="propinsi" class="form-control" required>
                                                        <option value="">Pilih Provinsi</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id'] ?>"><?php echo $key['nama']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                <label>Kabupaten / Kota</label>
                                                <select name="kota" id="kota" class="form-control" required>
                                                        <option value="">Pilih Kabupaten/Kota</option>
                                                    <?php foreach($hasil2 as $key2){ ?>
                                                        <option value="<?php echo $key2['id'] ?>"><?php echo $key2['nama']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <br />
                                                <label>Alamat</label>
                                               		<textarea name="address" class="form-control" rows="5"></textarea>
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
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "kota="+kota,
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