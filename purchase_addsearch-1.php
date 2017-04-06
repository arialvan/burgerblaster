<?php
include"userotentifikasi.php";
include "crud/class_crud.php";
include "connection.php";
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
                        <div class="panel-heading">Add Purchase</div>
                        	<div class="panel-body">
                            	<div class="row">
                                    <form action="crud/crud_purchase.php" method="post" class="requang">
                                	<div class="col-md-5">
                                        <div class="form-group">
                                        
                                        	<input type="hidden" name="act" value="add_purchase" />
                                                <?php 
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                                <label>Outlet</label>
                                                <select name="id_outlet" class="form-control" required>
                                                        <option value="">Pilih Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                                <label>Date</label>
                                                <input type="text" name="purchase_date" class="form-control example1" placeholder="Date" required /><br />
                                            <br />
                                            <!-- <input type="text" name="id_material[]" id="id_material[]" required> -->
                                        </div> 
                                        </div>
                                        <div class="col-md-12">  
                                        <div class="form-group">
                                            <table class="table table-striped table-bordered table-hover requang">
                                                <thead>
                                                  <tr class="black text-white">
                                                    <td>No</td>
                                                    <td>Bahan</td>
                                                    <td>Qty</td>
                                                    <td>Satuan</td>
                                                    <td>@Harga</td>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                  <tr>
                                                      <td align="center">1<input name="kode[]" type="hidden" value="1" /></td>
                                                      <td>
                                                          <input type="text" name="id_material[]" class="typeahead form-control" placeholder="Nama Barang">
                                                    </td>
                                                    <td><input type="text" name="qty_prc[]" id="qty_prc[]" class="form-control" required></td>
                                                    <td>
                                                        <select name="unit_prc[]" id="unit_prc[]" class="form-control" required>
                                                                    <option value="">Pilih</option>
                                                                    <option value="kg">Kilogram</option>
                                                                    <option value="kg">Ons</option>
                                                                    <option value="pcs">Pcs</option>
                                                                    <option value="rak">Rak</option>
                                                                    <option value="lusin">Lusin</option>
                                                                    <option value="botol">Botol</option>
                                                                    <option value="sendok">Sendok</option>
                                                                    <option value="butir">Butir</option>
                                                                    <option value="kotak">Kotak</option>
                                                                    <option value="lembar">Lembar</option>
                                                                    <option value="batang">batang</option>
                                                        </select> 
                                                    </td>
                                                    <td align="center"><input type="text" name="price_prc[]" id="price_prc[]" class="form-control" placeholder="ex: 10000" required></td>
                                                  </tr>
                                                  </tbody>
                                                </table>
                                                <p><span class="fa fa-plus-square" onClick="tambah()"></span> | <span class="fa fa-minus-square" onclick="hapus()"></span></p>
                                                <p>&nbsp;</p>
                                            
                                            <input type="submit" value="Simpan" class="btn btn-primary">
                                            <input type=button value=Batal onclick="self.history.back()" class="btn btn-danger">
                                         </div>
                                        </div>
                                  </form>
                                </div>
                             </div>
    		</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
     
     <?php
        $sql = $con->prepare("SELECT * FROM material ORDER BY id_material"); // menampilkan data yg ada didatabase yg sesuai dengan inputan user
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);	

        while ($key2 = $sql->fetch()){
                $result[] =$key2['material_name']; // manempilkan nama jabatan
        }
        echo $json=json_encode($result);
     ?>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/datepicker.js"></script>
      <script src="assets/js/typehead.js"></script>
     
      <script type="text/javascript">
                /* Auto Complete*/
            var substringMatcher = function(strs) {
                return function findMatches(q, cb) {
                  var matches, substringRegex;

                  // an array that will be populated with substring matches
                  matches = [];

                  // regex used to determine if a string contains the substring `q`
                  substrRegex = new RegExp(q, 'i');

                  // iterate through the pool of strings and for any string that
                  // contains the substring `q`, add it to the `matches` array
                  $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                      matches.push(str);
                    }
                  });

                  cb(matches);
                };
              };

              var states = <?php echo $json; ?>;

              $('.typeahead').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
              },
              {
                name: 'states',
                source: substringMatcher(states)
              });
              
              /* Datepicker */
                $(document).ready(function () {
                $('.example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
            
                        
                var no=2;
                function tambah(){

                   row = '<tr><td align="center">'+no+'<input name="kode[]" type="hidden" id="kode[]" value="1"></td><td><input type="text" name="id_material[]" class="typeahead form-control" placeholder="Nama Barang"></td><td><input type="text" name="qty_prc[]" id="qty_prc[]" class="form-control" required></td><td><select name="unit_prc[]" id="unit_prc[]" class="form-control" required><option value="">Pilih</option><option value="kg">Kilogram</option><option value="kg">Ons</option><option value="pcs">Pcs</option><option value="rak">Rak</option><option value="lusin">Lusin</option><option value="botol">Botol</option><option value="sendok">Sendok</option><option value="butir">Butir</option><option value="kotak">Kotak</option><option value="lembar">Lembar</option><option value="batang">batang</option></select> </td><td align="center"><input type="text" name="price_prc[]" id="price_prc[]" class="form-control" placeholder="ex: 10000" required></td></tr>';

                   $('.requang > tbody:last').append(row)

                    no++; 
                }
                function hapus(){

                        if (no>2){
                        no--;
                        $('.requang tbody tr:last-child').remove('tr:not(first)');

                        }
                }
                
            
        </script>
        <script src="assets/js/custom.js"></script>     
   
</body>
</html>