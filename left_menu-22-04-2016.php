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
                <li><a class="active-menu"  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a></li>
                    <?php if($admin==1){?>
                    <li><a href="#"><i class="fa fa-angle-double-right fa-2x"></i>Data Input<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">User<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="useradd.php">Add User</a></li>
                                    <li><a href="useraccess.php">Add Access </a></li>
                                </ul>
                            </li>
                            <li><a href="#">Warehouse & Outlet<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="warehouse-add.php">Add Warehouse</a></li>
                                    <li><a href="outletadd.php">Add Outlet</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Material & Product<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="material_add.php">Add Material</a></li>
                                    <li><a href="product_add.php">Add Product</a></li>
                                </ul>
                            </li>
                            <li><a href="meja_add.php">Add Tables</a></li>
                            <li><a href="#">Blaster Finance<span class="fa arrow"></span></a>
                                 <ul class="nav nav-third-level">
                                    <li><a href="purchase_list.php">Daily Purchase</a></li>
                                    <li><a href="cost_list.php">Fixed Cost</a></li>
                                    <li><a href="cash_list.php">Daily Cash Book</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php }elseif($chasier==1){ ?>
                    <li><a href="#"><i class="fa fa-angle-double-right fa-2x"></i>Data Input<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="warehouse-add.php">Add Warehouse</a></li>
                            <li><a href="outletadd.php">Add Outlet</a></li>
                            <li><a href="material_add.php">Add Material</a></li>
                            <li><a href="product_add.php">Add Product</a></li>
                            <li><a href="meja_add.php">Add Tables</a></li>
                            
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($admin==1){?>
                    <li><a href="#"><i class="fa fa-users fa-2x"></i>User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="userlist.php">User List</a></li>
                            <li><a href="useraccess_list.php">Access List</a></li>
                            <li><a href='useredit.php?id_user=<?php echo $_SESSION['ID'] ?>' class='fa fa-edit'>My Account</a></li>
                        </ul>
                    </li>
                    <?php }else{ ?>
                    <li><a href="#"><i class="fa fa-users fa-2x"></i>User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href='useredit.php?id_user=<?php echo $_SESSION['ID'] ?>' class='fa fa-edit'>My Account</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                
                <?php if($admin==1 || $chasier==1){?>
                <li><a href="warehouse_list.php"><i class="fa fa-bank fa-2x"></i>Warehouse<span class="fa arrow"></span></a></li> 
                <li><a href="outletlist.php"><i class="fa fa-shopping-cart fa-2x"></i> Outlet<span class="fa arrow"></span></a></li>
                <li><a href="meja_list.php"><i class="fa fa-table fa-2x"></i> Tables<span class="fa arrow"></span></a></li>
                <li><a href="product_add.php"><i class="fa fa-bars fa-2x"></i>Product <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                             <ul class="nav nav-third-level">
                                    <?php
                                        $tables = "outlet";
                                        $filds  = "id_outlet,outlet_name"; 
                                        $db->select($tables,$filds);
                                        $dts=($db->getResult());				
                                        foreach($dts as $key ){
                                    ?>
                                            <li><a href="product_list.php?id=<?php echo $key['id_outlet']; ?>"><?php echo $key['outlet_name']; ?> </a></li>
                                    <?php    } ?>
                            </ul>
                    </ul>
                </li>                
                <li><a href="#"><i class="fa fa-briefcase fa-2x"></i>Cashier <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="order_bill.php">Order List</a></li>
                        <li><a href="bill_list.php">Bill Payment</a></li>
                        <li><a href="payment_done.php">Products Sould</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li><a href="#"><i class="fa fa-download fa-2x"></i>Order <span class="fa arrow"></span></a>
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
                <?php if($ceo==1){?>
                <li><a href="#"><i class="fa fa-bar-chart-o fa-2x"></i>Report <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="payment_done.php">Table Report</a></li>
                        <li><a href="payment_chart.php">Chart Report</a></li>
                    </ul>
                </li>
                 <?php } ?>
           <li><a  href="logout.php"><i class="fa fa-lock fa-2x"></i> Logout</a></li>	
       </ul>               
   </div>
</nav> 