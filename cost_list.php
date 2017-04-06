<?php
include"userotentifikasi.php";
include "connection.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
if(isset($_GET['id_ot'])){$idot=$_GET['id_ot'];}else{$idot=$_SESSION['IDOT'];}
?>
<link href="assets/css/datetimepicker.css" rel="stylesheet" />
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
                               Fixed Cost
                        </div>
                        <div class="panel-body">
                            <!-- TABEL HARIAN-->
                            <div class="table-responsive">
                                <form action="" method="get">  
                                  <?php 
                                    $table = "outlet";
                                    $fild  = "*"; 
                                    $db->select($table,$fild);
                                    $hasil=($db->getResult());
                                  ?>
                                    <div class="form-group input-group col-sm-6">
                                        <select name="id_ot" class="form-control" required>
                                                <option value="">Pilih Outlet</option>
                                                <?php foreach($hasil as $key){ ?>
                                                <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                <?php } ?>
                                        </select>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Information</th>
                                            <th>Cost</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                            $no=1;
                                            $table = "fixed_cost";
                                            $fild  = "*"; 
                                            $where = "id_outlet='$idot' ";
                                            $db->select($table,$fild,NULL,$where);
                                            $hasil2=($db->getResult());
			
                                            foreach($hasil2 as $key2) { 
                                            $sumQty[]=$key2['cost'];
                                        ?>
                                            <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $key2['ket_cost']; ?></td>
                                                <td class="text-right"><?php echo rupiah($key2['cost']);?></td>
                                                <td class="text-right">
                                                    <a href='cost_edit.php?id_cost=<?php echo $key2['id_cost'] ?>' title="Edit"><span class="glyphicon glyphicon-edit"></span></a> |
                                                    <a href='cost_move.php?id_cost=<?php echo $key2['id_cost'] ?>' title="Remove"><span class="glyphicon glyphicon-remove"></span></a> 
                                                </td>
                                            </tr>
											
                                        <?php $no++;} ?>
                                    </tbody>
                                        <tfoot>
                                            <tr class="bg-color-green">
                                                <th colspan="2" style="text-align:right">Total:</th>
                                                <th class="text-right"><?php @$totalnya=array_sum($sumQty); echo rupiah($totalnya); ?></th>
                                                <th></th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br />
                                <input type="button" class="btn btn-primary btn-lg" value="Add New Cost" onclick="window.location='cost_add.php'" />
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
<?php include 'footer.php'; ?>

        
