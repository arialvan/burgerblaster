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
         
        <input type="hidden" name="act" value="add_gudang" />
        <input type="hidden" name="id_material" value="<?php echo $id_mat; ?>" />
        <input type="hidden" name="id_wh1" value="<?php echo $id_wh; ?>" />
        <input type="hidden" name="id" value="<?php echo $value['id_stock_material']; ?>" />
            <label><?php echo $value['material_name']; ?></label> :
            <input type="text" name="gudang" size="10" value="<?php echo $value['qty_material']; ?>" /> 
            
            <label>Kirim ke Gudang</label> 
            <?php 
                $table = "warehouse";
                $fild  = "*"; 
                $db->select($table,$fild);
                $hasil=($db->getResult());
            ?>
                <select name="id_wh2" required>
                    <option value="">Pilih Gudang</option>
                    <?php foreach($hasil as $key){ ?>
                    <option value="<?php echo $key['id_wh'] ?>"><?php echo $key['name_wh']; ?></option>;
                    <?php } ?>
                </select> <br /><br />
                
                <label>Banyaknya</label>
                <input type="text" name="stripgudang" size="10" />
                <label>Sisa Stock</label>
                <input type=text name="sisa" size="10" readonly="readonly" />
<?php 

        } 
        
    }

?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript"> 
var gudang       = document.getElementsByName('gudang')[0];
var stripgudang = document.getElementsByName('stripgudang')[0];
var sisa      = document.getElementsByName('sisa')[0];

function updateInput() {
  sisa.value = gudang.value - stripgudang.value;
}

gudang.addEventListener('change', updateInput);
stripgudang.addEventListener('keyup', updateInput);
sisa.addEventListener('change', updateInput);
</script>