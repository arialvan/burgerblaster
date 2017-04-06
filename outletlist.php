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
                             Outlet Table
                        </div>
                        <div class="panel-body">
                        <?php
							$table = "outlet";
							$fild  = "*"; 
							$db->select($table,$fild);
							$hasil=($db->getResult());
						?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama Outlet</th>
                                            <th>Phone</th>
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
						<td><?php echo $key['outlet_name'] ?></td>
						<td><?php echo $key['phone']?></td>
						<td><?php echo $key['outlet_addr']?></td>
						<td>
                                                    <a href='outletedit.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-edit'>Edit</a>|
                                                    <a href='outletmove.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-pencil'>Hapus</a>|
                                                    <a href='outletstock.php?id_ot=<?php echo $key['id_outlet'] ?>' class='fa fa-pencil'>View Stock</a>
						</td>
                                            </tr>
											
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <input type="button" class="btn btn-primary btn-lg" value="Add Outlet" onclick="window.location='outletadd.php'"/>
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
			
		/*$(document).ready(function(){
		  $.ajax({ 
			   type: 'POST', 
			   url: 'userjson.php', 
			   data: { get_param: 'value' }, 
			   dataType: 'json',
			   success: function (data) { 
				var trbd = '';
				   $.each(data, function(index, item) {
					trbd = '<tr><td>'+item.name+'</td><td>'+item.phone+'</td><td>'+item.email+'</td><td>'+item.level+'</td><td>'+item.address+'</td><td><a href="useredit.php?'+item.id_user+'" class="fa fa-edit">Edit</a> <a href="userdelete.php?'+item.id_user+'" class="fa fa-pencil">Delete</a></td></tr>';
					   $('tbody').append(trbd);
				   });
				   $('#dataTables-example').dataTable();
			   }
		  });
			   
		});*/
		
		/*$ ( document ).ready(function() {
			$.ajax({
				type: 'POST',
				url: 'userjson.php',
				dataType: 'json',
				success: function(data) {
					$.each(data, function(i, data) {
						var body = "<tr>";
						body    += "<td>" + data.name + "</td>";
						body    += "<td>" + data.phone + "</td>";
						body    += "<td>" + data.email + "</td>";
						body    += "<td>" + data.level + "</td>";
						body    += "<td>" + data.address + "</td>";
						body    += "<td>" + '<a href="useredit.php?id_user='+ data.id_user +'" class="fa fa-edit">Edit</a> <a href="userdelete.php?id_user='+ data.id_user +'" class="fa fa-pencil">Delete</a>'+"</td>";
						body    += "</tr>";
						$( "#dataTables-example tbody" ).append(body);
					});
					
					$( "#dataTables-example" ).DataTable();
				},
				error: function() {
					alert('Fail!');
				}
			});
			});*/
        </script>
        <script src="assets/js/custom.js"></script>
 </body>
</html>