<?php
include "crud/class_crud.php";
include "func/sex.php";
$db = new crud();


if(isset($_POST['id_product'])){  
        $get=explode("#",$_POST['id_product']);
        $id = $get[0];
        $ket= $get[1];
        $id_pes=$get[2];
    if($ket=="onplace"){
        $table5 = "product";
        $fild5  = "*";
        $where5 = "id_product='$id'";
        $db->select($table5,$fild5,NULL,$where5);
        $hasil5=$db->getResult();
        foreach ($hasil5 as $value) ; 
?>

        <input type="hidden" name="act" value="order_add_tambahan" />
        <input type="hidden" name="id_product" value="<?php echo $id; ?>" />
        <input type="hidden" name="id_outlet" value="<?php echo $value['id_outlet']; ?>" />
        <input type="hidden" name="ket_pes" value="1" />
        <input type="text" name="id_pes" value="<?php echo $id_pes; ?>" />
        <div class="panel panel-default">
            <div class="row">
            <div class="col-sm-8 col-md-12">
                <div class="tab-content bg-color-brown text-center">
                    <a href="#ViewMakanan" class="view-detil-makanan" data-id="<?php echo $value['id_product']; ?>" data-toggle="modal"><img src="blester/<?php echo $value['product_foto'] ?>"  class="img-circle" width="200" height="180" /></a>
                        <div class="caption ">
                        <h4><?php echo $value['product_name'] ?></h4>
                        <h4><?php echo rupiah($value['unit_price']); ?></h4>                                      
                        </div>
                </div>
              
                <p class="text-center">Add Quantity</p>
                <div class="input-group text-center">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-minuse" type="button">-</button>
                    </span>
                    <input type="text" name="qty" class="form-control no-padding add-color text-center height-25" maxlength="3" value="0" />
                    <span class="input-group-btn">
                        <button class="btn btn-red btn-pluss" type="button">+</button>
                    </span>
                </div>   
                <?php
                    $table1="meja";
                    $filds ="*";
                    $db->select($table1,$filds);
                    $hasils=$db->getResult();
                    
                ?>
                <p class="text-center">Table Number</p>
                <div class="form-group">
                    <select name="meja" class="form-control text-center" required >
                    <option value="0">-- Table Number --</option>
                <?php
                    foreach ($hasils as $values){
                ?>    
                    <option value="<?php echo $values['id_meja']; ?>"><?php echo $values['no_meja']; ?></option>
                <?php } ?>
                </select>
                </div>
            </div>
        </div>
            
        </div>

<?php  

    }else{ 
            $table5 = "product";
            $fild5  = "*";
            $where5 = "id_product='$id'";
            $db->select($table5,$fild5,NULL,$where5);
            $hasil5=$db->getResult();
            foreach ($hasil5 as $value) ; 
    
?>
        
        <input type="hidden" name="act" value="order_add_tambahan" />
        <input type="hidden" name="id_product" value="<?php echo $id; ?>" />
        <input type="hidden" name="id_outlet" value="<?php echo $value['id_outlet']; ?>" />
        <input type="hidden" name="ket_pes" value="2" />
        <input type="hidden" name="id_pes" value="<?php echo $id_pes; ?>" />
        <div class="panel panel-default">
            <div class="row">
            <div class="col-sm-8 col-md-12">
                <div class="tab-content bg-color-brown text-center">
                    <a href="#ViewMakanan" class="view-detil-makanan" data-id="<?php echo $value['id_product']; ?>" data-toggle="modal"><img src="blester/<?php echo $value['product_foto'] ?>"  class="img-circle" width="200" height="180" /></a>
                        <div class="caption ">
                        <h4><?php echo $value['product_name'] ?></h4>
                        <h4><?php echo rupiah($value['unit_price']); ?></h4>                                      
                        </div>
                </div>
               
                <p class="text-center">Add Quantity</p>
                <div class="input-group text-center">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-minuse" type="button">-</button>
                    </span>
                    <input type="text" name="qty" class="form-control no-padding add-color text-center height-25" maxlength="3" value="0" />
                    <span class="input-group-btn">
                        <button class="btn btn-red btn-pluss" type="button">+</button>
                    </span>
                </div>   
            </div>
        </div>
            
        </div> 
<?php } } ?>

<script type="text/javascript">
            $('.btn-minuse').on('click', function(){
                $(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) - 1)
            })

            $('.btn-pluss').on('click', function(){
                $(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) + 1)
            })
</script>