<nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="photo/hamburger.png" width="50" height="50" /></a> 
            </div>
            <?php
		//include"logout_style.php";
            ?>
            <div style="color:#FFF;padding: 15px 50px 5px 50px;font-size: 16px;"> 
                <?php 
                    $tables = "outlet";
                    $filds  = "outlet_name";
                    $wheres = "id_outlet='$_SESSION[IDOT]'";
                    $db->select($tables,$filds,NULL,$wheres);
                    $hasils=($db->getResult());
                    foreach($hasils as $keys );
                ?>
                <span style="font-family:fantasy; font-weight:bold; font-size:22px; text-align: left;"><?php echo $keys['outlet_name']; ?></span>
                <a href="logout.php" class="btn btn-default square-btn-adjust" style="float: right;">Logout</a> 
                <a href="useredit.php?id_user=<?php echo $_SESSION['ID'] ?>" class="btn btn-default square-btn-adjust" style="float: right;">My Account</a>
            </div>
       </nav>   