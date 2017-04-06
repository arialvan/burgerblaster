<?php
include"userotentifikasi.php";
include"header.php";
include "func/sex.php";
include "crud/class_crud.php";
$db = new crud();
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
                             Tabel User 
                        </div>
                        <div class="panel-body">
                        <?php
							$table = "users";
							$fild  = "*"; 
							$db->select($table,$fild);
							$hasil=($db->getResult());
						?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Alamat</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
											foreach($hasil as $key )
											{ 
										?>
                                        		<tr>
													 	<td><?php echo $key['name'] ?></td>
														<td><?php echo $key['phone']?></td>
														<td><?php echo $key['email']?></td>
														<td><?php lev($key['level'])?></td>
														<td><?php echo $key['address']?></td>
														<td>
                                                                                                                    <a href='useredit.php?id_user=<?php echo $key['id_user'] ?>' title="Edit"><span class="glyphicon glyphicon-pencil Edit"></span></a>&nbsp;&nbsp;
                                                                                                                    <a href='usermove.php?id_user=<?php echo $key['id_user'] ?>'title="Remove" ><span class="glyphicon glyphicon-remove Remove"></span></a>&nbsp;&nbsp;
                                                                                                                    <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_user']; ?>" title="Reset Password"><span class="glyphicon glyphicon-lock ViewDetail"></span></a>&nbsp;&nbsp;
                                                                                                                </td>
												 </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                            
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
                                                    <button type="submit" class="btn btn-primary btn-circle" onclick="alert('Are You Sure ?')">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <br />
                            <input type="button" class="btn btn-primary btn-lg" value="Add User" onclick="window.location='useradd.php'"/>
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
     <?php include 'footer.php';?>
     <script type="text/javascript">
         $('.ViewDetail').click(function(){
                        var id = $(this).data('id');
                        $.ajax({
                        type : 'post',
                        url : 'password_reset.php', //Here you should put your query 
                        data :  'id_user='+ id, //Here you pass your image id via ajax .
                        success : function(data){
                            // Open modal and show output data from file.php 
                            $('.modal-body #show_View').html(data);
                            $('#ViewDetail').modal('show');
                         }
                      });

                });
     </script>