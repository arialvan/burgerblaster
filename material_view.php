<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
$id_mat=$_GET['id_material'];
$bln   =$_GET['bln'];
$thn   =date('Y'); //$_GET['thn']; 
if(isset($bln)){$bulan=$bln;}else{$bulan=date('m');}
if(isset($thn)){$tahun=$thn;}else{$tahun=date('Y');}

$table3 = "material";
$fild3  = "material_name"; 
$where3 = "id_material='$id_mat'";
$db->select($table3,$fild3,NULL,$where3);
$hasil3=($db->getResult());
foreach($hasil3 as $key3 );
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
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <?php echo"<h3>".$key3['material_name']."</h3>"; ?>
                        </div>
                        <div class="panel-body">
                        <?php
                            $table = "material JOIN material_stock ON material.id_material=material_stock.id_material";
                            //$fild  = "SUM(material_stock.qty_material) AS Total"; 
                            $fild  = "*"; 
                            $where = " material.id_material='$id_mat' AND MONTH(material_stock.date_input)='$bulan' AND YEAR(material_stock.date_input)='$tahun'";
                            $db->select($table,$fild,NULL,$where);
                            $hasil2=($db->getResult());
			?>
                            <div class="table-responsive">
                                <form action="" method="get">
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">
                                        Bulan &nbsp;<select name="bln" class="form-control">
                                        <?php $bln=array(1=>"Jan","Feb","Mar","April","Mei","Juni","Juli","Agus","Sep","Okt","Nov","Dec"); ?>
                                        <option><?php echo $bulan; ?></option>
                                        <?php 
                                                        for($i=1;$i<=12;$i++){
                                                                if(strlen($i)==1){ 
                                                                        echo "<option value='0$i'>$bln[$i]</option>";
                                                                }else{
                                                                        echo "<option value=$i>$bln[$i]</option>";
                                                                }
                                                        }
                                                ?>
                                        </select>
                                        </td>
                                        <td valign="middle">Tahun 
                                          &nbsp; <select name="thn" id="tahun" class="form-control">
                                          <option><?php echo $tahun; ?></option>
                                          <?php 
                                                        $th=date('Y')+2;
                                                        for($t=2012;$t<$th;$t++){
                                                                if($t==($th-2)){ 
                                                                echo "<option selected>$t</option>";
                                                                }else{ 
                                                                echo "<option>$t</option>";
                                                                }			
                                                        }
                                                   ?>
                                               </select>
                                        </td>
                                        <td valign="middle"><br />                                      
                                        <input type="hidden" name="id_material" value="<?php echo $id_mat;?>" />
                                        <input type="submit" class="btn btn-primary" value="Search">
                                        </td>
                                     </tr>
                                </table>  
                                </form>   
                                <br />  
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Bahan Baku</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            <th>Tgl Input</th>
                                            <th>Tgl Update</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            foreach($hasil2 as $key2)
                                            { 
                                               //echo $qty=count($hasil2);
                                               $sumQty[]=$key2['qty_material'];
                                        ?>
                                            <tr>
						<td><?php echo $key2['id_material'];?></td>
						<td><?php echo $key2['material_name'];?></td>
						<td><?php echo $key2['unit'];?></td>
                                                <td><?php echo $key2['price'];?></td>
                                                <td><?php echo $key2['qty_material'];?></td>
                                                <td><?php echo $key2['date_input'];?></td>
                                                <td><?php echo $key2['date_update'];?></td>
						<td>
                                                    <a href='material_edit_detail.php?idstockm=<?php echo $key2['id_stock_material'] ?>&bln=<?php echo $_GET['bln']; ?>&thn=<?php echo $_GET['thn']; ?>' class='fa fa-edit'>Edit</a> |
                                                    <a href='material_move_detail.php?idstockm=<?php echo $key2['id_stock_material'] ?>&id_material=<?php echo $key2['id_material'];?>&bln=<?php echo $_GET['bln']; ?>&thn=<?php echo $_GET['thn']; ?>' class='fa fa-pencil'>Hapus</a> |
						</td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align:right">Total:</th>
                                                <th colspan="4"><?php echo @array_sum($sumQty); ?></th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br />
                            <input type="button" class="btn btn-default btn-lg" value="Add Bahan Baku" onclick="window.location='material_add.php'"/>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      
    <script src="assets/js/custom.js"></script>
     <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
     <script src="assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
		$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>