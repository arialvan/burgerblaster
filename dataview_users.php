<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $table = "users";
                    $fild  = "*"; 
                    $db->select($table,$fild);
                    $hasil=($db->getResult());
                    foreach($hasil as $key )
                    { 
		?>
                    <tr>
                        <td>
                            <?php 
                                echo $key['name']."<br />
                                     <span class='text-danger small'>".$key['phone']."<br />".$key['email']."</span>";
                            ?>
                        </td>
                        <td><?php lev($key['level'])?></td>
			<td><?php echo $key['address']?></td>
			<td>
                            <a href='useredit.php?id_user=<?php echo $key['id_user'] ?>' title="Edit"><span class="glyphicon glyphicon-edit Edit"></span></a>&nbsp;&nbsp;
                            <a href='usermove.php?id_user=<?php echo $key['id_user'] ?>' onclick="return confirm('Are you sure you want to delete this product?')" title="Remove" ><span class="glyphicon glyphicon-remove Remove"></span></a>&nbsp;&nbsp;
                            <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_user']; ?>" title="Reset Password"><span class="glyphicon glyphicon-lock ViewDetail"></span></a>&nbsp;&nbsp;
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>