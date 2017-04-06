<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
$iduser=$_SESSION['ID'];

if(isset($_GET['id_outlet'])){$outlet=$_GET['id_outlet']; }else{$outlet=$_SESSION['IDOT'];}

//Access Menu
$table7="access";
$fild7  = "*"; 
$where7 = "id_user='$_SESSION[ID]'";
$db->select($table7,$fild7,NULL,$where7);
$dt7=($db->getResult());				
foreach($dt7 as $key7 );
$admin=$key7['admin']; $waiters=$key7['waiters']; $chasier=$key7['chasier']; $ceo=$key7['ceo']; $client=$key7['client'];
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
    					<h5><?php echo"welcom ".$_SESSION['name'];?></h5>
					</div>
                </div>
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                             Order List 
                        </div>
                 <?php if($admin==1){?>
                <div class="row">
                    <div class="col-sm-6"> 
                        <form action="" method="get">
                                <table  cellpadding="6" >
                                     <tr>
                                        <td valign="middle">
                                          <?php 
                                                    $table = "outlet";
                                                    $fild  = "*"; 
                                                    $db->select($table,$fild);
                                                    $hasil=($db->getResult());
                                                ?>
                                            <label>&nbsp;</label>
                                                <select name="id_outlet" class="form-control" required>
                                                        <option value="">Search Outlet</option>
                                                    <?php foreach($hasil as $key){ ?>
                                                        <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                                                    <?php } ?>
                                                </select>
                                        </td>
                                        <td valign="middle"><br />  
                                        <input type="submit" class="btn btn-primary" value="Search">
                                        </td>
                                     </tr>
                                </table>  
                        </form> 
                    </div>
                </div>    
                <?php } ?>

<?php
/* 
===============================================================================================================
* Jika admin=1 atau kasir=1 bisa lihat semua pesanan 
*
===============================================================================================================
*/
if($admin==1 || $chasier==1){ ?>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Orders From</th>
                                    <th>Date</th>
                                    <th>Type Order</th>
                                    <th>Option</th>
                                    <th>Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $table = "order_first JOIN users ON order_first.id_user=users.id_user";
                                    $fild  = "*"; 
                                    $where = "order_first.status='1' AND order_first.id_outlet='$outlet' ORDER BY id_pes DESC ";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row){
                                ?>
                                <tr class="showmove">
                                    <td><?php echo $row['id_pes']; ?></td>
                                    <td class="text-right"><?php  echo $row['name']; ?></td>
                                    <td  class="text-center"><?php echo DateToIndo($row['date']); ?></td>
                                    <td><?php  echo $type=type($row['ket_pes']); ; ?></td>
                                    <td class="text-right">
                                        <button class="btn btn-primary btn-xs" data-title="+order" onclick="window.location='orderadd.php?ket=<?php echo type($row['ket_pes']); ?>&id_pes=<?php echo $row['id_pes']; ?>'" title="+ Order"><span class="glyphicon glyphicon-plus"></span></button>
                                        <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_pes']; ?>" title="View Detail"><span class="glyphicon glyphicon-arrow-right ViewDetail"></span></a>
                                        
                                    </td>
                                    <td class="text-right"><a href="#" class="savebill btn btn-primary btn-xs" id="<?php echo $row['id_pes']; ?>" title="Save to Bill" ><span class="glyphicon glyphicon-saved"></span></a></td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                         </table>
                    </div>
                    <br />
                    
                    <!-- Class  Edit-->
                                <div class="modal fade" id="ViewDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="crud/crud_order.php" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Blaster</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <span id="show_View"></span>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning btn-circle" data-dismiss="modal">Close</button> &nbsp;&nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-primary btn-circle" onclick="alert('Are You Sure ?')">Save Bill</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <div class="btn col-md-12 left">
                                <input type="button" class="btn btn-danger btn-lg" value="Order Page" onclick="window.location='orderadd_first.php'"/>&nbsp;
                                <input type="button" class="btn btn-primary btn-lg" value="Bill Payment" onclick="window.location='bill_list.php'"/>
                            </div>
                  </div>  
<?php }elseif($waiters==1){ ?> 
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Orders From</th>
                                    <th>Date</th>
                                    <th>Type Order</th>
                                    <th>Option</th>
                                    <th>Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $table = "order_first JOIN users ON order_first.id_user=users.id_user";
                                    $fild  = "*"; 
                                    $where = "order_first.id_user='$iduser' AND order_first.status='1' AND order_first.id_outlet='$outlet' ORDER BY id_pes DESC ";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row){
                                ?>
                                <tr class="showmove">
                                    <td><?php echo $row['id_pes']; ?></td>
                                    <td class="text-right"><?php  echo $row['name']; ?></td>
                                    <td  class="text-center"><?php echo DateToIndo($row['date']); ?></td>
                                    <td><?php  echo $type=type($row['ket_pes']); ; ?></td>
                                    <td class="text-right">
                                        <button class="btn btn-primary btn-xs" data-title="+order" onclick="window.location='orderadd.php?ket=<?php echo type($row['ket_pes']); ?>&id_pes=<?php echo $row['id_pes']; ?>'" title="+ Order"><span class="glyphicon glyphicon-plus"></span></button>
                                        <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_pes']; ?>" title="View Detail"><span class="glyphicon glyphicon-arrow-right ViewDetail"></span></a>
                                        
                                    </td>
                                    <td class="text-right"><a href="#" class="savebill btn btn-primary btn-xs" id="<?php echo $row['id_pes']; ?>" title="Save to Bill" ><span class="glyphicon glyphicon-saved"></span></a></td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                         </table>
                    </div>
                    <br />
                    
                    <!-- Class  Edit-->
                                <div class="modal fade" id="ViewDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="crud/crud_order.php" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Blaster</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <span id="show_View"></span>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning btn-circle" data-dismiss="modal">Close</button> &nbsp;&nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-primary btn-circle" onclick="alert('Are You Sure ?')">Save Bill</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <div class="btn col-md-12 left">
                                <input type="button" class="btn btn-danger btn-lg" value="Order Page" onclick="window.location='orderadd_first.php'"/>&nbsp;
                                <input type="button" class="btn btn-primary btn-lg" value="Bill Payment" onclick="window.location='bill_list.php'"/>
                            </div>
                  </div>
<?php }else{ ?>
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Orders From</th>
                                    <th>Date</th>
                                    <th>Type Order</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $table = "order_first JOIN users ON order_first.id_user=users.id_user";
                                    $fild  = "*"; 
                                    $where = "order_first.id_user='$iduser' AND order_first.status='1' AND order_first.id_outlet='$outlet' ORDER BY id_pes DESC ";
                                    $db->select($table,$fild,NULL,$where);
                                    $hasil=$db->getResult();
                                    foreach ($hasil as $row){
                                ?>
                                <tr class="showmove">
                                    <td><?php echo $row['id_pes']; ?></td>
                                    <td class="text-right"><?php  echo $row['name']; ?></td>
                                    <td  class="text-center"><?php echo DateToIndo($row['date']); ?></td>
                                    <td><?php  echo $type=type($row['ket_pes']); ; ?></td>
                                    <td class="text-right">
                                        <button class="btn btn-primary btn-xs" data-title="+order" onclick="window.location='orderadd.php?ket=<?php echo type($row['ket_pes']); ?>&id_pes=<?php echo $row['id_pes']; ?>'" title="+ Order"><span class="glyphicon glyphicon-plus"></span></button>
                                        <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_pes']; ?>" title="View Detail"><span class="glyphicon glyphicon-arrow-right ViewDetail"></span></a>
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                         </table>
                    </div>
                    <br />
                    
                    <!-- Class  Edit-->
                                <div class="modal fade" id="ViewDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="crud/crud_order.php" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Blaster</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <span id="show_View"></span>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning btn-circle" data-dismiss="modal">Close</button> &nbsp;&nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-primary btn-circle" onclick="alert('Are You Sure ?')">Save Bill</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <div class="btn col-md-12 left">
                                <input type="button" class="btn btn-danger btn-lg" value="Order Page" onclick="window.location='orderadd_first.php'"/>&nbsp;
                                <input type="button" class="btn btn-primary btn-lg" value="Bill Payment" onclick="window.location='bill_list.php'"/>
                            </div>
                  </div>
<?php } ?>
                </div>
            </div>
                </div>
            </div>
        </div>
</div>
 <!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script> 
<script type="text/javascript">
                    $('.ViewDetail').click(function(){
                        var id = $(this).data('id');
                        $.ajax({
                        type : 'post',
                        url : 'order_bill_view.php', //Here you should put your query 
                        data :  'id_pes='+ id, //Here you pass your image id via ajax .
                        success : function(data){
                            // Open modal and show output data from file.php 
                            $('.modal-body #show_View').html(data);
                            $('#ViewDetail').modal('show');
                         }
                      });

                });
        
        // Class Save Bill
        $(".savebill").click(function(){
            var element = $(this);
            var del_id = element.attr("id");
            var info = 'id=' + del_id;
            if(confirm("Are you sure save to bill this item ?"))
            {
             $.ajax({
               type: "POST",
               url: "bill_save.php",
               data: info,
               success: function(){
             }
            });
              $(this).closest(".showmove").animate({ backgroundColor: "#003" }, "slow")
              .animate({ opacity: "0.2" }, "fast");
             }

            return false;
        });
</script>  