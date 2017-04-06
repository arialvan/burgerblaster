<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $table = "user_customer";
                    $fild  = "*"; 
                    $db->select($table,$fild);
                    $hasil=($db->getResult());
                    foreach($hasil as $key )
                    { 
		?>
                    <tr>
                        <td>
                            <?php 
                                echo $key['nama_cs']."<br />
                                     <span class='text-danger small'>".$key['hp_cs']."<br />".$key['email_cs']."</span>";
                            ?>
                        </td>
                        <td><?php echo $key['alamat_cs'];?></td>
                        <td>
                            <a href='csedit.php?id_cs=<?php echo $key['id_cs'] ?>' title="Edit"><span class="glyphicon glyphicon-edit Edit"></span></a>&nbsp;&nbsp;
                            <a href='csmove.php?id_cs=<?php echo $key['id_cs'] ?>'title="Remove" ><span class="glyphicon glyphicon-remove Remove"></span></a>&nbsp;&nbsp;
                            <a href="#ViewDetail" class="btn btn-primary btn-xs ViewDetail" data-toggle="modal" data-id="<?php echo $row['id_cs']; ?>" title="Reset Password"><span class="glyphicon glyphicon-lock ViewDetail"></span></a>&nbsp;&nbsp;
                        </td>
                    </tr>
		<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>