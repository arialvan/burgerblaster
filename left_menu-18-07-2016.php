<?php
$table1 = "users";
$fild1  = "*"; 
$where1 = "id_user='$_SESSION[ID]'";
$db->select($table1,$fild1,NULL,$where1);
$dt=($db->getResult());				
foreach($dt as $key );
$foto=$key['pic'];
$level=$key['level'];

//Access Menu
$table7="access";
$fild7  = "*"; 
$where7 = "id_user='$_SESSION[ID]'";
$db->select($table7,$fild7,NULL,$where7);
$dt7=($db->getResult());				
foreach($dt7 as $key7 );
$admin=$key7['admin']; $waiters=$key7['waiters']; $chasier=$key7['chasier']; $ceo=$key7['ceo']; $client=$key7['client'];
?>
<nav class="navbar-default navbar-side" role="navigation">
	<div class="sidebar-collapse">
    	<ul class="nav" id="main-menu">
        	<li class="text-center"><img src="<?php echo "blester/".$foto;?>" class="user-image img-responsive" /></li> 
<!-- DASHBOARD =========================-->
                <li><a class="active-menu"  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a></li>
                
<!-- REPORT ============================-->                
                <?php if($ceo==1){?>
                <li><a href="#"><i class="fa fa-bar-chart-o fa-2x"></i>Report <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="payment_done.php">Report(Day/Month/Year)</a></li>
                        <li><a href="payment_chart.php">Chart Report Penjualan</a></li>
                        <li><a href="product_chart.php">Chart Report Product</a></li>
                        <li><a href="cash_list.php">Daily Cash Book</a></li>
                        <li><a href="#">Cost<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="purchase_list.php">Daily Cost</a></li>
                                    <li><a href="cost_list.php">Fixed Cost</a></li>
                                </ul>
                        </li>
                    </ul>
                </li>
                 <?php } ?>
                
<!-- DATA VIEW ============================-->                 
                <?php if($admin==1 || $chasier==1){?>
                <li><a href="#"><i class="fa fa-database fa-2x"></i>Data View <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="warehouse_list.php"><i class="fa fa-bank fa-2x"></i>Warehouse</a></li> 
                        <li><a href="outletlist.php"><i class="fa fa-home fa-2x"></i>Outlet</a></li> 
                        <li><a href="outletlist.php"><i class="fa fa-shopping-cart fa-2x"></i> Product<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="meja_list.php"><i class="fa fa-table fa-2x"></i> Tables</a></li>
                                                        <?php
                                                            $tables = "outlet";
                                                            $filds  = "id_outlet,outlet_name"; 
                                                            $db->select($tables,$filds);
                                                            $dts=($db->getResult());				
                                                            foreach($dts as $key ){
                                                        ?>
                                                                <li><a href="product_list.php?id=<?php echo $key['id_outlet']; ?>"><i class="fa fa-bars fa-2x"></i><?php echo $key['outlet_name']; ?> </a></li>
                                                        <?php    } ?>
                                </ul>
                        </li>
                    </ul>
                </li>
                 <?php } ?>
                
                    
                <?php if($admin==1 || $chasier==1){?>
                
                
                 
                <?php } ?>
                
                <li><a href="#"><i class="fa fa-mail-forward fa-2x"></i>Order <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="orderadd_first.php">Add New Order</a></li>
                        <li><a href="order_chart.php">Order Chart</a></li>
                        <?php 
                            $table_ses = "session_menu";
                            $fild_ses  = "*"; 
                            $where_ses = "id_outlet='$_SESSION[IDOT]'";
                            $db->select($table_ses,$fild_ses,NULL,$where_ses);
                            $hasil_ses=($db->getResult());
                            foreach($hasil_ses as $key_ses);
                            if($key_ses['role_session']==2){
                        ?>
                        <li><a href="order_bill_role.php">Order List</a></li>
                        <?php 
                            }else{
                        ?>
                        <li><a href="order_bill.php">Order List</a></li>
                        <?php } ?>
                    </ul>
                </li>
                
<!-- USER ===============================-->           
             <?php if($admin==1){?>
                    <li><a href="#"><i class="fa fa-gears fa-2x"></i>Setting<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">User<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="useradd.php">Add User</a></li>
                                    <li><a href="userlist.php">User List</a></li>
                                    <li><a href="useraccess_list.php">User Access</a></li>
                                    <li><a href='useredit.php?id_user=<?php echo $_SESSION['ID'] ?>' class='fa fa-edit'>My Account</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Warehouse & Outlet<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="warehouse-add.php">Add Warehouse</a></li>
                                    <li><a href="cost_add.php">Add Outlet</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Material<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="material_add.php">Add Material</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Product<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="product_add.php">Add Product</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Cost<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="purchase_add.php">Add Daily Cost</a></li>
                                    <li><a href="cost_add.php">Add Fixed Cost</a></li>
                                </ul>
                            </li>
                            <li><a href="meja_add.php">Add Tables</a></li>
                        </ul>
                    </li>
                    <?php } ?>   
                
           <li><a  href="logout.php"><i class="fa fa-sign-out fa-2x"></i> Logout</a></li>	
       </ul>               
   </div>
</nav> 