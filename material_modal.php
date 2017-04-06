<?php
include "crud/class_crud.php";
$db = new crud();
if(isset($_POST['id_material'])){  
        $id = explode('#',$_POST['id_material']);
        $id_mat = $id[0]; //echo "<br />";
        $id_wh  = $id[1];
        $table5 = "material JOIN material_stock ON material.id_material=material_stock.id_material";
        //$fild5  = "*,SUM(qty_material) AS Total"; 
        $fild5  = "*";
        $where5 = "material.id_material='$id_mat' AND material_stock.id_wh='$id_wh'";
        $db->select($table5,$fild5,NULL,$where5);
        $hasil5=$db->getResult();
        foreach ($hasil5 as $value) { ?>

<input type="hidden" name="act" value="add_shareoutlet" />            
<input type="hidden" name="id_material" value="<?php echo $id_mat; ?>" />
<input type="hidden" name="id_wh" value="<?php echo $id_wh; ?>" />
<input type="hidden" name="id" value="<?php echo $value['id_stock_material']; ?>" />
            <label><?php echo $value['material_name']; ?></label> :
            <input type="text" name="stok" size="10" value="<?php echo $value['qty_material']; ?>" /> 
            
            <label>Kirim ke Outlet</label> 
            <?php 
                $table = "outlet";
                $fild  = "*"; 
                $db->select($table,$fild);
                $hasil=($db->getResult());
            ?>
                <select name="id_ot" required>
                    <option value="">Pilih Outlet</option>
                    <?php foreach($hasil as $key){ ?>
                    <option value="<?php echo $key['id_outlet'] ?>"><?php echo $key['outlet_name']; ?></option>;
                    <?php } ?>
                </select> <br /><br />
                
                <label>Banyaknya</label>
                <input type="text" name="kurangstok" size="10" />
                <label>Sisa Stock</label>
                <input type=text name="total" size="10" readonly="readonly" />
<?php 

        } 
        
    }

?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript"> 
var stok       = document.getElementsByName('stok')[0];
var kurangstok = document.getElementsByName('kurangstok')[0];
var total      = document.getElementsByName('total')[0];

function updateInput() {
  total.value = stok.value - kurangstok.value;
}

stok.addEventListener('change', updateInput);
kurangstok.addEventListener('keyup', updateInput);
total.addEventListener('change', updateInput);
</script>